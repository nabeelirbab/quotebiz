<div class="tabbable">

    <ul class="nav nav-tabs nav-tabs-top nav-underline">
        <li class="nav-item 
        {{ request()->route()->getActionName() == 'Acelle\Http\Controllers\Admin\CustomerController@edit' ? 'active' : '' }}
        text-semibold"><a class="nav-link" href="{{ action('Admin\CustomerController@edit', $customer->uid) }}">
            <span class="material-icons-round">
person_outline
</span> {{ trans('messages.profile') }}</a>
        </li>
        @if($customer->user_type == 'admin')
        <li class="nav-item 
        {{ request()->route()->getActionName() == 'Acelle\Http\Controllers\Admin\CustomerController@contact' ? 'active' : '' }}
        text-semibold"><a class="nav-link" href="{{ action('Admin\CustomerController@contact', $customer->uid) }}">
            <span class="material-icons-outlined">
maps_home_work
</span> {{ trans('messages.contact_information') }}</a>
        </li>
        <li class="nav-item 
        {{ request()->route()->getActionName() == 'Acelle\Http\Controllers\Admin\CustomerController@subscriptions' ? 'active' : '' }}
        text-semibold"><a class="nav-link" href="{{ action('Admin\CustomerController@subscriptions', $customer->uid) }}">
            <span class="material-icons-outlined">
assignment_turned_in
</span> {{ trans('messages.subscriptions') }}</a>
        </li>
        @can('viewSubAccount', $customer)
            <li class="nav-item 
            {{ request()->route()->getActionName() == 'Acelle\Http\Controllers\Admin\CustomerController@subAccount' ? 'active' : '' }}
            text-semibold"><a class="nav-link" href="{{ action('Admin\CustomerController@subAccount', $customer->uid) }}">
                <span class="material-icons-outlined">
approval
</span> {{ trans('messages.customer.sub_account') }}</a>
            </li>
        @endcan
        @endif
    </ul>
</div>
