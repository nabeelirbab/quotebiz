<?php
$sitename = \Acelle\Model\Setting::get("site_name");
$sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));

?>
<!DOCTYPE html>
<html>
<head>
	<?php $job_design = Acelle\Jobs\HelperJob::form_design(); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{$sitename}}</title>
	 <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Open+Sans:wght@400;700&display=swap');
body{
	background: rgba(0,0,0,.075);
	}
.container{
	/*margin-top: 10px;*/
	margin-bottom: 50px;
}
.col-md-4{
	background: #F9F8F4;
	text-align: center;
	border-radius: 12px;
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}
.logo{
	text-align: left!important;
	transform: translate(-40px,20px);
	font-weight: 1000!important;
	font-size: 8px!important;
 	font-family: 'Abril Fatface', cursive!important;
}
.logo span{
	font-size: 20px;
}
.image{
	margin-top: 44%;
}
h6.mt-3{
	font-weight: bold;
}
.col-md-4 p{
	font-size: 12px;
	line-height: 15px;
	padding: 0 60px 0 60px;
	color: #0000009e;
	font-weight: 500;
}
.formclass{
	background: #fff;
	border-top-right-radius: 15px;
	border-bottom-right-radius: 15px;
}
p.mb-0{
	color: #6C6D6F;
	font-size: 10px;
	font-weight: bold;
}
strong{
	font-size: 12px;
}
.fa-phone-volume{
	margin-right: 4px;
	font-size: 12px;
}
.fs-1{
	font-size:16px;
	color: {{ ($job_design) ? $job_design->button_text_color:'#fff'}};

}
/*form.information{
	margin: 0 280px 0 100px;
}*/
h4.form-heading{
	font-weight: bold;
	font-size: 28px!important
}
p.form-para{
	font-size: 15px;
	font-weight: 500;
	color: #9f9f9f;
	line-height: 17px;
}
p.form-para::after{
	content: ".";
	font-size: 0;
	display: block;
	width: 8%;
	height: 4px;
	background: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
	margin: 10px 10px;
	transform: translateX(-10px);
}
.form-group {
    position: relative;
    margin-bottom: 0.5rem;
    /*margin-right: 90px;*/
}
.floatright{
	float: right;
}
.form-control {
    border-radius: 6px;
    font-size: 1.1rem;
    outline: 0;
}
.form-control:focus{
	box-shadow: none;
    border-radius: 0;
    border: 1px solid #dae0e5;;
}
.form-control-placeholder {
    /*position: absolute;
    top: 12px;
    left: 10px;
    transition: all 200ms;
    opacity: 0.5;
    font-size: 75%;*/
    font-size: 1.1rem;
    font-weight: 500;
    color: #444;
    margin-bottom: 8px;
}

.form-control:focus+.form-control-placeholder,
.form-control:valid+.form-control-placeholder {
    font-size: 60%;
    transform: translate3d(0, -75%, 0);
    opacity: 1;
    top: 12px;
}
.btn-primary{
	border: none!important;
	background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
	height: 46px!important;
}

.terms{
	font-size: 10px;
	color: #0000009e;
	font-weight: 500;
}
.terms a{
	color: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
}
.siteLogo{
	float: left;
}
.siteLogo img{
	width: 100%;
}
.login{
	color: {{ ($job_design) ? $job_design->login_color:'#6200EA'}};
}


@media screen and (max-width: 767px){
.mycol1{
		border-radius: 0;
		border-top-right-radius: 12px;
		border-top-left-radius: 12px;
		padding: 50px 50px 50px 50px;
	}
.floatright{
	float: none;
	text-align: center;
}
.image{
	margin-top: 0;
}
.mycol2{
		border-radius: 0;
		border-bottom-right-radius: 12px;
		border-bottom-left-radius: 12px;
		text-align: center;
		padding-bottom: 40px;
	}
/*form.information{
	margin: 10px 10px 0 10px;
}*/
	.form-group {
    margin: 10px 10px 0 10px;
}
.logo{
	transform: translate(-90px,-30px);
}
.siteLogo{
	float: none;
    text-align: center;
    margin-bottom: 33px;
}
.siteLogo img{
	width: 50%;
}
}
@media screen and (min-width: 767px)
{
/*	form.information{
	margin: 0 200px 0 50px;
}*/
	.form-group {
    /*margin-right: 40px;*/
}
}
@media screen and (min-width: 1200px){
/*	form.information{
	margin: 0 280px 0 100px;
}*/
	.form-group {
    margin-bottom: 0.5rem;
    /*margin-right: 80px;*/
}
}
.dogcFe {
	background-size: cover !important;
	background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);
   
}
#result{
	position: absolute;
    z-index: 1;
    width: 100%;
    max-height: 285px;
    overflow: auto;
}
#result li{
	cursor: pointer;
}
	</style>
