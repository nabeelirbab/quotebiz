
<div class="headbar d-flex">
    <div class="me-auto"></div>
    @if(config('app.brand'))
        <div class="me-2">
            <a class="open-site-top-menu xtooltip" title="{{ trans('messages.open_website') }}" target="_blank" href="{{ config('wordpress.url') }}">
                <span class="material-icons-outlined">public</span>
            </a>
        </div>
    @endif
    <div class="top-search-container"></div>
</div>

<script>
    $(function() {
        TopSearchBar.init({
            container: $('.top-search-container'),
            sections: [
                new SearchSection({
                    url: '{{ url('search/general') }}',
                }),
                new SearchSection({
                    url: '{{ url('search/campaigns') }}',
                }),
                new SearchSection({
                    url: '{{ url('search/lists') }}',
                }),
                new SearchSection({
                    url: '{{ url('search/subscribers') }}',
                }),
                new SearchSection({
                    url: '{{ url('search/automations') }}',
                }),
                new SearchSection({
                    url: '{{ url('search/templates') }}',
                })
            ],
            lang: {
                no_keyword: `{!! trans('messages.search.type_to_search.wording') !!}`,
                empty_result: `{!! trans('messages.search.empty_result') !!}`,
                tooltip: `{!! trans('messages.click_open_app_search') !!}`,
            }
        });
    });
</script>