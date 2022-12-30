<?php

namespace Acelle\Http\Controllers\Customer;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Model\StripePayment;
use Acelle\Model\Setting;
use Session;
use Stripe;

    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripePayment');
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
    	$stripeData = StripePayment::where('subdomain',Setting::subdomain())->first();
        Stripe\Stripe::setApiKey($stripeData->stripe_secret);
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose quotebiz.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
