@extends('layouts.core.backend')

@section('title', $list->name)

@section('page_header')

    @include("admin.lists._header")

@endsection

@section('content')

    @include("admin.lists._menu")

    <form action="{{ action('Admin\MailListController@update', $list->uid) }}" method="POST" class="form-validate-jqueryz">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">

        @include("admin.lists._form")
        <hr>
        <div class="text-left">
            <button class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save') }}</button>
            <a href="{{ action('Admin\MailListController@index') }}" class="btn btn-link"><i class="icon-cross2"></i> {{ trans('messages.cancel') }}</a>
        </div>
    </form>
@endsection
