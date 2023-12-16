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
                <h3 class="nk-block-title page-title">Social Links</h3>
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
                      <input type="hidden" name="id" @if($formdesign) value="{{$formdesign->id}}" @endif>
                      
                       <div class="row mb-3">
                        <div class="col-md-12">
                          
                        <div class="form-group">
                            <label class="form-label" for="Facebook">Facebook</label>
                              <div  class="input-group" title="Using input value">
                              <input type="url" class="form-control" @if($formdesign) value="{{$formdesign->facebook}}" @endif name="facebook" id="Facebook" placeholder="https://www.facebook.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Instagram">Instagram</label>
                              <div class="input-group" title="Using input value">
                              <input type="url" class="form-control" @if($formdesign) value="{{$formdesign->instagram}}"  @endif name="instagram" id="Instagram" placeholder="https://www.instagram.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="LinkedIn">LinkedIn</label>
                              <div  class="input-group" title="Using input value">
                              <input type="url" class="form-control" @if($formdesign) value="{{$formdesign->linkedIn}}"  @endif name="linkedIn" id="LinkedIn" placeholder="https://www.linkedin.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Twitter">Twitter</label>
                              <div  class="input-group" title="Using input value">
                              <input type="url" class="form-control" @if($formdesign) value="{{$formdesign->twitter}}"  @endif name="twitter" id="Twitter" placeholder="https://www.twitter.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="WhatsApp">WhatsApp</label>
                              <div  class="input-group" title="Using input value">
                              <input type="url" class="form-control" @if($formdesign) value="{{$formdesign->whatsApp}}"  @endif name="whatsApp" id="WhatsApp" placeholder="https://wa.me/" />
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                        <button class="btn btn-success btn-lg" type="submit">@if($formdesign) Update @else Save @endif</button>
                       <!--  <input type="submit" class="btn btn-default btn-lg" name="preview" value="Preview" type="submit"> -->
                    </div>
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