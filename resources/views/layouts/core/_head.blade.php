<meta charset="UTF-8">
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
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
.form-control, div.dataTables_wrapper div.dataTables_filter input, .dual-listbox .dual-listbox__search {
    display: block;
    width: 100%;
    height: calc(2.125rem + 10px) !important;
    padding: 0.4375rem 1rem;
    font-size: 0.8125rem;
    font-weight: 400;
    line-height: 1.25rem;
    color: #3c4d62;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #dbdfea;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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