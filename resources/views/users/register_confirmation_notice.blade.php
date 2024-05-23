@extends('layouts.core.register')

@section('title', trans('messages.create_your_account'))

@section('content')

    <div class="panel panel-body p-4 rounded-3 shadow" style="background: rgba(255, 255, 255, 0.9);">
      
            
            <h1 class="mb-10">{{ trans('messages.email_confirmation') }}</h1>
            <p>{!! trans('messages.activation_email_sent_content') !!}</p>
                
    </div>
@endsection
