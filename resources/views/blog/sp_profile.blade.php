
<?php
	$data = new stdClass();
	$data->title = $user->first_name . ' ' . $user->last_name;
	if($user->user_img){
        $data->image = asset('frontend-assets/images/users/'.$user->user_img);
	}else{
        $data->image =  action('SettingController@file', \Acelle\Model\Setting::get('site_favicon'));
	}
	$job_design = Acelle\Jobs\HelperJob::form_design(); 
	$sitename = \Acelle\Model\Setting::get("site_name");
  $sitetitle = \Acelle\Model\Setting::get("site_title");
  $sitetagline = \Acelle\Model\Setting::get("site_tagline");
  $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country);
  $job_design = Acelle\Jobs\HelperJob::form_design(); 
?>
@include('blog.header',['post' => $data])
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/ni.css?ver=2.9.1') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
 <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/blog/style.css') }}">
<style type="text/css">

.flatpickr-calendar.inline {
  width: 100%;
  margin-bottom: 15px;
}
.flatpickr-day.selected,.flatpickr-day.selected:hover{
	background: {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
	border-color: {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
}
.col-md-4{
	flex: 0 0 30.333333%;
    max-width: 30.333333%;
}
#seeMoreLink {
	font-weight: bold;
	text-decoration: underline;
	margin-bottom: 5px;
	color: {{ ($job_design) ? $job_design->button_color:'#6200EA'}} !important;
}

h2{
	font-size: 24px;
}
a {
	color: #222222;
}
.box-border{
	border: 1px solid #7977771f;border-radius: 12px;
}

._mnf8sq {
    outline: none !important;
    cursor: pointer !important;
    border: 1px solid rgb(221, 221, 221) !important;
    border-radius: 12px !important;
    box-sizing: border-box !important;
    background: rgb(255, 255, 255) !important;
    margin-bottom: 16px !important;
}
._1141qqg {
    font-size: 16px !important;
    font-weight: 600 !important;
    overflow: hidden !important;
    color: rgb(34, 34, 34) !important;
    text-overflow: ellipsis !important;
}
._mnf8sq:hover {
    background: rgb(247, 247, 247) !important;
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid #e5e9f2;
}
@media screen and (max-width: 667px) {
.col-md-4{
	flex: 0 0 100%;
    max-width: 100%;
}
._mnf8sq{
	height: 70px;
	display: flex;
    align-items: center;
}
.svgcenter{
  width: 30%;
}

._1141qqg{
  width: 70%;
}
.text-sm-center{
	text-align: center;
}
.body-padding{
	padding: 15px;
}
}
</style>
<section style="border-top: 1px solid #c9c9c9; background-color: #f7f8fa ">

	<div class="container mt-5" style="width: 93%">
		<div class="row">
			<div class="col-md-4">
			 <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="text-center mt-4">
                	@if($user->user_img)
                    <img src="{{asset('frontend-assets/images/users/'.$user->user_img)}}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                	@else
                    <img src="{{asset('frontend-assets/images/avt.jpeg')}}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                    @endif
                </div>
                <div class="card-body pt-0">
                	  <p class="card-text text-center mb-5">
                      @foreach(json_decode($user->category_id) as $key => $cat)
                       @if(\Acelle\Jobs\HelperJob::categoryDetail($cat)->cat_parent_id == 0)
                        <span class="data-value badge badge-pill badge-info">
                        	 {{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                        @if ($key < count(json_decode($user->category_id)) - 1)
                             
                        @endif
                        @endif
                    @endforeach
                    </p>
                    <h5 class="card-title text-center mb-0" style="line-height: 0.4">{{$user->first_name}} {{$user->last_name}}</h5>
                 <div class="mb-4">
                    @if($job_design->business_name == 'yes' && $user->business->business_name)
                    <p class="card-text text-center mb-5">
                       <span class="data-value badge badge-pill badge-info" style="background-color: #364a63 !important;border-color: #364a63 !important;">
                    	{{ $user->business->business_name }}
                       </span>
                    </p>
                </div>
                    @endif
                    @if( $user->business->business_website ||  $user->business->business_phone || $user->business->business_website )
                    <div class="mb-4">
                  <hr>
                     @if($job_design->business_number == 'yes' && $user->business->business_phone)
                    <p class="card-text text-center mt-4 mb-0" style="font-size: 14px;">
                    	 <em class="icon ni ni-call"></em><span> <a href="tel:{{ $user->business->business_phone }}">{{ $user->business->business_phone }}</a></span>
                    </p>
                    @endif
                    @if($job_design->business_email == 'yes' && $user->business->business_email)
                    <p class="card-text text-center mb-0" style="font-size: 14px;">
                    	<em class="icon ni ni-mail"></em><span> <a href="mailto:{{ $user->business->business_email }}">Send Email</a></span>
                    </p>
                    @endif
                   
                    @if($job_design->business_website == 'yes' && $user->business->business_website)
                    <p class="card-text text-center mb-0" style="font-size: 14px;">
                    	<em class="icon ni ni-globe"></em><span><a href="{{ $user->business->business_website }}" target="_blank"> {{ $user->business->business_website }}</a></span>
                    </p>
                    @endif
                  </div>
                  <hr>
                   @endif
                    <h4 class="text-center mt-5 mb-2"> {{ ($job_design) ? $job_design->event_text : 'What is the date of your event?'}}</h4>
                    <div id="calendar"></div>
                    <div class=" text-center">
                      <button class="btn btn-success" data-toggle="modal" data-target="#quoteModal">Request A Quote</button>
                    </div>
                </div>
            </div>
            <p class="text-center" style="cursor: pointer; margin-top: 100px; font-weight: bold" data-toggle="modal" data-target="#shareModal"><img src="{{ asset('images/share_Icon.svg') }}" style="width: 5%;" class="mb-1"> <span style="text-decoration: underline;">Share</span> </p>
			</div>
			<div class="col-md-8 ml-md-auto">
				<h2 class="ml-0" style="margin-top: -6px;">About {{$user->first_name}} </h2>
				<div class=" mb-5 border-bottom">
				<div class="row mt-5 mb-4 ">
					<div class="col-md-12 d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/category.png') }}" class="mr-4">
						</div>
						<div>
						   <h4 class="m-0">Category</h4>
                          <p class="card-text">
		                      @foreach(json_decode($user->category_id) as $key => $cat)
                                @if(\Acelle\Jobs\HelperJob::categoryDetail($cat)->cat_parent_id == 0)
		                        <span class="data-value">
		                        	{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
		                        @if ($key < count(json_decode($user->category_id)) - 1)
		                             
		                        @endif
		                        @endif
		                    @endforeach
		                    </p>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12 d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/location.png') }}" class="mr-4">
						</div>
						<div>
						   <h4 class="m-0">Service Area</h4>
                          <p class="">
                          	@if($user->country)
		                     {{Acelle\Jobs\HelperJob::countryname($user->country)->name}}
		                     @elseif($user->state)
		                      {{Acelle\Jobs\HelperJob::statename($user->state)->name}}
		                     @else
		                     {{Acelle\Jobs\HelperJob::cityname($user->city)->name}}
		                     
		                     @endif
		                    </p>
						</div>
					</div>
				</div>
				@if($user->experience)
				<div class="row pb-4">
					<div class="col-md-12 d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/medal.png') }}" class="mr-4">
						</div>
						<div>
						 <h4 class="m-0">Years in Business</h4>
                         {{ $user->experience }}
						</div>
					</div>
				</div>
			    @endif
			</div>
			  
			    @if ($user->biography)
			    <h2 class="mt-3 mb-4">Biography</h2>
			    <div class="row mb-5 border-bottom">
			        <div class="col-md-12 mb-5">
			            <p id="accommodationDescription" class="mb-1">
			                {{ $user->biography }}
			            </p>
			        </div>
			    </div>
			    @endif
				@if(count($user->gallery) > 0)
				<h2 class="mb-5">Gallery</h2>
				 <div class="row border-bottom mb-5 pb-5">
				  @foreach($user->gallery as  $key => $gallery)
				    <div class="col-md-3 mb-4 text-center">
				        <a href="#" data-toggle="modal" data-target="#imageModal" data-slide-to="{{ $key }}">
				            <img src="{{ asset('frontend-assets/images/'.$gallery->image)}}" alt="Image {{ $key + 1 }}" class="img-fluid gallery-img" >
				        </a>
				    </div>
				    @endforeach
			        
			    </div>
			    @endif
			    <h2 class="mb-4 ml-0">Preferred music genres</h2>
				<div class="row mr-1 mb-5 border-bottom pb-5">
					<div class="col-md-6">
						<div class="d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
						</div>
						    <p class="font-weight-bold">Retro</p>
						</div>
						<div class="d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
						</div>
						    <p class="font-weight-bold">Retro</p>
						</div>
						<div class="d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
						</div>
						    <p class="font-weight-bold">Retro</p>
						</div>
						
					</div>
					<div class="col-md-6">
						<div class="d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
						</div>
						    <p class="font-weight-bold">Retro</p>
						</div>
						<div class="d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
						</div>
						    <p class="font-weight-bold">Retro</p>
						</div>
						<div class="d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/music.png') }}" class="mr-4">
						</div>
						    <p class="font-weight-bold">Retro</p>
						</div>
						
					</div>
				</div>

				<h2 class="form-heading ml-0 mb-1">
				{{ ($job_design) ? $job_design->title_heading : 'What are you looking for?'}}</h2>
				<p class="form-para">
				{{ ($job_design) ? $job_design->titlesub_heading : 'Let us know what you are looking for and we will provide you up to 3 quotes.'}}
				</p>
				<div class="container mt-5">
				<div class="row mt-5"
				style="height: 100%;align-items: center;">
				<div class="col-lg-12 pl-md-0" style="box-shadow: -1px -1px 6px -6px rgba(0,0,0,0.27);border-radius: 12px">
				@if($errors->any())
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  {{$errors->first()}}
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  </button>
				</div>
				@endif
			
				<form class="information" action="{{ url('quote-form')}}" method="post" style="padding: 0.5rem "
				autocomplete="off">
				{{ csrf_field()}}
				
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
				  <label class="form-control-placeholder"
				         for="search">{{ ($job_design) ? $job_design->category_heading : 'What service do you need?'}}</label>
				  @if($job_design && $job_design->search_box == 'auto_suggest')     
				  <input type="text" style="height: 50px !important;" class="form-control" name="category_name" id="search"
				         placeholder="eg {{Acelle\Jobs\HelperJob::categoryDetail(Acelle\Jobs\HelperJob::categoryname())->category_name}}... etc"
				         required>
				  <ul class="list-group" id="result">
				  </ul>
				  @else
				  <select class="form-control select2" name="category_name" id="mySelect" style="height: 50px !important" required="">
				     <option value="" disabled selected="" style="color: #333;">Select Service</option>
				     @foreach(Acelle\Jobs\HelperJob::allcategories() as $category) 
				     <option>{{$category->category_name}}</option>
				     @endforeach
				  </select>
				  @endif
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
				 <label class="form-control-placeholder" for="zipcode">{{ ($job_design) ? $job_design->postcode_text : 'Where you need ?'}}</label>
				  <input type="text" style="height: 50px !important;" class="form-control" name="zipcode" id="zipcode" placeholder="Location"
				         required>
				  @if(Session::has('error'))
				      <strong style="color: red">Location Error : <span>{{Session::get('error')}}</span></strong>
				  @endif
				  <div class="custom-control custom-control-sm custom-checkbox notext mt-2">
				    <input type="checkbox" class="custom-control-input" id="local_business"
				           name="local_business" value="local business">
				    <label class="custom-control-label ml-2" for="local_business" style="padding-left: 5px;font-size: 13px;color: #9f9f9f;">I prefer a local business</label>
				  </div>
				  <input type="hidden" id="latitude" name="latitude">
				  <input type="hidden" id="longitude" name="longitude">
				  <input type="hidden" id="state" name="state">
				</div>
				</div>
				<div class="col-md-5">
				<div class="form-group">
				  <button type="submit" class="btn rounded-2 btn-primary d-block login-button py-2 fw-600 w-100" style="border-radius: 0.55rem;"><span style="font-size: 17px">{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}</span></button>
				</div>
				</div>
				</div>
				<p class="terms mt-4">By clicking "{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}",
				you consent to the {{$sitename}} storing the information submitted on this page so you can get most
				up-to-date quotes, no matter what device you are using. You also agree to The {{$sitename}}'s
				 <a href="#" class="link-color" data-toggle="modal" data-target="#terms">Terms of Service</a> and 
				 <a href="#" class="link-color" data-toggle="modal" data-target="#privacy">Privacy Policy.</a>
				</p>
				</form>
				</div>
				<!-- Terms Modal -->
				<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
				aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">Terms of Service</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">X</span>
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
				<h4 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">X</span>
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
				</div>

				</div>
  	<!-- Modal -->
				<div class="modal fade" id="biographyModal" tabindex="-1" role="dialog" aria-labelledby="biographyModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h4 class="modal-title ml-3" id="biographyModalLabel"> Biography</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">X</span>
				                </button>
				            </div>
				            <div class="modal-body">
				                <div class="modal-body">
                                <textarea  style="border: none; background:none; color:  #222222;width: 100%; min-height: 58vh;" disabled>{!! $user->biography !!}</textarea>
                            </div>
				            </div>
				            <div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
				        </div>
				    </div>
				</div>
			    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered modal-lg">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h4 class="modal-title" id="imageModalLabel">Gallery Slider</h4>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">X</span>
			                </button>
			            </div>
			            <div class="modal-body">
			                <div id="imageSlider" class="carousel slide" data-ride="carousel">
			                    <div class="carousel-inner">
			                    	@foreach($user->gallery as $key => $gallery)
							        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}" style="max-height: 550px">
							            <img src="{{ asset('frontend-assets/images/'.$gallery->image)}}" alt="Image {{ $key + 1 }}" class="d-block w-100">
							        </div>
							        @endforeach
			                        <!-- Add more carousel items as needed -->
			                    </div>
			                    <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
			                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			                        <span class="sr-only">Previous</span>
			                    </a>
			                    <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
			                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
			                        <span class="sr-only">Next</span>
			                    </a>
			                </div>
			            </div>
			            <div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
			        </div>
			    </div>
			</div>

			<!-- Quote model -->

			<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h4 class="modal-title" id="imageModalLabel">Send a quote request to {{$user->first_name}} {{$user->last_name}} </h4>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">X</span>
			                </button>
			            </div>
			            <div class="modal-body">
			             <div class="row justify-content-center"
								style="height: 100%;align-items: center;">
								<div class="col-lg-12 col-md-12 col-sm-12 formclass">
								@if($errors->any())
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  {{$errors->first()}}
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  </button>
								</div>
								@endif
								<form class="information" action="{{ url('quote-form')}}" method="post" style="padding: 0.5rem "
								autocomplete="off">
								{{ csrf_field()}}

								<input type="hidden" name="sp_id" value="{{ $user->id }}">
								<input type="hidden" id="selectedDate" name="booking_date" value="{{date('Y-m-d') }}">
								
								<div class="row">
								<div class="col-md-12">
								<div class="form-group">
								  <label class="form-control-placeholder"
								         for="search">{{ ($job_design) ? $job_design->category_heading : 'What service do you need?'}}</label>
								
								  <select class="form-control select2" name="category_name" required="" style="height: calc(5.25rem + 2px) !important;">
								     <option value="" disabled selected="">Select Service</option>
								     @foreach(json_decode($user->category_id) as $category) 
								     <option>{{\Acelle\Jobs\HelperJob::categoryDetail($category)->category_name}}</option>
								     @endforeach
								  </select>
								</div>
								</div>
								  <input type="hidden" class="form-control" name="zipcode" id="zipcode" value="Location"
								         required>
								  <input type="hidden" value="latitude" name="latitude">
								  <input type="hidden" value="longitude" name="longitude">
								  <input type="hidden" value="state" name="state">
								<div class="col-md-5 mt-4">
								<div class="form-group">
								  <button type="submit" class="btn rounded-2 btn-primary d-block login-button py-2 fw-600 w-100"><span style="font-size: 17px">{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}</span></button>
								</div>
								</div>
								</div>
								</form>
							
								</div>
						
								</div>
			            </div>
			            <div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
			        </div>
			    </div>
			</div>


			<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content" style="padding: 0 15px;">
			            <div class="modal-header">
			            <h4 class="item-title mb-2">Share this profile</h4>
			                
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">X</span>
			                </button>
			            </div>
			            <div class="modal-body m-4 body-padding">
			            <div class="row d-flex justify-content-around mb-2">
		            		<div class="col-lg-5 col-sm-12 p-4 _mnf8sq">
		            			<input type="text" value="{{Request::url()}}" id="myInput" style="z-index: -4;position: absolute;">

		            			<div class="row" onclick="copyToClipboard()">
		            				<div class="col-lg-3 col-sm-3 svgcenter">
		            					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M25 5a4 4 0 0 1 4 4v17a5 5 0 0 1-5 5H12a5 5 0 0 1-5-5V10a5 5 0 0 1 5-5h13zm0 2H12a3 3 0 0 0-3 3v16a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V9a2 2 0 0 0-2-2zm-3-6v2H11a6 6 0 0 0-6 5.78V22H3V9a8 8 0 0 1 7.75-8H22z"></path></svg>
		            				</div>
		            				<div class="col-lg-8 col-sm-8 _1141qqg">Copy Link
		            				</div>
		            			</div>
		            		</div>
		            		<div class="col-lg-5 col-sm-12 p-4 _mnf8sq">
		            			<div class="row" onclick="sendEmail()">
		            				<div class="col-lg-3 col-sm-3 svgcenter">
		            					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 32px; width: 32px; stroke: currentcolor; stroke-width: 2; overflow: visible;"><g fill="none"><rect width="28" height="24" x="2" y="4" rx="4"></rect><path d="m3 6 10.42 8.81a4 4 0 0 0 5.16 0L29 6"></path></g></svg>
		            				</div>
		            				<div class="col-lg-8 col-sm-8 _1141qqg text-sm-center">Email
		            				</div>
		            			</div>
		            		</div>
			            </div>
			                 <div class="row d-flex justify-content-around mb-2">
		            		<div class="col-lg-5 col-sm-12 p-4 _mnf8sq">
		            			<div class="row" onclick="shareOnFacebook()">
		            				<div class="col-lg-3 col-sm-3 svgcenter">
		            					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px;border-radius: 6px;"><path fill="#1877F2" d="M32 0v32H0V0z"></path><path fill="#FFF" d="M22.94 16H18.5v-3c0-1.27.62-2.5 2.6-2.5h2.02V6.56s-1.83-.31-3.58-.31c-3.65 0-6.04 2.21-6.04 6.22V16H9.44v4.63h4.06V32h5V20.62h3.73l.7-4.62z"></path></svg>
		            				</div>
		            				<div class="col-lg-8 col-sm-8 _1141qqg">
		            					Facebook
		            				</div>
		            			</div>
		            		</div>
		            		<div class="col-lg-5 col-sm-12 p-4 _mnf8sq">
		            			<div class="row"  onclick="shareOnTwitter()">
		            				<div class="col-lg-3 col-sm-3 svgcenter">
		            				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px;border-radius: 6px;"><path fill="#1DA1F2" d="M0 0h32v32H0z"></path><path fill="#FFF" d="M18.66 7.99a4.5 4.5 0 0 0-2.28 4.88A12.31 12.31 0 0 1 7.3 8.25a4.25 4.25 0 0 0 1.38 5.88c-.69 0-1.38-.13-2-.44a4.54 4.54 0 0 0 3.5 4.31 4.3 4.3 0 0 1-2 .06 4.64 4.64 0 0 0 4.18 3.13A8.33 8.33 0 0 1 5.82 23a12.44 12.44 0 0 0 19.31-11.19 7.72 7.72 0 0 0 2.2-2.31 8.3 8.3 0 0 1-2.5.75 4.7 4.7 0 0 0 2-2.5c-.88.5-1.82.88-2.82 1.06A4.5 4.5 0 0 0 18.66 8z"></path></svg>
		            				</div>
		            				<div class="col-lg-8 col-sm-8 _1141qqg">
		            					Twitter
		            				</div>
		            			</div>
		            		</div>
			            </div>
			         
                        <div class="single-blog-banner-layout1 d-none" style="position: static;">
                      	<div class="banner-content" style="bottom: 0">
                        <ul class="item-social mb-2 text-center">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i>SHARE</a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($user->first_name) }}" target="_blank" class="twitter"><i class="fab fa-twitter"></i>SHARE</a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($user->first_name) }}" target="_blank" class="linkedin"><i class="fab fa-linkedin"></i>SHARE</a></li>
                        </ul>
                       </div>
                      </div>
			            </div>
			            <div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
			        </div>
			    </div>
			</div>

			</div>
			
		</div>
		
	</div>
</section>

@include('blog.footer')

<script rel="preload" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBNL_1BSqiKF5qf0WqLbMT4xF1dB1Aux1M&libraries=places"></script>
   @php
	    $charLimit = 400;
	@endphp

	@if (strlen($user->biography) > $charLimit)
	    <script>
	        document.addEventListener('DOMContentLoaded', function () {
	            var biographyElement = document.getElementById('accommodationDescription');
	            var fullBiography = {!! json_encode($user->biography) !!}; // Ensure proper escaping for JavaScript

	            if (biographyElement.textContent.length > {{ $charLimit }}) {
	                var shortText = biographyElement.textContent.substring(0, {{ $charLimit }}) + '...';

	                biographyElement.textContent = shortText;

	                var seeMoreLink = document.createElement('a');
	                seeMoreLink.id = 'seeMoreLink';
	                seeMoreLink.href = '#';
	                seeMoreLink.textContent = 'See More >';

	                seeMoreLink.addEventListener('click', function (e) {
	                    e.preventDefault();
	                    $('#biographyModal').modal('show');
	                });

	                biographyElement.insertAdjacentElement('afterend', seeMoreLink); // Insert the link after the paragraph
	            }
	        });
	    </script>
	@endif
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script rel="preload" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
	    function copyToClipboard() {
            // Get the input element by its ID
            var inputElement = document.getElementById("myInput");

            // Select the text in the input element
            inputElement.select();

            // Execute the copy command
            document.execCommand("copy");

            // Provide user feedback (you can customize this part)
            alert("Link copied to clipboard!");
        }

        function sendEmail() {
            // You can use the "mailto:" protocol to open the user's default email client
            window.location.href = "mailto:?subject=Check%20out%20this%20link&body=" + encodeURIComponent(window.location.href);
        }

        function shareOnFacebook() {
            // You can customize the URL and other parameters based on your requirements
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href), "_blank");
        }

        function shareOnTwitter() {
            // You can customize the URL and other parameters based on your requirements
            window.open("https://twitter.com/intent/tweet?url=" + encodeURIComponent(window.location.href), "_blank");
        }
    $(document).ready(function(){
       $('#owl-carousel').owlCarousel({
            items: 3, // Number of items displayed per slide
            loop: false, // Loop through items
            nav: false, // Show navigation buttons
            responsive: {
                0: { items: 1 }, // Responsive settings for different screen widths
                768: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 }
            }
        });
        $('#owl-carousel2').owlCarousel({
            items: 4, // Number of items displayed per slide
            loop: false, // Loop through items
            nav: false, // Show navigation buttons
            responsive: {
                0: { items: 1 }, // Responsive settings for different screen widths
                768: { items: 2 },
                992: { items: 3 }
            }
        });
    });
