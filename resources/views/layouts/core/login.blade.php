<!DOCTYPE html>
<html lang="en">
<?php $job_design = Acelle\Jobs\HelperJob::form_design(); ?>
    <head>
        @include('layouts.core._head')
        <style type="text/css">
            .dogcFe {
                background-size: cover !important;
              background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);
             }
             .btn-primary{
                    border: none!important;
                    background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
                    height: 46px!important;
                }
            .row {
                    margin-left: 0px;
                    margin-right: 0px;
                }
            .loginheader {
                    max-width: 200px;
                    margin: 0 auto;
                    margin-bottom: 25px;
                 }
            .button-loading .loader {
                    top: 9px !important;
                    left: 20px !important;
                }
        </style>
        @include('layouts.core._script_vars')
    </head>
    <body class="bg-slate-800 dogcFe" style="max-height: 100%;padding-bottom: 0px">
        <!-- Page container -->
        <div class="login-container mt-5">
            @if (\Auth::check())
                <div class="text-end">
                    <a href="{{ url("/logout") }}"  class='text-white ml-20'><i class="icon-switch2"></i> {{ trans('messages.logout') }}</a>
                </div>
            @endif

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">
                    <div class="row justify-content-md-center">
                       
                        <div class="col-sm-12 col-md-4">

                            <div class="text-center loginheader">
                                <a class="main-logo-big" href="{{ url('/') }}">
                                    @if (\Acelle\Model\Setting::get('site_logo_big'))
                                        <img src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big')) }}" style="max-width: 90%;" alt="">
                                    @else
                                        <img src="{{ URL::asset('images/logo_big.svg') }}" alt="">
                                    @endif
                                </a>
                            </div>

                            @yield('content')
                         <!-- Footer -->
                        <div class="small container mt-3">
                            <div class=" text-white text-center py-3">
                                 <a href="{{ url('/') }}" class="text-white" target="_blank">Copyright &copy; {{date("Y")}} {{\Acelle\Model\Setting::get("site_name")}}.</a>
                            </div>
                        </div>
                        </div>

                    </div>

                </div>
                <!-- /main content -->

         
            <!-- /footer -->
            </div>
            <!-- /page content -->



        </div>
        <!-- /page container -->

        {!! \Acelle\Model\Setting::get('custom_script') !!}

    </body>
</html>