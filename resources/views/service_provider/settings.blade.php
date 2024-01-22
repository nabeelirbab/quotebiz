<?php
    $data = new stdClass();
    $data->title = Auth::user()->first_name . ' ' . Auth::user()->last_name;
    $data->image = Auth::user()->user_img;
    $job_design = Acelle\Jobs\HelperJob::form_design(); 
    $sitename = \Acelle\Model\Setting::get("site_name");
  $sitetitle = \Acelle\Model\Setting::get("site_title");
  $sitetagline = \Acelle\Model\Setting::get("site_tagline");
  $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country);
  $job_design = Acelle\Jobs\HelperJob::form_design(); 
?>
@extends('service_provider.layout.app')
@section('title', 'Profile')
@section('styling')
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/bootstrap-multiselect.min.css') }}">
<style type="text/css">
.gallery-img {
    border-radius: 10px; /* Add border radius */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Add shadow */
    transition: transform 0.2s ease-in-out;
}

.gallery-img:hover {
    transform: scale(1.05);
}

.pac-container {
    z-index: 1060 !important;
}
.select2-selection__rendered {
  line-height: 35px !important;
  color: #52648482 !important;
  font-size: 1.1rem;
}
.select2-container .select2-selection--single {
  height: 50px !important;
  border-radius: 6px;
  border: 1px solid #c1c1c1;
}
.select2-selection__arrow {
  height: 50px !important;
}
.form-group {
  position: relative;
  margin-bottom: 0.5rem;
}
.floatright {
 float: right;
}
h4 {
    font-size: 18px;
}

