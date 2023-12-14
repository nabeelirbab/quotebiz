<?php
$sitename = \Acelle\Model\Setting::get("site_name");
$sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
$sitelightlogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
$logo_height = \Acelle\Model\Setting::get("logo_height");
$logo_width = \Acelle\Model\Setting::get("logo_width");
$job_design = Acelle\Jobs\HelperJob::form_design(); 
if (isset($post)) {
  $title = @$post->title;
  $image = asset('frontend-assets/images/posts/' . @$post->cover_img);
} else {
  $title = \Acelle\Model\Setting::get("site_name"). '-'. 'Blogs';
  $image = action('SettingController@file', \Acelle\Model\Setting::get('site_favicon'));
}
?>
<!DOCTYPE html>
<html class="no-js"  lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
    @if (\Acelle\Model\Setting::get('site_favicon'))
    <meta property="og:image" content="{{ $image }}">
    @else
    <meta property="og:image" content="{{ URL::asset('favicon/favicon-32x32.png') }}">
    @endif
    <meta name="description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
    <meta name="keywords" content="{{ \Acelle\Model\Setting::get("site_keyword") }}" />
    <meta name="php-version" content="{{ phpversion() }}" />
    @if(\Acelle\Model\Setting::get("meta_tag"))
    {!! \Acelle\Model\Setting::get("meta_tag") !!}
    @endif
    <link rel="canonical" href="{{ url()->current() }}" />

    <title>{{ $title }}</title>
    @if (\Acelle\Model\Setting::get('site_favicon'))
      <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}"/>
    @else
      @include('layouts.core._favicon')
    @endif
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/main.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/fontawesome-all.min.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/meanmenu.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/style.css') }}">
    <style type="text/css">
     body {
             font-family: {{ ($job_design) ? $job_design->font_family:'DM Sans'}}, sans-serif !important;
        }

      h1, h2, h3, h4, h5, h6 {
          margin: 20px 5px 0;
      }
        #header-middlebar {
            background-image: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image) : 'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg' }});
            background-position: center;
            height: 160px;
            background-color: rgb(238, 238, 238);
            background-repeat: no-repeat;
        }
        #sitesmall{
              width: {{ ($logo_width) ? $logo_width:'100px'}};
              height: {{ ($logo_height) ? $logo_height:'auto'}};
        }
        /* Add custom styles here */
        .gallery-img {
            border-radius: 10px; /* Add border radius */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add shadow */
            transition: transform 0.2s ease-in-out;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        /* Adjust modal styles */
        .modal-content {
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        }
        .logo-mobile{
            width: 14%;
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
        .footer {
          background-color: #333;
          color: #fff;
          padding: 20px;
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
          /*margin-bottom: 25px;*/
          line-height: 1.7;
          box-sizing: border-box;
        }
        .post_excerpt p {
          margin: 0;
          line-height: 1.5em;
          font-size: 14px;
          color: #777;
        }
       .profile_read-more {
            text-transform: uppercase;
            margin-top: 20px;
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            bottom: 6px;
            right: 85px;
            color: {{ ($job_design) ? $job_design->link_color:'#fff'}} !important;
          }

          .post_read-more {
            text-transform: uppercase;
            margin-top: 20px;
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            bottom: 85px;
            right: 36px;
            color: {{ ($job_design) ? $job_design->link_color:'#fff'}} !important;
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
        .text-soft{
          color: #5daac3 !important;
          font-weight: bold;
          font-size: 1.2rem;
        }


    </style>
</head>

<body class="sticky-header">
 <div id="myElement" data-laravel-variable="{{ $sitelightlogo }}"></div>

    <div id="wrapper" class="wrapper">
        <!-- Add your site or application content here -->
        <!-- Header Area Start Here -->
        <header class="has-mobile-menu">
            <div id="header-middlebar" class="pt--29 pb--29 bg--light border-bootom border-color-accent2">
                <div class="container" style="height: 100px;display: grid;">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-4">
                            @if($job_design && $job_design->facebook || $job_design->instagram || $job_design->linkedIn || $job_design->twitter || $job_design->whatsApp )
                            <div class="header-action-items">
                                <ul>
                                    @if($job_design->facebook)
                                    <li class="item-social-layout2"> <a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                     @if($job_design->twitter)
                                    <li class="item-social-layout2"> <a href="#"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if($job_design->instagram)
                                    <li class="item-social-layout2"> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if($job_design->linkedIn)
                                    <li class="item-social-layout2"> <a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center">
                            <div class="logo-area" id="sitesmall">
                                <a href="{{url('/')}}" class="temp-logo" id="temp-logo">
                                    <img  src="{{$sitelightlogo}}" alt="{{$sitename}}" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="rt-sticky-placeholder"></div>
            <div id="header-menu" class="header-menu menu-layout1 bg--light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav id="dropdown" class="template-main-menu">
                                <ul>
                                    <li class="hide-on-mobile-menu">
                                        <a href="{{ url('/') }}">HOME</a>
                                    </li>
                                    <li class="hide-on-desktop-menu">
                                        <a href="{{ url('/') }}">HOME</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/blogs') }}">BLOG</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/service-providers') }}">SERVICE PROVIDERS</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/login') }}">Login</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>