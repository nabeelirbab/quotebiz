@extends('layouts.core.frontend')
@section('title', 'Credits Amount')
@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    @endsection
@section('content')


<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between g-3">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Credits Management</h3>
<div class="nk-block-des text-soft">
</div>
</div><!-- .nk-block-head-content -->

</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
@if(Session::has('success'))
     <div class="alert alert-success  fade show mt-5" role="alert">
      <strong>Credit!</strong> {{Session::get('success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 @endif
<div class="nk-block">
<div class="card card-bordered card-stretch  row m-0">
<div class="card-inner-group col-md-6 border-right p-0" >
<div class="card-inner text-center">
   <div class="card-title-group">
    <div class="card-title">
        <h5 class="title">Credit Bundles</h5>
    </div>
    <div class="nk-block-tools-opt">
       <a href="javascript:void(0)" class="btn btn-primary" onclick="openNav()"><em class="icon ni ni-plus"></em><span>Add Bundle</span></a>
    </div><!-- .card-tools -->
  
</div><!-- .card-title-group -->
    
</div><!-- .card-inner -->
<div class="card-inner  p-0 ">
<div class="nk-tb-list nk-tb-tnx">
    <div class="nk-tb-item nk-tb-head">
        <div class="nk-tb-col"><span>Bundle Name</span></div>
        <div class="nk-tb-col text-right"><span>Cost Amount</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Credits</span></div>
        <div class="nk-tb-col text-right tb-col-sm"><span>Created At</span></div>
        <div class="nk-tb-col text-center tb-col-sm"><span>Actions</span></div>
    </div><!-- .nk-tb-item -->
 @foreach($credits as $creadit)
    <div class="nk-tb-item">
        <div class="nk-tb-col">
            <div class="nk-tnx-type">
                
                <div class="nk-tnx-type-text">
                    <span class="tb-lead">{{$creadit->bundel_name}}</span>
                </div>
            </div>
        </div>
        
        <?php 
          $currencyConvert = Acelle\Jobs\HelperJob::setcurrency($creadit->currency,$creadit->credit_amount);
        ?>
        <div class="nk-tb-col text-right">
            <span class="tb-amount">{{$currencyConvert['convert']}}<span> {{$currencyConvert['currency']}}</span></span>
        </div>
        <div class="nk-tb-col tb-col-lg">
            <span class="tb-lead-sub">{{$creadit->credit}}</span>
        </div>
        <div class="nk-tb-col text-right tb-col-sm">
            <span class="tb-amount">{{\Carbon\Carbon::parse($creadit->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
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
                            <label class="form-label" >Bundle Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="bundel_name"  value="{{$creadit->bundel_name}}" placeholder="Enter Bundle Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Credit</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="credit"  value="{{$creadit->credit}}" placeholder="Enter Credit" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Currency</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="currency" readonly  value="{{\Acelle\Model\AdminCurrency::currency()}}" placeholder="Currency" required>
                            </div>
                        </div>
                    </div>
                   <!--  <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Currency</label>
                            <div class="form-control-wrap">
                              <select class="form-control" name="currency" required>
                                <option value="" selected>Select currency</option>
                                <option value="USD" {{$creadit && $creadit->currency == 'USD' ? 'selected': ''}}>USD</option>
                                <option value="EUR" {{$creadit && $creadit->currency == 'EUR' ? 'selected': ''}}>EUR</option>
                                <option value="AUD" {{$creadit && $creadit->currency == 'AUD' ? 'selected': ''}}>AUD</option>
                              </select>
                               
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Cost Amount</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="{{$creadit->credit_amount}}" name="credit_amount"  placeholder="Enter Amount" required>
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
</div><!-- .card-inner -->
{{$credits}}
<div class="card-inner">
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->

<div class="card-inner-group col-md-6 border-right p-0" >
<div class="card-inner text-center" style="padding: 1.5em;">
    <?php $quotePrice = Acelle\Jobs\HelperJob::quoteprice(); ?>
    <div class="card-title">
        <h5 class="title">Set Cost Per Quote</h5>
    </div>
    
</div><!-- .card-inner -->
<div class="card-inner  p-0 ">
<div class="nk-tb-list nk-tb-tnx">
 <form action="{{ url('/quoteprice') }}" method="post">
     {{ csrf_field() }}
     <input type="hidden" @if($quotePrice) value="{{$quotePrice->id}}" @endif name="id">
   <div class="form-row p-2">
     <div class="form-group col-md-12">
       <label for="inputState">Select option</label>
       <select id="inputState" class="form-control" name="type" onchange="quoteoption(this)" required>
         <option selected>Choose...</option>
         <option value="category" >BY CATEGORY</option>
         <option disabled>BY BUDGET</option>
         <option disabled>BY QUOTE AMOUNT</option>
       </select>
     </div>
     <div class="form-group col-md-12"  id="addOption">
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
        <div id="mySidepanel" class="sidepanel" style="height: 833px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <div class="preview-block">
         <form action="{{ url('credit-amount') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="row d-flex justify-content-center gy-4">
           
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="form-label" >Bundle Name</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="bundel_name" placeholder="Enter Bundle Name" required>
                    </div>
                </div>
            </div> 
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="form-label" >Credit</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="credit" placeholder="Enter Credit" required>
                    </div>
                </div>
            </div>
               <div class="col-sm-10">
                        <div class="form-group">
                            <label class="form-label" >Currency</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="currency" readonly  value="{{\Acelle\Model\AdminCurrency::currency()}}" placeholder="Currency" required>
                            </div>
                        </div>
                    </div>
       <!--      <div class="col-sm-10">
                <div class="form-group">
                    <label class="form-label">Currency</label>
                    <div class="form-control-wrap">
                          <select class="form-control" name="currency" required>
                            <option value="" selected>Select currency</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="AUD">AUD</option>
                          </select>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="form-label" >Cost Amount</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="credit_amount"  placeholder="Enter Amount" required>
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


@endsection
@section('script')

<script type="text/javascript">

function quoteoption(event){
   if(event.value == 'category'){
    var html ='<label for="inputState">Global credit cost per category</label>'+
       '<input type="number" @if($quotePrice) value="{{$quotePrice->price}}" @endif name="price" class="form-control" required ><br>'+
       '<div class="text-center"> <button class="btn btn-success btn-lg" type="submit">Save</button></div>';
       $('#addOption').html(html);
   }else{
    $('#addOption').html('');
   }
  
}
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