<?php
  $sitename = \Acelle\Model\Setting::get("site_name");
  $sitetitle = \Acelle\Model\Setting::get("site_title");
  $sitetagline = \Acelle\Model\Setting::get("site_tagline");
  $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country);
  $job_design = Acelle\Jobs\HelperJob::form_design(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:title" content="{{ $sitename }} | {{$sitetitle}} | {{$sitetagline}} ">
<meta property="og:description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
@if (\Acelle\Model\Setting::get('site_favicon'))
<meta property="og:image" content="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}">
@else
<meta property="og:image" content="{{ URL::asset('favicon/favicon-32x32.png') }}">
@endif
<meta name="description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
<meta name="keywords" content="{{ \Acelle\Model\Setting::get("site_keyword") }}" />
<meta name="php-version" content="{{ phpversion() }}" />
<meta name="apple-mobile-web-app-title" content="{{ \Acelle\Model\Setting::get("site_name") }}" />
<meta name="application-name" content="{{ \Acelle\Model\Setting::get("site_name") }}" />
@if(\Acelle\Model\Setting::get("meta_tag"))
{!! \Acelle\Model\Setting::get("meta_tag") !!}
@endif
<link rel="canonical" href="{{ url()->current() }}" />
<title>{{ $sitename }} | {{$sitetitle}} | {{$sitetagline}}</title>
@if (\Acelle\Model\Setting::get('site_favicon'))
  <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}"/>
@else
  @include('layouts.core._favicon')
@endif
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite2.css?ver=2.9.1') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<script async rel="preload" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5462023016685790"
     crossorigin="anonymous"></script>

<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Open+Sans:wght@400;700&display=swap');
body {
background: #fff;
}


/*
.container {
  margin-bottom: 50px;
}*/
.navbar-set{
  display: flex;
  justify-content: space-between;
}
.main-hearder{
  margin-bottom: 10vh;
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
.terms{
  font-size: 10px;
  color: #0000009e;
  font-weight: 500;
}
.terms a{
  color: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
}
.siteLogo{
  max-width: 9%;
}
.login{
color: {{ ($job_design) ? $job_design->login_color:'#6200EA'}};
}
/*.col-md-4 {
  background: #F9F8F4;
  text-align: center;
  border-radius: 12px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}*/

.logo {
  text-align: left !important;
  transform: translate(-40px, 20px);
  font-weight: 1000 !important;
  font-size: 8px !important;
  font-family: 'Abril Fatface', cursive !important;
}

.logo span {
  font-size: 20px;
}

.image {
  margin-top: 44%;
}

h6.mt-3 {
  font-weight: bold;
}

.col-md-4 p {
  font-size: 12px;
  line-height: 15px;
  padding: 0 60px 0 60px;
  color: #0000009e;
  font-weight: 500;
}

.formclass {
  background: rgba(255, 255, 255, 0.8);
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
}
p.mb-0 {
  font-size: 10px;
  font-weight: bold;
  color: #9f9f9f;
}
strong {
  font-size: 12px;
}
.fa-phone-volume {
  margin-right: 4px;
  font-size: 12px;
}
.fs-1 {
  font-size: 16px;
  color: {{ ($job_design) ? $job_design->button_text_color:'#fff'}};
}
h4.form-heading {
  font-weight: bold;
  font-size: 28px !important
}
p.form-para {
  font-size: 15px;
  font-weight: 500;
  color: #9f9f9f;
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
.form-group {
  position: relative;
  margin-bottom: 0.5rem;
}
.floatright {
 float: right;
}
.form-control {
  border-radius: 6px;
  font-size: 1.1rem;
  outline: 0;
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
.footer a{
  color: {{ ($job_design) ? $job_design->button_text_color:'#fff'}} !important;
}

.form-control-placeholder {
  font-size: 1.1rem;
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
.btn-primary {
  border: none !important;
  background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
  height: 46px !important;
}
.terms {
  font-size: 10px;
  color: #0000009e;
  font-weight: 500;
}
.terms a {
  color: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
}
.siteLogo img {
  width: 100%;
}
.login {
  color: {{ ($job_design) ? $job_design->login_color:'#6200EA'}};
}
@media screen and (max-width: 667px) {
  .container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    width: 96%;
}
.social{
  float: none !important;
}
.main-hearder{
  margin-bottom: 5vh;
}
  .btn-primary {
    border: none !important;
    background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
    height: 46px !important;
    padding: 10px;
}
.navbar-set{
  display: block;
  justify-content: space-between;
}
.mycol1 {
  border-radius: 0;
  border-top-right-radius: 12px;
  border-top-left-radius: 12px;
  padding: 50px 50px 50px 50px;
}
.floatright {
  float: none;
  text-align: center;
}
.image {
  margin-top: 0;
}
.mycol2 {
  border-radius: 0;
  border-bottom-right-radius: 12px;
  border-bottom-left-radius: 12px;
  text-align: center;
  padding-bottom: 40px;
}
.form-group {
  margin: 10px 10px 0 10px;
}
.logo {
  transform: translate(-90px, -30px);
}
.siteLogo {
  float: none;
  text-align: center;
  margin-bottom: 30px;
  max-width: 100%;
}
.siteLogo img {
  width: 40%;
}
.dogcFe {
  background-size: cover !important;
  width: 100%;
  height: 100% !important;
  -webkit-box-align: start;
  align-items: start;
  -webkit-box-pack: center;
  justify-content: center;
  /*min-height: 650px;*/
  max-height: 1500px;
  position: relative;
  margin: 0px 0px 0px;
  background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);
}
}
@media screen and (min-width: 1200px) {
.form-group {
  margin-bottom: 0.5rem;
}
}
.centered-text {
  text-align: center;
}
.social{
  float: right;
}
.social a {
 font-size: 25px;
 color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
}
#footer{
 background-color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
}
.dogcFe {
  background-size: cover !important;
  width: 100%;
  height: 100vh;
  -webkit-box-align: start;
  align-items: start;
  -webkit-box-pack: center;
  justify-content: center;
  /*min-height: 650px;*/
  max-height: 1500px;
  position: relative;
  margin: 0px 0px 0px;
  background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);
}
#result {
  position: absolute;
  z-index: 2;
  width: 100%;
  max-height: 285px;
  overflow: auto;
}
#result li {
  cursor: pointer;
}
.blog-box-layout5 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-radius: 9px 9px 9px 9px;
    box-shadow: 0 0 10px 0 rgba(0,0,0,.15);
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
@media (min-width: 768px) {
  .text-md-end {
    text-align: right;
  }
}
.logo-img {
    max-height: 50px;
}

