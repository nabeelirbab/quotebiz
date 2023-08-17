<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Setting;
use Acelle\Model\Support;
use Acelle\Model\SupportChat;
use Acelle\Model\SupportImage;
use Auth;

class SupportController extends Controller
{
    public function adminsupport(){
        $supports = Support::where('subdomain',Setting::subdomain())->orderBy('id','desc')->paginate(12);
        return view('support',compact('supports'));
    }

    public function servicesupport(){
        $supports = Support::where('user_id',Auth::user()->id)->where('subdomain',Setting::subdomain())->orderBy('id','desc')->paginate(12);
        return view('service_provider.support',compact('supports'));
    }
	public function customersupport(){
		$supports = Support::where('user_id',Auth::user()->id)->where('subdomain',Setting::subdomain())->orderBy('id','desc')->paginate(12);
        return view('customer.support',compact('supports'));
	}

    public function getTickets(){
    	$supports = Support::with('supportchat','supportchat.supportchatimg','supportuser')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
    	return $supports;
    }

    public function adminTickets(){
        $supports = Support::with('supportchat','supportchat.supportchatimg','supportuser')->where('subdomain',Setting::subdomain())->orderBy('id','desc')->get();
        return $supports;
    }
    
    public function addsupport(Request $request){
    	$support = new Support;
    	$support->user_id = Auth::user()->id; 
    	$support->subdomain = Setting::subdomain(); 
    	$support->type = $request->input('type'); 
    	$support->category = $request->input('category'); 
    	$support->priority = $request->input('priority'); 
    	$support->subject = $request->input('subject'); 
    	$support->message = $request->input('message'); 
    	$support->save();

        $chat_support = new SupportChat;
        $chat_support->support_id = $support->id;
        $chat_support->subdomain = Setting::subdomain();
        $chat_support->message = $request->input('message');
        $chat_support->save();

    	if($request->file('file')){

    	     $imageArray = $request->file('file');
    	     foreach ($imageArray as $key => $image) {
	             $chat = new SupportImage;
	             $imageType = $image->getClientMimeType();
	             if($imageType == 'image/avif' || $imageType == 'image/bmp' || $imageType == 'image/gif' || $imageType == 'image/jpeg' || $imageType == 'image/jpg' || $imageType == 'image/png' || $imageType == 'image/svg+xml' || $imageType == 'image/webp'){

	                $chat->fileType = '0';
	              
	             }elseif($imageType == 'video/3gpp' || $imageType == 'video/mp4' || $imageType == 'video/mpeg' || $imageType == 'video/ogg' || $imageType == 'video/webm'){

	                $chat->fileType = '1';

	             }else{

	                $chat->fileType = '2';

	             }
	             $imageName = time().$image->getClientOriginalName();
	             $destination ='/frontend-assets/images/chat';
	             $image->move(public_path($destination), $imageName);
			      $chat->support_chat_id = $chat_support->id;
			      $chat->support_id = $support->id;
			      $chat->user_id = Auth::user()->id;
			      $chat->subdomain = Setting::subdomain();
			      $chat->file = $imageName;
		          $chat->save();
         }
      }
      return redirect('customer/support');
    }

    public function storechat(Request $request){
        // dd($request->file('files'));
        $chat_support = new SupportChat;
        $chat_support->support_id = $request->input('support_id');
        $chat_support->subdomain = Setting::subdomain();
        $chat_support->message = $request->input('message');
        $chat_support->message_belong = $request->input('message_belong');
        $chat_support->save();

        if($request->file('files')){

             $imageArray = $request->file('files');
             foreach ($imageArray as $key => $image) {
                 $chat = new SupportImage;
                 $imageType = $image->getClientMimeType();
                 if($imageType == 'image/avif' || $imageType == 'image/bmp' || $imageType == 'image/gif' || $imageType == 'image/jpeg' || $imageType == 'image/jpg' || $imageType == 'image/png' || $imageType == 'image/svg+xml' || $imageType == 'image/webp'){

                    $chat->fileType = '0';
                  
                 }elseif($imageType == 'video/3gpp' || $imageType == 'video/mp4' || $imageType == 'video/mpeg' || $imageType == 'video/ogg' || $imageType == 'video/webm'){

                    $chat->fileType = '1';

                 }else{

                    $chat->fileType = '2';

                 }
                 $imageName = time().$image->getClientOriginalName();
                 $destination ='/frontend-assets/images/chat';
                 $image->move(public_path($destination), $imageName);
                  $chat->support_chat_id = $chat_support->id;
                  $chat->support_id = $request->input('support_id');
                  $chat->user_id = Auth::user()->id;
                  $chat->subdomain = Setting::subdomain();
                  $chat->file = $imageName;
                  $chat->save();
         }
      }
      $retunchat = SupportChat::with('supportchatimg')->where('id',$chat_support->id)->first();
      return $retunchat;
    }
}
