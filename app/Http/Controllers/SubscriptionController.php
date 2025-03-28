<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as LaravelLog;
use Acelle\Model\Subscription;
use Acelle\Model\Setting;
use Acelle\Model\Plan;
use Acelle\Cashier\Services\StripeGatewayService;
use Acelle\Cashier\Cashier;
use Acelle\Library\Contracts\PaymentGatewayInterface;
use Carbon\Carbon;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use Acelle\Model\SubscriptionLog;

class SubscriptionController extends Controller
{
    public $clientId;
    public $secret;
    public $client;
    public $environment;
    
    public function __construct()
    {
        $this->environment = Setting::get('cashier.paypal.environment', 'sandbox');
        $this->clientId = Setting::get('cashier.paypal.client_id');
        $this->secret = Setting::get('cashier.paypal.secret');

        if (!$this->clientId || !$this->secret) {
            throw new \Exception('PayPal credentials are missing.');
        }

        if ($this->environment == 'sandbox') {
            $this->client = new PayPalHttpClient(new SandboxEnvironment($this->clientId, $this->secret));
        } else {
            $this->client = new PayPalHttpClient(new ProductionEnvironment($this->clientId, $this->secret));
        }
    }

    public function index(Request $request)
    {
        // init
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;

        // 1. HAVE NOT HAD SUBSCRIPTION YET OR SUBSCRIPTION IS ENDED
        if (!$subscription ||
            $subscription->isEnded()
        ) {
            return redirect('admin/account/subscription/select-plan');
        }

        // @todo không để đây, chỉ test thôi, cần move qua cronjob
        // 1. 1 End luôn subscription nếu đã hết hạn
        //    2 Sinh ra RENEW invoice
        //    3 Xử lý thanh toán
        $subscription->check();
        $subscription->processRenewInvoice();

        // 2. IF PLAN NOT ACTIVE
        if (!$subscription->plan->isActive()) {
            return response()->view('errors.general', [ 'message' => __('messages.subscription.error.plan-not-active', [ 'name' => $subscription->plan->name]) ]);
        }

        // 3. SUBSCRIPTION IS NEW
        if ($subscription->isNew()) {
            $invoice = $subscription->getItsOnlyUnpaidInitInvoice();

            return redirect('admin/account/subscription/payment/'.$invoice->uid);
        }

        // 3. SUBSCRIPTION IS ACTIVE, SHOW DETAILS PAGE
        return view('subscription.index', [
            'subscription' => $subscription,
            'plan' => $subscription->plan,
        ]);
    }

    public function selectPlan(Request $request)
    {
        //
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;

        return view('subscription.selectPlan', [
            'plans' => Plan::getAvailablePlans(),
            'subscription' => $subscription,
        ]);
    }

    public function init(Request $request)
    {
        // Get current customer
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;
        $plan = Plan::findByUid($request->plan_uid);

        // try to save old invoice billing info
        if ($subscription &&
            !$subscription->isEnded() &&
            $subscription->getUnpaidInvoice()
        ) {
            $oldInvoice = $subscription->getUnpaidInvoice();

            $oldBillingInfo = [
                'billing_first_name' => $oldInvoice->billing_first_name,
                'billing_last_name' => $oldInvoice->billing_last_name,
                'billing_address' => $oldInvoice->billing_address,
                'billing_email' => $oldInvoice->billing_email,
                'billing_phone' => $oldInvoice->billing_phone,
                'billing_country_id' => $oldInvoice->billing_country_id,
            ];
        }

        // create new subscription
        $subscription = $customer->subscription;
        $subscription = $customer->assignPlan($plan);

        // create init invoice
        if (!$subscription->invoices()->new()->count()) {
            $invoice = $subscription->createInitInvoice();
        }

        // copy old billing info
        if (isset($oldBillingInfo)) {
            $invoice = $subscription->getUnpaidInvoice();

            $invoice->fill($oldBillingInfo);
            $invoice->save();
        }

        // Check if subscriotion is new
        return redirect('admin/account/subscription/billing-information');
    }

