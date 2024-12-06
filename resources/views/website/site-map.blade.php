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
                            <li><a href="index.php">HOME</a></li>
                            <li>ABOUT US
                                <ul>
                                    <li><a href="company_profile.php">COMPANY PROFILE</a></li>
                                    <li><a href="board.php">BOARD OF DIRECTOR</a></li>
                                    <li><a href="offices.php">OFFICES</a></li>
                                    <li><a href="gallery.php">GALLERY</a></li>
                                </ul>
                            </li>
                            <li>DOCUMENTS
                                <ul>
                                    <li><a href="acts.php">ACTS/POLICIES/GUIDELINES</a></li>
                                    <li>TARRIFS</li>
                                    <ul>
                                        <li><a href="tarrif_orders.php">TARRIF ORDER</a></li>
                                        <li><a href="tarrif_petition.php">TARRIF PETITION</a></li>
                                    </ul>
                                    <li><a href="rti.php">RIGHT TO INFORMATION</a></li>
                                    <li><a href="finance.php">FINANCE</a></li>
                                    <li><a href="reports.php">REPORTS</a></li>
                                    <li><a href="publication.php">PUBLICATIONS</a></li>
                                    <li><a href="standard-forms.php">STANDARD FORMS</a></li>
                                </ul>
                            </li>
                            <li>PROJECTS
                                <ul>
                                    <li><a href="hydro.php">HYDRO PLANTS</a></li>
                                    <li><a href="thermal.php">THERMAL PLANTS</a></li>
                                    <li><a href="ongoing.php">ONGOING PROJECT</a></li>
                                    <li><a href="pipeline.php">PROJECTS IN PIPELINE</a></li>
                                </ul>
                            </li>
                            <li>TENDERS
                                <ul>
                                    <li><a href="tenders.php">CURRENT F.Y.</a></li>
                                    <li><a href="archive.php">ARCHIVE</a></li>
                                </ul>
                            </li>
                            <li>CAREER
                                <ul>
                                    <li><a href="apprenticeship.php">APPRENTICESHIP</a></li>
                                    <li><a href="recruitment.php">RECRUITMENT</a></li>
                                </ul>
                            </li>
                            <li><a href="disaster_management.php">DISASTER MANAGEMENT</a></li>
                            <li><a href="contact-us.php">CONTACT US</a></li>
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