.select2-container--default.select2-container--open .select2-selection--single {
  border-color: {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}} !important;
}
.select2-container--default .select2-selection--single:focus {
  box-shadow: none;
  border-radius: 6px;
  border: 1px solid {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
}
.form-control:focus {
  box-shadow: none;
  border-radius: 6px;
  border: 1px solid {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
}
.form-control-placeholder {
  font-weight: 500;
  color: #364a63;
  margin-bottom: 8px;
}
.form-control:focus + .form-control-placeholder,
.form-control:valid + .form-control-placeholder {
  font-size: 60%;
  transform: translate3d(0, -75%, 0);
  border-radius: 6px;
  opacity: 1;
  top: 12px;
}

.col-md-4{
    flex: 0 0 30.333333%;
    max-width: 30.333333%;
}
#seeMoreLink {
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: 5px;
    color: {{ ($job_design) ? $job_design->button_color:'#6200EA'}} !important;
}
h2{
    font-size: 24px;
}
@media screen and (max-width: 667px) {
.col-md-4{
    flex: 0 0 100%;
    max-width: 100%;
}
}
</style>
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
      .btn-group .dropdown-toggle {
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
                                     <div class="container mt-5 mb-5">
                                        <div class="row">
                                            
                                            <div class="col-md-12 ml-md-auto">
                                                <h2 class="ml-0">About {{Auth::user()->first_name}} </h2>
                                                <div class="row mt-5 mb-4 ">
                                                    <div class="col-md-12 d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/category.png') }}" class="mr-4">
                                                        </div>
                                                        <div>
                                                           <h4 class="m-0">Category</h4>
                                                          <p class="card-text text-center">
                                                              @foreach(json_decode(Auth::user()->category_id) as $key => $cat)
                                                              @if(\Acelle\Jobs\HelperJob::categoryDetail($cat)->cat_parent_id == 0)
                                                                <span class="data-value">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                                                                @if ($key < count(json_decode(Auth::user()->category_id)) - 1)
                                                                     ,
                                                                @endif
                                                                @endif
                                                            @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12 d-flex mb-4">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/location.png') }}" class="mr-4">
                                                        </div>
                                                        <div>
                                                           <h4 class="m-0">Service Area</h4>
                                                          <p class="">
                                                            @if(Auth::user()->country)
                                                             {{Acelle\Jobs\HelperJob::countryname(Auth::user()->country)->name}}
                                                             @elseif(Auth::user()->state)
                                                              {{Acelle\Jobs\HelperJob::statename(Auth::user()->state)->name}}
                                                             @else
                                                             {{Acelle\Jobs\HelperJob::cityname(Auth::user()->city)->name}}
                                                             
                                                             @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->experience)
                                                <div class="row mb-5 pb-5 border-bottom">
                                                    <div class="col-md-12 d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/medal.png') }}" class="mr-4">
                                                        </div>
                                                        <div>
                                                         <h4 class="m-0">Years in Business</h4>
                                                         {{ Auth::user()->experience }}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                              
                                                @if (Auth::user()->biography)
                                                <h2 class="mt-3 mb-4">Biography</h2>
                                                <div class="row mb-5 border-bottom">
                                                    <div class="col-md-12 mb-5">
                                                        <p id="accommodationDescription" class="mb-1">
                                                            {!! Auth::user()->biography !!}
                                                        </p>
                                                    </div>
                                                </div>
                                                @else
                                                <h2 class="mt-3 mb-4">Biography</h2>
                                                <div class="row mb-5 border-bottom">
                                                    <div class="col-md-12 mb-5">
                                                        <p class="ml-1" style="font-size: 16px;text-decoration-line: underline; cursor: pointer;" id="bio" class="mb-1">
                                                           Add bio
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(count(Auth::user()->gallery) > 0)
                                                <h2 class="mb-5">Gallery</h2>
                                                 <div class="row border-bottom mb-5 pb-3">
                                                  @foreach(Auth::user()->gallery as  $key => $gallery)
                                                    <div class="col-md-3 mb-4 text-center">
                                                        <a href="#" data-toggle="modal" data-target="#imageModal" data-slide-to="{{ $key }}">
                                                            <img src="{{ asset('frontend-assets/images/'.$gallery->image)}}" alt="Image {{ $key + 1 }}" class="img-fluid gallery-img" >
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                    
                                                </div>
                                                @endif
                                                <h2 class="mb-4 ml-0">Preferred music genres</h2>
                                                <div class="row mr-1 mb-5">
                                                    <div class="col-md-6">
                                                        <div class="d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
                                                        </div>
                                                            <p class="font-weight-bold">Retro</p>
                                                        </div>
                                                        <div class="d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
                                                        </div>
                                                            <p class="font-weight-bold">Retro</p>
                                                        </div>
                                                        <div class="d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
                                                        </div>
                                                            <p class="font-weight-bold">Retro</p>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
                                                        </div>
                                                            <p class="font-weight-bold">Retro</p>
                                                        </div>
                                                        <div class="d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
                                                        </div>
                                                            <p class="font-weight-bold">Retro</p>
                                                        </div>
                                                        <div class="d-flex">
                                                        <div class="mr-5 mt-1" style="width: 25px">
                                                            <img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
                                                        </div>
                                                            <p class="font-weight-bold">Retro</p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                    <!-- Modal -->
                                                <div class="modal fade" id="biographyModal" tabindex="-1" role="dialog" aria-labelledby="biographyModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="biographyModalLabel"> Biography</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea rows="24" style="border: none; background:none; color:  #222222; width: 100%" disabled>{!! Auth::user()->biography !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="imageModalLabel">Gallery Slider</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="imageSlider" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach(Auth::user()->gallery as $key => $gallery)
                                                                    <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                                                        <img src="{{ asset('frontend-assets/images/'.$gallery->image)}}" alt="Image {{ $key + 1 }}" class="d-block w-100">
                                                                    </div>
                                                                    @endforeach
                                                                    <!-- Add more carousel items as needed -->
                                                                </div>
                                                                <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                      
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

   @php
        $charLimit = 400;
    @endphp

    @if (strlen(Auth::user()->biography) > $charLimit)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var biographyElement = document.getElementById('accommodationDescription');
                var fullBiography = {!! json_encode(Auth::user()->biography) !!}; // Ensure proper escaping for JavaScript

                if (biographyElement.textContent.length > {{ $charLimit }}) {
                    var shortText = biographyElement.textContent.substring(0, {{ $charLimit }}) + '...';

                    biographyElement.textContent = shortText;

                    var seeMoreLink = document.createElement('a');
                    seeMoreLink.id = 'seeMoreLink';
                    seeMoreLink.href = '#';
                    seeMoreLink.textContent = 'See More >';

                    seeMoreLink.addEventListener('click', function (e) {
                        e.preventDefault();
                        $('#biographyModal').modal('show');
                    });

                    biographyElement.insertAdjacentElement('afterend', seeMoreLink); // Insert the link after the paragraph
                }
            });
        </script>
    @endif
        <script type="text/javascript">
            $(document).ready(function() {
            $('#bio').on('click', function() {
                $('#profile-edit').modal('show');
                // Activate the "Biography" tab
                $('a[href="#biography"]').tab('show');
            });
        });
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
                        $('.uploadimg').html('<img class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;" src="' + data + '" alt="">');
                    }
                });
            }

        }
    </script>
@endsection