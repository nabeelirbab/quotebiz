
<?php
	$data = new stdClass();
	$data->title = $user->first_name . ' ' . $user->last_name;
	$data->image = $user->user_img;
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
@media screen and (max-width: 667px) {
.col-md-4{
	flex: 0 0 100%;
    max-width: 100%;
}
}
</style>
<section style="border-top: 1px solid #c9c9c9; background-color: #f7f8fa ">

	<div class="container mt-5 mb-5" style="width: 93%">
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
                <div class="card-body">
                    <h5 class="card-title text-center">{{$user->first_name}} {{$user->last_name}}</h5>
                    <p class="card-text text-center">
                      @foreach(json_decode($user->category_id) as $key => $cat)
                        <span class="data-value badge badge-pill badge-info">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                        @if ($key < count(json_decode($user->category_id)) - 1)
                             
                        @endif
                    @endforeach
                    </p>
                    <p class="text-center mb-2">What is the date of your event?</p>
                    <div id="calendar"></div>
                    <div class=" text-center">
                      <button class="btn btn-success" data-toggle="modal" data-target="#quoteModal">Request A Quote</button>
                    </div>
                </div>
            </div>
            <p class="text-center mt-3" data-toggle="modal" data-target="#shareModal"><img src="{{ asset('images/share.png') }}" style="width: 4%;"> <span style="text-decoration: underline;cursor: pointer;">Share</span> </p>
			</div>
			<div class="col-md-8 ml-md-auto">
				<h2 class="ml-0">About {{$user->first_name}} </h2>
				<div class="row mt-5 mb-4 ">
					<div class="col-md-12 d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/category.png') }}" class="mr-4">
						</div>
						<div>
						   <h4 class="m-0">Category</h4>
                          <p class="card-text text-center">
		                      @foreach(json_decode($user->category_id) as $key => $cat)
		                        <span class="data-value">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
		                        @if ($key < count(json_decode($user->category_id)) - 1)
		                             ,
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
				<div class="row mb-5 pb-5 border-bottom">
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
				 <div class="row border-bottom mb-5">
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
				<div class="row mr-1 mb-5 border-bottom">
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
				<div class="col-lg-12 pl-0" style="box-shadow: -1px -1px 6px -6px rgba(0,0,0,0.27);border-radius: 12px">
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
				  <input type="text" class="form-control" name="category_name" id="search"
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
				    <label class="custom-control-label" for="local_business" style="font-size: 13px;color: #9f9f9f;">I prefer a local business</label>
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
  	<!-- Modal -->
				<div class="modal fade" id="biographyModal" tabindex="-1" role="dialog" aria-labelledby="biographyModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h5 class="modal-title" id="biographyModalLabel"> Biography</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
				                <div class="modal-body">
                                <textarea rows="24" style="border: none; background:none; color:  #222222;width: 100%" disabled>{!! $user->biography !!}</textarea>
                            </div>
				            </div>
				        </div>
				    </div>
				</div>
			    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered modal-lg">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title" id="imageModalLabel">Gallery Slider</h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
			                <div id="imageSlider" class="carousel slide" data-ride="carousel">
			                    <div class="carousel-inner">
			                    	@foreach($user->gallery as $key => $gallery)
							        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
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
			        </div>
			    </div>
			</div>

			<!-- Quote model -->

			<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title" id="imageModalLabel">Send a quote request to {{$user->first_name}} {{$user->last_name}} </h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
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
			        </div>
			    </div>
			</div>


			<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			            <h2 class="item-title">{{$user->first_name}} {{$user->last_name}}</h2>
			                
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
                        <div class="single-blog-banner-layout1" style="position: static;">
                      	<div class="banner-content" style="bottom: 0">
                        <ul class="item-social mb-2 text-center">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i>SHARE</a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($user->first_name) }}" target="_blank" class="twitter"><i class="fab fa-twitter"></i>SHARE</a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($user->first_name) }}" target="_blank" class="linkedin"><i class="fab fa-linkedin"></i>SHARE</a></li>
                        </ul>
                       </div>
                      </div>
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