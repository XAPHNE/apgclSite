@extends('layouts.guest')

@section('content')

    <section class="pt-3 pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bread-text">
                    <li class="breadcrumb-item"><a href="#" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                    <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.about_us') </a>/</li>
                    <li class="breadcrumb-item active bread-text" aria-current="page">@lang('navigationMenu.gallery') {{ $gallery->event_name }}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <h4 class="line-vertical">{{ $gallery->event_name }} @lang('navigationMenu.gallery')</h4>
                @foreach ($galleryFiles as $galleryFile)
                    @if ($galleryFile->is_visible)
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a href="{{ asset($galleryFile->downloadLink) }}" class="fancybox" rel="ligthbox">
                            <img src="{{ asset($galleryFile->downloadLink) }}" class="zoom img-fluid " alt="">
                        </a>
                    </div>
                    @endif
                @endforeach
        </div>
    </section>

@endsection

@push('styles')
<style type="">
    .green {
        background - color: #6fb936;
    }
    .thumb{
        margin-bottom: 30px;
    }
            
    img.zoom {
        width: 100%;
        height: 200px;
        border-radius:5px;
        object-fit:cover;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        -o-transition: all .3s ease-in-out;
        -ms-transition: all .3s ease-in-out;
    }
            
    
    .transition {
        -webkit-transform: scale(1.2); 
        -moz-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }
        .modal-header {
    
        border-bottom: none;
    }
        .modal-title {
            color:# 000;
    }
    .modal - footer {
        display: none;
    }
    </style>
@endpush