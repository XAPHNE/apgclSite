@extends('layouts.guest')

@section('content')

    <section class="pt-3 pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bread-text">
                    <li class="breadcrumb-item"><a href="#" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                    <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.about_us') /</a></li>
                    <li class="breadcrumb-item active bread-text" aria-current="page">@lang('navigationMenu.gallery')</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pt-0">
        <div class="container">
            @foreach ($galleryCategories as $galleryCategory)
                @php
                    $filteredGalleries = $galleries->filter(function ($gallery) use ($galleryCategory) {
                        return $gallery->gallery_category === $galleryCategory;
                    });
                @endphp

                {{-- Render the galleryCategory only if there are visible galleries --}}
                @if ($filteredGalleries->isNotEmpty())
                    <div class="row">
                        <h4 class="line-vertical">{{ $galleryCategory }}</h4>
                        @foreach ($filteredGalleries as $gallery)
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
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </section>

@endsection