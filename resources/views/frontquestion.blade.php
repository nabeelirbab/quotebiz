<?php
	if(!$zipcode || !$category){
// dd($category);
		$url = url('/');
		 header("Location: ".$url);
		die();
	}
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
		<link rel="stylesheet" href="{{ asset('frontend-assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">
	
		<!-- STYLE CSS -->
		<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/style2.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
		
		<style>
			
		<?php
		  $total = count($questions)+1;
		  $mid = 90/$total;
		  $final = 100/$total;
		// dd($total,$final,'dddd'); 
		  ?>
		  /*.wizard > .steps ul.step-1:before {
			left:<?php echo $mid; ?>%;
			transition: all 0.5s ease; }
		  .wizard > .steps ul.step-1:after {
			width: <?php echo $final; ?>%;
			transition: all 0.5s ease;
			 }*/

		<?php
		  for($i=1; $i <= $total; $i++){ ?>
		
		 .wizard > .steps ul.step-<?php echo $i; ?>:before {
			left:<?php echo $i*$mid; ?>%;
			transition: all 0.5s ease; }
		  .wizard > .steps ul.step-<?php echo $i; ?>:after {
			width: <?php echo $i*$final; ?>%;
			transition: all 0.5s ease; }
		<?php } ?>

.actions li button {
    padding: 0;
    border: none;
    display: inline-flex;
    height: 54px;
    width: 180px;
    letter-spacing: 1.3px;
    align-items: center;
    background: rgb(128 57 242);
    font-family: "Open-Sans";
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
    font-family: Material-Design-Iconic-Font;
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
		  max-width: 25%;
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
		  /*padding: 1rem;*/
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
		  border: 1px solid #843ff2;
		  &::after {
		    color:black;
		    font-family: FontAwesome;
		    border: 2px solid hsla(150, 75%, 45%, 1);
		    content: "\f00c";
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
		  border: 1px solid #843ff2;
		  &::after {
		    color: black;
		    font-family: FontAwesome;
		    border: 2px solid hsla(150, 75%, 45%, 1);
		    content: "\f00c";
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
 	font-size: 13px;
 }
 label img{
    vertical-align: middle;
    max-height: 140px !important;
    max-width: 140px !important;

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
			  <img src="{{$sitesmalllogo}}" alt="Logo">
			</a>
		</div>
		<div class="wrapper">
		
            <form action="{{ url('storeform') }}" method="post" id="form" >
            	 {{ csrf_field() }}
            	<div class="form-header">
            		
            		<input type="hidden" name="category_id" value="{{$category->id}}">
            		<input type="hidden" name="zip_code" value="{{$zipcode}}">
            		<input type="hidden" name="state" value="{{$state}}">
            		<input type="hidden" name="latitude" value="{{$latitude}}">
            		<input type="hidden" name="longitude" value="{{$longitude}}">
            		<input type="hidden" name="local_business" value="{{$local_business}}">
            		<input type="hidden" name="admin_id" value="{{\Acelle\Model\Setting::subdomain()}}">
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
						  	
						    <h2 style="padding-top: 10px" class="font-class">{{$choices->choice}}</h2>
						   
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
						      <h2 style="padding-top: 10px" class="font-class">{{$choices->choice}}</h2>
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
	                    		<i class="zmdi zmdi-eye zmdi-hc-lg" id="togglePassword" style="cursor: pointer;color: #8039f2;bottom: 13px"></i>
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
	                    		<i class="zmdi zmdi-eye zmdi-hc-lg" id="togglePassword" style="cursor: pointer;color: #8039f2;bottom: 13px;"></i>
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
	jqOld("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        onStepChanging: function (event, currentIndex, newIndex) { 
        	if ( newIndex === 1 ) {
        	
                jqOld('.wizard > .steps ul').addClass('step-0');
            }else{
            	jqOld('.wizard > .steps ul').removeClass('step-0');
            }


		<?php
		$total = count($questions)+1;

		$subtotal = count($questions);
		for($i =1; $i <= $total; $i++){ ?>
			// alert(<?php echo $total; ?>);
            if ( newIndex === <?php echo $i; ?> ) {
            	// alert(newIndex);
                jqOld('.wizard > .steps ul').addClass('step-<?php echo $i; ?>');
                // $('#wizard .actions li:last').hide();

            } else {
            	if (newIndex === <?php echo $total; ?>) { //if last step
		   //remove default #finish button
				   jqOld('#wizard').find('a[href="#finish"]').remove(); 
				   //append a submit type button
				   jqOld('#wizard .actions li:last').show();
				   jqOld('#wizard .actions li:last').html('<button id="FinalSubmit" type="submit">Get Quotes</button>');
				}else{

		          jqOld('#wizard .actions li:last').hide();
				}
				// jqOld(".actions ul li:nth-child(2)").css("cssText", "display: list-item !important;");
                jqOld('.wizard > .steps ul').removeClass('step-<?php echo $i; ?>');
            }
           
		<?php } ?>
            return true; 
        },
        onFinished: function (event, currentIndex) {
		 
		  jqOld("#form").submit();
		},
        labels: {
            finish: "Get Quotes",
            next: "Continue",
            previous: "Back"
        }
    });
    // Custom Button Jquery Steps
    jqOld('.forward').click(function(){
    	jqOld("#wizard").steps('next');
    })
    jqOld('.backward').click(function(){
        jqOld("#wizard").steps('previous');
    })
    var input = document.querySelector("#phone");
	window.intlTelInput(input, {
	  initialCountry: "au",
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
	jqOld("#FinalSubmit").prop('disabled', true);
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