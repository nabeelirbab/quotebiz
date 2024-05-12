 <?php  
       $customer =  Request::user()->customer;
       $subscription = $customer->subscription;
    ?>
 
<div class="row">
    <div class="col-md-12">
        <div class="tabbable pb-2">
            <ul class="nav nav-tabs nav-tabs-top nav-underline mb-2" style="background: white;
                padding: 6px;
                padding-left: 25px;

">
                <li rel0="UserController@seo" class="nav-item">
                    <a href="{{ url("admin/seo") }}" class="nav-link {{ request()->is('admin/seo') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            public
                        </span> SEO Meta Data
                    </a>
                </li>

                <li rel0="UserController@sitesetting" class="nav-item">
                    <a href="{{ url("admin/logo-setting") }}" class="nav-link {{ request()->is('admin/logo-setting') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            donut_small
                        </span> Logo
                    </a>
                </li>

                <li rel0="UserController@formdesign" class="nav-item">
                    <a href="{{ url("admin/page-design") }}" class="nav-link {{ request()->is('admin/page-design') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            maps_home_work
                        </span> Page Design
                    </a>
                </li>

                  <li rel0="UserController@formdesign" class="nav-item">
                    <a href="{{ url("admin/page-layout") }}" class="nav-link {{ request()->is('admin/page-layout') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            maps_home_work
                        </span> Page Layout
                    </a>
                </li>

                <li rel0="UserController@formdesign" class="nav-item">
                    <a href="{{ url("admin/custom-field") }}" class="nav-link {{ request()->is('admin/custom-field') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            maps_home_work
                        </span> Custom Fields
                    </a>
                </li>
                <li rel0="UserController@socialdesign" class="nav-item">
                    <a href="{{ url("admin/feature-bar") }}" class="nav-link {{ request()->is('admin/feature-bar') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            share
                        </span> Feature Bar
                    </a>
                </li> 
                <li rel0="UserController@socialdesign" class="nav-item">
                    <a href="{{ url("admin/social") }}" class="nav-link {{ request()->is('admin/social') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            share
                        </span> Social Media
                    </a>
                </li>

                <li rel0="UserController@termsdesign" class="nav-item">
                    <a href="{{ url("admin/terms") }}" class="nav-link {{ request()->is('admin/terms') ? 'active' : '' }}">
                        <span class="material-icons-outlined">
                            gavel
                        </span> Terms & Policy
                    </a>
                </li>

                @if($subscription->plan_id == 2 || $subscription->plan_id == 3 || $subscription->plan_id == 4 || $subscription->plan_id == 5)

                @endif

            </ul>
        </div>
    </div>
</div>
