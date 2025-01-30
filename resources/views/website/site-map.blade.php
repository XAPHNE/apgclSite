@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text text-uppercase">@lang('header.site_map') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical text-uppercase">@lang('header.site_map')</h4>
            <div class="col-md-12">
                <div class="mt-4 stt-3">
                    <div>
                        <ul>
                            <li><a href="{{ url('/' . app()->getLocale()) }}">HOME</a></li>
                            <li>ABOUT US
                                <ul>
                                    <li><a href="{{ route('company-profile.websiteIndex', ['lang' => app()->getLocale()]) }}">COMPANY PROFILE</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/about-us/board-of-directors' }}">BOARD OF DIRECTOR</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/about-us/offices' }}">OFFICES</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/about-us/gallery' }}">GALLERY</a></li>
                                </ul>
                            </li>
                            <li>DOCUMENTS
                                <ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/rosters' }}">ROSTER</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/acts-policies-service-rules' }}">ACTS/POLICIES/GUIDELINES</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/certificates' }}">CERTIFICATES</a></li>
                                    <li>TARRIFS</li>
                                    <ul>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/documents/tariff-order' }}">TARRIF ORDER</a></li>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/documents/tariff-petition' }}">TARRIF PETITION</a></li>
                                    </ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/right-to-information' }}">RIGHT TO INFORMATION</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/annual-statements' }}">ANNUAL STATEMENT</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/annual-returns' }}">ANNUAL RETURN</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/reports' }}">REPORTS</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/publications' }}">PUBLICATIONS</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/documents/standard-forms' }}">STANDARD FORMS</a></li>
                                </ul>
                            </li>
                            <li>PROJECTS
                                <ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/projects/hydro-plants' }}">HYDRO PLANTS</a></li>
                                    <ul>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/hydro-plants/klhep' }}">KARBI LANGPI HYDRO ELECTRIC PROJECT</a></li>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/hydro-plants/mshep' }}">MYNTRIANG SMALL HYDRO ELECTRIC PROJECT</a></li>
                                    </ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/projects/thermal-plants' }}">THERMAL PLANTS</a></li>
                                    <ul>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/thermal-plants/ntps' }}">NAMRUP THERMAL POWER STATION</a></li>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/thermal-plants/nrpp' }}">NAMRUP REPLACEMENT POWER PROJECT</a></li>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/thermal-plants/ltps' }}">LAKWA THERMAL POWER STATION</a></li>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/thermal-plants/lrpp' }}">LAKWA REPLACEMENT POWER PROJECT</a></li>
                                    </ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/projects/ongoing-projects' }}">ONGOING PROJECT</a></li>
                                    <ul>
                                        <li><a href="{{ url('/' . app()->getLocale()) . '/projects/ongoing-projects/lkhep' }}">LOWER KOPILI HYDRO ELECTRIC PROJECT</a></li>
                                    </ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/projects/projects-in-pipeline' }}">PROJECTS IN PIPELINE</a></li>
                                </ul>
                            </li>
                            <li>TENDERS
                                <ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/tenders/current-financial-year' }}">CURRENT FINANCIAL YEAR</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/tenders/archive' }}">ARCHIVE</a></li>
                                </ul>
                            </li>
                            <li>CAREER
                                <ul>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/career/internship' }}">INTERNSHIP</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/career/apprenticeship' }}">APPRENTICESHIP</a></li>
                                    <li><a href="{{ url('/' . app()->getLocale()) . '/career/recruitments' }}">RECRUITMENT</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/' . app()->getLocale()) . '/disaster-management' }}">DISASTER MANAGEMENT</a></li>
                            <li><a href="{{ url('/' . app()->getLocale()) . '/dam-safety' }}">DAM SAFETY</a></li>
                            <li><a href="{{ url('/' . app()->getLocale()) . '/contact-us' }}">CONTACT US</a></li>
                            <li><a href="{{ url('/' . app()->getLocale()) . '/corporate-social-responsibility' }}">CORPORATE SOCIAL RESPONSIBILITY</a></li>
                            <li><a href="{{ url('/' . app()->getLocale()) . '/calendars-and-holidays' }}">CALENDAR & HOLIDAY</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style type="text/css">
    .table  th {
        background-color: #d1e7dd !important; 
        text-align: center !important;
    }
    tbody tr {
        text-align: center;
    }
</style>
@endpush

@push('scripts')
    
@endpush