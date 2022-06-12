@extends('layouts.core.frontend')
@section('title', 'Date Format')
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
<h3 class="nk-block-title page-title">Date Format</h3>
<div class="nk-block-des text-soft">
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">
    <div class="toggle-wrap nk-block-tools-toggle">
        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
        <div class="toggle-expand-content" data-content="pageMenu">
            <ul class="nk-block-tools g-3">
                
                <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary" onclick="openNav()"><em class="icon ni ni-plus"></em><span>Add Amount</span></a></li>
            </ul>
        </div>
    </div><!-- .toggle-wrap -->
</div><!-- .nk-block-head-content -->
</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
@if(Session::has('success'))
     <div class="alert alert-success  fade show mt-5" role="alert">
      <strong>Date Format!</strong> {{Session::get('success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 @endif
<div class="nk-block">
<div class="card card-bordered card-stretch">
<div class="card-inner-group">
<div class="card-inner">
<div class="card-title-group">
    <div class="card-title">
        <h5 class="title">Date Format</h5>
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
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><span>#ID</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Credits</span></div>
        <div class="nk-tb-col text-right"><span>Amount</span></div>
        <div class="nk-tb-col text-right tb-col-sm"><span>Created At</span></div>
        <div class="nk-tb-col text-center tb-col-sm"><span>Actions</span></div>
    </div><!-- .nk-tb-item -->
 @foreach($credits as $creadit)
    <div class="nk-tb-item">
        <div class="nk-tb-col">
            <div class="nk-tnx-type">
                
                <div class="nk-tnx-type-text">
                    <span class="tb-lead">{{$creadit->id}}</span>
                </div>
            </div>
        </div>
        <div class="nk-tb-col tb-col-lg">
            <span class="tb-lead-sub">{{$creadit->credit}}</span>
        </div>
        <div class="nk-tb-col text-right">
            <span class="tb-amount">{{$creadit->credit_amount}} <span>USD</span></span>
        </div>
        <div class="nk-tb-col text-right tb-col-sm">
            <span class="tb-amount">{{$creadit->created_at}}</span>
        </div>
        <div class="nk-tb-col text-center">
            
            <span class="badge badge-sm badge-dim badge-outline-success" onclick="openNavEdit('{{$creadit->id}}')" style="cursor: pointer;">Edit</span>
            <a href="{{ url('deletecredit/'.$creadit->id) }}" class="badge badge-sm badge-dim badge-outline-danger" style="cursor: pointer;">Delete</a>
        </div>
    </div><!-- .nk-tb-item -->
    <div id="mySidepanel{{$creadit->id}}" class="sidepanel" style="top: 60px;height: 650px;">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNavEdit('{{$creadit->id}}')">×</a>
            <div class="preview-block" style="padding: 24px;">
             <form action="{{ url('credit-amount') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   <input type="hidden" name="id" value="{{$creadit->id}}">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Credit</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="credit"  value="{{$creadit->credit}}" placeholder="Enter Credit">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Amount</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$creadit->credit_amount}}" name="credit_amount"  placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>
                 
                    <div class="col-sm-10 text-center mb-5">
                        <button class="btn btn-success btn-lg" type="submit">Save</button>
                    </div>

                   
                </div>
              </form>
            </div>
           </div>
    @endforeach
 
</div><!-- .nk-tb-list -->

        <div id="mySidepanel" class="sidepanel" style="height: 833px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <div class="preview-block">
         <form action="{{ url('credit-amount') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="row d-flex justify-content-center gy-4">
           
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="form-label" >Credit</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="credit" placeholder="Enter Credit">
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="form-label" >Amount</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="credit_amount"  placeholder="Enter Amount">
                    </div>
                </div>
            </div>
         
            <div class="col-sm-10 text-center mb-5">
                <button class="btn btn-success btn-lg" type="submit">Save</button>
            </div>

           
        </div>
      </form>
    </div>
   </div>

</div><!-- .card-inner -->
{{$credits}}
<div class="card-inner">
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
function openNav() {
  // document.getElementById("mySidepanel").style.width = "35%";
  $('.toggle-expand').removeClass('active');
  $('.toggle-expand-content').removeClass('expanded');
  $('.toggle-expand-content').hide();
  $('#mySidepanel').addClass('panelWidth');
}

function closeNav() {
  // document.getElementById("mySidepanel").style.width = "0";
  $('#mySidepanel').removeClass('panelWidth');
}

function openNavEdit(id) {

  $('.toggle-expand').removeClass('active');
  $('.toggle-expand-content').removeClass('expanded');
  $('.toggle-expand-content').hide();
  $('#mySidepanel'+id).addClass('panelWidth');
}

function closeNavEdit(id) {
  $('#mySidepanel'+id).removeClass('panelWidth');
    }
</script>
@endsection