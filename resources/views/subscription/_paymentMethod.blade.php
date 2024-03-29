<div class="card mt-2 subscription-step">
    @if (($invoice ?? false) && $invoice->hasBillingInformation())
        <a href="{{ url('admin/account/subscription/payment/'.$invoice->uid) }}"
        class="card-header py-3 select-plan-tab">
            <div class="d-flex align-items-center">
                <div class="me-3"><label class="subscription-step-number bg-secondary">3</label></div>
                <div>
                    <h5 class="fw-600 mb-0 fs-6 text-start">
                        {{ trans('messages.subscription.payment_method.title') }}
                    </h5>
                    <p class="m-0 text-muted">{{ trans('messages.subscription.payment_method.subtitle') }}</p>
                </div>
                <div class="ms-auto">
                    <span class="material-icons-outlined fs-4 text-success">
                        task_alt
                        </span>
                </div>
            </div>
        </a>
    @else
        <div class="card-header py-3 select-plan-tab">
            <div class="d-flex align-items-center">
                <div class="me-3"><label class="subscription-step-number bg-secondary">3</label></div>
                <div>
                    <h5 class="fw-600 mb-0 fs-6 text-start">
                        {{ trans('messages.subscription.payment_method.title') }}
                    </h5>
                    <p class="m-0 text-muted">{{ trans('messages.subscription.payment_method.subtitle') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>