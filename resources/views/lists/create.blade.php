@extends('layouts.core.frontend')

@section('title', trans('messages.create_list'))

@section('page_header')
	<div class="page-title">
		<ul class="breadcrumb breadcrumb-caret position-right">
			<li class="breadcrumb-item"><a href="{{ url("/") }}">{{ trans('messages.home') }}</a></li>
			<li class="breadcrumb-item"><a href="{{ url("lists") }}">{{ trans('messages.lists') }}</a></li>
		</ul>
		<h1>
			<span class="text-semibold"><span class="material-icons-round">
add
</span> {{ trans('messages.create_list') }}</span>
		</h1>
	</div>
@endsection

@section('content')
	<form action="{{ url('lists') }}" method="POST" class="form-validate-jqueryz">
		{{ csrf_field() }}
		@include("lists._form")
		<hr>
		<div class="text-left">
			<button class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save') }}</button>
			<a href="{{ url('lists') }}" class="btn btn-link"><i class="icon-cross2"></i> {{ trans('messages.cancel') }}</a>
		</div>
	</form>
@endsection
