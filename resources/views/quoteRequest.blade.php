<?php
$sitename = \Acelle\Model\Setting::get("site_name");
$sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
$provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
$providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $job_design = Acelle\Jobs\HelperJob::form_design(); ?>
<meta charset="UTF-8">
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ \Acelle\Model\Setting::get("site_description") }}">
<meta name="keywords" content="{{ \Acelle\Model\Setting::get("site_keyword") }}" />
<meta name="php-version" content="{{ phpversion() }}" />
@if(\Acelle\Model\Setting::get("meta_tag"))
{!! \Acelle\Model\Setting::get("meta_tag") !!}
@endif
<link rel="canonical" href="{{ url('/') }}" />
<title>{{ \Acelle\Model\Setting::get("site_name") }} - HomePage</title>
@if (\Acelle\Model\Setting::get('site_favicon'))
  <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_favicon')) }}"/>
@else
  @include('layouts.core._favicon')
@endif
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5462023016685790"
     crossorigin="anonymous"></script>
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Open+Sans:wght@400;700&display=swap');
body {
background: rgba(0, 0, 0, .075);
}

.container {
  margin-bottom: 50px;
}
.select2-selection__rendered {
  line-height: 35px !important;
  color: #52648482 !important;
  font-size: 1.1rem;
}
.select2-container .select2-selection--single {
  height: 50px !important;
  border-radius: 6px;
  border: 1px solid #c1c1c1;
}
.select2-selection__arrow {
  height: 50px !important;
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
  max-width: 9%;
}
.login{
color: {{ ($job_design) ? $job_design->login_color:'#6200EA'}};
}
.col-md-4 {
  background: #F9F8F4;
  text-align: center;
  border-radius: 12px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.logo {
  text-align: left !important;
  transform: translate(-40px, 20px);
  font-weight: 1000 !important;
  font-size: 8px !important;
  font-family: 'Abril Fatface', cursive !important;
}

.logo span {
  font-size: 20px;
}

.image {
  margin-top: 44%;
}

h6.mt-3 {
  font-weight: bold;
}

.col-md-4 p {
  font-size: 12px;
  line-height: 15px;
  padding: 0 60px 0 60px;
  color: #0000009e;
  font-weight: 500;
}

.formclass {
  background: rgba(255, 255, 255, 0.8);
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
}
p.mb-0 {
  font-size: 10px;
  font-weight: bold;
  color: #9f9f9f;
}
strong {
  font-size: 12px;
}
.fa-phone-volume {
  margin-right: 4px;
  font-size: 12px;
}
.fs-1 {
  font-size: 16px;
  color: {{ ($job_design) ? $job_design->button_text_color:'#fff'}};
}
h4.form-heading {
  font-weight: bold;
  font-size: 28px !important
}
p.form-para {
  font-size: 15px;
  font-weight: 500;
  color: #9f9f9f;
  line-height: 17px;
}
p.form-para::after {
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
}
.floatright {
 float: right;
}
.form-control {
  border-radius: 6px;
  font-size: 1.1rem;
  outline: 0;
}
.select2-container--default.select2-container--open .select2-selection--single {
  border-color: {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}} !important;
}
.select2-container--default .select2-selection--single:focus {
  box-shadow: none;
  border-radius: 6px;
  border: 1px solid {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
}
.form-control:focus {
  box-shadow: none;
  border-radius: 6px;
  border: 1px solid {{ ($job_design) ? $job_design->button_color:'#c1c1c1'}};
}

.form-control-placeholder {
  font-size: 1.1rem;
  font-weight: 500;
  color: #364a63;
  margin-bottom: 8px;
}
.form-control:focus + .form-control-placeholder,
.form-control:valid + .form-control-placeholder {
  font-size: 60%;
  transform: translate3d(0, -75%, 0);
  border-radius: 6px;
  opacity: 1;
  top: 12px;
}
.btn-primary {
  border: none !important;
  background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
  height: 46px !important;
}
.terms {
  font-size: 10px;
  color: #0000009e;
  font-weight: 500;
}
.terms a {
  color: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}};
}
.siteLogo {
  float: left;
}
.siteLogo img {
  width: 100%;
}
.login {
  color: {{ ($job_design) ? $job_design->login_color:'#6200EA'}};
}
@media screen and (max-width: 667px) {
.mycol1 {
  border-radius: 0;
  border-top-right-radius: 12px;
  border-top-left-radius: 12px;
  padding: 50px 50px 50px 50px;
}
.floatright {
  float: none;
  text-align: center;
}
.image {
  margin-top: 0;
}
.mycol2 {
  border-radius: 0;
  border-bottom-right-radius: 12px;
  border-bottom-left-radius: 12px;
  text-align: center;
  padding-bottom: 40px;
}
.form-group {
  margin: 10px 10px 0 10px;
}
.logo {
  transform: translate(-90px, -30px);
}
.siteLogo {
  float: none;
  text-align: center;
  margin-bottom: 80px;
  max-width: 100%;
}
.siteLogo img {
  width: 50%;
}
}
@media screen and (min-width: 1200px) {
.form-group {
  margin-bottom: 0.5rem;
}
}
.centered-text {
  padding: 5px 17px 5px 17px;
  height: 5vh;
  text-align: center;
}
.social{
  float: right;
}
.social a {
 font-size: 25px;
}

