@extends('layouts.core.frontend')

@section('title', 'Form Design')

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    
@endsection

@section('content')

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

 ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Edit application settings</h3>
                <div class="nk-block-des text-soft">
                    <p>Form deisgn for quote page</p>
                </div>
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                 <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
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
                     <textarea type="text" name="site_description" class="form-control required ">{{$sitedesc}}</textarea>  </div>
                     </div>
                    <div class="col-sm-12 text-center mt-5">
                        <button class="btn btn-success btn-lg" type="submit">@if($sitesetting) Update @else Save @endif</button>
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
@section('script')

<script type="text/javascript">
  imgfavicon.onchange = evt => {
  const [file] = imgfavicon.files
  if (file) {
    sitefavicon.src = URL.createObjectURL(file)
  }
}

  imglarge.onchange = evt => {
  const [file] = imglarge.files
  if (file) {
    sitelarge.src = URL.createObjectURL(file)
  }
}

  imgsmall.onchange = evt => {
  const [file] = imgsmall.files
  if (file) {
    sitesmall.src = URL.createObjectURL(file)
  }
}
</script>
@endsection