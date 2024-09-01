  <div class="nk-tb-list nk-tb-ulist">
        <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
            <!-- <div class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" id="uid">
                    <label class="custom-control-label" for="uid"></label>
                </div>
            </div> -->
            <div class="nk-tb-col tb-col-md"><span class="sub-text">#</span></div>
            <div class="nk-tb-col"><span class="sub-text">User</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Mobile No</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Business Name</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Category</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Service Location Setting</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">State</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">City</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Registered On</span></div>
            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
            <div class="nk-tb-col"><span class="sub-text">Actions</span></div>
           
        </div><!-- .nk-tb-item -->
        @if($users->count() > 0)
       
        @foreach($users as $user)
        <div class="nk-tb-item">
             <div class="nk-tb-col  tb-col-md">
                <span >{{$user->id}}</span>
            </div>
            <div class="nk-tb-col">
                       <div class="user-card">
                <a href="{{ url('admin/profile_detail/'.$user->id) }}" target="_blank">

                        <div class="user-avatar bg-primary mr-3">
                            @if($user->user_img)
                            <img src="{{asset('frontend-assets/images/users/'.$user->user_img)}}" alt="Profile Image" class="rounded-circle">
                            @else
                            <span>{{mb_substr($user->first_name, 0, 1)}}{{mb_substr($user->last_name, 0, 1)}}</span>
                            @endif
                        </div>
                    </a>
                
                       <a href="{{ url('admin/profile_detail/'.$user->id) }}" target="_blank">
                        <div class="user-info">
                          
                            <span class="tb-lead"> {{ \Acelle\Jobs\HelperJob::getprefix(json_decode($user->category_id)) ?? '' }} {{$user->first_name}} {{$user->first_name}} {{$user->last_name}}
                                <em class="icon ni ni-eye float-right"></em>
                            </span>
                            <span>{{$user->email}}</span>
                        </div>
                         </a>
                    </div>
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
                @if(Acelle\Jobs\HelperJob::countryname($user->country))
                <span>{{Acelle\Jobs\HelperJob::countryname($user->country)->name}}</span>
                @else
                <span>{{$user->country}}</span>
                @endif
            </div>
            <div class="nk-tb-col tb-col-lg">
                @if(Acelle\Jobs\HelperJob::statename($user->state))
                <span>{{Acelle\Jobs\HelperJob::statename($user->state)->name}}</span>
                @else
                <span>{{$user->state}}</span>
                @endif
            </div>
            <div class="nk-tb-col tb-col-lg">
              @if(Acelle\Jobs\HelperJob::cityname($user->city)) <span >{{Acelle\Jobs\HelperJob::cityname($user->city)->name}}</span> 
               @else
               {{$user->city}}
               @endif
            </div>
            <div class="nk-tb-col tb-col-lg">
                <span>{{\Carbon\Carbon::parse($user->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
            </div>
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
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="{{ url('admin/profile_detail/'.$user->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                    <li onclick="addCredits('{{$user->id}}')"><a href="#"><em class="icon ni ni-invest"></em><span>Add Credits</span></a></li>
                                    <li><a href="{{ url('admin/location_setting/'.$user->id) }}"><em class="icon ni ni-location"></em><span>Location Setting</span></a></li>
                                     <li>
                                      <a href="#" onclick="document.getElementById('password-reset-form{{$user->id}}').submit();">
                                        <em class="icon ni ni-unlock"></em><span>Send password reset</span>
                                      </a>
                                    </li>
                                    <form id="password-reset-form{{$user->id}}" action="{{ url('/forget-password') }}" method="POST" style="display: none;">
                                         {{ csrf_field() }}
                                      <input type="hidden" name="email" value="{{ $user->email }}" />
                                    </form>
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
        @endif
       
    </div><!-- .nk-tb-list -->
    <div class="card-inner">
    {{$users}}
</div><!-- .card-inner -->