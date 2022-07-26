<script>
    @if (
        is_object(\Auth::user()->customer) &&
        \Auth::user()->customer->getOption("sending_server_option") == \Acelle\Model\Plan::SENDING_SERVER_OPTION_OWN &&
        !\Auth::user()->customer->activeSendingServers()->count()
    )
        notify({
            type: 'warning',
            message: `{!! trans('messages.not_have_any_customer_sending_server', [
                'link' => url('sending_servers/select'),
            ]) !!}`,
            timeout: false,
        });
    @endif

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