</style>
</head>
<body>
<div class="container-fluid dogcFe">
<header class="main-hearder">
<nav class="navbar navbar-expand-lg navbar-light" style="display: contents;">
<div class="navbar-set">
<div class="siteLogo">
   <img class="mt-4" id="sitesmall" src="{{$sitesmalllogo}}" alt="{{$sitename}}">
</div>
@if(Auth::user())
@if(Auth::user()->user_type == 'client')

<div class="mt-4 text-center">
  @if($job_design->blog_status != '2')
  <a href="{{ url('/blogs') }}" class="fs-1 mr-4 login"><b>Blog</b></a>
  @endif
<a href="{{ url('/customer') }}" class="btn btn-primary btn-lg">Dashboard</a>
</div>
@elseif(Auth::user()->user_type == 'admin')
<div class="mt-4 text-center">
  @if($job_design->blog_status != '2')
  <a href="{{ url('/blogs') }}" class="fs-1 mr-4 login"><b>Blog</b></a>
  @endif
<a href="{{ url('/admin') }}" class="btn btn-primary btn-lg">Dashboard</a>
</div>
@else
<div class="mt-4 text-center">
  @if($job_design->blog_status != '2')
  <a href="{{ url('/blogs') }}" class="fs-1 mr-4 login"><b>Blog</b></a>
  @endif
<a href="{{ url('/service-provider') }}" class="btn btn-primary btn-lg">Dashboard</a>
</div>
@endif
@else
<div class="mt-4 text-center">
  @if($job_design->blog_status != '2')
  <a href="{{ url('/blogs') }}" class="fs-1 mr-4 login"><b>Blog</b></a>
  @endif
