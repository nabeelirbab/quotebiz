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
  </style>
@endsection
@section('content')
<!-- content @s -->
<div class="nk-content ">
<div class="container-fluid mt-4">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Service Providers</h3>
<div class="nk-block-des text-soft">
    <p>You have total  {{count($users)}} users.</p>
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">

</div><!-- .nk-block-head-content -->
<div class="float-right">
<a href="{{url('admin/invitedserviceproviders')}}" class="btn btn-info" >Invited Service Providers</a>
<button class="btn btn-success " data-toggle="modal" data-target="#modalEdit">Invite</button>
</div>

</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
<div class="card card-bordered card-stretch">
<div class="card-inner-group">
<div class="card-inner position-relative card-tools-toggle">
    <div class="card-title-group">
        <div class="card-tools">
     @if(Session::has('success'))
         <div class="alert alert-success  fade show" role="alert">
          {{Session::get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     @endif
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
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
            </div>
        </div>
    </div><!-- .card-search -->
</div><!-- .card-inner -->
<div class="card-inner p-0">
    <div class="nk-tb-list nk-tb-ulist">
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
            <!-- <div class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" id="uid">
                    <label class="custom-control-label" for="uid"></label>
                </div>
            </div> -->
            <div class="nk-tb-col tb-col-mb"><span class="sub-text">#</span></div>
            <div class="nk-tb-col"><span class="sub-text">User</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Mobile No</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Business Name</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Category</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Service Location Setting</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">State</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">City</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Registered On</span></div>
            <div class="nk-tb-col"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>
           
        </div><!-- .nk-tb-item -->
        @foreach($users as $user)
        <div class="nk-tb-item">
             <div class="nk-tb-col  tb-col-mb">
                <span >{{$user->id}}</span>
            </div>
            <div class="nk-tb-col">
                <a href="{{ url('admin/profile_detail/'.$user->id) }}">
                    <div class="user-card">
                        <div class="user-avatar bg-primary">
                            <span>{{mb_substr($user->first_name, 0, 1)}}{{mb_substr($user->last_name, 0, 1)}}</span>
                        </div>
                        <div class="user-info">
                            <span class="tb-lead">{{$user->first_name}} {{$user->last_name}}
                            </span>
                            <span>{{$user->email}}</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="nk-tb-col tb-col-lg">
                <span >{{$user->mobileno}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                @if($user->business)
                <span >{{$user->business->business_name}}</span>
                @endif
            </div>
            <div class="nk-tb-col tb-col-md" style="width: 15%;">
                 @foreach(json_decode($user->category_id) as $cat)
                    <span>{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>,
                 @endforeach
            </div>
            <div class="nk-tb-col tb-col-lg">
                @if($user->type == 'world')
                <span>WorldWide</span>
                @elseif($user->type == 'country')
                <span>CountryWide</span>
                @elseif($user->type == 'state')
                <span>StateWide</span>
                @elseif($user->type == 'local business')
                <span>Local Business</span>
                @else
                <span>City</span>
                @endif

            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{Acelle\Jobs\HelperJob::countryname($user->country)->name}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{Acelle\Jobs\HelperJob::statename($user->state)->name}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                @if($user->city)
                <span>{{Acelle\Jobs\HelperJob::cityname($user->city)->name}}</span>
                @endif
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{\Carbon\Carbon::parse($user->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>
            <div class="nk-tb-col">
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
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="{{ url('admin/profile_detail/'.$user->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                    <li><a href="{{ url('admin/location_setting/'.$user->id) }}"><em class="icon ni ni-location"></em><span>Location Setting</span></a></li>
                                  @if($user->activated == '1')
                                <li><a href="{{ url('admin/account_status/'.$user->id.'?status=0') }}" onclick="return confirm('Are you sure you want to suspend this account?');" title="Suspend Account"><em class="icon ni ni-na"></em><span>Suspend Account</span></a></li>
                                @else
                                <li><a href="{{ url('admin/account_status/'.$user->id.'?status=1') }}" onclick="return confirm('Are you sure you want to active this account?');" title="Active Account"><em class="icon ni ni-shield-check"></em><span>Active Account</span></a></li>
                                @endif                         
                          </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- .nk-tb-item -->
        @endforeach
       
    </div><!-- .nk-tb-list -->
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
                        <form action="{{ url('admin/sendInvitation') }}" method="post">
                          {{ csrf_field()}}
                        <div class="row d-flex justify-content-center gy-4">
                            <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Credits</label>
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
            </div>
        </div>
<div class="card-inner">
    {{$users}}
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
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
    $(document).ready(function($){

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
            $("form").submit(function(e){
               e.preventDefault();
               $('#sendemail').hide()
               $('#loaderbtn').show();
                  $.ajax({
                    url: "{{ url('admin/sendInvitation') }}",
                    type: 'post',
                    data: $('form').serialize(),
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
    </script>
@endsection