</script>
    <script>
        flatpickr("#calendar", {
            defaultDate: new Date(),
            minDate: "today",
            inline: true,
            onChange: function(selectedDates, dateStr, instance) {
                // Update the hidden input value with the selected date
                document.getElementById('selectedDate').value = dateStr;
            },
        });
    </script>
    <script type="text/javascript">
    	 $('#mySelect').on('change', function () {
		  var selectedValue = $(this).val();
		  var textColor = selectedValue ? '#3c4d62' : '#c1c1c1';

		  // Remove !important from the inline style
		  $('.select2-container--default .select2-selection--single .select2-selection__rendered').css('color', textColor);

		  // Add a more specific rule with !important to override Select2 styles
		  var styleTag = $('<style>.select2-container--default .select2-selection--single .select2-selection__rendered { color: ' + textColor + ' !important; }</style>');
		  $('head').append(styleTag);
		});
    </script>
@if($provideradminlocation->admin_location_type == "World Wide")
<script>
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize() {
  var input = document.getElementById('zipcode');
  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.addListener('place_changed', function () {
  var place = autocomplete.getPlace();
  var components = place.address_components;
  $("#latitude").val(place.geometry['location'].lat());
  $("#longitude").val(place.geometry['location'].lng());
  for(i=0;i<components.length;i++){
  if(place.address_components[i].types[0].toString() === 'administrative_area_level_1'){
  var state = place.address_components[i].long_name;
  console.log(state);
  $("#state").val(state);
  }
  }
  });
  }
</script>
@else
<script>

	@if($providercountry)
	var pc = "{{ $providercountry->code }}";
	@else 
    var pc = 'au';
  @endif
  var loc = pc.toLowerCase();
  google.maps.event.addDomListener(window, 'load', initialize);

  function initialize() {
  var options = {
  componentRestrictions: {country: loc}
  };
  var input = document.getElementById('zipcode');
  var autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.addListener('place_changed', function () {
  var place = autocomplete.getPlace();
    var components = place.address_components;
  $("#latitude").val(place.geometry['location'].lat());
     $("#longitude").val(place.geometry['location'].lng());
  for(i=0;i<components.length;i++){
    console.log(place.address_components[i].types[0].toString());
  if(place.address_components[i].types[0].toString() === 'administrative_area_level_1'){
  var state = place.address_components[i].long_name;
  console.log(state);
  $("#state").val(state);
  }
  }
  });
  }
</script>
@endif
<script>
    jQuery(document).ready(function () {
        // Function to update the image slider on image click
        $('.gallery-img').click(function () {
            var slideTo = $(this).data('slide-to');
            $('#imageSlider').carousel(slideTo);
        });

        // Initialize the image slider when the modal is shown
        $('#imageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var slideTo = button.data('slide-to');
            $('#imageSlider').carousel(slideTo);
        });
    });
</script>