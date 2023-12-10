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
        .switch {
  position: relative;
  display: inline-block;
  width: 90px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(55px);
  -ms-transform: translateX(55px);
  transform: translateX(55px);
}

/*------ ADDED CSS ---------*/
.on
{
  display: none;
}

.on
{
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 35%;
  font-size: 12px;
  font-family: Verdana, sans-serif;
}
.off
{
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 65%;
  font-size: 12px;
  font-family: Verdana, sans-serif;
}

input:checked+ .slider .on
{display: block;}

input:checked + .slider .off
{display: none;}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;}
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
     <div class="alert alert-success alert-dismissible fade in mt-1" role="alert">
      <button class="close" type="button" data-dismiss="alert"></button>
      <strong>Domain!</strong> {{Session::get('success')}}
    </div>
 @endif
<div class="nk-block">
<div class="row g-gs justify-center">

<div class="col-xxl-6 col-sm-6">
<div class="card">
<div class="card-inner-group p-0" >
<div class="card-inner text-center" style="padding: 1.5em;border:0px">
    <div class="card-title">
        <h5 class="title">Set Custom Domain</h5>

    </div>
    @if(@Auth::user()->customdomain->parent)
    <ul class="uldesign" >
      <li>Log in to your Domain registrar's account.</li>
      <li>Select the domain ({{Auth::user()->customdomain->parent}})</li>
      <li>Create a "A" type entry with host name as "@" point to IPv4 "143.198.155.146"</li>
    </ul>
    <label class="switch float-right">
     <input type="checkbox" id="togBtn" {{Auth::user()->customdomain->status == 'active'? 'checked': ''}}>
     <div class="slider round">
      <!--ADDED HTML -->
      <span class="on">Active</span>
      <span class="off">Inactive</span>
      <!--END-->
     </div>
    </label>
    @endif
 
</div><!-- .card-inner -->
<div class="card-inner  p-0 ">
<div class="nk-tb-list nk-tb-tnx">
 <form action="{{ url('/admin/custom-domain') }}" method="post">
     {{ csrf_field() }}
   <div class="form-row p-2">
     <div class="form-group col-md-12"  id="addOption">
      <label for="inputState">Add your domain</label>
       <input type="domain" @if(Auth::user()) value="{{@Auth::user()->customdomain->parent}}" @endif name="parent" class="form-control" required ><br>
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
document.querySelector("#togBtn").onchange = (e) => {
  let checked = e.target.checked;
  if (checked) {
    console.log("checked !");
    window.location.href = '{{ url("admin/domain-status?status=active")}}';
  } else {
    console.log("unchecked...");
    window.location.href = '{{ url("admin/domain-status?status=inactive")}}';
  }
}
</script>
@endsection