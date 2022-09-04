@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
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
<h3 class="nk-block-title page-title">Quotes </h3>
<div class="nk-block-des text-soft">
    <!-- <p>Parmanemt and part-time employee's payroll</p> -->
</div>
</div>

</div>
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="card card-bordered">
<ul class="nav nav-tabs nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
<li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#parmanent"><em class="icon ni ni-user-circle"></em><span>All Quotes</span></a>
</li>
<!-- <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#part-time"><em class="icon ni ni-repeat"></em><span>Quotes Sent </span>
    </a>
</li> -->
</ul>
<div class="tab-content mt-0">
<div class="tab-pane active" id="parmanent">
    <div class="nk-tb-list nk-tb-ulist border-bottom border-light">
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
           
            <div class="nk-tb-col tb-col-md h2"><span class="sub-text">#ID</span></div>
            <div class="nk-tb-col h2"><span class="sub-text">Customer</span></div>
            <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Category</span></div>
            <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Zip Code</span></div>
            <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Additional Information</span></div>
            <div class="nk-tb-col h2"><span class="sub-text">Quotations</span></div>
            <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Posted on</span></div>
            <div class="nk-tb-col tb-col-lg h2"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col h2"><span class="sub-text">Action</span></div>
         
        </div>
        <!-- .nk-tb-item -->
        @foreach($quotes as $quote)
        <div class="nk-tb-item">
            <div class="nk-tb-col tb-col-md">
                <span>{{$quote->id}}</span>
            </div>
              <div class="nk-tb-col">
                <a href="{{ url('customer_detail/'.$quote->user->id) }}">
                <div class="user-card">
                    <div class="user-avatar bg-primary">
                        <span>{{mb_substr($quote->user->first_name, 0, 1)}}{{mb_substr($quote->user->last_name, 0, 1)}}</span>
                    </div>
                    <div class="user-info">
                        <span class="tb-lead">{{$quote->user->first_name}} {{$quote->user->last_name}} 
                          <!-- <span class="dot dot-success d-md-none ml-1"></span> -->
                        </span>
                        <span>{{$quote->user->email}}</span>
                    </div>
                </div>
              </a>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{$quote->category->category_name}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{$quote->zip_code}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{Str::limit($quote->additional_info, 120, '...')}}</span>
            </div>
            <div class="nk-tb-col">
                <span  data-toggle="modal" data-target="#modalEdit{{$quote->id}}">{{count($quote->quotations)}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{\Carbon\Carbon::parse($quote->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                @if($quote->status == 'pending')
                    <span class="badge badge-light">Open for quoting</span>
                    @else
                     <span class="badge badge-success">Open</span>
                    @endif
            </div>
            <div class="nk-tb-col">
                    <span class="badge"> <button class="btn btn-sm btn-success" onclick="openNav('{{$quote->id}}')">View Details</button></span>
            </div>
        </div><!-- .nk-tb-item -->
           <div id="mySidepanel{{$quote->id}}" class="sidepanel" style="height: 100%;">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav('{{$quote->id}}')">×</a>
                    <div class="preview-block" style="padding: 24px;">
                        <div class="row">
                        <h5>{{$quote->category->category_name}} :</h5>
                        <br>

                         @foreach($quote->questionsget as $questions)
                           <div class="col-md-12 mt-1 mb-1">
                             <h6>{{$questions->questions->question}}</h6>
                             @foreach($questions->choice as $choices)
                             
                                 <p class="fs-6">{{$choices->choice_value}}</p>
                             @endforeach
                         </div>
                         @endforeach

                         <br>
                          <br>
                        <div class="mt-4">
                         <h6>Additional Information</h6>
                         <p>{{$quote->additional_info}}</p>
                         </div>
                     </div>
                    </div>
                   </div>
                   <div class="modal fade zoom" tabindex="-1" id="modalEdit{{$quote->id}}">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Quotations</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                    </a>
                    </div>
                    <div class="modal-body">
                    <div class="preview-block">
                    <div class="nk-tb-list nk-tb-ulist border-bottom border-light">
                    <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
                       
                        <div class="nk-tb-col h2"><span class="sub-text">#ID</span></div>
                        <div class="nk-tb-col h2"><span class="sub-text">Service Provider</span></div>
                        <div class="nk-tb-col h2"><span class="sub-text">Quote Amount</span></div>
                        <div class="nk-tb-col h2"><span class="sub-text">Quote</span></div>
                        <div class="nk-tb-col h2"><span class="sub-text">Created At</span></div>
                        </div>
                      @foreach($quote->quotations as $quotation)
                       <div class="nk-tb-item">
                          <div class="nk-tb-col">
                              <span>{{$quotation->id}}</span>
                          </div>
                          <div class="nk-tb-col">
                             <a href="{{ url('customer_detail/'.$quotation->user_id) }}"> <span>{{$quotation->sp->first_name}} {{$quotation->sp->last_name}}</span>
                             </a>
                          </div>
                          <div class="nk-tb-col">
                            <?php 
                              $currencyConvert = Acelle\Jobs\HelperJob::usdcurrency($quotation->quote_price); 
                             ?>
                            {{$currencyConvert['convert']}}<span> {{$currencyConvert['currency']}}</span></span>
                          </div>
                          <div class="nk-tb-col">
                              <span>{{$quotation->comment}}</span>
                          </div>
                          <div class="nk-tb-col">
                              <span>{{\Carbon\Carbon::parse($quotation->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
                          </div>
                        </div>
                      @endforeach
                    
                  </div>
                 
                    </div>
                    </div>

                    </div>
                    </div>
                </div>
        @endforeach
       
    </div>
    <!-- .nk-tb-list -->
</div>
    {{$quotes}}
<!--tab pan active-->

<!--tab pan-->
</div>
<!--tab content-->
</div>
<!--card-->
</div>
<!--nk block-->
</div>
</div>
</div>
</div>

@endsection
@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script type="text/javascript">
    function openNav(id) {
  // document.getElementById("mySidepanel").style.width = "35%";
  $('.toggle-expand').removeClass('active');
  $('.toggle-expand-content').removeClass('expanded');
  $('.toggle-expand-content').hide();
  $('#mySidepanel'+id).addClass('panelWidth');
}

function closeNav(id) {
  // document.getElementById("mySidepanel").style.width = "0";
  $('#mySidepanel'+id).removeClass('panelWidth');
}
</script>
@endsection

