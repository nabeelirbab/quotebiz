@extends('layouts.core.login')

@section('title', trans('messages.not_authorized'))

@section('content')
    <div class="alert alert-danger alert-styled-left">
        <span class="text-semibold">
            {{ trans('messages.you_are_not_activated') }}
        </span>
    </div>
    <a href='#back' onclick='history.back()' class='btn btn-secondary'>{{ trans('messages.go_back') }}</a>
    <a href='{{ url('users/resend-activation-email', ['uid' => $uid]) }}' class='btn btn-secondary'>{{ trans('messages.resend_activation_email') }}</a>
@endsection