<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Library\Log as MailLog;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Acelle\Model\Customer;
use Acelle\Jobs\HelperJob;
use Acelle\Model\User;
use Acelle\Model\Subdomain;
use Acelle\Model\StripeKey;
use Acelle\Model\Creadit;
use Acelle\Model\Setting;
use Acelle\Model\CreditAmount;
use Acelle\Model\BuyCreadit;
use Acelle\Model\DateFormet;
use Acelle\Model\JobDesign;
use Acelle\Model\QuotePrice;
use Acelle\Model\Invitation;
use Acelle\Model\Category;
use Acelle\Model\SpBusiness;
use Acelle\Model\SiteSetting;
use Acelle\Model\FreeCredit;
use Acelle\Model\Subscription;
use Acelle\Library\Facades\Hook;
use Auth;
use Mail;
use Acelle\Mail\SendInvitation;
use Acelle\Exports\UsersExport;
use Acelle\Imports\UsersImport;
use Acelle\Imports\SPImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Redirect;

class UserController extends Controller
{
/**
* Log in back user.
*
* @param \Illuminate\Http\Request $request
*
* @return \Illuminate\Http\Response
*/
public function loginBack(Request $request)
{
    $id = \Session::pull('orig_user_id');
    $orig_user = User::findByUid($id);

    \Auth::login($orig_user);

    return redirect()->action('Admin\UserController@index');
}

/**
* Activate user account.
*
* @param \Illuminate\Http\Request $request
*
* @return \Illuminate\Http\Response
*/
public function activate(Request $request, $account, $token)
{
    $userActivation = \Acelle\Model\UserActivation::where('token', '=', $token)->first();
    // dd($token);

    if (!$userActivation) {
      return view('notAuthorized');
    } else {
      $userActivation->user->setActivated();
    if($userActivation->user->user_type == 'service_provider' || $userActivation->user->user_type == 'client'){
       return redirect('/users/login');
    }
    // Execute registered hooks
    Hook::execute('customer_added', [$userActivation->user->customer]);

    $request->session()->put('user-activated', trans('messages.user.activated'));

    if (isset($request->redirect)) {
        return redirect()->away(urldecode($request->redirect));
        } else {
        return redirect('/');
        }
    }
}

public function adminActivate(Request $request, $token)
{
    $userActivation = \Acelle\Model\UserActivation::where('token', '=', $token)->first();
    // dd($token);
    if (!$userActivation) {
      return view('notAuthorized');
    } else {
     $userActivation->user->setActivated();
    // Execute registered hooks
     Hook::execute('customer_added', [$userActivation->user->customer]);
     $request->session()->put('user-activated', trans('messages.user.activated'));
    if (isset($request->redirect)) {
         return redirect()->away(urldecode($request->redirect));
        } else {
         $url = 'https://'.$userActivation->user->subdomain.'.'.str_replace('https://','', url('/login'));
        // dd($url);
         return redirect()->away($url);
        }
    }
}

/**
* Resen activation confirmation email.
*
* @param \Illuminate\Http\Request $request
*
* @return \Illuminate\Http\Response
*/
public function resendActivationEmail(Request $request)
{
    $user = User::findByUid($request->uid);

    try {
    $user->sendActivationMail($user->email, url('/'));
    } catch (\Exception $e) {
    return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service').': '.$e->getMessage() ]);
    }

    return view('users.registration_confirmation_sent');
}

public function resendAdminActivationEmail(Request $request)
{
    $user = User::findByUid($request->uid);

    try {
     $user->sendActivationMail($user->email, url('/'));
    } catch (\Exception $e) {
     return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service').': '.$e->getMessage() ]);
    }
    return view('users.registration_confirmation_sent');
}


public function login(Request $request)
{
    if (\Acelle\Model\Setting::get('enable_user_registration') == 'no') {
      return $this->notAuthorized();
    }
    // If already logged in
    if (!is_null($request->user())) {

    if($request->user()->user_type == 'client'){
        return redirect('/customer');
        }else{
         return redirect('/service-provider');
        }
    }

    // Initiate customer object for filling the form
    $customer = Customer::newCustomer();

    $user = new User();
    if (!empty($request->old())) {
        $customer->fill($request->old());
        $user->fill($request->old());
    }

    if($request->isMethod('post')){
        // dd($request->all());
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'subdomain' => Setting::subdomain()]))
        {
        if(Auth::check()){
         $user = Auth::user();
        if (!$user->activated) {
            $uid = $user->uid;
            auth()->logout();
            return view('notActivated', ['uid' => $uid]);
        }
        if($user->can("service_access", User::class)){
             User::where('id',$user->id)->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
            return redirect('/service-provider');
        }

        if($user->can("client_access", User::class)){
             User::where('id',$user->id)->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
            return redirect('/customer');
        }
        else{
            return redirect('/admin');
        }

        }
     }
     else
      {
       return back()->with('message','These credentials do not match our records.');
      }
    }
    return view('users.b_login', [
    'customer' => $customer,
    'user' => $user,
    ]);
}