    public function payment(Request $request)
    {
        // Get current customer
        $customer = $request->user()->customer;

        // get invoice
        $invoice = $customer->invoices()->where('uid', '=', $request->invoice_uid)->first();

        if (!$invoice || !$invoice->isNew()) {
            return redirect('admin/account/subscription');
        }

        if ($invoice->isNew()) {
            if ($invoice->getPendingTransaction()) {
                return view('subscription.pending', [
                    'invoice' => $invoice,
                ]);

            // go to billing info + payment
            } else {
                // no billing information
                if (!$invoice->hasBillingInformation()) {
                    return redirect('admin/account/subscription/billing-information');
                }

                if ($invoice->isFree()) {
                    return view('subscription.payment', [
                        'invoice' => $invoice,
                    ]);
                } else {
                    return view('subscription.payment', [
                        'invoice' => $invoice,
                    ]);
                }
            }
        }
    }

    public function confirmFree(Request $request)
    {
        // get invoice
        $invoice = $request->user()->customer->invoices()->where('uid', '=', $request->invoice_uid)->first();

        if (!$invoice->isFree()) {
            throw new \Exception('Invoice is not free!');
        }

        if ($request->payment_method) {
            $request->user()->customer->updatePaymentMethod([
                'method' => $request->payment_method,
            ]);
        }

        $invoice->confirmWithoutPayment();

        $request->session()->flash('alert-success', trans('messages.invoice.confirmed'));
        return redirect('admin/account/subscription');
    }

    public function cancelInvoice(Request $request, $uid)
    {
        $invoice = \Acelle\Model\Invoice::findByUid($uid);

        if (!$request->user()->customer->can('delete', $invoice)) {
            return $this->notAuthorized();
        }

        $invoice->cancel();

        // Redirect to my subscription page
        $request->session()->flash('alert-success', trans('messages.invoice.cancelled'));
        return redirect('admin/account/subscription');
    }

    public function checkout(Request $request)
    {
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;
        $invoice = $subscription->getUnpaidInvoice();

        $request->user()->customer->updatePaymentMethod([
            'method' => $request->payment_method,
        ]);

        // redirect to service checkout
        return redirect()->away($customer->getPreferredPaymentGateway()->getCheckoutUrl($invoice));
    }

    public function billingInformation(Request $request)
    {
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;
        $invoice = $subscription->getUnpaidInvoice();
        $billingAddress = $customer->getDefaultBillingAddress();

        // Save posted data
        if ($request->isMethod('post')) {
            $validator = $invoice->updateBillingInformation($request->all());

            // redirect if fails
            if ($validator->fails()) {
                return response()->view('subscription.billingInformation', [
                    'invoice' => $invoice,
                    'billingAddress' => $billingAddress,
                    'errors' => $validator->errors(),
                ], 400);
            }

            // update current billing information
            $customer->updateBillingInformationFromInvoice($invoice);

            $request->session()->flash('alert-success', trans('messages.billing_address.updated'));

            // return to subscription
            return redirect('admin/account/subscription/payment/'.$invoice->uid);
        }

        return view('subscription.billingInformation', [
            'invoice' => $invoice,
            'billingAddress' => $billingAddress,
        ]);
    }

