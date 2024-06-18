<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as LaravelLog;
use Acelle\Library\Facades\Billing;
use Acelle\Model\StripeKey;
use Acelle\Model\Setting;
use Acelle\Model\AdminCurrency;
use Auth;
use Acelle\Model\User;

class AccountController extends Controller
{
    /**
     * Update user profile.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function profile(Request $request)
    {

        // Get current user
        $user = $request->user();
        $customer = $user->customer;
        $customer->getColorScheme();

        // Authorize
        if (!$request->user()->customer->can('profile', $customer)) {
            return $this->notAuthorized();
        }

        // Save posted data
        if ($request->isMethod('post')) {
            // dd($request->all());
            $this->validate($request, $user->rulesupdate());

            // Update user account for customer
            $user->fill($request->all());
            // Update password
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // Save current user info
            $customer->fill($request->all());

            // Upload and save image
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    // Remove old images
                    $user->uploadProfileImage($request->file('image'));
                }
            }

            // Remove image
            if ($request->_remove_image == 'true') {
                $user->removeProfileImage();
            }

            if ($customer->save()) {
                $request->session()->flash('alert-success', trans('messages.profile.updated'));
            }
        }

        if (!empty($request->old())) {
            $customer->fill($request->old());
            // User info
            $customer->user->fill($request->old());
        }

        return view('account.profile', [
            'customer' => $customer,
            'user' => $request->user(),
        ]);
    }

    /**
     * Update customer contact information.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function contact(Request $request)
    {
        // Get current user
        $customer = $request->user()->customer;
        $contact = $customer->getContact();

        // Create new company if null
        if (!is_object($contact)) {
            $contact = new \Acelle\Model\Contact();
        }

        // save posted data
        if ($request->isMethod('post')) {
            // Prenvent save from demo mod
            if ($this->isDemoMode()) {
                return view('somethingWentWrong', ['message' => trans('messages.operation_not_allowed_in_demo')]);
            }

            $this->validate($request, \Acelle\Model\Contact::$rules);

            $contact->fill($request->all());

            // Save current user info
            if ($contact->save()) {
                if (is_object($contact)) {
                    $customer->contact_id = $contact->id;
                    $customer->save();
                }
                $request->session()->flash('alert-success', trans('messages.customer_contact.updated'));
            }
        }

        return view('account.contact', [
            'customer' => $customer,
            'contact' => $contact->fill($request->old()),
        ]);
    }

    /**
     * User logs.
     */
    public function logs(Request $request)
    {
        $logs = $request->user()->customer->logs;

        return view('account.logs', [
            'logs' => $logs,
        ]);
    }

    /**
     * Logs list.
     */
    public function logsListing(Request $request)
    {
        $logs = \Acelle\Model\Log::search($request)->paginate($request->per_page);

        return view('account.logs_listing', [
            'logs' => $logs,
        ]);
    }

    /**
     * Quta logs.
     */
    public function quotaLog(Request $request)
    {
        return view('account.quota_log');
    }

    /**
     * Quta logs 2.
     */
    public function quotaLog2(Request $request)
    {
        return view('account.quota_log_2');
    }

    /**
     * Api token.
     */
    public function api(Request $request)
    {
        $stripeData = StripeKey::where('subdomain', Setting::subdomain())->where('method','stripe')->first();
        if ($request->stripe && $request->isMethod('post')) {
            if ($stripeData) {
                $stripeData->stripe_key = $request->stripe_key;
                $stripeData->stripe_secret = $request->stripe_secret;
                $stripeData->update();
            } else {
                $stripeData = new StripeKey;
                $stripeData->user_id = Auth::user()->id;
                $stripeData->subdomain = Setting::subdomain();
                $stripeData->method = $request->method;
                $stripeData->status = 'active';
                $stripeData->stripe_key = $request->stripe_key;
                $stripeData->stripe_secret = $request->stripe_secret;
                $stripeData->save();
                // dd($stripeData);
            }

        }

        $stripeData = StripeKey::where('subdomain', Setting::subdomain())->where('method','paypal')->first();
        if ($request->paypal && $request->isMethod('post')) {
            if ($stripeData) {
                $stripeData->stripe_key = $request->stripe_key;
                $stripeData->stripe_secret = $request->stripe_secret;
                $stripeData->update();
            } else {
                $stripeData = new StripeKey;
                $stripeData->user_id = Auth::user()->id;
                $stripeData->subdomain = Setting::subdomain();
                $stripeData->method = 'paypal';
                $stripeData->status = 'active';
                $stripeData->stripe_key = $request->stripe_key;
                $stripeData->stripe_secret = $request->stripe_secret;
                $stripeData->save();
                // dd($stripeData);
            }

        }

        $currencyData = AdminCurrency::where('subdomain', Setting::subdomain())->first();

        if ($request->currency && $request->isMethod('post')) {
            // dd($request->all());
            if ($currencyData) {
                $currencyData->code = $request->code;
                $currencyData->update();
            } else {
                $currencyData = new AdminCurrency;
                $currencyData->admin_id = Auth::user()->id;
                $currencyData->subdomain = Setting::subdomain();
                $currencyData->code = $request->code;
                $currencyData->save();
            }

        }
        return view('account.api', compact('stripeData','currencyData'));

    }