.dogcFe {
  background-size: cover !important;
  width: 100%;
  height: 94vh;
  -webkit-box-align: start;
  align-items: start;
  -webkit-box-pack: center;
  justify-content: center;
  min-height: 650px;
  max-height: 1500px;
  position: relative;
  margin: 0px 0px 0px;
  background: url({{ ($job_design) ? asset('frontend-assets/images/'.$job_design->backgroup_image):'https://cdn.oneflare.com/static/client/hero/home-hero-4.jpg'}}) no-repeat rgb(238, 238, 238);

}
#result {
  position: absolute;
  z-index: 2;
  width: 100%;
  max-height: 285px;
  overflow: auto;
}
#result li {
  cursor: pointer;
}
</style>
</head>
<body>
<div class="container-fluid dogcFe">
<div class="siteLogo">
<img class="mt-4" id="sitesmall" src="{{$sitesmalllogo}}" alt="{{$sitename}}">
</div>
@if(Auth::user())
@if(Auth::user()->user_type == 'client')
<div class="floatright mt-4">
<a href="{{ url('/customer') }}" class="btn btn-primary btn-lg">Dashboard</a>
</div>
@elseif(Auth::user()->user_type == 'admin')
<div class="floatright mt-4">
<a href="{{ url('/admin') }}" class="btn btn-primary btn-lg">Dashboard</a>
</div>
@else
<div class="floatright mt-4">
<a href="{{ url('/service-provider') }}" class="btn btn-primary btn-lg">Dashboard</a>
</div>
@endif
@else
<div class="floatright mt-4">
<a href="{{ url('/users/login') }}" class="fs-1 mr-4 login"><b>Log in</b></a> <a
href="{{ url('/users/register') }}" class="btn btn-primary btn-lg">Register Business</a>
</div>
@endif
<div class="row justify-content-{{($job_design) ? $job_design->position : 'end'}}"
style="height: 100%;align-items: center;">
<div class="col-md-6 formclass" style="box-shadow: -1px -1px 13px 7px rgba(0,0,0,0.27);border-radius: 12px">
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{$errors->first()}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($job_design && $job_design->no_status == '1')
<div class="d-flex pt-3 pr-2">
<p class="ml-auto mb-0">Want to speak with an agent?</p>
</div>
<div class="d-flex pr-2">
<p class="ml-auto"><strong><i class="fas fa-phone-volume"></i>{{$job_design->agent_no}}</strong></p>
</div>
@endif
<form class="information" action="{{ url('quote-form')}}" method="post" style="padding: 25px "
autocomplete="off">
{{ csrf_field()}}
<h3 class="form-heading">
{{ ($job_design) ? $job_design->title_heading : 'What are you looking for?'}}</h3>
<p class="form-para">
{{ ($job_design) ? $job_design->titlesub_heading : 'Let us know what you are looking for and we will provide you up to 3 quotes.'}}
</p>
<div class="row">
<div class="col-md-6">
<div class="form-group">
  <label class="form-control-placeholder"
         for="search">{{ ($job_design) ? $job_design->category_heading : 'What service do you need?'}}</label>
  @if($job_design && $job_design->search_box == 'auto_suggest')     
  <input type="text" class="form-control" name="category_name" id="search"
         placeholder="eg {{Acelle\Jobs\HelperJob::categoryDetail(Acelle\Jobs\HelperJob::categoryname())->category_name}}... etc"
         required>
  <ul class="list-group" id="result">
  </ul>
  @else
  <select class="form-control select2" name="category_name" style="height: 200px" required="">
     <option value="" disabled selected="">Select Service</option>
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
  <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Location"
         required>
  @if(Session::has('error'))
      <strong style="color: red">Location Error : <span>{{Session::get('error')}}</span></strong>
  @endif
  <div class="custom-control custom-control-sm custom-checkbox notext mt-2">
    <input type="checkbox" class="custom-control-input" id="local_business"
           name="local_business" value="local business">
    <label class="custom-control-label" for="local_business" style="font-size: 13px;color: #9f9f9f;">I prefer a local business</label>
  </div>
  <input type="hidden" id="latitude" name="latitude">
  <input type="hidden" id="longitude" name="longitude">
  <input type="hidden" id="state" name="state">
