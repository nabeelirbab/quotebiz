@extends('service_provider.layout.app')
@section('title', 'Dashboard')
@section('styling')
 
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
<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Dashboard</h3>
            <div class="nk-block-des text-soft">
                <p>Welcome to {{\Acelle\Model\Setting::get("site_name")}} Dashboard.</p>
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
                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
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
                                <h6 class="title">Today Quotes</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="">
                                <div class="amount">0</div>
                              <!--   <div class="nk-ecwg6-ck">
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div> -->
                            </div>
                           
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
                                <h6 class="title">Today Revenue</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="">
                                <div class="amount">$0</div>
                              
                            </div>
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
                                <h6 class="title">Today Customers</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="">
                                <div class="amount">0</div>
                              
                            </div>
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
                                <h6 class="title">Today Visitors</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="">
                                <div class="amount">0</div>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
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
                        <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                        <div class="nk-tb-col"><span>Amount</span></div>
                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95954</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar sm bg-purple-dim">
                                    <span>AB</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Abu Bin Ishtiyak</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">02/11/2020</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs badge-success">Paid</span>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95850</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar sm bg-azure-dim">
                                    <span>DE</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Desiree Edwards</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">02/02/2020</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">596.75 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs badge-danger">Canceled</span>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95812</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar sm bg-warning-dim">
                                    <img src="./images/avatar/b-sm.jpg" alt="">
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Blanca Schultz</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">02/01/2020</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">199.99 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs badge-success">Paid</span>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95256</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar sm bg-purple-dim">
                                    <span>NL</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Naomi Lawrence</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">01/29/2020</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs badge-success">Paid</span>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95135</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar sm bg-success-dim">
                                    <span>CH</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Cassandra Hogan</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">01/29/2020</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs badge-warning">Due</span>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div>
        <div class="col-xxl-8 mb-4">
            <div class="card card-full">
                <div class="nk-ecwg nk-ecwg8 h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-3">
                            <div class="card-title">
                                <h6 class="title">Sales Statistics</h6>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">Weekly</a>
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
      
       
    </div><!-- .row -->
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>
<!-- content @e -->
@endsection
@section('script')
<script src="{{ asset('frontend-assets/assets/js/charts/chart-ecommerce.js?ver=2.9.1') }}"></script>

@endsection