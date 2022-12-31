@extends('layouts.core.backend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<style type="text/css">

</style>
@endsection

@section('content')
<div class="nk-content">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Customer Lists</h3>
<div class="nk-block-des text-soft">
   
</div>
</div><!-- .nk-block-head-content -->

<!-- .nk-block-head-content -->
</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="card card-bordered card-stretch">
<div class="card-inner-group">
<div class="card-inner position-relative card-tools-toggle">
    <div class="card-title-group">
        <div class="card-tools">
     @if(Session::has('success'))
         <div class="alert alert-success  fade show" role="alert">
          {{Session::get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     @endif
        </div><!-- .card-tools -->
        <div class="card-tools mr-n1">
            <ul class="btn-toolbar gx-1">
                <li>
                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                </li><!-- li -->
                <li class="btn-toolbar-sep"></li><!-- li -->
                
            </ul><!-- .btn-toolbar -->
        </div><!-- .card-tools -->
    </div>
    <!-- .card-title-group -->
    <div class="card-search search-wrap" data-search="search">
        <div class="card-body">
            <div class="search-content">
                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email" id="search">
                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
            </div>
        </div>
    </div><!-- .card-search -->
</div><!-- .card-inner -->
<div class="card-inner p-0">
    <div class="nk-tb-list nk-tb-ulist">
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
            <!-- <div class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" id="uid">
                    <label class="custom-control-label" for="uid"></label>
                </div>
            </div> -->
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">#ID</span></div>
            <div class="nk-tb-col"><span class="sub-text">User</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Domain</span></div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">Subdomain</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Registered On</span></div>
            <div class="nk-tb-col"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>

        </div><!-- .nk-tb-item -->
      @foreach($domains as $domain)
        <div class="nk-tb-item">
         
             <div class="nk-tb-col tb-col-lg">
                <span >{{$domain->id}}</span>
            </div>
            <div class="nk-tb-col">
                <a href="{{ url('admin/customer_detail/'.$domain->user->id) }}">
                    <div class="user-card">
                        <div class="user-avatar bg-primary">
                            <span>{{mb_substr($domain->user->first_name, 0, 1)}}{{mb_substr($domain->user->last_name, 0, 1)}}</span>
                        </div>
                        <div class="user-info">
                            <span class="tb-lead">{{$domain->user->first_name}} {{$domain->user->last_name}}
                            </span>
                            <span>{{$domain->user->email}}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span><a href="http://{{$domain->parent}}" target="_blank"> {{$domain->parent}}</a></span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{$domain->subdomain}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{$domain->updated_at}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{$domain->status}}</span>
            </div>
        </div>
        @endforeach
    
    </div><!-- .nk-tb-list -->
</div><!-- .card-inner -->
<div class="card-inner">
   
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->

</div>
</div>
</div>
</div>
<!-- content @e -->
@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>

<script>

</script>
@endsection
