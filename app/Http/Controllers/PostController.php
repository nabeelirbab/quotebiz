<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Post;
use Acelle\Model\Setting;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::where('subdomain',Setting::subdomain())->orderBy('id','desc')->paginate(20);
       return view('blogs',compact('posts'));
    }

    public function allBlogs()
    {
       $posts = Post::where('subdomain',Setting::subdomain())->orderBy('id','desc')->paginate(20);
       return view('blog.blogs',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addBlog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = str_slug($request->input('title'));
        $post->subdomain = Setting::subdomain();
        $post->getExcerptAttribute();
        if($request->file('cover_img')){
            $image = $request->file('cover_img');
            $new_image = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images/posts';
            $image->move(public_path($destination),$new_image);
            $post->cover_img = $new_image;
        } 
        $post->save();
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($account, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blogShow', compact('post'));
    }

    public function singleBlog($account, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::where('subdomain',Setting::subdomain())->where('slug','<>',$slug)->orderBy('id','desc')->get();
        return view('blog.single-blog', compact('post','relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($account,$id)
    {
       $post = Post::where('id',$id)->first();
       return view('editBlog',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $account, $id)
    {
       
        $post = Post::where('id',$id)->first();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = str_slug($request->input('title'));
        $post->subdomain = Setting::subdomain();
        $post->getExcerptAttribute();
        if($request->file('cover_img')){
            $image = $request->file('cover_img');
            $new_image = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images/posts';
            $image->move(public_path($destination),$new_image);
            $post->cover_img = $new_image;
        } 
        // dd($post);
        $post->update();
        return redirect('/admin/posts')->with('success', 'Update successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account,$id)
    {
        Post::where('id',$id)->delete();
        return redirect('/admin/posts')->with('success', 'Delete successful!');
    }
}
