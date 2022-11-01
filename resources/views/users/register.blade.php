
<?php $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(Route::input('account')); ?>
<?php $countries = Acelle\Jobs\HelperJob::countries(); ?>
<?php $providerstatename = Acelle\Jobs\HelperJob::statename($provideradminlocation->state); ?>
<?php $providercityname = Acelle\Jobs\HelperJob::cityname($provideradminlocation->city); ?>
<?php $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country); ?>
@extends('layouts.core.register')

@section('title', trans('messages.create_your_account'))
<style type="text/css">
    .btn-group{
        width: 100%;
        height: 50px;
        background-color: transparent;
    }
    .btn-lg{
        width: 100%;
        background-color: transparent !important;
        color: black !important;
        border: 1px solid #bbb !important;
    }
    .multiselect-container{
        width: 100% !important;
    }
    .mc-form .form-control, .mc-form .select2 {
        font-size: 100%;
        border-color: #bbb;
        border-radius: 2px;
        border: solid 1px #bbb;
        height: 46px !important;
    }
</style>

@section('content')
  <?php
   if($invite){
      $email = $invite->email;
      $name = $invite->name;
   }else{
      $email = $user->email;
      $name = $user->first_name;
   }
  ?>
    <form enctype="multipart/form-data" action="{{ url('users/register') }}" method="POST" class="form-validate-jqueryz subscription-form">
        {{ csrf_field() }}
        <input type="hidden" name="invite" value="{{Request::get('invite')}}">
        <div class="row mt-5 mc-form">
            <div class="col-md-2"></div>
            <div class="col-md-2 text-end mt-60">
                <a class="main-logo-big" href="{{ url('/') }}">
                    <img width="150px" src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark')) }}" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h1 class="mb-20">{{ trans('messages.create_your_account') }}</h1>
                <p>If you would like to become part of our network and offer your business and provide your skills to people looking for your skills then please register below.<a href="{{url("users/login")}}"> Login</a></p>
              @if($errors->any())
                <div class="alert alert-danger alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button> 
                    <strong>{{$errors->first()}}</strong>
                </div>
                @endif
                 <div class="form-group control-text">
                    <label>
                        <b>Business Name</b>
                         <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="business_name" class="form-control" required>
                  </div>
                <div class="form-group control-text">
                    <label>
                        <b>Category</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select class="form-control" name="category_id[]" required onchange="subCategory(this)">
                         <option value="">Select Category</option>
                         @foreach(Acelle\Jobs\HelperJob::categories() as $category)
                         <option value="{{$category->id}}">{{$category->category_name}}</option>
                         @endforeach
                     </select>
                  </div>
                  <div id="appendbox">
                      
                  </div>
                   <div class="form-group control-text">
                
                    <input id="subdomain" placeholder="" value="{{request('account')}}" type="hidden" name="subdomain" class="form-control required unique:users,subdomain,,id  ">
                <input type="hidden" name="user_type" value="service_provider">
                    </div>

                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'email',
                    'value' => $email,
                    'help_class' => 'profile',
                    'rules' => $user->registerRules($email)
                ])
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'first_name',
                    'value' => $name,
                    'rules' => $user->registerRules($name)
                ])
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'last_name',
                    'value' => $user->last_name,
                    'rules' => $user->registerRules($user->subdomain)
                ])
                
                @include('helpers.form_control', [
                    'type' => 'password',
                    'label'=> trans('messages.password'),
                    'name' => 'password',
                    'rules' => $user->registerRules($user->subdomain),
                    'eye' => true,
                ])
                 <div class="form-group control-text">
                    <label>
                        <b>Where do you want to receive work</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select name="business_type" class="form-control" required onchange="GetTypeData(this.value)">
                        <option disabled selected value="">Select Type</option>
                        @if($provideradminlocation->admin_location_type=="World Wide")
                        <option value="world">
                            Worldwide
                        </option>
                        <option value="country">
                            Countrywide
                        </option>
                        <option value="state">
                            Statewide
                        </option>
                        <option value="local business">
                            Locally
                        </option>
                        @elseif($provideradminlocation->admin_location_type=="Country Wise")
                         <option value="country">
                            Countrywide
                        </option>
                        <option value="state">
                            Statewide
                        </option>
                        <option value="local business">
                            Locally
                        </option>
                        @elseif($provideradminlocation->admin_location_type=="State Wise")
                        <option value="state">
                            Statewide
                        </option>
                        <option value="local business">
                            Locally
                        </option>
                        @endif
                    </select>
                  </div>
                   <div class="form-group control-text" id="world_wise" style="display: none">
                    <div class="col-md-12 p-0 mt-4">
                    <div class="row">
                        <div class="col-md-4 p-0">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Country
                                    <span style="color: red">*</span>
                                </label>
                                <select name="country" id="country"
                                        class="form-control select2" required
                                        onchange="GetStates(this.value)">
                                    <option disabled selected value="">Select
                                        Country
                                    </option>
                                    @forelse($countries as $country)
                                        
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 pr-0">
                            <div class="form-group">
                                <label class="form-label" for="full-name">State
                                    <span style="color: red">*</span>
                                </label>
                                <select name="state" id="state1"
                                        class="form-control select2"
                                        onchange="GetCities(this.value)">
                                  
                                        <option disabled selected value="">
                                            Select Country First
                                        </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pr-0" >
                            <div class="form-group">
                                <label class="form-label" for="full-name">City
                                    <span style="color: red">*</span>
                                </label>
                                <select name="city" id="city2"
                                        class="form-control select2">
                               
                                        <option disabled selected value="">
                                            Select State First
                                        </option>
                                </select>
                            </div>
                        </div>
                    </div>
                  </div>
                   </div>
                    <div class="col-md-12 p-0" id="country_wise" style="display: none">
                        <div class="form-group">
                            <label class="form-label" for="full-name">Country
                                <span style="color: red">*</span>
                            </label>
                            <select name="country" id="country"
                                    class="form-control select2"
                                    onchange="GetStates(this.value)">
                                <option disabled selected value="">
                                    Select
                                    Country
                                </option>
                                @forelse($countries as $country)
                                    @if($provideradminlocation->country==$country->id)
                                        <option selected
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                    @else
                                        {{--                                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
                                    @endif
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                  <div class="col-md-12 mt-4 p-0" id="state_wise" style="display: none">
                   <div class="row">
                        <div class="col-md-6 p-0">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Country
                                    <span style="color: red">*</span>
                                </label>
                                <select name="country" id="country"
                                        class="form-control select2"
                                        onchange="GetStates(this.value)">
                                    <option disabled selected value="">
                                        Select
                                        Country
                                    </option>
                                    @forelse($countries as $country)
                                        @if($provideradminlocation->country==$country->id)
                                            <option selected
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                        @else
                                            {{--                                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group">
                                <label class="form-label" for="full-name">State
                                    <span style="color: red">*</span>
                                </label>
                                <select name="state" id="state2"
                                        class="form-control select2"
                                        onchange="GetCities(this.value)">
                                    <option selected
                                            value="{{ ($providerstatename) ? $providerstatename->id : '' }}">{{ ($providerstatename) ? $providerstatename->name : '' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                      <div class="col-md-12 mt-4 p-0" id="city_wise" style="display: none">
                       <div class="row">
                        <div class="col-md-4 p-0">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Country
                                    <span style="color: red">*</span>
                                </label>
                                <select name="country" id="country"
                                        class="form-control select2"
                                        onchange="GetStates(this.value)">
                                    <option disabled selected value="">
                                        Select
                                        Country
                                    </option>
                                    @forelse($countries as $country)
                                        @if($provideradminlocation->country==$country->id)
                                            <option selected
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                        @else
                                            {{--                                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pr-0">
                            <div class="form-group">
                                <label class="form-label" for="full-name">State
                                    <span style="color: red">*</span>
                                </label>
                                <select name="state" id="state3"
                                        class="form-control select2"
                                        onchange="GetCities(this.value)">
                                    <option selected
                                            value="{{ ($providerstatename) ? $providerstatename->id : '' }}">{{ ($providerstatename) ? $providerstatename->name : '' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pr-0" >
                            <div class="form-group">
                                <label class="form-label" for="full-name">City
                                    <span style="color: red">*</span>
                                </label>
                                    <?php $citylist = Acelle\Jobs\HelperJob::citieslist($provideradminlocation->state); ?>
                                <select name="city" id="city1"
                                        class="form-control select2"
                                        >
                                    <option value="{{ ($providercityname) ? $providercityname->id : '' }}">{{ ($providercityname) ? $providercityname->name : '' }}</option>

                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                   <div class="form-group control-text" id="bus_address" style="display: none">
                    <label class="form-label">
                        Business Address
                        <span style="color: red">*</span>
                     </label>
                      <input type="text" name="address" id="address"  class="form-control" autocomplete="off" placeholder="Enter Your Address">
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>
                     <div class="form-group control-text" id="appendType" style="display: none">
                      <div class="form-group  mt-3">
                          <label class="form-label" for="display-radius">
                              Radius(KM)
                              <span style="color: red">*</span>
                          </label>
                          <input type="number" class="form-control"
                                 id="display-radius" name="state_radius"
                                 placeholder="Enter Radius"
                                 value="">
                      </div>
                  </div>
                  <div class="form-group control-text">
                    <label>
                        <b>Zipcode</b>
                         <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="zipcode" class="form-control" required>
                  </div>
                @if (Acelle\Model\Setting::get('registration_recaptcha') == 'yes')
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            @if ($errors->has('recaptcha_invalid'))
                                <div class="text-danger text-center">{{ $errors->first('recaptcha_invalid') }}</div>
                            @endif
                            {!! Acelle\Library\Tool::showReCaptcha() !!}
                        </div>
                    </div>
                @endif
                <hr>
                <div class="row flex align-items">
                    <div class="col-md-4">
                        <button type='submit' class="btn btn-secondary res-button"><i class="icon-check"></i> {{ trans('messages.get_started') }}</button>
                    </div>
                    <div class="col-md-8">
                        {!! trans('messages.register.agreement_intro') !!}
                    </div>
                        
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnout.com/toastr.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBSIo75YZ1hfbKAQPDvo0Tfyys9Zo6c9hk&libraries=places"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.select2').select2();
        });

    </script>

@if($provideradminlocation->admin_location_type!="World Wide" && $provideradminlocation->admin_location_type=="Country Wise")
<script>
  var countryid = {{ $provideradminlocation->country }};
  GetStatesdata(countryid);
  GetStates(countryid);
  function GetStatesdata(val) {
    $("#state").empty();
    $.ajax({
      url: "{{ url('/getstatesforprovider') }}/" + val,
      method: "get",
      success: function (data) {
      $("#state").html(data);
      }
    });
  }
</script>
@endif

@if($provideradminlocation->admin_location_type!="World Wide" && $provideradminlocation->admin_location_type=="State Wise" )
<script>
var countryid = {{ $provideradminlocation->country }};
var stateid = {{ $provideradminlocation->state }};
GetCitiesdata(stateid);
GetStates(countryid);
function GetCitiesdata(val) {
$.ajax({
url: "{{ url('/getprovidercities') }}/" + val,
method: "get",
success: function (data) {
$("#city").html(data);
}
});
}
</script>
@endif

@if($provideradminlocation->admin_location_type=="World Wide")

<script>

google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
var input = document.getElementById('address');
var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.addListener('place_changed', function () {
var place = autocomplete.getPlace();
console.log(place);
$("#latitude").val(place.geometry['location'].lat());
$("#longitude").val(place.geometry['location'].lng());
});
}

</script>

@else

<script>

var pc = "{{ $providercountry->code }}";

google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
var options = {
types: ['(cities)'],
componentRestrictions: {country: pc}
};

var input = document.getElementById('address');
var autocomplete = new google.maps.places.Autocomplete(input, options);
autocomplete.addListener('place_changed', function () {
var place = autocomplete.getPlace();
console.log(place);
$("#latitude").val(place.geometry['location'].lat());
$("#longitude").val(place.geometry['location'].lng());
});
}

</script>

@endif


<script type="text/javascript">

$(document).ready(function () {
$('.select2').select2();
});

function GetTypeData(val) {
// $("#appendType").empty();
// $("#bus_address").empty();
if(val == "country"){
 $("#country_wise").show();
 $("#state_wise").hide();
 $("#world_wise").hide();
 $("#city_wise").hide();
 $("#bus_address").hide();
 $("#appendType").hide();
}
else if(val == "world"){
 $("#world_wise").show();
 $("#country_wise").hide();
 $("#state_wise").hide();
 $("#city_wise").hide();
 $("#bus_address").hide();
 $("#appendType").hide();
}
else if(val == "state"){
 @if($provideradminlocation->admin_location_type=="World Wide" || $provideradminlocation->admin_location_type=="Country Wide")
  var countryid = {{ $provideradminlocation->country }};
  GetStates(countryid);
 @endif
 $("#country_wise").hide();
 $("#state_wise").show();
 $("#city_wise").hide();
 $("#world_wise").hide();
 $("#bus_address").hide();
 $("#appendType").hide();
}
else if(val == "city"){
 $("#country_wise").hide();
 $("#state_wise").hide();
 $("#world_wise").hide();
 $("#city_wise").show();
 $("#bus_address").hide();
 $("#appendType").hide();
}
else if (val == "local business") {
 $("#country_wise").hide();
 $("#state_wise").hide();
 $("#city_wise").hide();
 $("#world_wise").hide();
 $("#bus_address").show();
 $("#appendType").show();
} else {
$("#bus_state").show();
$("#bus_city").show();
$("#bus_address").hide();
$("#appendType").hide();
}
}

function GetStates(val) {
$("#state").empty();
$("#city").empty();
$("#city").html("<option value='' selected disabled>Select State First</option>");
$.ajax({
url: "{{ url('/getstates') }}/" + val,
method: "get",
success: function (data) {
$("#state1").html(data);
$("#state2").html(data);
$("#state3").html(data);
}
});
}

function GetCities(val) {
  $.ajax({
    url: "{{ url('/getcities') }}/" + val,
    method: "get",
    success: function (data) {
    $("#city1").html(data);
    $("#city2").html(data);
    }
  });
}

$("#AddressUpdateForm").submit(function (event) {
var lat = $("#latitude").val();
var long = $("#longitude").val();
// if (lat == "" || long == "") {
//     alert("Please Enter Valid Address !");
//     return false;
// }
// event.preventDefault();
});


</script>
    <script>
      function subCategory(e){
        // alert(e.value);
         $.ajax({url: "{{url('users/subcategory/')}}/"+e.value, success: function(result){
         $('#appendbox').html(result);
            $('#example-getting-started').multiselect({
              templates: {
                button: '<button type="button" class="multiselect dropdown-toggle btn btn-primary btn-lg" data-bs-toggle="dropdown" aria-expanded="false"><span class="multiselect-selected-text"></span></button>',
              },
                header: true,
                height: 150,
                allSelectedText: 'Sub Category Selected',
                selectedList: 3,
                numberDisplayed: 3,
                nonSelectedText: "Select Sub Category",
                minWidth: 410
            });
         console.log(result);
        
        }});
      }

        @if (isSiteDemo())
            $('.res-button').click(function(e) {
                e.preventDefault();

                notify('notice', '{{ trans('messages.notify.notice') }}', '{{ trans('messages.operation_not_allowed_in_demo') }}');
            });
        @endif
    </script>
    
@endsection
