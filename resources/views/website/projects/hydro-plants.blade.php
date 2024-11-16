@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.projects') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.hydro_plants') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card horizontal-card">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-0" style="overflow: hidden;">
                            <img src="{{ asset('website-assets/images/project/klhep_hydro.jpg') }}" class="card-img" alt="Card Image">
                        </div>
                        <div class="col-md-8 card-bgg" style="background-color:#d9e5d9;">
                            <div class="card-body">
                                <h5 class="card-title pb-2"> 
                                   <a href="{{ url('/' . app()->getLocale() . '/projects/hydro-plants/klhep') }}">
                                      Karbi Langpi Hydro Electric Project
                                    </a>
                                </h5>
                                <p class="card-text">The Karbi Langpi Hydro Electric Project is located in the West Karbi Anglong District of Assam, about 125Km from the State capital Guwahati. The Project envisages generation of 2X50 MW of electricity by constructing a concrete gravity dam with gated spillways on the river Karbi Langpi near Hatidubi and diverting the river flow through an intake structure and low pressure 4430 m long, 4.20 diameter horse-shoe shaped tunnel to the Power House.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card horizontal-card">
                    <div class="row no-gutters">
                        <div class="col-md-8 card-bgg" style="background-color:#d9e5d9;">
                            <div class="card-body">
                                <h5 class="card-title pb-2">  
                                    <a href="{{ url('/' . app()->getLocale() . '/projects/hydro-plants/mshep') }}">
                                      Myntriang Small Hydro Electric Project
                                    </a>
                                </h5>
                                <p class="card-text">Myntriang Small Hydro Electric Project is situated in the state of Assam, dist. West Karbi Anglong near Amtereng. The project comprises of two stages, i.e. stage-I and stage-II and both the stages of MSHEP are fed by Myntriang (Terenglangso) river which is a tributuary of Borpani river.

                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 p-0" style="overflow: hidden;">
                            <img src="{{ asset('website-assets/images/project/3.jpg') }}" class="card-img" alt="Card Image">
                        </div>
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
<style>
    .horizontal-card .card-img {
        transition: transform 0.3s ease-in-out;
    }

    .horizontal-card:hover .card-img {
        transform: scale(1.1);
    }

    .horizontal-card .card-title {
        position: relative;
        display: inline-block;
        
    }
    .theme-dark .card-bgg {
        background-color: #242424 !important;
    }
    .horizontal-card .card-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 60px;
        height: 4px;
        background-color: #79dd09;
        transition: width 0.3s ease-in-out;
    }

    .horizontal-card:hover .card-title::after {
        width: 120px;
    }

    @media (max-width: 767px) {
        .horizontal-card .row {
            flex-direction: column;
        }
    }
</style>
@endpush

@push('scripts')
    
@endpush