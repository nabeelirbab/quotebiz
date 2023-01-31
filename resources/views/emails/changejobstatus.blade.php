@component('mail::message')
<h3 style="font-family: DM Sans, sans-serif;">Hi {{$maildata['user']->first_name}},</h3>
@if($maildata['status'] == 'won')
<p style="font-family: DM Sans, sans-serif;">Your quote has been accepted</p> <br>
<p style="font-family: DM Sans, sans-serif;">Your Quote:</p>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;line-height: 24px;background-color: #f2f7f2;">
    	{!! $maildata['quote'] !!}
</p>
@elseif($maildata['status'] == 'done')
<p style="font-family: DM Sans, sans-serif;">Job is Done </p><br>
<p style="font-family: DM Sans, sans-serif;">Your Quote:</p>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;line-height: 24px;background-color: #f2f7f2;">
    	{!! $maildata['quote'] !!}
</p>
@endif

<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">Regards,<br>
{{ \Acelle\Model\Setting::get('site_name') }} </p>
@endcomponent
