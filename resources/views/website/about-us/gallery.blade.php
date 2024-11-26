@extends('layouts.guest')

@section('content')

    <section class="pt-3 pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bread-text">
                    <li class="breadcrumb-item"><a href="#" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> Home /</a></li>
                    <li class="breadcrumb-item"><a href="#" class="bread-text">About Us /</a></li>
                    <li class="breadcrumb-item active bread-text" aria-current="page">GALLERY</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <h4 class="line-vertical">Power Stations</h4>
                @foreach ($galleries as $gallery)
                    @if ($gallery->gallery_category === 'Power Stations')
                        @if ($gallery->is_visible)
                            <div class="col-md-3">
                                <div class="mt-1 mb-3">
                                    <a href="{{ url('/' . app()->getLocale() . '/about-us/gallery/' . $gallery->id) }}">
                                        <div class="text-center border">
                                            <img src="{{ asset($gallery->thumbnail) }}" alt="gallery" width="100%">
                                            <div class="p-2">
                                                <p class="mb-0 fw-bold" style="font-size: 14px;">
                                                {{ $gallery->event_description }}
                                                </p>
                                        </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            
            <div class="row">
                <h4 class="line-vertical">Ministers Visit</h4>
                @foreach ($galleries as $gallery)
                    @if ($gallery->gallery_category === "Minister's Visit")
                        @if ($gallery->is_visible)
                            <div class="col-md-3">
                                <div class="mt-1 mb-3">
                                    <a href="{{ url('/' . app()->getLocale() . '/about-us/gallery/' . $gallery->id) }}">
                                        <div class="text-center border">
                                            <img src="{{ asset($gallery->thumbnail) }}" alt="gallery" width="100%">
                                            <div class="p-2">
                                                <p class="mb-0 fw-bold" style="font-size: 14px;">
                                                {{ $gallery->event_description }}
                                                </p>
                                        </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>


            <div class="row">
                <h4 class="line-vertical">Social Responsibility & Allied Activities</h4>
                @foreach ($galleries as $gallery)
                    @if ($gallery->gallery_category === "Social Responsibility & Allied Activities")
                        @if ($gallery->is_visible)
                            <div class="col-md-3">
                                <div class="mt-1 mb-3">
                                    <a href="{{ url('/' . app()->getLocale() . '/about-us/gallery/' . $gallery->id) }}">
                                        <div class="text-center border">
                                            <img src="{{ asset($gallery->thumbnail) }}" alt="gallery" width="100%">
                                            <div class="p-2">
                                                <p class="mb-0 fw-bold" style="font-size: 14px;">
                                                {{ $gallery->event_description }}
                                                </p>
                                        </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>


            <div class="row">
                <h4 class="line-vertical">Industrial Meets, Seminars & Workshops</h4>
                @foreach ($galleries as $gallery)
                    @if ($gallery->gallery_category === "Industrial Meets, Seminars & Workshops")
                        @if ($gallery->is_visible)
                            <div class="col-md-3">
                                <div class="mt-1 mb-3">
                                    <a href="{{ url('/' . app()->getLocale() . '/about-us/gallery/' . $gallery->id) }}">
                                        <div class="text-center border">
                                            <img src="{{ asset($gallery->thumbnail) }}" alt="gallery" width="100%">
                                            <div class="p-2">
                                                <p class="mb-0 fw-bold" style="font-size: 14px;">
                                                {{ $gallery->event_description }}
                                                </p>
                                        </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="row">
                <h4 class="line-vertical">Other Events</h4>
                @foreach ($galleries as $gallery)
                    @if ($gallery->gallery_category === "Other Events")
                        @if ($gallery->is_visible)
                            <div class="col-md-3">
                                <div class="mt-1 mb-3">
                                    <a href="{{ url('/' . app()->getLocale() . '/about-us/gallery/' . $gallery->id) }}">
                                        <div class="text-center border">
                                            <img src="{{ asset($gallery->thumbnail) }}" alt="gallery" width="100%">
                                            <div class="p-2">
                                                <p class="mb-0 fw-bold" style="font-size: 14px;">
                                                {{ $gallery->event_description }}
                                                </p>
                                        </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection