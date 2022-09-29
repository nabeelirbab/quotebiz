<?php

namespace Acelle\Http\Controllers\ServiceProvider;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Model\Quote;
use Acelle\Model\User;
use Acelle\Model\Country;
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
        $user->type = $request->user_type;
        if (isset($request->state_radius)) {
            $user->type_value = $request->state_radius;
        }
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
                foreach($countries as $country)
                {
                    echo '<option value="'.$country->name.'">'.$country->name.'</option>';
                }
                ?>
            </select>
        </div>
        <?php

    }
}
