@extends('layouts.core.backend')

@section('title', trans('messages.create_admin'))
	
@section('page_header')
	
			<div class="page-title">
				<ul class="breadcrumb breadcrumb-caret position-right">
					<li class="breadcrumb-item"><a href="{{ action("Admin\HomeController@index") }}">{{ trans('messages.home') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ action("Admin\Admin2Controller@index") }}">{{ trans('messages.users') }}</a></li>
				</ul>
				<h1>
					<span class="text-semibold"><span class="material-icons-round">
add
</span> {{ trans('messages.create_admin') }}</span>
				</h1>
			</div>

@endsection

@section('content')
          <form enctype="multipart/form-data" action="{{ action('Admin\Admin2Controller@store') }}" method="POST" class="form-validate-jqueryz">
					{{ csrf_field() }}
					
					@include('admin.admins2._form')			
					
				<form>
				
@endsection
