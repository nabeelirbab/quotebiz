<?php
	if(!$zipcode || !$category){
// dd($category);
		$url = url('/');
		 header("Location: ".$url);
		die();
	}
	// dd($sp_id);
	$job_design = Acelle\Jobs\HelperJob::form_design();

	if(count($category->questions) > 0){
           $questions = $category->questions;
        }else{
           $questions = $category->subquestions;
        }

	   $sitename = \Acelle\Model\Setting::get("site_name");
	   $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));

     // dd($questions);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
		<meta name="keywords" content="{{ \Acelle\Model\Setting::get("site_keyword") }}" />
		<meta name="php-version" content="{{ phpversion() }}" />
		<title>{{ \Acelle\Model\Setting::get("site_name") }}</title>
		@if (\Acelle\Model\Setting::get('site_favicon'))
		    <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}"/>
		@else
		    @include('layouts.core._favicon')
		@endif
		<link rel="stylesheet" href="{{ asset('frontend-assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">
		<!-- STYLE CSS -->
		<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/style2.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
		<style>
		<?php
		  $total = count($questions)+3;
		  $mid = 90/$total;
		  $final = 100/$total;
		// dd($total,$final,'dddd'); 
		  ?>
		  .wizard > .steps ul.step-1:before {
			left:<?php echo $mid; ?>%;
			transition: all 0.5s ease; }
		  .wizard > .steps ul.step-1:after {
			width: <?php echo $final; ?>%;
			transition: all 0.5s ease;
			 }

		<?php
		  for($i=1; $i <= $total; $i++){ ?>
		
		 .wizard > .steps ul.step-<?php echo $i; ?>:before {
			left:<?php echo $i*$mid; ?>%;
			transition: all 0.5s ease; }
		  .wizard > .steps ul.step-<?php echo $i; ?>:after {
			width: <?php echo $i*$final; ?>%;
			transition: all 0.5s ease; }
		<?php } ?>
		
		body {
		  background: #f7f8fa;
		  color: #222222;
		  font-family: {{ ($job_design) ? $job_design->font_family:'DM Sans'}}, sans-serif !important;

		}
		input{
			font-family: {{ ($job_design) ? $job_design->font_family:'DM Sans'}}, sans-serif !important;

		}

		  .wizard > .steps ul:after {
		    content: "";
		    width: 10.33%;
		    height: 8px;
		    background: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
		    border-radius: 2px;
		    position: absolute;
		    top: 0;
		    left: 0;
		    transition: all 0.5s ease; }
		    .actions li a {
		     border: none !important;
		     background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		    }
		    .form-control:focus {
		    /* box-shadow: 0px 0px 7px 0px rgb(116 107 107); */
		    border: 1px solid {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
		}
		.actions li button {
		    padding: 0;
		    border: none;
		    display: inline-flex;
		    height: 54px;
		    width: 160px;
		    letter-spacing: 1.3px;
		    font-size: 0.8rem;
		    align-items: center;
		    background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		    cursor: pointer;
		    position: relative;
		    padding-left: 34px;
		    /*text-transform: uppercase;*/
		    color: #fff;
		    border-radius: 27px;
		    -webkit-transform: perspective(1px) translateZ(0);
		    transform: perspective(1px) translateZ(0);
		    -webkit-transition-duration: 0.3s;
		    transition-duration: 0.3s;
		}
		.actions li button:before {
		    content: '\f2ee';
		    font-size: 18px;
		    position: absolute;
		    top: 17px;
		    right: 17px;
		    -webkit-transform: translateZ(0);
		    transform: translateZ(0);
		}
		.images-icons{
			max-width: 100%;
			border-top-right-radius: 15px;
			border-top-left-radius: 15px; 
		}
		.mainclass {
		  display: flex;
		  flex-flow: row wrap;
		}
		.mainclass > div {
		  flex: 1;
		  padding: 0.5rem;
		  max-width: 29%;
		}
		input[type="radio"] {
		  display: none;
		  &:not(:disabled) ~ label {
		    cursor: pointer;
		  }
		  &:disabled ~ label {
		    color: black;
		    border-color: hsla(150, 5%, 75%, 1);
		    box-shadow: none;
		    cursor: not-allowed;
		  }
		}
		input[type="checkbox"] {
		  display: none;
		  &:not(:disabled) ~ label {
		    cursor: pointer;
		  }
		  &:disabled ~ label {
		    color: black;
		    border-color: hsla(150, 5%, 75%, 1);
		    box-shadow: none;
		    cursor: not-allowed;
		  }
		}
		label {
		  height: 100%;
		  display: block;
		  background: white;
		  border-radius: 15px;
		  padding: 0.8rem;
		  color: black;
		  margin-bottom: 1rem;
		  //margin: 1rem;
		  text-align: center;
		  box-shadow: 0px 3px 10px -2px hsla(150, 5%, 65%, 0.5);
		  position: relative;
		}
		input[type="radio"]:checked + label {
		  /*background: hsla(150, 75%, 50%, 1);*/
		  color: black;
		  border: 1px solid {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
		  &::after {
		    color:black;
		    /*border: 2px solid hsla(150, 75%, 45%, 1);*/
		    /*content: "\f00c";*/
		    font-size: 24px;
		    position: absolute;
		    top: -25px;
		    left: 50%;
		    transform: translateX(-50%);
		    height: 50px;
		    width: 50px;
		    line-height: 50px;
		    text-align: center;
		    border-radius: 50%;
		    background: white;
		    box-shadow: 0px 2px 5px -2px hsla(0, 0%, 0%, 0.25);
		  }
		}
		input[type="checkbox"]:checked + label {
		  /*background: hsla(150, 75%, 50%, 1);*/
		  color: black;
		  border: 1px solid {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
		  &::after {
		    color: black;
		    /*border: 2px solid hsla({{ ($job_design) ? $job_design->underline_color:'#6200EA'}});*/
		    /*content: "\f00c";*/
		    font-size: 24px;
		    position: absolute;
		    top: -25px;
		    left: 50%;
		    transform: translateX(-50%);
		    height: 50px;
		    width: 50px;
		    line-height: 50px;
		    text-align: center;
		    border-radius: 50%;
		    background: white;
		    box-shadow: 0px 2px 5px -2px hsla(0, 0%, 0%, 0.25);
		  }
		}
		/*input[type="radio"]#control_05:checked + label {
		  background: red;
		  border-color: red;
		}*/
		p {
		  font-weight: 900;
		}

		.d-flex {
		    display: flex;
		}
		.justify-content-center {
		    justify-content: center;
		}
		.row {
		    margin-right: -15px;
		    margin-left: -15px;
		}
		.content.clearfix{
			padding: 15px;
		}
		@media only screen and (min-width: 992px) {
		.col-md-6 {
		    width: 50%;
		    float: left;
		    position: relative;
		    min-height: 1px;
		    padding-right: 15px;
		    padding-left: 15px;
		}

		}
		@media only screen and (max-width: 700px) {
		  section {
		    flex-direction: column;
		  }
		  .mainclass > div {
		    flex: 1;
		    padding: 0.5rem;
		    max-width: 100% !important;
		 }
		 .font-class{
		 	font-size: 16px;
		 }
		 .actions li a{
		 	width: 156px;
		 }
		 label img{
		    vertical-align: middle;
		    max-height: 60px !important;
		    max-width: 60px !important;

		 }
		}
		.swyft-box-shadow-down {
		    box-shadow: 0 6px 6px 0 rgb(0 0 0 / 16%);
		    z-index: 100;
		}
		.jss3 {
		    height: 100px;
		    width: 100%;
		    display: flex;
		    align-items: center;
		    justify-content: center;
		    background-color: rgb(255, 255, 255);
		}
		.iti__flag {background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/img/flags.png");
		}

		@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
		  .iti__flag {background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/img/flags@2x.png");}
		}
		</style>
	</head>
	<body class="dogcFe">
		<div class="MuiBox-root jss3 swyft-box-shadow-down">
			<a href="{{url('/')}}" rel="noreferrer" style="text-align: center; max-width: 250px">
			@if(request('account') == 'dj123.com.au')
			  <img src="{{$sitesmalllogo}}" alt="Logo" style="max-width: 40%">
			  @else
			  <img src="{{$sitesmalllogo}}" alt="Logo">
			  @endif
			</a>
		</div>
		<div class="wrapper">
		
            <form action="{{ url('storeform') }}" method="post" id="form" >
            	 {{ csrf_field() }}
            	<div class="form-header">
            		
            		<input type="hidden" name="category_id[]" value="{{$category->id}}">
            		<input type="hidden" name="zip_code" value="{{$zipcode}}">
            		<input type="hidden" name="state" value="{{$state}}">
            		<input type="hidden" name="latitude" value="{{$latitude}}">
            		<input type="hidden" name="longitude" value="{{$longitude}}">
            		<input type="hidden" name="local_business" value="{{$local_business}}">
            		<input type="hidden" name="admin_id" value="{{\Acelle\Model\Setting::subdomain()}}">
            		<input type="hidden" name="sp_id" value="{{@$sp_id}}">
            		@if($booking_date)
            		<input type="hidden" name="booking_date" value="{{@$booking_date}}">
            		@endif
            	</div>
            	<div id="wizard">
            		
				   @foreach($questions as $question)
            		<!-- SECTION 1 -->
            		@if($question->choice_selection == "single")
            		<input type="hidden" name="question_id[]" value="{{$question->id}}">
            		@elseif($question->choice_selection == "multiple")
            		<input type="hidden" name="question_id2[]" value="{{$question->id}}">
            		@elseif($question->choice_selection == "datepicker")
                    <input type="hidden" name="question_date[]" value="{{$question->id}}">
            		@else
                    <input type="hidden" name="question_input[]" value="{{$question->id}}">
            		@endif
	                <h4></h4>
	                <section>
	                <h3 style="text-align: center;color: black">{{$question->question}}</h3>
	                	<div class="mainclass justify-content-center" style="padding-bottom: 48px">
		                @if($question->choice_selection == "single")		
	                     @foreach($question->choices as $key => $choices)
		                  <div>

						  <input type="radio" id="control_0{{$choices->id}}" name="option[{{$question->id}}]" value="{{$choices->choice }}">
						  <label for="control_0{{$choices->id}}">
						  	@if($choices->icon)
                              <img class="images-icons" src="{{ asset('/frontend-assets/images/categories/'.$choices->icon) }}" >
						  	@else
                             <img src="{{ asset('/frontend-assets/images/icons/option.png') }}">
						  	@endif
						  	
						    <h2 style="padding-top: 15px" class="font-class">{{$choices->choice}}</h2>
						   
						  </label>
						</div>
						@endforeach
						@elseif($question->choice_selection == "multiple")
{{--							{{ dd($question->choices) }}--}}
						@foreach($question->choices as $key => $choices)
	                     <div>
						  <input type="checkbox" id="control_0{{$choices->id}}" name="choices[]" value="{{$question->id}},{{$choices->choice}}">
						  <label for="control_0{{$choices->id}}">
						  	@if($choices->icon)
                              <img class="images-icons" src="{{ asset('/frontend-assets/images/categories/'.$choices->icon) }}" >
						  	@else
                              <img src="{{ asset('/frontend-assets/images/icons/option.png') }}">
						  	@endif
						      <h2 style="padding-top: 15px" class="font-class">{{$choices->choice}}</h2>
						  </label>
						</div>
						@endforeach
						@elseif($question->choice_selection == "datepicker")
						<div style="max-width: 50%">
                            <div class="form-row">
	                    	<div class="form-holder">
	                    		<!-- <span>Where do you need it?</span> -->
	                    		<input type="date" class="form-control zipclass" name="date[]" placeholder="Enter Postcode"  required>
	                    	</div>
	                    </div>
	                </div>
						@else
						<div  style="max-width: 50%">
                         <div class="form-row">
	                    	<div class="form-holder">
	                    		<!-- <span>{{$question->question}}</span> -->
	                    		<input type="text" class="form-control zipclass" name="input[]" placeholder="{{$question->question}}" autocomplete="{{$question->question}}" required>
	                    		<input type="text" style="opacity: 0" id="" 
                                name="PreventChromeAutocomplete" autocomplete="address-level4" />
	                    	</div>
	                    </div>
	                </div>
					@endif
				</div>
	            </section>
				@endforeach
                 <h4></h4>
	                <section>
	                	<h3 style="text-align: center;color: black">Additional Information</h3>
	                	<div class="row" style="padding: 0 20px;">
	                    <div class="form-row col-md-12">
	                    	<div class="form-holder">
	                    		<textarea  class="form-control" rows="8" cols="70" name="additional_info"></textarea>
	                    	</div>
	                    </div>	
	                   
	                	</div>
	                </section>
	                @if(!$booking_date)
	                 <h4></h4>
	                <section>
	                	<h3 style="text-align: center;color: black">{{ ($job_design) ? $job_design->event_text : 'What is the date of your event?'}}</h3>
	                	<div class="mainclass justify-content-center" style="padding-bottom: 48px">
	                	 <div style="max-width: 50%">
                            <div class="form-row">
	                    	<div class="form-holder">
	                    		<!-- <span>Where do you need it?</span> -->
	                    		<input type="date" class="form-control zipclass" name="booking_date"  required>
	                    	</div>
	                    </div>
	                </div>
	                	</div>
	                </section>
	                @endif
	                @if(!$sp_id)
	                 <h4></h4>
	                <section>
	                	<h3 style="margin-bottom: 8px;text-align: center;color: black">Other Services</h3>
	                	<p style="margin-bottom: 46px;font-size: 14px;font-weight: 200;text-align: center;">Interested in more services? Select additional categories and receive up to 3 quotes for each one to explore more options for your event</p>
	                	<div class="mainclass justify-content-center" style="padding-bottom: 48px">
				    @foreach($categories as $key => $cat)
				        <div class="text-center">
				            <input type="checkbox" id="cat_0{{$cat->id}}" name="category_id[]" value="{{$cat->id}}">
				            <label for="cat_0{{$cat->id}}" style="padding: 1rem !important; display: flex;align-items: center;justify-content: center;">
				                <!-- If you want to include an image -->
				                @if($cat->category_icon)
				                @if($cat->icon_option == 'upload')
				                <div class="" >
				                	<div style="max-width: 60px; min-width: 60px; margin: 0 auto;">
				                    <img class="images-icons" src="{{ asset('/frontend-assets/images/categories/'.$cat->category_icon) }}">
				                		
				                	</div>
				                    <h3 style="padding-top: 15px" class="font-class">{{$cat->category_name}}</h3>

				                </div>
				                @else
				                <div class="">
				                	<div  style="max-width: 60px; min-width: 60px; margin: 0 auto;">
                                     <img src="{{asset('images/icons/'.$cat->category_icon)}}">
				                		
				                	</div>
				                    <h3 style="padding-top: 15px" class="font-class">{{$cat->category_name}}</h3>

                                 </div>
				                @endif
				                @else
				                <div>
				                	
				                    <img src="{{ asset('/frontend-assets/images/icons/option.png') }}" style="max-width: 45%">
				                    <h3 style="padding-top: 15px" class="font-class">{{$cat->category_name}}</h3>
				                </div>

				                @endif

				                <!-- Wrapping h2 in a div for centering -->
				                
				            </label>
				        </div>
				    @endforeach
				</div>

	                </section>
	                @endif
				@if(Auth::user())
					@if(Auth::user()->user_type == 'client' || Auth::user()->user_type == 'service_provider')
	       
	                @else
	                <h4></h4>
	                <section>
	                	<h3 style="text-align: center;color: black">Alright, let's get your details and create your tailored online estimate!</h3>
	                	<div class="row" style="padding: 0 20px;">
	                		<input type="hidden" name="user_type" value="client">
	                		<input type="hidden" name="subdomain" value="{{\Acelle\Model\Setting::subdomain()}}">
	                	
	                    <div class="form-row col-md-6" id="first">
	                    	
	                    	<div class="form-holder">
	                    		<span>First Name</span>
	                    		<input type="text" id="f_name" class="form-control" name="first_name" placeholder="Enter First Name"  required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" id="last">
	                    	
	                    	<div class="form-holder">
	                    		<span>Last Name</span>
	                    		<input type="text" id="l_name" class="form-control" name="last_name" placeholder="Enter Last Name"  required>
	                    	</div>
	                    </div>
                     	<div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>Email</span>&nbsp;&nbsp;<span id="emailexist" style="color: red"></span>
	                    		<input type="email" name="email" onblur="myFunction()"  class="form-control formEmail" name="email" placeholder="Enter Email"  mrequired="">
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px">
	                    	
	                    	<div class="form-holder">
	                    		<span>Password</span>
	                    		<input type="password"  name="password" id="id_password" class="form-control" placeholder="Enter Password"  required>
	                    		<i class="zmdi zmdi-eye zmdi-hc-lg" id="togglePassword" style="cursor: pointer;color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};bottom: 13px"></i>
	                    	</div>
	                    </div>
	                    <div class="form-row col-md-6" id="city">
	                    	
	                    	<div class="form-holder">
	                    		<span>City</span>
	                    		<input type="text" name="city" class="form-control" name="email" placeholder="Enter City"  required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px" id="mobileno">
	                    	
	                    	<div class="form-holder" style="display: grid">
	                    		<span>Mobile No</span>
	                    		<input type="tel" id="phone" name="mobileno" class="form-control" placeholder="Mobile numbersss"  required>
	                    	</div>
	                    </div>
	                   		
	                   
	                	</div>
	                </section>

					@endif

					@else
<!-- SECTION 3 -->
	                <h4></h4>
	                <section>
	                	<h3 style="text-align: center;color: black">Alright, let's get your details and create your tailored online estimate!</h3>
	                	<div class="row">
	                		<input type="hidden" name="user_type" value="client">
	                		<input type="hidden" name="subdomain" value="{{\Acelle\Model\Setting::subdomain()}}">
	                     <div class="form-row col-md-6" id="first">
	                    	<div class="form-holder">
	                    		<span>First Name</span>
	                    		<input type="text" id="f_name" class="form-control" name="first_name" placeholder="Enter First Name" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" id="last">
	                    	<div class="form-holder">
	                    		<span>Last Name</span>
	                    		<input type="text" id="l_name" class="form-control" name="last_name" placeholder="Enter Last Name" required>
	                    	</div>
	                    </div>	
                     	<div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>Email</span>&nbsp;&nbsp;<span style="color: red" id="emailexist"></span>
	                    		<input type="email"  class="form-control formEmail" onblur="myFunction()"  name="email" placeholder="Enter Email" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px">
	                    	
	                    	<div class="form-holder">
	                    		<span>Password</span>
	                    		<input type="password" name="password" id="id_password" class="form-control" placeholder="Enter Password" required>
	                    		<i class="zmdi zmdi-eye zmdi-hc-lg" id="togglePassword" style="cursor: pointer;color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};bottom: 13px;"></i>
	                    	</div>
	                    </div>

	                     <div class="form-row col-md-6" id="city">
	                    	
	                    	<div class="form-holder">
	                    		<span>City</span>
	                    		<input type="text" name="city" class="form-control" name="email" placeholder="Enter City" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px" id="mobileno">
	                    	
	                    	<div class="form-holder" style="display: grid">
	                    		<span>Mobile No</span>
	                    		<input type="tel" id="phone" name="mobileno" class="form-control" placeholder="Mobile number" required>
	                    	</div>
	                    </div>

	                	</div>
	                </section>

					@endif
            	</div>
            </form>
		</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="{{ asset('frontend-assets/js/jquery.steps.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.js"></script>
<script type="text/javascript">
var jqOld = jQuery.noConflict();

	jqOld(document).on('click', '#togglePassword', function(e) {
	  var input = jqOld("#id_password");
	  if (input.attr("type") === "password") {
	    input.attr("type", "text");
	    jqOld(this).removeClass("zmdi-eye");
	    jqOld(this).addClass("zmdi-eye-off");
	  } else {
	    input.attr("type", "password");
	    jqOld(this).removeClass("zmdi-eye-off");
	    jqOld(this).addClass("zmdi-eye");
	  }

	});


 jqOld(function(){
	jqOld('input').attr('autocomplete', 'off');

    // Add validation rules to your form
    jqOld("#form").validate({
        rules: {
            // Add validation rules for your form fields
            // Example:
            'input[]': {
                required: true,
            },
            // Add rules for other fields as needed
        },
        messages: {
            // Add custom error messages if needed
        },
    });

    jqOld("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        onStepChanging: function (event, currentIndex, newIndex) {
            // Check if the "Continue" button is clicked
            if (newIndex > currentIndex) {
                // Trigger form validation before proceeding to the next step
                if (!jqOld("#form").valid()) {
                    return false;
                }
            }

            // Your existing code for onStepChanging
            if (newIndex === 1) {
                jqOld('.wizard > .steps ul').addClass('step-0');
            } else {
                jqOld('.wizard > .steps ul').removeClass('step-0');
            }

            <?php
            $total = count($questions) + 3;
            $subtotal = count($questions);
            for ($i = 1; $i <= $total; $i++) { ?>
                if (newIndex === <?php echo $i; ?>) {
                    jqOld('.wizard > .steps ul').addClass('step-<?php echo $i; ?>');
                } else {
                    if (newIndex === <?php echo $total; ?>) { //if last step
                        jqOld('#wizard').find('a[href="#finish"]').remove();
                        jqOld('#wizard .actions li:last').show();
                        jqOld('#wizard .actions li:last').html('<button id="FinalSubmit" type="submit">Get Quotes</button>');
                    } else {
                        jqOld('#wizard .actions li:last').hide();
                    }
                    jqOld('.wizard > .steps ul').removeClass('step-<?php echo $i; ?>');
                }
            <?php } ?>

            return true;
        },
        onFinished: function (event, currentIndex) {
            // Check if the form is valid before submitting
            if (jqOld("#form").valid()) {
                jqOld("#form").submit();
            }
        },
        labels: {
            finish: "Get Quotes",
            next: "Continue",
            previous: "Back"
        }
    });

    // Custom Button Jquery Steps
    jqOld('.forward').click(function () {
        // Trigger form validation before proceeding to the next step
        if (jqOld("#form").valid()) {
            jqOld("#wizard").steps('next');
        }
    });

    jqOld('.backward').click(function () {
        jqOld("#wizard").steps('previous');
    });
    var input = document.querySelector("#phone");
	window.intlTelInput(input, {
	  initialCountry: "au",
	  nationalMode: false, // Set to false to enforce international format
      autoPlaceholder: "aggressive",
	  geoIpLookup: function(callback) {
	    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
	      var countryCode = (resp && resp.country) ? resp.country : "au";
	      console.log(countryCode)
	      callback(countryCode);
	    });
	  },
	  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js" // just for formatting/placeholders etc
	});
});

