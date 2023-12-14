@extends('layouts.core.frontend')

@section('title', 'Currency')

@section('page_header')

<div class="page-title">
<ul class="breadcrumb breadcrumb-caret position-right">
<li class="breadcrumb-item"><a href="{{ url("/admin") }}">{{ trans('messages.home') }}</a></li>
<li class="breadcrumb-item active">Currency</li>
</ul>
<h1>
<span class="text-semibold"><span class="material-icons-round">
person_outline
</span> {{ Auth::user()->displayName() }}</span>
</h1>
</div>

@endsection

@section('content')

	@include("account._menu")

	<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">Set Currency</h3>
               
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
   

</div>
@endsection
