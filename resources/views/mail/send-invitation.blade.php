@component('mail::message')
#  Hi {{$maildata['name']}}
{{ \Acelle\Model\Setting::get('site_name') }} would like to invite you to join their quote business network. <br>
To accept the invitation, simply click the link below: 
<br>
<a href="{{url('users/register?invite='.$maildata['code'])}}" style="font-size:16px;font-family:'Lato',Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:block;text-align:center;background-color:#48a7fe;width: 32%;margin-top: 12px" >
Accept Invitation
</a>
<br>
Thanks,<br>
{{ \Acelle\Model\Setting::get('site_name') }}
@endcomponent
