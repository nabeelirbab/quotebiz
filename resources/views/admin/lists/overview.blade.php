@extends('layouts.core.backend')

@section('title', $list->name . " - " . number_with_delimiter($list->readCache('SubscriberCount')) . " " . trans('messages.subscribers'))

@section('head')
    <script type="text/javascript" src="{{ URL::asset('core/echarts/echarts.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/echarts/dark.js') }}"></script> 
@endsection

@section('page_header')

    @include("admin.lists._header")

@endsection

@section('content')

    @include("admin.lists._menu")

    <h2 class="text-primary my-4">{{ trans('messages.list_performance') }}</h2>

    @include("admin.lists._stat")

    <h3 class="text-semibold text-primary">{{ trans('messages.list_growth') }}</h3>

    @include("admin.lists._growth_chart")
@endsection