/**
* User registration.
*/
public function register(Request $request)
{

    if (\Acelle\Model\Setting::get('enable_user_registration') == 'no') {
        return $this->notAuthorized();
    }
    // If already logged in
    if (!is_null($request->user())) {
        if($request->user()->user_type == 'client'){
         return redirect('/customer');
        }else{
         return redirect('/service-provider');
        }
    }
    // Initiate customer object for filling the form
    // $customer = Customer::newCustomer();
     $user = new User();
    if ($request->isMethod('post')) {
        $user->fill($request->all());
        $rules = $user->registerRules2(Setting::subdomain());
    // Captcha check
    if (\Acelle\Model\Setting::get('registration_recaptcha') == 'yes') {
        $success = \Acelle\Library\Tool::checkReCaptcha($request);
        if (!$success) {
            $rules['recaptcha_invalid'] = 'required';
        }
    }
        if(count($request->category_id) == 1){
         $cate = Category::select('id')->where('id',$request->category_id[0])->orWhere('cat_parent_id',$request->category_id[0])->get();
           $category = [];
            foreach ($cate as $key => $value) {
                
                $category[] = $value->id;
            }
            
        }else{
            $category = $request->category_id;
        }
    
        $this->validate($request, $rules);
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->type = $request->business_type;
        $user->type_value = $request->state_radius;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->category_id = json_encode($category);
        $user->zipcode = $request->zipcode;
        $freeCredits = HelperJob::freeCredits();
        if($freeCredits && $freeCredits->status == 'active'){
           $user->credits = $freeCredits->credits;
        }
        if($request->invite){
            $invite = Invitation::where('subdomain',Setting::subdomain())->where('token',$request->invite)->first();
            if($invite){
               $user->credits = $invite->credits;
               Invitation::where('token',$request->invite)->update(['status' => 'active']);
            }
        }
    $user->save();
       $business = new SpBusiness;
       $business->user_id = $user->id;
       $business->business_name = $request->business_name;
       $business->save();
    // user email verification
    if (true) {
    // Send registration confirmation email
    try {
        $user->sendActivationMail($user->displayName());
    } catch (\Exception $e) {
        return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service') . ": " . $e->getMessage()]);
    }
    return view('users.register_confirmation_notice');
    // no email verification
    } else {
        $user->setActivated();
        return redirect()->route('users/login');
        }
    }
    $invite = '';
    if($request->invite){
        // dd('hello');
         $invite = Invitation::where('subdomain',Setting::subdomain())->where('token',$request->invite)->first();
    }
    return view('users.register', [
    // 'customer' => $customer,
    'user' => $user,
    'invite' => $invite
    ]);
    }

    public function subcategory($account, $id){
     $subcategories = Category::where('cat_parent_id',$id)->get();
     return view('users.subcategory',compact('subcategories'));
    }

    public function subcategory_select($account, $id){
     $subcategories = Category::where('cat_parent_id',$id)->get();
     return view('users.subcategory_select',compact('subcategories'));
    }

    public function adminregister(Request $request)
    {
        
    if (\Acelle\Model\Setting::get('enable_user_registration') == 'no') {
     return $this->notAuthorized();
    }

    // If already logged in
    if (!is_null($request->user())) {
     return redirect('/');
    }

    // Initiate customer object for filling the form
    $customer = Customer::newCustomer();

    $user = new User();
    if (!empty($request->old())) {
     $customer->fill($request->old());
     $user->fill($request->old());
    }
    // save posted data
    if ($request->isMethod('post')) {
        $user->fill($request->all());

        $rules = $user->registerRules($request->subdomain);
        // Captcha check
        if (\Acelle\Model\Setting::get('registration_recaptcha') == 'yes') {
            $success = \Acelle\Library\Tool::checkReCaptcha($request);
            if (!$success) {
                $rules['recaptcha_invalid'] = 'required';
            }
        }
        $this->validate($request, $rules);
        $user = $customer->createAccountAndUser($request);
        $subdomain = new Subdomain;
        $subdomain->user_id =  $user->id;
        $subdomain->subdomain = $request->subdomain;
        $subdomain->save();
        $today = Carbon::today();
        $subscription = new Subscription;
        $subscription->uid = uniqid();
        $subscription->status = 'active';
        $subscription->current_period_ends_at =  $today->addMonths(3);
        $subscription->started_at = Carbon::now()->toDateTimeString();
        $subscription->customer_id = $user->customer_id;
        $subscription->plan_id = 1;
        $subscription->save();
        $job_design = new JobDesign;
        $job_design->admin_id = $user->id;
        $job_design->subdomain = $request->subdomain;
        $job_design->save();
        // user email verification
    if (true) {
    // Send registration confirmation email
    try {
        $user->sendAdminActivationMail($user->displayName());
    } catch (\Exception $e) {
        return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service') . ": " . $e->getMessage()]);
    }

    return view('users.register_confirmation_notice');

    // no email verification
    } else {
    $user->setActivated();
    return redirect()->route('login');
    }
    }

    return view('users.adminregister', [
    'customer' => $customer,
    'user' => $user,
    ]);
}

