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
        @foreach($users as $user)
        <div class="nk-tb-item">
       
             <div class="nk-tb-col tb-col-lg">
                <span >{{$user->id}}</span>
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