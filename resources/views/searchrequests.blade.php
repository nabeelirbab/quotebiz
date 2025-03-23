
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