public function paymentsReceive(Request $request)
{

$payments = BuyCreadit::with('users')->where('subdomain',Auth::user()->subdomain)->orderBy('id','desc')->paginate(10);

return view('paymenthistory',compact('payments'));

}

public function paymentsSearch(Request $request)
{

$searchString = $request->search;
$payments = BuyCreadit::with('users')->where('payment_id',$searchString)->where('subdomain',Auth::user()->subdomain)->orderBy('id','desc')->paginate(50);

return view('paymentsearch',compact('payments'));

}

public function credits(Request $request)
{

if ($request->isMethod('post')) {
    if($request->id){
        $update = CreditAmount::find($request->id);
        $update->credit = $request->credit;
        $update->credit_amount = $request->credit_amount;
        $update->bundel_name = $request->bundel_name;
        $update->currency = $request->currency;
        $update->update();
        return redirect()->back()->with('success', 'Update Successfully'); 
    }else{

        $credit = new CreditAmount;
        $credit->credit_amount = $request->credit_amount;
        $credit->credit = $request->credit;
        $credit->bundel_name = $request->bundel_name;
        $credit->subdomain = Setting::subdomain();
        $credit->currency = $request->currency;
        $credit->save();
      }
     }

    $credits = CreditAmount::where('subdomain',Setting::subdomain())->orderBy('credit_amount','asc')->paginate(15);
return view('creditamount',compact('credits'));

}

public function spcredits(Request $request){
     $credits = User::find($request->user_id)->credits;
     $total = $credits + $request->credits;
     User::where('id',$request->user_id)->update(['credits' => $total]);
     return redirect()->back()->with('success', 'Creadit add Successfully');   
}

