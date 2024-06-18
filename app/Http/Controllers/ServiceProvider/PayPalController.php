<?php

namespace Acelle\Http\Controllers\ServiceProvider;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Model\StripeKey;
use Acelle\Model\CreditAmount;
use Acelle\Model\User;
use Acelle\Model\Setting;
use Acelle\Model\BuyCreadit;
use Session;
use Auth;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;

class PayPalController extends Controller
{
    private $client;

    public function __construct()
    {
        $paypalData = StripeKey::where('subdomain', Setting::subdomain())
            ->where('method', 'paypal')
            ->first();

        $environment = new SandboxEnvironment(
            $paypalData->stripe_key,
            $paypalData->stripe_secret
        );

        $this->client = new PayPalHttpClient($environment);
    }

    public function paypalPost(Request $request)
    {
        $credit = CreditAmount::find($request->id);
        $user = auth()->user();
        $currencyConvert1 = \Acelle\Jobs\HelperJob::setcurrency($credit->currency, $credit->credit_amount);
        $currencyConvert = \Acelle\Jobs\HelperJob::convertusd(number_format($currencyConvert1['convert'], 2));
        
        if (((int)number_format($currencyConvert['convert'], 2)) < 1) {
            Session::flash('danger', 'Amount must be greater than $1');
            return redirect('service-provider/buy-credits');
        }

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => number_format($currencyConvert['convert'], 2)
                ]
            ]],
            "application_context" => [
                 "cancel_url" => url('service-provider/paypal/status?status=cancel&id=' . $credit->id),
                 "return_url" => url('service-provider/paypal/status?status=success&id=' . $credit->id),
            ]
        ];

        try {
            $response = $this->client->execute($request);
            return redirect()->away($response->result->links[1]->href);
        } catch (HttpException $ex) {
            return redirect()->route('home')->with('error', 'Something went wrong');
        }
    }

    public function getPaymentStatus(Request $request)
    {
        if ($request->input('status') == 'cancel') {
            return redirect()->route('home')->with('error', 'Payment cancelled');
        }

        $orderId = $request->query('token');
        $captureRequest = new OrdersCaptureRequest($orderId);

        try {
            $response = $this->client->execute($captureRequest);

            if ($response->result->status == 'COMPLETED') {
                $user = Auth::user();
                $credit = CreditAmount::find($request->input('id'));
                $currencyConvert1 = \Acelle\Jobs\HelperJob::setcurrency($credit->currency, $credit->credit_amount);
                $currencyConvert = \Acelle\Jobs\HelperJob::convertusd(number_format($currencyConvert1['convert'], 2));

                // Update user credits
                $totalCredits = $user->credits + (int)$credit->credit;
                $user->credits = $totalCredits;
                $user->save();

                // Record the payment
                $paymentDone = new BuyCreadit;
                $paymentDone->payment_id = $response->result->id;
                $paymentDone->amount = number_format($currencyConvert['convert'], 2);
                $paymentDone->user_id = $user->id;
                $paymentDone->subdomain = Setting::subdomain();
                $paymentDone->creadits = $credit->credit;
                $paymentDone->method = 'PayPal';
                $paymentDone->save();

                Session::flash('success', 'Your transaction completed successfully!');
                return redirect('service-provider/buy-credits');
            }
        } catch (HttpException $ex) {
            return redirect('service-provider/buy-credits')->with('error', 'Payment failed');
        }

        return redirect('service-provider/buy-credits')->with('error', 'Payment failed');
    }
}
