@extends('layouts.guest')

@section('content')
    <!-- banner section start  -->
    <div class="home-banner">
        <div class="banner-slider-area owl-carousel">
            @forelse ($sliderFiles as $gallery)
                @foreach ($gallery->galleryFiles as $file)
                    <div class="single-banner-slide owl-theme" data-dot="{{ $loop->parent->iteration }}-{{ $loop->iteration }}">
                        <img src="{{ asset($file->downloadLink) }}" alt="Gallery File">
                    </div>
                @endforeach
                <div class="single-banner-slide owl-theme" data-dot="06">
                    <video width="720" controls>
                        <source src="admin-assets/Gallery/Home Page Slider/Carousel/2024/1738218440_APGCL _720P_VIDEO_FINAL.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @empty
                <div class="single-banner-slide">
                    <p>No slider files available.</p>
                </div>
            @endforelse
        </div>
    </div>
    <!-- banner section close  -->

    <div class="acme-news-ticker" style="height: 60px;">
        <!-- <div class="acme-news-ticker-label">Marquee</div> -->
    
        <div class="acme-news-ticker-box">
            <ul class="my-news-ticker">
                <li><a href="ticker/PFC_A++.pdf" target="_blank"><b style="font-size: x-large;">Assam Power Generation Corporation Limited has been categorised as A++ w.e.f. 15th December 2022</b></a></li>
            </ul>
    
        </div>
        <!-- <div class="acme-news-ticker-controls acme-news-ticker-horizontal-controls">
            <button class="acme-news-ticker-pause"></button>
        </div> -->
    </div> 
    <!-- two Grid Section start -->
    <div id="stmc" class="two-grid-home pt-70">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="grid-home-1 rounded">
                        <div class="shadow  border rounded">
                            <div class="grid-head p-3">
                                <h4 class="text-white mb-0">
                                    <span class="me-2 "><i class="fas fa-address-card border-end pe-3" aria-hidden="true"></i></span>@lang('companyProfile.about_us_title')
                                </h4>
                            </div>
                            <div class="grid-text p-4">
                                <p>
                                    @lang('companyProfile.about_us_description') <span><a href="{{ route('company-profile.websiteIndex', ['lang' => app()->getLocale()]) }}">[ + @lang('homePage.view_more') ]</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="grid-home-1 rounded">
                        <div class=" shadow  border rounded">
                            <div class="grid-head p-3">
                                <h4 class="text-white mb-0">
                                    <span class="me-2 "><i class="fas fa-address-card border-end pe-3" aria-hidden="true"></i></span>@lang('homePage.news_and_events')
                                </h4>
                            </div>
                            <div class="grid-text p-4">
                                <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" height="230" scrollamount="3">
                                    @foreach ($latestEntries as $latestEntry)
                                        @if ($latestEntry->news_n_events)
                                            <div class="news">
                                                <div class="news-content">
                                                    <a target="_blank" href="{{ url($latestEntry->downloadLink) }}">
                                                        <h6>
                                                            @if ($latestEntry->new_badge)
                                                                <img src="{{ asset('website-assets/images/home/new-1.gif') }}">
                                                            @endif
                                                            {{ $latestEntry->description }}
                                                        </h6>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- two Grid Section close -->


    <!-- section counter start -->
    <div class="fun-facts pt-70 pb-100">
        <div class="container">
            <div class="counter">
                <div class="row justify-content-center">
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="fas fa-chart-line counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="50">00</span>+</h2>
                            <p class="text-center">Years Of Experience</p>
                        </div>
                    </div>
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="fas fa-industry counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="6">00</span>+</h2>
                            <p class="text-center">Power Projects</p>
                        </div>
                    </div>
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="far fa-smile counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="670">00</span>+</h2>
                            <p class="text-center">Qualified Professionals</p>
                        </div>
                    </div>
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="fas fa-bolt counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="60000">00</span>+ MU</h2>
                            <p class="text-center">Electricity Generated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- section counter close -->


    <!-- section partner start -->

    <section>
        <div class="container">
            <div class="text-center">
                <h2>@lang('homePage.partners_who_support_us')</h2>
                <div class="divider mx-auto my-4"></div>
            </div>
        </div>
    </section>
    <section class="pb-20">
        <div class="brand">
            <div class="container-fluid">
                <div class="brands-slider owl-carousel">
                    <div class="brand-single-img text-center">
                        <img  src="{{ asset('website-assets/images/home/APDCL_Support_Partner.png') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/APDCL_Support_Partner.png') }}" alt="image" width="100%" onclick="window.open('https://www.apdcl.org/website/', '_blank')">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/aegcl-logo.jpg') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/aegcl-logo.jpg') }}" alt="image" width="100%" onclick="window.open('https://www.aegcl.co.in/', '_blank')">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/aerc.jpg') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/aerc.jpg') }}" alt="image" width="100%" onclick="window.open('https://aerc.gov.in/', '_blank')">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/assam_gov.png') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/assam_gov.png') }}" alt="image" width="100%" onclick="window.open('https://assam.gov.in/web/', '_blank')">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/dap.png') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/dap.png') }}" alt="image" width="100%" onclick="window.open('https://darpg.gov.in/', '_blank')">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/digital-india.jpg') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/digital-india.jpg') }}" alt="image" width="100%" onclick="window.open('https://www.digitalindia.gov.in/', '_blank')">
                    </div>
                    {{-- <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/logo_amrit.png') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/logo_amrit.png') }}" alt="image" width="100%">
                    </div> --}}
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/mop.png') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/mop.png') }}" alt="image" width="100%" onclick="window.open('https://powermin.gov.in/', '_blank')">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/nic.jpg') }}" alt="image" width="100%">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/nic.jpg') }}" alt="image" width="100%" onclick="window.open('https://www.nic.in/', '_blank')">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .brand-single-img img {
        width: 100% !important;
        height: 100%;
        padding: 4px;
    }
    .brands-slider .brand-single-img{
        padding: 0px !important;
    }
    .banner-slider-area {
        position: relative;
    }
    .single-banner-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 400px; /* Example height, adjust as needed */
        background: #f4f4f4; /* Optional background */
    }
    .video-container {
        width: 100%;
        max-width: 80%; /* Limits the video width */
        height: 100%; /* Matches the height of the slider */
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fb-video {
        max-height: 100%; /* Ensures it fits the container */
        max-width: 100%;
        margin: auto;
    }
    video {
        max-width: 100%; /* Ensures video fits within the container */
        max-height: 100%; /* Ensures video respects the slider's height */
        border: 1px solid #ccc; /* Optional: Adds a border for better appearance */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Optional: Adds a subtle shadow */
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // ticker

        $('.my-news-ticker').AcmeTicker({
            type:'marquee',/*horizontal/horizontal/Marquee/type*/
            direction: 'left',/*up/down/left/right*/
            speed: 0.05,/*true/false/number*/ /*For vertical/horizontal 600*//*For marquee 0.05*//*For typewriter 50*/
            // controls: {
            //     toggle: $('.acme-news-ticker-pause'),/*Can be used for horizontal/horizontal/typewriter*//*not work for marquee*/
            // }
        });

    });
</script>
@endpush