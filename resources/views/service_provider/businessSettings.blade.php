@extends('service_provider.layout.app')
@section('title', 'Profile')
@section('styling')
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap-multiselect.min.css') }}">
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
        .btn-group{
            width: 100%;
        }
        .multiselect-container{
            width: 100%;
        }
        .btn-group .dropdown-toggle{
            display: block;
            width: 100%;
            height: calc(2.9rem + 2px) !important;
            padding: 0.4375rem 1rem;
            font-size: 0.8125rem;
            font-weight: 400;
            line-height: 1.25rem;
            color: #3c4d62;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c1c1c1;
            border-radius: 4px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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
<?php 
  $categories = json_decode(Auth::user()->category_id);
  $array = array_intersect($categories,Acelle\Jobs\HelperJob::categories_select());
  $selectcat = array_values($array)[0];
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
                                                <h4 class="nk-block-title">Business Information</h4>
                                                <div class="nk-block-des">
                                                    <p>Business info, like business name and address, etc.</p>
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
                                                    <span class="data-label">Business Name</span>
                                                    <span class="data-value">{{Auth::user()->business->business_name}}</span>
                                                </div>
                                            </div><!-- data-item -->

                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Business Registration Number</span>
                                                    @if(Auth::user()->business->business_reg)
                                                    <span class="data-value">
                                                        {{Auth::user()->business->business_reg}}
                                                    </span>
                                                    @else
                                                    <span class="data-value text-soft">
                                                        Not add yet
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    @if(Auth::user()->business->business_email)
                                                    <span class="data-value">
                                                        {{Auth::user()->business->business_email}}
                                                    </span>
                                                    @else
                                                    <span class="data-value text-soft">
                                                        Not add yet
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Business Categories</span>
                                                    <span class="data-value">
                                                         @foreach(json_decode(Auth::user()->category_id) as $cat)
                                                            <span class="data-value text-soft">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>,
                                                         @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Business Phone Number</span>
                                                    @if(Auth::user()->business->business_phone)
                                                    <span class="data-value">
                                                        {{Auth::user()->business->business_phone}}
                                                    </span>
                                                    @else
                                                    <span class="data-value text-soft">
                                                        Not add yet
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Business Website</span>
                                                    @if(Auth::user()->business->business_website)
                                                    <span class="data-value">
                                                        {{Auth::user()->business->business_website}}
                                                    </span>
                                                    @else
                                                    <span class="data-value text-soft">
                                                        Not add yet
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Country</span>
                                                    <span class="data-value ">{{Acelle\Jobs\HelperJob::countryname(Auth::user()->country)->name}}</span>
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">State</span>
                                                    <span class="data-value ">{{Acelle\Jobs\HelperJob::statename(Auth::user()->state)->name}}</span>
                                                </div>
                                            </div>
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
                                                   @if(Auth::user()->address)
                                                    <span class="data-value">
                                                        {{Auth::user()->address}}
                                                    </span>
                                                    @else
                                                    <span class="data-value text-soft">
                                                        Not add yet
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(Auth::user()->type_value)
                                            <div class="data-item">
                                                <div class="data-col">
                                                  <span class="data-label">Radius</span>
                                                    <span class="data-value">
                                                        {{Auth::user()->type_value}} KM
                                                    </span>
                                                </div>
                                            </div>
                                             @endif
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Zipcode</span>
                                                        @if(Auth::user()->zipcode)
                                                        <span class="data-value">
                                                            {{Auth::user()->zipcode}}
                                                        </span>
                                                        @else
                                                        <span class="data-value text-soft">
                                                            Not add yet
                                                        </span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->

                                        </div><!-- data-list -->

                                    </div><!-- .nk-block -->
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg side-class"
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
                                                                    <input type="file" accept="image/*" name="image" id="uploadImg" onchange="uploadImg(this)"
                                                                           class="d-none">
                                                                    <label for="uploadImg" class="labelcls"><em class="icon ni ni-camera-fill cameraicon"></em><span>Change Photo</span></label>

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
                                                    <a href="{{url('service-provider/location-setting')}}">
                                                        <em class="icon ni ni-location"></em>
                                                        <span>Service Location Settings</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="active" href="{{url('service-provider/business-setting')}}">
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
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title">Update Business Info</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Business</a>
                        </li>
                        <!--  <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                        </li> -->
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <form action="{{ url('service-provider/business-update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Business Name</label>
                                            <input type="text" class="form-control" id="full-name"
                                                   value="{{Auth::user()->business->business_name}}" name="business_name"
                                                   placeholder="Enter business name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Business Registration Number</label>
                                            <input type="text" class="form-control" id="display-name"
                                                   value="{{Auth::user()->business->business_reg}}" name="business_reg"
                                                   placeholder="Enter business registration number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="personal-email">Business Email</label>
                                            <input type="email" class="form-control" id="personal-email"
                                                   value="{{Auth::user()->business->business_email}}" name="business_email"  placeholder="Enter business email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Business Phone</label>
                                            <input type="text" class="form-control" id="phone-no"
                                                   value="{{Auth::user()->business->business_phone}}" name="business_phone"
                                                   placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Business Category</label>
                                            <select class="form-control" name="category_id[]" required onchange="subCategory(this)">
                                             <option value="" disabled>Select Category</option>
                                             @foreach(Acelle\Jobs\HelperJob::categories() as $category)
                                             <option value="{{$category->id}}" {{$selectcat == $category->id ? 'selected': ''}}>{{$category->category_name}}</option>
                                             @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="subcat">

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="birth-day">Business Website</label>
                                            <input type="text" class="form-control" value="{{Auth::user()->business->business_website}}"
                                                   name="business_website" placeholder="Enter business website">
                                        </div>
                                    </div>

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
<script src="{{ asset('frontend-assets/js/bootstrap-multiselect.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var obj = {
                value : '{{$selectcat}}'
            }
           subCategory(obj);
        });
      $(document).on('click','.custom-select',function(){
           $('.dropdown-menu').toggle();
      })
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
         function subCategory(e){
         
            console.log(e.value);
         $.ajax({url: "{{url('users/subcategory_select/')}}/"+e.value, success: function(result){
         $('#subcat').html(result);
            $('#example-getting-started').multiselect({
              templates: {
                button: '<button type="button" class="multiselect dropdown-toggle btn btn-lg" data-bs-toggle="dropdown" aria-expanded="false"><span class="multiselect-selected-text"></span></button>',
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
    </script>
@endsection