</head>
<body class="dogcFe" style="min-height: 100%;">
	
<div class="container-fluid" style="height: 100vh;width: 96%;">
	<div class="siteLogo">
		<img class="mt-3" id="sitesmall" src="{{$sitesmalllogo}}">
	</div>
	@if(Auth::user())
	 @if(Auth::user()->user_type == 'client')
	 @elseif(Auth::user()->user_type == 'admin')
	 <div class="floatright p-2 mt-3">
	 <a href="{{ url('/admin') }}" class="btn btn-primary btn-lg">Dashboard</a>
	 </div>
	 @else
	 <div class="floatright p-2 mt-3">
	 <a href="{{ url('/users/login') }}" class="fs-1 mr-4 login"><b>Log in</b></a>	<a href="{{ url('/users/register') }}" class="btn btn-primary btn-lg">Register Business </a>
	 </div>
	 @endif
	@else
	<div class="floatright p-2">
	<a href="{{ url('/users/login') }}" class="fs-1 mr-4 login"><b>Log in</b></a>	<a href="{{ url('/users/register') }}" class="btn btn-primary btn-lg">Register Business</a>
	</div>
	@endif
		<div class="row justify-content-end" style="height: 100%;align-items: center;">
		
			<div class="col-md-7 formclass" style="box-shadow: -1px -1px 13px 7px rgba(0,0,0,0.27);border-radius: 12px">
				@if($job_design && $job_design->no_status == '1')
				<div class="d-flex pt-3 pr-2">
					<p class="ml-auto mb-0">Want to speak with an agent?</p>
				</div>	
				<div class="d-flex pr-2">
					<p class="ml-auto"><strong><i class="fas fa-phone-volume"></i>{{$job_design->agent_no}}</strong></p>
				</div>	
				@endif
				<form class="information" action="{{ url('questionnaire')}}" method="post" style="padding: 25px " autocomplete="off">
					{{ csrf_field()}}
					<h3 class="form-heading">
					{{ ($job_design) ? $job_design->title_heading : 'What are you looking for?'}}</h3>
					<p class="form-para"> 
						{{ ($job_design) ? $job_design->titlesub_heading : 'Let us know what you are looking for and we will provide you up to 3 quotes.'}}
						
					</p>
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
					 <label class="form-control-placeholder" for="search">{{ ($job_design) ? $job_design->category_heading : 'What service do you need?'}}</label>
					 <input type="text" class="form-control" name="category_name" id="search" placeholder="eg DJ, Cleaner, Plumber etc" required>
					  <ul class="list-group" id="result">
				        
				    </ul>
					  </div>
					</div>
                   <div class="col-md-6">
					<div class="form-group">
					 <label class="form-control-placeholder" for="zipcode">{{ ($job_design) ? $job_design->postcode_text : 'Where you need ?'}}</label>
					 <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Post Code" required>
					  </div>
					</div>

					<div class="col-md-5">
						<div class="form-group mt-3"><button type="submit" class="btn btn-block btn-primary"><span style="font-size: 17px" >{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}<i class="fa fa-arrow-right"></i></span></button></div>
					</div>
					 
					</div>

					 <p class="terms mt-4">By clicking "{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}", you consent to the {{$sitename}} storing the information submitted on this page so you can get most up-to-date quotes, no matter what device you are using. You also agree to The {{$sitename}}'s <a href="#" data-toggle="modal" data-target="#terms">Terms of Service</a> and <a href="#" data-toggle="modal" data-target="#privacy">Privacy Policy.</a></p>
				</form>
			</div>
			
			<!-- Terms Modal -->
			<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Terms of Service</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	@if($job_design)
			        {{$job_design->terms}}
			        @endif
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			        
			      </div>
			    </div>
			  </div>
			</div>

			<!-- Privacy Modal -->
			<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	@if($job_design)
			        {{$job_design->privacy_policy}}
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
</body>
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<script type="text/javascript">

	$.ajaxSetup({ cache: false });

     $('#search').keyup(function(){
     $('#result').html('');

		if($('#search').val()){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
	        url: "{{ url('category-search')}}",
	        type:"post",
	        data:{ category_name:$('#search').val(), _token: _token},
	        success:function(response){
	           console.log(response);
	           $('#result').html(response);
	        },
	        error: function (xhr) {

	        }

        });

		}
     });

  $('#result').on('click', 'li', function() {
  var click_text = $(this).text();
  $('#search').val($.trim(click_text));
  $("#result").html('');
 });
</script>
</html>