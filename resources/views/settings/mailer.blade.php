@extends('layouts.core.frontend')

@section('title', trans('messages.settings'))

@section('page_header')

    <div class="page-title">				
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">{{ trans('messages.home') }}</a></li>
        </ul>
        <h1>
            <span class="text-gear"><span class="material-icons-outlined">
email
</span> {{ trans('messages.system_email') }}</span>
        </h1>				
    </div>

@endsection

@section('content')
	
    @if (count($errors) > 0 && $errors->has('smtp_valid'))
        <!-- Form Error List -->
        <div class="alert alert-danger alert-noborder">
            <ul>
                @foreach ($errors->all() as $key => $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ url('admin/mail') }}" method="POST" class="form-validate-jqueryz mailer-form">
        {{ csrf_field() }}
        
        <div class="tabbable">
           @include("account._menu")

            <div class="tab-content">
                <p>{{ trans('messages.system_email.intro') }}</p>

                @include("settings._mailer")
            </div>
        </div>
    </form>
        
    <script>
        function toogleMailer() {
            var value = $("select[name='env[MAIL_MAILER]']").val();
            $('.mailer-setting').hide();
            $('.mailer-setting.' + value).show();
        }
        
        $(document).ready(function() {
            // SMTP toogle
            toogleMailer();

            $("select[name='env[MAIL_MAILER]']").change(function() {
                toogleMailer();
            });
        });
    </script>
@endsection
