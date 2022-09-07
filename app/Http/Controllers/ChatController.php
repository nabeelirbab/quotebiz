<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Chat;
use Acelle\Model\User;
use Acelle\Model\Quotation;
use Auth;
use Carbon\Carbon;
use Acelle\Mail\SendQuotation;
use Acelle\Mail\ReceiveQuotation;
use Mail;
use File;
use Notification;
use Acelle\Notifications\SendPushNotification;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function storequotation(Request $request)
    {

        $quote = new Quotation;
        $quote->user_id = Auth::user()->id;
        $quote->customer_id = $request->customer_id;
        $quote->quote_id = $request->quote_id;
        $quote->comment = $request->comment;
        $quote->quote_price = $request->quote_price;
        $quote->subdomain = request('account');
        $quote->save();
        $quote->load(['quote.myquotation']);
        
        $message = new Chat;
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request->customer_id;
        $message->quote_id = $request->quote_id;
        $message->quotation_id = $quote->id;
        $message->message = $request->comment;
        $message->messageStart = '1';
        $message->subdomain = request('account');
        $message->save();

        $total = Auth::user()->credits - $request->credit_cost;
        $user = User::find(Auth::user()->id);
        $user->credits = $total;
        $user->save();

        $receiver = User::find($request->customer_id);

        $quotedata = [
           'user' => $receiver,
           'subject' => 'Quotation Receive'
        ];

        $jobdata = [
           'user' => $user,
           'subject' => 'Quotation Send'
        ];

        Mail::to($receiver->email)->send(new ReceiveQuotation($quotedata));
        Mail::to($user->email)->send(new SendQuotation($jobdata));

        return response()->json($quote, 200);
    }

    public function getCustomerfriend(){

    $sp = Quotation::with('chatcustomer','chat.user','chat','quote.category','quote.questionsget','quote.questionsget.questions','quote.questionsget.choice','quotestatus')->where('subdomain',request('account'))->where('user_id',Auth::user()->id)->withCount("unread_msg")->get();
        return $sp;
    }

    public function getProviderfriend(){

        $sp = Quotation::with('chatsp','chat.user','chat','quote.category','quote.questionsget','quote.questionsget.questions','quote.questionsget.choice')->withCount("unread_msg")->where('subdomain',request('account'))->where('customer_id',Auth::user()->id)->get();
        return $sp;
    }

    public function chatStart(Request $request){
          
           $receiverUser = User::find($request->receiver_id)->chatWithRefId;
           $quote = Quotation::find($request->quotation_id);
           $quote->updated_by_msg = Carbon::now();
           $quote->last_msg = $request->message;
           $quote->save();

           $chat = new Chat;
           $chat->sender_id = (int)$request->sender_id;
           $chat->receiver_id = (int)$request->receiver_id;
           $chat->message = $request->message;
           $chat->messageType = $request->messageType;
           $chat->quote_id = (int)$request->quote_id;
           $chat->messageStart = '0';
           $chat->isDeleted = '0';
           $chat->quotation_id = $request->quotation_id;
           $chat->subdomain = request('account');
           if($receiverUser == $request->sender_id){
             $chat->read_at = Carbon::now();
           }else{
            $fcmTokens = User::where('id',$request->receiver_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            Notification::send(null,new SendPushNotification(\Acelle\Model\Setting::get("site_name"),$request->message,$fcmTokens));
           }
           $chat->save();
           $chat->load(['user']);
           

           return $chat;
    }

    public function chatFilesShare(Request $request){

           $receiverUser = User::find($request->receiver_id)->chatWithRefId;
           
           $chat = new Chat;
           $chat->sender_id = (int)$request->sender_id;
           $chat->receiver_id = (int)$request->receiver_id;
           $chat->quote_id = (int)$request->quote_id;
           $chat->isDeleted = '0';
           $chat->messageStart = '0';
           $chat->quotation_id = (int)$request->quotation_id;
           $chat->subdomain = request('account');

           if($receiverUser == $request->sender_id){
             $chat->read_at = Carbon::now();
           }
             $image = $request->file('file');
             $imageType = $image->getClientMimeType();
             if($imageType == 'image/avif' || $imageType == 'image/bmp' || $imageType == 'image/gif' || $imageType == 'image/jpeg' || $imageType == 'image/jpg' || $imageType == 'image/png' || $imageType == 'image/svg+xml' || $imageType == 'image/webp'){

                $chat->messageType = '1';
              
             }elseif($imageType == 'video/3gpp' || $imageType == 'video/mp4' || $imageType == 'video/mpeg' || $imageType == 'video/ogg' || $imageType == 'video/webm'){

                $chat->messageType = '2';

             }else{

                $chat->messageType = '3';

             }
             $imageName = time().$image->getClientOriginalName();
             $destination ='/frontend-assets/images/chat';
             $image->move(public_path($destination), $imageName);

             $chat->message = $imageName;
             $chat->save();
             $chat->load(['user']);
             
             $quote = Quotation::find($request->quotation_id);
             $quote->updated_by_msg = Carbon::now();
             $quote->last_msg = $imageName;
             $quote->save();

             return $chat;
    }

    public function deleteMsg($account,$id){

            $delete = Chat::find($id);
            if($delete->messageType != '0'){
                $image_path = public_path('/frontend-assets/images/chat/'.$delete->message);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $delete->isDeleted = '1';
            $delete->save();
            return $delete;
    }

    public function updateMsg(Request $request){
 
            
            $update = Chat::find($request->id);
            $update->message = $request->message;
            $update->update();
            return $update;
    }

    public function readMsg(Request $request){
            
            User::where('id',$request->receiver_id)->update(['chatWithRefId' => $request->user_id]);
            $update = Chat::where('quotation_id',$request->id)->where('receiver_id',$request->receiver_id)->update(['read_at' => Carbon::now()]);
            
            return $update;
    }

    public function allunreadMsg($account, $id){

        return Chat::where('receiver_id',$id)->whereNull('read_at')->count();
    }

    public function emptyRefId(Request $request){
            
          return  User::where('id',$request->id)->update(['chatWithRefId' => null]);
             
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