<a href="{{ url('/users/login') }}" class="fs-1 mr-4 login"><b>Log in</b></a>
<a href="{{ url('/users/register') }}" class="btn btn-primary btn-lg">Register Business</a>
</div>
@endif
</div>
</nav>
</header>
<div class="container">
<div class="row justify-content-{{($job_design) ? $job_design->position : 'end'}}"
style="height: 100%;align-items: center;">
<div class="col-lg-7 col-md-8 col-sm-10 formclass" style="box-shadow: -1px -1px 13px 7px rgba(0,0,0,0.27);border-radius: 12px">
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{$errors->first()}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($job_design && $job_design->no_status == '1')
<div class="d-flex pt-3 pr-2">
<p class="ml-auto mb-0">Want to speak with an agent?</p>
</div>
<div class="d-flex pr-2">
<p class="ml-auto"><strong><i class="fas fa-phone-volume"></i>{{$job_design->agent_no}}</strong></p>
</div>
@endif
<form class="information" action="{{ url('quote-form')}}" method="post" style="padding: 0.5rem "
autocomplete="off">
{{ csrf_field()}}
<h3 class="form-heading">
{{ ($job_design) ? $job_design->title_heading : 'What are you looking for?'}}</h3>
<p class="form-para">
{{ ($job_design) ? $job_design->titlesub_heading : 'Let us know what you are looking for and we will provide you up to 3 quotes.'}}
</p>
<div class="row">
<div class="col-md-6">
<div class="form-group">
  <label class="form-control-placeholder"
         for="search">{{ ($job_design) ? $job_design->category_heading : 'What service do you need?'}}</label>
  @if($job_design && $job_design->search_box == 'auto_suggest')     
  <input type="text" class="form-control" name="category_name" id="search"
         placeholder="eg {{Acelle\Jobs\HelperJob::categoryDetail(Acelle\Jobs\HelperJob::categoryname())->category_name}}... etc"
         required>
  <ul class="list-group" id="result">
  </ul>
  @else
  <select class="form-control select2" name="category_name" style="height: 200px" required="">
     <option value="" disabled selected="">Select Service</option>
     @foreach(Acelle\Jobs\HelperJob::allcategories() as $category) 
     <option>{{$category->category_name}}</option>
     @endforeach
  </select>
  @endif
</div>
</div>
<div class="col-md-6">
<div class="form-group">
 <label class="form-control-placeholder" for="zipcode">{{ ($job_design) ? $job_design->postcode_text : 'Where you need ?'}}</label>
  <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Location"
         required>
  @if(Session::has('error'))
      <strong style="color: red">Location Error : <span>{{Session::get('error')}}</span></strong>
  @endif
  <div class="custom-control custom-control-sm custom-checkbox notext mt-2">
    <input type="checkbox" class="custom-control-input" id="local_business"
           name="local_business" value="local business">
    <label class="custom-control-label" for="local_business" style="font-size: 13px;color: #9f9f9f;">I prefer a local business</label>
  </div>
  <input type="hidden" id="latitude" name="latitude">
  <input type="hidden" id="longitude" name="longitude">
  <input type="hidden" id="state" name="state">
</div>
</div>
<div class="col-md-5">
<div class="form-group">
  <button type="submit" class="btn rounded-2 btn-primary d-block login-button py-2 fw-600 w-100"><span style="font-size: 17px">{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}<i
                    class="fa fa-arrow-right"></i></span></button>
</div>
</div>
</div>
<p class="terms mt-4">By clicking "{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}",
you consent to the {{$sitename}} storing the information submitted on this page so you can get most
up-to-date quotes, no matter what device you are using. You also agree to The {{$sitename}}'s
 <a href="#" data-toggle="modal" data-target="#terms">Terms of Service</a> and 
 <a href="#" data-toggle="modal" data-target="#privacy">Privacy Policy.</a>
</p>
</form>
@if($job_design && $job_design->facebook || $job_design->instagram || $job_design->linkedIn || $job_design->twitter || $job_design->whatsApp )
<div class="centered-text">
  <div class="social">
  @if($job_design->facebook)
  <a href="{{$job_design->facebook}}" target="_blank"><em class="icon ni ni-facebook-fill"></em></a>
  @endif
  @if($job_design->instagram)
  <a href="{{$job_design->instagram}}" target="_blank"><em class="icon ni ni-instagram-round"></em></a>
  @endif
  @if($job_design->linkedIn)
  <a href="{{$job_design->linkedIn}}" target="_blank"><em class="icon ni ni-linkedin-round"></em></a>
  @endif
  @if($job_design->twitter)
  <a href="{{$job_design->twitter}}" target="_blank"><em class="icon ni ni-twitter-round"></em></a>
  @endif
  @if($job_design->whatsApp)
  <a href="{{$job_design->whatsApp}}" target="_blank"><em class="icon ni ni-whatsapp-round"></em></a>
   @endif
  </div>
