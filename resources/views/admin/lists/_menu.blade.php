<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-top nav-underline mb-1">
            <li rel0="Admin\MailListController/overview" class="nav-item">
                <a href="{{ action('Admin\MailListController@overview', $list->uid) }}" class="nav-link">
                <span class="material-icons-outlined">
auto_graph
</span> {{ trans('messages.overview') }}
                </a>
            </li>
            <li rel0="Admin\MailListController/edit" class="nav-item">
                <a class="nav-link level-1" href="{{ action('Admin\MailListController@edit', $list->uid) }}">
                <span class="material-icons-outlined">
settings
</span> {{ trans('messages.list.title.setting') }}
                </a>
            </li>
            <li rel0="SubscriberController" class="nav-item">
                <a href="{{ action("Admin\AccountController@contact") }}" class="nav-link dropdown-toggle level-1" data-bs-toggle="dropdown">
                <span class="material-icons-outlined">
people
</span> {{ trans('messages.subscribers') }}
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="nav-item" rel0="SubscriberController/index">
                        <a class="dropdown-item" href="{{ action('Admin\SubscriberController@index', $list->uid) }}">
                        <span class="material-icons-round">
                format_list_bulleted
                </span> {{ trans('messages.view_all') }}
                        </a>
                    </li>
                    <li class="nav-item" rel0="SubscriberController/create">
                        <a class="dropdown-item" href="{{ action('Admin\SubscriberController@create', $list->uid) }}">
                        <span class="material-icons-outlined">
add
</span> {{ trans('messages.add') }}
                        </a>
                    </li>
                    <li class="divider"></li>
                    @if (\Auth::user()->can('import', $list))
                    <li class="nav-item" rel0="SubscriberController/import">
                        <a class="dropdown-item" class="dropdown-item" href="{{ action('Admin\SubscriberController@import', $list->uid) }}">
                        <span class="material-icons-outlined">
file_upload
</span> {{ trans('messages.import') }}
                        </a>
                    </li>
                    @endif
                    @if (\Auth::user()->can('export', $list))
                    <li class="nav-item" rel0="SubscriberController/export">
                        <a class="dropdown-item" href="{{ action('Admin\SubscriberController@export', $list->uid) }}">
                        <span class="material-icons-outlined">
file_download
</span> {{ trans('messages.export') }}
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li rel0="SegmentController" class="nav-item">
                <a href="{{ action("Admin\AccountController@contact") }}" class="nav-link level-1 dropdown-toggle" data-bs-toggle="dropdown">
                <span class="material-icons-outlined">
splitscreen
</span> {{ trans('messages.segments') }}
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="nav-item" rel0="SegmentController/index">
                    <a class="dropdown-item" href="{{ action('Admin\SegmentController@index', $list->uid) }}">
                    <span class="material-icons-round">
                format_list_bulleted
                </span> {{ trans('messages.view_all') }}
                    </a>
                    </li>
                    <li class="nav-item" rel0="SegmentController/create">
                    <a class="dropdown-item" href="{{ action('Admin\SegmentController@create', $list->uid) }}">
                    <span class="material-icons-outlined">
add
</span> {{ trans('messages.add') }}
                    </a>
                    </li>
                </ul>
            </li>
            <li rel0="PageController" rel1="Admin\MailListController/embeddedForm" class="nav-item">
                <a href="#menu" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="material-icons-outlined">
web
</span> {{ trans('messages.custom_forms_and_emails') }}
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end has-head">
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\MailListController@embeddedForm', $list->uid) }}">
                    <span class="material-icons-outlined">
dashboard
</span> {{ trans('messages.Embedded_form') }}
                    </a>
                </li>
                <li class="head">
                    <span class="material-icons-round me-1">
                        add_task
                        </span> {{ trans('messages.subscribe') }}
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'sign_up_form']) }}">
                    {{ trans('messages.sign_up_form') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'sign_up_thankyou_page']) }}">
                    {{ trans('messages.sign_up_thankyou_page') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'sign_up_confirmation_email']) }}">
                    {{ trans('messages.sign_up_confirmation_email') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'sign_up_confirmation_thankyou']) }}">
                    {{ trans('messages.sign_up_confirmation_thankyou') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'sign_up_welcome_email']) }}">
                    {{ trans('messages.sign_up_welcome_email') }}
                    </a>
                </li>
                <li class="head">
                    <span class="material-icons-round me-1">
                        logout
                        </span> {{ trans('messages.unsubscribe') }}
                    </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'unsubscribe_form']) }}">
                    {{ trans('messages.unsubscribe_form') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'unsubscribe_success_page']) }}">
                    {{ trans('messages.unsubscribe_success_page') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'unsubscribe_goodbye_email']) }}">
                    {{ trans('messages.unsubscribe_goodbye_email') }}
                    </a>
                </li>
                    <li class="head">
                        <span class="material-icons-round me-1">
                            person_outline
                            </span> {{ trans('messages.update_profile') }}
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'profile_update_email_sent']) }}">
                    {{ trans('messages.profile_update_email_sent') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'profile_update_email']) }}">
                    {{ trans('messages.profile_update_email') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'profile_update_form']) }}">
                    {{ trans('messages.profile_update_form') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'profile_update_success_page']) }}">
                    {{ trans('messages.profile_update_success_page') }}
                    </a>
                </li>
                </ul>
            </li>
            <li rel0="FieldController/index" class="nav-item">
                <a class="nav-link" href="{{ action('Admin\FieldController@index', $list->uid) }}">
                <span class="material-icons-outlined">
fact_check
</span> {{ trans('messages.manage_list_fields') }}
                </a>
            </li>
            <li rel0="Admin\MailListController/verification" class="nav-item">
                <a class="nav-link" href="{{ action('Admin\MailListController@verification', $list->uid) }}">
                <span class="material-icons-outlined">
mark_email_read
</span> {{ trans('messages.email_verification') }}
                </a>
            </li>
        </ul>
    </div>
</div>
