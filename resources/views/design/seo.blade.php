@extends('layouts.core.frontend')

@section('title', 'Form Design')

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
<?php $formdesign = Acelle\Jobs\HelperJob::form_design(); ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">SEO Setting</h3>
                <div class="nk-block-des text-soft">
                    <p>By providing links to your social media accounts, you can encourage shoppers to follow you and share your business and products with their friends.</p>
                </div>
            </div><!-- .nk-block-head-content -->
          
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
    @include("design._menu")
      
        @if(Session::has('success'))
         <div class="alert alert-success  fade show" role="alert">
          {{Session::get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     @endif
        <div class="card-inner">
            <div class="preview-block">
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                 <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-8">
                   
                    <div class="row">
                    <div class="col-md-12  mb-4">
                      <label class="form-label"> Preview as
                            <span class="text-danger">*</span>
                      </label>
                     <div class="card" style="border-radius: 6px">
                       <div class="card-body" style="font-family: arial;">
                        <div class="d-flex justify-content-start">
                          <div class="image-container mr-3">
                           <img id="sitefavicon" src="{{$sitefavicon}}" style="width: 30px;">
                          </div>
                          <div>
                          <h5 class="mb-0">{{$sitename}}</h5>
                          <span>{{request('account')}}</span>
                          </div>
                        </div>
                         <a href="" ><h2 class="card-title mt-1" style="font-size: 20px;font-weight: 400">{{$sitename}} | {{$sitetitle}} | {{$sitetagline}}</h2></a>
                         <p class="card-text">{{$sitedesc}}</p>
                       </div>
                     </div>
                     </div>
                      <div class="mb-2 mt-3">
                       <span class="text-danger">NOTE: Site Title | Page Title | Tagline should typically be between 50-60 characters long, including spaces</span>
                    </div>
                   <div class="col-sm-4 mb-4">
                      <input type="hidden" name="id" @if($sitesetting) value="{{$sitesetting->id}}" @endif>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Site Title <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$sitename}}" name="site_name"  placeholder="Enter Site Title" required>
                            </div>
                        </div>
                      </div>
                        <div class="col-sm-4 mb-4">
                     
                        <div class="form-group">
                            <label class="form-label" for="default-01">Home Page Title <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$sitetitle}}" name="site_title"  placeholder="Enter Home Page Title" required>
                            </div>
                        </div>
                      </div>
                          <div class="col-sm-4 mb-4">
                      
                        <div class="form-group">
                            <label class="form-label" for="default-01">Tagline<span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$sitetagline}}" name="site_tagline"  placeholder="Enter Tagline" required>
                            </div>
                        </div>
                      </div>
                    
                   <div class="col-md-12">
                      <div class="form-group control-textarea">
                      <label class="form-label"> Meta Description <span class="text-danger">(should be between 50-155 characters)</span>
                            <span class="text-danger">*</span>
                      </label>
                     <textarea type="text" name="site_description" rows="20" class="form-control required ">{{$sitedesc}}</textarea>  </div>
                     </div>
                    <div class="col-sm-12  mb-3">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Keywords <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$sitekeyword}}" name="site_keyword"  placeholder="Enter Keywords" required>
                            </div>
                        </div>
                      </div>
                    </div>
                   
                        <div class="text-center">
                        <button class="btn btn-success btn-lg" type="submit">@if($formdesign) Update @else Save @endif</button>
                       <!--  <input type="submit" class="btn btn-default btn-lg" name="preview" value="Preview" type="submit"> -->
                    </div>
                  
                </div>
              </div>
              </form>
            </div>
        </div>
  </div>
    </div><!-- .card-preview -->
    <!-- The Modal -->
     <div id = "modal" class = "modal">
       <div class = "modal-background"></div>
       <div class="modal-content" style="width: 76%;">
      <p class="text-center">
        <img src="{{asset('frontend-assets/images/demo.png')}}" alt="" style="height: 654px;">
      </p>
    </div>
       <button class = "modal-close is-large" aria-label = "close"></button>
    </div> 
@endsection
@section('script')

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js" integrity="sha512-94dgCw8xWrVcgkmOc2fwKjO4dqy/X3q7IjFru6MHJKeaAzCvhkVtOS6S+co+RbcZvvPBngLzuVMApmxkuWZGwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
          $(document).ready(function() {
        $('.js-example-basic-single').select2({
            templateResult: formatFont,
            templateSelection: formatFontSelection,
        });
        
        function formatFont(font) {
            if (!font.id) {
                return font.text;
            }

            return $(
                `<div style="font-family: ${font.text} !important;">${font.text}</div>`
            );
        }

        function formatFontSelection(font) {
            return $(`<div style="font-family: ${font.text} !important;">${font.text}</div>`);
        }
    });
       $(".modal-button").click(function() {
            var target = $(this).data("target");
            $("html").addClass("is-clipped");
            $(target).addClass("is-active");
         });
         
         $(".modal-close").click(function() {
            $("html").removeClass("is-clipped");
            $(this).parent().removeClass("is-active");
         });
  $(function () {
    $('#cp0, #cp1, #cp2').colorpicker({
        format: 'hex',
    });
  });
</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  $("input[name$='no_status']").click(function() {
        var val = $(this).val();
        var html = '<div class="col-md-6 col-sm-6">'+
                        '<div class="form-group">'+
                          '<label class="form-label" for="default-01">Business No</label>'+
                          '<div class="form-control-wrap">'+
                          '<input type="text" class="form-control" @if($formdesign && $formdesign->business_no) value="{{$formdesign->business_no}}" @else value="{{Auth::user()->customer->getContact()->phone}}" @endif name="business_no" id="default-01" placeholder="Enter business phone number" required>'+
                         '</div>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6 col-sm-6">'+
                      '<div class="form-group">'+
                     '<label class="form-label" for="default-01">Agent No</label>'+
                    '<div class="form-control-wrap">'+
                    '<input type="text" class="form-control" @if($formdesign && $formdesign->agent_no) value="{{$formdesign->agent_no}}" @else value="{{Auth::user()->customer->getContact()->phone}}" @endif name="agent_no" id="default-01" placeholder="Enter agent phone number" required>'+
                      '</div>'+
                     '</div>'+
                    '</div>';

               if(val == 0){
               $('#businessno').hide();
                // $('#agentno').empty();
               }else{
                $('#businessno').show();
                $('#businessno').html(html);
               }            
    });
</script>
@endsection