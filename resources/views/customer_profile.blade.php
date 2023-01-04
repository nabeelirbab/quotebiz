@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">

<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
@endsection

@section('content')

<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between g-3">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">User / <strong class="text-primary small">{{$userdetail->first_name}} {{$userdetail->last_name}}</strong> &nbsp; 
	@if($userdetail->activated == '1')
	  <span class="badge badge-outline-success badge-pill">Active</span>
	@else
      <span class="badge badge-outline-danger badge-pill">Inactive</span>
	@endif
</h3> 
<div class="nk-block-des text-soft">
    <ul class="list-inline">
        <li>User ID: <span class="text-base">{{$userdetail->id}}</span></li>
        <li>Last Login: <span class="text-base">{{$userdetail->last_login_at}}</span></li>
    </ul>
</div>

</div>
<div class="nk-block-head-content">
 @if(Session::has('success'))
         <div class="alert alert-success  fade show" role="alert">
          {{Session::get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     @endif
 </div>
</div>
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="card card-bordered">
<div class="card-aside-wrap">
<div class="card-content">
    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
        <li class="nav-item">
            <a class="nav-link active" href="#"><em class="icon ni ni-user-circle"></em><span>Personal</span></a>
        </li>
         
        <li class="nav-item nav-item-trigger ">
            <div class="card-inner card-inner-sm">
            <ul class="btn-toolbar justify-center gx-1">
               
                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>
                @if($userdetail->activated == '1')
                <li><a href="{{ url('admin/account_status/'.$userdetail->id.'?status=0') }}" onclick="return confirm('Are you sure you want to suspend this account?');" class="btn btn-trigger btn-icon text-danger" title="Suspend Account"><em class="icon ni ni-na"></em></a></li>
                @else
                <li><a href="{{ url('admin/account_status/'.$userdetail->id.'?status=1') }}" onclick="return confirm('Are you sure you want to suspend this account?');" class="btn btn-trigger btn-icon" title="Active Account"><em class="icon ni ni-shield-check"></em></a></li>
                @endif
            </ul>
        </div><!-- .card-inner -->
        </li>
    </ul><!-- .nav-tabs -->
    <div class="card-inner">
        <div class="nk-block">
            <div class="nk-block-head">
                <h5 class="title">Personal Information</h5>
                <p>Basic info, like your name and address.</p>
            </div><!-- .nk-block-head -->
            <div class="profile-ud-list">
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">First Name</span>
                        <span class="profile-ud-value">{{$userdetail->first_name}}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Last Name</span>
                        <span class="profile-ud-value">{{$userdetail->last_name}}</span>
                    </div>
                </div>
               
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Mobile Number</span>
                        <span class="profile-ud-value">{{$userdetail->mobileno}}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Email Address</span>
                        <span class="profile-ud-value">{{$userdetail->email}}</span>
                    </div>
                </div>
                @if($userdetail->category)
                 <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Category</span>
                        <span class="profile-ud-value">{{$userdetail->category->category_name}}</span>
                    </div>
                </div>
                @endif
            </div><!-- .profile-ud-list -->
        </div><!-- .nk-block -->
        <div class="nk-block">
            <div class="nk-block-head nk-block-head-line">
                <h6 class="title overline-title text-base">Additional Information</h6>
            </div><!-- .nk-block-head -->
            <div class="profile-ud-list">
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Joining Date</span>
                        <span class="profile-ud-value">{{\Carbon\Carbon::parse($userdetail->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
                    </div>
                </div>

                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">City</span>
                        @if(Acelle\Jobs\HelperJob::cityname($userdetail->city))<span class="profile-ud-value">{{Acelle\Jobs\HelperJob::cityname($userdetail->city)->name}}</span> 
                        @else
                        <span class="profile-ud-value">{{$userdetail->city}}</span>
                        @endif
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Zip Code</span>
                        <span class="profile-ud-value">{{$userdetail->zipcode}}</span>
                    </div>
                </div>
            </div><!-- .profile-ud-list -->
        </div><!-- .nk-block -->
        <div class="nk-divider divider md"></div>
       
    </div><!-- .card-inner -->
</div><!-- .card-content -->

</div><!-- .card-aside-wrap -->
</div><!-- .card -->
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>
<!-- content @e -->

@endsection

@section('script')
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
@endsection