@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

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

 <!-- content @s -->
 <div id="app" class="mt-4">
        <question-component></question-component>
  </div>
<!-- content @e -->
@endsection

@section('script')
 <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
 <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
 <script src="{{ asset('js/app.js') }}"></script>

@endsection
