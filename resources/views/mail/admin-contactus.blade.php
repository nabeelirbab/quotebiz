@component('mail::message')
# 
<p style="font-family: DM Sans, sans-serif;"> Hello Admin, </p>
<p style="font-size: 17px; margin: 0; font-family: DM Sans, sans-serif;">
    A new message has been submitted through the contact form. Below are the details:

  <br><br>

  <strong>First Name:</strong> {{ $maildata['first_name'] }}  <br>
  <strong>Last Name:</strong> {{ $maildata['last_name'] }}  <br>
  <strong>Email:</strong> {{ $maildata['email'] }}  <br>
  <strong>Message:</strong> {!! $maildata['message'] !!}

  <br>

  Please review the message and respond accordingly.

  <br>

  <p style="font-size: 17px; margin: 0; font-family: DM Sans, sans-serif;">Best Regards,<br>
      {{ \Acelle\Model\Setting::get('site_name') }}
  </p>
</p>

@endcomponent
