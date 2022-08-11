  <!-- sidebar @s -->
  <?php
 $sitelargelogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
 $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
 ?>
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="{{url('customer')}}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ $sitesmalllogo }}"  alt="logo">
                             <img class="logo-dark logo-img" src="{{ $sitelargelogo }}" 
                 alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item">
                                    <a href="{{url('/customer/')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{url('customer/my-jobs')}}" class="nk-menu-link ">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                        <span class="nk-menu-text">My Jobs</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('customer/inbox')}}" class="nk-menu-link ">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chat-fill"></em></span>
                                        <span class="nk-menu-text">Inbox <span class="badge msgnotifications" style="left: 92px;bottom: 19px;">0</span></span>
                                    </a>
                                </li>
                                <!-- .nk-menu-item -->
                               <!--  <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                        <span class="nk-menu-text">Quotes</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                          <li class="nk-menu-item">
                                            <a href="{{url('customer/myjobs')}}" class="nk-menu-link"><span class="nk-menu-text">My Jobs</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{url('customer/myresponses')}}" class="nk-menu-link"><span class="nk-menu-text">Inbox</span></a>
                                        </li>
                                    </ul>
                                </li> -->
                                <li class="nk-menu-item">
                                    <a href="{{url('customer/profile')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                                        <span class="nk-menu-text">My Profile</span>
                                    </a>
                                 </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="{{url('customer/support')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                        <span class="nk-menu-text">Support</span>
                                    </a>
                                
                                </li><!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->