@extends('service_provider.layout.app')
@section('title', 'Quotes')

@section('styling')
 <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/quill.css?ver=2.9.1') }}">

<style type="text/css">
.nk-msg-head {
    padding: 1rem 1.5rem !important;
}
</style>
@endsection 
@section('content')

 <div id="app" class="mt-4">
        <responses-component authuser="{{Auth::user()->id}}" userdata="{{Auth::user()}}"></responses-component>
  </div>
@endsection
@section('script')
    <script src="{{ asset('frontend-assets/assets/js/apps/chats.js?ver=2.9.1') }}"></script>
    <!-- <script src="{{ asset('frontend-assets/assets/js/apps/messages.js?ver=2.9.1') }}"></script> -->
   
    <script src="{{ asset('frontend-assets/assets/js/libs/editors/quill.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/editors.js?ver=2.9.1') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
    
    <script type="text/javascript">
        $(".nk-msg-item").click(function(){
            $("#chatbody").addClass("nkchatbody");
        });
    </script>
@endsection