@if ($lists->count() > 0)
	<table class="table table-box pml-table mt-2"
		current-page="{{ empty(request()->page) ? 1 : empty(request()->page) }}"
	>
		@foreach ($lists as $key => $list)
			<tr>
				<td width="1%">
					<div class="text-nowrap">
						<div class="checkbox inline">
							<label>
								<input type="checkbox" class="node styled"
									name="uids[]"
									value="{{ $list->uid }}"
								/>
							</label>
						</div>
					</div>
				</td>
				<td width="35%">
					<a class="kq_search fw-600 d-block list-title" href="{{ action('Admin\MailListController@overview', [
						'uid' => $list->uid
					]) }}">
						{{ $list->name }}
					</a>
					<span class="text-muted">{{ trans('messages.created_at') }}: {{ Tool::formatDateTime($list->created_at) }}</span>
					@if (empty($list->getSendingServers()))
						<div class="text-danger"><span class="material-icons-outlined">
error_outline
</span> {{ trans('messages.list_has_no_sending_server') }}</div>
					@endif
				</td>
				<td class="stat-fix-size-sm">
					<div class="d-flex">
						<div class="single-stat-box pull-left">
							<a href="{{ action('Admin\SubscriberController@index', $list->uid) }}" class="d-block">
								<span class="stat-num mt-0 mb-1">{{ number_with_delimiter($list->readCache('SubscriberCount', 0)) }}</span>
							</a>
							<span class="text-muted">{{ trans("messages." . Acelle\Library\Tool::getPluralPrase('subscriber', $list->readCache('SubscriberCount', 0))) }}</span>
						</div>
						<div class="single-stat-box pull-left ml-20">
							<span class="no-margin text-primary stat-num">{{ $list->openUniqRate() }}%</span>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-info" style="width: {{ $list->readCache('UniqOpenRate', 0) }}%">
								</div>
							</div>
							<span class="text-muted small">{{ trans('messages.open_rate') }}</span>
						</div>
						<div class="single-stat-box pull-left ml-20">
							<span class="no-margin text-primary stat-num">{{ $list->readCache('ClickedRate', 0) }}%</span>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-info" style="width: {{ $list->readCache('ClickedRate', 0) }}%">
								</div>
							</div>
							<span class="text-muted small">{{ trans('messages.click_rate') }}</span>
						</div>
					</div>
				</td>
				<td class="text-end pe-0">
					<div class="d-flex align-items-center text-nowrap justify-content-end" role="group">
						<a href="{{ action('Admin\SubscriberController@create', $list->uid) }}" data-popup="tooltip"
							title="{{ trans('messages.create_subscriber') }}" role="button" class="btn btn-secondary btn-icon me-1">
							<span class="material-icons-outlined">
								person_add
							</span>
						</a>
						<a href="{{ action('Admin\MailListController@overview', $list->uid) }}" role="button" class="btn btn-primary me-1">
							<span class="material-icons-outlined">
								multiline_chart
							</span> {{ trans('messages.list.overview_statistics') }}
						</a>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-light btn-icon dropdown-toggle ps-2"  data-bs-toggle="dropdown" aria-expanded="false">
									
							</button>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDrop1">
								<li>
									<a class="dropdown-item" href="{{ action('Admin\SubscriberController@index', $list->uid) }}">
										<span class="material-icons-outlined me-2">
											people
										</span> {{ trans("messages.subscribers") }}
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{ action('Admin\SegmentController@index', $list->uid) }}">
										<span class="material-icons-outlined me-2">
											library_add_check
										</span> {{ trans('messages.segments') }}
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{ action('Admin\MailListController@embeddedForm', $list->uid) }}">
										<span class="material-icons-outlined me-2">
											dns
										</span> {{ trans('messages.Embedded_form') }}
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{ action('Admin\PageController@update', ['list_uid' => $list->uid, 'alias' => 'sign_up_form']) }}">
										<span class="material-icons-outlined me-2">
											web
										</span> {{ trans('messages.custom_forms_and_emails') }}
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{ action('Admin\FieldController@index', $list->uid) }}">
										<span class="material-icons-outlined me-2">
											view_day
										</span> {{ trans('messages.manage_list_fields') }}
									</a>
								</li>
								<li><a class="dropdown-item" href="{{ action('Admin\MailListController@verification', $list->uid) }}">
									<span class="material-icons-outlined me-2">
										gpp_good
									</span> {{ trans("messages.email_verification") }}</a></li>
								<li><a class="dropdown-item" href="{{ action('Admin\MailListController@edit', $list->uid) }}">
									<span class="material-icons-outlined me-2">
										edit
									</span> {{ trans("messages.edit_list") }}</a></li>
								@if (\Auth::user()->can('import', $list))
									<li><a class="dropdown-item" href="{{ action('Admin\SubscriberController@import', $list->uid) }}">
										<span class="material-icons-outlined me-2">
											drive_folder_upload
										</span> {{ trans('messages.import') }}</a></li>
								@endif
								@if (\Auth::user()->can('export', $list))
									<li><a class="dropdown-item" href="{{ action('Admin\SubscriberController@export', $list->uid) }}">
										<span class="material-icons-outlined me-2">
											downloading
										</span> {{ trans('messages.export') }}</a></li>
								@endif
								<li>
									<a class="copy-list-button dropdown-item"
										href="{{ action('Admin\MailListController@copy', ['copy_list_uid' => $list->uid]) }}"
									>
										<span class="material-icons-outlined me-2">
											copy_all
										</span> {{ trans('messages.copy') }}
									</a>
								</li>
								@if ($settings['list.clone_for_others'])
									<li>
										<a class="dropdown-item"
											href="{{ action('Admin\MailListController@cloneForCustomersChoose', $list->uid) }}"
											class="clone-for-users"
										>
										<span class="material-icons-outlined me-2">
											control_point_duplicate
										</span> {{ trans('messages.list.clone_for_other_users') }}
										</a>
									</li>
								@endif
								<li>
									<a class="dropdown-item list-action-single"
										link-method="POST"
										link-confirm-url="{{ action('Admin\MailListController@deleteConfirm', ['uids' => $list->uid]) }}"
										href="{{ action('Admin\MailListController@delete', ['uids' => $list->uid]) }}">
										<span class="material-icons-outlined me-2">
											delete
										</span> {{ trans('messages.delete') }}
									</a>
								</li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</table>
	@include('elements/_per_page_select', ["items" => $lists])
	
	
	<script>
		var ListsList = {
			clonePopup: new Popup(),
			copyPopup: null,

			getCopyPopup: function() {
				if (this.copyPopup === null) {
					this.copyPopup = new Popup();
				}

				return this.copyPopup;
			},

			getClonePopup: function() {
				if (this.clonePopup === null) {
					this.clonePopup = new Popup();
				}

				return this.clonePopup;
			},
		}
		
		$('.clone-for-users').on('click', function(e) {
			e.preventDefault();
			var url = $(this).attr('href');
			
			// load popup
			ListsList.getClonePopup().load({
				url: url
			});
		});

		// $('.detele-list-button').on('click', function(e) {
		// 	e.preventDefault();
		// 	var url = $(this).attr('href');
		// 	var confirmUrl = $(this).attr('list-delete-confirm');

		// 	new Link({
		// 		url: url,
		// 		confirmUrl: confirmUrl,
		// 		method: 'POST',
		// 		data: {
		// 			_token: CSRF_TOKEN,
		// 		},
		// 		done: function(response) {
		// 			notify({
		// 				type: 'success',
		// 				message: response,
		// 			});

		// 			ListsIndex.getList().load();
		// 		}
		// 	});
		// });

		

		$('.copy-list-button').on('click', function(e) {
			e.preventDefault();			
			var url = $(this).attr('href');

			ListsList.getCopyPopup().load({
				url: url
			});
		});
	</script>
	
@elseif (!empty(request()->keyword))
	<div class="empty-list">
		<span class="material-icons-outlined">
			auto_awesome
		</span>
		<span class="line-1">
			{{ trans('messages.no_search_result') }}
		</span>
	</div>
@else
	<div class="empty-list">
		<span class="material-icons-outlined">
			auto_awesome
		</span>
		<span class="line-1">
			{{ trans('messages.list_empty_line_1') }}
		</span>
		<span class="line-2">
			{{ trans('messages.list_empty_line_2') }}
		</span>
	</div>
@endif
