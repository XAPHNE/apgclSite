@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.projects') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.thermal_plants') </a></li>
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
                            <img src="{{ asset('website-assets/images/common/thermail-1.jpg') }}" class="card-img" alt="Card Image">
                        </div>
                        <div class="col-md-8 card-bgg" style="background-color:#d9e5d9;">
                            <div class="card-body">
                                <h5 class="card-title pb-2"> 
                                   <a href="{{ url('/' . app()->getLocale() . '/projects/thermal-plants/ntps') }}">
                                   Namrup Thermal Power Station
                                    </a>
                                </h5>
                                <p class="card-text">
                                   Namrup Thermal Power Station (NTPS) is a gas-based Power Station with a total installed capacity of 41 MW situated in the district of Dibrugarh, Assam. NTPS is the first gas-based Power Station in South-East Asia. NTPS has also won the Gas Heritage award at the Fifth India Power awards held at New Delhi in 2012 in recognition for being the first Gas Turbine Unit in India by Council of Power Utilities.
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
                                    <a href="{{ url('/' . app()->getLocale() . '/projects/thermal-plants/nrpp') }}">
                                    Namrup Replacement Power Project

                                    </a>
                                </h5>
                                <p class="card-text">
                                The Namrup Replacement power project (NRPP-phase-1) was conceived to replace the old power plant of NTPS. The commercial operation of NRPP was declared on 16-07-2021. The capacity of NRPP is (GTG-62.25 MW + STG-36.15 MW) and the total installed capacity is 98.4 MW in combined cycle. Natural gas is used as the fuel for its operation.

                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 p-0" style="overflow: hidden;">
                            <img src="{{ asset('website-assets/images/common/thermal-2.jpg') }}" class="card-img" alt="Card Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card horizontal-card">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-0" style="overflow: hidden;">
                            <img src="{{ asset('website-assets/images/common/thermal-3.jpg') }}" class="card-img" alt="Card Image">
                        </div>
                        <div class="col-md-8 card-bgg" style="background-color:#d9e5d9;">
                            <div class="card-body">
                                <h5 class="card-title pb-2"> 
                                    <a href="{{ url('/' . app()->getLocale() . '/projects/thermal-plants/ltps') }}">
                                      Lakwa Thermal Power Station
                                    </a>
                                </h5>
                                <p class="card-text">
                                Lakwa Thermal Power Station (LTPS) is a gas-based power plant situated in the district of Charaideo in the State of Assam with a total installed capacity of 97.2 MW. The first phase of LTPS was started with three numbers of Westinghouse Make open cycle Gas Turbine Units. Thereafter, in 1986, one number of 15 MW Mitsubishi, Japan Make open cycle Gas Turbine Unit was installed to further augment the generation capacity of Assam. These units were later decommissioned in the year 2017-2018. In 1993, the Phase-II power house of LTPS was commissioned with three numbers of 20 MW each BHEL/GE Make Gas Turbine Units. And, in 2012 the Phase-III power house was commissioned with one number of 37.2 MW BHEL/GE Make STG as Waste Heat Recovery Plant of Phase-II power house.
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
                                    <a href="{{ url('/' . app()->getLocale() . '/projects/thermal-plants/lrpp') }}">
                                        Lakwa Replacement Power Project
                                    </a>
                                </h5>
                                <p class="card-text">
                                       Lakwa Replacement Power Project (LRPP) was commissioned in the year 2018. Total installed capacity is 69.76 MW. Natural gas is used as fuel. In 2018, LRPP was commissioned with 7×10 MW nos. of Wartsila India Pvt. Ltd. Make Gas Engines as replacement of the then decommissioned old Westinghouse/Mitsubishi Gas Turbine Units of Phase-I power house of LTPS.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 p-0" style="overflow: hidden;">
                            <img src="{{ asset('website-assets/images/common/thermal-4.jpg') }}" class="card-img" alt="Card Image">
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