@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}"> 
<style type="text/css">
    .card-title{
        text-align: center;
    }
    .data{
        text-align: center;
    }
</style>
@endsection

@section('content')
<?php
$currencySymbols = [
    'AED' => 'د.إ',
    'AFN' => 'Af',
    'ALL' => 'Lek',
    'AMD' => 'դ',
    'ANG' => 'ƒ',
    'AOA' => 'Kz',
    'ARS' => '$',
    'AUD' => '$',
    'AWG' => 'ƒ',
    'AZN' => '₼',
    'BAM' => 'KM',
    'BBD' => '$',
    'BDT' => '৳',
    'BGN' => 'лв',
    'BHD' => '.د.ب', 
    'BIF' => 'FBu',
    'BMD' => '$',
    'BND' => '$',
    'BOB' => '$b',
    'BRL' => 'R$',
    'BSD' => '$',
    'BTN' => 'Nu.',
    'BWP' => 'P',
    'BYR' => 'p.',
    'BZD' => 'BZ$',
    'CAD' => '$',
    'CDF' => 'FC',
    'CHF' => 'CHF',
    'CLF' => 'UF',
    'CLP' => '$',
    'CNY' => '¥',
    'COP' => '$',
    'CRC' => '₡',
    'CUP' => '⃌',
    'CVE' => '$', 
    'CZK' => 'Kč',
    'DJF' => 'Fdj',
    'DKK' => 'kr',
    'DOP' => 'RD$',
    'DZD' => 'دج',
    'EGP' => 'E£',
    'ETB' => 'Br',
    'EUR' => '€',
    'FJD' => '$',
    'FKP' => '£',
    'GBP' => '£',
    'GEL' => 'ლ',
    'GHS' => '¢',
    'GIP' => '£',
    'GMD' => 'D', 
    'GNF' => 'FG',
    'GTQ' => 'Q',
    'GYD' => '$',
    'HKD' => '$',
    'HNL' => 'L',
    'HRK' => 'kn',
    'HTG' => 'G',
    'HUF' => 'Ft',
    'IDR' => 'Rp',
    'ILS' => '₪',
    'INR' => '₹',
    'IQD' => 'ع.د',
    'IRR' => '﷼',
    'ISK' => 'kr',
    'JEP' => '£',
    'JMD' => 'J$',
    'JOD' => 'JD',
    'JPY' => '¥',
    'KES' => 'KSh',
    'KGS' => 'лв',
    'KHR' => '៛',
    'KMF' => 'CF', 
    'KPW' => '₩',
    'KRW' => '₩',
    'KWD' => 'د.ك',
    'KYD' => '$',
    'KZT' => '₸',
    'LAK' => '₭',
    'LBP' => '£',
    'LKR' => '₨',
    'LRD' => '$',
    'LSL' => 'L',
    'LTL' => 'Lt',
    'LVL' => 'Ls',
    'LYD' => 'ل.د', 
    'MAD' => 'د.م.',
    'MDL' => 'L',
    'MGA' => 'Ar',
    'MKD' => 'ден',
    'MMK' => 'K',
    'MNT' => '₮',
    'MOP' => 'MOP$', 
    'MRO' => 'UM', 
    'MUR' => '₨', 
    'MVR' => '.ރ',
    'MWK' => 'MK',
    'MXN' => '$',
    'MYR' => 'RM',
    'MZN' => 'MT',
    'NAD' => '$',
    'NGN' => '₦',
    'NIO' => 'C$',
    'NOK' => 'kr',
    'NPR' => '₨',
    'NZD' => '$',
    'OMR' => '﷼',
    'PAB' => 'B/.',
    'PEN' => 'S/.',
    'PGK' => 'K',
    'PHP' => '₱',
    'PKR' => '₨',
    'PLN' => 'zł',
    'PYG' => 'Gs',
    'QAR' => '﷼',
    'RON' => 'lei',
    'RSD' => 'Дин.',
    'RUB' => '₽',
    'RWF' => 'ر.س',
    'SAR' => '﷼',
    'SBD' => '$',
    'SCR' => '₨',
    'SDG' => '£',
    'SEK' => 'kr',
    'SGD' => '$',
    'SHP' => '£',
    'SLL' => 'Le', 
    'SOS' => 'S',
    'SRD' => '$',
    'STD' => 'Db',
    'SVC' => '$',
    'SYP' => '£',
    'SZL' => 'L',
    'THB' => '฿',
    'TJS' => 'TJS',
    'TMT' => 'm',
    'TND' => 'د.ت',
    'TOP' => 'T$',
    'TRY' => '₤',
    'TTD' => '$',
    'TWD' => 'NT$',
    'TZS' => 'TSh',
    'UAH' => '₴',
    'UGX' => 'USh',
    'USD' => '$',
    'UYU' => '$U',
    'UZS' => 'лв',
    'VEF' => 'Bs',
    'VND' => '₫',
    'VUV' => 'VT',
    'WST' => 'WS$',
    'XAF' => 'FCFA',
    'XCD' => '$',
    'XDR' => 'SDR',
    'XOF' => 'FCFA',
    'XPF' => 'F',
    'YER' => '﷼',
    'ZAR' => 'R',
    'ZMK' => 'ZK', 
    'ZWL' => 'Z$',
];
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
            @if($subscription->plan_id == 1)
            <li class="nk-block-tools-opt"><a href="{{ url('admin/account/subscription?upgrade='.$subscription->plan_id) }}" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Upgrade Plan</span></a></li>
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
            <div class="">
                <div class="card-title">
                    <h6 class="title">Quotes</h6>
                </div>
            </div>
            <div class="data">
                <div class="">
                    <div class="amount">{{$quoteCount}}</div>
                    <!-- <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                    </div> -->
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
            <div class="">
                <div class="card-title">
                    <h6 class="title">Total Revenue</h6>
                </div>
            </div>
            <div class="data">
                <div class="">
                    <div class="amount">
                         <?php 
                              $currencyConvert = Acelle\Jobs\HelperJob::usdcurrency($totalRevenue); 
                             ?>
                       <?php
                      foreach($currencySymbols as $key=>$value){
                                if($key == $currencyConvert['currency']){
                                  echo $value;
                                }
                            }
                      ?>{{$currencyConvert['convert']}} <span class="fs-5">{{$currencyConvert['currency']}}</span></div>
                    <!-- <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                    </div> -->
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
            <div class="">
                <div class="card-title">
                    <h6 class="title">Customers</h6>
                </div>
            </div>
            <div class="data">
                <div class="">
                    <div class="amount">{{$customerCount}}</div>
                   <!--  <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                    </div> -->
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
            <div class="">
                <div class="card-title">
                    <h6 class="title">Service Providers</h6>
                </div>
            </div>
            <div class="data">
                <div class="">
                    <div class="amount">{{$providerCount}}</div>
                   <!--  <div class="nk-ecwg6-ck">
                        <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                    </div> -->
                </div>
                <!-- <div class="info"><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>2.34%</span><span> vs. last week</span></div> -->
            </div>
        </div><!-- .card-inner -->
    </div><!-- .nk-ecwg -->
