<?php

namespace Acelle\Http\Controllers\Auth;

use Acelle\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use Acelle\Model\User; 
use Acelle\Model\Setting;
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Acelle\Notifications\ResetPassword;
use Acelle\Library\Log as MailLog;
use Acelle\Library\ExtendedSwiftMessage;
use App;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function showForgetPasswordForm()
      {
         return view('auth.passwords.email');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'subdomain' => Setting::subdomain(), 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
            $resetPasswordUrl = url('reset-password', $token);
            $htmlContent = '<p>Please click the link below to reset your password:<br><a href="'.$resetPasswordUrl.'">'.$resetPasswordUrl.'</a>';

            // build the message
            $message = new ExtendedSwiftMessage();
            $message->setEncoder(new \Swift_Mime_ContentEncoder_PlainContentEncoder('8bit'));
            $message->setContentType('text/html; charset=utf-8');

            $message->setSubject('Password Reset');
            $message->setTo($request->email);
            $message->setReplyTo(Setting::get('mail.reply_to'));
            $message->addPart($htmlContent, 'text/html');

            $mailer = App::make('xmailer');
            $result = $mailer->sendWithDefaultFromAddress($message);

            if (array_key_exists('error', $result)) {
                throw new \Exception($result['error']);
            }
      
          return back()->with('status', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($account, $token) { 
         return view('auth.passwords.reset', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'subdomain' => Setting::subdomain(), 
                                'token' => $request->token
                              ])
                              ->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)->where('subdomain',Setting::subdomain())
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/users/login')->with('status', 'Your password has been changed!');
      }
}
