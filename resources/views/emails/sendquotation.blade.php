@component('mail::message')
# 
<p style="font-family: DM Sans, sans-serif;">Hi {{$maildata['user']->first_name}},</p>


<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
	Your quote has been sent to the customer. They will get in touch with you via the messaging app on the platform.
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
All the best!
</p>

<br>
{{ \Acelle\Model\Setting::get('site_name') }}
@endcomponent
