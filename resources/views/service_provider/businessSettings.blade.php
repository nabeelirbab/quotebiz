@extends('service_provider.layout.app')
@section('title', 'Profile')
@section('styling')
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap-multiselect.min.css') }}">
    <style type="text/css">
        .nav-tabs .nav-item {
            padding-right: 4.25rem;
        }
        .labelcls {
            display: flex;
            align-items: center;
            padding: 0.3rem 1rem;
            font-size: 12px;
            font-weight: 500;
            color: #526484;
            transition: all .4s;
            line-height: 1.3rem;
            position: relative;
            margin-bottom: 0px !important;
            width: 66%;
            margin-top: -23px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease-in-out;
            border-radius: 29px;
            margin-left: 20px;
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
  if(count($array) > 0){
    $selectcat = array_values($array)[0];
  }else{
    $selectcat = 0;
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
                                                    @if(Acelle\Jobs\HelperJob::cityname(Auth::user()->city) && Auth::user()->city)
                                                    <span class="data-value ">{{Acelle\Jobs\HelperJob::cityname(Auth::user()->city)->name}}</span>
                                                    @else
                                                    <span class="data-value ">{{ Auth::user()->city}}</span>
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
@include('service_provider.includes.profile-update-modal')
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
                        $('.uploadimg').html('<img class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;" src="' + data + '" alt="">');
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