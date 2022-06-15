<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs nav-tabs-top nav-underline">
			<li rel0="Admin\CampaignController/overview" class="nav-item">
				<a href="{{ action('Admin\CampaignController@overview', $campaign->uid) }}" class="nav-link">
					<span class="material-icons-outlined">
auto_graph
</span> {{ trans('messages.overview') }}
				</a>
			</li>
			<li rel0="Admin\CampaignController/links" class="nav-item">
				<a href="{{ action('Admin\CampaignController@links', $campaign->uid) }}" class="nav-link">
					<span class="material-icons-outlined">
link
</span> {{ trans('messages.links') }}
				</a>
			</li>
			<li rel0="Admin\CampaignController/openMap" class="nav-item">
				<a href="{{ action('Admin\CampaignController@openMap', $campaign->uid) }}" class="nav-link">
					<span class="material-icons-outlined">
map
</span> {{ trans('messages.open_map') }}
				</a>
			</li>
			<li rel0="Admin\CampaignController/subscribers" class="nav-item">
				<a href="{{ action('Admin\CampaignController@subscribers', $campaign->uid) }}" class="nav-link">
					<span class="material-icons-round">
people_outline
</span> {{ trans('messages.subscribers') }}
				</a>
			</li>
			<li class="nav-item"
				rel0="Admin\CampaignController/trackingLog"
				rel1="Admin\CampaignController/bounceLog"
				rel2="Admin\CampaignController/feedbackLog"
				rel3="Admin\CampaignController/openLog"
				rel4="Admin\CampaignController/clickLog"
				rel5="Admin\CampaignController/unsubscribeLog"
			>
				<a href="{{ action("AccountController@contact") }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
					<span class="material-icons-outlined">
						article
</span> {{ trans('messages.sending_logs') }}
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li rel0="Admin\CampaignController/trackingLog">
						<a class="dropdown-item" href="{{ action('Admin\CampaignController@trackingLog', $campaign->uid) }}">
							<span class="material-icons-outlined">
								article
</span> {{ trans('messages.tracking_log') }}
						</a>
					</li>
					<li rel0="Admin\CampaignController/bounceLog">
						<a class="dropdown-item" href="{{ action('Admin\CampaignController@bounceLog', $campaign->uid) }}">
							<span class="material-icons-outlined">
								article
</span> {{ trans('messages.bounce_log') }}
						</a>
					</li>
					<li rel0="Admin\CampaignController/feedbackLog">
						<a class="dropdown-item" href="{{ action('Admin\CampaignController@feedbackLog', $campaign->uid) }}">
							<span class="material-icons-outlined">
								article
</span> {{ trans('messages.feedback_log') }}
						</a>
					</li>
					<li rel0="Admin\CampaignController/openLog">
						<a class="dropdown-item" href="{{ action('Admin\CampaignController@openLog', $campaign->uid) }}">
							<span class="material-icons-outlined">
								article
</span> {{ trans('messages.open_log') }}
						</a>
					</li>
					<li rel0="Admin\CampaignController/clickLog">
						<a class="dropdown-item" href="{{ action('Admin\CampaignController@clickLog', $campaign->uid) }}">
							<span class="material-icons-outlined">
								article
</span> {{ trans('messages.click_log') }}
						</a>
					</li>
					<li rel0="Admin\CampaignController/unsubscribeLog">
						<a class="dropdown-item" href="{{ action('Admin\CampaignController@unsubscribeLog', $campaign->uid) }}">
							<span class="material-icons-outlined">
								article
</span> {{ trans('messages.unsubscribe_log') }}
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item" rel0="Admin\CampaignController/templateReview">
				<a href="{{ action('Admin\CampaignController@templateReview', $campaign->uid) }}" class="nav-link">
					<span class="material-icons-outlined">
auto_awesome_mosaic
</span> {{ trans('messages.email_review') }}
				</a>
			</li>
		</ul>
	</div>
</div>

<script>
	var downloaded = false;
	var downloadWindow;

	function goToDownLoad(logtype) {
		downloadWindow = window.open('{{ action('Admin\CampaignController@trackingLogDownload', ['uid' => $campaign->uid]) }}?logtype=' + logtype, '_blank');
	}

	function downloadAndCloseDownloadWindow(downloadUrl) {
		downloadWindow.close();
		window.location.href = downloadUrl;
	}
</script>
