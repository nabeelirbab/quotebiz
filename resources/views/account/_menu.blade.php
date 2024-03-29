    <?php  
       $customer =  Request::user()->customer;
       $subscription = $customer->subscription;
    ?>
    <div class="row">
    <div class="col-md-12">
    <div class="tabbable pb-2">
    <ul class="nav nav-tabs nav-tabs-top nav-underline mb-4">
    <li rel0="AccountController/profile" class="nav-item">
    <a href="{{ url("admin/account/profile") }}" class="nav-link">
        <span class="material-icons-outlined">
    face
    </span> {{ trans('messages.my_profile') }}
    </a>
    </li>
    <li rel0="AccountController/contact" class="nav-item">
    <a href="{{ url("admin/account/contact") }}" class="nav-link">
        <span class="material-icons-outlined">
    maps_home_work
    </span> {{ trans('messages.contact_information') }}
    </a>
    </li>
    
  
    @if (config('app.saas'))
   <!--  <li rel0="AccountController/billing" class="nav-item">
        <a href="{{ url("admin/account/billing") }}" class="nav-link">
            <span class="material-icons-outlined">
    credit_card
    </span> {{ trans('messages.billing') }}
        </a>
    </li> -->
    <li class="nav-item"
        rel0="AccountController/subscription"
        rel1="PaymentController"
        rel2="AccountController/subscriptionNew"
        rel3="SubscriptionController"
        class="position-relative"
    >
        <a href="{{ url("admin/account/subscription") }}" class="nav-link position-relative {{ isset($tab) && $tab == 'subscription' ? 'active' : '' }}">
            <span class="material-icons-outlined">
    assignment
    </span> {{ trans('messages.subscription') }}
            @if (Auth::user()->customer->hasSubscriptionNotice())
                <i class="material-icons-round tabs-warning-icon text-danger">info</i>
            @endif
        </a>
    </li>
    @endif
    @if($subscription->plan_id == 2 || $subscription->plan_id == 3 || $subscription->plan_id == 4 || $subscription->plan_id == 5)
  
    @endif
   
    </ul>
    </div>
    </div>
    </div>
