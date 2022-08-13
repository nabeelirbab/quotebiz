<?php

namespace Acelle\Http\Controllers\ServiceProvider;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Model\StripeKey;
use Acelle\Model\Creadit;
use Acelle\Model\User;
use Acelle\Model\CreditAmount;
use Acelle\Model\BuyCreadit;
use Session;
use Stripe;
use Auth;

    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function paymenthistory(){
      $histories = Auth::user()->creadits()->paginate(10);
      return view('service_provider.paymenthistory',compact('histories'));
    }

    public function stripePayment(Request $request)
    {

        $creadit = CreditAmount::find($request->id);

        return view('service_provider.stripePayment',compact('creadit'));
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
    	$creadit = CreditAmount::find($request->id);
      $user = auth()->user();
      $currencyConvert = Acelle\Jobs\HelperJob::setcurrency($creadit->currency,$creadit->credit_amount);
    	// dd((int)$creadit->amount * 100);
    	$stripeData = StripeKey::where('subdomain',request('account'))->first();
        Stripe\Stripe::setApiKey($stripeData->stripe_secret);
        $customer = \Stripe\Customer::create([
        'email' => $user->email,
        'name' => $user->first_name.' '.$user->last_name,
        'description' => "quotebiz.com platform's user",
    ]);
        $payment = Stripe\Charge::create([
                "amount" => (int)number_format($currencyConvert['convert'], 2) * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose quotebiz.com"
        ]);
        // dd($payment->status);
        if($payment->status == "succeeded"){
          $total = Auth::user()->credits + (int)$creadit->credit;
          $user = User::find(Auth::user()->id);
          $user->credits = $total;
          $user->save();

          $paymentDone = new BuyCreadit;
          $paymentDone->payment_id = $payment->id;
          $paymentDone->amount = $creadit->credit_amount;
          $paymentDone->user_id = Auth::user()->id;
          $paymentDone->subdomain = request('account');
          $paymentDone->creadits = $creadit->credit;
          $paymentDone->save();
          

        }
        Session::flash('success', 'Your transection complete successfully!!');
           
        return redirect('service-provider/buy-creadits');
    }

}
