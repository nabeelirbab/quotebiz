@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))
<?php $job_design = Acelle\Jobs\HelperJob::form_design(); ?>
@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
        .sub-text {
            display: block;
            font-size: 16px;
            color: #fbfdff;
            font-weight: bold;
        }
        .accordion {
            border-radius: 4px;
            border: none;
            background: #fff;
        }
    </style>
@endsection

@section('content')
<?php
 $date = Acelle\Jobs\HelperJob::dateFormat();
  if($date == 'd/m/Y'){
     $date = 'DD/MM/YYYY';
  }else{
    $date = 'MM/DD/YYYY';
  }
?>
 <!-- content @s -->
 <div id="app" class="mt-4">
  <div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title pb-2">Custom Filed Lists</h3>
                            <div class="nk-block-des text-soft">
                              <a href="#" class="mb-1" style="color:#222;" data-toggle="modal" data-target="#howitwork">How it works</a>
                               <br>
                                <span>At QuoteBiz, we understand that every service category and subcategory may have unique requirements..</span>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                    
                                          <li class="nk-block-tools-opt"><a :href="hostname+'/admin/custom-field/add'" class="btn btn-primary" ><em class="icon ni ni-plus"></em><span>Add Question</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
   @include("design._menu")
        <custom-component dateformat='{{$date}}' eventtext='{{ $job_design->event_text}}'></custom-component>
              </div>
    </div>
</div>

</div>
  </div>
<!-- content @e -->
@endsection

@section('script')
 <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
 <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
 <script src="{{ asset('js/app.js') }}"></script>

@endsection
