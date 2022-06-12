<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Library\Log as MailLog;
use Acelle\Model\Customer;
use Acelle\Model\User;
use Acelle\Model\Subdomain;
use Acelle\Model\StripeKey;
use Acelle\Model\Creadit;
use Acelle\Model\CreditAmount;
use Acelle\Model\BuyCreadit;
use Acelle\Model\DateFormet;
use Acelle\Library\Facades\Hook;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Log in back user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function loginBack(Request $request)
    {
        $id = \Session::pull('orig_user_id');
        $orig_user = User::findByUid($id);

        \Auth::login($orig_user);

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Activate user account.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, $account, $token)
    {
        $userActivation = \Acelle\Model\UserActivation::where('token', '=', $token)->first();
        // dd($token);

        if (!$userActivation) {
            return view('notAuthorized');
        } else {
            $userActivation->user->setActivated();
            if($userActivation->user->user_type == 'service_provider' || $userActivation->user->user_type == 'client'){
                 return redirect('/users/login');
            }
            // Execute registered hooks
            Hook::execute('customer_added', [$userActivation->user->customer]);

            $request->session()->put('user-activated', trans('messages.user.activated'));

            if (isset($request->redirect)) {
                return redirect()->away(urldecode($request->redirect));
            } else {
                return redirect('/');
            }
        }
    }

    public function adminActivate(Request $request, $token)
    {
        $userActivation = \Acelle\Model\UserActivation::where('token', '=', $token)->first();
        // dd($token);

        if (!$userActivation) {
            return view('notAuthorized');
        } else {
            $userActivation->user->setActivated();
           
            // Execute registered hooks
            Hook::execute('customer_added', [$userActivation->user->customer]);

            $request->session()->put('user-activated', trans('messages.user.activated'));

            if (isset($request->redirect)) {
                return redirect()->away(urldecode($request->redirect));
            } else {
                $url = 'http://'.$userActivation->user->subdomain.'.'.str_replace('http://','', url('/login'));
                // dd($url);
                return redirect()->away($url);
            }
        }
    }

    /**
     * Resen activation confirmation email.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resendActivationEmail(Request $request)
    {
        $user = User::findByUid($request->uid);

        try {
            $user->sendActivationMail($user->email, action('HomeController@index'));
        } catch (\Exception $e) {
            return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service').': '.$e->getMessage() ]);
        }

        return view('users.registration_confirmation_sent');
    }

    public function resendAdminActivationEmail(Request $request)
    {
        $user = User::findByUid($request->uid);

        try {
            $user->sendActivationMail($user->email, action('HomeController@index'));
        } catch (\Exception $e) {
            return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service').': '.$e->getMessage() ]);
        }

        return view('users.registration_confirmation_sent');
    }


 public function login(Request $request)
    {


        if (\Acelle\Model\Setting::get('enable_user_registration') == 'no') {
            return $this->notAuthorized();
        }

        // If already logged in
        if (!is_null($request->user())) {

            if($request->user()->user_type == 'client'){

             return redirect('/customer');

            }else{
             return redirect('/service-provider');
            }
        }

        // Initiate customer object for filling the form
        $customer = Customer::newCustomer();

        $user = new User();
        if (!empty($request->old())) {
            $customer->fill($request->old());
            $user->fill($request->old());
        }

      if($request->isMethod('post')){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'subdomain' => $request->subdomain]))
        {

        if(Auth::check()){
            $user = Auth::user();
          if (!$user->activated) {
            $uid = $user->uid;
            auth()->logout();
            return view('notActivated', ['uid' => $uid]);
                }
           
                if($user->can("service_access", User::class)){
                     User::where('id',$user->id)->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                    return redirect('/service-provider');
                }

                if($user->can("client_access", User::class)){
                     User::where('id',$user->id)->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                    return redirect('/customer');
                }
                else{
                    return redirect('/');
                }
                
                }
            }
            else
            {
                return back()->with('message','These credentials do not match our records.
');
            }
        }

     return view('users.b_login', [
            'customer' => $customer,
            'user' => $user,
        ]);
    }

    /**
     * User registration.
     */
    public function register(Request $request)
    {


        if (\Acelle\Model\Setting::get('enable_user_registration') == 'no') {
            return $this->notAuthorized();
        }

        // If already logged in
        if (!is_null($request->user())) {

            if($request->user()->user_type == 'client'){

             return redirect('/customer');

            }else{
             return redirect('/service-provider');
            }
        }

        // Initiate customer object for filling the form
        // $customer = Customer::newCustomer();

        $user = new User();
        // if (!empty($request->old())) {
        //     $customer->fill($request->old());
        //     $user->fill($request->old());
        // }

        // save posted data
        if ($request->isMethod('post')) {
            $user->fill($request->all());
            
                $rules = $user->registerRules2();
            

            // Captcha check
            if (\Acelle\Model\Setting::get('registration_recaptcha') == 'yes') {
                $success = \Acelle\Library\Tool::checkReCaptcha($request);
                if (!$success) {
                    $rules['recaptcha_invalid'] = 'required';
                }
            }

 
            $this->validate($request, $rules);

           
                $user = new User();
                $user->fill($request->all());
                $user->password = bcrypt($request->password);
                $user->city = $request->city;
                $user->zipcode = $request->zipcode;
                $user->timezone = $request->timezone;
                $user->language_id = $request->language_id;
                $user->save();

            

            // user email verification
            if (true) {
                // Send registration confirmation email
                try {
                    $user->sendActivationMail($user->displayName());
                } catch (\Exception $e) {
                    return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service') . ": " . $e->getMessage()]);
                }

                return view('users.register_confirmation_notice');

            // no email verification
            } else {
                $user->setActivated();
                return redirect()->route('users/login');
            }
        }

        return view('users.register', [
            // 'customer' => $customer,
            'user' => $user,
        ]);
    }

