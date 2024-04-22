@include('blog.header')
<style type="text/css">
  p.mb-0 {
  font-size: 10px;
  color: #222222;
}
a {
    color: #222222;
    text-decoration: none;
    background-color: transparent;
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid #e5e9f2;
}
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 3rem;
}
</style>
<?php $job_design = Acelle\Jobs\HelperJob::form_design();  ?>
        <!-- Header Area End Here -->
        <!-- Blog Area Start Here -->
        <section class="blog-wrap-layout9">
            <div class="container">
                <div class="section-heading-3">
                    <h2>{{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }}</h2>
                    <p>Browse our {{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'service providers' }}.</p>
                </div>
                <div class="row" id="no-equal-gallery">
                    @foreach($users as $user)
                    <div class="col-lg-3 col-sm-12 mb-4 mt-4">
                      <div class="card text-center" style="min-height: 350px;border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                      <div class="mr-auto ml-auto mt-4">
                        <a href="{{ url('sp-profile/'.$user->id) }}">
                        @if($user->user_img)
                          <img src="{{asset('frontend-assets/images/users/'.$user->user_img)}}" alt="Profile Image" class="rounded-circle mt-4" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                        @else
                          <img src="{{asset('frontend-assets/images/avt.jpeg')}}" alt="Profile Image" class="rounded-circle mt-4" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                          @endif
                          </a>
                      </div>
                      <a href="{{ url('sp-profile/'.$user->id) }}">
                      <div class="card-body pt-0 mt-1">
                        <p class="card-text text-center mb-4">
                          @foreach(json_decode($user->category_id) as $key => $cat)
                           @if(\Acelle\Jobs\HelperJob::categoryDetail($cat)->cat_parent_id == 0)
                            <span class="data-value badge badge-pill badge-info">
                               {{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                            @if ($key < count(json_decode($user->category_id)) - 1)
                                 
                            @endif
                            @endif
                        @endforeach
                        </p>
                        <h5 class="card-title text-center mb-0" style="line-height: 0.4">{{$user->title}} {{$user->first_name}} {{$user->last_name}}</h5>
                     <div class="mb-3">
                        @if($job_design->business_name == 'yes' && $user->business->business_name)
                        <p class="card-text text-center mt-1 mb-4">
                           <span class="data-value badge badge-pill badge-info" style="background-color: #364a63 !important;border-color: #364a63 !important;">
                          {{ $user->business->business_name }}
                           </span>
                        </p>
                    </div>
                        @endif
                        @if( $user->business->business_website ||  $user->business->business_phone || $user->business->business_website )
                        <div class="mb-2">
                      <hr style="border-top: 1px solid #e5e9f2">
                        @if($job_design->business_number == 'yes' && $user->business->business_phone)
                        <p class="card-text text-center mt-3 mb-0" style="font-size: 14px;font-weight: normal;">
                            <em class="icon ni ni-call"></em><span> <a href="tel:{{ $user->business->business_phone }}" class="track-click" data-type="phone" data-user-id="{{ $user->id }}">{{ $user->business->business_phone }}</a></span>
                        </p>
                        @endif

                        @if($job_design->business_email == 'yes' && $user->business->business_email)
                            <p class="card-text text-center mb-0" style="font-size: 14px;font-weight: normal;">
                                <em class="icon ni ni-mail"></em><span> <a href="mailto:{{ $user->business->business_email }}" class="track-click" data-type="email" data-user-id="{{ $user->id }}">Send Email</a></span>
                            </p>
                        @endif

                        @if($job_design->business_website == 'yes' && $user->business->business_website)
                            <p class="card-text text-center mb-0" style="font-size: 14px;font-weight: normal;">
                                <em class="icon ni ni-globe"></em><span> <a href="{{ $user->business->business_website }}" class="track-click" data-type="website" data-user-id="{{ $user->id }}" {!! $job_design->website_link_setting == 'NoFollow' ? 'rel="nofollow" target="_blank"' : 'target="_blank"' !!}>{{ $user->business->business_website }}</a></span>
                            </p>
                        @endif
                      </div>
                      <hr style="border-top: 1px solid #e5e9f2">
                       @endif
                       <span class="profile_read-more ">SEE PROFILE >></span>
                    </div>
                    </a>
                  </div>
                    </div>
                    @endforeach
                </div>
                <div class="loadmore-btn-layout1">
                    {{$users}}
                </div>
            </div>
        </section>
        @include('blog.footer')
    