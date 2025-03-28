<li class="nav-item dropdown">
	<a href="javascript:;"
		class="nav-link d-flex align-items-center py-3 lvl-1 dropdown-toggle activities-menu-item middle-bar-element"
		id="content-menu"
	>
		<i class="navbar-icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 109.3 94.4"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><path d="M62.2,94.4a45.3,45.3,0,0,1-5.2-.3,48.1,48.1,0,0,1-18.1-5.8,3.5,3.5,0,0,1-1.3-4.8,3.3,3.3,0,0,1,4.7-1.3A40.2,40.2,0,1,0,22.2,42.8a3.6,3.6,0,0,1-3.9,3.1A3.5,3.5,0,0,1,15.2,42a47.2,47.2,0,1,1,47,52.4Z" style="fill:#f2f2f2"/><polygon points="38.6 33.3 24.8 69.9 0 39.7 38.6 33.3" style="fill:#f2f2f2"/><path d="M84.2,63.8a3.3,3.3,0,0,1-1.7-.4L60.4,51.2a3.5,3.5,0,0,1-1.8-3.1V29a3.5,3.5,0,1,1,7,0V46.1L85.9,57.3A3.5,3.5,0,0,1,87.3,62,3.6,3.6,0,0,1,84.2,63.8Z" style="fill:#ffadad"/></g></g></g></g></svg>
		</i>
		<span class="leftbar-item">{{ trans('messages.activities') }}</span>
	</a>
</li>

<script>
	var sidebar;

	$(function() {
		$('.activities-menu-item').on('click', function() {
			var sidebar = new Sidebar();
			if(!sidebar.showed()) {
				sidebar.load({
					url: '{{ url('admin/account/activity') }}'
				});
			} else {
				sidebar.hide();
			}
		});
	});
</script>