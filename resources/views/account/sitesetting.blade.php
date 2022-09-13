@extends('layouts.core.frontend')

@section('title', 'Site Setting')

@section('page_header')

<div class="page-title">
<ul class="breadcrumb breadcrumb-caret position-right">
<li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('messages.home') }}</a></li>
<li class="breadcrumb-item active">Site Setting</li>
</ul>
<h1>
<span class="text-semibold"><span class="material-icons-round">
person_outline
</span> {{ Auth::user()->displayName() }}</span>
</h1>
</div>
@endsection
@section('content')
@include("account._menu")
<?php

$sitename = '';
$sitekeyword = '';
$sitedesc = '';
$sitesmalllogo = '';
$sitelargelogo = '';
$sitefavicon = '';

$sitename = \Acelle\Model\Setting::get("site_name");
$sitekeyword = \Acelle\Model\Setting::get("site_keyword");
$sitedesc = \Acelle\Model\Setting::get("site_description");
$sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
$sitelargelogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
$sitefavicon = action('SettingController@file', \Acelle\Model\Setting::get('site_favicon'));
$sitedarklogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));


 ?>

	<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">Edit application settings</h3>
               
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
   <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                 <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4" style="padding: 45px;">
                   <div class="col-sm-10">
                    <div class="row">
                    <div class="col-sm-6 mb-4">
                      <input type="hidden" name="id" @if($sitesetting) value="{{$sitesetting->id}}" @endif>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site name <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$sitename}}" name="site_name" id="default-01" placeholder="Enter main heading" required>
                            </div>
                        </div>
                      </div>
                       <div class="col-sm-6  mb-3">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site keyword <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$sitekeyword}}" name="site_keyword" id="default-01" placeholder="Enter sub heading" required>
                            </div>
                        </div>
                      </div>
                       <div class="col-sm-6  mb-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site logo (small) <span class="text-danger">*</span></label>
                            <div class="row">
                              <div class="col-sm-9">
                                <div class="form-control-wrap">
                                <input accept="image/*" type='file' id="imgsmall" class="form-control"  name="site_smalllogo">
                            </div>
                              </div>
                              <div class="col-md-3">
                              <img style="background-color: #ccc" id="sitesmall" width="100%" src="{{$sitesmalllogo}}">
                             </div>
                            </div>
                            
                        </div>
                      </div>
                      <div class="col-sm-6  mb-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site logo (large) <span class="text-danger">*</span></label>
                            <div class="row">
                              <div class="col-sm-9">
                                <div class="form-control-wrap">
                                <input accept="image/*" type='file' id="imglarge" class="form-control"  name="site_largelogo">
                            </div>
                              </div>
                              <div class="col-md-3">
                              <img style="background-color: #ccc " id="sitelarge" width="100%" src="{{$sitelargelogo}}">
                             </div>
                            </div>
                            
                        </div>
                      </div>

                      <div class="col-sm-6  mb-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site logo (dark) <span class="text-danger">*</span></label>
                            <div class="row">
                              <div class="col-sm-9">
                                <div class="form-control-wrap">
                                <input accept="image/*" type='file' id="imglarge" class="form-control"  name="site_logo_dark">
                            </div>
                              </div>
                              <div class="col-md-3">
                              <img style="background-color: #ccc " id="sitelarge" width="100%" src="{{$sitedarklogo}}">
                             </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6  mb-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site favicon <span class="text-danger">*</span></label>
                            <div class="row">
                              <div class="col-sm-9">
                                <div class="form-control-wrap">
                                <input accept="image/*" type='file' id="imgfavicon" class="form-control"  name="site_favicon" >
                            </div>
                              </div>
                              <div class="col-md-3">
                              <img style="background-color: #ccc " id="sitefavicon" width="100%" src="{{$sitefavicon}}">
                             </div>
                            </div>
                            
                        </div>
                      </div>
                     <div class="col-md-6">
                      <div class="form-group control-textarea">
                      <label class="form-label"> Site description
                            <span class="text-danger">*</span>
                      </label>
                     <textarea type="text" name="site_description" rows="10" class="form-control required ">{{$sitedesc}}</textarea>  </div>
                     </div>
                    <div class="col-sm-12 text-center mt-5">
                        <button class="btn btn-success btn-lg" type="submit">@if($sitesetting) Update @else Save @endif</button>
                        @if($sitesetting)
                        <a href="{{ url('admin/removesetting') }}" onclick="return confirm('Are you sure you want to reset setting?');" class="btn btn-warning btn-lg" > Default Setting </a>
                        @endif
                       <!--  <input type="submit" class="btn btn-default btn-lg" name="preview" value="Preview" type="submit"> -->
                    </div>
                </div>
                </div>
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->

</div>
@endsection
