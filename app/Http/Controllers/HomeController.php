<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Subscription;
use Acelle\Model\Quote;
use Acelle\Model\User;
use Acelle\Model\BuyCreadit;
use Auth;
use Session;
use Redirect;

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
      $customerCount = User::where('user_type','client')->where('subdomain',request('account'))->count();
      $providerCount = User::where('user_type','service_provider')->where('subdomain',request('account'))->count();
      $quoteCount =  Quote::where('admin_id',request('account'))->count();
      $quotes =  Quote::where('admin_id',request('account'))->orderBy('created_at','desc')->limit(5)->get();
      $totalRevenue =  BuyCreadit::where('subdomain',request('account'))->sum('amount');
        return view('dashboard', [
            'customerCount' => $customerCount,
            'providerCount' => $providerCount,
            'quoteCount' => $quoteCount,
            'quotes' => $quotes,
            'totalRevenue' => $totalRevenue,
        ]);
    }
   
   public function home(){

     return view('index');
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
    
    public function provider_detail($account, $id){
       $userdetail = User::where('subdomain',Auth::user()->subdomain)->where('id',$id)->first();
       return view('provider_profile',compact('userdetail'));
    }

    public function customer_detail($account, $id){
       $userdetail = User::where('subdomain',Auth::user()->subdomain)->where('id',$id)->first();
       return view('customer_profile',compact('userdetail'));
    }

    public function accountstatus(Request $request,$account,$id){
       $update = User::where('id',$id)->update(['activated' => $request->get('status')]);
        Session::flash('success', 'Account status change successfully!!');
       return Redirect::back();
    }
    public function servicecategories(){
         
        return view('servicecategories');
    }

    public function supportchat(){
        return view('supportchat');
    }
}
