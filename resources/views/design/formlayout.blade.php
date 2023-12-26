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

<?php $formdesign = Acelle\Jobs\HelperJob::form_design(); ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Form Layout</h3>
                <div class="nk-block-des text-soft">
                    <p>Form layout for quote page</p>
                </div>
            </div><!-- .nk-block-head-content -->
           <div class="nk-block-head-content">
          <!--  <a href="{{ url('/')}}" target="_blank" class="btn btn-primary" ><span>Preview Design</span></a> -->
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
                      <input type="hidden" name="id" @if($formdesign) value="{{$formdesign->id}}" @endif>
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label" for="default-01">Quote Box Position</label>
                        <div class="form-control-wrap">
                         <label>
                          <input type="radio" name="position" id="option1" autocomplete="off" value="start" {{$formdesign && $formdesign->position == 'start' ? 'checked':''}} > Left
                        </label>
                         <label>
                          <input type="radio" name="position" id="option2" autocomplete="off" value="center" {{$formdesign && $formdesign->position == 'center' ? 'checked':''}} > Center
                        </label>
                        <label >
                          <input type="radio" name="position" {{$formdesign && $formdesign->position == 'end' ? 'checked':''}} id="option2" value="end" autocomplete="off"> Right
                        </label>
                        </div>
                        </div>

                        </div>
                        <div class="col-md-6">
                          
                        <div class="form-group">
                          <label class="form-label" for="default-01">Blog Section Visibility</label>
                          <div class="form-control-wrap">
                           <label>
                            <input type="radio" name="blog_status" autocomplete="off" value="0" {{$formdesign && $formdesign->blog_status == '0' ? 'checked':''}} > Show Featured & Menu
                          </label>
                          <label >
                            <input type="radio" name="blog_status" {{$formdesign && $formdesign->blog_status == '1' ? 'checked':''}} id="option2" value="1" autocomplete="off"> Show Only in Menu
                          </label>
                          <label >
                            <input type="radio" name="blog_status" {{$formdesign && $formdesign->blog_status == '2' ? 'checked':''}} id="option2" value="2" autocomplete="off"> Completely Hide
                          </label>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                          

                        <div class="form-group">
                          <label class="form-label" for="default-01">Profile Section Visibility</label>
                          <div class="form-control-wrap">
                           <label>
                            <input type="radio" name="profile_status" autocomplete="off" value="0" {{$formdesign && $formdesign->profile_status == '0' ? 'checked':''}} > Show Featured & Menu
                          </label>
                          <label >
                            <input type="radio" name="profile_status" {{$formdesign && $formdesign->profile_status == '1' ? 'checked':''}} id="option2" value="1" autocomplete="off">Show Only in Menu
                          </label>
                          <label >
                            <input type="radio" name="profile_status" {{$formdesign && $formdesign->profile_status == '2' ? 'checked':''}} id="option2" value="2" autocomplete="off"> Completely Hide
                          </label>
                          </div>
                        </div>
                        </div>
                      </div>
                  
          
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