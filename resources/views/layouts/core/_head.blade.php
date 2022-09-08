<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
<meta name="keywords" content="{{ \Acelle\Model\Setting::get("site_keyword") }}" />
<meta name="php-version" content="{{ phpversion() }}" />

<title>@yield('title') - {{ \Acelle\Model\Setting::get("site_name") }}</title>

@if (\Acelle\Model\Setting::get('site_favicon'))
    <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}"/>
@else
    @include('layouts.core._favicon')
@endif    

@include('layouts.core._includes')
<style type="text/css">
		.form-group:last-child {
	    margin-bottom: 20px !important;
	}
	.nav-tabs .nav-item {
    padding-right: 1rem;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(2.125rem + 2px);
    position: absolute;
    top: 5px !important;
    right: 0;
    width: calc(2.125rem + 2px);
    display: flex;
    align-items: center;
    justify-content: center;
}
.select2-search__field{
    font-size: 16px;
}
a .icon + span{
    margin-left: 0.25rem;
    margin-top: 6px;
}
.breadcrumb-item {
    font-size: 11px;
    font-weight: 500;
    text-transform: inherit !important;
    letter-spacing: 0.05rem;
}
	</style>