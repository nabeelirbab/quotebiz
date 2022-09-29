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
    </style>
@endsection
@section('content')

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card">
                            @if(Session::has('success'))
                                <div class="alert alert-success  fade show mt-5" role="alert">
                                    <strong>Service Location Information !</strong> {{Session::get('success')}}
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
                                                <h4 class="nk-block-title">Service Location Information</h4>
                                                <div class="nk-block-des">
                                                    <p>Basic info, like your Address , Country and State, that you use
                                                        on Nio Platform.</p>
                                                </div>
                                            </div>
                                            <div class="nk-tab-actions mr-n1">
                                                <a href="#" class="btn btn-icon btn-trigger" data-toggle="modal"
                                                   data-target="#profile-edit">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Type</span>
                                                    <span class="data-value"
                                                          style="text-transform:capitalize">{{ (Auth::user()->type) ? Auth::user()->type : '--' }}</span>
                                                </div>
                                            </div><!-- data-item -->

                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label" style="text-transform:capitalize">
                                                        {{ (Auth::user()->type) ? Auth::user()->type : '--' }}
                                                    </span>
                                                    <span class="data-value">
                                                        @if(Auth::user()->type=="local business")
                                                            {{ (Auth::user()->type_value) ? Auth::user()->type_value : '--' }}
                                                            KM
                                                        @else
                                                            {{ (Auth::user()->type_value) ? Auth::user()->type_value : '--' }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->

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
                                                                    <input type="file" accept="image/*" name="image"
                                                                           id="uploadImg" onchange="uploadImg(this)"
                                                                           class="d-none">
                                                                    <label for="uploadImg" class="labelcls"><em
                                                                                class="icon ni ni-camera-fill cameraicon"></em><span>Change Photo</span></label>

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
                                                <li><a
                                                            href="service_providers/lms/admin-profile.html"><em
                                                                class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a>
                                                </li>
                                                <li><a href="service_providers/lms/admin-profile-notification.html"><em
                                                                class="icon ni ni-bell-fill"></em><span>Notifications</span></a>
                                                </li>
                                                <li><a href="service_providers/lms/admin-profile-activity.html"><em
                                                                class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a>
                                                </li>
                                                <li><a href="service_providers/lms/admin-profile-setting.html"><em
                                                                class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a>
                                                </li>
                                                <li><a class="active"
                                                       href="{{url('service-provider/locationSetting')}}"><em
                                                                class="icon ni ni-location"></em><span>Service Location Settings</span></a>
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
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title">Update Service Location</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Service Location</a>
                        </li>
                        <!--  <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                        </li> -->
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <form action="{{ url('service-provider/location-update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Type</label>
                                            <select name="user_type" class="form-control" required
                                                    onchange="GetTypeData(this.value)">
                                                <option disabled selected value="">Select Type</option>
                                                <option value="local business">local business</option>
                                                <option value="state">state</option>
                                                <option value="country">country</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="appendType"></div>

                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                    </div><!-- .tab-content -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
    <!-- language modal -->

@endsection
@section('script')

    <script type="text/javascript">
        function uploadImg(e) {
            console.log(e.files);
            var form_data = new FormData();

            var oFReader = new FileReader();
            oFReader.readAsDataURL(e.files[0]);
            var f = e.files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                alert("Image File Size is very big");
            } else {
                form_data.append("file", e.files[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('service-provider/userImg') }}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (data) {
                        $('.uploadimg').html('<div style="margin-right: 15px;" class="nk-msg-media user-avatar"><img src="' + data + '" alt=""></div>');
                    }
                });
            }

        }

        function GetTypeData(val) {
            $("#appendType").empty();
            if (val == "local business") {
                $("#appendType").append('<div class="form-group"><label class="form-label" for="display-radius">Radius</label> <input type="number" class="form-control" id="display-radius" name="state_radius" placeholder="Enter Radius"></div>');
            }
            if (val == "state") {
                $("#appendType").append('<div class="form-group"><label class="form-label" for="display-State">State</label> <input type="text" class="form-control" id="display-State" name="state_radius" placeholder="Enter State"></div>');
            }
            if (val == "country") {
                form_data = "country";
                $.ajax({
                    url: "{{ url('service-provider/userCountries') }}",
                    method: "get",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (data) {
                        $("#appendType").html(data);
                    }
                });
            }
        }
    </script>
@endsection