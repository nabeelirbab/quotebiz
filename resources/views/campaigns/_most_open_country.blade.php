<h3 class="mt-5 mb-3"><span class="material-icons-outlined me-2">
    drafts
    </span> {{ trans('messages.top_country_by_opens') }}</h3>
<div class="row">
    <div class="col-md-6">
        @if (!$campaign->uniqueOpenCount())
            <div class="empty-chart-pie">
                <div class="empty-list">
                    <span class="material-icons-outlined">
auto_awesome
</span>
                    <span class="line-1">
                        {{ trans('messages.log_empty_line_1') }}
                    </span>
                </div>
            </div>
        @else
            <div class="stat-table">
                @foreach ($campaign->topCountries(7)->get() as $location)
                    <div class="stat-row">
                        <p class="">
                            <img class="flag-icon" src="{{ url($location->getFlagPath()) }}" />
                            {{ $location->getCountryName() }}
                        </p>
                        <span class="pull-right num">
                            {{ $location->aggregate }}
                        </span>
                    </div>
                @endforeach 
            </div>
            <div class="text-end">
                <a href="{{ action('CampaignController@openMap', $campaign->uid) }}" class="btn btn-info bg-teal-600">{{ trans('messages.open_map') }} <span class="material-icons-round">
arrow_forward
</span></a>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        @if ($campaign->uniqueOpenCount())
            <div class="border p-3 shadow-sm rounded">
                <div class="">
                    <div class="chart-container has-scroll">
                        <div class="chart has-fixed-height"
                            id="OpenPieChart" 
                            style="width:100%; height:350px;"
                            data-url="{{ action('CampaignController@chartCountry', $campaign->uid) }}">
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                $(function() {
                    OpenPieChart.showChart();
                });
                var OpenPieChart = {
                    url: '{{ action('CampaignController@chartCountry', $campaign->uid) }}',
                    getChart: function() {
                        return $('#OpenPieChart');
                    },
            
                    showChart: function() {
                        $.ajax({
                            method: "GET",
                            url: this.url,
                        })
                        .done(function( response ) {
                            OpenPieChart.renderChart( response.data );
                        });
                    },
            
                    renderChart: function(data) {
                        // based on prepared DOM, initialize echarts instance
                        var growthChart2 = echarts.init(OpenPieChart.getChart()[0], ECHARTS_THEME);

                        var colors = [
                            '#5cb2b2',
                            '#b25977',
                            '#aab25a',
                            '#5b7bb2',
                            '#555555',
                            '#626eb2',
                            '#81ac8d',
                            '#7d5fb2',
                            '#b26e59'
                        ];
            
                        var cData = data.map(function(item, index) {
                            return {
                                name: item.name,
                                value: item.value,
                                itemStyle: {
                                    color: colors[index],
                                    borderWidth: 1,  borderType: 'solid', borderColor: '#fff'
                                }
                            };
                        });
            
                        var option = {
                            title: {
                                text: '{{ trans('messages.countries') }}',
                                // subtext: '{{ trans('messages.statistics_chart') }}',
                                left: 'center'
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: '{b}: {c} ({d}%)'
                            },
                            legend: {
                                orient: 'vertical',
                                left: 'right',
                            },
                            series: [
                                {
                                    selectedMode: 'single',
                                    type: 'pie',
                                    radius: '70%',
                                    data: cData,
                                    emphasis: {
                                        itemStyle: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    },
                                    label: {
                                        // position: 'inner',
                                        fontSize: 12,
                                        color: ECHARTS_THEME == 'dark' ? '#fff' : null,
                                        formatter: '{b}\n{d}% ({c})',
                                    },
                                }
                            ]
                        };
            
                        // use configuration item and data specified to show chart
                        growthChart2.setOption(option);
                    }
                }    
            </script>
        @else
            <div class="empty-chart-pie">
                <div class="empty-list">
                    <span class="material-icons-outlined">
auto_awesome
</span>
                    <span class="line-1">
                        {{ trans('messages.log_empty_line_1') }}
                    </span>
                </div>
            </div>
        @endif
    </div>                
</div>