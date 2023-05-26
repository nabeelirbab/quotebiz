@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<style type="text/css">
    .card-inner {
    padding: 1rem;
}
</style>
@endsection

@section('content')
<!-- content @s -->
<div class="nk-content">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Customer Lists</h3>
<div class="nk-block-des text-soft">
    <p>You have total {{count($users)}} users.</p>
</div>
</div><!-- .nk-block-head-content -->
<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
    <div class="toggle-expand-content" data-content="pageMenu">
        <ul class="nk-block-tools g-3">
         
            <li class="nk-block-tools-opt">
                <div class="drodown">
                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><span>Add User</span></a></li>
                            <li><a href="#" data-toggle="modal" data-target="#exampleModal"><span>Import Users</span></a></li>
                            
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
</div>
<!-- .nk-block-head-content -->
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
    </div>
    <!-- .card-title-group -->
    <div class="card-search search-wrap" data-search="search">
        <div class="card-body">
            <div class="search-content">
                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email" id="search">
                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
            </div>
        </div>
    </div><!-- .card-search -->
</div><!-- .card-inner -->
<div class="card-inner p-0" id="result">
    <div class="nk-tb-list nk-tb-ulist" >
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
         
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">#ID</span></div>
            <div class="nk-tb-col"><span class="sub-text">User</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">City</span></div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">Zip Code</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Mobile No</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Registered On</span></div>
            <div class="nk-tb-col"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>

        </div><!-- .nk-tb-item -->
        @foreach($users as $key => $user)
        <div class="nk-tb-item">
       
             <div class="nk-tb-col tb-col-lg">
                <span >{{$key + 1}}</span>
            </div>
            <div class="nk-tb-col">
                <a href="{{ url('admin/customer_detail/'.$user->id) }}">
                    <div class="user-card">
                        <div class="user-avatar bg-primary">
                            <span>{{mb_substr($user->first_name, 0, 1)}}{{mb_substr($user->last_name, 0, 1)}}</span>
                        </div>
                        <div class="user-info">
                            <span class="tb-lead">{{$user->first_name}} {{$user->last_name}}
                                <!-- <span class="dot dot-success d-md-none ml-1"></span> -->
                            </span>
                            <span>{{$user->email}}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="nk-tb-col tb-col-lg">
               @if(Acelle\Jobs\HelperJob::cityname($user->city)) <span >{{Acelle\Jobs\HelperJob::cityname($user->city)->name}}</span> 
               @else
               {{$user->city}}
               @endif
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{$user->zipcode}}</span>
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{$user->mobileno}}</span>
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
                                <li><a href="{{ url('admin/customer_detail/'.$user->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
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
    <div class="card-inner">
    {{$users}}
</div><!-- .card-inner -->
</div><!-- .card-inner -->

</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content card shadow mb-4">
      <div class="modal-body card-header py-3" style="background: white">
        <div class="">
            <h6 class="m-0 font-weight-bold text-primary">Import Users</h6>
        </div>
        <form method="POST" action="{{ url('admin/import-customers') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    
                    <div class="col-md-12 mb-3 mt-3">
                        <p>Please Upload CSV in Given Format <a href="{{ asset('') }}" target="_blank">Sample CSV Format</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input 
                            type="file" 
                            class="form-control form-control-user @error('file') is-invalid @enderror" 
                            id="exampleFile"
                            name="file" 
                            value="{{ old('file') }}">

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="p-3">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Users</button>
                <a class="btn btn-primary float-right mr-3 mb-3" data-dismiss="modal">Cancel</a>
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
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<script type="text/javascript">
    $("#search").on("keyup", function() {
        
      var value = $(this).val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        url: "{{ url('admin/user-search')}}",
        type: "post",
        data: {search: value,user_type: 'client', _token: _token},
        success: function (response) {
        console.log(response);
        $('#result').html(response);
        },
        error: function (xhr) {

        }

        });


     });
</script>
@endsection