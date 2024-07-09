@extends('layouts.guest')

@section('content')

    <section class="about-profile">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-white">
                    <li class="breadcrumb-item"><a href="{{ url('/' . app()->getLocale()) }}" class="text-white"><i class="fas fa-home" style="color:#fff;" aria-hidden="true"></i> @lang('footer.home') /</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-white">@lang('companyProfile.about_us_title') /</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">@lang('footer.company_profile')</li>
                </ol>
            </nav>
            <div class="col-m-12">
                <div class="text-start">
                    <h3 class="text-white fw-bold">@lang('navigationMenu.company_profile')</h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <p id="content">
                            @lang('companyProfile.about_us_description')
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 class="line-vertical">@lang('companyProfile.vision_title')</h4>
                        <p>
                            @lang('companyProfile.vision_description')
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 class="line-vertical">@lang('companyProfile.mission_title')</h4>
                        <p>
                            @lang('companyProfile.mission_description')
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 class="line-vertical">@lang('companyProfile.functions_title')</h4>
                        <ol type="number" class="line-vertical-ol">
                            @lang('companyProfile.functions_description')
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <div class="mt-4">
                            <h4 class="line-vertical">@lang('companyProfile.objectives_title')</h4>
                            <ol type="number" class="line-vertical-ol">
                                @lang('companyProfile.objectives_description')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection