<?php
	if(!$zipcode || !$category){
// dd($category);
		$url = url('get-quote');
		 header("Location: ".$url);
		die();
	}
	$job_design = Acelle\Jobs\HelperJob::form_design();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>QuoteBiz</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="quotebiz.com">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{ asset('frontend-assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">
	
		<!-- STYLE CSS -->
		<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/css/style2.css') }}">
		<style>
			
		<?php
		  $total = count($category->questions)+1;
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
    background: #e4bd37;
    font-family: "Muli-Bold";
    cursor: pointer;
    position: relative;
    padding-left: 34px;
    text-transform: uppercase;
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
		  border-radius: 20px;
		  padding: 1rem;
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
    max-width: 50%;
}
}
.dogcFe {
	background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) center bottom / cover no-repeat rgb(238, 238, 238);
	
}
/*.actions ul li:nth-child(2) {
   display:none !important;
}*/
		</style>
	</head>
	<body class="dogcFe">
<?php
// dd(Acelle\Model\Language::getSelectOptions()[0]);
?>
		<div class="wrapper">
			
            <form action="{{ url('storeform') }}" method="post" id="form">
            	 {{ csrf_field() }}
            	<div class="form-header">
            		<a href="#" style="margin-bottom: 20px;font-size: 20px">#{{$category->category_name}} Quote Questions</a>
            		<input type="hidden" name="category_id" value="{{$category->id}}">
            		<input type="hidden" name="zip_code" value="{{$zipcode}}">
            		<input type="hidden" name="admin_id" value="{{request('account')}}">

            	</div>
            	<div id="wizard">
            		
				   @foreach($category->questions as $question)
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
	                	<div class="mainclass justify-content-center">
		                @if($question->choice_selection == "single")		
	                     @foreach($question->choices as $key => $choices)
		                  <div>

						  <input type="radio" id="control_0{{$choices->id}}" name="option[{{$question->id}}]" value="{{$choices->choice }}" @if($key == 0) checked @endif>
						  <label for="control_0{{$choices->id}}">
						  	@if($choices->icon)
                              <img src="{{ asset('/frontend-assets/images/categories/'.$choices->icon) }}" style="height: 185px;">
						  	@else
                             <img src="{{ asset('/frontend-assets/images/icons/option.png') }}">
						  	@endif
						  	
						    <h2>{{$choices->choice}}</h2>
						   
						  </label>
						</div>
						@endforeach
						@elseif($question->choice_selection == "multiple")
						@foreach($question->choices as $key => $choices)
	                     <div>
						  <input type="checkbox" id="control_0{{$choices->id}}" name="choices[]" value="{{$question->id}},{{$choices->choice}}" @if($key == 0) checked @endif>
						  <label for="control_0{{$choices->id}}">
						  	@if($choices->icon)
                              <img src="{{ asset('/frontend-assets/images/categories/'.$choices->icon) }}" style="height: 185px;">
						  	@else
                             <img src="{{ asset('/frontend-assets/images/icons/option.png') }}">
						  	@endif
						    <h2>{{$choices->choice}}</h2>
						   
						  </label>
						</div>
						@endforeach
						@elseif($question->choice_selection == "datepicker")
						<div class="row d-flex justify-content-center" style="max-width: 100%">
                            <div class="form-row col-md-12">
	                    	<div class="form-holder">
	                    		<!-- <span>Where do you need it?</span> -->
	                    		<input type="date" class="form-control zipclass" name="date[]" placeholder="Enter Postcode" required>
	                    	</div>
	                    </div>
	                </div>
						@else
						<div class="row d-flex justify-content-center" style="max-width: 100%">
                         <div class="form-row col-md-12">
	                    	<div class="form-holder">
	                    		<!-- <span>Where do you need it?</span> -->
	                    		<input type="text" class="form-control zipclass" name="input[]" placeholder="{{$question->question}}" required>
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
	                	<div class="row">
	                		
	                    <div class="form-row col-md-12">
	                    	
	                    	<div class="form-holder">
	                    		<textarea  class="form-control" rows="5" cols="70" name="additional_info"></textarea>
	                    	</div>
	                    </div>	
	                   
	                	</div>
	                </section>
				@if(Auth::user())
					@if(Auth::user()->user_type == 'client')
	       
	                @else
	                <h4></h4>
	                <section>
	                	<h3 style="text-align: center;color: black">Alright, let's get your details and create your tailored online estimate!</h3>
	                	<div class="row">
	                		<input type="hidden" name="user_type" value="client">
	                		<input type="hidden" name="subdomain" value="{{request('account')}}">
	                    <div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>First Name</span>
	                    		<input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>Last Name</span>
	                    		<input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
	                    	</div>
	                    </div>	
                     	<div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>Email</span>&nbsp;&nbsp;<span id="emailexist" style="color: red"></span>
	                    		<input type="email" name="email" onblur="myFunction()"  class="form-control formEmail" name="email" placeholder="Enter Email">
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px">
	                    	
	                    	<div class="form-holder">
	                    		<span>Password</span>
	                    		<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
	                    	</div>
	                    </div>
	                    <div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>City</span>
	                    		<input type="text" name="city" class="form-control" name="email" placeholder="Enter City" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px">
	                    	
	                    	<div class="form-holder">
	                    		<span>Mobile No</span>
	                    		<input type="text" name="mobileno" class="form-control" placeholder="eg +92xxxxxxxx" required>
	                    	</div>
	                    </div>
	                   		
	                   
	                	</div>
	                </section>

					@endif

					@else
