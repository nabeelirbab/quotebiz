<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Subscription;
use Acelle\Model\Quote;
use Acelle\Model\Quotation;
use Acelle\Model\User;
use Acelle\Model\SiteSetting;
use Acelle\Model\BuyCreadit;
use Acelle\Model\Invitation;
use Auth;
use Session;
use Redirect;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $date = $request->get('date');
        if ($date == 'daily') {
            $from = Carbon::now()->subDays(0);
        } elseif ($date == 'monthly') {
            $from = Carbon::now()->subDays(30);
        } else {
            $from = Carbon::now()->subDays(6);
        }

        event(new \Acelle\Events\UserUpdated($request->user()->customer));

        // Last month
        $customerCount = User::where('user_type', 'client')->where('subdomain', request('account'))->count();
        $providerCount = User::where(function($q) {
           $q->where('user_type', 'service_provider')
           ->orWhere('user_relation', 'both');
          })->where('subdomain', request('account'))->count();
        $quoteCount = Quote::where('admin_id', request('account'))->count();
        $quotes = Quote::where('admin_id', request('account'))->orderBy('created_at', 'desc')->limit(5)->get();
        $totalRevenue = BuyCreadit::where('subdomain', request('account'))->sum('amount');

        $topSP = User::has('allQuoteSp')->with(['allQuoteSp' => function ($q) use ($date, $from) {
            if ($date == 'daily') {
                $q->where('created_at', Carbon::today());
            } elseif ($date == 'monthly') {
                $q->whereMonth('created_at', Carbon::now()->month);
            } else {
                $q->whereBetween('created_at', [$from, Carbon::today()]);
            }
        }])->addSelect(['totalamount' => Quotation::has('wonquote')->selectRaw('sum(quote_price) as total_likes')->whereColumn('user_id', 'users.id')->whereBetween('created_at', [$from, Carbon::today()])->groupBy('user_id')])->where('user_type', 'service_provider')->where('subdomain', request('account'))->orderBy('totalamount', 'DESC')->get();
        // dd($topSP[0]->allQuoteSp);
        return view('dashboard', [
            'customerCount' => $customerCount,
            'providerCount' => $providerCount,
            'quoteCount' => $quoteCount,
            'quotes' => $quotes,
            'totalRevenue' => $totalRevenue,
            'topSp' => $topSP
        ]);
    }

    public function home()
    {

        return view('index');
    }

    public function quotes()
    {

        $quotes = Quote::with('quotations', 'user')->orderBy('id', 'desc')->paginate(7);
        // dd($quotes);
        return view('quotes', compact('quotes'));
    }

    public function support()
    {
        return view('support');
    }

    public function customers()
    {
        $users = User::where('subdomain', Auth::user()->subdomain)->where('user_type', 'client')->paginate(10);
        // dd($users);
        return view('customers', compact('users'));
    }

    public function serviceproviders()
    {
        $users = User::where('subdomain', Auth::user()->subdomain)->where('id', '<>', Auth::user()->id)->where(function($q) {
           $q->where('user_type', 'service_provider')
           ->orWhere('user_relation', 'both');
          })->paginate(10);
        return view('serviceproviders', compact('users'));
    }

    public function invitedserviceproviders()
    {
        $users = Invitation::where('subdomain', Auth::user()->subdomain)->paginate(10);
        return view('inviteserviceproviders', compact('users'));
    }

    public function provider_detail($account, $id)
    {
        $userdetail = User::where('subdomain', Auth::user()->subdomain)->where('id', $id)->first();
        return view('provider_profile', compact('userdetail'));
    }

    public function customer_detail($account, $id)
    {
        $userdetail = User::where('subdomain', Auth::user()->subdomain)->where('id', $id)->first();
        return view('customer_profile', compact('userdetail'));
    }

    public function accountstatus(Request $request, $account, $id)
    {
        $update = User::where('id', $id)->update(['activated' => $request->get('status')]);
        Session::flash('success', 'Account status change successfully!!');
        return Redirect::back();
    }

    public function servicecategories()
    {

        return view('servicecategories');
    }

    public function supportchat()
    {
        return view('supportchat');
    }

    public function sitesetting(Request $request)
    {

        $sitesetting = SiteSetting::where('subdomain', request('account'))->first();
        if ($request->isMethod('post')) {
            if ($sitesetting) {

                $sitesetting->subdomain = request('account');
                $sitesetting->site_name = $request->site_name;
                $sitesetting->site_keyword = $request->site_keyword;
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
            } else {

                $sitesetting = new SiteSetting;
                $sitesetting->subdomain = request('account');
                $sitesetting->site_name = $request->site_name;
                $sitesetting->site_keyword = $request->site_keyword;
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

        }

        return view('account/sitesetting', compact('sitesetting'));
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

    public function removesetting()
    {

        SiteSetting::where('subdomain', request('account'))->delete();
        return Redirect::back();

    }

    public function updateToken(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function location_setting($account, $id)
    {
        $userdetail = User::where('subdomain', Auth::user()->subdomain)->where('id', $id)->first();
        return view('location_setting', compact('userdetail'));
    }

    public function Save_location_setting(Request $request)
    {
        $user = User::find($request->providerid);
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->type = $request->user_type;
        $radius = null;
        if (isset($request->state_radius)) {
            $radius = $request->state_radius;
        }
        $user->type_value = $radius;
        $user->location_setting = $request->allow_location_setting;
        $user->save();

        return redirect()->back()->with('success', 'Profile Update Successfully');
    }
}
