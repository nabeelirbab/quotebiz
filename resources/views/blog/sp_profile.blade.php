
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
<style type="text/css">
	.pac-container {
    z-index: 1060 !important;
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
.form-group {
  position: relative;
  margin-bottom: 0.5rem;
}
.floatright {
 float: right;
}
.btn-primary {
  border: none !important;
  background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
  height: 35px !important;
}
.btn-success {
  width: 100%;
  border: none !important;
  border-radius: 0.55rem;
  background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
  font-size: 1.5rem;
  height: 43px;
  font-weight: 500;
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
</style>
<section style="border-top: 1px solid #c9c9c9; background-color: #f7f8fa ">

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-md-3">
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
                    <div class=" text-center">
                      <button class="btn btn-success" data-toggle="modal" data-target="#quoteModal">Request A Quote</button>
                    </div>
                </div>
            </div>
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
				<div class="row mt-4 mb-3">
					<div class="col-md-12 d-flex">
						<div class="mr-5 mt-1" style="width: 25px">
							<img src="{{ asset('frontend-assets/location.png') }}" class="mr-4">
						</div>
						<div>
						   <h4 class="m-0">Service Area</h4>
                          <p class="">
                          	@if($user->city)
		                     {{Acelle\Jobs\HelperJob::cityname($user->city)->name}}
		                     @elseif($user->state)
		                      {{Acelle\Jobs\HelperJob::statename($user->state)->name}}
		                     @else
		                     {{Acelle\Jobs\HelperJob::countryname($user->country)->name}}
		                     @endif
		                    </p>
						</div>
					</div>
				</div>
				@if($user->experience)
				<div class="row mt-3 mb-5 pb-5 border-bottom">
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
                @if($user->biography)
				<h2 class=" mt-3 mb-4">Biography</h2>
				<div class="row mb-5 border-bottom">
					<div class="col-md-12">
						<p>
						{{$user->biography}}
						</p>
					</div>
				</div>
				@endif
				@if(count($user->gallery) > 0)
				<h2 class="mb-5">Gallery</h2>
				 <div class="row">
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
				<div class="row mr-1 mb-5">
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
			    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered">
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
								
								<div class="row">
								<div class="col-md-12">
								<div class="form-group">
								  <label class="form-control-placeholder"
								         for="search">{{ ($job_design) ? $job_design->category_heading : 'What service do you need?'}}</label>
								
								  <select class="form-control select2" name="category_name" required="" style="height: calc(4.25rem + 2px);">
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
			</div>
			
		</div>
		
	</div>
</section>

@include('blog.footer')
<script rel="preload" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBNL_1BSqiKF5qf0WqLbMT4xF1dB1Aux1M&libraries=places"></script>

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