@component('mail::message')

<p style="font-family: DM Sans, sans-serif;">Hi {{$maildata['user']->first_name}},</p>


<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
{{$maildata['sender']->first_name}} has provided you a quote.
<a href="{{url('customer/inbox')}}" style="font-size:16px;font-family: DM Sans, sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:block;text-align:center;background-color:#48a7fe;width: 47%;margin-top: 12px" >
[Click here to review quote]
</a>
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
You can communicate with service providers on the platform.
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
All the best!
</p>

<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
{{ \Acelle\Model\Setting::get('site_name') }}
</p>
@endcomponent
