@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
@endsection

@section('content')
<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Blogs</h3>
<div class="nk-block-des text-soft">
<p>You have total {{count($posts)}} Blogs</p>
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
<div class="toggle-expand-content" data-content="pageMenu">
<ul class="nk-block-tools g-3">
    <li class="nk-block-tools-opt">
        <a href="{{ url('admin/posts/add') }}" class="btn btn-primary">
            <em class="icon ni ni-plus"></em>
            <span>Add Blog</span>
        </a>
    </li>
</ul>
</div>
</div><!-- .toggle-wrap -->
</div><!-- .nk-block-head-content -->
</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="row g-gs">
<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" class="card-img-top" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <a href="{{ url('admin/posts/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                    <div class="float-right">
                    <a href="{{ url('admin/posts/'.$post->slug) }}" class="btn btn-sm btn-success">Update</a>
                    <a href="{{ url('admin/posts/'.$post->slug) }}" class="btn btn-sm btn-warning">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

</div>
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>
<!-- content @e -->
@endsection


