@extends('service_provider.layout.app')
@section('title', 'Quotes')

@section('styling')
 <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/quill.css?ver=2.9.1') }}">
 <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
 <style type="text/css">
  @media only screen and (max-width: 600px) {
   .nkchatbody {
    position: relative;
    opacity: 1;
    pointer-events: auto;
    max-height: calc(87vh - (65px + 0px));
    border-radius: 0px;
  }
  .creditsCost{
    float: right;
    padding-right: 1rem !important;
  }
}
.nk-msg-body {
    max-height: calc(100vh - (27px + 112px));
    overflow: auto;
    border-bottom: none !important;
    }
.btn-center-text {
      display: flex;
      justify-content: center;
      align-items: center;
  }
 </style>
@endsection
@section('content')
 <?php $quotePrice = Acelle\Jobs\HelperJob::quoteprice();
       if($quotePrice){
           $quotePrice = $quotePrice->price;
       }else{
           $quotePrice = 10;
       }

       // dd($quotePrice);
  ?>
 <!-- content @s -->
<div id="app" class="mt-4">
  <div class="nk-content mt-5">
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
    <a class="nav-link active" data-toggle="tab" href="#parmanent"><em class="icon ni ni-user-circle"></em><span>Lost Quotes</span></a>
</li>
<!-- <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#part-time"><em class="icon ni ni-repeat"></em><span>Quotes Sent </span>
    </a>
