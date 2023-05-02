<?php
$sitename = \Acelle\Model\Setting::get("site_name");
$sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
$sitelightlogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
$job_design = Acelle\Jobs\HelperJob::form_design(); 
if (isset($post)) {
  $title = $post->title;
  $image = asset('frontend-assets/images/posts/' . $post->cover_img);
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
        .single-blog-banner-layout1 .banner-content .item-social li .linkedin {
            background-color: #0A66C2;
        }
        .blog-box-layout5 {
          height: 320px; /* Set a fixed height for the container */
          display: flex; /* Use flexbox to make sure the image and content divs are the same height */
          flex-direction: column;
          justify-content: space-between;
        }

        .blog-box-layout5 .item-img {
           flex: 1;
            position: relative;
            max-height: 280px;
            overflow: hidden;
            min-height: 250px;
            margin: 0;
            align-items: center;
            text-align: center;
            display: flex;
            background: white;
            border-radius: 9px; 
        }

        .blog-box-layout5 .item-img img {
          object-fit: cover; /* Make the image fill the container */
          height: 100%; /* Make sure the image takes up the full height of the container */
          width: 100%; /* Make sure the image takes up the full width of the container */
        }
        .blog-box-layout5 .item-img a {
            display: initial !important;
        }

        .blog-box-layout5:hover .item-img .hover-icon {
          opacity: 1; /* Show the hover icon on hover */
        }

        .blog-box-layout5 .item-content {
          flex: 0 0 auto; /* Make the content div take up only the necessary space */
          height: 120px;
        }

        .blog-box-layout5 .entry-meta,
        .blog-box-layout5 .item-title {
          margin: 0;
          padding: 0 10px;
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
</head>

<body class="sticky-header">
 
    <div id="wrapper" class="wrapper">
        <!-- Add your site or application content here -->
        <!-- Header Area Start Here -->
        <header class="has-mobile-menu">
            <div id="header-middlebar" class="pt--29 pb--29 bg--light border-bootom border-color-accent2">
                <div class="container">
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
                            <div class="logo-area">
                                <a href="{{url('/')}}" class="temp-logo" id="temp-logo">
                                    <img  src="{{$sitesmalllogo}}" alt="{{$sitename}}" class="img-fluid">
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
                                        <a href="{{ url('/posts') }}">BLOG</a>
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