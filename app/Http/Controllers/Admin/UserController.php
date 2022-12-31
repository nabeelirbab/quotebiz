<?php

namespace Acelle\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Acelle\Http\Controllers\Controller;
use Acelle\Model\Subdomain;

class UserController extends Controller
{
	public function domainlist(){
        $domains = Subdomain::where('parent','!=', null)->orderby('id','desc')->get();
        return view('admin.customedomains',compact('domains'));
	}
}
