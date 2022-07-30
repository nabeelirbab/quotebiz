@extends('layouts.core.frontend')
@section('title', 'Payment History')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
@section('content')


<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between g-3">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Payment History</h3>
<div class="nk-block-des text-soft">
<p>You have total {{$payments->count()}} orders.</p>
</div>
</div><!-- .nk-block-head-content -->

</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="card card-bordered card-stretch">
<div class="card-inner-group">
<div class="card-inner">
<div class="card-title-group">
    <div class="card-title">
        <h5 class="title">All Orders</h5>
    </div>
    <div class="card-tools mr-n1">
        <ul class="btn-toolbar gx-1">
            <li>
                <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
            </li><!-- li -->
         
        </ul><!-- .btn-toolbar -->
    </div><!-- .card-tools -->
    <div class="card-search search-wrap" data-search="search">
        <div class="search-content">
            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
        </div>
    </div><!-- .card-search -->
</div><!-- .card-title-group -->
</div><!-- .card-inner -->
<div class="card-inner p-0">
<div class="nk-tb-list nk-tb-tnx">
    <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
        <div class="nk-tb-col"><span>#ID</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Name</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Email</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Source</span></div>
        <div class="nk-tb-col tb-col-lg"><span>Payment ID</span></div>
        <div class="nk-tb-col text-right"><span>Amount</span></div>
        <div class="nk-tb-col text-right tb-col-sm"><span>Credits</span></div>
        <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Payment Status</span></div>
        <div class="nk-tb-col text-right tb-col-sm"><span>Payment At</span></div>
    </div><!-- .nk-tb-item -->
    @foreach($payments as $creadit)
    <div class="nk-tb-item">
        <div class="nk-tb-col">
            <div class="nk-tnx-type">
                
                <div class="nk-tnx-type-text">
                    <span class="tb-lead">{{$creadit->id}}</span>
                </div>
            </div>
        </div>
        <div class="nk-tb-col tb-col-xxl">
            <span class="tb-lead-sub">{{$creadit->users->first_name}} {{$creadit->users->last_name}}</span>
        </div>
        <div class="nk-tb-col tb-col-xxl">
            <span class="tb-lead-sub">{{$creadit->users->email}}</span>
        </div>
        <div class="nk-tb-col tb-col-xxl">
            <span class="tb-lead-sub">Stripe</span>
        </div>
        <div class="nk-tb-col tb-col-lg">
            <span class="tb-lead-sub">{{$creadit->payment_id}}</span>
        </div>
        <div class="nk-tb-col text-right">
            <span class="tb-amount">
                <?php 
                  $currencyConvert = Acelle\Jobs\HelperJob::usdcurrency($creadit->amount); 
                 ?>
                {{$currencyConvert['convert']}}<span> {{$currencyConvert['currency']}}</span></span>
        </div>
        <div class="nk-tb-col text-right tb-col-sm">
            <span class="tb-amount">{{$creadit->creadits}}</span>
        </div>
        <div class="nk-tb-col nk-tb-col-status">
            <div class="dot dot-success d-md-none"></div>
            <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">Completed</span>
        </div>
        <div class="nk-tb-col text-right tb-col-sm">
            <span class="tb-amount">{{\Carbon\Carbon::parse($creadit->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
        </div>
    </div><!-- .nk-tb-item -->
    @endforeach
 
</div><!-- .nk-tb-list -->
</div><!-- .card-inner -->
<div class="card-inner">
{{$payments}}
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>

<!-- modals -->
<div class="modal fade" tabindex="-1" id="tranxDetails">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<a href="#" class="close" data-dismiss="modal" aria-label="Close">
<em class="icon ni ni-cross"></em>
</a>
<div class="modal-body modal-body-md">
<div class="nk-modal-head mb-3 mb-sm-5">
<h4 class="nk-modal-title title">Transaction <small class="text-primary">#TNX67234</small></h4>
</div>
<div class="nk-tnx-details">
<div class="nk-block-between flex-wrap g-3">
<div class="nk-tnx-type">
<div class="nk-tnx-type-icon bg-warning text-white">
<em class="icon ni ni-arrow-up-right"></em>
</div>
<div class="nk-tnx-type-text">
<h5 class="title">+ 0.004560 BTC</h5>
<span class="sub-text mt-n1">15 Oct, 2019 09:45 PM</span>
</div>
</div>
<ul class="align-center flex-wrap gx-3">
<li>
<span class="badge badge-sm badge-success">Completed</span>
</li>
</ul>
</div>
<div class="nk-modal-head mt-sm-5 mt-4 mb-4">
<h5 class="title">Transaction Info</h5>
</div>
<div class="row gy-3">
<div class="col-lg-6">
<span class="sub-text">Order ID</span>
<span class="caption-text">YWLX52JG73</span>
</div>
<div class="col-lg-6">
<span class="sub-text">Reference ID</span>
<span class="caption-text text-break">NIY9TB2JG73YWLXPYM2U8HR</span>
</div>
<div class="col-lg-6">
<span class="sub-text">Transaction Fee</span>
<span class="caption-text">0.000002 BTC</span>
</div>
<div class="col-lg-6">
<span class="sub-text">Amount</span>
<span class="caption-text">0.004560 BTC</span>
</div>
</div><!-- .row -->
<div class="nk-modal-head mt-sm-5 mt-4 mb-4">
<h5 class="title">Transaction Details</h5>
</div>
<div class="row gy-3">
<div class="col-lg-6">
<span class="sub-text">Transaction Type</span>
<span class="caption-text">Deposit</span>
</div>
<div class="col-lg-6">
<span class="sub-text">Payment Gateway</span>
<span class="caption-text align-center">CoinPayments <span class="badge badge-primary ml-2 text-white">Online Gateway</span></span>
</div>
<div class="col-lg-6">
<span class="sub-text">Payment From</span>
<span class="caption-text text-break">1xA058106537340385c87d264f93</span>
</div>
<div class="col-lg-6">
<span class="sub-text">Payment To</span>
<span class="caption-text text-break">1x0385c87d264A05810653734f93</span>
</div>
<div class="col-lg-12">
<span class="sub-text">Transaction Hash</span>
<span class="caption-text text-break">Tx156d3342d5c87d264f9359200xa058106537340385c87d264f93</span>
</div>
<div class="col-lg-12">
<span class="sub-text">Details</span>
<span class="caption-text">Deposit Fund for Investment</span>
</div>
</div><!-- .row -->
</div><!-- .nk-tnx-details -->
</div><!-- .modal-body -->
</div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div><!-- .modal -->

@endsection
@section('script')


@endsection