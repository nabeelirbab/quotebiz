<?php

namespace Acelle\Http\Controllers\ServiceProvider;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Model\Quote;
use Acelle\Model\User;
use Acelle\Model\Country;
use Acelle\Model\State;
use Acelle\Model\City;
use Auth;

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
// dd(Auth::user()->category_id);
        $pendingquotes = Quote::with('user', 'category', 'myquotation', 'questionsget.questions', 'questionsget.choice.choice')->where('zip_code', Auth::user()->zipcode)->whereIn('category_id', json_decode(Auth::user()->category_id))->where('admin_id', request('account'))->where('status', 'pending')->orderBy('created_at', 'desc')->get();

        return $pendingquotes;
    }

    public function newJob($id)
    {

        return view('service_provider.newQuoteDetail');
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
        $user->address = $request->address;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();

        return redirect()->back()->with('success', 'Profile Update Successfully');
    }
}
