@extends('layouts.core.frontend')

@section('title', trans('messages.api_token'))



@section('content')


	<div class="nk-block nk-block-lg">
  
        <div class="row mt-3">
        <div class="col-md-12">
            <div class="sub-section">
                <h2 style="margin-bottom: 10px;margin-top: 0">{{ trans('messages.payment.all_available_gateways') }}</h2>
                <p>{!! trans('messages.payment.all_available_gateways.wording') !!}</p>
                <div class="mc-list-setting mt-5">
                <div class="list-setting bg-stripe
                    current">
                    <div class="list-setting-main" style="width: 50%">
                        <div class="title">
                            <label>Stripe</label>
                        </div>
                        <p>Receive payments from Credit / Debit card to your Stripe account</p>
                    </div>
                    <div class="list-setting-status text-nowrap pl-4">
                        @if(Acelle\Jobs\HelperJob::payment_method('stripe'))
                          @if(Acelle\Jobs\HelperJob::payment_method('stripe')->status == 'active' )
                                <span class="label label-flat bg-active">
                                    {{ trans('messages.payment.active') }}
                                </span>
                            @else
                            <span class="label label-flat bg-inactive">
                                {{ trans('messages.payment.inactive') }}
                            </span>
                            @endif
                         @endif
                    </div>
                    <div class="list-setting-actions text-nowrap pl-4">
                      @if(Acelle\Jobs\HelperJob::payment_method('stripe'))
                           @if(Acelle\Jobs\HelperJob::payment_method('stripe')->status == 'active' )
                           <a class="btn btn-secondary ml-5"
                                    link-method="post" href="{{ url('admin/payment_method/status?method=stripe&status=inactive') }}">
                                    {{ trans('messages.payment.disable') }}
                                </a>
                            @else
                                <a class="btn btn-secondary ml-5"
                                    link-method="post" href="{{ url('admin/payment_method/status?method=stripe&status=active') }}">
                                    {{ trans('messages.payment.enable') }}
                            </a>
                             @endif
                            <button class="btn btn-secondary ml-5" data-bs-toggle="modal" data-bs-target="#stripeModal">
                                Setting
                            </button>
                            @else
                             <button class="btn btn-secondary ml-5" data-bs-toggle="modal" data-bs-target="#stripeModal">
                                Connect
                            </button>
                            @endif
                    </div>
                </div>

                    <div class="list-setting bg-paypal
                    current">
                    <div class="list-setting-main" style="width: 50%">
                        <div class="title">
                            <label>Paypal</label>
                        </div>
                        <p>PayPal is the fast/safe way to send money, make an online payment, receive money or set up a merchant account</p>
                    </div>
                     <div class="list-setting-status text-nowrap pl-4">
                        @if(Acelle\Jobs\HelperJob::payment_method('paypal'))
                          @if(Acelle\Jobs\HelperJob::payment_method('paypal')->status == 'active' )
                                <span class="label label-flat bg-active">
                                    {{ trans('messages.payment.active') }}
                                </span>
                            @else
                            <span class="label label-flat bg-inactive">
                                {{ trans('messages.payment.inactive') }}
                            </span>
                            @endif
                         @endif
                    </div>
                    <div class="list-setting-actions text-nowrap pl-4">
                      @if(Acelle\Jobs\HelperJob::payment_method('paypal'))
                           @if(Acelle\Jobs\HelperJob::payment_method('paypal')->status == 'active' )
                           <a class="btn btn-secondary ml-5"
                                    link-method="post" href="{{ url('admin/payment_method/status?method=paypal&status=inactive') }}">
                                    {{ trans('messages.payment.disable') }}
                                </a>
                            @else
                                <a class="btn btn-secondary ml-5"
                                    link-method="post" href="{{ url('admin/payment_method/status?method=paypal&status=active') }}">
                                    {{ trans('messages.payment.enable') }}
                            </a>
                             @endif
                            <button class="btn btn-secondary ml-5" data-bs-toggle="modal" data-bs-target="#paypalModal">
                                Setting
                            </button>
                            @else
                             <button class="btn btn-secondary ml-5" data-bs-toggle="modal" data-bs-target="#paypalModal">
                                Connect
                            </button>
                            @endif
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="stripeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Stripe Payment Method</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="stripe" value="stripe">

                <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-12 mt-0">
                        @if(!Acelle\Jobs\HelperJob::payment_method('stripe'))
                        <div class="alert alert-danger fade show" role="alert">
                        <strong> For Receive payments from Credit / Debit card to your Stripe account Please enter stripe keys</strong> 
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="default-01">Publishable key </label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if(Acelle\Jobs\HelperJob::payment_method('stripe')) value="{{Acelle\Jobs\HelperJob::payment_method('stripe')->stripe_key}}" @endif name="stripe_key" id="default-01" placeholder="Enter Stripe Key" required>
                            </div>
                        </div>
                           <div class="form-group">
                            <label class="form-label" for="default-01">Stripe Secret</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if(Acelle\Jobs\HelperJob::payment_method('stripe')) value="{{Acelle\Jobs\HelperJob::payment_method('stripe')->stripe_secret}}" @endif name="stripe_secret" id="default-01" placeholder="Enter Stripe Secret" required>
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg text-center" type="submit">@if(Acelle\Jobs\HelperJob::payment_method('stripe')) Update @else Save @endif</button>

                    </div>
                </div>
              </form>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="paypalModal" tabindex="-1" aria-labelledby="paypalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">PayPal Payment Method</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="paypal" value="paypal">

                <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-12 mt-0">
                        @if(!Acelle\Jobs\HelperJob::payment_method('paypal'))
                        <div class="alert alert-danger fade show" role="alert">
                        <strong> PayPal is the fast/safe way to send money, make an online payment, receive money or set up a merchant account.</strong> 
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="default-01">Client Id</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if(Acelle\Jobs\HelperJob::payment_method('paypal')) value="{{Acelle\Jobs\HelperJob::payment_method('paypal')->stripe_key}}" @endif name="stripe_key" id="default-01" placeholder="Enter Client Id" required>
                            </div>
                        </div>
                           <div class="form-group">
                            <label class="form-label" for="default-01">Secret</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" @if(Acelle\Jobs\HelperJob::payment_method('paypal')) value="{{Acelle\Jobs\HelperJob::payment_method('paypal')->stripe_secret}}" @endif name="stripe_secret" id="default-01" placeholder="Enter Secret" required>
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg text-center" type="submit">@if(Acelle\Jobs\HelperJob::payment_method('paypal')) Update @else Save @endif</button>

                    </div>
                </div>
              </form>
      </div>

    </div>
  </div>
