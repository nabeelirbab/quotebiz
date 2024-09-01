	<!-- Contact us -->
<div class="modal fade" id="contactus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Contact Us</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
	<div class="error-body"></div>
	<form action="{{ url('contactus') }}" method="post" id="contactform">
		 @csrf
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
             <label class="form-control-placeholder" for="search">First Name</label>
             <input type="text" name="first_name" class="form-control" required="">
            </div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
             <label class="form-control-placeholder" for="search">Last Name</label>
             <input type="text" name="last_name" class="form-control" required="">
            </div>
		</div>
		<div class="col-md-12 mt-2">
			<div class="form-group">
		     <label class="form-control-placeholder" for="search">Email</label>
		     <input type="email" name="email_address" class="form-control" required="">
		    </div>
		</div>

		<div class="col-md-12 mt-2">
			<div class="form-group">
		     <label class="form-control-placeholder" for="search">Message</label>
		     <textarea class="form-control" name="message" cols="40" rows="40" style="min-height: 215px" required></textarea>
		    </div>
		</div>	
	       <div class="col-md-12 mt-2">
                @php
                    // Generate two random numbers
                    $digit1 = rand(1, 9);
                    $digit2 = rand(1, 9);
                @endphp
                <label for="captcha">What is {{ $digit1 }} + {{ $digit2 }}?</label>
                <input type="text" name="captcha" class="form-control" required="">
                <input type="hidden" name="digit1" value="{{ $digit1 }}">
                <input type="hidden" name="digit2" value="{{ $digit2 }}">
                @if ($errors->has('captcha'))
                    <div class="text-danger">{{ $errors->first('captcha') }}</div>
                @endif
            </div>
	</div>
	<div class="mt-5 text-center">
		<button type="submit" class="btn btn-primary">Send Message</button>
	</div>
	</form>

</div>
</div>
</div>
</div>

	<!-- Terms Modal -->
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Terms of Service</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
@if($job_design && $job_design->terms)
<textarea  style="border: none; background:none; color:  #222222;width: 100%; min-height: 58vh;" disabled>{!! $job_design->terms !!}</textarea>
@else
<textarea  style="border: none; background:none; color:  #222222;width: 100%; min-height: 58vh;" disabled>
a. Our website is intended for use by individuals over the age of 18. If you are under the age of 18, you must have parental consent to use our services.
b. You are responsible for providing accurate and up-to-date information when registering for our services.
c. You must not use our website for any illegal or unauthorized purposes.

Payment and Refunds:
a. We accept payment through the methods listed on our website.
b. All payments are non-refundable unless otherwise stated.
c. We reserve the right to change our pricing and payment terms at any time.

Intellectual Property:
a. All content on our website is protected by copyright and other intellectual property laws.
b. You may not use any content from our website without our express written permission.

User Conduct:
a. You must not use our website to harass, bully, or defame others.
b. You must not use our website to post or distribute spam, viruses, or other malicious content.
c. You must not use our website to collect personal information from others without their consent.

Termination:
a. We reserve the right to terminate your access to our website at any time and for any reason.
b. Upon termination, you will no longer have access to our website or any of its content.

Disclaimer:
a. We make no guarantees or warranties about the accuracy, reliability, or completeness of the content on our website.
b. We are not responsible for any errors or omissions on our website.
c. We are not liable for any damages or losses that may result from your use of our website.

Governing Law:
a. These terms and conditions are governed by the laws of [insert state/country].
b. Any disputes arising from your use of our website will be resolved in accordance with the laws of [insert state/country].
</textarea>
@endif
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- Privacy Modal -->
<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
@if($job_design && $job_design->privacy_policy)
<textarea  style="border: none; background:none; color:  #222222;width: 100%; min-height: 58vh;" disabled>{!! $job_design->privacy_policy !!}</textarea>
@else
<textarea  style="border: none; background:none; color:  #222222;width: 100%; min-height: 58vh;" disabled>We are committed to protecting your privacy. This Privacy Policy outlines how we collect, use, and safeguard your personal information when you use our enquiry quote form or interact with our website.

 1. Information We Collect:

When you use our enquiry quote form, we may collect the following types of information:

Personal Information: This includes your name, email address, phone number, and any other details you provide when submitting an enquiry.

Usage Data: We may collect information about your interaction with our website, including your IP address, browser type, pages visited, and the time and date of your visit.

 1. How We Use Your Information:

We use the information collected to:

Respond to your enquiries and provide you with the requested information or services.

Improve our website and services based on your feedback and usage patterns.

Send you relevant updates, promotions, or newsletters if you have opted in to receive such communications.

 1. Data Security:

We take the security of your information seriously. We implement industry-standard measures to protect your data from unauthorized access, alteration, disclosure, or destruction.

Sharing Your Information:

We do not sell, trade, or rent your personal information to third parties. However, we may share your information with trusted service providers or partners who assist us in delivering our services. These entities are contractually bound to maintain the confidentiality and security of your data.

 1. Your Choices:

You have the right to:

Access and update your personal information.

Opt-out of receiving promotional emails from us.

Request the deletion of your data, subject to legal obligations.

 1. Changes to this Policy:

We may update this Privacy Policy to reflect changes in our practices or for legal reasons. We encourage you to review this policy periodically.

 1. Contact Us:

If you have any questions or concerns about our Privacy Policy or how we handle your data, please contact us.

By using our enquiry quote form or interacting with our website, you agree to the terms outlined in this Privacy Policy.
</textarea>
@endif
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>

</div>