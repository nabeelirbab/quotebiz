@extends('layouts.core.frontend')

@section('title', 'Currency')

@section('page_header')

	<div class="page-title">
		<ul class="breadcrumb breadcrumb-caret position-right">
			<li class="breadcrumb-item"><a href="{{ url("/") }}">{{ trans('messages.home') }}</a></li>
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
    <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                 <form action="" method="post" enctype="multipart/form-data" style="padding: 40px">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   <div class="col-sm-7">
                    <div class="form-group">
                      <label class="form-label" for="default-01">Select Currency </label>
                       <div class="form-control-wrap">
                    <select class="form-control" name="code">
                        <option value="" selected>Select Currency</option>
                        <option value="USD" {{$currencyData && $currencyData->code == 'USD' ? 'selected': ''}}>USD</option>
                        <option value="EUR" {{$currencyData && $currencyData->code == 'EUR' ? 'selected': ''}}>EUR</option>
                        <option value="AUD" {{$currencyData && $currencyData->code == 'AUD' ? 'selected': ''}}>AUD</option>
                    </select>
                </div>
                       </div>
                   </div>
                    
                   
                    <div class="col-sm-7 text-center">
                        <button class="btn btn-success btn-lg" type="submit">Save</button>
                    </div>

                   
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->

</div>
@endsection
