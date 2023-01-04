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
        <leads-component quoteprice='{{ $quotePrice }}' authuser="{{Auth::user()->id}}" creaditSum="{{Auth::user()->credits}}"></leads-component>
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
    </script>
@endsection