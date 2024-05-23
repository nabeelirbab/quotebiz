@extends('layouts.core.login')

@section('title', trans('messages.password_reset'))

@section('content')
    
    <!-- send reset password email -->
    <form class="" role="form" method="POST" action="{{ url('/reset-password') }}">
        {{ csrf_field() }}
        
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="panel panel-body p-4 rounded-3 shadow" style="background: rgba(255, 255, 255, 0.9);">                        
            
            @if (session('status'))
                <div class="alert alert-success">
        {{ session('status') }}
                </div>
            @endif

             @if (session('error'))
                <div class="alert alert-danger">
        {{ session('error') }}
                </div>
            @endif
            
            <h4 class="text-semibold mt-0">{{ trans('messages.password_reset') }}</h4>
            
            <div class="form-group has-feedback has-feedback-left{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" placeholder="{{ trans("messages.email") }}" value="{{ $email ?? old('email') }}">
                <div class="form-control-feedback has-label">
        <i class="icon-envelop5 text-muted"></i>
                </div>
                @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
                @endif                            
            </div>
                
            <div class="form-group has-feedback has-feedback-left{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="{{ trans("messages.password") }}">
                <div class="form-control-feedback">
        <i class="icon-lock2 text-muted"></i>
                </div>
                @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
                @endif
            </div>
                
            <div class="form-group has-feedback has-feedback-left{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ trans("messages.confirm_password") }}">
                <div class="form-control-feedback">
        <i class="icon-lock2 text-muted"></i>
                </div>
                @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
                @endif
            </div>
            
            <button type="submit" class="btn btn-secondary">
                {{ trans('messages.reset_password') }}  <i class="icon-circle-right2 position-right"></i>
            </button>
            @if(request('account'))
            <a href="{{ url("/users/login") }}" class="btn btn-light">
                {{ trans("messages.return_to_login") }}
            </a>
            @else
               <a href="{{ url("/login") }}" class="btn btn-light">
                {{ trans("messages.return_to_login") }}
            </a>
            @endif
            
        </div>
    </form>
    <!-- /send reset password email -->                
    
@endsection



