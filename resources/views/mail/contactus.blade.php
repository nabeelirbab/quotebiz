@component('mail::message')
# 
<p style="font-family: DM Sans, sans-serif;"> Hi {{$maildata['first_name']}}, </p>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
Thank you for reaching out to us. We appreciate your interest and would like to assure you that we have received your inquiry. Our team will review your message promptly and get back to you as soon as possible.

<br>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">
Once again, thank you for considering {{ \Acelle\Model\Setting::get('site_name') }}. We look forward to assisting you. 
</p>
<br>
<p style="font-size: 17px;margin: 0;font-family: DM Sans, sans-serif;">Best Regards,<br>
{{ \Acelle\Model\Setting::get('site_name') }} </p>
@endcomponent
