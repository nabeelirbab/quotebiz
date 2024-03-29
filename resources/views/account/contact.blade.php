@extends('layouts.core.frontend')

@section('title', trans('messages.contact_information'))
@section('head')
<style type="text/css">
   .btn > span:only-child, .dual-listbox .dual-listbox__button > span:only-child {
    width: -1% !important;
}
</style>
@endsection
@section('page_header')

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li class="breadcrumb-item"><a href="{{ url("/admin") }}">{{ trans('messages.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('messages.contact_information') }}</li>
        </ul>
        <h1>
            <span class="text-semibold"><i class="icon-address-book3"></i> {{ $customer->user->displayName() }}</span>
        </h1>
    </div>

@endsection

@section('content')

    @include("account._menu")

    <form enctype="multipart/form-data" action="{{ url('admin/account/contact') }}" method="POST" class="form-validate-jqueryz">
        {{ csrf_field() }}

        <h2 class="text-semibold text-primary mb-4">{{ trans('messages.primary_account_contact') }}</h2>

        <div class="row">
            <div class="col-md-6">
            <?php

            if($contact->first_name){
               $first_name = $contact->first_name;
            }else{
              $first_name = Auth::user()->first_name;
            }
            if($contact->last_name){
               $last_name = $contact->last_name;
            }else{
              $last_name = Auth::user()->last_name;
            }

            ?>
                <div class="row">
                    <div class="col-md-6">
                        @include('helpers.form_control', ['type' => 'text', 'name' => 'first_name', 'value' => $first_name, 'rules' => Acelle\Model\Contact::$rules])
                    </div>
                    <div class="col-md-6">
                        @include('helpers.form_control', ['type' => 'text', 'name' => 'last_name', 'value' => $last_name, 'rules' => Acelle\Model\Contact::$rules])
                    </div>
                </div>

                @include('helpers.form_control', ['type' => 'text', 'label' => trans('messages.email_at_work'), 'name' => 'email', 'value' => $contact->email, 'help_class' => 'customer_contact', 'rules' => Acelle\Model\Contact::$rules])

                @include('helpers.form_control', ['type' => 'text', 'name' => 'address_1', 'value' => $contact->address_1, 'rules' => Acelle\Model\Contact::$rules])

                <div class="row">
                    <div class="col-md-6">
                        @include('helpers.form_control', ['type' => 'text', 'name' => 'city', 'value' => $contact->city, 'rules' => Acelle\Model\Contact::$rules])
                    </div>
                    <div class="col-md-6">
                        @include('helpers.form_control', ['type' => 'text', 'label' => trans('messages.zip_postal_code'), 'name' => 'zip', 'value' => $contact->zip, 'rules' => Acelle\Model\Contact::$rules])
                    </div>
                </div>

                @include('helpers.form_control', ['type' => 'text', 'label' => trans('messages.website_url'), 'name' => 'url', 'value' => $contact->url, 'rules' => Acelle\Model\Contact::$rules])

            </div>
            <div class="col-md-6">

                @include('helpers.form_control', ['type' => 'select', 'name' => 'country_id', 'label' => trans('messages.country'), 'value' => $contact->country_id, 'options' => Acelle\Model\Country::getSelectOptions(), 'include_blank' => trans('messages.choose'), 'rules' => Acelle\Model\Contact::$rules])

                @include('helpers.form_control', ['type' => 'text', 'label' => trans('messages.company_organization'), 'name' => 'company', 'value' => $contact->company, 'rules' => Acelle\Model\Contact::$rules])

                @include('helpers.form_control', ['type' => 'text', 'label' => trans('messages.office_phone'), 'name' => 'phone', 'value' => $contact->phone, 'rules' => Acelle\Model\Contact::$rules])

                @include('helpers.form_control', ['type' => 'text', 'name' => 'address_2', 'value' => $contact->address_2, 'rules' => Acelle\Model\Contact::$rules])

                @include('helpers.form_control', ['type' => 'text', 'label' => trans('messages.state_province_region'), 'name' => 'state', 'value' => $contact->state, 'rules' => Acelle\Model\Contact::$rules])

            </div>
        </div>

        <h2 class="text-semibold text-primary">{{ trans('messages.billing_information') }}</h2>

        <div class="row">
            <div class="col-md-6">

                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'tax_number',
                    'value' => $contact->tax_number,
                    'help_class' => 'customer_contact',
                    'rules' => Acelle\Model\Contact::$rules]
                )

            </div>
            <div class="col-md-6">

                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'billing_address',
                    'value' => $contact->billing_address,
                    'help_class' => 'customer_contact',
                    'rules' => Acelle\Model\Contact::$rules]
                )

            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-secondary"><i class="icon-check"></i> {{ trans('messages.save') }}</button>
        </div>

    <form>

@endsection
