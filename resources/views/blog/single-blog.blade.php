<?php
   
    $job_design = Acelle\Jobs\HelperJob::form_design(); 
    $sitename = \Acelle\Model\Setting::get("site_name");
  $sitetitle = \Acelle\Model\Setting::get("site_title");
  $sitetagline = \Acelle\Model\Setting::get("site_tagline");
  $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country);
  $job_design = Acelle\Jobs\HelperJob::form_design(); 
?>
@include('blog.header',['post' => $post])
        <!-- Header Area End Here -->
        <!-- Single Blog Banner Start Here -->
        <section class="single-blog-wrap-layout1">
            <div class="single-blog-banner-layout1">
                <div class="banner-img">
                    <img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="blog">
                </div>
                <div class="banner-content">
                    <div class="container">
                        <ul class="entry-meta meta-color-light2">
                            <li><i class="fas fa-calendar-alt"></i>{{ $post->created_at->format('M j, Y') }}</li>
                        </ul>
                        <h2 class="item-title">{{$post->title}}</h2>
                      
                        <ul class="item-social">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i>SHARE</a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="twitter"><i class="fab fa-twitter"></i>SHARE</a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($post->title) }}" target="_blank" class="linkedin"><i class="fab fa-linkedin"></i>SHARE</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gutters-50">
                    <div class="col-lg-8 border-bottom mb-5">
                        <div class="single-blog-box-layout1">
                            <div class="blog-details">
                              {!! $post->description !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 sidebar-widget-area sidebar-break-md">
                        <div class="widget">
                            <div class="section-heading heading-dark">
                                <h3 class="item-heading">POPULAR POSTS</h3>
                            </div>
                            <div class="widget-latest">
                                <ul class="block-list">
                                    @foreach($relatedPosts as $post)
                                    <li class="single-item">
                                        <div class="item-img" style="width: 150px;">
                                            <a href="{{ url('blog/'.$post->slug) }}"><img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="Post"></a>
                                        </div>
                                        <div class="item-content">
                                            <ul class="entry-meta meta-color-dark">
                                                <!-- <li><i class="fas fa-tag"></i>Weeding</li> -->
                                                <li><i class="fas fa-calendar-alt"></i>{{ $post->created_at->format('M j, Y') }}</li>
                                            </ul>
                                            <h4 class="item-title"><a href="{{ url('blog/'.$post->slug) }}">{{$post->title}}</a></h4>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                       
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
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Instagram End Here -->
        <!-- Footer Area Start Here -->
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