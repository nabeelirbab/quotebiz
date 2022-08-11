<!DOCTYPE html>
<html lang="en">
<?php $job_design = Acelle\Jobs\HelperJob::form_design(); ?>
    <head>
        @include('layouts.core._head')
        <style type="text/css">
            .dogcFe {
              background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);
             }
             .btn-primary{
                    border: none!important;
                    background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
                    height: 46px!important;
                }
        </style>
        @include('layouts.core._script_vars')
    </head>
    <body class="bg-slate-800 dogcFe">
        <!-- Page container -->
        <div class="page-container login-container">
            @if (\Auth::check())
                <div class="text-end">
                    <a href="{{ url("/logout") }}"  class='text-white ml-20'><i class="icon-switch2"></i> {{ trans('messages.logout') }}</a>
                </div>
            @endif

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-2 col-md-4">

                        </div>
                        <div class="col-sm-8 col-md-4">

                            <div class="text-center login-header">
                                <a class="main-logo-big" href="{{ url('/') }}">
                                    @if (\Acelle\Model\Setting::get('site_logo_big'))
                                        <img src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big')) }}" style="width: 220px;" alt="">
                                    @else
                                        <img src="{{ URL::asset('images/logo_big.svg') }}" alt="">
                                    @endif
                                </a>
                            </div>

                            @yield('content')

                        </div>
                    </div>
                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->


            <!-- Footer -->
            <div class="small">
                <div class="footer text-white text-center py-3" style="width: 100%">
                    {!! trans('messages.copy_right_light') !!}
                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /page container -->

        {!! \Acelle\Model\Setting::get('custom_script') !!}

    </body>
</html>