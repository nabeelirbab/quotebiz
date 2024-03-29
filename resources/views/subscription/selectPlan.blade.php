@extends('layouts.core.frontend_dark')

@section('title', trans('messages.subscriptions'))

@section('head')
    <script type="text/javascript" src="{{ URL::asset('core/js/group-manager.js') }}"></script>
@endsection

@section('menu_title')
    @include('subscription._title')
@endsection

@section('menu_right')
    @include('layouts.core._top_activity_log')
    @include('layouts.core._menu_frontend_user')
@endsection

@section('content')    
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">{{ trans('messages.subscription.choose_a_plan') }}</h2>
                @if ($subscription)
                    @include('elements._notification', [
                        'level' => 'warning',
                        'message' => trans('messages.subscription.ended_intro', [
                            'ended_at' => Acelle\Library\Tool::formatDate($subscription->ends_at),
                            'plan' => $subscription->plan->name,
                        ])
                    ])
                    
                    <p>{{ trans('messages.select_plan.wording') }}</p>
                @else
                    @include('elements._notification', [
                        'level' => 'warning',
                        'message' => trans('messages.no_plan.title')
                    ])
        
                    <p>{{ trans('messages.select_plan.wording') }}</p>
                @endif
                
                @if (empty($plans))
                    <div class="row">
                        <div class="col-md-6">
                            @include('elements._notification', [
                                'level' => 'danger',
                                'message' => trans('messages.plan.no_available_plan')
                            ])
                        </div>
                    </div>
                @else
                    <div class="new-price-box" style="margin-right: -30px">
                        <div class="">

                            @foreach ($plans as $key => $plan)
                                <div
                                    data-url="{{ url('admin/account/subscription/order-box?plan_uid='.$plan->uid) }}"
                                    class="new-price-item mb-3 d-inline-block plan-item
                                        {{ $subscription && $subscription->plan->id == $plan->id ? 'current' : '' }}
                                    "
                                    style="width: calc(25% - 20px)">
                                    <div style="height: 100px">
                                        <div class="price">
                                            {!! format_price($plan->price, $plan->currency->format, true) !!}
                                            <span class="p-currency-code">{{ $plan->currency->code }}</span>
                                        </div>
                                        <p><span class="material-icons-outlined text-muted2">
                                            restore
                                            </span> {{ $plan->displayFrequencyTime() }}</p>
                                    </div>
                                    <hr class="mb-2" style="width: 40px">
                                    <div style="height: 40px">
                                        <label class="plan-title fs-5 fw-600 mt-0">{{ $plan->name }}</label>
                                    </div>

                                    <div style="height: 130px">
                                        <p class="mt-4">{{ $plan->description }}</p>
                                    </div>

                                    <span class="time-box d-block text-center small py-2 fw-600">
                                        <div class="mb-1">
                                            <!-- <span>{{ $plan->displayTotalQuota() }} {{ trans('messages.sending_total_quota_label') }}</span> -->
                                        </div>
                                        <div>
                                            <!-- <span>{{ $plan->displayMaxSubscriber() }} {{ trans('messages.contacts') }}</span> -->
                                        </div>
                                    </span>

                                    <a
                                        link-method="POST"
                                        href="{{ url('admin/account/subscription/init?plan_uid='.$plan->uid) }}"
                                        class="btn btn-primary rounded-3 d-block mt-4 shadow-sm">
                                            {{ trans('messages.plan.select') }}
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        var SubscriptionSelectPlan = {
            // orderBox: null,

            // getOrderBox: function() {
            //     if (this.orderBox == null) {
            //         this.orderBox = new Box($('.order-box'), '{{ url('account/subscription/order-box') }}');
            //     }
            //     return this.orderBox;
            // }
        }

        $(function() {
            // SubscriptionSelectPlan.getOrderBox().load();

            var manager = new GroupManager();
            $('.plan-item').each(function() {
                manager.add({
                    box: $(this),
                    url: $(this).attr('data-url')
                });
            });

            manager.bind(function(group, others) {
                group.box.on('click', function() {
                    group.box.addClass('current');

                    others.forEach(function(other) {
                        other.box.removeClass('current');
                    });

                    // load order
                    // SubscriptionSelectPlan.getOrderBox().load(group.url);
                })
            });
        });
    </script>
@endsection