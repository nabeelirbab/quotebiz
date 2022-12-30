<?php

namespace Acelle\Http\Controllers;

use Acelle\Model\QuestionChoice;
use Acelle\Model\Category;
use Acelle\Model\Quote;
use Acelle\Model\QuoteQuestion;
use Acelle\Model\QuoteChoice;
use Acelle\Model\User;
use Acelle\Model\Subdomain;
use Illuminate\Http\Request;
use Auth;
use Acelle\Library\ExtendedSwiftMessage;
use Exception;
use Acelle\Library\Log as MailLog;
use Acelle\Model\Setting;
use Acelle\Jobs\HelperJob;
use Acelle\Mail\OnJobPost;
use Acelle\Mail\RelatedJob;
use Carbon\Carbon;
use Mail;

class QuestionChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request->all());
        $zipcode = $request->zipcode;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $state = $request->state;
        $local_business = "";
        if (isset($request->local_business)) {
            $local_business = $request->local_business;
        }
        if (empty($latitude) || empty($longitude)) {
            return redirect()->back()->with("error", "Please enter valid location");
        }
        $count = Category::where('subdomain', Setting::subdomain())->count();
        if ($count > 0) {
            $category = Category::where('cat_parent', '1')->where('subdomain', Setting::subdomain())->where('category_name', $request->category_name)->first();
        } else {
            $category = Category::where('cat_parent', '0')->where('category_name', $request->category_name)->first();
        }


        return view('frontquestion', compact('category', 'zipcode', 'latitude', 'longitude', 'local_business', 'state'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeform(Request $request)
    {

        // $mailer = HelperJob::mailSettings();
        if (Auth::user()) {
            if (Auth::user()->user_type == 'client' || Auth::user()->user_type == 'service_provider') {

                $user = Auth::user();

            } elseif(!$request->first_name && !$request->last_name){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'subdomain' => Setting::subdomain()]))
                    {
                    if(Auth::check()){
                     $user = Auth::user();
                    if (!$user->activated) {
                        $uid = $user->uid;
                        auth()->logout();
                        return view('notActivated', ['uid' => $uid]);
                    }
                         User::where('id',$user->id)->update([
                        'last_login_at' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ]);
                   

                    }
                 }else{
                    return redirect('/')->withErrors(['msg' => 'Wrong email or password']);
                 }
        }else{
                $user = new User();
                $user->fill($request->all());
                $user->password = bcrypt($request->password);
                $user->city = $request->city;
                $user->mobileno = $request->mobileno;
                $user->activated = 1;
                $user->save();
            }

        } elseif(!$request->first_name && !$request->last_name){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'subdomain' => Setting::subdomain()]))
                    {
                    if(Auth::check()){
                     $user = Auth::user();
                    if (!$user->activated) {
                        $uid = $user->uid;
                        auth()->logout();
                        return view('notActivated', ['uid' => $uid]);
                    }
                         User::where('id',$user->id)->update([
                        'last_login_at' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ]);
                   

                    }
                 }else{
                    return redirect('/')->withErrors(['msg' => 'Wrong email or password']);
                 }
        }else {
            $user = new User();
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->city = $request->city;
            $user->activated = 1;
            $user->mobileno = $request->mobileno;
            $user->save();
        }
        $quote = new Quote;
        $quote->category_id = $request->category_id;
        $quote->admin_id = $request->admin_id;
        $quote->zip_code = $request->zip_code;
        $quote->latitude = $request->latitude;
        $quote->longitude = $request->longitude;
        $quote->state = $request->state;
        if($request->local_business == "local business")
        {
            $quote->type = "local business";
        }
        $quote->additional_info = $request->additional_info;
        $quote->user_id = $user->id;
        $quote->save();

        if ($request->question_id) {

            foreach ($request->option as $key => $value) {
                $question = new QuoteQuestion;
                $question->quote_id = $quote->id;
                $question->question_id = $key;
                $question->save();


                $q_choice = new QuoteChoice;
                $q_choice->question_id = $key;
                $q_choice->choice_value = $value;
                $q_choice->quote_question_id = $question->id;
                $q_choice->save();

            }
        }

        if ($request->question_date) {

            foreach ($request->date as $keydate => $date) {
                $questiondate = new QuoteQuestion;
                $questiondate->quote_id = $quote->id;
                $questiondate->question_id = $request->question_date[$keydate];
                $questiondate->save();


                $q_choice_date = new QuoteChoice;
                $q_choice_date->question_id = $request->question_date[$keydate];
                $q_choice_date->choice_value = $date;
                $q_choice_date->quote_question_id = $questiondate->id;
                $q_choice_date->save();

            }
        }

        if ($request->question_input) {

            foreach ($request->input as $keyinput => $input) {
                $questioninput = new QuoteQuestion;
                $questioninput->quote_id = $quote->id;
                $questioninput->question_id = $request->question_input[$keyinput];
                $questioninput->save();


                $q_choice_input = new QuoteChoice;
                $q_choice_input->question_id = $request->question_input[$keyinput];
                $q_choice_input->choice_value = $input;
                $q_choice_input->quote_question_id = $questioninput->id;
                $q_choice_input->save();

            }
        }

        if ($request->question_id2) {
            foreach ($request->question_id2 as $index => $question_id) {

                $question1 = new QuoteQuestion;
                $question1->quote_id = $quote->id;
                $question1->question_id = $question_id;
                $question1->save();

                foreach ($request->choices as $key1 => $value1) {

                    $data = explode(",", $value1);
                    if ($data[0] == $question_id) {
                        // echo $data[1].'<>'.$question_id.'&lt;br>';
                        $q_choices = new QuoteChoice;
                        $q_choices->question_id = $question_id;
                        $q_choices->choice_value = $data[1];
                        $q_choices->quote_question_id = $question1->id;
                        $q_choices->save();
                    }


                }

            }

        }
        $jobdata = [
            'user' => $user,
            'subject' => 'Quote Post'
        ];

        Mail::to($user->email)->send(new OnJobPost($jobdata));

        $job = Quote::with('quotations', 'user')->where('id', $quote->id)->where('user_id', $user->id)->orderBy('id', 'desc')->first();

        $SPEmails = array();
        $location = '';
        if ($request->local_business == "local business")
        {

            $users = User::where('user_type', 'service_provider')->where('id','<>',$user->id)->where('type', 'local business')->where('activated', 1)->whereNotNull('type')->where('subdomain', Setting::subdomain())->where('category_id', 'like', '%' . $request->category_id . '%')->get();
            foreach ($users as $user) {
                $userlat = $user->latitude;
                $userlang = $user->longitude;
                $userradius = $user->type_value;

                $rawQuery = "users.* , ( 6371  * acos( cos( radians(" . $userlat . ") ) * cos( radians( " . $request->latitude . " ) ) * cos( radians( " . $request->longitude . " ) - radians(" . $userlang . ") ) + sin( radians(" . $userlat . ") ) * sin( radians(" . $request->latitude . ") ) ) ) AS distance";
                $getusersdata = User::where('id', $user->id)
                    ->selectRaw($rawQuery)
                    ->having("distance", "<=", $userradius)
                    ->orderBy("distance", 'asc')
                    ->first();

                if ($getusersdata) {
                    array_push($SPEmails, $getusersdata->email);
                }
            }

            $location = $request->zip_code;

        }
        else {

            $users = User::where('user_type', 'service_provider')->where('id','<>',$user->id)->where('activated', 1)->whereNotNull('type')->where('subdomain', Setting::subdomain())->where('category_id', 'like', '%' . $request->category_id . '%')->get();

            foreach ($users as $user) {

                if ($user->type == "local business") {
                    $userlat = $user->latitude;
                    $userlang = $user->longitude;
                    $userradius = $user->type_value;

                    $rawQuery = "users.* , ( 6371  * acos( cos( radians(" . $userlat . ") ) * cos( radians( " . $request->latitude . " ) ) * cos( radians( " . $request->longitude . " ) - radians(" . $userlang . ") ) + sin( radians(" . $userlat . ") ) * sin( radians(" . $request->latitude . ") ) ) ) AS distance";
                    $getusersdata = User::where('id', $user->id)
                        ->selectRaw($rawQuery)
                        ->having("distance", "<=", $userradius)
                        ->orderBy("distance", 'asc')
                        ->first();
                    $location = $request->zip_code;
                    if ($getusersdata) {
                        array_push($SPEmails, $getusersdata->email);
                    }
                }
                elseif ($user->type == "country" || $user->type == "world") {
                    $deal_lat = $request->latitude;
                    $deal_long = $request->longitude;
                    $arrContextOptions=array(
                        "ssl"=>array(
                            "verify_peer"=>false,
                            "verify_peer_name"=>false,
                        ),
                    ); 
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyC_b-7SwLA4kCWz514JTmVZZ3gc3M4hDAA&latlng=" . $deal_lat . "," . $deal_long . "&sensor=false";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_REFERER, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
                    $result = curl_exec($ch);
                    curl_close($ch);
                   
                    $output = json_decode($result);


                    for ($j = 0; $j < count($output->results[0]->address_components); $j++) {

                        $cn = array($output->results[0]->address_components[$j]->types[0]);

                        if (in_array("country", $cn)) {
                            $country = $output->results[0]->address_components[$j]->long_name;
                        }
                    }
                    $usercountryname = HelperJob::countryname($user->country)->name;
                    if ($usercountryname == $country) {
                        array_push($SPEmails, $user->email);
                             // dd($SPEmails);
                    }
                    $location = $country;
                }
                elseif ($user->type == "state") {
                    $deal_lat = $request->latitude;
                    $deal_long = $request->longitude;
                    $state = $request->state;
                    $userstatename = HelperJob::statename($user->state)->name;
                    if ($userstatename == $state) {
                        array_push($SPEmails, $user->email);
                    }
                    $location = $request->state;
                }else{
                    array_push($SPEmails, $user->email);
                }
            }
        }