public function quoteprice(Request $request){
    if($request->id){
        $quoteprice = QuotePrice::find($request->id);
        $quoteprice->type = $request->input('type');
        $quoteprice->price = $request->input('price');
        $quoteprice->save();
        return redirect()->back()->with('success', 'Update Successfully');
    }else{
        $quoteprice = new QuotePrice;
        $quoteprice->subdomain = Setting::subdomain();
        $quoteprice->type = $request->input('type');
        $quoteprice->price = $request->input('price');
        $quoteprice->save();
        return redirect()->back()->with('success', 'Add Successfully');
    }
}

public function freecredits(Request $request){
    if($request->id){
        $freecredits = FreeCredit::find($request->id);
        $freecredits->credits = $request->input('credits');
        $freecredits->price = $request->input('price');
        $freecredits->save();
        return redirect()->back()->with('success', 'Update Successfully');
    }else{
        $freecredits = new FreeCredit;
        $freecredits->subdomain = Setting::subdomain();
        $freecredits->credits = $request->input('credits');
        $freecredits->status = $request->input('status');
        $freecredits->save();
        return redirect()->back()->with('success', 'Add Successfully');
    }
}

public function deletecredit($account, $id){
    $delete = CreditAmount::where('id',$id)->delete();
    return redirect()->back()->with('success', 'Delete Successfully'); 
}

public function dateformet(Request $request){
    $formet = DateFormet::where('subdomain',Setting::subdomain())->first();
    if($request->isMethod('post')){
       $data = explode('-', $request->dateformet);
        if($formet){
            $formet->type = $data[0];
            $formet->date_formet = $data[1];
            $formet->update();
        }else{
            $formet = new DateFormet;
            $formet->subdomain = Setting::subdomain();
            $formet->type = $data[0];
            $formet->date_formet = $data[1];
            $formet->save();
            // dd($formet);
        }
    }
    return view('dateformet',compact('formet'));
}

public function formdesign(Request $request){
    if($request->isMethod('post'))
    {
        if($request->id){
          $job_design =JobDesign::find($request->id);
        }else{
          $job_design = new JobDesign;
        }

        if($request->file('backgroup_image')){
            $image = $request->file('backgroup_image');
            $new_image = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images';
            $image->move(public_path($destination),$new_image);
            $job_design->backgroup_image = $new_image;
            } 
            $job_design->admin_id = Auth::user()->id;
            $job_design->subdomain = Setting::subdomain();
            $job_design->underline_color = $request->underline_color;
            $job_design->link_color = $request->link_color;
            $job_design->category_heading = $request->category_heading;
            $job_design->title_heading = $request->title_heading;
            $job_design->titlesub_heading = $request->titlesub_heading;
            $job_design->postcode_text = $request->postcode_text;
            $job_design->button_color = $request->button_color;
            $job_design->button_text = $request->button_text;
            $job_design->font_family = $request->font_family;
            $job_design->search_box = $request->search_box;
            $job_design->login_color = $request->login_color;
            $job_design->button_text_color = $request->button_text_color;
            $job_design->agent_no = $request->agent_no;
            $job_design->position = $request->position;
            $job_design->business_no = $request->business_no;
            $job_design->no_status = $request->no_status;
            $job_design->blog_status = $request->blog_status;
            $job_design->profile_status = $request->profile_status;
        if($request->preview){
        return view('previewdesign',compact('job_design'));
     }else{
            $job_design->save();
            return redirect('/admin/page-design')->with('success', 'Design Update Successfully');
      }

    }
    return view('design.formdesign');
}

public function formlayout(Request $request){
    if($request->isMethod('post'))
    {
        if($request->id){
          $job_design =JobDesign::find($request->id);
        }else{
          $job_design = new JobDesign;
        }

        
            $job_design->admin_id = Auth::user()->id;
            $job_design->subdomain = Setting::subdomain();
            $job_design->position = $request->position;
            $job_design->blog_status = $request->blog_status;
            $job_design->profile_status = $request->profile_status;
      
            $job_design->save();
            return redirect('/admin/page-layout')->with('success', 'Design Update Successfully');
      
    }
    return view('design.formlayout');
}

