@component('mail::message')
# Introduction

The body of your message.

<a href="{{url('users/register?invite=invited')}}" style="font-size:16px;font-family:'Lato',Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:block;text-align:center;background-color:#48a7fe" >
Create Account
</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
