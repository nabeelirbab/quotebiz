@component('mail::message')
# 
<h3>Hi {{$maildata['user']->first_name}} {{$maildata['user']->last_name}}</h3>


<p style="font-size: 18px; margin: 0">
	Your job post in Quotebiz. We occasionally need to follow up and verify the request to ensure quality responses.
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
