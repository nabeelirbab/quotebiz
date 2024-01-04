@include('blog.header')
<?php $job_design = Acelle\Jobs\HelperJob::form_design();  ?>
        <!-- Header Area End Here -->
        <!-- Blog Area Start Here -->
        <section class="blog-wrap-layout9">
            <div class="container">
                <div class="section-heading-3">
                    <h2>{{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }}</h2>
                    <p>Browse our {{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'service providers' }}.</p>
                </div>
                <div class="row gutters-40 menu-list" id="no-equal-gallery">
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
                      <div class="card-body">
                          <h4 class="card-title text-center mb-0 mt-0">{{$user->first_name}} {{$user->last_name}}</h4>
                          <p class="mb-1"> @if(Acelle\Jobs\HelperJob::cityname($user->city)) <span >{{Acelle\Jobs\HelperJob::cityname($user->city)->name}}</span> 
                           @else
                           {{$user->city}}
                           @endif</p>
                          <p class="card-text text-center mb-0">
                            @foreach(json_decode($user->category_id) as $key => $cat)
                              <span class="data-value badge badge-pill badge-info">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                              @if ($key < count(json_decode($user->category_id)) - 1)
                                  
                              @endif
                          @endforeach
                          </p>
                           <span class="profile_read-more">SEE PROFILE >></span>
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
    