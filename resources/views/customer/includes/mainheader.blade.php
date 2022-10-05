<?php
 $sitelargelogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
 ?>
                <div class="nk-header nk-header-fixed nk-header-fluid is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="{{url('customer')}}" class="logo-link">
                                     <img class="logo-light logo-img" src="{{$sitelargelogo }}" style="max-height: 52px;max-width: 140px;" >
                                    <img class="logo-dark logo-img" src="{{$sitelargelogo }}" alt="logo-dark" style="max-height: 52px;max-width: 140px;">
                                </a>
                            </div><!-- .nk-header-brand -->
                           <!--  <div class="nk-header-search ml-3 ml-xl-0">
                                <em class="icon ni ni-search"></em>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
                            </div> --><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                   <li class="nav-item d-none d-lg-block">
                                        <a href="{{ url('service-provider') }}" class="nk-quick-nav-icon"><p style="font-size: 16px"><b>Switch to service provider</b></p></a>
                                    </li>
                                    <li class="dropdown chats-dropdown hide-mb-xs">
                                        <a href="{{ url('customer/inbox') }}" class="le nk-quick-nav-icon">
                                            <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em><span class="badge msgnotifications">0</span></div>
                                        </a>
                                        
                                    </li>
                                   
                                   <!--  <li class="dropdown language-dropdown d-none d-sm-block mr-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                <img class="icon" src="./images/flags/english-sq.png" alt="">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-s1">
                                            <ul class="language-list">
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./images/flags/english.png" alt="" class="language-flag">
                                                        <span class="language-name">English</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./images/flags/spanish.png" alt="" class="language-flag">
                                                        <span class="language-name">Español</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./images/flags/french.png" alt="" class="language-flag">
                                                        <span class="language-name">Français</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                                        <span class="language-name">Türkçe</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> --><!-- .dropdown -->
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <div class="dropdown-inner user-card-wrap bg-lighter">
                                                <div class="user-card">
                                                 <div class="uploadimg">
                                                    @if(Auth::user()->user_img)
                                                    <div class="nk-msg-media user-avatar" style="margin-right: 15px;">
                                                    <img src="{{asset('frontend-assets/images/users/'.Auth::user()->user_img)}}" alt="">
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
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{url('customer/profile')}}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                 <!--    <li><a href="customer/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="customer/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li> -->
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{url('users/logout')}}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e