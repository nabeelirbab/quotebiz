<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Quote;
use Acelle\Model\Category;
use Acelle\Model\Subdomain;
use Acelle\Model\Setting;
use Redirect;


class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($account)
    {
            return view('quoteRequest');
    }

    public function Index(){

        $quotes = Quote::with('quotations','user')->where('admin_id',Setting::subdomain())->orderBy('id','desc')->paginate(10);
        // dd($quotes);
        return view('quotes',compact('quotes'));
    }

    public function category_search(Request $request){
     
     $category = Category::where('subdomain',Setting::subdomain())->count();
     if($category > 0){
        $searchDate = Category::query()->where('category_name', 'like', "%{$request->category_name}%")->where('subdomain',Setting::subdomain())->get();
    }else{
     $searchDate = Category::query()->where('category_name', 'like', "%{$request->category_name}%")->where('cat_parent','0')->get();
    }

     // dd($searchDate);

     $html = '';
     if(count($searchDate)){
     foreach ($searchDate as $key => $value) {
         $html .='<li class="list-group-item">'.$value->category_name.'</li>';
     }
 }else{
    $html = '<li class="list-group-item">Not Found</li>';
 }

     return $html;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
