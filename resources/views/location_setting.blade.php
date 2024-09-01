@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

<?php $countries = Acelle\Jobs\HelperJob::countries(); ?>
<?php $countryname = Acelle\Jobs\HelperJob::countryname($userdetail->country); ?>
<?php $statename = Acelle\Jobs\HelperJob::statename($userdetail->state); ?>
<?php $cityname = Acelle\Jobs\HelperJob::cityname($userdetail->city); ?>


@section('head')
    <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">User / <strong
                                            class="text-primary small">{{$userdetail->first_name}} {{$userdetail->last_name}}</strong>
                                    &nbsp;
                                    @if($userdetail->activated == '1')
                                        <span class="badge badge-outline-success badge-pill">Active</span>
                                    @else
                                        <span class="badge badge-outline-danger badge-pill">Inactive</span>
                                    @endif
                                </h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>User ID: <span class="text-base">{{$userdetail->id}}</span></li>
                                        <li>Last Login: <span class="text-base">{{$userdetail->last_login_at}}</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="nk-block-head-content">
                                @if(Session::has('success'))
                                    <div class="alert alert-success  fade show" role="alert">
                                        {{Session::get('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#"><em
                                                        class="icon ni ni-location"></em><span>Location Setting</span></a>
                                        </li>

                                        <li class="nav-item nav-item-trigger ">
                                            <a href="#" class="toggle btn btn-icon btn-trigger" data-target="userAside"><em
                                                        class="icon ni ni-user-list-fill"></em></a>
                                        </li>
                                    </ul><!-- .nav-tabs -->
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <h5 class="title">Location Setting</h5>
                                                <p>Basic info, like your Location address.</p>
                                            </div><!-- .nk-block-head -->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ url('admin/Save_location_setting')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="providerid" value="{{ $userdetail->id }}">
                                                        <div class="row">

                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="full-name">Where do you
                                                                    want to
                                                                    receive work</label>
                                                                <select name="user_type" class="form-control" required
                                                                        onchange="GetTypeData(this.value)">
                                                                    <option disabled selected value="">Select Type
                                                                    </option>
                                                                    <option {{ ($userdetail->type=="local business") ? "selected" : '' }} value="local business">
                                                                        Local Business
                                                                    </option>
                                                                    <option {{ ($userdetail->type=="country") ? "selected" : '' }} value="country">
                                                                        Country
                                                                    </option>
                                                                    <option {{ ($userdetail->type=="state") ? "selected" : '' }} value="state">
                                                                        State
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3" id="appendType">
                                                                @if($userdetail->type=="local business")
                                                                    <label class="form-label" for="display-radius">Radius(KM)</label>
                                                                    <input type="number" class="form-control"
                                                                           id="display-radius" name="state_radius"
                                                                           placeholder="Enter Radius"
                                                                           value="{{ ($userdetail->type_value) ? $userdetail->type_value : '' }}">
                                                                @endif
                                                            </div>

                                                            <div class="col-md-6 mb-3">

                                                                <label class="form-label" for="full-name">Country
                                                                    <span style="color: red">*</span>
                                                                </label>
                                                                <select name="country" id="country"
                                                                        class="form-control select2" required
                                                                        onchange="GetStates(this.value)" style="background-color: transparent !important;">
                                                                    <option disabled selected value="">Select Country
                                                                    </option>
                                                                    @forelse($countries as $country)
                                                                        @if($userdetail->country==$country->id)
                                                                            <option selected
                                                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                                                        @else
                                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                </select>

                                                            </div>

                                                         <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="state">State
                                                                    <span style="color: red">*</span>
                                                                </label>
                                                                <select name="state" id="state" class="form-control select2" required onchange="GetCities(this.value)">
                                                                    <option value="" disabled selected>Select State</option>
                                                                    <!-- Options will be dynamically added by AJAX -->
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label" for="city">City
                                                                    <span style="color: red">*</span>
                                                                </label>
                                                                <select name="city" id="city" class="form-control select2" required>
                                                                    <option value="" disabled selected>Select City</option>
                                                                    <!-- Options will be dynamically added by AJAX -->
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3">

                                                                <label class="form-label" for="full-name">Allow Service Provider to change location Setting
                                                                    <span style="color: red">*</span>
                                                                </label>
                                                                <select name="allow_location_setting" class="form-control select2" required>
                                                                    <option {{ ($userdetail->location_setting=="active") ? "selected" : '' }} value="active">active</option>
                                                                    <option {{ ($userdetail->location_setting=="blocked") ? "selected" : '' }} value="blocked">blocked</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-md-6 mb-3"></div>

                                                            <center>
                                                                <button class="btn btn-outline-info mt-4"> Update </button>
                                                            </center>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div><!-- .nk-block -->

                                    </div><!-- .card-inner -->
                                </div><!-- .card-content -->
                                <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right"
                                     data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true"
                                     data-toggle-body="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar lg bg-primary">
                                                    <span>{{mb_substr($userdetail->first_name, 0, 1)}}{{mb_substr($userdetail->last_name, 0, 1)}}</span>
                                                </div>
                                                <div class="user-info">
                                                    <div class="badge badge-outline-light badge-pill ucap">Service
                                                        Provider
                                                    </div>
                                                    <h5>{{$userdetail->first_name}} {{$userdetail->last_name}}</h5>
                                                    <span class="sub-text">{{$userdetail->email}}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner card-inner-sm">
                                            <ul class="btn-toolbar justify-center gx-1">

                                                <li><a href="#" class="btn btn-trigger btn-icon"><em
                                                                class="icon ni ni-mail"></em></a></li>
                                                @if($userdetail->activated == '1')
                                                    <li>
                                                        <a href="{{ url('admin/account_status/'.$userdetail->id.'?status=0') }}"
                                                           onclick="return confirm('Are you sure you want to suspend this account?');"
                                                           class="btn btn-trigger btn-icon text-danger"
                                                           title="Suspend Account"><em class="icon ni ni-na"></em></a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ url('admin/account_status/'.$userdetail->id.'?status=1') }}"
                                                           onclick="return confirm('Are you sure you want to suspend this account?');"
                                                           class="btn btn-trigger btn-icon" title="Active Account"><em
                                                                    class="icon ni ni-shield-check"></em></a></li>
                                                @endif
                                            </ul>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="overline-title-alt mb-2">In Account</div>
                                            <div class="profile-balance">
                                                <div class="profile-balance-group gx-4">
                                                    <div class="profile-balance-sub">
                                                        <div class="profile-balance-amount">
                                                            <div class="number">{{$userdetail->credits}} </div>
                                                        </div>
                                                        <div class="profile-balance-subtitle">Available Credits</div>
                                                    </div>
                                                    <!--  <div class="profile-balance-sub">
                                                         <span class="profile-balance-plus text-soft"><em class="icon ni ni-plus"></em></span>
                                                         <div class="profile-balance-amount">
                                                             <div class="number">1,643.76</div>
                                                         </div>
                                                         <div class="profile-balance-subtitle">Profit Earned</div>
                                                     </div> -->
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">23</span>
                                                        <span class="sub-text">Total Order</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">20</span>
                                                        <span class="sub-text">Complete</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">3</span>
                                                        <span class="sub-text">Progress</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->

                                    </div><!-- .card-inner -->
                                </div><!-- .card-aside -->
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
    <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        function GetTypeData(val) {
            $("#appendType").empty();
            if (val == "local business") {
                $("#appendType").append('<label class="form-label" for="display-radius">Radius(KM)</label> <input type="number" class="form-control" id="display-radius" name="state_radius" placeholder="Enter Radius" value="{{ ($userdetail->type_value) ? $userdetail->type_value : '' }}">');
            }
        }

     function GetStates(countryId) {
        $("#state").empty();
        $("#city").empty();
        $("#city").html("<option value='' selected disabled>Select City</option>");
        
        $.ajax({
            url: "{{ url('admin/getstates') }}/" + countryId,
            method: "get",
            success: function (data) {
                $("#state").html(data);

                // Automatically select the state if it's already set
                var selectedState = "{{ $userdetail->state }}";
                if (selectedState) {
                    $("#state").val(selectedState).trigger('change');
                }
            }
        });
    }

    function GetCities(stateId) {
        $.ajax({
            url: "{{ url('admin/getcities') }}/" + stateId,
            method: "get",
            success: function (data) {
                $("#city").html(data);

                // Automatically select the city if it's already set
                var selectedCity = "{{ $userdetail->city }}";
                if (selectedCity) {
                    $("#city").val(selectedCity);
                }
            }
        });
    }

    // Function to run on page load
    function initializePage() {
        var country = "{{ $userdetail->country }}"; // Assuming you have a country value
        var state = "{{ $userdetail->state }}"; // Assuming you have a state value

        // Trigger GetStates if country is set
        if (country) {
            GetStates(country);

            // Optionally trigger GetCities if state is set after states are loaded
            if (state) {
                // Adding a small delay to ensure states are loaded before cities
                setTimeout(function() {
                    GetCities(state);
                }, 500);
            }
        }
    }

    // Run initializePage function when the window loads
    window.onload = initializePage;
    </script>

@endsection
