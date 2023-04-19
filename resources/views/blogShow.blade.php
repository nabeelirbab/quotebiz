@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<style type="text/css">
.post-body {
    max-width:100%; /* adjust this value as needed */
    overflow-y: auto;
}

</style>
@endsection

@section('content')
<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">

<div class="nk-block">
<div class="row g-gs">
<div class="row">
  <div class="col-md-12 text-center">
    <h1>{{ $post->title }}</h1>
    <p class="text-muted">{{ $post->created_at->format('M j, Y') }}</p>
    <img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" class="img w-50 mb-4" alt="{{ $post->title }}">
    <div class="post-body">{!! $post->description !!}</div>
</div>
</div>

</div>
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>
<!-- content @e -->
@endsection


