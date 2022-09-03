@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}"> 
@endsection

@section('content')
<?php
  $dateName = '';
  if(Request::get('date') == 'daily'){
    $dateName = 'Daily';
  }elseif(Request::get('date') == 'monthly'){
     $dateName = 'Monthly';
  }else{
     $dateName = 'Weekly';
  }

?>
<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">{!! trans('messages.frontend_dashboard_hello', ['name' => Auth::user()->displayName()]) !!}</h3>
<div class="nk-block-des text-soft">
    <p>Welcome back to your account dashboard</p>
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
    <div class="toggle-expand-content" data-content="pageMenu">
        <ul class="nk-block-tools g-3">
            <li>
                <div class="drodown">
                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><span>Last 30 Days</span></a></li>
                            <li><a href="#"><span>Last 6 Months</span></a></li>
                            <li><a href="#"><span>Last 1 Years</span></a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php  
               $customer =  Request::user()->customer;
                $subscription = $customer->subscription;
            ?>
            @if ($subscription->plan_id == 1)
            <li class="nk-block-tools-opt"><a href="{{ url('account/subscription?upgrade='.$subscription->plan_id) }}" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Upgrade Plan</span></a></li>
            @endif            
        </ul>
    </div>
</div>
</div><!-- .nk-block-head-content -->
</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="row g-gs">
<div class="col-xxl-3 col-sm-6">
<div class="card">
    <div class="nk-ecwg nk-ecwg6">
        <div class="card-inner">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Quotes</h6>
                </div>
            </div>
            <div class="data">
                <div class="data-group">
                    <div class="amount">{{$quoteCount}}</div>
                    <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                    </div>
                </div>
                <!-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> -->
            </div>
        </div><!-- .card-inner -->
    </div><!-- .nk-ecwg -->
</div><!-- .card -->
</div><!-- .col -->
<div class="col-xxl-3 col-sm-6">
<div class="card">
    <div class="nk-ecwg nk-ecwg6">
        <div class="card-inner">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Total Revenue</h6>
                </div>
            </div>
            <div class="data">
                <div class="data-group">
                    <div class="amount">
                         <?php 
                              $currencyConvert = Acelle\Jobs\HelperJob::usdcurrency($totalRevenue); 
                             ?>
                      <span class="fs-5">{{$currencyConvert['currency']}}</span> {{$currencyConvert['convert']}}</div>
                    <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                    </div>
                </div>
                <!-- <div class="info"><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>2.34%</span><span> vs. last week</span></div> -->
            </div>
        </div><!-- .card-inner -->
    </div><!-- .nk-ecwg -->
</div><!-- .card -->
</div><!-- .col -->
<div class="col-xxl-3 col-sm-6">
<div class="card">
    <div class="nk-ecwg nk-ecwg6">
        <div class="card-inner">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Customers</h6>
                </div>
            </div>
            <div class="data">
                <div class="data-group">
                    <div class="amount">{{$customerCount}}</div>
                    <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                    </div>
                </div>
                <!-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> -->
            </div>
        </div><!-- .card-inner -->
    </div><!-- .nk-ecwg -->
</div><!-- .card -->
</div><!-- .col -->
<div class="col-xxl-3 col-sm-6">
<div class="card">
    <div class="nk-ecwg nk-ecwg6">
        <div class="card-inner">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Service Providers</h6>
                </div>
            </div>
            <div class="data">
                <div class="data-group">
                    <div class="amount">{{$providerCount}}</div>
                    <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                    </div>
                </div>
                <!-- <div class="info"><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>2.34%</span><span> vs. last week</span></div> -->
            </div>
        </div><!-- .card-inner -->
    </div><!-- .nk-ecwg -->
</div><!-- .card -->
</div><!-- .col -->
<div class="col-xxl-9">
<div class="card card-full">
    <div class="nk-ecwg nk-ecwg8 h-100">
        <div class="card-inner">
            <div class="card-title-group mb-3">
                <div class="card-title">
                    <h6 class="title">Sales Statistics</h6>
                </div>
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">{{$dateName}}</a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li><a href="#"><span>Daily</span></a></li>
                                <li><a href="#" class="active"><span>Weekly</span></a></li>
                                <li><a href="#"><span>Monthly</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nk-ecwg8-legends">
                <li>
                    <div class="title">
                        <span class="dot dot-lg sq" data-bg="#0fac81"></span>
                        <span>Total Quote</span>
                    </div>
                </li>
                <li>
                    <div class="title">
                        <span class="dot dot-lg sq" data-bg="#eb6459"></span>
                        <span>Canceled Quote</span>
                    </div>
                </li>
            </ul>
            <div class="nk-ecwg8-ck">
                <canvas class="ecommerce-line-chart-s4" id="salesStatistics"></canvas>
            </div>
            <div class="chart-label-group pl-5">
                <div class="chart-label">01 Jul, 2020</div>
                <div class="chart-label">30 Jul, 2020</div>
            </div>
        </div><!-- .card-inner -->
    </div>
