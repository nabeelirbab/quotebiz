<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as LaravelLog;
use Acelle\Model\Setting;
use Acelle\Model\Subdomain;
use Auth;

class SettingController extends Controller
{
    /**
     * Render uploaded file.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function file(Request $request, $filename)
    {
        //return \Image::make(Setting::getUploadFilePath($filename))->response();
        $path = Setting::getUploadFilePath($filename);
        $type = mime_content_type($path);
        if ($type == 'image/svg') {
            $type = 'image/svg+xml';
        }
        return response()->file($path, ['Content-Type' => $type]);
    }

    public function customdomain(Request $request){

         if ($request->isMethod('post')) {
             Subdomain::where('id',Auth::user()->id)->update(['parent'=> $request->parent]);
             return redirect()->back()->with('success', 'Domain add successfully');   

         }

         return view('customDomain');
    }
}