public function text_change(Request $request){
    $job_design =JobDesign::where('subdomain',Setting::subdomain())->first();
    $job_design->sp_text = $request->text_value;
    $job_design->save();
}

public function socialdesign(Request $request){
    if($request->isMethod('post'))
    {

        if($request->id){
          $job_design =JobDesign::find($request->id);
        }else{
          $job_design = new JobDesign;
        }
       
        $job_design->admin_id = Auth::user()->id;
        $job_design->subdomain = Setting::subdomain();
        $job_design->facebook = $request->facebook;
        $job_design->instagram = $request->instagram;
        $job_design->linkedIn = $request->linkedIn;
        $job_design->twitter = $request->twitter;
        $job_design->whatsApp = $request->whatsApp;
        $job_design->save();
        return redirect('/admin/social')->with('success', 'Update Successfully');;

    }
    return view('design.social');
}

public function termsdesign(Request $request){
    if($request->isMethod('post'))
    {

        if($request->id){
          $job_design =JobDesign::find($request->id);
        }else{
          $job_design = new JobDesign;
        }
       
        $job_design->admin_id = Auth::user()->id;
        $job_design->subdomain = Setting::subdomain();
        $job_design->terms = $request->terms;
        $job_design->privacy_policy = $request->privacy_policy;
        $job_design->save();
        return redirect('/admin/terms')->with('success', 'Update Successfully');;

    }
    return view('design.termspolicy');
}

  public function seo(Request $request)
    {

        $sitesetting = SiteSetting::where('subdomain', Setting::subdomain())->first();
        if ($request->isMethod('post')) {
                if ($sitesetting) {
                    $sitesetting = $sitesetting;
                }
                else{
                 $sitesetting = new SiteSetting;
                }

                $sitesetting->subdomain = Setting::subdomain();
                $sitesetting->site_name = $request->site_name;
                $sitesetting->site_keyword = $request->site_keyword;
                $sitesetting->site_title = $request->site_title;
                $sitesetting->site_tagline = $request->site_tagline;
                $sitesetting->site_description = $request->site_description;
                $sitesetting->save();
            
        }

        return view('design/seo', compact('sitesetting'));
    }

  public function sitesetting(Request $request)
    {

        $sitesetting = SiteSetting::where('subdomain', Setting::subdomain())->first();
        if ($request->isMethod('post')) {
                if ($sitesetting) {
                    $sitesetting = $sitesetting;
                }
                else{
                 $sitesetting = new SiteSetting;
                }

                $sitesetting->subdomain = Setting::subdomain();
                $sitesetting->site_name = $request->site_name;
                $sitesetting->site_keyword = $request->site_keyword;
                $sitesetting->site_title = $request->site_title;
                $sitesetting->site_tagline = $request->site_tagline;
                $sitesetting->logo_width = $request->logo_width;
                $sitesetting->logo_height = $request->logo_height;
                $sitesetting->site_description = $request->site_description;

                if ($request->file('site_smalllogo')) {
                    $sitesetting->site_logo_small = $this->fileUpload($request->file('site_smalllogo'), false);
                }
                if ($request->file('site_largelogo')) {
                    $sitesetting->site_logo_big = $this->fileUpload($request->file('site_largelogo'), false);
                }
                if ($request->file('site_logo_dark')) {
                    $sitesetting->site_logo_dark = $this->fileUpload($request->file('site_logo_dark'), false);
                }
                if ($request->file('site_favicon')) {
                    $sitesetting->site_favicon = $this->fileUpload($request->file('site_favicon'), false);
                }
                $sitesetting->save();
            

        }

        return view('design/sitesetting', compact('sitesetting'));
    }