</div><!-- .card -->
</div><!-- .col -->
<div class="col-xxl-3 col-md-6">
<div class="card card-full overflow-hidden">
    <div class="nk-ecwg nk-ecwg7 h-100">
        <div class="card-inner flex-grow-1">
            <div class="card-title-group mb-4">
                <div class="card-title">
                    <h6 class="title">Quote Statistics</h6>
                </div>
            </div>
            <div class="nk-ecwg7-ck">
                <canvas class="ecommerce-doughnut-s1" id="orderStatistics"></canvas>
            </div>
            <ul class="nk-ecwg7-legends">
                <li>
                    <div class="title">
                        <span class="dot dot-lg sq" data-bg="#0fac81"></span>
                        <span>Completed</span>
                    </div>
                </li>
                <li>
                    <div class="title">
                        <span class="dot dot-lg sq" data-bg="#e85347"></span>
                        <span>Canclled</span>
                    </div>
                </li>
                <li>
                    <div class="title">
                        <span class="dot dot-lg sq" data-bg="#816bff"></span>
                        <span>Processing</span>
                    </div>
                </li>
            </ul>
        </div><!-- .card-inner -->
    </div>
</div><!-- .card -->
</div><!-- .col -->

<div class="col-xxl-8">
<div class="card card-full">
    <div class="card-inner">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title">Recent Quotes</h6>
            </div>
        </div>
    </div>
    <div class="nk-tb-list mt-n2">
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span>Quote No.</span></div>
            <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
            <div class="nk-tb-col tb-col-sm"><span>Category</span></div>
            <div class="nk-tb-col tb-col-md"><span>Created At</span></div>
            <div class="nk-tb-col"><span>Quotations</span></div>
            <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
        </div>
        @foreach($quotes as $quote)
        <div class="nk-tb-item">
            <div class="nk-tb-col">
                <span class="tb-lead"><a href="#">#{{$quote->id}}</a></span>
            </div>
            <div class="nk-tb-col tb-col-sm">
                <div class="user-card">
                    <div class="user-avatar sm bg-purple-dim">
                        <span>{{mb_substr($quote->user->first_name, 0, 1)}}{{mb_substr($quote->user->last_name, 0, 1)}}</span>
                    </div>
                    <div class="user-name">
                        <span class="tb-lead">{{$quote->user->first_name}} {{$quote->user->last_name}}</span>
                    </div>
                </div>
            </div>

            <div class="nk-tb-col tb-col-md">
                <span>{{$quote->category->category_name}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-sub">{{\Carbon\Carbon::parse($quote->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>
            <div class="nk-tb-col">
                <span class="tb-sub tb-amount">{{count($quote->quotations)}}</span>
            </div>
            <div class="nk-tb-col">
                @if($quote->status == 'pending')
                    <span class="badge badge-light">Open for quoting</span>
                    @else
                     <span class="badge badge-success">Open</span>
                    @endif
            </div>
        </div>
        @endforeach
    </div>
</div><!-- .card -->
</div>
<div class="col-xxl-4 col-md-8 col-lg-6">
<div class="card h-100">
    <div class="card-inner">
        <div class="card-title-group mb-2">
            <div class="card-title">
                <h6 class="title">Top Service Providers</h6>
            </div>
            <div class="card-tools">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">{{$dateName}}</a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="{{ url('/?date=daily') }}" @if(Request::get('date') == 'daily') class="active" @endif><span>Daily</span></a></li>
                            <li><a href="{{ url('/?date=weekly') }}" @if(Request::get('date') == 'weekly' || Request::get('date') == null) class="active" @endif><span>Weekly</span></a></li>
                            <li><a href="{{ url('/?date=monthly') }}" @if(Request::get('date') == 'monthly') class="active" @endif><span>Monthly</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nk-top-products">
            @foreach($topSp as $sp)
            <li class="item">
                <div class="uploadimg">
                    @if($sp->user_img)
                    <div class="nk-msg-media user-avatar" style="margin-right: 15px;">
                    <img src="{{asset('frontend-assets/images/users/'.$sp->user_img)}}" alt="">
                    </div>
                    @else
                    <div class="user-avatar bg-primary" style="margin-right: 15px;">
                    <span>{{mb_substr($sp->first_name, 0, 1)}}{{mb_substr($sp->last_name, 0, 1)}}</span>
                    </div>
                    @endif
                </div>
                <div class="info">
                    <div class="title">{{$sp->first_name}} {{$sp->last_name}}</div>
                    <div class="price">{{count($sp->allQuoteSp)}} Quoted</div>
                </div>
                <?php
                 $won = 0;
                 foreach ($sp->allQuoteSp as $key => $value) {
                    if($value->wonquote != null){
                     $won ++;
                    }
                 }
                ?>
                <div class="total">
                    @if($sp->totalamount)
                     <?php $currency = Acelle\Jobs\HelperJob::usdcurrency($sp->totalamount); ?>
                    <div class="amount">{{$currency['currency']}} {{$currency['convert']}}</div>
                    @endif
                    <div class="count">{{$won}} Won</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div><!-- .card-inner -->
</div><!-- .card -->
</div><!-- .col -->
</div><!-- .row -->
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>
<!-- content @e -->
@endsection
@section('script')

<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/charts/chart-ecommerce.js?ver=2.9.1') }}"></script>

@endsection

