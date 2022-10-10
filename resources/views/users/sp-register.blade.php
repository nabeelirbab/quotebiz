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
</style>
@section('content')
  <form enctype="multipart/form-data" action="{{ url('customer/sp-register') }}" method="POST" class="form-validate-jqueryz subscription-form">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="row mt-5 mc-form">
            <div class="col-md-2"></div>
            <div class="col-md-2 text-end mt-60">
                <a class="main-logo-big" href="{{ url('/') }}">
                    <img width="150px" src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark')) }}" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h1 class="mb-20">Register Your Business</h1>
                <p>If you would like to become part of our network and offer your business and provide your skills to people looking for your skills then please register below.</p>
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
                        <b>Where do you want to receive work</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select name="business_type" class="form-control" required onchange="GetTypeData(this.value)">
                        <option disabled selected value="">Select Type</option>
                        <option value="local business">
                            Local Business
                        </option>
                        <option value="country">
                            Country
                        </option>
                        <option value="state">
                            State
                        </option>
                    </select>
                  </div>
                   <div class="form-group control-text" id="appendType">
                   
                  </div>
                  <div class="form-group control-text">
                    <label>
                        <b>Business Category</b>
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
                   <div class="form-group control-text">
                    <label>
                        <b>Business Registration Number</b>
                     </label>
                     <input type="text" name="business_reg" class="form-control" >
                  </div>
                   <div class="form-group control-text">
                    <label>
                        <b>Business Phone</b>
                        <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="business_phone" class="form-control" required>
                  </div>
                   <div class="form-group control-text">
                    <label>
                        <b>Business Email</b>
                        <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="business_email" class="form-control" required>
                  </div>
                   <div class="form-group control-text">
                    <label>
                        <b>Business Website</b>
                     </label>
                     <input type="text" name="business_website" class="form-control" >
                  </div>
                  <div class="form-group control-text">
                    <label>
                        <b>Country</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select name="country" id="country" class="form-control select2" required onchange="GetStates(this.value)">
                        <option disabled selected value="">Select Country
                        </option>
                        @forelse(Acelle\Jobs\HelperJob::countries() as $country)
                         <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @empty
                        @endforelse
                    </select>
                  </div>
                    <div class="form-group control-text">
                     <label>
                        <b>State</b>
                         <span class="text-danger">*</span>
                     </label>
                       <select name="state" id="state" class="form-control select2" required onchange="GetCities(this.value)">
                        <option disabled selected value="">Select Country
                            First
                        </option>
                     </select>
                   </div>
                    <div class="form-group control-text">
                     <label>
                        <b>City</b>
                        <span class="text-danger">*</span>
                     </label>
                      <select name="city" id="city" class="form-control select2" required>
                        <option disabled selected value="">Select State
                            First
                        </option>
                    </select>
                   </div>
                   <div class="form-group control-text" id="business_address" style="display: none">
                    <label>
                        <b>Business Address</b>
                     </label>
                      <input type="text" name="address" id="address" required class="form-control" autocomplete="off" placeholder="Enter Your Address">
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
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

       function GetTypeData(val) {
            $("#appendType").empty();
            if (val == "local business") {
                $('#business_address').show();
                $("#appendType").append('<div class="form-group"><label class="form-label" for="display-radius">Radius(KM)</label> <input type="number" class="form-control" id="display-radius" name="state_radius" placeholder="Enter Radius"></div>');
            }else{
               $('#business_address').hide();
            }
        }
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

        function GetStates(val) {
            $("#state").empty();
            $("#city").empty();
            $("#city").html("<option value='' selected disabled>Select State First</option>");
            $.ajax({
                url: "{{ url('/getstates') }}/" + val,
                method: "get",
                success: function (data) {
                    $("#state").html(data);
                }
            });
        }

        function GetCities(val) {
            $.ajax({
                url: "{{ url('/getcities') }}/" + val,
                method: "get",
                success: function (data) {
                    $("#city").html(data);
                }
            });
        }

        $("#AddressUpdateForm").submit(function (event) {
            var lat = $("#latitude").val();
            var long = $("#longitude").val();
            if (lat == "" || long == "") {
                alert("Please Enter Valid Address !");
                event.preventDefault();
                return false;
            }
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
