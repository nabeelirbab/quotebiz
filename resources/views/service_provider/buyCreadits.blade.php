@extends('service_provider.layout.app')
@section('title', 'Quotes')

@section('styling')
 <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/quill.css?ver=2.9.1') }}">
 <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
 <style type="text/css">
     .maincard{
        border: 1px solid #eae3e3;
        border-radius: 13px;
        padding: 16px;
        background: white;
     }
     .cardheader{
        border-bottom: 1px solid #eae3e3;
        padding: 20px 0 20px 2px;  
     }
     .cardfooter{
        border-top: 1px solid #eae3e3;
        padding: 20px 0 20px 2px;  
     }
 </style>
@endsection
@section('content')
<?php 

$currencySymbols = [
    'AED' => 'د.إ',
    'AFN' => 'Af',
    'ALL' => 'Lek',
    'AMD' => 'դ',
    'ANG' => 'ƒ',
    'AOA' => 'Kz',
    'ARS' => '$',
    'AUD' => '$',
    'AWG' => 'ƒ',
    'AZN' => '₼',
    'BAM' => 'KM',
    'BBD' => '$',
    'BDT' => '৳',
    'BGN' => 'лв',
    'BHD' => '.د.ب', 
    'BIF' => 'FBu',
    'BMD' => '$',
    'BND' => '$',
    'BOB' => '$b',
    'BRL' => 'R$',
    'BSD' => '$',
    'BTN' => 'Nu.',
    'BWP' => 'P',
    'BYR' => 'p.',
    'BZD' => 'BZ$',
    'CAD' => '$',
    'CDF' => 'FC',
    'CHF' => 'CHF',
    'CLF' => 'UF',
    'CLP' => '$',
    'CNY' => '¥',
    'COP' => '$',
    'CRC' => '₡',
    'CUP' => '⃌',
    'CVE' => '$', 
    'CZK' => 'Kč',
    'DJF' => 'Fdj',
    'DKK' => 'kr',
    'DOP' => 'RD$',
    'DZD' => 'دج',
    'EGP' => 'E£',
    'ETB' => 'Br',
    'EUR' => '€',
    'FJD' => '$',
    'FKP' => '£',
    'GBP' => '£',
    'GEL' => 'ლ',
    'GHS' => '¢',
    'GIP' => '£',
    'GMD' => 'D', 
    'GNF' => 'FG',
    'GTQ' => 'Q',
    'GYD' => '$',
    'HKD' => '$',
    'HNL' => 'L',
    'HRK' => 'kn',
    'HTG' => 'G',
    'HUF' => 'Ft',
    'IDR' => 'Rp',
    'ILS' => '₪',
    'INR' => '₹',
    'IQD' => 'ع.د',
    'IRR' => '﷼',
    'ISK' => 'kr',
    'JEP' => '£',
    'JMD' => 'J$',
    'JOD' => 'JD',
    'JPY' => '¥',
    'KES' => 'KSh',
    'KGS' => 'лв',
    'KHR' => '៛',
    'KMF' => 'CF', 
    'KPW' => '₩',
    'KRW' => '₩',
    'KWD' => 'د.ك',
    'KYD' => '$',
    'KZT' => '₸',
    'LAK' => '₭',
    'LBP' => '£',
    'LKR' => '₨',
    'LRD' => '$',
    'LSL' => 'L',
    'LTL' => 'Lt',
    'LVL' => 'Ls',
    'LYD' => 'ل.د', 
    'MAD' => 'د.م.',
    'MDL' => 'L',
    'MGA' => 'Ar',
    'MKD' => 'ден',
    'MMK' => 'K',
    'MNT' => '₮',
    'MOP' => 'MOP$', 
    'MRO' => 'UM', 
    'MUR' => '₨', 
    'MVR' => '.ރ',
    'MWK' => 'MK',
    'MXN' => '$',
    'MYR' => 'RM',
    'MZN' => 'MT',
    'NAD' => '$',
    'NGN' => '₦',
    'NIO' => 'C$',
    'NOK' => 'kr',
    'NPR' => '₨',
    'NZD' => '$',
    'OMR' => '﷼',
    'PAB' => 'B/.',
    'PEN' => 'S/.',
    'PGK' => 'K',
    'PHP' => '₱',
    'PKR' => '₨',
    'PLN' => 'zł',
    'PYG' => 'Gs',
    'QAR' => '﷼',
    'RON' => 'lei',
    'RSD' => 'Дин.',
    'RUB' => '₽',
    'RWF' => 'ر.س',
    'SAR' => '﷼',
    'SBD' => '$',
    'SCR' => '₨',
    'SDG' => '£',
    'SEK' => 'kr',
    'SGD' => '$',
    'SHP' => '£',
    'SLL' => 'Le', 
    'SOS' => 'S',
    'SRD' => '$',
    'STD' => 'Db',
    'SVC' => '$',
    'SYP' => '£',
    'SZL' => 'L',
    'THB' => '฿',
    'TJS' => 'TJS',
    'TMT' => 'm',
    'TND' => 'د.ت',
    'TOP' => 'T$',
    'TRY' => '₤',
    'TTD' => '$',
    'TWD' => 'NT$',
    'TZS' => 'TSh',
    'UAH' => '₴',
    'UGX' => 'USh',
    'USD' => '$',
    'UYU' => '$U',
    'UZS' => 'лв',
    'VEF' => 'Bs',
    'VND' => '₫',
    'VUV' => 'VT',
    'WST' => 'WS$',
    'XAF' => 'FCFA',
    'XCD' => '$',
    'XDR' => 'SDR',
    'XOF' => 'FCFA',
    'XPF' => 'F',
    'YER' => '﷼',
    'ZAR' => 'R',
    'ZMK' => 'ZK', 
    'ZWL' => 'Z$',
];
?>
<div class="container mt-5">
 @if(Session::has('success'))
     <div class="alert alert-success  fade show mt-5" role="alert">
      <strong>Payment successful!</strong> {{Session::get('success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 @endif
 @if(Session::has('danger'))
     <div class="alert alert-danger  fade show mt-5" role="alert">
      <strong>Payment decline!</strong> {{Session::get('danger')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 @endif
  <div class="up-card pt-0 pb-0 maincard mt-5 mb-3">
      <header class="up-card-header cardheader">
        <h3 id="heading" class="mb-0">
          Buy Credits
        </h3>
      </header>
       <section class="up-card-section mt-3 mb-4">
        <h5 id="para01" class="mb-10 para">
          Your available Credits
        </h5>
         <div id="connects-balance">
            {{ Auth::user()->credits}}
        </div> <!---->
         <h5 id="para02" class="mt-5 mb-10 para">
          Select the amount to buy
        </h5>
         <div class="row">
          <div class="col-lg-5 col-md-6 col-sm-12">
            <select class="form-control" id="getprice">
                @foreach(Acelle\Jobs\HelperJob::creditAmounts() as $creadit)
                <?php 
                   $currencyConvert = Acelle\Jobs\HelperJob::setcurrency($creadit->currency,$creadit->credit_amount);
                ?>
                <option value="{{$creadit->credit}},{{$currencyConvert['convert']}},{{$creadit->id}},{{$currencyConvert['currency']}}, <?php   foreach($currencySymbols as $key=>$value){
                                if($key == $currencyConvert['currency']){
                                  echo $value;
                                }
                            }?>">{{$creadit->credit}} Credits for  <?php   foreach($currencySymbols as $key=>$value){
                                if($key == $currencyConvert['currency']){
                                  echo $value;
                                }
                            }?>{{$currencyConvert['convert']}} {{$currencyConvert['currency']}}</option>
                @endforeach
            </select>
          </div>
        </div>
         <h5 id="para03" class="mt-5 mb-10 para">
            Your account will be charged
          </h5>
           <div id="charge-amount">
                $1.50
              </div> <!----> <!---->
           <h5 id="para04" class="mt-5 mb-10 para">
          Your new Credits balance will be
        </h5> <div id="new-balance">
          46
        </div> 
       
           <div id="note01" class="mt-3 pt-10 text-muted"><span class="d-none-mobile-app">
            This bundle of Connects will expire 1 year from today.
          </span>
          Unused Connects rollover to the next month
          (maximum of 200).
          <a aria-label="Learn more about Connects" href="" rel="noopener noreferrer" target="_blank" class="d-none-mobile-app">
            Learn more
          </a></div>
          
      </section> 
          <footer class="cardfooter d-none-mobile-app text-right">
             <form action="{{ url('service-provider/payment') }}" id="paymentForm" method="post">
                 {{csrf_field()}}
                 <input type="hidden" name="id" id="paymentValue">
             </form>
            <button id="footerButtonMain" type="submit" form="paymentForm" class="btn btn-primary up-btn-block-sm mb-0 d-none-mobile-app">
              Buy Credits
            </button> 
    </footer>
</div>

</div>
@endsection
@section('script')
    <script src="{{ asset('frontend-assets/assets/js/apps/chats.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/apps/messages.js?ver=2.9.1') }}"></script>
   
    <script src="{{ asset('frontend-assets/assets/js/libs/editors/quill.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/editors.js?ver=2.9.1') }}"></script>
    
    <script type="text/javascript">
        
            var creadits = '{{ Auth::user()->credits}}';
           
         
        $(document).ready(function(){
          $(".nk-msg-body").removeClass("profile-shown");
          $("#getprice").trigger('change');
        });

        $(".nk-msg-item").click(function(){
            $("#chatbody").addClass("nkchatbody");
        });

        $("#removeClass").click(function(){
            $("#chatbody").removeClass("nkchatbody");
        });

        $("#getprice").change(function() {
               console.log(creadits);
               var sum = 0;
               var result = $(this).val().split(',');
               console.log(result);
               var sum = Number(creadits) + Number(result[0]);
               console.log(sum);
               $('#new-balance').text(sum);
               $('#charge-amount').text(result[4]+result[1]+' '+result[3]);
               $('#paymentValue').val(result[2]);
        });
    </script>
@endsection