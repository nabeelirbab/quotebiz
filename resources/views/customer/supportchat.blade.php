@extends('customer.layout.app')
@section('title', 'Dashboard')
@section('content')
<!-- content @s -->

 <div id="app" class="mt-5">
        <customer-support-component authuser="{{Auth::user()->id}}"  userdata="{{Auth::user()}}"></customer-support-component>
  </div>
@endsection
@section('script')
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('frontend-assets/assets/js/apps/chats.js?ver=2.9.1') }}"></script> -->
    <!-- <script src="{{ asset('frontend-assets/assets/js/apps/messages.js?ver=2.9.1') }}"></script> -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/quill.css?ver=2.9.1') }}">
    <script src="{{ asset('frontend-assets/assets/js/libs/editors/quill.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/editors.js?ver=2.9.1') }}"></script>
    <script type="text/javascript">
        $(".nk-msg-item").click(function(){
            $("#chatbody").addClass("nkchatbody");
        });
    </script>

@endsection