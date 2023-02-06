@component('mail::message')
# 
<p style="font-family: DM Sans, sans-serif;"> Hi {{$maildata['name']}}, </p>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
{{ \Acelle\Model\Setting::get('site_name') }} would like to invite you to join their quote business network. You can subscribe to notifications about job opportunities that come through our system and provide a quote if you'd like the job. 
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
A maximum of 3 service providers are able to quote each job, so it pays to act quickly.
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
You get {{$maildata['credits']}} free credits when you sign up! 
</p>
<br>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
To accept the invitation, simply click the link below: 
</p>
<br>
<a href="{{url('users/register?invite='.$maildata['code'])}}" style="font-size:16px;font-family: DM Sans, sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:block;text-align:center;background-color:#48a7fe;width: 32%;margin-top: 12px" >
Accept Invitation
</a>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">Regards,<br>
{{ \Acelle\Model\Setting::get('site_name') }} </p>
@endcomponent
