@extends('layouts.core.frontend')

@section('title', 'Site Setting')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.css" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css" />
 <style type="text/css">
   .leftbar .page-container {
    position: relative;
    width: 100%!important;
    max-width: 90% !important;
    padding-left: 265px!important;
    padding-right: 3px!important;
    padding-top: 10px!important;
    min-height: 100vh;
  }
   .nav-item.dropdown {
      width: 100%;
  }
   @media screen and (max-width: 767px) {
  .leftbar .page-container {
    position: relative;
    width: 100%!important;
    max-width: 100% !important;
    padding-left: 5px!important;
    padding-right: 5px!important;
    padding-top: 10px!important;
    min-height: 100vh;
    margin-top: 30px;
}
}
  .card-body{
    font-family: arial,sans-serif;
   }
   .card-body h5{
    font-family: arial,sans-serif;
   }
   .card-body span{
    font-family: arial,sans-serif;
   }
  .card-title{
    font-family: arial,sans-serif;
    font-size: 20px;
    font-weight: 400;
  }
  .card-text{
    font-family: arial,sans-serif;
    font-size: 14px;
  }
  .image-container {
  width: 30px; /* set the width of the container */
  height: 30px; /* set the height of the container */
  position: relative; /* set the position property to relative */
}

.image-container img {
  position: absolute; /* set the position property to absolute */
  top: 0; /* set the top property to 0 */
  left: 0; /* set the left property to 0 */
  max-width: 100%; /* set the max-width property to 100% */
  height: auto; /* set the height property to auto */
}


 </style>
@endsection
@section('content')
<?php

$sitename = '';
$sitekeyword = '';
$sitetitle = '';
$sitetagline = '';
$logo_width = '';
$logo_height = '';
$sitedesc = '';
$sitesmalllogo = '';
$sitelargelogo = '';
$sitefavicon = '';

$sitename = \Acelle\Model\Setting::get("site_name");
$sitekeyword = \Acelle\Model\Setting::get("site_keyword");
$sitetitle = \Acelle\Model\Setting::get("site_title");
$sitetagline = \Acelle\Model\Setting::get("site_tagline");
$logo_width = \Acelle\Model\Setting::get("logo_width");
$logo_height = \Acelle\Model\Setting::get("logo_height");
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
                <h4 class="nk-block-title page-title">Logo</h3>
               
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
   <div class="card card-preview">
    @include("design._menu")
    
        <div class="card-inner">
            <div class="preview-block">
                
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                 <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   <div class="col-sm-10">
                  
                    <div class="row">
                  
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
                     
                      <div class="col-md-6  mb-4">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                            <label class="form-label" for="default-01">Logo Width</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$logo_width}}" name="logo_width"  placeholder="Enter Logo Width In px" >
                            </div>
                           </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                            <label class="form-label" for="default-01">Logo Height</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$logo_height}}" name="logo_height"  placeholder="Enter Logo Height In px" >
                            </div>
                           </div>
                          </div>

                        </div>
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
