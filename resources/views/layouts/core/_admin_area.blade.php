@if (null !== Session::get('orig_customer_id') && Auth::user()->customer)
    <a href="{{ url('customers/admin-area') }}" class="user-switch-area mc-modal-control">
        {{ trans('messages.customer.admin_area') }}
    </a>
    <script>
        var AdminAreaPopup;

        $(function() {
            $('.user-switch-area').on('click', function(e) {
                e.preventDefault();
                AdminAreaPopup = new Popup({
                    url: '{{ url('customers/admin-area') }}',
                });

                AdminAreaPopup.load();
            });
        });
            
    </script>
@endif