<!-- <!DOCTYPE html> -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
    <meta name="keywords" content="{{ \Acelle\Model\Setting::get("site_keyword") }}" />
    <title>@yield('title') - {{ \Acelle\Model\Setting::get("site_name") }}</title>
    @if (\Acelle\Model\Setting::get('site_favicon'))
        <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}"/>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnout.com/toastr.js/css/base.css" rel="stylesheet" media="all">
    @include('service_provider.includes.head-css')  
    @yield('styling')
</head>
<body>
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
        @include('service_provider.includes.sidebar')
        <!-- wrap @s -->
        <div class="nk-wrap ">
        @include('service_provider.includes.mainheader')
        <!-- Main Content-->
        @yield('content')

        <!-- End Page -->
        @include('service_provider.includes.footer')
    </div>
     <!-- wrap @e -->
</div>

  
</div>
  
 @include('service_provider.includes.footer-script')

    @yield('script')
</body>

</html>
