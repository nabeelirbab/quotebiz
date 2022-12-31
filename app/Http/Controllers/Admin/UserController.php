<?php

namespace Acelle\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Acelle\Http\Controllers\Controller;
use Acelle\Model\Subdomain;
use Redirect;
use Session;
class UserController extends Controller
{
	public function domainlist(){
        $domains = Subdomain::where('parent','!=', null)->orderby('id','desc')->get();
        return view('admin.customedomains',compact('domains'));
	}
	 public function domain_status(Request $request,$id){
       
      $update = Subdomain::where('id', $id)->update(['status' => $request->get('status')]);
        Session::flash('success', 'Domain status change successfully!!');
        return Redirect::back();
	 }
}