</div><!-- .card -->
</div><!-- .col -->

<div class="col-xxl-8">
<div class="card card-full">
    <div class="card-inner">
        <div class="">
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
        <div class=" mb-2">
            <div class="card-title">
                <h6 class="title">Top Service Providers</h6>
            </div>
            <div class="card-tools">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">{{$dateName}}</a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="{{ url('admin/?date=daily') }}" @if(Request::get('date') == 'daily') class="active" @endif><span>Daily</span></a></li>
                            <li><a href="{{ url('admin/?date=weekly') }}" @if(Request::get('date') == 'weekly' || Request::get('date') == null) class="active" @endif><span>Weekly</span></a></li>
                            <li><a href="{{ url('admin/?date=monthly') }}" @if(Request::get('date') == 'monthly') class="active" @endif><span>Monthly</span></a></li>
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
<div class="col-xxl-9">
<div class="card card-full">
    <div class="nk-ecwg nk-ecwg8 h-100">
        <div class="card-inner">
            <div class=" mb-3">
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
                 <canvas class="sales-bar-chart" id="activeSubscription"></canvas>
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
            <div class=" mb-4">
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
<script src="{{ asset('frontend-assets/assets/js/charts/gd-default.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/charts/chart-ecommerce.js?ver=2.9.1') }}"></script>

@endsection

