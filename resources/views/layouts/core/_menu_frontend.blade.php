<nav class="navbar navbar-expand-xl navbar-dark fixed-top navbar-main py-0">
    <?php  
       $customer =  Request::user()->customer;
       $subscription = $customer->subscription;
    ?>
    <div class="container-fluid ms-0">
        <a class="navbar-brand d-flex align-items-center me-2" href="{{ url('/admin') }}">
            @if (\Acelle\Model\Setting::get('site_logo_small'))
                <img class="logo" src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small')) }}" alt="">
            @else
                <span class="default-app-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 389.3 60.1"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><path d="M38.5,56.4,36.7,43.8H16.9l-7,12.6H0L29.6,6h9.8l8,50.4ZM33.1,16V13.6h-.2a18,18,0,0,1-1.6,3.8L20.6,36.7H35.7l-2.4-19A9.9,9.9,0,0,1,33.1,16Z" style="fill:#fff"/><path d="M82.7,28.9A13.5,13.5,0,0,0,79.4,27a13.2,13.2,0,0,0-4.4-.8,10.4,10.4,0,0,0-6.1,2,14.7,14.7,0,0,0-4.5,5.7,17.5,17.5,0,0,0-1.8,7.8c0,2.9.7,5.1,2,6.6a7,7,0,0,0,5.6,2.3,12.2,12.2,0,0,0,4.6-.9,22.6,22.6,0,0,0,4.4-2.2l-1.5,7.2a22.4,22.4,0,0,1-9.9,2.6c-4.3,0-7.6-1.3-10.1-3.9s-3.6-6.3-3.6-10.9a26,26,0,0,1,2.7-11.6,19.9,19.9,0,0,1,7.6-8.4,20.2,20.2,0,0,1,10.9-3,22.2,22.2,0,0,1,5.1.6,19.7,19.7,0,0,1,4,1.6Z" style="fill:#fff"/><path d="M118.6,29.3a10,10,0,0,1-6,9.5c-4.1,2.1-10.2,3.2-18.4,3.3v1.1a7.4,7.4,0,0,0,2.2,5.6,8.6,8.6,0,0,0,6.1,2.1,22,22,0,0,0,5.7-1,39.9,39.9,0,0,0,5.6-2.5l-1.4,7a25,25,0,0,1-11.7,2.9c-4.7,0-8.3-1.3-10.9-3.9s-4-6.3-4-11a25.6,25.6,0,0,1,2.7-11.5A20.7,20.7,0,0,1,96,22.6a18.4,18.4,0,0,1,10.4-3.1q5.7,0,9,2.7A8.8,8.8,0,0,1,118.6,29.3Zm-8.2.2a3.7,3.7,0,0,0-1.3-2.8,4.9,4.9,0,0,0-3.5-1.1,9.8,9.8,0,0,0-6.8,3.1,15.7,15.7,0,0,0-4,7.5c10.4,0,15.6-2.2,15.6-6.7Z" style="fill:#fff"/><path d="M130.6,57c-2.6,0-4.6-.6-6-1.9a7.5,7.5,0,0,1-2-5.5,60.1,60.1,0,0,1,1.3-8.5c.9-4.1,3.6-16.8,8.1-38h8.6l-8.5,40a35.4,35.4,0,0,0-.8,4.5c0,1.8,1,2.7,3.1,2.7a8.7,8.7,0,0,0,3.2-.6l-1.3,6.5A22.4,22.4,0,0,1,130.6,57Z" style="fill:#fff"/><path d="M151.3,57c-2.6,0-4.6-.6-5.9-1.9a7.1,7.1,0,0,1-2-5.5,48.5,48.5,0,0,1,1.3-8.5c.9-4.1,3.6-16.8,8.1-38h8.5l-8.5,40a23.4,23.4,0,0,0-.7,4.5q0,2.7,3,2.7a8.7,8.7,0,0,0,3.2-.6L157,56.2A22.4,22.4,0,0,1,151.3,57Z" style="fill:#fff"/><path d="M196.3,29.3a10,10,0,0,1-6,9.5c-4,2.1-10.2,3.2-18.4,3.3v1.1a7.3,7.3,0,0,0,2.1,5.6,8.6,8.6,0,0,0,6.1,2.1,22,22,0,0,0,5.7-1,28.1,28.1,0,0,0,5.6-2.5l-1.4,7a25,25,0,0,1-11.7,2.9c-4.7,0-8.3-1.3-10.9-3.9s-3.9-6.3-3.9-11a26.9,26.9,0,0,1,2.6-11.5,20.7,20.7,0,0,1,7.5-8.3,18.7,18.7,0,0,1,10.5-3.1c3.7,0,6.7.9,8.9,2.7A8.5,8.5,0,0,1,196.3,29.3Zm-8.2.2a3.2,3.2,0,0,0-1.3-2.8,4.9,4.9,0,0,0-3.5-1.1,9.8,9.8,0,0,0-6.8,3.1,14.7,14.7,0,0,0-3.9,7.5C182.9,36.2,188.1,34,188.1,29.5Z" style="fill:#fff"/><path d="M339.6,59.2h-8.7a17.3,17.3,0,0,1,.3-3.2,22,22,0,0,1,.4-3.6h-.2a28.9,28.9,0,0,1-3.8,4.7,12.4,12.4,0,0,1-3.4,2.2,12.6,12.6,0,0,1-4.3.8,9.1,9.1,0,0,1-7.9-3.7c-1.9-2.4-2.9-5.7-2.9-10A25.6,25.6,0,0,1,312.2,34a19.9,19.9,0,0,1,8.2-8.8,23.9,23.9,0,0,1,12-2.9A68.3,68.3,0,0,1,345.9,24l-5,23.5c-.3,1.6-.6,3.7-.9,6.1A52.7,52.7,0,0,0,339.6,59.2Zm-3.3-30a15.7,15.7,0,0,0-4.8-.5,12.8,12.8,0,0,0-7.1,2.1,14.4,14.4,0,0,0-4.9,6.3,22.5,22.5,0,0,0-1.8,8.9,9.2,9.2,0,0,0,1.3,5.4,4.5,4.5,0,0,0,4,1.9c2.5,0,4.8-1.3,6.8-3.9a26.4,26.4,0,0,0,4.4-10.5Z" style="fill:#fff"/><path d="M358.6,59.8a8.3,8.3,0,0,1-5.9-2,7.1,7.1,0,0,1-2-5.5,14.7,14.7,0,0,1,.4-3.6l5.2-25.5h8.5l-4.7,22.7a35.4,35.4,0,0,0-.8,4.5c0,1.8,1,2.7,3.1,2.7a8.7,8.7,0,0,0,3.2-.6L364.2,59A21,21,0,0,1,358.6,59.8ZM368.1,11a4.7,4.7,0,0,1-1.5,3.5,5.5,5.5,0,0,1-3.7,1.4,4.5,4.5,0,0,1-3.5-1.3,3.9,3.9,0,0,1-1.5-3.3,3.9,3.9,0,0,1,1.6-3.5,5,5,0,0,1,3.7-1.3,5.5,5.5,0,0,1,3.5,1.2A4.7,4.7,0,0,1,368.1,11Z" style="fill:#fff"/><path d="M379.3,59.8a8.3,8.3,0,0,1-5.9-2,6.9,6.9,0,0,1-2.1-5.4,48.6,48.6,0,0,1,1.4-8.5c.9-4.1,3.6-16.8,8.1-38h8.5l-8.5,40a23.4,23.4,0,0,0-.7,4.5q0,2.7,3,2.7a8.7,8.7,0,0,0,3.2-.6L385,59A22.4,22.4,0,0,1,379.3,59.8Z" style="fill:#fff"/><path d="M307.4.1,310,3.3c-.1.4-.1.7-.2,1.1l-.2.6L297.9,59.1H284.5l10.4-44L266.1,44.8l-4.2-.6L246.7,16.9c-3.6,14-7.1,28-10.7,42.1l-11.6.2,14-54.8c.3-1.5.7-2.9,1.5-3.4h10.2c-.3-.8-.2-.6-.1-.4s1.3,2.5,1.9,3.8l.4.6c4.5,8.9,9.1,17.7,13.7,26.5L291.7,5l.6-.6L296.5.1Z" style="fill:#fff"/><path d="M310,3.5a2.9,2.9,0,0,0-.2.9H238.4l.4-1.8A3.4,3.4,0,0,1,242.1,0h65.1a2.9,2.9,0,0,1,2.9,2.9C310.1,3.1,310,3.3,310,3.5Z" style="fill:#fff"/><path d="M228.9,14.7H203.3a2.5,2.5,0,0,1,0-5h25.6a2.5,2.5,0,0,1,0,5Z" style="fill:#fff"/><path d="M225.3,28.7H213.5a2.5,2.5,0,0,1,0-5h11.8a2.5,2.5,0,0,1,0,5Z" style="fill:#fff"/><path d="M221.9,42.7h-3.1a2.5,2.5,0,0,1,0-5h3.1a2.5,2.5,0,0,1,0,5Z" style="fill:#fff"/></g></g></g></g></svg>
                </span>
            @endif
        </a>
        <button class="navbar-toggler" role="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <span class="leftbar-hide-menu middle-bar-element">
            <svg class="SideBurgerIcon-image" viewBox="0 0 50 32"><path d="M49,4H19c-0.6,0-1-0.4-1-1s0.4-1,1-1h30c0.6,0,1,0.4,1,1S49.6,4,49,4z"></path><path d="M49,16H19c-0.6,0-1-0.4-1-1s0.4-1,1-1h30c0.6,0,1,0.4,1,1S49.6,16,49,16z"></path><path d="M49,28H19c-0.6,0-1-0.4-1-1s0.4-1,1-1h30c0.6,0,1,0.4,1,1S49.6,28,49,28z"></path><path d="M8.1,22.8c-0.3,0-0.5-0.1-0.7-0.3L0.7,15l6.7-7.8c0.4-0.4,1-0.5,1.4-0.1c0.4,0.4,0.5,1,0.1,1.4L3.3,15l5.5,6.2   c0.4,0.4,0.3,1-0.1,1.4C8.6,22.7,8.4,22.8,8.1,22.8z"></path></svg>
        </span>
           
        <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-md-0 main-menu">
                    <li class="nav-item" rel0="HomeController">
                        <a href="{{ url('/admin') }}" title="{{ trans('messages.dashboard') }}" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                          <em class="icon ni ni-dashboard fs-5 mr-1"></em>
                            <span>{{ trans('messages.dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item" rel0="HomeController">
                        <a href="{{ url('admin/quotes') }}" title="Quotes" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                           <em class="icon ni ni-coin-alt fs-5 mr-1"></em>
                            <span>Quotes</span>
                        </a>
                    </li>
                    <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/customers') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                           <em class="icon ni ni-users fs-5 mr-1"></em>
                            <span>Customers</span>
                        </a>
                    </li>
                    <?php  $job_design = Acelle\Jobs\HelperJob::form_design();  ?>
                    <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/serviceproviders') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                           <em class="icon ni ni-users fs-5 mr-1"></em>
                            <span>{{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }}</span>
                        </a>
                    </li>

                    <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/service-categories') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                           <em class="icon ni ni-network fs-5 mr-1"></em>
                            <span>Service Categories</span>
                        </a>
                    </li>
                <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/page-design') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                          <em class="icon ni ni-color-palette fs-5 mr-1"></em>
                            <span>Website Designer</span>
                        </a>
                    </li>
                <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/questions') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                          <em class="icon ni ni-card-view fs-5 mr-1"></em>
                            <span>Form Builder</span>
                        </a>
                  </li>
                <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/serviceproviders-report') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                          <em class="icon ni ni-card-view fs-5 mr-1"></em>
                            <span>Reporting</span>
                        </a>
                  </li>
                <li class="nav-item dropdown language-switch" rel1="CustomerController" >
                        <a role="button" class="nav-link lvl-1 dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                           <em class="icon ni ni-setting fs-5 mr-1"></em>
                            <span>Settings</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="height: 280px;overflow: auto;">
                         <li class="nav-item" rel2="HomeController">
                                <a href="{{ url('admin/account/profile') }}" title="Account" class="dropdown-item d-flex align-items-center">
                                  <em class="icon ni ni-account-setting fs-5 mr-1"></em>
                                    <span>Account</span>
                                </a>
                            </li>

                         @if($subscription->plan_id == 3 || $subscription->plan_id == 4 || $subscription->plan_id == 5)
                            
                             <li class="nav-item" rel2="HomeController">
                                <a href="{{ url('admin/custom-domain') }}" title="Custom Domain" class="dropdown-item d-flex align-items-center">
                                  <em class="icon ni ni-account-setting fs-5 mr-1"></em>
                                    <span>Custom Domain</span>
                                </a>
                            </li>
                            <li class="nav-item" rel2="HomeController">
                                <a href="{{ url('admin/google-site-verification') }}" title="Google Site Verification" class="dropdown-item d-flex align-items-center">
                                  <em class="icon ni ni-tranx fs-5 mr-1"></em>
                                    <span>Google Site Verification</span>
                                </a>
                            </li>
                            @endif
                               <li class="nav-item" rel0="CustomerController9">
                                <a href="{{ url('admin/mail') }}" class="dropdown-item d-flex align-items-center">
                                   <em class="icon ni ni-emails fs-5 mr-1"></em>
                                    Email Settings
                                </a>
                            </li>
                              <li class="nav-item" rel0="CustomerController9">
                                <a href="{{ url('admin/layouts') }}" class="dropdown-item d-flex align-items-center">
                                   <em class="icon ni ni-emails fs-5 mr-1"></em>
                                    Email Templates
                                </a>
                            </li> 
                              <li class="nav-item" rel2="HomeController">
                                    <a href="{{ url('admin/credit-amount') }}" title="Credits Management" class="dropdown-item d-flex align-items-center">
                                        <em class="icon ni ni-invest fs-5 mr-1"></em>
                                        <span>Credits Management</span>
                                    </a>
                                </li>
                                <li class="nav-item" rel2="HomeController">
                                    <a href="{{ url('admin/payments-receive') }}" title="Receive Payments" class="dropdown-item d-flex align-items-center">
                                      <em class="icon ni ni-tranx fs-5 mr-1"></em>
                                        <span>Received Payments</span>
                                    </a>
                                </li>
                              <li class="nav-item" rel0="CustomerController9">
                                <a href="{{ url('admin/account/api') }}" class="dropdown-item d-flex align-items-center">
                                   <em class="icon ni ni-briefcase fs-5 mr-1"></em>
                                    Payment Settings
                                </a>
                            </li>
                              <li class="nav-item" rel0="CustomerController9">
                                <a href="{{ url('admin/account/location-setting') }}" class="dropdown-item d-flex align-items-center">
                                  <em class="icon ni ni-location fs-5 mr-1"></em>
                                    Service Location Settings
                                </a>
                            </li>
                       </ul>
                    </li>
        
                    <li class="nav-item dropdown language-switch"  rel0="CustomerController">
                    <a  class="nav-link lvl-1 dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                       <em class="icon ni ni-file-docs fs-5 mr-1"></em>
                        <span>Blogs</span>
                         <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    
                    <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/posts') }}" title="All Blogs" class="dropdown-item d-flex align-items-center">
                          <em class="icon ni ni-tranx fs-5 mr-1"></em>
                            <span>All Blogs</span>
                        </a>
                    </li>      
                    <li class="nav-item" rel2="HomeController">
                        <a href="{{ url('admin/posts/add') }}" title="Add Blogs" class="dropdown-item d-flex align-items-center">
                            <em class="icon ni ni-blank fs-5 mr-1"></em>
                            <span>Add Blog</span>
                        </a>
                    </li>
                       
                   </ul>
                </li>
              
                <li class="nav-item" rel2="HomeController">
                    <a href="{{ url('admin/support') }}" title="Support" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                       <em class="icon ni ni-headphone fs-5 mr-1"></em>
                        <span>Support</span>
                    </a>
                </li>
            </ul>
            <div class="navbar-right">
                <ul class="navbar-nav me-auto mb-md-0">
                    @include('layouts.core._top_activity_log')
                    
                    @include('layouts.core._menu_frontend_user')
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    var MenuFrontend = {
        saveLeftbarState: function(state) {
            var url = '{{ url('account/leftbar/state') }}';

            $.ajax({
                method: "GET",
                url: url,
                data: {
                    _token: CSRF_TOKEN,
                    state: state,
                }
            });
        }
    };

    $(function() {
        //
        $('.leftbar .leftbar-hide-menu').on('click', function(e) {
            if (!$('.leftbar').hasClass('leftbar-closed')) {
                $('.leftbar').addClass('leftbar-closed');

                MenuFrontend.saveLeftbarState('closed');
            } else {
                $('.leftbar').removeClass('leftbar-closed');

                MenuFrontend.saveLeftbarState('open');
            }
        });
    });        
</script>