// dd($SPEmasils);
        $emailsize = sizeof($SPEmails);
        if ($emailsize > 0) {
            foreach ($SPEmails as $key => $value) {

                $email = $value;

                $maildata = [
                    'jobdetail' => $job,
                    'location' => $location
                ];

                Mail::to($email)->send(new RelatedJob($maildata));
            }
        }

        if (Auth::user()) {
            return redirect('customer/my-jobs');
        } else {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'subdomain' => $request->admin_id])) {

                if (Auth::check()) {
                    User::where('id', Auth::user()->id)->update([
                        'last_login_at' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ]);
                    return redirect('customer/my-jobs');
                }
            }

        }


    }

    public function checkEmail(Request $request)
    {
        // return $request->all();
        $data = User::where('subdomain',Setting::subdomain())->where('email',$request->email)->where(function ($query) {
          $query->orWhere('user_type', '=', 'client')
            ->orWhere('user_type', '=', 'service_provider');
         })->first();
        // $data = User::where('email', $request->email)->first();

        if (!$data) {
            return 0;
        } else {
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \Acelle\Model\QuestionChoice $questionChoice
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionChoice $questionChoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Acelle\Model\QuestionChoice $questionChoice
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionChoice $questionChoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Acelle\Model\QuestionChoice $questionChoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionChoice $questionChoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Acelle\Model\QuestionChoice $questionChoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionChoice $questionChoice)
    {
        //
    }
}
