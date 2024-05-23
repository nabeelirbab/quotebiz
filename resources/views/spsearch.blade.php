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

                        <div class="user-avatar bg-primary">
                            @if($user->user_img)
                            <img src="{{asset('frontend-assets/images/users/'.$user->user_img)}}" alt="Profile Image" class="rounded-circle">
                            @else
                            <span>{{mb_substr($user->first_name, 0, 1)}}{{mb_substr($user->last_name, 0, 1)}}</span>
                            @endif
                        </div>
                    </a>
                     <select style="margin: 10px;" id="srname{{$user->id}}" onchange="updateSr({{$user->id}})">
                                <option value="" {{ $user->title == '' ? 'selected' : '' }}>--</option>
                                <option value="Mr." {{ $user->title == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                <option value="Mrs." {{ $user->title == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                <option value="Ms." {{ $user->title == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                <option value="Miss" {{ $user->title == 'Miss' ? 'selected' : '' }}>Miss</option>
                                <option value="Mx." {{ $user->title == 'Mx.' ? 'selected' : '' }}>Mx.</option>
                                <option value="DJ" {{ $user->title == 'DJ' ? 'selected' : '' }}>DJ</option>
                                <option value="Dr." {{ $user->title == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                <option value="Prof." {{ $user->title == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                                <option value="Rev." {{ $user->title == 'Rev.' ? 'selected' : '' }}>Rev.</option>
                                <option value="Hon." {{ $user->title == 'Hon.' ? 'selected' : '' }}>Hon.</option>
                                <option value="Sir" {{ $user->title == 'Sir' ? 'selected' : '' }}>Sir</option>
                                <option value="Lady" {{ $user->title == 'Lady' ? 'selected' : '' }}>Lady</option>
                                <option value="Capt." {{ $user->title == 'Capt.' ? 'selected' : '' }}>Capt.</option>
                                <option value="Lt." {{ $user->title == 'Lt.' ? 'selected' : '' }}>Lt.</option>
                                <option value="Maj." {{ $user->title == 'Maj.' ? 'selected' : '' }}>Maj.</option>
                                <option value="Sgt." {{ $user->title == 'Sgt.' ? 'selected' : '' }}>Sgt.</option>
                                <option value="Chief" {{ $user->title == 'Chief' ? 'selected' : '' }}>Chief</option>
                                <option value="Sen." {{ $user->title == 'Sen.' ? 'selected' : '' }}>Sen.</option>
                                <option value="Gov." {{ $user->title == 'Gov.' ? 'selected' : '' }}>Gov.</option>
                                <option value="Pres." {{ $user->title == 'Pres.' ? 'selected' : '' }}>Pres.</option>
                                <option value="Jr." {{ $user->title == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                <option value="Sr." {{ $user->title == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                <option value="Esq." {{ $user->title == 'Esq.' ? 'selected' : '' }}>Esq.</option>
                                <option value="Rabbi" {{ $user->title == 'Rabbi' ? 'selected' : '' }}>Rabbi</option>
                                <option value="Imam" {{ $user->title == 'Imam' ? 'selected' : '' }}>Imam</option>
                                <option value="Sheikh" {{ $user->title == 'Sheikh' ? 'selected' : '' }}>Sheikh</option>  
                      </select>
                       <a href="{{ url('admin/profile_detail/'.$user->id) }}" target="_blank">
                        <div class="user-info">
                          
                            <span class="tb-lead">{{$user->first_name}} {{$user->last_name}}
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
                                  @if($user->activated == '1')
                                <li><a href="{{ url('admin/account_status/'.$user->id.'?status=0') }}" onclick="return confirm('Are you sure you want to suspend this account?');" title="Suspend Account"><em class="icon ni ni-na"></em><span>Suspend Account</span></a></li>
                                @else
                                <li><a href="{{ url('admin/account_status/'.$user->id.'?status=1') }}" onclick="return confirm('Are you sure you want to active this account?');" title="Active Account"><em class="icon ni ni-shield-check"></em><span>Active Account</span></a></li>
                                <li><a href="{{ url('admin/account_status/'.$user->id.'?status=3') }}" onclick="return confirm('Are you sure you want to delete this account?');" title="Suspend Account"><em class="icon ni ni-na"></em><span>Delete Account</span></a></li>
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