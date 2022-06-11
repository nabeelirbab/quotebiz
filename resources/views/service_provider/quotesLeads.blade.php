@extends('service_provider.layout.app')
@section('title', 'Quotes')

@section('styling')
 <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/quill.css?ver=2.9.1') }}">
 <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
@endsection
@section('content')

 <!-- content @s -->
  <div id="app" class="mt-4">
        <leads-component authuser="{{Auth::user()->id}}" creaditSum="{{Auth::user()->credits}}"></leads-component>
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