<!-- SECTION 3 -->
	                <h4></h4>
	                <section>
	                	<h3 style="text-align: center;color: black">Alright, let's get your details and create your tailored online estimate!1111</h3>
	                	<div class="row">
	                		<input type="hidden" name="user_type" value="client">
	                		<input type="hidden" name="subdomain" value="{{request('account')}}">
	                    <div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>First Name</span>
	                    		<input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>Last Name</span>
	                    		<input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
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
	                    		<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
	                    	</div>
	                    </div>

	                     <div class="form-row col-md-6">
	                    	
	                    	<div class="form-holder">
	                    		<span>City</span>
	                    		<input type="text" name="city" class="form-control" name="email" placeholder="Enter City" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row col-md-6" style="margin-bottom: 38px">
	                    	
	                    	<div class="form-holder">
	                    		<span>Mobile No</span>
	                    		<input type="text" name="mobileno" class="form-control" placeholder="eg +92xxxxxxxx" required>
	                    	</div>
	                    </div>

	                	</div>
	                </section>

					@endif
            	</div>
            </form>
		</div>

		  
		<script src="{{ asset('frontend-assets/js/jquery-3.3.1.min.js') }}"></script>
		
		<!-- JQUERY STEP -->
		<script src="{{ asset('frontend-assets/js/jquery.steps.js') }}"></script>


		<script>
		$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        onStepChanging: function (event, currentIndex, newIndex) { 
        	if ( newIndex === 1 ) {
        	
                $('.wizard > .steps ul').addClass('step-0');
            }else{
            	$('.wizard > .steps ul').removeClass('step-0');
            }


		<?php
		$total = count($category->questions)+1;

		$subtotal = count($category->questions);
		for($i =1; $i <= $total; $i++){ ?>
			// alert(<?php echo $total; ?>);
            if ( newIndex === <?php echo $i; ?> ) {
            	// alert(newIndex);
                $('.wizard > .steps ul').addClass('step-<?php echo $i; ?>');
                // $('#wizard .actions li:last').hide();

            } else {
            	if (newIndex === <?php echo $total; ?>) { //if last step
		   //remove default #finish button
				   $('#wizard').find('a[href="#finish"]').remove(); 
				   //append a submit type button
				   $('#wizard .actions li:last').show();
				   $('#wizard .actions li:last').html('<button type="submit">Get Quotes</button>');
				}else{

		          $('#wizard .actions li:last').hide();
				}
				// $(".actions ul li:nth-child(2)").css("cssText", "display: list-item !important;");
                $('.wizard > .steps ul').removeClass('step-<?php echo $i; ?>');
            }
           
		<?php } ?>
		

            return true; 
        },
        onFinished: function (event, currentIndex) {
		  $("#form").submit();
		  // alert('hell');
		},
        labels: {
            finish: "Get Quotes",
            next: "Continue",
            previous: "Back"
        }
    });
    // Custom Button Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    })
  
});

function Zipcode(){
//ajax request
// console.log($(".actions ul li:nth-child(2)").find());
	if($('.zipclass').val().length > 3){
	  $(".actions ul li:nth-child(2)").css("cssText", "display: list-item !important;");
	}else{
	  $(".actions ul li:nth-child(2)").css("cssText", "display: none !important;");

	}
}

function myFunction(){
//ajax request
var _token = $('meta[name="csrf-token"]').attr('content');
// alert(_token);
        $.ajax({
            url: "{{url('checkEmail')}}",
            type: 'post',
            data: {
                email : $('.formEmail').val(),
                subdomain: "{{request('account')}}",
                _token : _token
            },
            dataType: 'json',
            success: function(data) {
            	console.log(data);
                if(data == true) {
                    console.log('Email exists!');
                    $('#wizard .actions li:last').hide();
                    $('#emailexist').html('email already exists');
                }
                else {
                    console.log('Email doesnt!');
                    $('#wizard .actions li:last').show();
                    $('#emailexist').html('');
                }
            },
            error: function(data){
                //error
            }
        });
}


		</script>
<!-- Template created and distributed by Colorlib -->
</body>
</html>