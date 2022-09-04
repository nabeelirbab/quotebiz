<?php

namespace Acelle\Http\Controllers\Customer;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Model\Quote;
use Acelle\Model\User;
use Acelle\Model\QuotationStatus;
use Acelle\Mail\ChangeJobStatus;
use Mail;
use Auth;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::where('user_id',Auth::user()->id)->first();
        // dd($quotes);
        // dd($quotes->questions[0]->choice[0]->choice);
          return view('customer.myresponses',compact('quotes'));
    }

    public function myquotes(){

        $myrequests = Quote::with('quotations')->where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        // dd($myrequests[0]->quotations);
        return view('customer.myquotes',compact('myrequests'));

    }

    public function changeStatus(Request $request){
       
       $quote = Quote::find($request->quote_id);
       $quote->status = $request->status;
       $quote->save();
        // updateOrCreate
       $status = QuotationStatus::where('quote_id',$request->quote_id)->where('user_id',$request->provider_id)->first();
       if($status){

           $status->status = $request->status;
           $status->save();

       }else{

           $status = new QuotationStatus;
           $status->quotation_id = $request->quotation_id;
           $status->quote_id = $request->quote_id;
           $status->status = $request->status;
           $status->user_id = $request->provider_id;
           $status->save();

       }
       
       $user = User::where('id',$request->provider_id)->first();
       if($request->status == 'won'){

          $jobdata = [
             'user' => $user,
             'subject' => 'Congratulation You Won Job'
          ];

        Mail::to($user->email)->send(new ChangeJobStatus($jobdata));
       }
       
       return $status;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        
       $user = User::find(Auth::user()->id);
       $user->first_name = $request->first_name;
       $user->last_name = $request->last_name;
       $user->mobileno = $request->mobileno;
       $user->city = $request->city;
       $user->zipcode = $request->zipcode;
       $user->save();

       return redirect()->back()->with('success', 'Profile Update Successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
