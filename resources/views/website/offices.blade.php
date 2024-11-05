@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.about_us') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.offices') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">OFFICES (HEAD QUARTER)</h4>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Chairman</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            Ph: 0361 2739503
                            E-mail: rakesh.kumar@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Managing Director</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            Ph: 0361 2739546
                            E-mail: bibhu.bhuyan@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <h4 class="line-vertical">OTHER OFFICES (HEAD QUARTER)</h4>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Chief General Manager(Hydro & Civil)</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            E-mail: saurav.saikia@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Chief General Manager(Generation)</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            E-mail: md.zakir@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Chief General Manager(NRE)</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            E-mail: prasanna.gogoi@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Chief General Manager(PP&I)</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            E-mail: akshay.talukdar@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The Chief General Manager(F&A)</h4>
                        <p class="mb-0">Assam Power Generation Corporation Ltd.
                            3rd Floor, Bijulee Bhawan, Guwahati-1
                            E-mail: suresh.kaimal@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <h4 class="line-vertical">OFFICES (PROJECTS)</h4>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The General Manager</h4>
                        <p class="mb-0">ALakwa Thermal Power Station<br>
                            Maibella, Charaideo<br>
                            Ph: 03772 254322<br>
                            E-mail: janardan.das@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The General Manager</h4>
                        <p class="mb-0">Namrup Thermal Power Station<br>
                            Namrup, Dibrugarh<br>
                            Ph: 0374 2503080<br>
                            E-mail: jadupran.borgohain@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The General Manager</h4>
                        <p class="mb-0">Karbi Langpi Hydro Electric Project<br>
                            Lengery, Karbi Anglong<br>
                            E-mail: longsing.bey@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The General Manager</h4>
                        <p class="mb-0">Lower Kopili Hydro Electric Project, APGCL<br>
                            Longku, Dima Hasao<br>
                            Ph: ----<br>
                            E-mail: jonardan.rongpi@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The General Manager</h4>
                        <p class="mb-0">Myntriang Small Hydro Electric Project<br>
                            Lengery, Karbi Anglong<br>
                            Ph: ----<br>
                            E-mail: longsing.bey@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <h4 class="line-vertical">OFFICES (OTHERS)</h4>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of The General Manager<br></h4>
                        <p class="mb-0">Design(Civil), APGCL<br>
                            Narengi, Guwahati-781026<br>
                            Ph: ----<br>
                            E-mail: amarendra.singha@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of Deputy General Manager</h4>
                        <p class="mb-0">Investigation Circle, APGCL<br>
                            Narengi, Guwahati-781026<br>
                            Ph: ----<br>
                            E-mail: jayantakumar.das@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Resident Engineer (Liaison)</h4>
                        <p class="mb-0">ASEB, E-18, Lajpat Nagar-II<br>
                            New Delhi-110 024<br>
                            Ph: 011 29819218<br>
                            E-mail: ashish.choudhury@apgcl.org
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1 mb-3">
                    <div class="box-board text-center shadow p-2">
                        <h4 class="fs-5">Office of Assistant General Manager</h4>
                        <p class="mb-0">Borpani Killing Valley (BKV)<br>
                            Investigation Division, Jagiroad<br>
                            APGCL<br>
                            E-mail: pickloo.deka@apgcl.org
                        </p>
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