    public function currency(Request $request)
    {

        $currencyData = AdminCurrency::where('subdomain', Setting::subdomain())->first();

        if ($request->isMethod('post')) {
            // dd($request->all());
            if ($currencyData) {
                $currencyData->code = $request->code;
                $currencyData->update();
            } else {
                $currencyData = new AdminCurrency;
                $currencyData->admin_id = Auth::user()->id;
                $currencyData->subdomain = Setting::subdomain();
                $currencyData->code = $request->code;
                $currencyData->save();
            }

        }

        return view('account.setcurrency', compact('currencyData'));
    }

    public function updateStatus(Request $request){
        $payment = StripeKey::where('subdomain', Setting::subdomain())->where('method',$request->method)->first();
        $payment->status = $request->status;
        $payment->update();
        return redirect()->back();
    }

    /**
     * Renew api token.
     */
    public function renewToken(Request $request)
    {
        $user = $request->user();

        $user->api_token = str_random(60);
        $user->save();

        // Redirect to my lists page
        $request->session()->flash('alert-success', trans('messages.user_api.renewed'));

        return redirect()->action('AccountController@api');
    }

    /**
     * Billing.
     */
    public function billing(Request $request)
    {
        return view('account.billing', [
            'customer' => $request->user()->customer,
            'user' => $request->user(),
        ]);
    }

    /**
     * Edit billing address.
     */
    public function editBillingAddress(Request $request)
    {
        $customer = $request->user()->customer;
        $billingAddress = $customer->getDefaultBillingAddress();

        // has no address yet
        if (!$billingAddress) {
            $billingAddress = $customer->newBillingAddress();
        }

        // copy from contacy
        if ($request->same_as_contact == 'true') {
            $billingAddress->copyFromContact();
        }

        // Save posted data
        if ($request->isMethod('post')) {
            list($validator, $billingAddress) = $billingAddress->updateAll($request);

            // redirect if fails
            if ($validator->fails()) {
                return response()->view('account.editBillingAddress', [
                    'billingAddress' => $billingAddress,
                    'errors' => $validator->errors(),
                ], 400);
            }

            $request->session()->flash('alert-success', trans('messages.billing_address.updated'));

            return;
        }

        return view('account.editBillingAddress', [
            'billingAddress' => $billingAddress,
        ]);
    }

    /**
     * Remove payment method
     */
    public function removePaymentMethod(Request $request)
    {
        $customer = $request->user()->customer;

        $customer->removePaymentMethod();
    }

    /**
     * Edit payment method
     */
    public function editPaymentMethod(Request $request)
    {
        // Save posted data
        if ($request->isMethod('post')) {
            if (!Billing::isGatewayRegistered($request->payment_method)) {
                throw new \Exception('Gateway for ' . $request->payment_method . ' is not registered!');
            }

            $gateway = Billing::getGateway($request->payment_method);

            $request->user()->customer->updatePaymentMethod([
                'method' => $request->payment_method,
            ]);

            if ($gateway->supportsAutoBilling()) {
                return redirect()->away($gateway->getAutoBillingDataUpdateUrl($request->return_url));
            }

            return redirect()->away($request->return_url);
        }

        return view('account.editPaymentMethod', [
            'redirect' => $request->redirect ? $request->redirect : url('admin/account/billing'),
        ]);
    }

    public function leftbarState(Request $request)
    {
        $request->session()->put('customer-leftbar-state', $request->state);
    }

    public function wizardColorScheme(Request $request)
    {
        $customer = $request->user()->customer;

        // Save color scheme
        if ($request->isMethod('post')) {
            $customer->color_scheme = $request->color_scheme;
            $customer->theme_mode = $request->theme_mode;
            $customer->save();

            return view('account.wizardMenuLayout');
        }

        return view('account.wizardColorScheme');
    }

    public function wizardMenuLayout(Request $request)
    {
        $customer = $request->user()->customer;

        // Save color scheme
        if ($request->isMethod('post')) {
            $customer->menu_layout = $request->menu_layout;
            $customer->save();
            return;
        }

        return view('account.wizardMenuLayout');
    }

    public function activity(Request $request)
    {
        return view('account.activity');
    }

    public function saveAutoThemeMode(Request $request)
    {
        $request->session()->put('customer-auto-theme-mode', $request->theme_mode);
    }

    public function locationsetting(Request $request)
    {
        if ($request->isMethod('post')) {

            $admin = User::find(Auth::user()->id);
            if (isset($request->type)) {
                $admin->admin_location_type = $request->type;
                $admin->save();
            }

            if ($request->type!="World Wide") {

                if (isset($request->country)) {
                    $admin->country = $request->country;
                    $admin->save();
                }

                if (isset($request->state)) {
                    $admin->state = $request->state;
                    $admin->save();
                }

                if (isset($request->city)) {
                    $admin->city = $request->city;
                    $admin->save();
                }

            }

            return redirect()->back()->with('success', 'Successfully Updated');
        }
        return view('account.locationsetting');
    }

}
