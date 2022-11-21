<?php

namespace Acelle\Http\Controllers\Auth;

use Acelle\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Acelle\Model\Setting;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(\Illuminate\Http\Request $request)
    {
        $rules = [
            $this->username() => 'required',
            'password' => 'required'
        ];

        if (Setting::isYes('login_recaptcha') && !Setting::isYes('theme.beta')) {
            if (!\Acelle\Library\Tool::checkReCaptcha($request)) {
                $rules['recaptcha_invalid'] = 'required';
            }
        }

        $this->validate($request, $rules);
    }

    protected function credentials(Request $request)
    {

        return array_merge($request->only($this->username(), 'password'), ['user_type' => 'admin', 'subdomain' => $request->subdomain]);
        
    }

    public function authenticated($request, $user)
    {
        // If user is not activated
        // dd(request("account"));
        // dd($user);
        if (!$user->activated) {
            $uid = $user->uid;
            auth()->logout();
            return view('notActivated', ['uid' => $uid]);
        }

        if($user->can("service_access", User::class)){
            return redirect('/not-authorized');
        }

        if($user->can("client_access", User::class)){
            return redirect('/not-authorized');
        }

        if($user->can("admin_access", User::class)){
            return redirect('/super-admin');
        }

        return redirect()->intended('/admin');
    }
}
