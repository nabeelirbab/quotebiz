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
                                    <strong>Profile!</strong> {{Session::get('success')}}
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
                                                <h4 class="nk-block-title">Personal Information</h4>
                                                <div class="nk-block-des">
                                                    <p>Basic info, like your name and address, that you use on {{\Acelle\Model\Setting::get("site_name")}}.</p>
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
                                                    <span class="data-label">Full Name</span>
                                                    <span class="data-value">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                                </div>
                                            </div><!-- data-item -->

                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value">{{Auth::user()->email}}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Phone Number</span>
                                                    <span class="data-value text-soft">
                                                        @if(Auth::user()->mobileno)
                                                            {{Auth::user()->mobileno}}
                                                        @else
                                                            Not add yet
                                                        @endif</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">City</span>
                                                    @if(Auth::user()->city)
                                                    <span class="data-value ">{{Acelle\Jobs\HelperJob::cityname(Auth::user()->city)->name}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Address</span>
                                                    <span class="data-value ">
                                                        @if(Auth::user()->address)
                                                            {{Auth::user()->address}}
                                                        @else
                                                            Not add yet
                                                        @endif</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Zipcode</span>
                                                    <span class="data-value ">{{Auth::user()->zipcode}}</span>
                                                </div>
                                            </div>
                                             <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Experience</span>
                                                    <span class="data-value ">{{Auth::user()->experience}}</span>
                                                </div>
                                            </div>
                                             <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Biography</span>
                                                    <span class="data-value ">{{Auth::user()->biography}}</span>
                                                </div>
                                            </div>
                                            <!-- data-item -->

                                        </div><!-- data-list -->

                                    </div><!-- .nk-block -->
                                </div>
                             @include('service_provider.includes.setting-sidebar')
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
                    <h5 class="title">Update Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                        </li>
                        <!--  <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                        </li> -->
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <form action="{{ url('service-provider/profile-update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">First Name</label>
                                            <input type="text" class="form-control" id="full-name"
                                                   value="{{Auth::user()->first_name}}" name="first_name"
                                                   placeholder="Enter Full name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Last Name</label>
                                            <input type="text" class="form-control" id="display-name"
                                                   value="{{Auth::user()->last_name}}" name="last_name"
                                                   placeholder="Enter display name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Phone Number</label>
                                            <input type="text" class="form-control" id="phone-no"
                                                   value="{{Auth::user()->mobileno}}" name="mobileno"
                                                   placeholder="Phone Number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="personal-email">Address</label>
                                            <input type="text" class="form-control" name ="address" id="personal-email"
                                                   value="{{Auth::user()->address}}" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="zipcode">Zipcode</label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode"
                                                   value="{{Auth::user()->zipcode}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="experience">Experience</label>
                                            <input type="text" class="form-control" name="experience" id="experience"
                                                   value="{{Auth::user()->experience}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="experience">Biography</label>
                                            <textarea name="biography" class="form-control" rows="4" cols="6">{{Auth::user()->biography}}</textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                        <div class="tab-pane" id="address">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Address Line 1</label>
                                        <input type="text" class="form-control" id="address-l1"
                                               value="2337 Kildeer Drive">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l2">Address Line 2</label>
                                        <input type="text" class="form-control" id="address-l2" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-st">State</label>
                                        <input type="text" class="form-control" id="address-st" value="Kentucky">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-county">Country</label>
                                        <select class="form-select" id="address-county">
                                            <option>Canada</option>
                                            <option>United State</option>
                                            <option>United Kindom</option>
                                            <option>Australia</option>
                                            <option>India</option>
                                            <option>Bangladesh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" data-dismiss="modal" class="btn btn-primary">Update Address</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
        function showsidebar(){
            $('.side-class').toggle();
        }
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
    </script>
@endsection