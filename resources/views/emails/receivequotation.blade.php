@component('mail::message')

<h3>Hi {{$maildata['user']->first_name}} {{$maildata['user']->last_name}}</h3>


<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
	Your job post in Quotebiz. We occasionally need to follow up and verify the request to ensure quality responses.
</p>

Thanks,<br>
{{ \Acelle\Model\Setting::get('site_name') }}
@endcomponent
