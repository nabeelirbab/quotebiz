<?php $countries = Acelle\Jobs\HelperJob::countries(); ?>
<?php $countryname = Acelle\Jobs\HelperJob::countryname(Auth::user()->country); ?>
<?php $statename = Acelle\Jobs\HelperJob::statename(Auth::user()->state); ?>
<?php $cityname = Acelle\Jobs\HelperJob::cityname(Auth::user()->city); ?>


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
    </style>
@endsection

@section('content')

    <!-- content @s -->
    <div class="nk-content mb-3">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
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
                                            <form action="{{ url('service-provider/address-update') }}" method="post" id="AddressUpdateForm">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="full-name">Where do you want to receive work</label>
                                                            <select name="user_type" class="form-control" required onchange="GetTypeData(this.value)">
                                                                <option disabled selected value="">Select Type</option>
                                                                <option {{ (Auth::user()->type=="local business") ? "selected" : '' }} value="local business">
                                                                    Local Business
                                                                </option>
                                                                <option {{ (Auth::user()->type=="country") ? "selected" : '' }} value="country">
                                                                    Country
                                                                </option>
                                                                <option {{ (Auth::user()->type=="state") ? "selected" : '' }} value="state">
                                                                    State
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="full-name">Country
                                                                        <span style="color: red">*</span>
                                                                    </label>
                                                                    <select name="country" id="country" class="form-control select2" required onchange="GetStates(this.value)">
                                                                        <option disabled selected value="">Select Country
                                                                        </option>
                                                                        @forelse($countries as $country)
                                                                            @if(Auth::user()->country==$country->id)
                                                                                <option selected value="{{ $country->id }}">{{ $country->name }}</option>
                                                                            @else
                                                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                            @endif
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="full-name">State
                                                                        <span style="color: red">*</span>
                                                                    </label>
                                                                    <select name="state" id="state" class="form-control select2"
                                                                            required onchange="GetCities(this.value)">
                                                                        @if($statename)
                                                                            <option selected value="{{ Auth::user()->state }}">{{ ($statename) ? $statename->name : '' }}
                                                                            </option>
                                                                        @else
                                                                            <option disabled selected value="">
                                                                                Select Country First
                                                                            </option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="full-name">City
                                                                        <span style="color: red">*</span>
                                                                    </label>
                                                                    <select name="city" id="city" class="form-control select2" required>
                                                                        @if($cityname)
                                                                            <option value="{{ Auth::user()->city }}">{{ ($cityname) ? $cityname->name : '' }}</option>
                                                                        @else
                                                                            <option disabled selected value="">Select State First
                                                                            </option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8 mt-4" id="bus_address">
                                                        @if(Auth::user()->type=="local business")
                                                            <div class="form-group">
                                                                <label class="form-label" for="address">Address
                                                                    <span style="color: red">*</span>
                                                                </label>
                                                                <input type="text" name="address" id="address"  class="form-control" autocomplete="off"
                                                                       placeholder="Enter Your Address"
                                                                       value="{{ Auth::user()->address }}">
                                                                <input type="hidden" id="latitude" name="latitude"
                                                                       value="{{ (Auth::user()->latitude) ? Auth::user()->latitude : '' }}">
                                                                <input type="hidden" id="longitude" name="longitude" value="{{ (Auth::user()->longitude) ? Auth::user()->longitude : '' }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 mt-1" id="appendType">
                                                        @if(Auth::user()->type=="local business")
                                                            <div class="form-group  mt-3">
                                                                <label class="form-label" for="display-radius">   Radius(KM)
                                                                </label>
                                                                <input type="number" class="form-control" id="display-radius" name="state_radius" placeholder="Enter Radius" value="{{ (Auth::user()->type_value) ? Auth::user()->type_value : '' }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                        <center>
                                                            @if(Auth::user()->location_setting=="active")
                                                                <button class="btn btn-success btn-lg">Save</button>
                                                            @else
                                                                <strong class="text-bold text-danger">Location Setting Blocked by Admin.</strong>
                                                            @endif
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!-- data-list -->

                                    </div><!-- .nk-block -->
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                     data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="uploadimg">
                                                    @if(Auth::user()->user_img)
                                                        <div class="nk-msg-media user-avatar"
                                                             style="margin-right: 15px;">
                                                            <img src="{{asset('frontend-assets/images/users/'.Auth::user()->user_img)}}"
                                                                 alt="">
                                                        </div>
                                                    @else
                                                        <div class="user-avatar bg-primary" style="margin-right: 15px;">
                                                            <span>{{mb_substr(Auth::user()->first_name, 0, 1)}}{{mb_substr(Auth::user()->last_name, 0, 1)}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                                    <span class="sub-text">{{Auth::user()->email}}</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                                                           href="#"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <input type="file" accept="image/*" name="image" id="uploadImg" onchange="uploadImg(this)" class="d-none">
                                                                    <label for="uploadImg" class="labelcls">
                                                                        <em class="icon ni ni-camera-fill cameraicon"></em>
                                                                        <span>Change Photo</span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">Last Login</h6>
                                                <p>{{Auth::user()->last_login_at}}</p>
                                                <h6 class="overline-title-alt">Login IP</h6>
                                                <p>{{Auth::user()->last_login_ip}}</p>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">

                                                <li>
                                                    <a class="active" href="{{url('service-provider/location-setting')}}">
                                                        <em class="icon ni ni-location"></em>
                                                        <span>Service Location Settings</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{url('service-provider/business-setting')}}">
                                                        <em class="icon ni ni-user-fill-c"></em>
                                                        <span>Business Infomation</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{url('service-provider/settings')}}">
                                                        <em class="icon ni ni-user-fill-c"></em>
                                                        <span>Personal Infomation</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- .card-inner -->

                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->


@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBSIo75YZ1hfbKAQPDvo0Tfyys9Zo6c9hk&libraries=places"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
        });
        function GetTypeData(val) {
            $("#appendType").empty();
            if (val == "local business") {
                $("#appendType").append('<div class="form-group mt-3"><label class="form-label" for="display-radius">Radius(KM)</label> <input type="number" class="form-control" id="display-radius" name="state_radius" placeholder="Enter Radius" value="{{ (Auth::user()->type_value) ? Auth::user()->type_value : '' }}"></div>');
                $('#bus_address').show();

            }else{
                $('#bus_address').hide();
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


    </script>
@endsection