@if ($customers->count() > 0)
    <table class="table table-box pml-table mt-2"
        current-page="{{ empty(request()->page) ? 1 : empty(request()->page) }}"
    >
    <thead class="tb-ticket-head">
            <tr class="tb-ticket-title">
                <th class="tb-ticket-id"><span>#ID</span></th>
                <th class="tb-ticket-desc text-center">
                    <span>User</span>
                </th>
                <th class="tb-ticket-desc">
                    <span>Subdomain</span>
                </th>
                <th class="tb-ticket-desc">
                    <span>Current Plan</span>
                </th>
                <th class="tb-ticket-desc">
                    <span>City</span>
                </th>
                <th class="tb-ticket-date tb-col-md">
                    <span>Created At</span>
                </th>
                <th class="tb-ticket-status">
                    <span>Status</span>
                </th>
                <th class="tb-ticket-status text-center">
                    <span>Action</span>
                </th>
                <!-- <th class="tb-ticket-action">Action</th> -->
            </tr><!-- .tb-ticket-title -->
        </thead>
        @foreach ($customers as $key => $item)
            <tr>
                <td width="1%">
                    {{$item->user->id}}
                </td>
                <td>
                     <div class="text-center">
                     <span>   
                     <img width="50" class="rounded-circle me-2" src="{{ $item->user->getProfileImageUrl() }}" alt="">
                    </span>
                    <h5 class="m-0 text-bold">
                        <a class="kq_search d-block" href="{{ action('Admin\CustomerController@edit', $item->user->uid) }}">{{ $item->user->displayName() }}</a>
                    </h5>
                    <span class="text-muted kq_search">{{ $item->user->email }}</span><br>
                
                </div>
                </td>
                <td>
                    {{ $item->user->subdomain}}
                </td>
                <td>
                    @if ($item->currentPlanName())
                        <h5 class="no-margin stat-num">
                            <span><i class="material-icons-outlined">
 assignment_turned_in
</i> {{ $item->currentPlanName() }}</span>
                        </h5>
                        <span class="text-muted2">{{ trans('messages.current_plan') }}</span>
                    @else
                        <span class="text-muted2">{{ trans('messages.customer.no_active_subscription') }}</span>
                    @endif
                </td>
                <td>
                    {{ $item->user->city}}
                </td>
                <td>
                   {{ Tool::formatDateTime($item->created_at) }}
                </td>
                <td>
                    <span class="text-muted2 list-status pull-left">
                        <span class="label label-flat bg-{{ $item->status }}">{{ trans('messages.user_status_' . $item->status) }}</span>
                    </span>
                </td>
                <td class="text-end">
                   <!--  @can('loginAs', $item)
                        <a href="{{ action('Admin\CustomerController@loginAs', $item->uid) }}" data-popup="tooltip"
                            title="{{ trans('messages.login_as_this_customer') }}" role="button"
                            class="btn btn-primary btn-icon"><span class="material-icons-outlined">
login
</span></a>
                    @endcan -->
                    @can('update', $item)
                        <a href="{{ action('Admin\CustomerController@edit', $item->uid) }}"
                            data-popup="tooltip" title="{{ trans('messages.edit') }}"
                            role="button" class="btn btn-secondary btn-icon"><span class="material-icons-outlined">
edit
</span></a>
                    @endcan
                    @if (Auth::user()->can('delete', $item) ||
                        Auth::user()->can('enable', $item) ||
                        Auth::user()->can('disable', $item) ||
                        Auth::user()->can('assignPlan', $item)
                    )
                        <div class="btn-group">
                            <button role="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @can('assignPlan', $item)
                                    <li>
                                        <a
                                            href="{{ action('Admin\CustomerController@assignPlan', [
                                                "uid" => $item->uid,
                                            ]) }}"
                                            class="dropdown-item assign_plan_button"
                                        >
                                            <i class="material-icons-outlined">
assignment_turned_in
</i>
                                             {{ trans('messages.customer.assign_plan') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('enable', $item)
                                    <li>
                                        <a class="dropdown-item list-action-single" link-confirm="{{ trans('messages.enable_customers_confirm') }}" href="{{ action('Admin\CustomerController@enable', ["uids" => $item->uid]) }}">
                                            <span class="material-icons-outlined">
play_arrow
</span> {{ trans('messages.enable') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('disable', $item)
                                    <li>
                                        <a class="dropdown-item list-action-single" link-confirm="{{ trans('messages.disable_customers_confirm') }}" href="{{ action('Admin\CustomerController@disable', ["uids" => $item->uid]) }}">
                                            <span class="material-icons-outlined">
hide_source
</span> {{ trans('messages.disable') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('read', $item)
                                    <li>
                                        <a class="dropdown-item" href="{{ action('Admin\CustomerController@subscriptions', $item->uid) }}">
                                            <span class="material-icons-outlined">
assignment_turned_in
</span> {{ trans('messages.subscriptions') }}
                                        </a>
                                    </li>
                                @endcan
                                <li>
                                    <a class="dropdown-item list-action-single" link-confirm="{{ trans('messages.delete_users_confirm') }}" href="{{ action('Admin\CustomerController@delete', ['uids' => $item->uid]) }}">
                                        <span class="material-icons-outlined">
delete_outline
</span> {{ trans('messages.delete') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    @include('elements/_per_page_select', ["items" => $customers])
    

    <script>
        var assignPlan;        
        $(function() {
            $('.assign_plan_button').click(function(e) {
                e.preventDefault();

                var src = $(this).attr('href');
                assignPlan = new Popup({
                    url: src
                });

                assignPlan.load();
            });
        });
    </script>

@elseif (!empty(request()->keyword))
    <div class="empty-list">
        <span class="material-icons-round">
people_outline
</span>
        <span class="line-1">
            {{ trans('messages.no_search_result') }}
        </span>
    </div>
@else
    <div class="empty-list">
        <span class="material-icons-round">
people_outline
</span>
        <span class="line-1">
            {{ trans('messages.customer_empty_line_1') }}
        </span>
    </div>
@endif