</div>
    <div class="row">
     
        <div class="col-md-4">
             <div class="card card-preview">
        <div class="card-inner">
           <div class="preview-block">
                <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
             <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="currency" value="currency">
                <div class="row ">
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label" for="default-01">Select Currency </label>
                       <div class="form-control-wrap">
                        <select class="form-control" name="code">
                        <option value="" selected>Select Currency</option>
                        <option value="USD" {{$currencyData && $currencyData->code == 'USD' ? 'selected': ''}}>USD</option>
                        <option value="EUR" {{$currencyData && $currencyData->code == 'EUR' ? 'selected': ''}}>EUR</option>
                        <option value="AUD" {{$currencyData && $currencyData->code == 'AUD' ? 'selected': ''}}>AUD</option>
                        <option value="AED" {{$currencyData && $currencyData->code == 'AED' ? 'selected': ''}}>AED</option>
                        <option value="AMD" {{$currencyData && $currencyData->code == 'AMD' ? 'selected': ''}}>AMD</option>
                        <option value="ANG" {{$currencyData && $currencyData->code == 'ANG' ? 'selected': ''}}>ANG</option>
                        <option value="AWG" {{$currencyData && $currencyData->code == 'AWG' ? 'selected': ''}}>AWG</option>
                        <option value="AZN" {{$currencyData && $currencyData->code == 'AZN' ? 'selected': ''}}>AZN</option>
                        <option value="BAM" {{$currencyData && $currencyData->code == 'BAM' ? 'selected': ''}}>BAM</option>
                        <option value="BBD" {{$currencyData && $currencyData->code == 'BBD' ? 'selected': ''}}>BBD</option>
                        <option value="BDT" {{$currencyData && $currencyData->code == 'BDT' ? 'selected': ''}}>BDT</option>
                        <option value="BGN" {{$currencyData && $currencyData->code == 'BGN' ? 'selected': ''}}>BGN</option>
                        <option value="BMD" {{$currencyData && $currencyData->code == 'BMD' ? 'selected': ''}}>BMD</option>
                        <option value="BND" {{$currencyData && $currencyData->code == 'BND' ? 'selected': ''}}>BND</option>
                        <option value="BSD" {{$currencyData && $currencyData->code == 'BSD' ? 'selected': ''}}>BSD</option>
                        <option value="BWP" {{$currencyData && $currencyData->code == 'BWP' ? 'selected': ''}}>BWP</option>
                        <option value="BYN" {{$currencyData && $currencyData->code == 'BYN' ? 'selected': ''}}>BYN</option>
                        <option value="BZD" {{$currencyData && $currencyData->code == 'BZD' ? 'selected': ''}}>BZD</option>
                        <option value="CAD" {{$currencyData && $currencyData->code == 'CAD' ? 'selected': ''}}>CAD</option>
                        <option value="CDF" {{$currencyData && $currencyData->code == 'CDF' ? 'selected': ''}}>CDF</option>
                        <option value="CHF" {{$currencyData && $currencyData->code == 'CHF' ? 'selected': ''}}>CHF</option>
                        <option value="CNY" {{$currencyData && $currencyData->code == 'CNY' ? 'selected': ''}}>CNY</option>
                        <option value="CZK" {{$currencyData && $currencyData->code == 'CZK' ? 'selected': ''}}>CZK</option>
                        <option value="DKK" {{$currencyData && $currencyData->code == 'DKK' ? 'selected': ''}}>DKK</option>
                        <option value="DOP" {{$currencyData && $currencyData->code == 'DOP' ? 'selected': ''}}>DOP</option>
                        <option value="DZD" {{$currencyData && $currencyData->code == 'DZD' ? 'selected': ''}}>DZD</option>
                        <option value="EGP" {{$currencyData && $currencyData->code == 'EGP' ? 'selected': ''}}>EGP</option>
                        <option value="ETB" {{$currencyData && $currencyData->code == 'ETB' ? 'selected': ''}}>ETB</option>
                        <option value="FJD" {{$currencyData && $currencyData->code == 'FJD' ? 'selected': ''}}>FJD</option>
                        <option value="GBP" {{$currencyData && $currencyData->code == 'GBP' ? 'selected': ''}}>GBP</option>
                        <option value="GEL" {{$currencyData && $currencyData->code == 'GEL' ? 'selected': ''}}>GEL</option>
                        <option value="GIP" {{$currencyData && $currencyData->code == 'GIP' ? 'selected': ''}}>GIP</option>
                        <option value="GMD" {{$currencyData && $currencyData->code == 'GMD' ? 'selected': ''}}>GMD</option>
                        <option value="GYD" {{$currencyData && $currencyData->code == 'GYD' ? 'selected': ''}}>GYD</option>
                        <option value="HKD" {{$currencyData && $currencyData->code == 'HKD' ? 'selected': ''}}>HKD</option>
                        <option value="HRK" {{$currencyData && $currencyData->code == 'HRK' ? 'selected': ''}}>HRK</option>
                        <option value="HTG" {{$currencyData && $currencyData->code == 'HTG' ? 'selected': ''}}>HTG</option>
                        <option value="HUF" {{$currencyData && $currencyData->code == 'HUF' ? 'selected': ''}}>HUF</option>
                        <option value="IDR" {{$currencyData && $currencyData->code == 'IDR' ? 'selected': ''}}>IDR</option>
                        <option value="ILS" {{$currencyData && $currencyData->code == 'ILS' ? 'selected': ''}}>ILS</option>
                        <option value="ISK" {{$currencyData && $currencyData->code == 'ISK' ? 'selected': ''}}>ISK</option>
                        <option value="JMD" {{$currencyData && $currencyData->code == 'JMD' ? 'selected': ''}}>JMD</option>
                        <option value="JPY" {{$currencyData && $currencyData->code == 'JPY' ? 'selected': ''}}>JPY</option>
                        <option value="KES" {{$currencyData && $currencyData->code == 'KES' ? 'selected': ''}}>KES</option>
                        <option value="KGS" {{$currencyData && $currencyData->code == 'KGS' ? 'selected': ''}}>KGS</option>
                        <option value="KHR" {{$currencyData && $currencyData->code == 'KHR' ? 'selected': ''}}>KHR</option>
                        <option value="KMF" {{$currencyData && $currencyData->code == 'KMF' ? 'selected': ''}}>KMF</option>
                        <option value="KRW" {{$currencyData && $currencyData->code == 'KRW' ? 'selected': ''}}>KRW</option>
                        <option value="KYD" {{$currencyData && $currencyData->code == 'KYD' ? 'selected': ''}}>KYD</option>
                        <option value="KZT" {{$currencyData && $currencyData->code == 'KZT' ? 'selected': ''}}>KZT</option>
                        <option value="LBP" {{$currencyData && $currencyData->code == 'LBP' ? 'selected': ''}}>LBP</option>
                        <option value="LKR" {{$currencyData && $currencyData->code == 'LKR' ? 'selected': ''}}>LKR</option>
                        <option value="LRD" {{$currencyData && $currencyData->code == 'LRD' ? 'selected': ''}}>LRD</option>
                        <option value="LSL" {{$currencyData && $currencyData->code == 'LSL' ? 'selected': ''}}>LSL</option>
                        <option value="MAD" {{$currencyData && $currencyData->code == 'MAD' ? 'selected': ''}}>MAD</option>
                        <option value="MDL" {{$currencyData && $currencyData->code == 'MDL' ? 'selected': ''}}>MDL</option>
                        <option value="MGA" {{$currencyData && $currencyData->code == 'MGA' ? 'selected': ''}}>MGA</option>
                        <option value="MKD" {{$currencyData && $currencyData->code == 'MKD' ? 'selected': ''}}>MKD</option>
                        <option value="MMK" {{$currencyData && $currencyData->code == 'MMK' ? 'selected': ''}}>MMK</option>
                        <option value="MNT" {{$currencyData && $currencyData->code == 'MNT' ? 'selected': ''}}>MNT</option>
                        <option value="MOP" {{$currencyData && $currencyData->code == 'MOP' ? 'selected': ''}}>MOP</option>
                        <option value="MRO" {{$currencyData && $currencyData->code == 'MRO' ? 'selected': ''}}>MRO</option>
                        <option value="MVR" {{$currencyData && $currencyData->code == 'MVR' ? 'selected': ''}}>MVR</option>
                        <option value="MWK" {{$currencyData && $currencyData->code == 'MWK' ? 'selected': ''}}>MWK</option>
                        <option value="MXN" {{$currencyData && $currencyData->code == 'MXN' ? 'selected': ''}}>MXN</option>
                        <option value="MYR" {{$currencyData && $currencyData->code == 'MYR' ? 'selected': ''}}>MYR</option>
                        <option value="MZN" {{$currencyData && $currencyData->code == 'MZN' ? 'selected': ''}}>MZN</option>
                        <option value="NAD" {{$currencyData && $currencyData->code == 'NAD' ? 'selected': ''}}>NAD</option>
                        <option value="NGN" {{$currencyData && $currencyData->code == 'NGN' ? 'selected': ''}}>NGN</option>
                        <option value="NOK" {{$currencyData && $currencyData->code == 'NOK' ? 'selected': ''}}>NOK</option>
                        <option value="NPR" {{$currencyData && $currencyData->code == 'NPR' ? 'selected': ''}}>NPR</option>
                        <option value="NZD" {{$currencyData && $currencyData->code == 'NZD' ? 'selected': ''}}>NZD</option>
                        <option value="PGK" {{$currencyData && $currencyData->code == 'PGK' ? 'selected': ''}}>PGK</option>
                        <option value="PHP" {{$currencyData && $currencyData->code == 'PHP' ? 'selected': ''}}>PHP</option>
                        <option value="PKR" {{$currencyData && $currencyData->code == 'PKR' ? 'selected': ''}}>PKR</option>
                        <option value="PLN" {{$currencyData && $currencyData->code == 'PLN' ? 'selected': ''}}>PLN</option>
                        <option value="QAR" {{$currencyData && $currencyData->code == 'QAR' ? 'selected': ''}}>QAR</option>
                        <option value="RON" {{$currencyData && $currencyData->code == 'RON' ? 'selected': ''}}>RON</option>
                        <option value="RSD" {{$currencyData && $currencyData->code == 'RSD' ? 'selected': ''}}>RSD</option>
                        <option value="RUB" {{$currencyData && $currencyData->code == 'RUB' ? 'selected': ''}}>RUB</option>
                        <option value="SAR" {{$currencyData && $currencyData->code == 'SAR' ? 'selected': ''}}>SAR</option>
                        <option value="SBD" {{$currencyData && $currencyData->code == 'SBD' ? 'selected': ''}}>SBD</option>
                        <option value="SCR" {{$currencyData && $currencyData->code == 'SCR' ? 'selected': ''}}>SCR</option>
                        <option value="SEK" {{$currencyData && $currencyData->code == 'SEK' ? 'selected': ''}}>SEK</option>
                        <option value="SGD" {{$currencyData && $currencyData->code == 'SGD' ? 'selected': ''}}>SGD</option>
                        <option value="SLL" {{$currencyData && $currencyData->code == 'SLL' ? 'selected': ''}}>SLL</option>
                        <option value="SOS" {{$currencyData && $currencyData->code == 'SOS' ? 'selected': ''}}>SOS</option>
                        <option value="SZL" {{$currencyData && $currencyData->code == 'SZL' ? 'selected': ''}}>SZL</option>
                        <option value="THB" {{$currencyData && $currencyData->code == 'THB' ? 'selected': ''}}>THB</option>
                        <option value="TJS" {{$currencyData && $currencyData->code == 'TJS' ? 'selected': ''}}>TJS</option>
                        <option value="TOP" {{$currencyData && $currencyData->code == 'TOP' ? 'selected': ''}}>TOP</option>
                        <option value="TRY" {{$currencyData && $currencyData->code == 'TRY' ? 'selected': ''}}>TRY</option>
                        <option value="TTD" {{$currencyData && $currencyData->code == 'TTD' ? 'selected': ''}}>TTD</option>
                        <option value="TWD" {{$currencyData && $currencyData->code == 'TWD' ? 'selected': ''}}>TWD</option>
                        <option value="TZS" {{$currencyData && $currencyData->code == 'TZS' ? 'selected': ''}}>TZS</option>
                        <option value="UAH" {{$currencyData && $currencyData->code == 'UAH' ? 'selected': ''}}>UAH</option>
                        <option value="UGX" {{$currencyData && $currencyData->code == 'UGX' ? 'selected': ''}}>UGX</option>
                        <option value="UZS" {{$currencyData && $currencyData->code == 'UZS' ? 'selected': ''}}>UZS</option>
                        <option value="VND" {{$currencyData && $currencyData->code == 'VND' ? 'selected': ''}}>VND</option>
                        <option value="VUV" {{$currencyData && $currencyData->code == 'VUV' ? 'selected': ''}}>VUV</option>
                        <option value="WST" {{$currencyData && $currencyData->code == 'WST' ? 'selected': ''}}>WST</option>
                        <option value="XAF" {{$currencyData && $currencyData->code == 'XAF' ? 'selected': ''}}>XAF</option>
                        <option value="XCD" {{$currencyData && $currencyData->code == 'XCD' ? 'selected': ''}}>XCD</option>
                        <option value="YER" {{$currencyData && $currencyData->code == 'YER' ? 'selected': ''}}>YER</option>
                        <option value="ZAR" {{$currencyData && $currencyData->code == 'ZAR' ? 'selected': ''}}>ZAR</option>
                        <option value="ZMW" {{$currencyData && $currencyData->code == 'ZMW' ? 'selected': ''}}>ZMW</option>
                    </select>
                </div>
                       </div>
                   </div>                   
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-success btn-lg" type="submit">Save</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->
        </div>
    </div>
   

</div>
@endsection
