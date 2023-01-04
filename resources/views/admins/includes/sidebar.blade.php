<!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="{{url('admins')}}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('/images/logo.png') }}" srcset="{{ asset('/images/logo2x.png 2x') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ url('/images/logo-dark.png') }}" srcset="{{ url('/images/logo-dark2x.png 2x') }}" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item">
                                    <a href="{{ url('admins') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="{{ url('admins/quotes') }}" class="nk-menu-link ">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">Quotes</span>
                                    </a>
                                 
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('admins/customers') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                                        <span class="nk-menu-text">Customers</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                             
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                        <span class="nk-menu-text">Service Providers</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                          <li class="nk-menu-item">
                                            <a href="{{ url('admins/serviceprovider') }}" class="nk-menu-link"><span class="nk-menu-text">Service Providers List</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('admins/servicecategories') }}" class="nk-menu-link"><span class="nk-menu-text">Service Categories</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-task-fill-c"></em></span>
                                        <span class="nk-menu-text">Quote Form Builder</span>
                                    </a>
                                
                                </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                    <a href="{{ url('admins/emailtemplate') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-template-fill"></em></span>
                                        <span class="nk-menu-text">Email Templates</span>
                                    </a>
                                
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="{{ url('admins/settings') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting-alt-fill"></em></span>
                                        <span class="nk-menu-text">Settings</span>
                                    </a>
                                
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item has-sub">
                                    <a href="{{ url('admins/paymenthistory') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span>
                                        <span class="nk-menu-text">Payment History</span>
                                    </a>
                                
                                </li><!-- .nk-menu-item -->
                               
                                <li class="nk-menu-item has-sub">
                                <a href="{{ url('admins/support') }}" class="nk-menu-link">
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