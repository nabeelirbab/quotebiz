<?php
$sitename = \Acelle\Model\Setting::get("site_name");
$sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
$sitelightlogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
$logo_height = \Acelle\Model\Setting::get("logo_height");
$logo_width = \Acelle\Model\Setting::get("logo_width");
$job_design = Acelle\Jobs\HelperJob::form_design(); 

$subject = ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers';
if (isset($post)) {
  $title = \Acelle\Model\Setting::get("site_name"). ' - '.$subject.' - '.@$post->title;
  $image = @$post->image;
} else {
  $title = \Acelle\Model\Setting::get("site_name"). ' - '.$subject.' - Discover Exceptional '.$subject.' and Elevate Your Experience';
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
    <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite2.css?ver=2.9.1') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/fontawesome-all.min.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/meanmenu.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/blog/style.css') }}">
    <style type="text/css">
     body {
             color: #222 !important;
             font-family: {{ ($job_design) ? $job_design->font_family:'DM Sans'}}, sans-serif !important;
        }

        .close{
            font-size: 30px;
        }
        .flatpickr-calendar.inline{
            box-shadow: none !important;
        }
      h1, h2, h3, h4, h5, h6 {
          margin: 20px 5px 0;
      }
      h1, h2, h3, h4, h5, h6, p, span {
            font-family: {{ ($job_design) ? $job_design->font_family:'DM Sans'}}, sans-serif !important;
        }
        #header-middlebar {
           background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):asset('frontend-assets/images/default.jpg')}}) no-repeat rgb(238, 238, 238);
            background-position: center;
            height: 160px;
            background-color: rgb(238, 238, 238);
            background-repeat: no-repeat;
        }
        #sitesmall{
              max-width: {{ ($logo_width) ? $logo_width:'100px'}};
              height: {{ ($logo_height) ? $logo_height:'auto'}};
        }
        .social a {
           font-size: 25px;
           padding-left: 15px;
           color: {{ ($job_design) ? $job_design->button_text_color.'!important':'#6200EA !important'}};
          }
          #footer{
           background-color: {{ ($job_design) ? $job_design->footer_color.'!important':'#6200EA !important'}};
          }
          .footer {
            /*background-color: #333;*/
            color: #fff;
            padding: 20px;
          }
          .footer a{
              color: {{ ($job_design) ? $job_design->button_text_color:'#fff'}} !important;
            }

          .link-inline li {
            display: inline-block;
            margin-right: 5px; /* Adjust as needed for spacing */
            border-right: 2px solid #fff; /* Border color and style */
            padding-right: 10px; /* Adjust as needed for spacing */
          }

          .link-inline li:last-child {
              border-right: none; /* Remove border from the last item */
          }

          .terms {
            font-size: 10px;
            color: #0000009e;
            font-weight: 500;
          }
          .terms a {
            color: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
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
        .badge-info{
          color: #fff !important;
          background-color: {{ ($job_design) ? $job_design->link_color:'#fff'}} !important;
          border-color: {{ ($job_design) ? $job_design->link_color:'#fff'}} !important;
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
            /*font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.5;
            overflow: hidden;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;*/
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
            color: gray;
            cursor: pointer;
          }
        .profile_read-more:hover {
              background-color: #f2f2f2; /* Replace with your desired background color */
              color: gray; /* Change text color if needed */
              outline: none; /* Remove default focus outline if desired */
              padding: 0 7px;
              border-radius: 12px;
              font-size: 11px;
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
        p.form-para {
          font-size: 15px;
          font-weight: 500;
          color: #666666;
          line-height: 17px;
        }
        p.form-para::after {
          content: ".";
          font-size: 0;
          display: block;
          width: 8%;
          height: 4px;
          background: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
          margin: 10px 10px;
          transform: translateX(-10px);
        }
        .terms {
            font-size: 10px;
            color: #0000009e;
            font-weight: 600;
        }
        .pac-container {
            z-index: 1060 !important;
        }
        .select2-selection__rendered {
          line-height: 35px !important;
          color: #52648482 !important;
          font-size: 1.1rem;
        }
        .select2-container .select2-selection--single {
          height: 50px !important;
          border-radius: 6px;
          border: 1px solid #c1c1c1;
        }
        .select2-selection__arrow {
          height: 50px !important;
        }
        .form-group {
          position: relative;
          margin-bottom: 0.5rem;
        }
        .floatright {
         float: right;
        }
        .btn-primary {
          border: none !important;
          background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
          border: none !important;
          height: 38px !important;
          padding: 22px;
          line-height: 0;
          font-size: 13px;
        }
        .custom-control-label::after {
            position: absolute;
            top: 0.5rem;
            left: -2.2rem;
            display: block;
            width: 1.7rem;
            height: 1.7rem;
            content: "";
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 50% 50%;
        }
        .custom-control-label::before {
            position: absolute;
            top: 0.7rem;
            left: -2rem;
            display: block;
            width: 1.4rem;
            height: 1.4rem;
            pointer-events: none;
            content: "";
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #fff;
            border: 1px solid;
        }
        .btn-success {
          width: 100%;
          border: none !important;
          border-radius: 0.55rem;
          background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
          font-size: 1.5rem;
          height: 43px;
          font-weight: 500;
        }
        .form-control {
          border-radius: 6px;
          font-size: 1.6rem !important;
          outline: 0;
        }
        .form-control, div.dataTables_wrapper div.dataTables_filter input, .dual-listbox .dual-listbox__search {
          display: block;
          width: 100%;
          height: calc(4.9rem + 2px) !important;
          padding: 0.4375rem 1rem;
          font-size: 0.8125rem;
          font-weight: 400;
          line-height: 1.25rem;
          color: #3c4d62;
          background-color: #fff;
          background-clip: padding-box;
          border: 1px solid #c1c1c1;
          border-radius: 4px;
          transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }
      .modal-body{
        padding: 25px;
      }
        .select2-container--default.select2-container--open .select2-selection--single {
          border-color: {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}} !important;
        }
        .select2-container--default .select2-selection--single:focus {
          box-shadow: none;
          border-radius: 6px;
          border: 1px solid {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
        }
        .form-control:focus {
          box-shadow: none;
          border-radius: 6px;
          border: 1px solid {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
        }
        .form-control-placeholder {
          font-weight: 500;
          color: #364a63;
          margin-bottom: 8px;
        }
        .form-control:focus + .form-control-placeholder,
        .form-control:valid + .form-control-placeholder {
          font-size: 60%;
          transform: translate3d(0, -75%, 0);
          border-radius: 6px;
          opacity: 1;
          top: 12px;
        }
        @media only screen and (max-width: 768px) {
            
            .profile_read-more{
              right: 36%;
            }

        }
       /* .item-social-layout2 a{
           color: {{ ($job_design) ? $job_design->button_text_color.'!important':'#333 !important'}};
        }
*/

    </style>
</head>

<body class="sticky-header">
 <div id="myElement" data-laravel-variable="{{ $sitesmalllogo }}"></div>

    <div id="wrapper" class="wrapper">
        <!-- Add your site or application content here -->
        <!-- Header Area Start Here -->
        <header class="has-mobile-menu">
            @if(Request::segment(1) == 'sp-profile')
            <div id="header-middlebar" class="pt--29 pb--29 bg--light border-bootom border-color-accent2">
                <div class="container" style="height: 100px;display: grid;">
                    <div class="row align-items-center  d-flex justify-content-center">
                       
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
            @endif
            <div id="header-menu" class="header-menu menu-layout1 bg--light">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-2 d-flex " style="align-items: center;">
                            @if(Request::segment(1) != 'sp-profile')
                            <div class="logo-area d-flex"style="align-content: center;" >
                                <a href="{{url('/')}}" class="temp-logo" id="temp-logo">
                                    <img  src="{{$sitesmalllogo}}" alt="{{$sitename}}" id="sitesmall" class="img-fluid">
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-7" style="display: flex;justify-content: center;align-items: center;">
                            <nav id="dropdown" class="template-main-menu">
                                <ul>
                                    <li class="hide-on-mobile-menu">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="hide-on-desktop-menu">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                     @if($job_design && $job_design->profile_status != '2')
                                    <li>
                                        <a href="{{ url('/service-providers') }}">{{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }}</a>
                                    </li>
                                    @endif
                                    @if($job_design && $job_design->blog_status != '2')
                                    <li>
                                        <a href="{{ url('/blogs') }}">BLOG</a>
                                    </li>
                                    @endif
                                   
                                    @if(Auth::user())
                                      @if(Auth::user()->user_type == 'client' || Auth::user()->user_type == 'admin')
                                         <li>
                                            <a  href="{{ Auth::user()->user_type == 'client' ? url('/customer') : url('/admin') }}">Dashboard</a>
                                         </li>
                                        @else
                                          <li>
                                            <a  href="{{ url('/service-provider') }}">Dashboard</a>
                                          </li>
                                          @endif
                                         @else
                                         <li>
                                            <a href="{{ url('/users/login') }}">Login</a>
                                         </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                         <div class="col-lg-3 d-flex justify-content-end">
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
                    </div>
                </div>
            </div>
        </header>