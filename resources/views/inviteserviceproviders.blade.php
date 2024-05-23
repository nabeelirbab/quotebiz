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
<h3 class="nk-block-title page-title">Invited Service Providers</h3>
<div class="nk-block-des text-soft">
    <p>You have total {{count($users)}} users.</p>
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">

</div><!-- .nk-block-head-content -->
<button class="btn btn-success float-right" data-toggle="modal" data-target="#modalEdit">Invite</button>
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
            <div class="nk-tb-col tb-col-mb"><span class="sub-text">#ID</span></div>
            <div class="nk-tb-col"><span class="sub-text">User</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Invited On</span></div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">Actions</span></div>
           
        </div><!-- .nk-tb-item -->
        @foreach($users as $user)
        <div class="nk-tb-item">
             <div class="nk-tb-col tb-col-mb">
                <span >{{$user->id}}</span>
            </div>
            <div class="nk-tb-col">
                <a href="">
                    <div class="user-card">
                        <div class="user-avatar bg-primary">
                            <span>{{mb_substr($user->name, 0, 1)}}</span>
                        </div>
                        <div class="user-info">
                            <span class="tb-lead">{{$user->name}}<span class="dot dot-success d-md-none ml-1"></span></span>
                            <span>{{$user->email}}</span>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="nk-tb-col tb-col-lg">
                <span>{{\Carbon\Carbon::parse($user->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                @if($user->status == 'pending')
                <span class="tb-status text-danger">Pending</span>
                @else
                <span class="tb-status text-success">Active</span>
                @endif
            </div>
           <div class="nk-tb-col tb-col-md">
                @if($user->status == 'pending')
                <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#resendInvite{{$user->id}}">Resend Invitation</button>
                @else
                @endif
            </div>
        </div><!-- .nk-tb-item -->
        <!-- Resend Email -->
         <div class="modal fade zoom" tabindex="-1" id="resendInvite{{$user->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Resend Invitation</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    <div class="toast fade hide" id="toast{{$user->id}}" data-autohide="false">
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
                        <form class="resendeInvite" method="post">
                          {{ csrf_field()}}
                          <input type="hidden" name="id" value="{{ $user->id }}">
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
                    <div class="row  d-flex justify-content-center gy-4 mb-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Name:</label>
                                <div class="form-control-wrap">
                                 <input type="text" class="form-control" readonly placeholder="Enter Name" value="{{$user->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Email:</label>
                                <div class="form-control-wrap">
                                 <input type="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email" readonly required>
                                </div>
                            </div>
                        </div>
                        </div>
                     <div class="row mt-5">
                        <div class="col-sm-12 text-center mb-5">
                            <button class="btn btn-success btn-lg" type="submit" id="resendemail{{$user->id}}" type="button">Send</button>
                              <button class="btn btn-primary btn-lg" style="display: none" id="reloaderbtn{{$user->id}}" type="button" disabled>
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
                      Invitation send successfully
                    </div>
                  </div>
                    </div>
                    <div class="modal-body">
                       <div class="preview-block">
                        <form action="{{ url('admin/sendInvitation') }}" method="post" class="sendform">
                          {{ csrf_field()}}
                        <div class="row d-flex justify-content-center gy-4">
                            <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-01">Credits</label>
                                <div class="form-control-wrap">
                                 <input type="number" class="form-control" name="credits" value="50" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  d-flex justify-content-center gy-4 mb-1" id="addsection">
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
                        <div class="col-sm-12 text-center mb-5">
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
            var html ='<div class="removeQuestion mb-3"><div class="col-sm-5">'+
                        '<div class="form-group ">'+
                            '<label class="form-label" for="default-01">Name:</label>'+
                            '<div class="form-control-wrap">'+
                            ' <input type="text" class="form-control" name="name[]" placeholder="Enter Name">'+
                            '</div>'+
                       ' </div>'+
                    '</div>'+
                    '<div class="col-sm-6">'+
                       ' <div class="form-group ">'+
                            '<label class="form-label" for="default-01">Email:</label>'+
                            '<div class="form-control-wrap">'+
                            ' <input type="email" class="form-control" name="email[]" placeholder="Enter Email">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-1"><span title="Remove Section" class="removeSection material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end" style="cursor: pointer;position: absolute;top: 58px;">remove_circle</span>'+
                    '</div></div>';
          $('#addsection').append(html);
        });

        $(document).on('click','.removeSection',function(e){
          $(e.target).closest('.removeQuestion').remove();
 
         });

            $(".sendform").submit(function(e){
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

            $(".resendeInvite").submit(function(e){
                console.log($(this).serialize());
               e.preventDefault();
             var id = unserialize($(this).serialize()).id;
               $('#resendemail'+id).hide()
               $('#reloaderbtn'+id).show();
                  $.ajax({
                    url: "{{ url('admin/resendInvitation') }}",
                    type: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#toast'+id).toast('show');
                        $('#reloaderbtn'+id).hide();
                        $('#resendemail'+id).show();
                    },
                    error: function(data){
                        //error
                    }
                });
            });

            function unserialize(data) {
                data = data.split('&');
                var response = {};
                for (var k in data){
                    var newData = data[k].split('=');
                    response[newData[0]] = newData[1];
                }
                return response;
            }
           
        });
    </script>
@endsection
