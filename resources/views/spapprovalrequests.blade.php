
@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
  <style type="text/css">
    .col-sm-12, .col-sm-10, .col-sm-6, .col-sm-5, .col-sm-1 {
        margin: 0px !important;
    }
    .removeQuestion{
        display: contents;
    }
     .edit-mode input {
            display: inline-block;
        }

        .edit-mode  {
            display: none !important;
        }
        .user-info .icon {
            display: none;
        }

        /* Show the eye icon when the user-card is hovered */
        .user-card:hover .user-info .icon {
            display: inline-block;
        }
  </style>
@endsection
@section('content')

<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid mt-4">
<div class="nk-content-inner">
<div class="nk-content-body">
<?php  $job_design = Acelle\Jobs\HelperJob::form_design();  ?>
<h3 id="titleLabel" class="nk-block-title page-title">{{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }} Approval Requests</h3>
<div class="nk-block">
<div class="card card-bordered card-stretch">
<div class="card-inner-group">
<div class="card-inner position-relative card-tools-toggle">
    <div class="card-title-group">
        <div class="card-tools">
 
        </div><!-- .card-tools -->

        <div class="card-tools mr-n1">
            <ul class="btn-toolbar gx-1">
                <li>
                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                </li><!-- li -->
                <li class="btn-toolbar-sep"></li><!-- li -->
                
            </ul><!-- .btn-toolbar -->
        </div><!-- .card-tools -->
    </div><!-- .card-title-group -->
    <div class="card-search search-wrap" data-search="search">
        <div class="card-body">
            <div class="search-content">
                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by id, user or email" id="search">
                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
            </div>
        </div>
    </div><!-- .card-search -->
