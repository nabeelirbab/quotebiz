@component('mail::message')
<h3>Hi {{$maildata['user']->first_name}} {{$maildata['user']->last_name}}</h3>

The body of your message.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
