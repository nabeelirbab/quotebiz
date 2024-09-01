<?php
  $data = new stdClass();
  $data->title = $post->title;
  $data->subject = 'Blog';
  $data->type = 'single_blog';
  if($post->cover_img){
        $data->image = asset('frontend-assets/images/posts/' . $post->cover_img);
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
        <!-- Header Area End Here -->
        <!-- Single Blog Banner Start Here -->
        <section class="single-blog-wrap-layout1">
            <div class="single-blog-banner-layout1">
                <div class="banner-img mt-md-4">
                    <img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="blog">
                </div>
                <div class="banner-content">
                    <div class="container">
                        
                        <h2 class="item-title mb-1 ml-0">{{$post->title}}</h2>
                        <ul class="entry-meta meta-color-light2">
                            <li><i class="fas fa-calendar-alt "></i>{{ $post->created_at->format('M j, Y') }}</li>
                        </ul>
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