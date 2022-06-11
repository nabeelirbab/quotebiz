<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Subscription;
use Acelle\Model\Quote;
use Acelle\Model\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        event(new \Acelle\Events\UserUpdated($request->user()->customer));

        // Last month
        $customer = $request->user()->customer;
        $sendingCreditsUsed = $customer->activeSubscription()->getCreditsUsedDuringPlanCycle('send'); // all time sending credits used
        $sendingCreditsLimit = $customer->activeSubscription()->getCreditsLimit('send');
        $sendingCreditsUsedPercentage = $customer->activeSubscription()->getCreditsUsedPercentageDuringPlanCycle('send');

        return view('dashboard', [
            'sendingCreditsUsed' => $sendingCreditsUsed,
            'sendingCreditsUsedPercentage' => $sendingCreditsUsedPercentage,
            'sendingCreditsLimit' => $sendingCreditsLimit,
        ]);
    }

    public function quotes(){

        $quotes = Quote::with('quotations','user')->orderBy('id','desc')->paginate(7);
        // dd($quotes);
        return view('quotes',compact('quotes'));
    }

    public function support(){
        return view('support');
    }

    public function customers(){
        $users = User::where('subdomain',Auth::user()->subdomain)->where('user_type','client')->paginate(10);
        // dd($users);
        return view('customers',compact('users'));
    }

    public function serviceproviders(){
        $users = User::where('subdomain',Auth::user()->subdomain)->where('id','<>',Auth::user()->id)->where('user_type','service_provider')->paginate(10);
        return view('serviceproviders',compact('users'));
    }

    public function servicecategories(){
         
        return view('servicecategories');
    }

    public function supportchat(){
        return view('supportchat');
    }
}
