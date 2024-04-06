<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\Post;
use Acelle\Model\User;
use Acelle\Model\Setting;
use Acelle\Model\Category;
use Acelle\Model\Visit;

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

    public function allSps()
    {
       $users = User::where(function($q) {
            $q->where('user_type', 'service_provider')
                ->orWhere('user_relation', 'both');
        })->where('subdomain',Setting::subdomain())->where('activated',1)->orderBy('id','desc')->paginate(20);
       return view('blog.sps',compact('users'));
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

    public function userProfile($account,$id){
     Visit::firstOrCreate([
            'user_id' => $id,
            'track_type' => 'profile_view',
            'visitor_ip' => request()->ip(),

        ]);

       $category_id = json_decode(User::where('id',$id)->first()->category_id);
       $customFields = Category::with(['customs' => function ($query) use ($id) {
            $query->whereHas('answers', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->with(['answers' => function ($query) use ($id) {
                $query->where('user_id', $id); // Filter answers by user ID
            }, 'answers.choice']);
        }])
        ->where('cat_parent', '1')
        ->where('cat_parent_id', '0')
        ->whereIn('id', $category_id)
        ->orderBy('category_name', 'desc')
        ->get();
      $user = User::with('gallery')->where('id',$id)->where('subdomain',Setting::subdomain())->first();
      return view('blog.sp_profile',compact('user','customFields'));
    }

     public function trackuser(Request $request){

         Visit::firstOrCreate([
                'user_id' => $request->user_id,
                'track_type' => $request->track_type,
                'visitor_ip' => request()->ip(),
                ]);
         
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
        $post->created_at = now();
        $post->getExcerptAttribute();
        if($request->file('cover_img')){
            $image = $request->file('cover_img');
            $new_image = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images/posts';
            $image->move(public_path($destination),$new_image);
            $post->cover_img = $new_image;
        } 
        if($request->input('action') == 'preview'){
            $relatedPosts = Post::where('subdomain',Setting::subdomain())->orderBy('id','desc')->get();
            return view('blog.single-blog', compact('post','relatedPosts'));
        }else{
           $post->save(); 
        }
        
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
        $relatedPosts = Post::where('subdomain',Setting::subdomain())->where('slug','<>',$slug)->orderBy('id','desc')->get();
        return view('blogShow', compact('post','relatedPosts'));
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
        if($request->input('action') == 'preview'){
            $relatedPosts = Post::where('subdomain',Setting::subdomain())->orderBy('id','desc')->get();
            return view('blog.single-blog', compact('post','relatedPosts'));
        }else{
           $post->update(); 
        }
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
