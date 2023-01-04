<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\StripeKey;
use Acelle\Model\Setting;
use Auth;

class StripeController extends Controller
{
    public function stripeKey(Request $request){

      $stripeData = StripeKey::where('subdomain',Setting::subdomain())->first();
       if($request->isMethod('post')){
       	if($stripeData){
             $stripeData->stripe_key = $request->stripe_key;
        	$stripeData->stripe_secret = $request->stripe_secret;
        	$stripeData->update();
       	}else{
       		$stripeData = new StripeKey;
        	$stripeData->user_id = Auth::user()->id;
          $stripeData->subdomain = Setting::subdomain();
        	$stripeData->stripe_key = $request->stripe_key;
        	$stripeData->stripe_secret = $request->stripe_secret;
        	$stripeData->save();
        	// dd($stripeData);
       	}
        	
       }
    	return view('stripekey',compact('stripeData'));
    }
}
