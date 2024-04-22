@extends('layouts.core.frontend')

@section('title', 'Form Design')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.css" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/libs/fontawesome-icons.css') }}">
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
 .select2-selection--single:not([class*=bg-]):not([class*=border-]){
      height: calc(2.9rem + 2px) !important;
      color: #3c4d62;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #c1c1c1;
      border-radius: 4px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
      top: 10px !important;
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
                <h3 class="nk-block-title page-title">Features Bar</h3>
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
                      <input type="hidden" name="id" @if($featurebar) value="{{$featurebar->id}}" @endif>
                      
                       <div class="row mb-3">
                        <div class="col-md-3 d-flex justify-content-center align-center">
                          <div class="form-check">
                            <input type="checkbox" id="feature1check" class="form-check-input"  name="feature1status" {{ $featurebar->feature1status == 'on' ? 'checked': '' }}>
                             <label class="form-check-label" for="feature1check">Hide / Show</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          
                        <div class="form-group">
                            <label class="form-label" for="feature1">Feature 1</label>
                              <div  class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($featurebar) value="{{$featurebar->feature1}}" @endif name="feature1" id="feature1" placeholder="https://www.feature1.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Instagram">Icon</label>
                              <div class="input-group" title="Using input value">
                             <i class="fas fa-plane display-4" aria-hidden="true"></i>

                            </div>
                        </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center align-center">
                          <div class="form-check">
                            <input type="checkbox" id="feature2check"  class="form-check-input" name="feature2status" {{ $featurebar->feature2status == 'on' ? 'checked': '' }}>
                             <label class="form-check-label" for="feature2check">Hide / Show</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          
                        <div class="form-group">
                            <label class="form-label" for="feature2">Feature 2</label>
                              <div  class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($featurebar) value="{{$featurebar->feature2}}" @endif name="feature2" id="feature2" placeholder="https://www.feature1.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Instagram">Icon</label>
                              <div class="input-group" title="Using input value">
                              <i class="fas fa-dollar-sign display-4" aria-hidden="true"></i>
                            </div>
                        </div>
                        </div>
                         <div class="col-md-3 d-flex justify-content-center align-center">
                          <div class="form-check">
                            <input type="checkbox" id="feature3check" class="form-check-input"  name="feature3status" {{ $featurebar->feature3status == 'on' ? 'checked': '' }} >
                             <label class="form-check-label" for="feature3check">Hide / Show</label>
                            
                          </div>
                        </div>
                       <div class="col-md-6">
                          
                        <div class="form-group">
                            <label class="form-label" for="feature3">Feature 3</label>
                              <div  class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($featurebar) value="{{$featurebar->feature3}}" @endif name="feature3" id="feature3" placeholder="https://www.feature1.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Instagram">Icon</label>
                              <div class="input-group" title="Using input value">
                              <i class="fas fa-wrench display-4" aria-hidden="true"></i>
                            </div>
                        </div>
                        </div>
                         <div class="col-md-3 d-flex justify-content-center align-center">
                          <div class="form-check">
                            <input type="checkbox" id="feature4check" class="form-check-input"  name="feature4status" {{ $featurebar->feature4status == 'on' ? 'checked': '' }}>
                             <label class="form-check-label" for="feature4check">Hide / Show</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="feature4">Feature 4</label>
                              <div  class="input-group" title="Using input value">
                              <input type="text" class="form-control" @if($featurebar) value="{{$featurebar->feature4}}" @endif name="feature4" id="feature4" placeholder="https://www.feature1.com/quotebiz" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="Instagram">Icon</label>
                              <div class="input-group" title="Using input value">
                              <i class="fas fa-headphones display-4" aria-hidden="true"></i>
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                        <button class="btn btn-success btn-lg" type="submit">@if($featurebar) Update @else Save @endif</button>
                       <!--  <input type="submit" class="btn btn-default btn-lg" name="preview" value="Preview" type="submit"> -->
                    </div>
                      </div>
                </div>
                <div class="col-md-4">
                   <div class="form-check mb-4">
                      <input type="checkbox" id="feature3check" class="form-check-input"  name="status" {{ $featurebar->status == 'on' ? 'checked': '' }} >
                       <label class="form-check-label" for="feature3check">Hide / Show Feature Bar</label>
                      
                    </div>
                   <div class="form-group">
                      <label class="form-label" for="default-01">Footer Color</label>
                       <div id="cp1" class="input-group" title="Using input value">
                        <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->featurebar_back}}" @endif name="featurebar_back" id="default-01" placeholder="Enter Link Color" required/>
                        <span class="input-group-append">
                          <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </span>
                      </div>
                    
                  </div>

                   <div class="form-group">
                      <label class="form-label" for="default-02">Text & Icon Color</label>
                       <div id="cp2" class="input-group" title="Using input value">
                        <input type="text" class="form-control" @if($formdesign) value="{{$formdesign->featurebar_text_icon}}" @endif name="featurebar_text_icon" id="default-02" placeholder="Enter Link Color" required/>
                        <span class="input-group-append">
                          <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </span>
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
 $(function () {
    $('#cp0, #cp1, #cp2').colorpicker({
        format: 'hex',
    });
  });
    $(document).ready(function() {
        $('.selectsearch').select2({
            templateResult: formatIcon,
            templateSelection: formatIconSelection,
        });

        function formatIcon(icon) {
            console.log(icon);
            if (!icon.id) {
                return icon.text;
            }
            var $icon = $('<span><img src="' + icon.element.getAttribute('data-icon') + '" style="width:10%" class="img-icon" /> ' + icon.text + '</span>');
            return $icon;
        }

        function formatIconSelection(icon) {
            if (!icon.id) {
                return icon.text;
            }
            var $icon = $('<span><img src="' + icon.element.getAttribute('data-icon') + '" style="width:12%" class="img-icon" /> ' + icon.text + '</span>');
            return $icon;
        }
    });
</script>
@endsection