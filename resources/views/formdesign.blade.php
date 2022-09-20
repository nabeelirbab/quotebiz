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
 </style>
@endsection
@section('content')
<?php $formdesign = Acelle\Jobs\HelperJob::form_design(); ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Form Design</h3>
                <div class="nk-block-des text-soft">
                    <p>Form deisgn for quote page</p>
                </div>
            </div><!-- .nk-block-head-content -->
           <div class="nk-block-head-content">
           <a href="{{ url('/')}}" target="_blank" class="btn btn-primary" ><span>Preview Design</span></a>
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
                   
                    <div class="col-sm-8">
                      <input type="hidden" name="id" @if($formdesign) value="{{$formdesign->id}}" @endif>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Main Heading </label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->title_heading}}" @else value="What are you looking for?" @endif name="title_heading" id="default-01" placeholder="Enter main heading" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Sub Heading</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->titlesub_heading}}" @else value="Let us know what you are looking for and we will provide you up to 3 quotes." @endif name="titlesub_heading" id="default-01" placeholder="Enter sub heading" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Category Input Heading</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->category_heading}}" @else value="Service you require" @endif name="category_heading" id="default-01" placeholder="Enter category input heading" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Post Code Heading</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->postcode_text}}" @else value="Where?" @endif name="postcode_text" id="default-01" placeholder="Enter post code heading" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Button Text</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->button_text}}" @else value="Send Me Quotes" @endif name="button_text" id="default-01" placeholder="Enter button text" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                       <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Button Color</label>
                              <div id="cp0" class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->button_color}}" @else value="#000000" @endif name="button_color" id="default-01" placeholder="Enter sun heading" required/>
                              <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Button Text Color</label>
                            <div id="cp1" class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->button_text_color}}" @else value="#FFFFFF" @endif name="button_text_color" id="default-01" placeholder="Enter sun heading" required/>
                              <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Underline Color</label>
                             <div id="cp2" class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->underline_color}}" @else value="#C31E1E" @endif name="underline_color" id="default-01" placeholder="Enter sub heading" required/>
                              <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </span>
                            </div>
                        </div>
                       </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Login Text Color</label>
                             <div id="cp2" class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->login_color}}" @else value="#C31E1E" @endif name="login_color" id="default-01" placeholder="Login Text Color" required/>
                              <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </span>
                            </div>
                        </div>
                       </div>
                   </div>
                     <div class="form-group">
                        <label class="form-label" for="default-01">Business Number Visibility</label>
                        <div class="form-control-wrap">
                         <label>
                          <input type="radio" name="no_status" id="option1" autocomplete="off" value="0" {{$formdesign && $formdesign->no_status == '0' ? 'checked':''}} > Hide
                        </label>
                        <label >
                          <input type="radio" name="no_status" {{$formdesign && $formdesign->no_status == '1' ? 'checked':''}} id="option2" value="1" autocomplete="off"> Want to speak with an agent ?
                        </label>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="form-label" for="default-01">Quote Box Position</label>
                        <div class="form-control-wrap">
                         <label>
                          <input type="radio" name="position" id="option1" autocomplete="off" value="start" {{$formdesign && $formdesign->position == 'start' ? 'checked':''}} checked> Left
                        </label>
                         <label>
                          <input type="radio" name="position" id="option2" autocomplete="off" value="center" {{$formdesign && $formdesign->position == 'center' ? 'checked':''}} > Center
                        </label>
                        <label >
                          <input type="radio" name="position" {{$formdesign && $formdesign->position == 'end' ? 'checked':''}} id="option2" value="end" autocomplete="off"> Right
                        </label>
                        </div>
                        </div>
                        <div class="row mb-3" id="businessno">
                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            @if($formdesign && $formdesign->no_status == '1')
                            <label class="form-label" for="default-01">Support CTA Text</label>
                            <div class="form-control-wrap">
                            <input type="text" class="form-control" placeholder="Enter business phone number" @if($formdesign && $formdesign->business_no) value="{{$formdesign->business_no}}" @else value="Want to speak with an agent?" @endif name="business_no" required>
                            </div>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            @if($formdesign && $formdesign->no_status == '1')
                            <label class="form-label" for="default-01">Support Phone</label>
                            <div class="form-control-wrap">
                            <input type="text" class="form-control" @if($formdesign && $formdesign->agent_no) value="{{$formdesign->agent_no}}" @else value="{{Auth::user()->customer->getContact()->phone}}" @endif name="agent_no" id="default-01" required>
                            </div>
                            @endif
                        </div>
                      </div>
                    </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Terms & Conditions</label>
                            <div class="form-control-wrap">
                               
                                  <textarea class="form-control" name="terms" aria-label="With textarea">@if($formdesign){{$formdesign->terms}}@endif</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Privacy Policy</label>
                            <div class="form-control-wrap">
                                  <textarea class="form-control" name="privacy_policy"  aria-label="With textarea">@if($formdesign){{$formdesign->privacy_policy}} @endif</textarea>
                               
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="form-label" for="default-01">Background Image (1800 x 250)</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" accept="image/*" onchange="loadFile(event)" name="backgroup_image" id="default-01" @if( $formdesign && !$formdesign->backgroup_image) required @endif>
                                @if($formdesign && $formdesign->backgroup_image)
                                  <img id="output" src="{{asset('frontend-assets/images/'.$formdesign->backgroup_image)}}" class="mt-3" />
                                @else
                                  <img id="output" class="mt-3" />
                               @endif
                            </div>
                        </div>
                    </div>
                   <div class="col-sm-4 d-none d-sm-block">
                    <p><b>Follow this image for guidence to fill form</b></p>

                    <a class="modal-button" data-target="#modal">
                       <img src="{{asset('frontend-assets/images/demo.png')}}" style="border: 1px solid #253a463b;padding: 9px;border-radius: 6px;">
                   </a>
                   </div>
                    <div class="col-sm-7 text-center">
                        <button class="btn btn-success btn-lg" type="submit">@if($formdesign) Update @else Save @endif</button>
                       <!--  <input type="submit" class="btn btn-default btn-lg" name="preview" value="Preview" type="submit"> -->
                    </div>
                </div>
              </form>
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
    <script>
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