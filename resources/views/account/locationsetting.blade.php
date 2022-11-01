@extends('layouts.core.frontend')

@section('title', 'Currency')

@section('page_header')

    <?php $countries = Acelle\Jobs\HelperJob::countries(); ?>
    <?php $countryname = Acelle\Jobs\HelperJob::countryname(Auth::user()->country); ?>
    <?php $statename = Acelle\Jobs\HelperJob::statename(Auth::user()->state); ?>
    <?php $cityname = Acelle\Jobs\HelperJob::cityname(Auth::user()->city); ?>


    @section('head')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @endsection

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li class="breadcrumb-item"><a href="{{ url("/admin") }}">{{ trans('messages.home') }}</a></li>
            <li class="breadcrumb-item active">Location Setiing</li>
        </ul>
        <h1>
<span class="text-semibold"><span class="material-icons-round">
person_outline
</span> {{ Auth::user()->displayName() }}</span>
        </h1>
    </div>

@endsection

@section('content')

    @include("account._menu")

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title page-title">Service Location Settings</h3>

                </div><!-- .nk-block-head-content -->

            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="card card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <!-- <span class="preview-title-lg overline-title">Create Category</span> -->
                    <form action="" method="post" enctype="multipart/form-data" style="padding: 40px">
                        {{ csrf_field() }}

                        <div class="row d-flex justify-content-center gy-4">

                            <div class="col-sm-12">
                                <label for="">Select Type</label>
                                <select name="type" class="form-control select2" onchange="GetRecord(this.value)"
                                        required>
                                    <option value="">Select Type</option>
                                    <option {{ (Auth::user()->admin_location_type=="World Wide") ? "selected" : '' }} value="World Wide">
                                        WorldWide
                                    </option>
                                    <option {{ (Auth::user()->admin_location_type=="Country Wise") ? "selected" : '' }} value="Country Wise">
                                        Countrywide
                                    </option>
                                    <option {{ (Auth::user()->admin_location_type=="State Wise") ? "selected" : '' }} value="State Wise">
                                        Statewide
                                    </option>
                                    <option {{ (Auth::user()->admin_location_type=="City Wise") ? "selected" : '' }} value="City Wise">
                                        Citywide
                                    </option>
                                </select>
                            </div>

                        </div>

                        @if(Auth::user()->admin_location_type=="World Wide" || Auth::user()->admin_location_type=="")
                            <div class="row mt-3" style="display: none" id="country_state_city">
                                @else
                                    <div class="row mt-3" id="country_state_city">
                                        @endif

                                        <div class="col-md-4">

                                            <label class="form-label" for="full-name">Country
                                            </label>
                                            <select name="country" id="country"
                                                    class="form-control select2"
                                                    onchange="GetStates(this.value)"
                                                    style="background-color: transparent !important;">
                                                <option disabled selected value="">Select Country
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

                                        <div class="col-md-4">

                                            <label class="form-label" for="full-name">State
                                                {{--                                    <span style="color: red">*</span>--}}
                                            </label>
                                            <select name="state" id="state"
                                                    class="form-control select2"
                                                    onchange="GetCities(this.value)">
                                                @if($statename)
                                                    <option selected
                                                            value="{{ Auth::user()->state }}">{{ ($statename) ? $statename->name : '' }}
                                                    </option>
                                                @else
                                                    <option disabled selected value="">
                                                        Select Country First
                                                    </option>
                                                @endif
                                            </select>

                                        </div>

                                        <div class="col-md-4">

                                            <label class="form-label" for="full-name">City
                                                {{--                                    <span style="color: red">*</span>--}}
                                            </label>
                                            <select name="city" id="city"
                                                    class="form-control select2">
                                                @if($cityname)
                                                    <option value="{{ Auth::user()->city }}">{{ ($cityname) ? $cityname->name : '' }}</option>
                                                @else
                                                    <option disabled selected value="">Select State
                                                        First
                                                    </option>
                                                @endif
                                            </select>

                                        </div>

                                    </div>

                                    <div class="row justify-content-center gy-4">

                                        <div class="col-sm-12 text-center">
                                            <button class="btn btn-success btn-lg" type="submit">Save</button>
                                        </div>

                                    </div>
                            </div>
                    </form>
                </div>
            </div>
        </div><!-- .card-preview -->

    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(".select2").select2();

        function GetStates(val) {
            $("#state").empty();
            $("#city").empty();
            $("#city").html("<option value='' selected disabled>Select State First</option>");
            $.ajax({
                url: "{{ url('admin/getstates') }}/" + val,
                method: "get",
                success: function (data) {
                    $("#state").html(data);
                }
            });
        }

        function GetCities(val) {
            $.ajax({
                url: "{{ url('admin/getcities') }}/" + val,
                method: "get",
                success: function (data) {
                    $("#city").html(data);
                }
            });
        }

        function GetRecord(val) {
            if (val != "World Wide") {
                $("#country_state_city").show();
            } else {
                $("#country_state_city").hide();
            }
        }

    </script>
@endsection
