<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title') - {{ \Acelle\Model\Setting::get("site_name") }}</title>

	@include('layouts.core._head')
	<?php $job_design = Acelle\Jobs\HelperJob::form_design(); ?>
	<style type="text/css">
    .row {
        margin-left: 0px;
        margin-right: 0px;
    }
     .dogcFe {
            background-size: cover !important;
          background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);
         }
         .btn-primary{
                border: none!important;
                background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
                height: 46px!important;
          }
   </style>
</head>

<body class="bg-slate-800 dogcFe">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">

			@yield('page_header')

		</div>
	</div>
	<!-- /page header -->

	<!-- Page container -->
	<div class="page-container" >

		<!-- Page content -->
	     <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">
                    <div class="row justify-content-md-center">
                       
                        <div class="col-sm-12 col-md-6">

                            <div class="text-center loginheader mb-3">
                                <a class="main-logo-big" href="{{ url('/') }}">
                                    @if (\Acelle\Model\Setting::get('site_logo_big'))
                                        <img src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big')) }}" style="max-width: 30%;" alt="">
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
		<!-- /footer -->

	</div>
	<!-- /page container -->
<script type="text/javascript">
	 
    $('.select-search').select2().on('select2:open', function(e){
    $('.select2-search__field').attr('placeholder', 'Search ....');
});
</script>
    {!! \Acelle\Model\Setting::get('custom_script') !!}

</body>
</html>
