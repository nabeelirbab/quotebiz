@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">

<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/somestyle.css') }}">
<style type="text/css">
.post-body {
    max-width:100%; /* adjust this value as needed */
    overflow-y: auto;
}
.container, .container-sm {
    max-width: 100%;
}
        .single-blog-banner-layout1 .banner-content .item-social li .linkedin {
            background-color: #0A66C2;
        }
       .blog-box-layout5 {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 9px 9px 9px 9px;
            box-shadow: 0 0 10px 0 rgba(0,0,0,.15);
            background: white;
        }
        .blog-box-layout5 .item-img {
            flex: 1;
            position: relative;
            /*max-height: 280px;*/
            overflow: hidden;
            /*min-height: 250px;*/
            margin: 0;
            align-items: center;
            text-align: center;
            background: white;
            border-radius: 9px 9px 0px 0px;
            padding-bottom: calc( 0.66 * 100% );
        }
        .blog-box-layout5 .item-img a {
            display: initial !important;
        }
        .blog-box-layout5 .item-img a img {
            transform: scale(1);
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            /*border-radius: 9px 9px 0 0;*/
            height: 100%;
            width: auto;
            position: absolute;
            top: calc(50% + 1px);
            left: calc(50% + 1px);
            transform: scale(1.01) translate(-50%,-50%);

        }
        .blog-box-layout5 .item-img img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        .blog-box-layout5 .item-content {
            flex: 0 0 auto;
            background-color: #ffffff;
            border-radius: 0 0 9px 9px;
            margin-bottom: 25px;
            padding: 0px;
        }
        .blog-box-layout5 .item-content .item-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.5;
            overflow: hidden;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin: 0;
        }
        .blog-box-layout5 .item-content .item-title a {
          color: #000000;
        }
        .list-unstyled {
          list-style: none;
          padding: 0;
          margin: 0;
        }
        .post_text{
          margin-top: 20px;
          padding: 0 30px;
          margin-bottom: 0;
          width: 100%;
          flex-grow: 1;
          height: 240px;
        }
        .post_excerpt{
          margin-bottom: 25px;
          line-height: 1.7;
          box-sizing: border-box;
        }
        .post_excerpt p {
          margin: 0;
          line-height: 1.5em;
          font-size: 14px;
          color: #777;
        }
        .post_read-more {
          text-transform: uppercase;
          margin-bottom: 20px;
          display: inline-block;
          font-size: 12px;
          font-weight: 700;
          color: #fb816a !important;
        }
        .post_meta-data {
          margin-top: auto;
          padding: 15px 30px;
          margin-bottom: 0;
          border-top: 1px solid #eaeaea;
          line-height: 1.3em;
          font-size: 12px;
          color: #adadad;
        }

         .single-blog-banner-layout1 .banner-img{
          display: flex;
          justify-content: center;
        }
        .single-blog-banner-layout1 .banner-img img{
          max-width: 100%;
          max-height: 1000px !important;
        }
        .single-blog-box-layout1{
          max-width: 100%;
          overflow-y: auto;
        }
</style>
@endsection

@section('content')
<!-- content @s -->
      <section class="single-blog-wrap-layout1">
            <div class="single-blog-banner-layout1" style="margin-bottom: 2.3rem">
                <div class="banner-img">
                    <img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="blog">
                </div>
                <div class="banner-content">
                    <div class="container">
                        <ul class="entry-meta meta-color-light2">
                            <li><i class="fas fa-calendar-alt"></i>{{ $post->created_at->format('M j, Y') }}</li>
                            <li><i class="fas fa-user"></i>BY <a href="#">Mark Willy</a></li>
                        </ul>
                        <h2 class="item-title">{{$post->title}}</h2>
                      
                        <ul class="item-social">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('blog/'.$post->slug)) }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i>SHARE</a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url('blog/'.$post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" class="twitter"><i class="fab fa-twitter"></i>SHARE</a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url('blog/'.$post->slug)) }}&title={{ urlencode($post->title) }}" target="_blank" class="linkedin"><i class="fab fa-linkedin"></i>SHARE</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gutters-50">
                	<div class="d-flex justify-content-center">
                		<a href="{{ url('admin/posts/edit/'.$post->id) }}" class="btn btn-success" style="margin-right: 15px">Edit</a>
                		<a href="{{ url('admin/posts/delete/'.$post->id) }}" class="btn btn-warning">Delete</a>
                	</div>
                    <div class="col-lg-8">
                        <div class="single-blog-box-layout1">
                            <div class="blog-details post-body">
                              {!! $post->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 sidebar-widget-area sidebar-break-md">
                        <div class="widget">
                            <div class="section-heading heading-dark">
                                <h3 class="item-heading">POPULAR POSTS</h3>
                            </div>
                            <div class="widget-latest">
                                <ul class="block-list">
                                    @foreach($relatedPosts as $post)
                                    <li class="single-item">
                                        <div class="item-img" style="width: 150px;">
                                            <a href="{{ url('blog/'.$post->slug) }}"><img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="Post"></a>
                                        </div>
                                        <div class="item-content">
                                            <ul class="entry-meta meta-color-dark">
                                                <!-- <li><i class="fas fa-tag"></i>Weeding</li> -->
                                                <li><i class="fas fa-calendar-alt"></i>{{ $post->created_at->format('M j, Y') }}</li>
                                            </ul>
                                            <h4 class="item-title"><a href="#">{{$post->title}}</a></h4>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- content @e -->
@endsection


