
<?php
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $countries = Acelle\Jobs\HelperJob::countries(); 
  $providerstatename = Acelle\Jobs\HelperJob::statename($provideradminlocation->state);
  $providercityname = Acelle\Jobs\HelperJob::cityname($provideradminlocation->city); 
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country); 
?>
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
    .recaptcha-box{
      margin-bottom: 0px !important;
    }
    .btn-view-password {
      margin-top: -35px !important;
    }
   @media only screen and (max-width: 468px) {
        
        .pl-xm-0{
         padding-left: 0px !important;
        }
       

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
        <div class="panel panel-body p-4 rounded-3 shadow" style="background: rgba(255, 255, 255, 0.9);">
         <h4 class="text-semibold mt-0 mb-4 fw-600 fs-5">{{ trans('messages.create_your_account') }}</h4>
         <!-- <p>If you would like to become part of our network and offer your business and provide your skills to people looking for your skills then please register below.<a href="{{url("users/login")}}"> Login</a></p> -->
            <div class="">
                
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
                
                    <input id="subdomain" placeholder="" value="{{\Acelle\Model\Setting::subdomain()}}" type="hidden" name="subdomain" class="form-control required unique:users,subdomain,,id  ">
                <input type="hidden" name="user_type" value="service_provider">
                    </div>
                <div class="row">
  
               <div class="col-md-6 p-0"> 
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'first_name',
                    'value' => $name,
                    'rules' => $user->registerRules($name)
                ])
               </div>
               <div class="col-md-6 pr-0 pl-xm-0"> 
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'last_name',
                    'value' => $user->last_name,
                    'rules' => $user->registerRules($user->subdomain)
                ])
               </div>
               <div class="col-md-6 p-0"> 
                 @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'email',
                    'value' => $email,
                    'help_class' => 'profile',
                    'rules' => $user->registerRules($email)
                ])
                 </div>
                 <div class="col-md-6 pr-0 pl-xm-0"> 
                @include('helpers.form_control', [
                    'type' => 'password',
                    'label'=> trans('messages.password'),
                    'name' => 'password',
                    'rules' => $user->registerRules($user->subdomain),
                    'eye' => true,
                ])
              </div>
                </div>
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
                  @if($provideradminlocation->admin_location_type=="World Wide")
                   <div class="form-group control-text" id="main_div" style="display: none">
                    <div class="col-md-12 p-0 mt-4">
                    <div class="row">
                        <div class="col-md-4 p-0" id="bus_country">
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

                        <div class="col-md-4 pr-0" id="bus_state">
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
                        <div class="col-md-4 pr-0" id="bus_city">
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
                @endif
                  <div class="col-md-12 mt-4 p-0" id="main_div">
                  <div class="row">

                      @if($provideradminlocation->admin_location_type=="Country Wise")
                          <div class="col-md-12 p-0" id="bus_country" style="display: none">
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
                          <div class="col-md-12 pr-0"  id="bus_state" style="display: none;">
                              <div class="form-group">
                                  <label class="form-label" for="full-name">State
                                      <span style="color: red">*</span>
                                  </label>
                                  <select name="state"
                                          class="form-control select2"
                                          onchange="GetCities(this.value)">
                                        
                                             @foreach(Acelle\Jobs\HelperJob::statelist($provideradminlocation->country) as $states)
                                              <option value="{{ $states->id }}" {{ ($provideradminlocation->state == $states->id) ? 'selected' : '' }}> {{$states->name}}
                                              </option>
                                              @endforeach
                                  </select>
                              </div>
                          </div>
                       
                      @endif

                      @if($provideradminlocation->admin_location_type=="State Wise")
                          <div class="col-md-12 p-0"  id="bus_country" style="display: none">
                           
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
                             <div class="col-md-6 pr-0" id="bus_state" style="display: none;">
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
                      @endif


                  </div>
              </div>
              <div class="row">
                
                <div class="col-md-6 p-0" id="bus_address" style="display: none;">
                   <div class="form-group control-text">
                    <label class="form-label">
                        Business Address
                        <span style="color: red">*</span>
                     </label>
                      <input type="text" name="address" id="address"  class="form-control" autocomplete="off" placeholder="Enter Your Address">
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>
                  </div>
                <div class="col-md-6 pr-0" id="appendType" style="display: none;">

                     <div class="form-group control-text">
                      <div class="form-group">
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
                        <div class="col-md-12 pl-xm-0">
                            @if ($errors->has('recaptcha_invalid'))
                                <div class="text-danger text-center">{{ $errors->first('recaptcha_invalid') }}</div>
                            @endif
                            {!! Acelle\Library\Tool::showReCaptcha() !!}
                        </div>
                    </div>
                @endif
                <hr>
                <div class="row flex align-items">
                    <div class="col-md-12">
                        <button type='submit' class="btn rounded-2 btn-primary d-block login-button py-2 fw-600"
            style="width:100%;text-transform:uppercase"><i class="icon-check"></i> {{ trans('messages.get_started') }}</button>
                    </div>
                   
                        
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnout.com/toastr.js"></script>
   <script rel="preload" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBNL_1BSqiKF5qf0WqLbMT4xF1dB1Aux1M&libraries=places"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.select2').select2();
        });

    </script>

@if($provideradminlocation->admin_location_type!="World Wide" && $provideradminlocation->admin_location_type=="Country Wise")
<script>
  var countryid = {{ $provideradminlocation->country }};
  GetStatesdata(countryid);
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
  @if($providercountry)
  var pc = "{{ $providercountry->code }}";
  @else 
    var pc = 'au';
  @endif
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
 $("#bus_country").show();
 $("#bus_state").hide();
 $("#world_wise").hide();
 $('#main_div').show();
 $("#bus_city").hide();
 $("#bus_address").hide();
 $("#appendType").hide();
 $('#bus_country').removeClass('col-md-4');
 $('#bus_country').removeClass('col-md-6');
 $('#bus_country').addClass('col-md-12');
}
else if(val == "world"){
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
else if(val == "state"){
 @if($provideradminlocation->admin_location_type=="World Wide" || $provideradminlocation->admin_location_type=="Country Wide")
  var countryid = {{ $provideradminlocation->country }};
  GetStates(countryid);
 @endif
 $("#bus_country").show();
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
 $("#country_wise").hide();
 $("#state_wise").hide();
 $("#world_wise").hide();
 $("#city_wise").show();
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