public function adminregister(Request $request)
    {


        if (\Acelle\Model\Setting::get('enable_user_registration') == 'no') {
            return $this->notAuthorized();
        }

        // If already logged in
        if (!is_null($request->user())) {
            return redirect('/');
        }

        // Initiate customer object for filling the form
        $customer = Customer::newCustomer();

        $user = new User();
        if (!empty($request->old())) {
            $customer->fill($request->old());
            $user->fill($request->old());
        }

        // save posted data
        if ($request->isMethod('post')) {
            $user->fill($request->all());
           
                $rules = $user->registerRules();
            

            // Captcha check
            if (\Acelle\Model\Setting::get('registration_recaptcha') == 'yes') {
                $success = \Acelle\Library\Tool::checkReCaptcha($request);
                if (!$success) {
                    $rules['recaptcha_invalid'] = 'required';
                }
            }

 
            $this->validate($request, $rules);

            // Okay, create it
           
                $user = $customer->createAccountAndUser($request);

                $subdomain = new Subdomain;
                $subdomain->user_id =  $user->id;
                $subdomain->subdomain = $request->subdomain;
                $subdomain->save();


            // user email verification
            if (true) {
                // Send registration confirmation email
                try {
                    $user->sendAdminActivationMail($user->displayName());
                } catch (\Exception $e) {
                    return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service') . ": " . $e->getMessage()]);
                }

                return view('users.register_confirmation_notice');

            // no email verification
            } else {
                $user->setActivated();
                return redirect()->route('login');
            }
        }

        return view('users.adminregister', [
            'customer' => $customer,
            'user' => $user,
        ]);
    }

    public function paymentsReceive(Request $request)
    {

      $payments = BuyCreadit::with('users')->where('subdomain',Auth::user()->subdomain)->orderBy('id','desc')->paginate(10);
      return view('paymenthistory',compact('payments'));

    }
    public function credits(Request $request)
    {

      if ($request->isMethod('post')) {
        if($request->id){
            $update = CreditAmount::find($request->id);
            $update->credit = $request->credit;
            $update->credit_amount = $request->credit_amount;
            $update->update();
            return redirect()->back()->with('success', 'Update Successfully'); 
        }else{

            $credit = new CreditAmount;
            $credit->credit_amount = $request->credit_amount;
            $credit->credit = $request->credit;
            $credit->subdomain = request('account');
            $credit->save();
        }
      }

      $credits = CreditAmount::where('subdomain',request('account'))->orderBy('id','desc')->paginate(15);
      return view('creditamount',compact('credits'));

    }

    public function deletecredit($account, $id){

        $delete = CreditAmount::where('id',$id)->delete();

        return redirect()->back()->with('success', 'Delete Successfully'); 
    }

    public function dateformet(Request $request){
      $formet = DateFormet::where('subdomain',request('account'))->first();
       if($request->isMethod('post')){
      $data = explode('-', $request->dateformet);
        if($formet){
            $formet->type = $data[0];
            $formet->date_formet = $data[1];
            $formet->update();
        }else{
            $formet = new DateFormet;
            $formet->subdomain = request('account');
            $formet->type = $data[0];
            $formet->date_formet = $data[1];
            $formet->save();
            // dd($formet);
        }
            
       }
        return view('dateformet',compact('formet'));
    }

    public function logout(){

      Auth::logout();
      return redirect('users/login');
    }
}