public function sendInvitation(Request $request){
    foreach ($request->email as $key => $email) {
        $code = rand();
        $maildata = [
         'credits' => $request->credits,
         'code' => $code,
         'name' => $request->name[$key]
        ];
        $invite = new Invitation;
        $invite->subdomain = Setting::subdomain();
        $invite->email = $email;
        $invite->name = $request->name[$key];
        $invite->credits = $request->credits;
        $invite->token =  $code;
        $invite->save();
        Mail::to($email)->send(new SendInvitation($maildata));
    }
    return $request->email;
}

public function resendInvitation(Request $request){

    $invite = Invitation::find($request->id);
    $code = rand();
    $maildata = [
     'credits' => $request->credits,
     'code' => $code,
     'name' => $invite->name 
    ];

    $invite->credits = $request->credits;
    $invite->token =  $code;
    $invite->save();

    Mail::to($invite->email)->send(new SendInvitation($maildata));
    if(count(Mail::failures()) > 0){
      dd(Mail::failures());
    }

return 1;
}

public function userImage(Request $request){
    $user = Auth::user();
    if($request->file('file')){
        $image = $request->file('file');
        $new_image = time().$image->getClientOriginalName();
        $destination = 'frontend-assets/images/users';
        $image->move(public_path($destination),$new_image);
        $user->user_img = $new_image; 
        $user->save();
        return url($destination).'/'.$new_image;
    }
}

public function sp_register(Request $request){
 if($request->isMethod('post')){
   $user = Auth::user();
   $user->user_relation = 'both';
   $user->type = $request->business_type;
   $user->type_value = $request->state_radius;
   $user->category_id = json_encode($request->category_id);
   $user->country = $request->country;
   $user->state = $request->state;
   $user->city = $request->city;
   $user->address = $request->address;
   $user->latitude = $request->latitude;
   $user->longitude = $request->longitude;
   $user->update();
   $business = new SpBusiness;
   $business->user_id = $request->user_id;
   $business->business_name = $request->business_name;
   $business->business_reg = $request->business_reg;
   $business->business_phone = $request->business_phone;
   $business->business_email = $request->business_email;
   $business->business_website = $request->business_website;
   $business->save();
   return redirect('/service-provider');
 }
  return view('users.sp-register');
}

public function uploadUsers(Request $request)
{
    Excel::import(new UsersImport, $request->file);

    return redirect()->back()->with('success', 'User Imported Successfully');
}

public function uploadSP(Request $request)
{
    Excel::import(new SPImport($request->credits), $request->file);

    return redirect('admin/invitedserviceproviders')->with('success', 'Invitation send successfully');
}

public function searchUser(Request $request){
     $keyword = $request->input('search');
     if($keyword == ''){
      $users = User::where('subdomain', Auth::user()->subdomain)->where('id', '<>', Auth::user()->id)->where('user_type', $request->user_type)->orderBy('id','desc')->paginate(10);
     }else{
        $users = User::where('user_type',$request->user_type)->where('subdomain',Setting::subdomain())->where(function ($query) use($keyword) {
        $query->orWhere('id', 'like', '%' . $keyword . '%')
           ->orWhere('email', 'like', '%' . $keyword . '%')
           ->orWhere('first_name', 'like', '%' . $keyword . '%')
           ->orWhere('last_name', 'like', '%' . $keyword . '%');
      })->paginate(50);
     }
 
     if($request->user_type == 'client'){
      return view('customersearch',compact('users'));
     }else{
      return view('spsearch',compact('users'));
     }
}
 public function fileUpload($file, $thumbnail = true)
    {

        $uploadPath = storage_path('app/setting/');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $md5file = \md5_file($file);

        $filename = $md5file . '.' . $file->getClientOriginalExtension();

        // save to server
        $file->move($uploadPath, $filename);

        // create thumbnails
        if ($thumbnail) {
            $img = \Image::make($uploadPath . $filename);
        }

        return $filename;
    }

  public function logout(){
        Auth::logout();
        return redirect('users/login');
  }
}
