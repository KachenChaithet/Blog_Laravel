@extends('home.home_master')
@section('blogdetail')
    <div class="breadcrumb-wrapper light-bg">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">{{ $blog->post_title }}</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}" alt="right-arrow">
                                </li>
                                <li aria-current="page">Detail Page</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="lonyo-section-padding7 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="lonyo-blog-d-wrap">
                        <div class="lonyo-blog-d-thumb" data-aos="fade-up" data-aos-duration="700">
                            <img src="{{ asset('uploads/post/' . $blog->image) }}" alt="">
                        </div>
                        <div class="lonyo-blog-meta pb-0">
                            <ul>
                                <li>
                                    <a href="single-blog.html"><img
                                            src="{{ asset('frontend/assets/images/blog/date.svg') }}"
                                            alt="">{{ $blog->created_at->format('M d Y') }}</a>
                                </li>

                            </ul>
                        </div>
                        <div class="lonyo-blog-d-content">
                            <h2><a href="single-blog.html">{{ $blog->post_title }}</a></h2>
                            <p>{!! $blog->long_desrp !!}</p>
                        </div>



                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="lonyo-blog-sidebar" data-aos="fade-left" data-aos-duration="700">
                        <div class="lonyo-blog-widgets">
                            <form action="#">
                                <div class="lonyo-search-box">
                                    <input type="search" placeholder="Type keyword here">
                                    <button id="lonyo-search-btn" type="button"><i class="ri-search-line"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Categories:</h4>
                            <div class="lonyo-blog-categorie">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ url('blog/category', $category->id) }}">{{ $category->category_name }}
                                                <span>({{ $category->count_post_count }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Recent Posts</h4>
                            @foreach ($recentpost as $recent)
                                <a class="lonyo-blog-recent-post-item" href="{{ url('blog/details', $recent->post_slug) }}">
                                    <div class="lonyo-blog-recent-post-thumb">
                                        <img src="{{ asset('uploads/post/' . $recent->image) }}" alt=""
                                            style="width: 150px; height: 120px;">

                                    </div>
                                    <div class="lonyo-blog-recent-post-data">
                                        <ul>
                                            <li><img src="{{ asset('frontend/assets/images/blog/date.svg') }}"
                                                    alt="">{{ $recent->created_at->format('M d Y') }}</li>
                                        </ul>
                                        <div>
                                            <h4>{{ $recent->post_title }}</h4>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Tags</h4>
                            <div class="lonyo-blog-tags">
                                <ul>
                                    <li><a href="single-blog.html">Software</a></li>
                                    <li><a href="single-blog.html">Business</a></li>
                                    <li><a href="single-blog.html">App</a></li>
                                    <li><a href="single-blog.html">Solutions</a></li>
                                    <li><a href="single-blog.html">Finance</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="deivdead-line"></div>


        </div>
    </div>

    @include('home.homelayout.apps')
@endsection
