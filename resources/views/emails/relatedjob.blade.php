
<?php 
  $admindetail =  Acelle\Jobs\HelperJob::admindetail();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="font-family: DM Sans, sans-serif !important;">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
	<td bgcolor="#f4f4f4" align="center">
		<table border="0" cellpadding="0" cellspacing="0" width="600" class="m_-8167979757003078776wrapper">
			<tbody>
				<tr>
					<td align="center" valign="top" style="padding:20px 10px">
						<a href="" >
						   <img alt="Quotebiz.io" src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark')) }}" width="105" height="30" style="display:block;width:105px;max-width:105px;min-width:105px;font-family:DM Sans, sans-serif;color:#ffffff;font-size:18px" border="0" class="CToWUd">
						</a>
					    <img src="https://ci5.googleusercontent.com/proxy/a70bhQBaRzSsThqCxZj5fkzkvRW7aIlrCbOo5x0_EcQXEaHqa5sBvLuVN36Q6TYm5IuUehVDUABxq7ZlxZ8xigEWS9_JaDI=s0-d-e1-ft#https://www.bark.com/img_temp/4314881479/tracker.jpg" alt="Bark.com" width="1" height="1" class="CToWUd">
					</td>
			</tr>
			</tbody>
		</table>
	</td>
</tr>


<tr>
<td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">
<table border="0" cellpadding="0" cellspacing="0" width="600" class="m_-8167979757003078776wrapper">
<tbody>

<tr>
<td bgcolor="#d9edf7" align="left" style="padding:10px 30px;color:#31708f;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px;border-bottom:1px solid #bce8f1">
<p style="margin:0">
New Customer Alert
</p>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 30px;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>


<tr>
<td align="left" valign="top" style="font-size:0">


<div style="display:block;vertical-align:top;width:100%;margin-bottom:20px">
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
	<tr>
<td align="left" style="color:#3a4449;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:30px">{{$maildata['jobdetail']->user->first_name}} needs a {{ $maildata['jobdetail']->category->category_name }}</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>


<tr>
<td align="left" valign="top" style="font-size:0">

<div style="display:inline-block;max-width:310px;vertical-align:top;width:100%;margin-bottom:20px">
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td style="padding:0px 0 0">

<table border="0" cellspacing="0" cellpadding="0" width="100%">

<tbody>
	@if($maildata['jobdetail']->additional_info)
	<tr>
    <td align="left" style="color:#61696d;font-family:DM Sans, sans-serif;font-size:16px;font-weight:400;line-height:30px;padding:0 10px 3px 0">
      "{{$maildata['jobdetail']->additional_info}}"
    </td>
  </tr>
  @endif
<tr>
	<td align="left" style="color:#61696d;font-family:DM Sans, sans-serif;font-size:16px;font-weight:400;line-height:30px;padding:0 0 3px"><img src="{{ asset('frontend-assets/images/email/location.png') }}" width="12" height="16" style="margin-left:2px;margin-right:11px;vertical-align:middle" alt="Location" class="CToWUd">@if($maildata['userType'] == 'state') Statewide @elseif($maildata['userType'] == 'country') Countrywide @endif<br><div style="font-size:13px;color:#a4a4a4;padding-left:28px">@if($maildata['userType'] == 'local business') This person prefers a local business @else Happy to receive service online or remotely  @endif</div>
	</td>
</tr>

<tr>
<td align="left" style="color:#61696d;font-family:DM Sans, sans-serif;font-size:16px;font-weight:400;line-height:30px;padding:0 0 3px"><table border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
<td style="color:#61696d;font-family:DM Sans, sans-serif;font-size:16px;font-weight:400;line-height:30px"><img src="{{ asset('frontend-assets/images/email/phone.png') }}" width="14" height="14" style="margin-left:2px;margin-right:13px;vertical-align:middle" alt="Phone" class="CToWUd">{{Acelle\Jobs\HelperJob::hide_mobile_no($maildata['jobdetail']->user->mobileno)}}</td>

<td>
<div style="line-height:1.5;text-align:left;background-color:#f3f3f6!important;border-radius:50px;padding-left:8px!important;padding-right:8px!important;color:#47bf9c!important;font-size:12px;margin-left:10px"><img src="{{ asset('frontend-assets/images/email/green.png') }}" width="12" height="12" style="margin-bottom:2px;vertical-align:middle" alt="Phone" class="CToWUd"> Verified</div>
</td>

</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td align="left" style="color:#61696d;font-family:DM Sans, sans-serif;font-size:16px;font-weight:400;line-height:30px;padding:0 0 3px"><img src="{{ asset('frontend-assets/images/email/envelope.png') }}" width="16" height="12" style="margin-left:2px;margin-right:6px;vertical-align:middle" alt="Email" class="CToWUd"> <a rel="nofollow" href="#m_-8167979757003078776_" style="text-decoration:none;color:inherit">{{Acelle\Jobs\HelperJob::mask_email($maildata['jobdetail']->user->email)}}</a> </td>

</tr>


<!-- <tr>
<td align="left" style="line-height:30px;padding:0 0 3px">
<p style="margin:0;padding:0;color:#61696d;font-family:DM Sans, sans-serif;font-size:16px;font-weight:400">
<img src="https://ci5.googleusercontent.com/proxy/OL5RgsLd8vY2XNi0-5joSW7pzdKX8R6aXqiKuzGYhG90k8wmte03bRfrflO2a4VfObgHScv6mX5Z7GZarvIFFyo3YeMAucKOaVp9fA=s0-d-e1-ft#https://d18jakcjgoan9.cloudfront.net/img/bark-coins-1.png" width="20" height="20" style="margin-right:1px;vertical-align:middle" alt="Credits" class="CToWUd"> 27 credits to respond
</p>
</td>
</tr> -->

<!-- <tr>
<td align="left"><img src="https://ci3.googleusercontent.com/proxy/cgC82gh5pP9UXc1AWapr-VMl4ewHp0Z5JFzL4W-l4yXBI5cflpnkRBdBHgR660jP9HWPS7f3W3KlAcNSmwISjg=s0-d-e1-ft#https://www.bark.com/rc/16958276/21973738.png" width="300" height="40" alt="Enable images to see live response information" class="CToWUd"></td>
</tr> -->

</tbody></table>
</td>
</tr>
</tbody></table>
</div>

<div style="display:inline-block;max-width:220px;vertical-align:top;width:100%;margin-bottom:20px">
<table align="right" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td valign="top">
<div id=":5ri" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
</td>
</tr>
</tbody>
</table>
</div>

</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="left" valign="middle" style="padding:0px 0px 0;color:#111111;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<a href="{{url('/service-provider/quotes-leads')}}" style="font-size:16px;font-family:DM Sans, sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:block;text-align:center;background-color:#48a7fe" >
Contact {{$maildata['jobdetail']->user->first_name}} Now
</a>
</td>
</tr>


<tr>
<td bgcolor="#ffffff" align="left" style="text-align:center;padding:20px 0px 0;color:#888888;font-family:DM Sans, sans-serif;font-size:17px;font-weight:400;line-height:25px">
Let {{$maildata['jobdetail']->user->first_name}} know you're interested and receive their contact details.
</td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>



<tr>
<td bgcolor="#f4f4f4" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="600" height="20" class="m_-8167979757003078776wrapper">

<tbody><tr>
<td bgcolor="#f4f4f4" align="center"></td>
</tr>
</tbody></table>
</td>
</tr>



<tr>
<td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">
<table border="0" cellpadding="0" cellspacing="0" width="600" class="m_-8167979757003078776wrapper">
<tbody>

<tr>
<td bgcolor="#d9edf7" align="left" style="padding:10px 30px;color:#31708f;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px;border-bottom:1px solid #bce8f1">
<p style="margin:0">
Quote Details
</p>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 30px;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
@foreach($maildata['jobdetail']->questionsget as $questions)
<tr>
<td bgcolor="#ffffff" align="left" style="padding:0px 0px 0;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<p style="margin:0">{{$questions->questions->question}}?</p>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="left" style="padding:5px 0px 20px;color:#3a4449;font-family:DM Sans, sans-serif;font-size:18px;font-weight:bold;line-height:25px">
	@foreach($questions->choice as $choices)
    <p style="margin:0">{{$choices->choice_value}}</p>
     @endforeach
</td>
</tr>
@endforeach