</div>
</div>
<div class="col-md-5">
<div class="form-group mt-3">
  <button type="submit" class="btn btn-block btn-primary"><span style="font-size: 17px">{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}<i
                    class="fa fa-arrow-right"></i></span></button>
</div>
</div>
</div>
<p class="terms mt-4">By clicking "{{ ($job_design) ? $job_design->button_text : 'Send Me Quotes'}}",
you consent to the {{$sitename}} storing the information submitted on this page so you can get most
up-to-date quotes, no matter what device you are using. You also agree to The {{$sitename}}'s <a
    href="#" data-toggle="modal" data-target="#terms">Terms of Service</a> and <a href="#"
                                                                                  data-toggle="modal"
                                                                                  data-target="#privacy">Privacy
Policy.</a></p>
</form>
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
<div class="centered-text container-fluid">
    <span class="text-muted" style="line-height: 2.5;">Copyright © <?php echo date("Y"); ?> {{$sitename}}</span>
    <div class="social">
    <a href=""><em class="icon ni ni-facebook-fill"></em></a>
    <a href=""><em class="icon ni ni-instagram-round"></em></a>
    <a href=""><em class="icon ni ni-linkedin-round"></em></a>
    <a href=""><em class="icon ni ni-twitter-round"></em></a>
    <a href=""><em class="icon ni ni-whatsapp-round"></em></a>
    </div>
</div>
</body>
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyD4pdnGpoS5aI6Qn7N__nHf1qtpQF-rBHs&libraries=places"></script>
<script type="text/javascript">
$('.select2').select2({ width: '300px', dropdownCssClass: "bigdrop" });
$.ajaxSetup({cache: false});
$('#search').keyup(function () {
$('#result').html('');
if ($('#search').val()) {
var _token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
url: "{{ url('category-search')}}",
type: "post",
data: {category_name: $('#search').val(), _token: _token},
success: function (response) {
console.log(response);
$('#result').html(response);
},
error: function (xhr) {
}
});
}
});
$('#result').on('click', 'li', function () {
var click_text = $(this).text();
$('#search').val($.trim(click_text));
$("#result").html('');
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
</html>