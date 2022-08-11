@extends('layouts.core.frontend')

@section('title', 'Date Format')

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
@endsection

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Date Format</h3>
                <div class="nk-block-des text-soft">
                </div>
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
                       <!--  @if(!$formet)
                        <div class="alert alert-danger  fade show mt-5" role="alert">
                        <strong> For Receive payments from Credit / Debit card to your Stripe account Please enter stripe keys</strong> 
                        </div>
                        @endif -->
                        <div class="form-group">
                            <label class="form-label" for="default-01">Select Date Format</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="dateformet">
                                    @if($formet)
                                    <option value="USA-MM/DD/YYYY" {{($formet->type.'-'.$formet->date_formet == 'USA-MM/DD/YYYY') ? 'selected' : ''}}>USA - MM/DD/YYYY </option>
                                    <option value="Europe-DD/MM/YYYY" {{($formet->type.'-'.$formet->date_formet == 'Europe-DD/MM/YYYY') ? 'selected' : ''}}>Europe - DD/MM/YYYY </option>
                                    @else
                                    <option value="USA-m/d/Y">USA - MM/DD/YYYY </option>
                                    <option value="Europe-d/m/Y">Australia/Europe - DD/MM/YYYY </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-sm-7 text-center">
                        <button class="btn btn-success btn-lg" type="submit">@if($formet) Update @else Save @endif</button>
                    </div>

                   
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->

</div>
@endsection