@if($maildata['jobdetail']->additional_info)
	<tr>
	<td bgcolor="#ffffff" align="left" style="padding:0px 0px 0;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
	<p style="margin:0">Additional Details</p>
	</td>
	</tr>
	<tr>
	<td bgcolor="#ffffff" align="left" style="padding:5px 0px 20px;color:#3a4449;font-family:DM Sans, sans-serif;font-size:18px;font-weight:bold;line-height:25px">
		
	    <p style="margin:0">{{$maildata['jobdetail']->additional_info}}</p>
	     
	</td>
	</tr>
@endif

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>

<tr>
<td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">
<table border="0" cellpadding="0" cellspacing="0" width="600" class="m_-8167979757003078776wrapper">
<tbody>


<tr>
<td bgcolor="#ffffff" align="left" style="padding:0px 30px 30px;color:#111111;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<a href="{{url('/service-provider/quotes-leads')}}" style="font-size:16px;font-family:DM Sans, sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:inline-block;background-color:#48a7fe" >Contact {{$maildata['jobdetail']->user->first_name}} Now</a>
</td>
</tr>


</tbody>
</table>
</td>
</tr>


<tr>
<td bgcolor="#f4f4f4" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="600" height="20" class="m_-8167979757003078776wrapper">

<tbody><tr>
<td bgcolor="#f4f4f4" align="center"></td>
</tr>
</tbody></table>
</td>
</tr>

<tr>
<td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">
<table border="0" cellpadding="0" cellspacing="0" width="600" class="m_-8167979757003078776wrapper">
<tbody>

<tr>
<td bgcolor="#d9edf7" align="left" style="padding:10px 30px;color:#31708f;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px;border-bottom:1px solid #bce8f1">
<p style="margin:0">
How do I get started?
</p>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 30px;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>



<tr>
<td bgcolor="#ffffff" align="left" style="padding:10px 0px 0;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<p style="margin:0">
To contact {{$maildata['jobdetail']->user->first_name}} you’ll need to buy credits.
</p>
</td>
</tr>

<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 0px 0;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<p style="margin:0">
We offer a discounted starter pack with enough credits for about 5 responses.
</p>
</td>
</tr>


<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 0px 0;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<p style="margin:0">
We’re so confident you’ll get hired at least once from your starter pack, that if you don’t we’ll give
you all your credits back.
</p>
</td>
</tr>

<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 0px 0;color:#111111;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<a href="{{url('/service-provider/quotes-leads')}}" style="font-size:16px;font-family:DM Sans, sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;border-radius:3px;padding:10px 15px;border:1px solid #48a7fe;display:inline-block;background-color:#48a7fe" >Contact {{$maildata['jobdetail']->user->first_name}} Now</a>
</td>
</tr>


<tr>
<td bgcolor="#ffffff" align="left" style="padding:20px 0px 0;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<p style="margin:0">If you have any questions email us at ( <a href="mailto:{{$admindetail->email}}" style="color:#48a7fe;text-decoration:underline" target="_blank"><span class="il"> {{$admindetail->email}}</span></a> ).</p>
</td>
</tr>


<tr>
<td bgcolor="#ffffff" align="left" style="padding:30px 0px 0px;color:#61696d;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px">
<p style="margin:0">Regards,</p>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="left" style="padding:10px 0px 30px;color:#3a4449;font-family:DM Sans, sans-serif;font-size:18px;font-weight:400;line-height:25px;font-style:italic">
<p style="margin:0">The <span class="il">{{ \Acelle\Model\Setting::get('site_name') }}</span> Team</p>
</td>
</tr>



</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>         
 <td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">  
     <table border="0" cellpadding="0" cellspacing="0" width="600" class="m_-8167979757003078776wrapper">   <tbody>
    	<tr>
    	<td bgcolor="#f4f4f4" align="center" style="padding:0px 30px 30px 30px;color:#666666;font-family:DM Sans, sans-serif;font-size:14px;font-weight:400;line-height:18px">
    	 <p style="margin:0"><a style="color:#3eaefc" href="{{ url('/') }}"><span class="il">{{ \Acelle\Model\Setting::get('site_name') }}</span></a> {{$admindetail->admin_address}}</p>    
      </td> 
 </tr> 
 </tbody> 
   </table>  
 </td>  
</tr>
</tbody>
</table>


</body>
</html>