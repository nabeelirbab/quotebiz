<script>
    

    @if (is_object(\Auth::user()->customer) &&
        !is_object(\Auth::user()->customer->subscription)
    )
        notify({
            type: 'warning',
            message: `{!! trans('messages.not_have_any_plan_notification', [
                'link' => url('account/subscription'),
            ]) !!}`,
            timeout: false,
        });
    @endif
</script>