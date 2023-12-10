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
                    <div class="col-lg-8">
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
            </div>
        </section>
        <!-- Instagram End Here -->
        <!-- Footer Area Start Here -->
     @include('blog.footer')