function Zipcode(){
//ajax request
// console.log(jqOld(".actions ul li:nth-child(2)").find());
	if(jqOld('.zipclass').val().length > 3){
	  jqOld(".actions ul li:nth-child(2)").css("cssText", "display: list-item !important;");
	}else{
	  jqOld(".actions ul li:nth-child(2)").css("cssText", "display: none !important;");

	}
}

function myFunction(){
//ajax request
var _token = jqOld('meta[name="csrf-token"]').attr('content');
// alert(_token);
        jqOld.ajax({
            url: "{{url('checkEmail')}}",
            type: 'post',
            data: {
                email : jqOld('.formEmail').val(),
                subdomain: "{{\Acelle\Model\Setting::subdomain()}}",
                _token : _token
            },
            dataType: 'json',
            success: function(data) {
            	console.log(data);
                if(data == true) {
                    console.log('Email exists!');
                    jqOld('#wizard .actions li:last').hide();
                    var html = "<span style='color:red'>email already exists</span><span style='float:right;cursor:pointer;' id='loginUser'>Login?</span>";
                    jqOld('#emailexist').html(html);
                }
                else {
                    console.log('Email doesnt!');
                    jqOld('#wizard .actions li:last').show();
                    jqOld('#emailexist').html('');
                }
            },
            error: function(data){
                //error
            }
        });
}

jqOld("#form").submit(function( event ) {
	console.log(jqOld('#wizard .actions li:last'));
	jqOld("#FinalSubmit").prop('disabled', true);
	jqOld('#wizard').find('a[href="#finish"]').empty();
	jqOld('#wizard').find('a[href="#finish"]').prepend('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
	jqOld("#FinalSubmit").css('cursor', 'not-allowed');
});
jqOld(document).on("click","#loginUser",function() {
   jqOld('#f_name').val('');
   jqOld('#l_name').val('');
   jqOld('#first').remove();
   jqOld('#last').remove();
   jqOld('#city').remove();
   jqOld('#mobileno').remove();
   jqOld('#wizard .actions li:last').show();
   jqOld('#emailexist').remove();
});
</script>
<!-- Template created and distributed by Colorlib -->
</body>
</html>