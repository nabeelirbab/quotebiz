@component('mail::message')
# 
<h3 style="font-family: DM Sans, sans-serif;">Hi {{$maildata['user']->first_name}},</h3>

<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
Your quote request has been received by the {{ \Acelle\Model\Setting::get('site_name') }} team.
<br> Soon you will receive some quotes provided by professionals servicing your area.
<br>
<br>
If you don't receive enough quotes then don't hesitate to reach out to customer support in your login area as we're always here to help you.
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">Regards,<br>
{{ \Acelle\Model\Setting::get('site_name') }} </p>
@endcomponent
