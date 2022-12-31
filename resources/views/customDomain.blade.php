@extends('layouts.core.frontend')
@section('title', 'Custom Domain')
@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
      .editcurrency{
        padding: 0;
        font-size: 15px !important;
        color: #3fbd9a !important;
        display: contents !important;
      }
       .form-group:last-child {
            margin-bottom: 0px !important;
        }
       .uldesign{
        list-style: auto;
        text-align: justify;
        padding: 10px;
        font-size: 15px;
       }
       .uldesign li{
         list-style: auto;
         margin-bottom: 5px;
       }
       .fade.in {
          opacity: 1
        }

        .fade {
          opacity: 0;
          -webkit-transition: opacity .15s linear;
          -o-transition: opacity .15s linear;
          transition: opacity .15s linear
        }
    </style>
    @endsection
@section('content')
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between g-3">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Custom Domain</h3>
<div class="nk-block-des text-soft">
</div>
</div><!-- .nk-block-head-content -->
 <a href="" style="float: right;"><h6>How to mapping custom domain</h6></a>

</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
@if(Session::has('success'))
     <div class="alert alert-success alert-dismissible fade in mt-5" role="alert">
      <button class="close" type="button" data-dismiss="alert"></button>
      <strong>Domain!</strong> {{Session::get('success')}}
    </div>
 @endif
<div class="nk-block">
<div class="row g-gs justify-center">

<div class="col-xxl-6 col-sm-6">
<div class="card">
<div class="card-inner-group p-0" >
<div class="card-inner text-center" style="padding: 1.5em;">
    <div class="card-title">
        <h5 class="title">Set Custom Domain</h5>

    </div>
    @if(Auth::user()->customdomain->parent)
    <ul class="uldesign" >
      <li>Log in to your Domain registrar's account.</li>
      <li>Select the domain ({{Auth::user()->customdomain->parent}})</li>
      <li>Create a CNAME entry with host name as "*".</li>
      <li>Map the CNAME entry to {{Auth::user()->customdomain->subdomain}}.quotebiz.io</li>
    </ul>
    @endif
 
</div><!-- .card-inner -->
<div class="card-inner  p-0 ">
<div class="nk-tb-list nk-tb-tnx">
 <form action="{{ url('/admin/custom-domain') }}" method="post">
     {{ csrf_field() }}
   <div class="form-row p-2">
     <div class="form-group col-md-12"  id="addOption">
      <label for="inputState">Add your domain</label>
       <input type="domain" @if(Auth::user()) value="{{Auth::user()->customdomain->parent}}" @endif name="parent" class="form-control" required ><br>
       <div class="text-center"> <button class="btn btn-success btn-lg" type="submit">Save</button></div>
     </div>
  </form>
</div><!-- .nk-tb-list -->
</div><!-- .card-inner -->

</div><!-- .card-inner-group -->
</div><!-- .card -->

</div><!-- .nk-block -->
</div>
</div>
</div>
</div>

@endsection
@section('script')

<script type="text/javascript">

</script>
@endsection