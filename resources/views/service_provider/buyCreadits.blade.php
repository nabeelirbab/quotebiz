@extends('service_provider.layout.app')
@section('title', 'Quotes')

@section('styling')
 <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/quill.css?ver=2.9.1') }}">
 <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
 <style type="text/css">
     .maincard{
        border: 1px solid #eae3e3;
        border-radius: 13px;
        padding: 16px;
        background: white;
     }
     .cardheader{
        border-bottom: 1px solid #eae3e3;
        padding: 20px 0 20px 2px;  
     }
     .cardfooter{
        border-top: 1px solid #eae3e3;
        padding: 20px 0 20px 2px;  
     }
 </style>
@endsection
@section('content')
<div class="container mt-5">
 @if(Session::has('success'))
     <div class="alert alert-success  fade show mt-5" role="alert">
      <strong>Payment successful!</strong> {{Session::get('success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 @endif
<div class="up-card pt-0 pb-0 maincard mt-5 mb-3">

          <header class="up-card-header cardheader">
            <h3 id="heading" class="mb-0">
          Buy Credits
        </h3>
      </header>
       <section class="up-card-section mt-3 mb-4">
        <h5 id="para01" class="mb-10 para">
          Your available Credits
        </h5>
         <div id="connects-balance">
           
            
            {{ Auth::user()->credits}}
           
        </div> <!---->
         <h5 id="para02" class="mt-5 mb-10 para">
          Select the amount to buy
        </h5>
         <div class="row">
          <div class="col-lg-5 col-md-6 col-sm-12">
            <select class="form-control" id="getprice">
                @foreach(Acelle\Jobs\HelperJob::creditAmounts() as $creadit)
                <option value="{{$creadit->credit}},{{$creadit->credit_amount}},{{$creadit->id}}">{{$creadit->credit}} for ${{$creadit->credit_amount}}</option>
                @endforeach
            </select>
          </div>
        </div>
         <h5 id="para03" class="mt-5 mb-10 para">
            Your account will be charged
          </h5>
           <div id="charge-amount">
            
                $1.50
              </div> <!----> <!---->
           <h5 id="para04" class="mt-5 mb-10 para">
          Your new Credits balance will be
        </h5> <div id="new-balance">
          46
        </div> 
       
           <div id="note01" class="mt-3 pt-10 text-muted"><span class="d-none-mobile-app">
            This bundle of Connects will expire 1 year from today.
          </span>
          Unused Connects rollover to the next month
          (maximum of 200).
          <a aria-label="Learn more about Connects" href="https://support.upwork.com/hc/en-us/articles/211062898" rel="noopener noreferrer" target="_blank" class="d-none-mobile-app">
            Learn more
          </a></div>
           <div id="note02" class="text-muted d-none-mobile-app">
          You're authorizing Upwork to charge your account.
          If you have sufficient funds, we will withdraw from your account balance.
          If not, the full amount will be charged to your primary billing method.
          <a aria-label="Learn more about billing methods" href="https://support.upwork.com/hc/en-us/articles/211062918" rel="noopener noreferrer" target="_blank">
            Learn more
          </a></div>
      </section> 
          <footer class="cardfooter d-none-mobile-app text-right">
             <form action="{{ url('service-provider/payment') }}" id="paymentForm" method="post">
                 {{csrf_field()}}
                 <input type="hidden" name="id" id="paymentValue">
             </form>
            <button id="footerButtonMain" type="submit" form="paymentForm" class="btn btn-primary up-btn-block-sm mb-0 d-none-mobile-app">
              Buy Credits
            </button> 
    </footer>
</div>

</div>
@endsection
@section('script')
    <script src="{{ asset('frontend-assets/assets/js/apps/chats.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/apps/messages.js?ver=2.9.1') }}"></script>
   
    <script src="{{ asset('frontend-assets/assets/js/libs/editors/quill.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/editors.js?ver=2.9.1') }}"></script>
    
    <script type="text/javascript">
        
            var creadits = '{{ Auth::user()->credits}}';
           
         
        $(document).ready(function(){
          $(".nk-msg-body").removeClass("profile-shown");
          $("#getprice").trigger('change');
        });

        $(".nk-msg-item").click(function(){
            $("#chatbody").addClass("nkchatbody");
        });

        $("#removeClass").click(function(){
            $("#chatbody").removeClass("nkchatbody");
        });

        $("#getprice").change(function() {
               console.log(creadits);
               var sum = 0;
               var result = $(this).val().split(',');
               var sum = Number(creadits) + Number(result[0]);
               console.log(sum);
               $('#new-balance').text(sum);
               $('#charge-amount').text('$'+result[1]);
               $('#paymentValue').val(result[2]);
        });
    </script>
@endsection