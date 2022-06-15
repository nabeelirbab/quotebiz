@extends('layouts.core.backend')

@section('title', $campaign->name)

@section('head')
    <script type="text/javascript" src="{{ URL::asset('core/echarts/echarts.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/echarts/dark.js') }}"></script> 
@endsection

@section('page_header')

    @include("admin.campaigns._header")

@endsection

@section('content')

    @include("admin.campaigns._menu")

    @include("admin.campaigns._info")

    <br />

    @include("admin.campaigns._chart")

    @if (config('custom.woo'))

        @include("admin.campaigns._chart2")

    @endif

    @include("admin.campaigns._open_click_rate")

    @include("admin.campaigns._count_boxes")

    <br />

    @include("admin.campaigns._24h_chart")


    <br />

    @include("admin.campaigns._top_link")

    <br />

    @include("admin.campaigns._most_click_country")

    <br />

    @include("admin.campaigns._most_open_country")

    <br />

    @include("admin.campaigns._most_open_location")

    <br />
@endsection
