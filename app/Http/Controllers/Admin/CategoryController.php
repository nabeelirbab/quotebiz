<?php

namespace Acelle\Http\Controllers\Admin;

use Acelle\Http\Controllers\Controller;
use Acelle\Model\Category;
// use Acelle\Classes\HelpClass;
use Illuminate\Http\Request;
use Route;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->account);
        $categories = Category::orderBy('category_name','asc')->paginate(12);
        return view('admin.categories.servicecategories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.addcategory');
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
       $category->category_description = $request->category_description;
       $category->save();
       return redirect('/admin/service-categories')->with('message', 'Category add successfully');
       
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
        // dd($id);
        $category = Category::find($id);
        return view('admin.categories.editcategory',compact('category'));
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
        $update->category_description = $request->category_description; 
        $update->update();
        return redirect('/admin/service-categories')->with('message', 'Category update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Acelle\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        Category::find($id)->delete();
        return redirect('/admin/service-categories')->with('message', 'Category delete successfully');
    }
}