    /**
     * Change plan.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function changePlan(Request $request)
    {
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;
        $gateway = $customer->getPreferredPaymentGateway();
        $plans = Plan::getAvailablePlans();

        // Authorization
        if (!$request->user()->customer->can('changePlan', $subscription)) {
            return $this->notAuthorized();
        }

        //
        if ($request->isMethod('post')) {
            $newPlan = Plan::findByUid($request->plan_uid);

            try {
                // set invoice as pending
                $changePlanInvoice = $subscription->createChangePlanInvoice($newPlan);
            } catch (\Exception $e) {
                $request->session()->flash('alert-error', $e->getMessage());
                return redirect('admin/account/subscription');
            }

            // return to subscription
            return redirect('admin/account/subscription/payment/'.$changePlanInvoice->uid);
        }

        return view('subscription.change_plan', [
            'subscription' => $subscription,
            'gateway' => $gateway,
            'plans' => $plans,
        ]);
    }

    /**
     * Cancel subscription at the end of current period.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        if (isSiteDemo()) {
            return response()->json(["message" => trans('messages.operation_not_allowed_in_demo')], 404);
        }

        $customer = $request->user()->customer;
        $subscription = $customer->subscription;

        if ($request->user()->customer->can('cancel', $subscription)) {
            $subscription->cancel();
        }

        // Redirect to my subscription page
        $request->session()->flash('alert-success', trans('messages.subscription.cancelled'));
        return redirect('admin/account/subscription');
    }


    /**
     * Cancel subscription at the end of current period.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resume(Request $request)
    {
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;

        if ($request->user()->customer->can('resume', $subscription)) {
            $subscription->resume();
        }

        // Redirect to my subscription page
        $request->session()->flash('alert-success', trans('messages.subscription.resumed'));
        return redirect('admin/account/subscription');
    }

    /**
     * Cancel now subscription at the end of current period.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelNow(Request $request)
    {
        if (isSiteDemo()) {
            return response()->json(["message" => trans('messages.operation_not_allowed_in_demo')], 404);
        }

        $customer = $request->user()->customer;
        $subscription = $customer->subscription;
        if($subscription->paypal_subscription_id){
           $this->cancelSubscription($subscription->paypal_subscription_id);
        }
        if ($request->user()->customer->can('cancelNow', $subscription)) {
            $subscription->cancelNow();
        }

        // Redirect to my subscription page
        $request->session()->flash('alert-success', trans('messages.subscription.cancelled_now'));
        return redirect('admin/account/subscription');
    }

    public function cancelSubscription($subscriptionID)
        {
        try {
        // Get Access Token
        $accessToken = $this->getAccessToken();

        // PayPal API Endpoint
        $url = "https://api.sandbox.paypal.com/v1/billing/subscriptions/{$subscriptionID}/cancel";

        // cURL Request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "reason" => "Customer requested cancellation"
        ]));

        // Execute API Call
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check Response
        if ($httpCode == 204) {
            return [
                "status" => "success",
                "message" => "Subscription has been canceled successfully."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Failed to cancel subscription. Response: " . $response
            ];
        }
        } catch (\Exception $e) {
        return [
            "status" => "error",
            "message" => "Error canceling subscription: " . $e->getMessage()
        ];
        }
    }

 public function getAccessToken()
    {
       
        $url = "https://api-m.sandbox.paypal.com/v1/oauth2/token";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: application/json",
            "Accept-Language: en_US"
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ":" . $this->secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);
        
        return $response['access_token'] ?? null;
    }

    public function orderBox(Request $request)
    {
        $customer = $request->user()->customer;
        $subscription = $customer->subscription;

        // choose a plan
        if ($request->plan_uid) {
            $plan = Plan::findByUid($request->plan_uid);

            return view('subscription.orderBox', [
                'subscription' => $subscription,
                'bill' => [
                    'title' => trans('messages.subscription.your_order'),
                    'description' => trans('messages.subscription.your_order.desc', [
                        'plan' => $plan->name,
                    ]),
                    'bill' => [
                        [
                            'title' => $plan->name,
                            'description' => view('plans._bill_desc', ['plan' => $plan]),
                            'price' => format_price($plan->price, $plan->currency->format),
                            'tax' => format_price($plan->getTax(), $plan->currency->format),
                            'discount' => format_price(0, $plan->currency->format),
                        ]
                    ],
                    'charge_info' => trans('messages.bill.charge_now'),
                    'total' => format_price($plan->total(), $plan->currency->format),
                    'pending' => false,
                    'invoice_uid' => '',
                    'type' => \Acelle\Model\Invoice::TYPE_NEW_SUBSCRIPTION,
                    'plan' => $plan,
                ],
            ]);
        }

        // choose a plan
        elseif ($subscription) {
            $invoice = $subscription->getUnpaidInvoice();

            return view('subscription.orderBox', [
                'subscription' => $subscription,
                'bill' => $invoice->getBillingInfo(),
                'invoice' => $invoice,
            ]);
        }

        return view('subscription.orderBox', [
            'subscription' => $subscription,
            'bill' => null,
        ]);
    }
}
