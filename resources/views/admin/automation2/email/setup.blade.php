@extends('layouts.popup.large')

@section('content')
        
    @include('automation2.email._tabs', ['tab' => 'setup'])
        
    <h5 class="mb-3">Email Setup</h5>    
    <p>{{ trans('messages.automation.email.setup.intro') }}</p>
    
    <form id="emailSetup" action="{{ action('Admin\Automation2Controller@emailSetup', $automation->uid) }}" method="POST">
        {{ csrf_field() }}
        
        <input type="hidden" name="email_uid" value="{{ $email->uid }}" />
        <input type="hidden" name="action_id" value="{{ $email->action_id }}" />
    
        <div class="row">
            <div class="col-md-6">                                            
                @include('helpers.form_control', ['type' => 'text',
                    'name' => 'subject',
                    'label' => trans('messages.email_subject'),
                    'value' => $email->subject,
                    'rules' => $email->rules(),
                    'help_class' => 'email',
                    'placeholder' => trans('messages.automation.email.subject.placeholder'), 
                ])
                                                
                @include('helpers.form_control', ['type' => 'text',
                    'name' => 'from_name',
                    'label' => trans('messages.from_name'),
                    'value' => $email->from_name,
                    'rules' => $email->rules(),
                    'help_class' => 'email',
                    'placeholder' => trans('messages.automation.email.from_name.placeholder'), 
                ])
                
                @include('helpers.form_control', [
                    'type' => 'autofill',
                    'id' => 'sender_from_input',
                    'name' => 'from_email',
                    'label' => trans('messages.from_email'),
                    'value' => $email->from_email,
                    'rules' => $email->rules(),
                    'help_class' => 'email',
                    'url' => url('senders/dropbox'),
                    'empty' => trans('messages.sender.dropbox.empty'),
                    'error' => trans('messages.sender.dropbox.error.' . Auth::user()->customer->allowUnverifiedFromEmailAddress(), [
                        'sender_link' => url('senders'),
                    ]),
                    'header' => trans('messages.verified_senders'),
                    'placeholder' => trans('messages.automation.email.from.placeholder'), 
                ])
                                                
                @include('helpers.form_control', [
                    'type' => 'autofill',
                    'id' => 'sender_reply_to_input',
                    'name' => 'reply_to',
                    'label' => trans('messages.reply_to'),
                    'value' => $email->reply_to,
                    'url' => url('senders/dropbox'),
                    'rules' => $email->rules(),
                    'help_class' => 'email',
                    'empty' => trans('messages.sender.dropbox.empty'),
                    'error' => trans('messages.sender.dropbox.reply.error.' . Auth::user()->customer->allowUnverifiedFromEmailAddress(), [
                        'sender_link' => url('senders'),
                    ]),
                    'header' => trans('messages.verified_senders'),
                    'placeholder' => trans('messages.automation.email.from.placeholder'), 
                ])
                
            </div>
            <div class="col-md-6 segments-select-box">
                <div class="form-group checkbox-right-switch">
                    @include('helpers.form_control', ['type' => 'checkbox3',
                        'name' => 'track_open',
                        'label' => trans('messages.automation.email.track_open'),
                        'value' => $email->track_open,
                        'options' => [false,true],
                        'help_class' => 'email',
                        'rules' => $email->rules(),
                    ])
                
                    @include('helpers.form_control', ['type' => 'checkbox3',
                        'name' => 'track_click',
                        'label' => trans('messages.automation.email.track_click'),
                        'value' => $email->track_click,
                        'options' => [false,true],
                        'help_class' => 'email',
                        'rules' => $email->rules(),
                    ])
                    
                    @include('helpers.form_control', ['type' => 'checkbox3',
                        'name' => 'sign_dkim',
                        'label' => trans('messages.automation.email.add_sign_dkim'),
                        'value' => $email->sign_dkim,
                        'options' => [false,true],
                        'help_class' => 'email',
                        'rules' => $email->rules(),
                    ])

                    @include('helpers.form_control', [
                        'type' => 'checkbox3',
                        'name' => 'custom_tracking_domain',
                        'label' => trans('messages.custom_tracking_domain'),
                        'value' => $email->tracking_domain_id || request()->custom_tracking_domain,
                        'options' => [false,true],
                        'help_class' => 'email',
                        'rules' => $email->rules()
                    ])

                    <div class="select-tracking-domain">
                        @include('helpers.form_control', [
                            'type' => 'select',
                            'name' => 'tracking_domain_uid',
                            'label' => '',
                            'value' => $email->trackingDomain? $email->trackingDomain->uid : null,
                            'options' => Auth::user()->customer->getVerifiedTrackingDomainOptions(),
                            'include_blank' => trans('messages.automation.email.select_tracking_domain'),
                            'help_class' => 'email',
                            'rules' => $email->rules()
                        ])
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-end mt-5 {{ Auth::user()->customer->allowUnverifiedFromEmailAddress() ? '' : 'unverified_next_but' }}">
            <button class="btn btn-secondary">
                <span class="d-flex align-items-center">
                    <span>{{ trans('messages.email.setup.save_next') }}</span> <i class="material-icons-outlined">keyboard_arrow_right</i>
                </span>
            </button>
        </div>
    </form>
    
    <script>
        function checkUnverified() {
			if(!$('.autofill-error:visible').length) {
				$('.unverified_next_but').removeClass('pointer-events-none');
                $('.unverified_next_but').removeClass('disabled');
			} else {
				$('.unverified_next_but').addClass('pointer-events-none');
                $('.unverified_next_but').addClass('disabled');
			}
		}

        setInterval(function() { checkUnverified() }, 1000);

        // auto fill
        var box = $('#sender_from_input').autofill({
            messages: {
                header_found: '{{ trans('messages.sending_identity') }}',
                header_not_found: '{{ trans('messages.sending_identity.not_found.header') }}'
            }
        });
        box.loadDropbox(function() {
            $('#sender_from_input').focusout();
            box.updateErrorMessage();
        })

        // auto fill 2
        var box2 = $('#sender_reply_to_input').autofill({
            messages: {
                header_found: '{{ trans('messages.sending_identity') }}',
                header_not_found: '{{ trans('messages.sending_identity.reply.not_found.header') }}'
            }
        });
        box2.loadDropbox(function() {
            $('#sender_reply_to_input').focusout();
            box2.updateErrorMessage();
        })
        
        $('#emailSetup').submit(function(e) {
            e.preventDefault();
            
            var form = $(this);
            var url = form.attr('action');
            
            // loading effect
            popup.loading();
            
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
                globalError: false,
                statusCode: {
                    // validate error
                    400: function (res) {
                       popup.loadHtml(res.responseText);
                    }
                 },
                 success: function (response) {
                    popup.load(response.url);
                    
                    // set node title
                    tree.getSelected().setTitle(response.title);
                    // merge options with reponse options
                    tree.getSelected().setOptions($.extend(tree.getSelected().getOptions(), {init: "true"}));
                    tree.getSelected().setOptions($.extend(tree.getSelected().getOptions(), response.options));

                    doSelect(tree.getSelected());

                    // validate
					tree.getSelected().validate();
                    
                    // save tree
					saveData();
                    
                    notify({
    type: 'success',
    title: '{!! trans('messages.notify.success') !!}',
    message: response.message
});
                 }
            });
        });

        $('[name="from_email"]').change(function() {
            $('[name="reply_to"]').val($(this).val()).change();
        });
        $('[name="from_email"]').blur(function() {
            $('[name="reply_to"]').val($(this).val()).change();
        });

        // select custom tracking domain
        $('[name=custom_tracking_domain]').change(function() {
            var value = $('[name=custom_tracking_domain]:checked').val();

            if (value) {
                $('.select-tracking-domain').show();
            } else {
                $('.select-tracking-domain').hide();
            }
        });
        $('[name=custom_tracking_domain]').change();
    </script>
@endsection
