@extends('layouts.guest')

@section('content')

    <section class="about-profile" style="background-image:url('{{ asset('website-assets/images/common/board-bg.jpg') }}');">
        <div class="container">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-white">
                <li class="breadcrumb-item"><a href="#" class="text-white"><i class="fas fa-home" style="color:#fff;" aria-hidden="true"></i> Home /</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">About Us /</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">BOARD OF DIRECTORS</li>
            </ol>
            </nav>
            <div class="col-m-12">
                <div class="text-start">
                    <h3 class="text-white fw-bold">BOARD OF DIRECTORS</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-50">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-4 mb-3">
                        <h4 class="line-vertical">Chairman</h4>
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/profile-1.jpg') }}" alt="board" width="120px" height="120px;">
                            <h4 class="fs-5">Shri Rakesh Kumar, IAS</h4>
                            <p class="mb-0">Commissioner & Secretary</p>
                            <p class="mb-0">Power (E). Department,Govt. of Assam Chairman</p>
                            <p class="mb-0">Assam Power Generation Corporation Limited</p>
                        </div>
                    </div>
                </div>
            <div class="col-md-4">
                    <div class="mt-4 mb-3">
                        <h4 class="line-vertical">Managing Director</h4>
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/Bibhu.jpg') }}" alt="board" width="120px" height="120px;" style="height:120px;">
                            <h4 class="fs-5">Shri. Bibhu Bhuyan</h4>
                            <p class="mb-0">Managing Director</p>
                            <p class="mb-0">Power (E). Department,Govt. of Assam Director</p>
                            <p class="mb-0">Assam Power Generation Corporation Limited</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt-50">
                <h4 class="line-vertical">Government Representatives</h4>
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/profile-1.jpg') }}" alt="board" width="120px" height="120px;">
                            <h4 class="fs-5">Shri. Gautam Talukdar, IAS</h4>
                            <p class="mb-0">Secretary</p>
                            <p class="mb-0">Power (E). Department, Govt. of Assam</p>
                        </div>
                    </div>
                </div>
            <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/profile-1.jpg') }}" alt="board" width="120px" height="120px;">
                            <h4 class="fs-5">Shri. B. J. Manta, ACS</h4>
                            <p class="mb-0">Additional Secretary</p>
                            <p class="mb-0">Industries, Comm. & PE Department, GoA</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row pt-50">
                <h4 class="line-vertical">Independent Directors</h4>
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/Nitya.jpg') }}" alt="board" width="120px" height="120px;">
                            <h4 class="fs-5">Shri. Nitya Bhushan Dey</h4>
                            <p class="mb-0">Independent Director</p>
                            <p class="mb-0">Assam Power Generation Corporation Limited</p>
                        </div>
                    </div>
                </div>
            <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/Anop_Singh_Purohit.jpeg') }}" alt="board" width="120px" height="120px;" style="height:120px;">
                            <h4 class="fs-5">Shri. Anop Singh Purohit</h4>
                            <p class="mb-0">Independent Director</p>
                            <p class="mb-0">Assam Power Generation Corporation Limited</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center">
                            <img src="{{ asset('website-assets/images/board/Debojit Mahanta-min.jpg') }}" alt="board" width="120px" height="120px;">
                            <h4 class="fs-5">Dr. Devajit Mahanta</h4>
                            <p class="mb-0">Independent Director</p>
                            <p class="mb-0">Assam Power Generation Corporation Limited</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection