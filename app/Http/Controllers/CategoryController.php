<?php

namespace Acelle\Http\Controllers;


use Acelle\Model\Category;
use Acelle\Model\SubCategory;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('user_id',Auth::user()->id)->where('cat_parent','!=','0')->orderBy('category_name','asc')->paginate(16);
        // dd($categories);
        return view('categories.servicecategories',compact('categories'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {

       $category = new Category;
       if($request->file('category_icon')){
            $image = $request->file('category_icon');
            $new_image = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images/categories';
            $image->move(public_path($destination),$new_image);
            $category->category_icon = $new_image;
       }
       $category->user_id = $request->user()->id;
       $category->category_name = $request->category_name;
       $category->cat_parent = 1;
       $category->subdomain = request('account');
       $category->credit_cost = $request->credit_cost;
       $category->category_description = $request->category_description;
       $category->save();
       return redirect('/service-categories')->with('message', 'Category add successfully');
       
    }

    public function storesub(Request $request)
    {

       $category = new SubCategory;
       // if($request->file('category_icon')){
       //      $image = $request->file('category_icon');
       //      $new_image = time().$image->getClientOriginalName();
       //      $destination = 'frontend-assets/images/categories';
       //      $image->move(public_path($destination),$new_image);
       //      $category->category_icon = $new_image;
       // }
       $category->sub_category = $request->category_name;
       $category->category_id = $request->category_id;
       $category->description = $request->category_description;
       $category->save();
       return redirect('/service-categories')->with('message', 'Sub category add successfully');
       
    }
    /**
     * Display the specified resource.
     *
     * @param  \Acelle\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Acelle\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Acelle\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Category $category)
    {
        // dd($request->all());
        $update = Category::find($request->id);
        if($request->file('category_icon')){
            $image = $request->file('category_icon');
            $new_image = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images/categories';
            $image->move(public_path($destination),$new_image);
            $update->category_icon = $new_image;
       }
        $update->category_name = $request->category_name;
        $update->credit_cost = $request->credit_cost;
        $update->category_description = $request->category_description; 
        $update->update();
        return redirect('/service-categories')->with('message', 'Category update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Acelle\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$account,$id)
    {
        Category::find($id)->delete();
        return redirect('/service-categories')->with('message', 'Category delete successfully');
    }
}
