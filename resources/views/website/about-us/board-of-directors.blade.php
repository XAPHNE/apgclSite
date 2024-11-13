@extends('layouts.guest')

@section('content')

    <section class="about-profile" style="background-image:url('{{ asset('website-assets/images/common/board-bg.jpg') }}');">
        <div class="container">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-white">
                <li class="breadcrumb-item"><a href="#" class="text-white"><i class="fas fa-home" style="color:#fff;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">@lang('navigationMenu.about_us') /</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">@lang('navigationMenu.board_of_directors')</li>
            </ol>
            </nav>
            <div class="col-m-12">
                <div class="text-start">
                    <h3 class="text-white fw-bold">@lang('navigationMenu.board_of_directors')</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-50">
        <div class="container">
            <div class="row">
                @foreach ($boardOfDirectors as $boardOfDirector)
                    @if ($boardOfDirector->is_chairman || $boardOfDirector->is_md)
                        <div class="col-md-4">
                            <div class="mt-4 mb-3">
                                <h4 class="line-vertical">{{ $boardOfDirector->designation }}</h4>
                                <div class="box-board text-center" style="height: 315.38px">
                                    <img src="{{ asset($boardOfDirector->downloadLink) }}" alt="board" style="height: 120px; width: 120px">
                                    <h4 class="fs-5">{{ $boardOfDirector->name }}</h4>
                                    <p class="mb-0 text-center fs-5"><b>{{ $boardOfDirector->designation }}</b></p>
                                    <p class="mb-0 text-center"><b>{!! $boardOfDirector->organisation !!}</b></p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            <div class="row pt-50">
                <h4 class="line-vertical">Government Representatives</h4>
                @foreach ($boardOfDirectors as $boardOfDirector)
                    @if ($boardOfDirector->is_gov_rep)
                        <div class="col-md-4">
                            <div class="mt-1 mb-3">
                                <div class="box-board text-center" style="height: 315.38px">
                                    <img src="{{ asset($boardOfDirector->downloadLink) }}" alt="board" style="height: 120px; width: 120px">
                                    <h4 class="fs-5">{{ $boardOfDirector->name }}</h4>
                                    <p class="mb-0 text-center fs-5"><b>{{ $boardOfDirector->designation }}</b></p>
                                    <p class="mb-0 text-center"><b>{{ $boardOfDirector->organisation }}</b></p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>


            <div class="row pt-50">
                <h4 class="line-vertical">Independent Directors</h4>
                @foreach ($boardOfDirectors as $boardOfDirector)
                    @if ($boardOfDirector->is_indi_ditr)
                        <div class="col-md-4">
                            <div class="mt-1 mb-3">
                                <div class="box-board text-center" style="height: 291px">
                                    <img src="{{ asset($boardOfDirector->downloadLink) }}" alt="board" style="height: 120px; width: 120px">
                                    <h4 class="fs-5">{{ $boardOfDirector->name }}</h4>
                                    <p class="mb-0 text-center fs-5"><b>{{ $boardOfDirector->designation }}</b></p>
                                    <p class="mb-0 text-center"><b>{{ $boardOfDirector->organisation }}</b></p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection