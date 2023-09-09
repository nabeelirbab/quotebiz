        <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg side-class"
                                     data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="uploadimg">
                                                    @if(Auth::user()->user_img)
                                                        <div class="nk-msg-media user-avatar"
                                                             style="margin-right: 15px;">
                                                            <img src="{{asset('frontend-assets/images/users/'.Auth::user()->user_img)}}"
                                                                 alt="">
                                                        </div>
                                                    @else
                                                        <div class="user-avatar bg-primary" style="margin-right: 15px;">
                                                            <span>{{mb_substr(Auth::user()->first_name, 0, 1)}}{{mb_substr(Auth::user()->last_name, 0, 1)}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                                    <span class="sub-text">{{Auth::user()->email}}</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                                                           href="#"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <input type="file" accept="image/*" name="image" id="uploadImg" onchange="uploadImg(this)"
                                                                           class="d-none">
                                                                    <label for="uploadImg" class="labelcls"><em class="icon ni ni-camera-fill cameraicon"></em><span>Change Photo</span></label>

                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">Last Login</h6>
                                                <p>{{Auth::user()->last_login_at}}</p>
                                                <h6 class="overline-title-alt">Login IP</h6>
                                                <p>{{Auth::user()->last_login_ip}}</p>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                              <li>
                                                    <a href="{{url('service-provider/location-setting')}}">
                                                        <em class="icon ni ni-location"></em>
                                                        <span>Service Location Settings</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="active" href="{{url('service-provider/business-setting')}}">
                                                        <em class="icon ni ni-user-fill-c"></em>
                                                        <span>Business Infomation</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{url('service-provider/settings')}}">
                                                        <em class="icon ni ni-user-fill-c"></em>
                                                        <span>Personal Infomation</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{url('service-provider/gallery')}}">
                                                        <em class="icon ni ni-user-fill-c"></em>
                                                        <span>Gallery</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- .card-inner -->

                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->