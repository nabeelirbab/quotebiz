<?php $countries = Acelle\Jobs\HelperJob::countries(); ?>
<?php $countryname = Acelle\Jobs\HelperJob::countryname(Auth::user()->country); ?>
<?php $statename = Acelle\Jobs\HelperJob::statename(Auth::user()->state); ?>
<?php $cityname = Acelle\Jobs\HelperJob::cityname(Auth::user()->city); ?>
<?php $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocation(); ?>
<?php $providerstatename = Acelle\Jobs\HelperJob::statename($provideradminlocation->state); ?>
<?php $providercityname = Acelle\Jobs\HelperJob::cityname($provideradminlocation->city); ?>
<?php $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country); ?>


@extends('service_provider.layout.app')
@section('title', 'Profile')
@section('styling')
<style type="text/css">
.labelcls {
display: flex;
align-items: center;
padding: 0.625rem 1.25rem;
font-size: 12px;
font-weight: 500;
color: #526484;
transition: all .4s;
line-height: 1.3rem;
position: relative;
margin-bottom: 0px !important;
}

.cameraicon {
font-size: 1.125rem;
width: 1.75rem;
opacity: .8;
}

.select2-container--default .select2-selection--single {
height: calc(2.125rem + 2px);
font-family: DM Sans, sans-serif;
font-size: 13px;
font-weight: 400;
background-color: #fff;
border: 1px solid #c1c1c1;
border-radius: 4px;
box-shadow: none;
transition: all 0.3s;
height: 49px !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
color: #526484;
line-height: 2rem !important;
padding: 0.4375rem calc(2.125rem + 2px) 0.4375rem 1rem;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
height: calc(3.125rem + 2px) !important;
position: absolute;
top: 0;
right: 0;
width: calc(2.125rem + 2px);
display: flex;
align-items: center;
justify-content: center;
}

.select2-container--default .select2-selection--single .select2-selection__arrow:after {
font-family: "Nioicon";
content: "";
line-height: 1;
font-size: 20px !important;
font-weight: 700 !important;
}
@if(Auth::user()->type =='country')
#bus_state {
    display: none;
}
#bus_city {
    display: none;
}
@endif
@if(Auth::user()->type =='state')
#bus_city {
    display: none;
}
@endif
@if(Auth::user()->type =='world')
#bus_city {
    display: block;
}
#bus_state {
    display: block;
}
@endif
@if(Auth::user()->type =="local business")
#main_div {
    display: none ;
}
@endif
  .toggle-side-menu{
            display: none !important;
        }
        @media only screen and (max-width: 600px) {
           .side-class{
            transition: none;
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            position: fixed !important;
            display: none;
          }
          .toggle-side-menu{
            background: white;
            margin-bottom: 13px;
            padding-top: 10px;
            padding-bottom: 30px;
            padding-right: 24px;
            display: block !important;
          }
        }
</style>
@endsection

@section('content')
  <?php
       $col = '12';
       if(Auth::user()->type == "state"){
         $col = '6';
       }
       elseif(Auth::user()->type == "country"){
         $col = '12';
       }
       elseif(Auth::user()->type == "world"){
         $col = '4';
       }
   ?>
<!-- content @s -->
<div class="nk-content mb-3">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block">
     <div class="toggle-side-menu" onclick="showsidebar()">
        <em class="icon ni ni-menu float-right" style="font-size: 20px"></em>
    </div>
