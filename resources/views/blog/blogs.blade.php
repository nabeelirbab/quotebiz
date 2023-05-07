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
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="blog-box-layout5">
                            <div class="item-img">
                                <a href="{{ url('/blog/'.$post->slug) }}"><img src="{{ asset('frontend-assets/images/posts/' . $post->cover_img) }}" alt="Blog"></a>
                                <a href="{{ url('/blog/'.$post->slug) }}" class="hover-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                            <div class="item-content">
                                <ul class="entry-meta meta-color-dark">
                                    <li><i class="fas fa-calendar-alt"></i>{{ $post->created_at->format('M j, Y') }}</li>
                                </ul>
                                <h3 class="item-title"><a href="{{ url('blog/'.$post->slug) }}">{{$post->title}}</a></h3>
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
    