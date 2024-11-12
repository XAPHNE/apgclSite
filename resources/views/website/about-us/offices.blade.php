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
            @foreach($contacts->filter(fn($contact) => $contact->is_office_bearer && $contact->office_category === 'chairman_and_md') as $contact)
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center shadow p-2 sd-height">
                            <h4 class="fs-5">{{ $contact->office_name }}</h4>
                            <p class="mb-0">
                                {{ $contact->office_address }}
                                <br>
                                <!-- Ph: 0361 2739503 -->
                                <!-- <br> -->
                                E-mail: {{ $contact->email }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-3">
            <h4 class="line-vertical">OTHER OFFICES (HEAD QUARTER)</h4>
            @foreach($contacts->filter(fn($contact) => $contact->is_office_bearer && $contact->office_category === 'other_offices_in_hq') as $contact)
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center shadow p-2 sd-height">
                            <h4 class="fs-5">{{ $contact->office_name }}</h4>
                            <p class="mb-0">
                                {{ $contact->office_address }}
                                <br>
                                <!-- Ph: 0361 2739503 -->
                                <!-- <br> -->
                                E-mail: {{ $contact->email }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-3">
            <h4 class="line-vertical">OFFICES (PROJECTS)</h4>
            @foreach($contacts->filter(fn($contact) => $contact->is_office_bearer && $contact->office_category === 'project_offices') as $contact)
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center shadow p-2 sd-height">
                            <h4 class="fs-5">{{ $contact->office_name }}</h4>
                            <p class="mb-0">
                                {{ $contact->office_address }}
                                <br>
                                <!-- Ph: 0361 2739503 -->
                                <!-- <br> -->
                                E-mail: {{ $contact->email }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

         <div class="row mt-3">
            <h4 class="line-vertical">OFFICES (OTHERS)</h4>
            @foreach($contacts->filter(fn($contact) => $contact->is_office_bearer && $contact->office_category === 'other_offices') as $contact)
                <div class="col-md-4">
                    <div class="mt-1 mb-3">
                        <div class="box-board text-center shadow p-2 sd-height">
                            <h4 class="fs-5">{{ $contact->office_name }}</h4>
                            <p class="mb-0">
                                {{ $contact->office_address }}
                                <br>
                                <!-- Ph: 0361 2739503 -->
                                <!-- <br> -->
                                E-mail: {{ $contact->email }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
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