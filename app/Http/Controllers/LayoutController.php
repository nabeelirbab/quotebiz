<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Http\Controllers\Controller;
use Acelle\Model\Setting;
use Illuminate\Support\Str;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if ($request->user()->admin->getPermission('layout_read') == 'no') {
        //     return $this->notAuthorized();
        // }
    $subdomain = Setting::subdomain(); // Replace with the actual user subdomain

    $items = \Acelle\Model\Layout::where('subdomain', $subdomain)
        ->orWhere(function ($query) use ($subdomain) {
            $query->where('related', 'main_admin')
                  ->whereNotExists(function ($subQuery) use ($subdomain) {
                      $subQuery->select(\DB::raw(1))
                               ->from('layouts')
                               ->where('subdomain', $subdomain);
                  });
        })
        ->get();
        // $items = \Acelle\Model\Layout::get();
// dd($items);
        return view('email_temp.index', [
            'items' => $items,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
       

        $items = \Acelle\Model\Layout::search($request)->paginate($request->per_page);

        return view('email_temp._list', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $account, $id)
    {
        // Generate info
        $user = $request->user();
        $layout = \Acelle\Model\Layout::where('uid', $id)->first();

   

        // Get old post values
        if (null !== $request->old()) {
            $layout->fill($request->old());
        }
        return view('email_temp.edit', [
            'layout' => $layout,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $account, $id)
    {
      

        // Prenvent save from demo mod
        if ($this->isDemoMode()) {
            return view('somethingWentWrong', ['message' => trans('messages.operation_not_allowed_in_demo')]);
        }

       

        // validate and save posted data
        if ($request->isMethod('patch')) {

            $layout = \Acelle\Model\Layout::where('uid',$id)->where('subdomain',Setting::subdomain())->first();
            $rules = array(
                'content' => 'required',
                'subject' => 'required',
            );

            // $this->validate($request, $rules);

            // make validator
            $validator = \Validator::make($request->all(), $rules);

            // redirect if fails
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->all()[0],
                ], 400);
            }


            $uuid = Str::uuid()->toString();

            if($layout){
               $layout->fill($request->all());
               $layout->save();
                 $request->session()->flash('alert-success', trans('messages.layout.updated'));
                return response()->json([
                    'status' => 'success',
                    'url' => url('admin/layouts/'.$layout->uid.'/edit'),
                ]);
            }else{

                $data = \Acelle\Model\Layout::findByUid($id);
                $layout = new \Acelle\Model\Layout();

                $layout->uid = $uuid;
                $layout->content = $request->content;
                $layout->alias = $data->alias;
                $layout->group_name = $data->group_name;
                $layout->related = 'admin';
                $layout->type = $data->type;
                $layout->subject = $request->subject;
                $layout->subdomain = Setting::subdomain();
                $layout->save();

                // Redirect to my lists page
                $request->session()->flash('alert-success', trans('messages.layout.updated'));
                return response()->json([
                    'status' => 'success',
                    'url' => url('admin/layouts/'.$uuid.'/edit'),
                ]);
            }
            // Save template
        
        }
    }
}
