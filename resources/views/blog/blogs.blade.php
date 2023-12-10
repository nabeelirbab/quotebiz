@include('blog.header')

        <!-- Header Area End Here -->
        <!-- Blog Area Start Here -->
        <section class="blog-wrap-layout9">
            <div class="container">
                <div class="section-heading-3">
                    <h2>The Blog</h2>
                    <p>Browse our blog for engaging articles and tips.</p>
                </div>
                <div class="row gutters-40 menu-list" id="no-equal-gallery">
                    @foreach($posts as $post)
                    <div class="col-lg-4 col-sm-12 mb-4 mt-4">
                        <div class="blog-box-layout5">
                            <div class="item-img">
                                <a href="{{ url('/blog/'.$post->slug) }}"><img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="Blog"></a>
                                <a href="{{ url('/blog/'.$post->slug) }}" class="hover-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                            <div class="post_text">
                              <div class="item-content">
                                  <a href="{{ url('blog/'.$post->slug) }}">
                                    <h1 class="item-title">
                                        {{$post->title}}
                                    </h1>
                                  </a>
                              </div>
                              <div class="post_excerpt">
                                <p>
                                  {!! clean(Str::limit($post->description, 140)) !!}
                                </p>
                              </div>
                              <a href="{{ url('blog/'.$post->slug) }}" class="post_read-more float-right">Read More >></a>
                            </div>
                            <div class="post_meta-data ">
                             <span class="post-date float-right"> {{$post->created_at->format('F d, Y')}} </span>
                           </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="loadmore-btn-layout1">
                    {{$posts}}
                </div>
            </div>
        </section>
        @include('blog.footer')
    