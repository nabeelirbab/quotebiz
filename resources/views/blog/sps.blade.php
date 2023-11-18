@include('blog.header')

        <!-- Header Area End Here -->
        <!-- Blog Area Start Here -->
        <section class="blog-wrap-layout9">
            <div class="container">
                <div class="section-heading-3">
                    <h2>Service Providers</h2>
                    <p>Browse our service providers.</p>
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
                          <h5 class="card-title text-center">{{$user->first_name}} {{$user->last_name}}</h5>
                          <p> @if(Acelle\Jobs\HelperJob::cityname($user->city)) <span >{{Acelle\Jobs\HelperJob::cityname($user->city)->name}}</span> 
                           @else
                           {{$user->city}}
                           @endif</p>
                          <p class="card-text text-center">
                            @foreach(json_decode($user->category_id) as $key => $cat)
                              <span class="data-value text-soft">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                              @if ($key < count(json_decode($user->category_id)) - 1)
                                  , 
                              @endif
                          @endforeach
                          </p>
                           @if($user->biography)
                          <div class="post_excerpt">
                            <p>
                               {!! clean(Str::limit($user->biography, 150)) !!}
                               <span class="post_read-more">Read More >></span>
                            </p>
                          </div>
                          
                          @endif
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
    