<div class="card">
@if(Session::has('success'))
<div class="alert alert-success  fade show mt-5" role="alert">
<strong>Service Location Settings !</strong> {{Session::get('success')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger  fade show mt-5" role="alert">
<strong>Service Location Settings !</strong> {{Session::get('error')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
@endif

@if($provideradminlocation->admin_location_type=="World Wide")

<div class="card-aside-wrap">
<div class="card-inner card-inner-lg">
<div class="nk-block-head">
<div class="nk-block-between d-flex justify-content-between">
<div class="nk-block-head-content">
<h4 class="nk-block-title">Service Location Settings</h4>
</div>

</div>
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="nk-data data-list">
<form action="{{ url('service-provider/address-update') }}"
method="post" id="AddressUpdateForm">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
    <div class="form-group">
        <label class="form-label" for="full-name">Where do you
            want to receive work</label>
        <select name="user_type" class="form-control" required
                onchange="GetTypeData(this.value)">
            <option disabled selected value="">Select Type
            </option>
            <option {{ (Auth::user()->type=="world") ? "selected" : '' }} value="world">
                Worldwide
            </option>
            <option {{ (Auth::user()->type=="country") ? "selected" : '' }} value="country">
                Countrywide
            </option>
            <option {{ (Auth::user()->type=="state") ? "selected" : '' }} value="state">
                Statewide
            </option>
            <option {{ (Auth::user()->type=="local business") ? "selected" : '' }} value="local business">
                Locally
            </option>
        </select>
    </div>
</div>

<div class="col-md-12 mt-4" id="main_div">
    <div class="row">
        <div class="col-md-{{$col}}" id="bus_country">
            <div class="form-group">
                <label class="form-label" for="full-name">Country
                    <span style="color: red">*</span>
                </label>
                <select name="country" id="country"
                        class="form-control select2"
                        onchange="GetStates(this.value)">
                    <option disabled selected value="">Select
                        Country
                    </option>
                    @forelse($countries as $country)
                        @if(Auth::user()->country==$country->id)
                            <option selected
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                        @else
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endif
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="col-md-{{$col}}" id="bus_state">
            <div class="form-group">
                <label class="form-label" for="full-name">State
                    <span style="color: red">*</span>
                </label>
            
                <select name="state" id="state"
                        class="form-control select2"
                        onchange="GetCities(this.value)">
                    @if($statename)
                       @foreach(Acelle\Jobs\HelperJob::statelist(Auth::user()->country) as $states)
                        <option value="{{ $states->id }}" {{ (Auth::user()->state == $states->id) ? 'selected' : '' }}> {{$states->name}}
                        </option>
                        @endforeach
                    @else
                        <option disabled selected value="">
                            Select Country First
                        </option>
                    @endif
                    
                </select>
            </div>
        </div>
        <div class="col-md-{{$col}}" id="bus_city">
            <div class="form-group">
                <label class="form-label" for="full-name">City
                    <span style="color: red">*</span>
                </label>
                <select name="city" id="city"
                        class="form-control select2">
                     @if($cityname)
                            @foreach(Acelle\Jobs\HelperJob::citieslist(Auth::user()->state) as $cities)
                            <option value="{{ $cities->id }}" {{ (Auth::user()->city == $cities->id) ? 'selected' : '' }}> {{$cities->name}}
                            </option>
                            @endforeach
                        @else
                            <option disabled selected value="">Select State
                                First
                            </option>
                        @endif
                </select>
            </div>
        </div>
    </div>
</div>


@if(Auth::user()->type=="local business")
    <div class="col-md-8 mt-4" id="bus_address">
        <div class="form-group">
            <label class="form-label" for="address">Address
                <span style="color: red">*</span>
            </label>
            <input type="text" name="address" id="address"
                   class="form-control" autocomplete="off"
                   placeholder="Enter Your Address"
                   value="{{ Auth::user()->address }}">
            <input type="hidden" id="latitude" name="latitude"
                   value="{{ (Auth::user()->latitude) ? Auth::user()->latitude : '' }}">
            <input type="hidden" id="longitude" name="longitude"
                   value="{{ (Auth::user()->longitude) ? Auth::user()->longitude : '' }}">
        </div>
    </div>
    <div class="col-md-4 mt-1" id="appendType">
        <div class="form-group  mt-3">
            <label class="form-label" for="display-radius">
                Radius(KM)
                 <span style="color: red">*</span>
            </label>
            <input type="number" class="form-control"
                   id="display-radius" name="state_radius"
                   placeholder="Enter Radius"
                   value="{{ (Auth::user()->type_value) ? Auth::user()->type_value : '' }}">
        </div>
    </div>
@else
    <div class="col-md-8 mt-4" style="display: none"
         id="bus_address">
        <div class="form-group">
            <label class="form-label" for="address">Address
                <span style="color: red">*</span>
            </label>
            <input type="text" name="address" id="address"
                   class="form-control" autocomplete="off"
                   placeholder="Enter Your Address"
                   value="{{ Auth::user()->address }}">
            <input type="hidden" id="latitude" name="latitude"
                   value="{{ (Auth::user()->latitude) ? Auth::user()->latitude : '' }}">
            <input type="hidden" id="longitude" name="longitude"
                   value="{{ (Auth::user()->longitude) ? Auth::user()->longitude : '' }}">
        </div>
    </div>
    <div class="col-md-4 mt-1" style="display: none"
         id="appendType">
        <div class="form-group  mt-3">
            <label class="form-label" for="display-radius">
                Radius(KM)
                <span style="color: red">*</span>
            </label>
            <input type="number" class="form-control"
                   id="display-radius" name="state_radius"
                   placeholder="Enter Radius"
                   value="{{ (Auth::user()->type_value) ? Auth::user()->type_value : '' }}">
        </div>
    </div>
@endif

<div class="col-md-12 mt-4">
    <center>
        @if(Auth::user()->location_setting=="active")
            <button class="btn btn-success btn-lg">Save</button>
        @else
            <strong class="text-bold text-danger">Location
                Setting Blocked by Admin.</strong>
        @endif
    </center>
</div>
</div>
</form>
</div><!-- data-list -->

</div><!-- .nk-block -->
</div>
@include('service_provider.includes.setting-sidebar')
</div>

@else

<div class="card-aside-wrap">
<div class="card-inner card-inner-lg">
<div class="nk-block-head">
<div class="nk-block-between d-flex justify-content-between">
<div class="nk-block-head-content">
<h4 class="nk-block-title">Service Location Settings</h4>
</div>

</div>
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="nk-data data-list">
<form action="{{ url('service-provider/address-update') }}"
method="post" id="AddressUpdateForm">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
    <div class="form-group">
        <label class="form-label" for="full-name">Where do you
            want to receive work</label>
        <select name="user_type" class="form-control" required
                onchange="GetTypeData(this.value)">
            @if($provideradminlocation->admin_location_type=="Country Wise")

                <option disabled selected value="">Select Type
                </option>
              <!--   <option disabled {{ (Auth::user()->type=="world") ? "selected" : '' }} value="world">
                    Worldwide
                </option> -->
                <option 
                        {{ (Auth::user()->type=="country") ? "selected" : '' }} value="country">
                    Countrywide
                </option>
                <option {{ (Auth::user()->type=="state") ? "selected" : '' }} value="state">
                    Statewide
                </option>
                 <option {{ (Auth::user()->type=="local business") ? "selected" : '' }} value="local business">
                    Locally
                </option>

            @endif

            @if($provideradminlocation->admin_location_type=="State Wise")
                <option disabled selected value="">Select Type
                </option>
              <!--   <option disabled {{ (Auth::user()->type=="world") ? "selected" : '' }} value="world">
                    Worldwide
                </option>
                <option disabled
                        {{ (Auth::user()->type=="country") ? "selected" : '' }} value="country">
                    Countrywide
                </option> -->
                <option 
                        {{ (Auth::user()->type=="state") ? "selected" : '' }} value="state">
                    Statewide
                </option>
                 <option {{ (Auth::user()->type=="local business") ? "selected" : '' }} value="local business">
                    Locally
                </option>
            @endif


        </select>
    </div>
</div>

<div class="col-md-12 mt-4" id="main_div">
    <div class="row">

        @if($provideradminlocation->admin_location_type=="Country Wise")
            <div class="col-md-{{$col}}" id="bus_country">
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
            <div class="col-md-{{$col}}" id="bus_state">
                <div class="form-group">
                    <label class="form-label" for="full-name">State
                        <span style="color: red">*</span>
                    </label>
                    <select name="state" id="state"
                            class="form-control select2"
                            onchange="GetCities(this.value)">
                          @if($statename)
                               @foreach(Acelle\Jobs\HelperJob::statelist(Auth::user()->country) as $states)
                                <option value="{{ $states->id }}" {{ (Auth::user()->state == $states->id) ? 'selected' : '' }}> {{$states->name}}
                                </option>
                                @endforeach
                            @else
                                <option disabled selected value="">
                                    Select Country First
                                </option>
                            @endif
                    </select>
                </div>
            </div>
            <div class="col-md-{{$col}}" id="bus_city">
                <div class="form-group">
                    <label class="form-label" for="full-name">City
                        <span style="color: red">*</span>
                    </label>
                    <select name="city" id="city"
                            class="form-control select2"
                            >
                        @if($cityname)
                            <option value="{{ Auth::user()->city }}">{{ ($cityname) ? $cityname->name : '' }}</option>
                        @else
                            <option disabled selected value="">
                                Select State First
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        @endif

        @if($provideradminlocation->admin_location_type=="State Wise")
            <div class="col-md-{{$col}}" id="bus_country">
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
            <div class="col-md-{{$col}}" id="bus_state">
                <div class="form-group">
                    <label class="form-label" for="full-name">State
                        <span style="color: red">*</span>
                    </label>
                    <select name="state" id="state"
                            class="form-control select2"
                            onchange="GetCities(this.value)">
                        <option selected
                                value="{{ ($providerstatename) ? $providerstatename->id : '' }}">{{ ($providerstatename) ? $providerstatename->name : '' }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-{{$col}}" id="bus_city">
                <div class="form-group">
                    <label class="form-label" for="full-name">City
                        <span style="color: red">*</span>
                    </label>
                        <?php $citylist = Acelle\Jobs\HelperJob::citieslist($provideradminlocation->state); ?>
                    <select name="city" id="city"
                            class="form-control select2"
                            >
                        @forelse($citylist as $citylis)

                            @if(Auth::user()->city==$citylis->id)
                                <option selected value="{{ $citylis->id }}">{{ $citylis->name }}</option>
                            @else
                                <option value="{{ $citylis->id }}">{{ $citylis->name }}</option>
                            @endif

                        @empty
                        @endforelse

                    </select>
                </div>
            </div>
        @endif


    </div>
</div>

@if(Auth::user()->type=="local business")
    <div class="col-md-8 mt-4" id="bus_address">
        <div class="form-group">
            <label class="form-label" for="address">Address
                <span style="color: red">*</span>
            </label>
            <input type="text" name="address" id="address"
                   class="form-control" autocomplete="off"
                   placeholder="Enter Your Address"
                   value="{{ Auth::user()->address }}">
            <input type="hidden" id="latitude" name="latitude"
                   value="{{ (Auth::user()->latitude) ? Auth::user()->latitude : '' }}">
            <input type="hidden" id="longitude" name="longitude"
                   value="{{ (Auth::user()->longitude) ? Auth::user()->longitude : '' }}">
        </div>
    </div>
        <div class="col-md-4 mt-1" id="appendType">
            <div class="form-group  mt-3">
                <label class="form-label" for="display-radius">
                    Radius(KM)
                     <span style="color: red">*</span>
                </label>
                <input type="number" class="form-control"
                       id="display-radius" name="state_radius"
                       placeholder="Enter Radius"
                       value="{{ (Auth::user()->type_value) ? Auth::user()->type_value : '' }}">
            </div>
        </div>
@else
    <div class="col-md-8 mt-4" style="display: none"
         id="bus_address">
        <div class="form-group">
            <label class="form-label" for="address">Address
                <span style="color: red">*</span>
            </label>
            <input type="text" name="address" id="address"
                   class="form-control" autocomplete="off"
                   placeholder="Enter Your Address"
                   value="{{ Auth::user()->address }}">
            <input type="hidden" id="latitude" name="latitude"
                   value="{{ (Auth::user()->latitude) ? Auth::user()->latitude : '' }}">
            <input type="hidden" id="longitude" name="longitude"
                   value="{{ (Auth::user()->longitude) ? Auth::user()->longitude : '' }}">
        </div>
    </div>
    <div class="col-md-4 mt-1" style="display: none"
         id="appendType">
        <div class="form-group  mt-3">
            <label class="form-label" for="display-radius">
                Radius(KM)
                 <span style="color: red">*</span>
            </label>
            <input type="number" class="form-control"
                   id="display-radius" name="state_radius"
                   placeholder="Enter Radius"
                   value="{{ (Auth::user()->type_value) ? Auth::user()->type_value : '' }}">
        </div>
    </div>
@endif

<div class="col-md-12 mt-4">
    <center>
        @if(Auth::user()->location_setting=="active")
            <button class="btn btn-success btn-lg">Save</button>
        @else
            <strong class="text-bold text-danger">Location
                Setting Blocked by Admin.</strong>
        @endif
    </center>
</div>

</div>
</form>
</div><!-- data-list -->

</div><!-- .nk-block -->
</div>
@include('service_provider.includes.setting-sidebar')
</div>

@endif


</div><!-- .card -->
</div><!-- .nk-block -->
</div>
</div>
</div>
</div>
<!-- content @e -->

@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBNL_1BSqiKF5qf0WqLbMT4xF1dB1Aux1M&libraries=places"></script>


@if($provideradminlocation->admin_location_type!="World Wide" && $provideradminlocation->admin_location_type=="Country Wise")
<script>
var pc = "{{ $providercountry->code }}";
var loc = pc.toLowerCase();
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
var options = {
componentRestrictions: {country: loc}
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
var countryid = {{ $provideradminlocation->country }};
GetStatesdata(countryid);
function GetStatesdata(val) {
$("#state").empty();
$.ajax({
url: "{{ url('service-provider/getstatesforprovider') }}/" + val,
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
var pc = "{{ $providercountry->code }}";
var loc = pc.toLowerCase();

google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
var options = {
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
var countryid = {{ $provideradminlocation->country }};
var stateid = {{ $provideradminlocation->state }};

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
var loc = pc.toLowerCase();
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
var options = {
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
 $("#bus_state").hide();
 $("#bus_city").hide();
 $("#bus_address").hide();
 $("#appendType").hide();
 $('#main_div').show();
 $('#bus_country').removeClass('col-md-4');
 $('#bus_country').removeClass('col-md-6');
 $('#bus_country').addClass('col-md-12');

}
else if(val == "state"){
 @if($provideradminlocation->admin_location_type=="World Wide" || $provideradminlocation->admin_location_type=="Country Wide")
  var countryid = {{ $provideradminlocation->country }};
  GetStates(countryid);
 @endif
 $("#bus_state").show();
 $("#bus_city").hide();
 $("#bus_address").hide();
 $("#appendType").hide();
 $('#bus_country').removeClass('col-md-12');
 $('#bus_state').removeClass('col-md-12');
 $('#bus_city').removeClass('col-md-4');
 $('#bus_state').addClass('col-md-6');
 $('#bus_country').addClass('col-md-6');
 $('#main_div').show();

}
else if(val == "city"){

 $('#main_div').show();
 $("#bus_state").show();
 $("#bus_city").show();
 $("#bus_address").hide();
 $("#appendType").hide();
}
else if (val == "local business") {
 $('#main_div').hide();
 $("#bus_state").hide();
 $("#bus_city").hide();
 $("#bus_address").show();
 $("#appendType").show();
} else {
$('#bus_country').removeClass('col-md-12');
$('#bus_state').removeClass('col-md-12');
$('#bus_city').removeClass('col-md-12');
$('#bus_country').removeClass('col-md-6');
$('#bus_state').removeClass('col-md-6');
$('#bus_city').removeClass('col-md-6');
$('#bus_city').addClass('col-md-4');
$('#bus_state').addClass('col-md-4');
$('#bus_country').addClass('col-md-4');
$('#main_div').show();
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
url: "{{ url('service-provider/getstates') }}/" + val,
method: "get",
success: function (data) {
$("#state").html(data);
}
});
}

function GetCities(val) {
$.ajax({
url: "{{ url('service-provider/getcities') }}/" + val,
method: "get",
success: function (data) {
$("#city").html(data);
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
function showsidebar(){
   $('.side-class').toggle();
}

</script>
@endsection