@extends('home.home_master')
@section('about')
    <div class="breadcrumb-wrapper light-bg">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">About Us</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}" alt="right-arrow">
                                </li>
                                <li aria-current="page">About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End breadcrumb -->


    <!-- end rating -->

    <div class="lonyo-section-padding3">
        <div class="container">
            @php
                $about = App\Models\About::find(1);
            @endphp
            <div class="row">
                <div class="col-lg-5">
                    <div class="lonyo-about-us-thumb2 pr-51" data-aos="fade-up" data-aos-duration="700">
                        <img src="{{ asset('uploads/about/' . $about->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-7 d-flex align-items-center">
                    <div class="lonyo-default-content pl-32" data-aos="fade-up" data-aos-duration="900">
                        <h2>{{ $about->title }}</h2>
                        <p>{!! $about->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <section class="lonyo-section-padding3 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="lonyo-default-content pr-50 feature-wrap">
                        <h2>Our core values ​​serve as our driving force</h2>
                        <p class="max-w616">Our core values ​​are at the core of everything we do. Ensuring the integrity,
                            security and privacy of your data. Innovation, providing cutting-edge tools to simplify
                            financial management. </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="lonyo-about-us-feature-wrap one" data-aos="fade-up" data-aos-duration="500">
                        <div class="lonyo-about-us-feature-icon">
                            <img src="{{ asset('frontend/assets/images/about-us/icon1.svg') }}" alt="">
                        </div>
                        <div class="lonyo-about-us-feature-content">
                            <h4>User-Centric Innovation</h4>
                            <p>We design our apps and software with our users in mind, constantly evolving to meet their
                                financial needs and solutions.</p>
                        </div>
                    </div>
                    <div class="lonyo-about-us-feature-wrap two" data-aos="fade-up" data-aos-duration="700">
                        <div class="lonyo-about-us-feature-icon">
                            <img src="{{ asset('frontend/assets/images/about-us/icon2.svg') }}" alt="">
                        </div>
                        <div class="lonyo-about-us-feature-content">
                            <h4>Transparency</h4>
                            <p>We believe in clear communication and full transparency in all our practices, providing users
                                with accurate financial insights.</p>
                        </div>
                    </div>
                    <div class="lonyo-about-us-feature-wrap three" data-aos="fade-up" data-aos-duration="900">
                        <div class="lonyo-about-us-feature-icon">
                            <img src="{{ asset('frontend/assets/images/about-us/icon3.svg') }}" alt="">
                        </div>
                        <div class="lonyo-about-us-feature-content">
                            <h4>Integrity & Trust</h4>
                            <p>We build lasting relationships with our users by consistently delivering reliable, ethical,
                                and also trustworthy services.</p>
                        </div>
                    </div>
                    <div class="lonyo-about-us-feature-wrap mb-0 four" data-aos="fade-up" data-aos-duration="1100">
                        <div class="lonyo-about-us-feature-icon">
                            <img src="{{ asset('frontend/assets/images/about-us/icon4.svg') }}" alt="">
                        </div>
                        <div class="lonyo-about-us-feature-content">
                            <h4>Security You Can Trust</h4>
                            <p>Your financial data is protected with top-level encryption and security protocols to ensure
                                your information is always secure.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lonyo-feature-shape shape2"></div>
    </section>
    <!-- end feature -->

    <div class="lonyo-section-padding10 team-section">
        <div class="shape">
            <img src="{{ asset('frontend/assets/images/about-us/shape1.svg') }}" alt="">
        </div>
        <div class="container">
            <div class="lonyo-section-title center max-width-750">
                <h2>We always believe in the strength of our team</h2>
            </div>
            <div class="row">
                @php
                    $teams = App\Models\Team::latest()->get();
                @endphp

                @foreach ($teams as $team)
                    <div class="col-lg-3 col-md-6">
                        <div class="lonyo-team-wrap" data-aos="fade-up" data-aos-duration="500">
                            <div class="lonyo-team-thumb">
                                <a href="single-team.html"><img src="{{ asset('uploads/teams/' . $team->image) }}"
                                        alt=""></a>
                            </div>
                            <div class="lonyo-team-content">
                                <a href="single-team.html">
                                    <h6>{{ $team->name }}</h6>
                                </a>
                                <p>{{ $team->position }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- end team -->

    <div class="lonyo-section-padding4 section">
        <div class="container">
            <div class="lonyo-section-title center">
                <h2>Find answers to all questions below</h2>
            </div>
            @php
                $faqs = App\Models\Faq::limit(5)->get();
            @endphp
            @foreach ($faqs as $faq)
                <div class="lonyo-faq-wrap1">
                    <div class="lonyo-faq-item item2 open" data-aos="fade-up" data-aos-duration="500">
                        <div class="lonyo-faq-header">
                            <h4>{{ $faq->title }}?</h4>
                            <div class="lonyo-active-icon">
                                <img class="plasicon" src="{{ asset('frontend/assets/images/v1/mynus.svg') }} alt="">
                                <img class="mynusicon" src="{{ asset('frontend/assets/images/v1/plas.svg') }} alt="">
                            </div>
                        </div>
                        <div class="lonyo-faq-body body2">
                            <p>{{ $faq->description }}.</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
                <a class="lonyo-default-btn faq-btn2" href="contact-us.html">Can't find your answer,</a>
            </div>
        </div>
    </div>
    <!-- end faq -->

    <div class="lonyo-content-shape">
        <img src="{{ asset('frontend/assets/images/shape/shape2.svg"') }} alt="">
    </div>

    @include('home.homelayout.apps')
    <!-- end cta -->
@endsection