</div>
@endif
</div>
<!-- Terms Modal -->
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Terms of Service</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
@if($job_design)
{{$job_design->terms}}
@endif
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- Privacy Modal -->
<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
@if($job_design)
{{$job_design->privacy_policy}}
@endif
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
@if($posts && $job_design->blog_status != '1' && $job_design->blog_status != '2')
<div class="container mt-5 mb-5">
  <div class="row">
    <div class="d-flex col-12 justify-content-between pt-5 pb-2">
      <h4>Featured Blogs</h4>
      <a href="{{ url('blogs') }}">View All</a>
    </div>
  </div>
  <div class="row" style="margin-bottom: 100px">
    @foreach($posts as $post)
    <div class="col-lg-4 col-sm-12 mb-4 mt-4">
        <div class="blog-box-layout5">
            <div class="item-img">
                <a href="{{ url('/blog/'.$post->slug) }}">
                  <img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="Blog">
                </a>
            </div>
            <div class="post_text">
              <div class="item-content">
                  <a href="{{ url('blog/'.$post->slug) }}">
                    <h1 class="item-title">
                        {{$post->title}}
                    </h1>
                  </a>
              </div>
              <div class="post_excerpt">
                <p>
                  {!! clean(Str::limit($post->description, 150)) !!}
                </p>
              </div>
              <a href="{{ url('blog/'.$post->slug) }}" class="post_read-more">Read More >></a>
            </div>
            <div class="post_meta-data">
             <span class="post-date"> {{$post->created_at->format('F d, Y')}} </span>
           </div>
        </div>
    </div>
    @endforeach
</div>
</div>
<footer class="footer bg-indigo is-dark bg-lighter" id="footer">
    <div class="container">
        <div class="row g-3 align-items-center py-3">
            <div class="col-md-1">
                <div class="">
                    <a href="{{ url('/') }}" class="logo-link">
                        <img class="logo-light logo-img" src="{{$sitesmalllogo}}" alt="{{$sitename}}" srcset="./images/logo2x.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="{{$sitesmalllogo}}" alt="{{$sitename}}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div><!-- .footer-logo -->
            </div><!-- .col -->
            <div class="col-md-4">
                <div class="text-base"><a href="">Copyright &copy; {{date("Y")}} {{$sitename}}.</a></div>
            </div><!-- .col -->
            <div class="col-md-7 d-flex justify-content-md-end">
                <ul class="link-inline gx-4">
                    <li><a href="#">How it works</a></li>
                    <li><a href="#">Service</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul><!-- .footer-nav --> 
            </div><!-- .col -->
        </div>
        
</footer><!-- .footer -->
@endif
</body>
<script rel="preload" src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script rel="preload" src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<script rel="preload" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script rel="preload" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBNL_1BSqiKF5qf0WqLbMT4xF1dB1Aux1M&libraries=places"></script>
<script type="text/javascript">
$('.select2').select2({ width: '300px', dropdownCssClass: "bigdrop" });
$.ajaxSetup({cache: false});
$('#search').keyup(function () {
$('#result').html('');
if ($('#search').val()) {
var _token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
url: "{{ url('category-search')}}",
type: "post",
data: {category_name: $('#search').val(), _token: _token},
success: function (response) {
console.log(response);
$('#result').html(response);
},
error: function (xhr) {
}
});
}
});
$('#result').on('click', 'li', function () {
var click_text = $(this).text();
$('#search').val($.trim(click_text));
$("#result").html('');
});
</script>
@if($provideradminlocation->admin_location_type == "World Wide")
<script>
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize() {
  var input = document.getElementById('zipcode');
  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.addListener('place_changed', function () {
  var place = autocomplete.getPlace();
  var components = place.address_components;
  $("#latitude").val(place.geometry['location'].lat());
  $("#longitude").val(place.geometry['location'].lng());
  for(i=0;i<components.length;i++){
  if(place.address_components[i].types[0].toString() === 'administrative_area_level_1'){
  var state = place.address_components[i].long_name;
  console.log(state);
  $("#state").val(state);
  }
  }
  });
  }
</script>
@else
<script>

	@if($providercountry)
	var pc = "{{ $providercountry->code }}";
	@else 
    var pc = 'au';
  @endif
  var loc = pc.toLowerCase();
  google.maps.event.addDomListener(window, 'load', initialize);

  function initialize() {
  var options = {
  componentRestrictions: {country: loc}
  };
  var input = document.getElementById('zipcode');
  var autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.addListener('place_changed', function () {
  var place = autocomplete.getPlace();
    var components = place.address_components;
  $("#latitude").val(place.geometry['location'].lat());
     $("#longitude").val(place.geometry['location'].lng());
  for(i=0;i<components.length;i++){
    console.log(place.address_components[i].types[0].toString());
  if(place.address_components[i].types[0].toString() === 'administrative_area_level_1'){
  var state = place.address_components[i].long_name;
  console.log(state);
  $("#state").val(state);
  }
  }
  });
  }
</script>
@endif
</html>