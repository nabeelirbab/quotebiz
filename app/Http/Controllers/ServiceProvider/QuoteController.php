<?php

namespace Acelle\Http\Controllers\ServiceProvider;

use Acelle\Http\Controllers\Controller;
use Acelle\Jobs\HelperJob;
use Illuminate\Http\Request;
use Acelle\Model\Quote;
use Acelle\Model\User;
use Acelle\Model\Country;
use Acelle\Model\State;
use Acelle\Model\City;
use Acelle\Model\SpBusiness;
use Auth;
use DB;

class QuoteController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->creadits);
        $pendingquotes = Quote::where('zip_code', Auth::user()->zipcode)->where('admin_id', request('account'))->get();
        // dd($pendingquotes[0]->questionsget[0]->choice);
        return view('service_provider.quotesResponses', compact('pendingquotes'));

    }

    public function leads()
    {
        return view('service_provider.quotesLeads');
    }

    public function leadsquotes()
    {
        $pendingquotes = array();

        //        if provider is local
        if (Auth::user()->type == "local business") {

            $pendingquotes = Quote::with('user','category','myquotation','questionsget.questions','questionsget.choice.choice')->whereIn('category_id', json_decode(Auth::user()->category_id))
                ->where('status', 'pending')
                ->select(
                    DB::raw("quotes.*, ( 6371  * acos( cos( radians(" . Auth::user()->latitude . ") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(" . Auth::user()->longitude . ") ) + sin( radians(" . Auth::user()->latitude . ") ) * sin( radians( latitude ) ) ) ) AS distance")
                )
                ->having("distance", "<=", Auth::user()->type_value)
                ->where('type', 'local business')
                ->orderBy('created_at', 'desc')
                ->get();

        }

        //        if provider is country base
        if (Auth::user()->type == "country") {

            $pendingquotesdata = Quote::whereIn('category_id', json_decode(Auth::user()->category_id))
                ->where('status', 'pending')
                ->whereNull('type')
                ->orderBy('created_at', 'desc')
                ->get();

            if(sizeof($pendingquotesdata)>0)
            {
                $Quotesids = array();
                foreach ($pendingquotesdata as $pendingquote)
                {
                    $deal_lat = $pendingquote->latitude;
                    $deal_long = $pendingquote->longitude;
                    $geocode_stats = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBSIo75YZ1hfbKAQPDvo0Tfyys9Zo6c9hk&latlng=" . $deal_lat . "," . $deal_long . "&sensor=false");
                    $output = json_decode($geocode_stats);
                    for ($j = 0; $j < count($output->results[0]->address_components); $j++) {
                        $cn = array($output->results[0]->address_components[$j]->types[0]);
                        if (in_array("country", $cn)) {
                            $country = $output->results[0]->address_components[$j]->long_name;
                        }
                    }
                    $usercountryname = HelperJob::countryname(Auth::user()->country)->name;
                    if ($usercountryname == $country) {
                        array_push($Quotesids, $pendingquote->id);
                    }

                }
                if(sizeof($Quotesids)>0)
                {
                    $pendingquotes = Quote::whereIn('id', $Quotesids)->get();
                }
            }

        }

        //        if provider is state base
        if (Auth::user()->type == "state") {

            $pendingquotes = Quote::whereIn('category_id', json_decode(Auth::user()->category_id))
                ->where('status', 'pending')
                ->whereNull('type')
                ->where('state',HelperJob::statename(Auth::user()->state)->name)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return $pendingquotes;
    }

    public function newJob($id)
    {
        return view('service_provider.newQuoteDetail');
    }

    public function businessUpdate(Request $request)
    {

       $business = SpBusiness::where('user_id',Auth::user()->id)->first();
       $business->business_name = $request->business_name;
       $business->business_reg = $request->business_reg;
       $business->business_phone = $request->business_phone;
       $business->business_email = $request->business_email;
       $business->business_website = $request->business_website;
       $business->save();

       return redirect()->back()->with('success', 'Business Info Update Successfully');
    }

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

    public function locationUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $radius = null;
        if (isset($request->state_radius)) {
            $radius = $request->state_radius;
        }
        $user->type = $request->user_type;
        $user->type_value = $radius;
        $user->save();

        return redirect()->back()->with('success', 'Location Update Successfully');
    }

    public function userCountries()
    {
        $countries = Country::all();
        ?>
        <div class="form-group"><label class="form-label" for="display-country">Country</label>
            <select name="state_radius" id="display-country" class="form-control" required>
                <option value="" selected disabled> Select Country</option>
                <?php
                foreach ($countries as $country) {
                    echo '<option value="' . $country->name . '">' . $country->name . '</option>';
                }
                ?>
            </select>
        </div>
        <?php

    }

    public function getstates($account, $id)
    {
        $countryid = $id;
        $states = State::where('country_id', $countryid)->get();
        ?>
        <option value="" selected disabled>Select State</option>
        <?php
        foreach ($states as $state) {
            echo '<option value="' . $state->id . '">' . $state->name . '</option>';
        }
        ?>
        <?php
    }

    public function getcities($account, $id)
    {
        $stateid = $id;
        $cities = City::where('state_id', $stateid)->get();
        ?>
        <option value="" selected disabled>Select City</option>
        <?php
        foreach ($cities as $city) {
            echo '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        ?>
        <?php
    }

    public function addressupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        if ($request->address != Auth::user()->address) {
            if (Auth::user()->latitude == $request->latitude && Auth::user()->longitude == $request->longitude) {
                return redirect()->back()->with('error', 'Please enter valid address !');
            } else {
                $user->address = $request->address;
                $user->latitude = $request->latitude;
                $user->longitude = $request->longitude;
            }
        }
        $radius = null;
        if (isset($request->state_radius)) {
            $radius = $request->state_radius;
        }
        $user->type = $request->user_type;
        $user->type_value = $radius;
        $user->save();

        return redirect()->back()->with('success', 'Profile Update Successfully');
    }
}