</div><!-- .card-inner -->
<div class="card-inner p-0" style="border-bottom: none;width: 100%;
    overflow: auto;
    white-space: nowrap;min-height: 200px" id="result">
   <form id="bulkUserUpdateForm" action="{{ url('admin/bulk_update_user_status') }}" method="POST">
    @csrf
       <div id="bulkActionContainer" class="mt-3 mb-3 ml-3 m d-none" >
        <select name="status" class="form-control w-20 d-inline" style="height: calc(2.2rem + 2px) !important">
            <option value="">Select Status</option>
            <option value="verified,1">Approve Account</option>
            <option value="active,1">Active Account</option>
            <option value="active,0">Suspend Account</option>
            <option value="active,3">Delete Account</option>
        </select>
            <button type="submit" class="btn btn-primary">Update Selected</button>
        </div>
    <div class="nk-tb-list nk-tb-ulist">
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
            <div class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" id="selectAll">
                    <label class="custom-control-label" for="selectAll"></label>
                </div>
            </div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">#</span></div>
            <div class="nk-tb-col"><span class="sub-text">User</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Business Name</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Category</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">City</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>
           
        </div><!-- .nk-tb-item -->
        @if($users->count() > 0)
       
        @foreach($users as $key => $user)
        <div class="nk-tb-item">
            <div class="nk-tb-col nk-tb-col-check">
            <div class="custom-control custom-control-sm custom-checkbox notext checked">
                <input type="checkbox" class="custom-control-input user-checkbox" name="user_ids[]" value="{{$user->id}}" id="uid{{$user->id}}">
                    <label class="custom-control-label" for="uid{{$user->id}}"></label>
            </div>
        </div>
             <div class="nk-tb-col  tb-col-md">
                <span >{{$key + 1}}</span>
            </div>
            <div class="nk-tb-col">
                    <div class="user-card">
                <a href="{{ url('admin/profile_detail/'.$user->id) }}" target="_blank">

                        <div class="user-avatar bg-primary mr-3">
                            @if($user->user_img)
                            <img src="{{asset('frontend-assets/images/users/'.$user->user_img)}}" alt="Profile Image" style="position: relative;" class="rounded-circle">
                            @if($user->is_featured == '1')
                            <em class="icon ni ni-star-fill" style="position: absolute;right: -4px;top: -1px;color: black;background: white; border-radius: 13px;"></em>
                            @endif
                            @else
                            <span style="position: relative;">{{mb_substr($user->first_name, 0, 1)}}{{mb_substr($user->last_name, 0, 1)}}</span>
                            @if($user->is_featured == '1')
                            <em class="icon ni ni-star-fill" style="position: absolute;right: -4px;top: -1px;color: black;background: white; border-radius: 13px;"></em>
                            @endif
                            @endif
                        </div>
                    </a>
                
                       <a href="{{ url('admin/profile_detail/'.$user->id) }}" target="_blank">
                        <div class="user-info">
                          
                            <span class="tb-lead">{{ \Acelle\Jobs\HelperJob::getprefix(json_decode($user->category_id)) ?? '' }} {{$user->first_name}} {{$user->last_name}}
                                <em class="icon ni ni-eye float-right"></em>
                            </span>
                            <span>{{$user->email}}</span>
                        </div>
                         </a>
                    </div>
               
            </div>

            <!--<div class="nk-tb-col tb-col-lg">
                <span >{{ $user->business ? $user->business->business_phone : $user->mobileno}}</span>
            </div>-->
            <div class="nk-tb-col tb-col-lg">
                @if($user->business)
                <span >{{$user->business->business_name}}</span>
                @endif
            </div>
            <div class="nk-tb-col tb-col-md" style="width: 15%;">
                @foreach(array_slice(json_decode($user->category_id), 0, 3) as $cat)
				    <span class="">{{ \Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name }}</span>
				@endforeach
            </div>
  
             <div class="nk-tb-col tb-col-lg">
              @if(Acelle\Jobs\HelperJob::cityname($user->city)) <span >{{Acelle\Jobs\HelperJob::cityname($user->city)->name}}</span> 
               @else
               {{$user->city}}
               @endif
            </div> 
            <!--<div class="nk-tb-col tb-col-lg">
                <span>{{\Carbon\Carbon::parse($user->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>-->
            <div class="nk-tb-col tb-col-lg">
                @if($user->activated == 0)
                <span class="tb-status text-danger">Inactive</span>
                @else
                <span class="tb-status text-success">Active</span>
                @endif
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="gx-1">
                    <li>
                        <div class="drodown">
                            <a href="#" class="dropdown-toggle btn btn-icon " data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="{{ url('sp-profile/'.$user->id) }}" target="_blank"><em class="icon ni ni-eye"></em><span>Public View Profile</span></a></li>
                            
                                       <li><a href="{{ url('admin/account_verified/'.$user->id.'?status=1') }}" onclick="return confirm('Are you sure you want to approve this account');" title="Approve Account"><em class="icon ni ni-check-circle-fill"></em></em><span>Approve Account</span></a></li>
   
                                       @if($user->activated == '1')
                                        <li><a href="{{ url('admin/account_status/'.$user->id.'?status=0') }}" onclick="return confirm('Are you sure you want to suspend this account?');" title="Suspend Account"><em class="icon ni ni-na"></em><span>Suspend Account</span></a></li>

                                        @else
                                        <li><a href="{{ url('admin/account_status/'.$user->id.'?status=1') }}" onclick="return confirm('Are you sure you want to active this account?');" title="Active Account"><em class="icon ni ni-shield-check"></em><span>Active Account</span></a></li>
                                          <li><a href="{{ url('admin/account_status/'.$user->id.'?status=3') }}" onclick="return confirm('Are you sure you want to delete this account?');" title="Suspend Account"><em class="icon ni ni-trash"></em><span>Delete Account</span></a></li>
                                        @endif                         
                                     </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- .nk-tb-item -->
        @endforeach
         </form>
        @endif
       
    </div><!-- .nk-tb-list -->
    <div class="card-inner">
    {{$users}}
</div><!-- .card-inner -->
</div><!-- .card-inner -->
<div class="modal fade zoom" tabindex="-1" id="modalEdit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send invite to service providers</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    <div class="toast fade hide" data-autohide="false">
                    <div class="toast-header">
                      <strong class="mr-auto text-primary">Alert</strong>
                      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                    </div>
                    <div class="toast-body">
                      Invitation sent successfully
                    </div>
                  </div>
                    </div>
                    <div class="modal-body">
                       <div class="preview-block">
                        <form action="{{ url('admin/sendInvitation') }}" method="post" id="formInvite">
                          {{ csrf_field()}}
                        <div class="row d-flex justify-content-center gy-4">
                            <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Free Credits</label>
                                <div class="form-control-wrap">
                                 <input type="number" class="form-control" name="credits" value="50" placeholder="Enter Amount" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  d-flex justify-content-center gy-4 mb-3" id="addsection">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Name:</label>
                                <div class="form-control-wrap">
                                 <input type="text" class="form-control" name="name[]" placeholder="Enter Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Email:</label>
                                <div class="form-control-wrap">
                                 <input type="email" class="form-control" name="email[]" placeholder="Enter Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <span title="Add New Section" id="addemail" class="addQuestions material-icons-round add-icon xtooltip tooltipstered lh-1 float-end" style="cursor: pointer;position: absolute;top: 45px;">add_circle</span>
                        </div>
                        </div>
                     <div class="row mt-5">
                        <div class="col-sm-10 text-center mb-5">
                            <button class="btn btn-success btn-lg" type="submit" id="sendemail" type="button">Send</button>
                              <button class="btn btn-primary btn-lg" style="display: none" id="loaderbtn" type="button" disabled>
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          <span class="sr-only">Loading...</span>
                        </button>
                        </div>
                      </div>

                        </form>
                    </div>
                        </div>
                    </div>
                    </div>
                  
                </div>

                <div class="modal fade" id="addcredits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Credits</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ url('admin/add-credits') }}" id="formId" method="post">
                            {!! csrf_field() !!}
                         <input type="hidden" id="userId" name="user_id" form="formId">
                          <div class="form-group">
                            <label for="inputAddress">Credits</label>
                            <input type="number" class="form-control" name="credits" form="formId" id="inputAddress" placeholder="Enter Credits" required>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="formId" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>


</div>
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
<div class="modal fade" id="exampleModal23" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content card shadow mb-4">
      <div class="modal-body card-header py-3" style="background: white">
        <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Bulk Invite</h6>
        </div>
        <form method="POST" action="{{ url('admin/import-sp') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                
                <div class="form-group row">
                    
                    <div class="col-md-12 mb-3 mt-3">
                        <p>Here you can use a CSV file to invite a large list of your service providers or contacts. This will send them an invite email with free credits to join your quotebiz platform.</p>
                        <p>Please Upload CSV in Given Format <a href="{{ asset('files/import_example.csv') }}" target="_blank">Sample CSV Format</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input 
                            type="file" 
                            class="form-control form-control-user @error('file') is-invalid @enderror" 
                            id="exampleFile"
                            name="file" 
                            value="{{ old('file') }}" required>

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
         
                </div>
                 <div class="row d-flex justify-content-center gy-4">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label class="form-label" for="default-01">Free Credits</label>
                        <div class="form-control-wrap">
                         <input type="number" class="form-control" name="credits" value="50" placeholder="Enter Amount" required>
                        </div>
                    </div>
                   </div>
                </div>
            </div>

            <div class="p-3">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Send Invitation</button>
                <a class="btn btn-default float-right mr-3 mb-3" data-dismiss="modal">Cancel</a>
            </div>
        </form>
    </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content card shadow mb-4">
      <div class="modal-body card-header py-3" style="background: white">
        <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Business Info</h6>
        </div>
        <form method="POST" action="{{ url('admin/update_bus_info') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                
                <div class="form-group row">
                    
                    <div class="col-md-12 mb-3 mt-3">
                        <p><b>If you wish to use your quotebiz as a business dirctory then you can allow your {{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }} to show their business information.</b></p>
                    </div>
                    {{-- File Input --}}
                 
         
                </div>
                  <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-12">
                      <input type="hidden" name="id" @if($job_design) value="{{$job_design->id}}" @endif>
                      <div class="row">
                  
                        <div class="col-md-6">
                          
                        <div class="form-group">
                          <label class="form-label" for="default-01">Business Name Visibility</label>
                          <div class="form-control-wrap">
                           <label>
                            <input type="radio" name="business_name" autocomplete="off" value="yes" {{$job_design && $job_design->business_name == 'yes' ? 'checked':''}} > Show
                          </label>
                          <label >
                            <input type="radio" name="business_name" {{$job_design && $job_design->business_name == 'no' ? 'checked':''}} id="option2" value="no" autocomplete="off"> Hide
                          </label>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="default-01">Business Website Visibility</label>
                          <div class="form-control-wrap">
                           <label>
                            <input type="radio" name="business_website" autocomplete="off" value="yes" {{$job_design && $job_design->business_website == 'yes' ? 'checked':''}} > Show  </label>
                          <label >
                            <input type="radio" name="business_website" {{$job_design && $job_design->business_website == 'no' ? 'checked':''}} id="option2" value="no" autocomplete="off"> Hide
                          </label>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label" for="default-01">Business Number Visibility</label>
                        <div class="form-control-wrap">
                         <label>
                          <input type="radio" name="business_number" id="option1" autocomplete="off" value="yes" {{$job_design && $job_design->business_number == 'yes' ? 'checked':''}} > Show
                        </label>
                         <label>
                          <input type="radio" name="business_number" id="option2" autocomplete="off" value="no" {{$job_design && $job_design->business_number == 'no' ? 'checked':''}} > Hide
                        </label>
                        </div>
                        </div>

                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label" for="default-01">Business Email Visibility</label>
                        <div class="form-control-wrap">
                         <label>
                          <input type="radio" name="business_email" id="option1" autocomplete="off" value="yes" {{$job_design && $job_design->business_email == 'yes' ? 'checked':''}} > Show
                        </label>
                         <label>
                          <input type="radio" name="business_email" id="option2" autocomplete="off" value="no" {{$job_design && $job_design->business_email == 'no' ? 'checked':''}} > Hide
                        </label>
                        </div>
                        </div>

                        </div>
                     <div class="col-md-12">
                          
                        <div class="form-group">
                          <label class="form-label" for="default-01">Select 'DoFollow' to share ranking power with linked site, 'NoFollow' to withhold it</label>
                          <div class="form-control-wrap">
                           <label>
                            <input type="radio" name="website_link_setting" autocomplete="off" value="DoFollow" {{$job_design && $job_design->website_link_setting == 'DoFollow' ? 'checked':''}} > DoFollow
                          </label>
                          <label >
                            <input type="radio" name="website_link_setting" {{$job_design && $job_design->website_link_setting == 'NoFollow' ? 'checked':''}} id="option2" value="NoFollow" autocomplete="off"> NoFollow
                          </label>
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                </div>
              
            </div>

            <div class="p-3">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Update</button>
                <a class="btn btn-default float-right mr-3 mb-3" data-dismiss="modal">Cancel</a>
            </div>
        </form>
    </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!-- content @e -->
@endsection
@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/jquery.email.multiple.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let selectAllCheckbox = document.getElementById("selectAll");
    let userCheckboxes = document.querySelectorAll(".user-checkbox");
    let bulkActionContainer = document.getElementById("bulkActionContainer");

    if (!selectAllCheckbox || !bulkActionContainer) {
        console.error("Error: Required elements not found!");
        return;
    }

    function toggleBulkActions() {
        let selectedCount = document.querySelectorAll(".user-checkbox:checked").length;
        console.log("Selected Count:", selectedCount); // Debugging

        if (selectedCount > 0) {
            bulkActionContainer.classList.remove("d-none");
        } else {
            bulkActionContainer.classList.add("d-none");
        }
    }

    // "Select All" checkbox functionality
    selectAllCheckbox.addEventListener("change", function () {
        let isChecked = this.checked;
        userCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        toggleBulkActions(); // Call function after selection
    });

    // Individual checkboxes should toggle the bulk action dropdown
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", toggleBulkActions);
    });

    // Ensure "Select All" updates when all individual checkboxes are checked
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            let totalCheckboxes = userCheckboxes.length;
            let checkedCheckboxes = document.querySelectorAll(".user-checkbox:checked").length;
            selectAllCheckbox.checked = (totalCheckboxes === checkedCheckboxes);
        });
    });
});
    function updateSr(id){
        var title = document.getElementById('srname'+id).value;
         var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('admin/update-user-title')}}",
                type: "post",
                data: {title: title, _token: _token, id: id},
                success: function (response) {
                console.log(response);
                  $('#successAlert').show();

                // Automatically hide the alert after 5 seconds
                setTimeout(function() {
                    $('#successAlert').fadeOut('slow');
                }, 5000);
            // $('#result').html(response);
                    },
                    error: function (xhr) {

                    }

            });
    }
      function enableEditMode() {
            document.querySelector('.edit-mode').style.setProperty('display', 'flex', 'important');
            document.querySelector('.view-mode').style.setProperty('display', 'none', 'important');

        }

        function updateTitle() {
            var newTitle = document.getElementById('titleInput').value;
            document.getElementById('titleLabel').innerText = newTitle;

            // Switch back to view mode after updating
            document.querySelector('.edit-mode').style.display = 'none';
            document.querySelector('.view-mode').style.display = 'flex';
            
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: "{{ url('admin/text-update')}}",
            type: "post",
            data: {text_value: newTitle, _token: _token},
            success: function (response) {
            console.log(response);
            // $('#result').html(response);
            },
            error: function (xhr) {

            }

            });
        }
    $(document).ready(function($){
   $("#search").on("keyup", function() {
        
        var value = $(this).val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        url: "{{ url('admin/user-search-approve')}}",
        type: "post",
        data: {search: value,user_type: 'service_provider', _token: _token},
        success: function (response) {
        console.log(response);
        $('#result').html(response);
        },
        error: function (xhr) {

        }

        });
     });
 
        $('#addemail').click(function(){
            var html ='<div class="removeQuestion"><div class="col-sm-5">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Name:</label>'+
                            '<div class="form-control-wrap">'+
                            ' <input type="text" class="form-control" name="name[]" placeholder="Enter Name">'+
                            '</div>'+
                       ' </div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                       ' <div class="form-group">'+
                            '<label class="form-label" for="default-01">Email:</label>'+
                            '<div class="form-control-wrap">'+
                            ' <input type="email" class="form-control" name="email[]" placeholder="Enter Email">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-1"><span title="Remove Section" class="removeSection material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end" style="cursor: pointer;position: absolute;top: 35px;">remove_circle</span>'+
                    '</div></div>';
          $('#addsection').append(html);
        });

        $(document).on('click','.removeSection',function(e){
          $(e.target).closest('.removeQuestion').remove();
         });
            $("#formInvite").submit(function(e){
               e.preventDefault();
               $('#sendemail').hide()
               $('#loaderbtn').show();
                  $.ajax({
                    url: "{{ url('admin/sendInvitation') }}",
                    type: 'post',
                    data: $('#formInvite').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('.toast').toast('show');
                        $('.all-mail').empty();
                        $('#loaderbtn').hide();
                        $("input[name=email]").val('');
                        $('#sendemail').show();
                    },
                    error: function(data){
                        //error
                    }
                });
            });
        });

           function addCredits(id){
            $('#userId').val(id);
            $('#addcredits').modal('show');
           }
    </script>
@endsection
