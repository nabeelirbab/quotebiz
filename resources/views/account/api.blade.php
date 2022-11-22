@extends('layouts.core.frontend')

@section('title', trans('messages.api_token'))

@section('page_header')

    <div class="page-title">
    <ul class="breadcrumb breadcrumb-caret position-right">
    <li class="breadcrumb-item"><a href="{{ url("/admin") }}">{{ trans('messages.home') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('messages.api_token') }}</li>
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
                <h4 class="nk-block-title page-title">Stripe Payment</h3>
                    <p>In order to receive payments from service providers you will need to setup a stripe account <a href="https://dashboard.stripe.com/login" target="_blank">Stripe Account</a>. Manage your API keys to authenticate requests with Stripe. <a href="https://stripe.com/docs/keys" target="_blank">API keys</a></p>
               
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                 <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-7">
                        @if(!$stripeData)
                        <div class="alert alert-danger  fade show mt-5" role="alert">
                        <strong> For Receive payments from Credit / Debit card to your Stripe account Please enter stripe keys</strong> 
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="default-01">Publishable key </label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($stripeData) value="{{$stripeData->stripe_key}}" @endif name="stripe_key" id="default-01" placeholder="Enter Stripe Key" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Stripe Secret</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if($stripeData) value="{{$stripeData->stripe_secret}}" @endif name="stripe_secret" id="default-01" placeholder="Enter Stripe Secret" required>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-sm-7 text-center">
                        <button class="btn btn-success btn-lg" type="submit">@if($stripeData) Update @else Save @endif</button>
                    </div>

                   
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->

</div>
@endsection