</li> -->
</ul>
<div class="tab-content mt-0">
<div class="tab-pane active" id="parmanent">
    <div class="nk-tb-list nk-tb-ulist border-light">
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
          <div class="nk-tb-col tb-col-md h2"><span class="sub-text">#</span></div>
          <div class="nk-tb-col h2"><span class="sub-text">Customer</span></div>
          <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Category</span></div>
          <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Address</span></div>
          <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Additional Information</span></div>
          <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Quotations</span></div>
          <div class="nk-tb-col tb-col-md h2"><span class="sub-text">Inquiry Date</span></div>
          <div class="nk-tb-col tb-col-lg h2"><span class="sub-text">Status</span></div>
          <div class="nk-tb-col h2"><span class="sub-text">Action</span></div>
        </div>
        <!-- .nk-tb-item -->
        @foreach($lostquotes as $key => $quote)
        <div class="nk-tb-item">
            <div class="nk-tb-col tb-col-md">
                <span>{{$key + 1}}</span>
            </div>
              <div class="nk-tb-col">
                <a href="{{ url('admin/customer_detail/'.$quote->user->id) }}">
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
            <div class="nk-tb-col tb-col-md">
                <span >{{count($quote->quotations)}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{\Carbon\Carbon::parse($quote->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                    <span class="badge badge-light">Lost</span>
            </div>
            <div class="nk-tb-col">
              <span class="badge"> <button class="btn btn-sm btn-success" onclick="openNav('{{$quote->id}}')">View Details</button></span>
            </div>
        </div><!-- .nk-tb-item -->
         <div id="mySidepanel{{$quote->id}}" class="sidepanel mt-5" style="top: 0px;height: 100%;background: #f3f3f3;padding-top: 0px;margin-top: 4.5rem !important;">
            <div class="d-flex justify-content-between align-items-center" style="background: white;padding: 2%;">
              <div style="">
            <a href="javascript:void(0)" class="button" onclick="closeNav('{{$quote->id}}')" style="height: 30px;min-width: 0px;line-height: 28px;">×</a>
            </div>
            <div style="margin-right: 10px;">
             <h5>{{$quote->category->category_name}}</h5>
                </div>
                <div>
                  
                </div>
             </div>
                  <div class="row card-panel" style="max-height: 80%;overflow: auto;">
                  <br>

                   @foreach($quote->questionsget as $questions)
                     <div class="col-md-12 mt-1 mb-1 p-0">
                       <h6>{{$questions->questions->question}}</h6>
                       @foreach($questions->choice as $choices)
                           <p class="fs-6">{{$choices->choice_value}}</p>
                       @endforeach
                   </div>
                   @endforeach
                   <br>
                    <br>
                  <div class="mt-4 p-0">
                   <h6>Additional Information</h6>
                   <p>{{$quote->additional_info}}</p>
                   </div>
               </div>
            <!--    <div class="d-flex justify-content-center align-items-center bg-white" style="height: 50px; ">
               <button class="btn btn-success w-90 btn-center-text" data-toggle="modal" data-target="#modalEdit{{$quote->id}}">Quote this lead</button>
             </div> -->
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
                 <div class="nk-chat-body" id="chatbody">
    <div class="nk-chat-panel" style="background: white;">
        <div class="row">
       
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="row">
                    @foreach($quote->questionsget as $questions)
                        <div class="col-md-6 mt-1 mb-1">
                            <h6>{{ $questions->questions->question }}</h6>
                            @foreach($questions->choice as $choices)
                                <span>{{ $choices->choice_value }},</span>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        @if($quote->additional_info)
                            <h6 class="title mb-1">Comment</h6>
                            <span class="sub-text">{{ $quote->additional_info }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2 mb-3">
                        <p style="font-size: 16px;"><b>Customers appreciate information specific to their job.</b></p>
                        <div class="card-inner p-0">
                            <!-- Create the editor container -->
                             <textarea id="commentVal{{$quote->id}}" class="form-control" placeholder="Enter your quote here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2 mb-5">
                        <div class="custom-control">
                            <input type="checkbox" class="custom-control-input" id="latest-sale">
                            <label class="custom-control-label" for="latest-sale"><b>Save this comment as a template</b></label>
                        </div>
                    </div>
                </div>

                @if($quote->myquotation)
                    <div class="row mt-3 justify-content-end">
                        <div class="col-md-4">
                            <button href="buy-credits" class="btn btn-success">Already Submit</button>
                        </div>
                    </div>
                @else
                    <div class="row mt-3 justify-content-end">
                        @if($quotePrice >= 10)
                            <div class="col-md-3 col-3 p-0">
                                @if($quote->category && $quote->category->credit_cost)
                                    <h5 class="p-0 mt-3 creditsCost">{{ $quote->category->credit_cost }} Credits</h5>
                                    <input type="hidden" value="{{ $quote->category->credit_cost }}">
                                @else
                                    <h5 class="p-0 mt-3">{{ $quoteprice }} Credits</h5>
                                    <input type="hidden" value="{{ $quoteprice }}">
                                @endif
                            </div>
                            <div class="col-md-7 col-xs-8">
                                <div class="input-group">
                                    <label style="position: absolute;bottom: 41px;">Quote Amount</label>
                                    <input type="number" class="form-control rounded-left" style="height: 50px" id="quoteAmount{{$quote->id}}" placeholder="What is the full amount you'd like to bid for this job?">
                                    <div class="input-group-append">
                                      <button id="sendQuoteButton{{$quote->id}}" class="btn btn-success" onclick="sendQuotation({{ $quote }})">Send Quote</button>
                                      <button id="loadingButton{{$quote->id}}" class="btn btn-success" style="display: none; background-color: #816bff !important; border-color: #816bff !important">
                                          Send Quote
                                          <div class="spinner-border text-secondary" role="status">
                                              <span class="sr-only">Loading...</span>
                                          </div>
                                      </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-7">
                                <span>Before sending a quotation, you need to buy credits.</span>
                            </div>
                            <div class="col-md-4">
                                <a href="buy-credits" class="btn btn-success">Buy Credits</a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
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
    {{$lostquotes}}
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
        <!-- <leads-component quoteprice='{{ $quotePrice }}' authuser="{{Auth::user()->id}}" creaditSum="{{Auth::user()->credits}}"></leads-component> -->
  </div>

                <!-- content @e -->
@endsection
@section('script')
    <script src="{{ asset('frontend-assets/assets/js/apps/chats.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/apps/messages.js?ver=2.9.1') }}"></script>
   
    <script src="{{ asset('frontend-assets/assets/js/libs/editors/quill.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/editors.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
        $(document).ready(function(){
          $(".nk-msg-body").removeClass("profile-shown");
        });

        $(".nk-msg-item").click(function(){
            $("#chatbody").addClass("nkchatbody");
        });

        $("#removeClass").click(function(){
            $("#chatbody").removeClass("nkchatbody");
        });
        function openNewquote(id){
           
           $.ajax({
                url: "{{url('service-provider/newjob/')}}/"+id,
                type:"get",
                dataType:"html",
                success:function(response){
                console.log(response);
                $('#appendQuoteDetail').html(response);
               
                },

            });
        }
        let isLoading = false;

    function sendQuotation(quoteQuestions) {
     

    // Log the entire object to check its structure
    console.log("Full quoteQuestions object:", quoteQuestions.user_id);

    // Log the id property to verify it exists
    var quoteId = quoteQuestions.id;
        var credits_cost = '';
        if (quoteQuestions.category && quoteQuestions.category.credit_cost) {
            credits_cost = quoteQuestions.category.credit_cost;
        } 

         var price = $('#quoteAmount'+quoteId).val();
        var comment = $('#commentVal'+quoteId).val();
        console.log(comment);

        if (price === '' && comment === '') {
            $('#commentVal'+quoteId).css('border-color', 'red');
            $('#quoteAmount'+quoteId).css('border-color', 'red');
            showToast("Please fill all missing fields", "error");
        } else if (price === '') {
            $('#quoteAmount'+quoteId).css('border-color', 'red');
            showToast("Please enter price", "error");
        } else if (comment === '') {
            $('#commentVal'+quoteId).css('border-color', 'red');
            showToast("Please enter quote", "error");
        } else {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $('#sendQuoteButton'+quoteId).hide();
            $('#loadingButton'+quoteId).show();

            $.ajax({
                url: '/service-provider/storequotation',
                method: 'POST',
                data: {
                    customer_id: quoteQuestions.user_id,
                    quote_id: quoteId,
                    quote_price: price,
                    credit_cost: credits_cost,
                    comment: comment,
                    _token: csrf_token
                },
                success: function(response) {
                    showToast("Quotation Sent Successfully", "success");

                    $('#loadingButton'+quoteId).hide();
                    $('#sendQuoteButton'+quoteId).show();
                    $('#comment'+quoteId).val('');
                    $('#quoteAmount'+quoteId).val('');
                   

                 
                },
                error: function(error) {
                    console.log(error);
                    showToast("An error occurred while sending the quote.", "error");
                    $('#loadingButton'+quoteId).hide();
                    $('#sendQuoteButton'+quoteId).show();
                }
            });
        }
    }

    function showToast(message, type) {
        var toastClass = type === "error" ? "bg-danger" : "bg-success";
        var toastHTML = `<div class="toast ${toastClass}" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-body">${message}</div>
        </div>`;
        $('#toastContainer').append(toastHTML);
        $('.toast').toast('show').on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }

 

    </script>

@endsection