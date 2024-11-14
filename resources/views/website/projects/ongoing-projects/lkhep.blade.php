@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.projects') </a>/</li>
                <li class="breadcrumb-item"><a href="{{ url('/' . app()->getLocale() . '/projects/ongoing-projects') }}" class="bread-text">@lang('navigationMenu.ongoing_projects') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">LKHEP </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="faet-tab" data-bs-toggle="tab" data-bs-target="#faet-tab-pane" type="button" role="tab" aria-controls="faet-tab-pane" aria-selected="true">Features</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="achiv-tab" data-bs-toggle="tab" data-bs-target="#achiv-tab-pane" type="button" role="tab" aria-controls="achiv-tab-pane" aria-selected="false">Policies</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="faet-tab-pane" role="tabpanel" aria-labelledby="faet-tab" tabindex="0">
                        <div class="mt-3 mb-3">
                            <h5 class="line-vertical ">Features</h5>

                            <p>The 120 MW Lower Kopili H.E. Project is one of the stage developments of Kopili River valley development which will augment the power generating capacity of the state. Located in the Dima Hasao and Karbi Anglong Districts of Assam, the project is funded by Asian Development Bank under its Assam Power Sector Investment Program. The Project will be completed as 4 major project packages and is expected to be completed by June 2024.</p>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="achiv-tab-pane" role="tabpanel" aria-labelledby="achiv-tab" tabindex="0">
                        <div class="mt-3 mb-3">
                            <h4 class="line-vertical">Policies</h4>
                            <div class="table-responsive">
                                <table class="table-bordered table table-striped" style="width:100%">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-center" style="width: 10.66%">@lang('table.serial_num')</th>
                                            <th colspan="2" class="text-center">@lang('table.name')</th>
                                            <th class="text-center nosort" style="width: 20%">@lang('table.download_view')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach ($lkhepPolicies as $name => $policies)
                                            @foreach ($policies as $index => $lkhepPolicy)
                                                <tr>
                                                    {{-- Serial number with rowspan --}}
                                                    @if ($index === 0)
                                                        <td class="text-center align-middle" rowspan="{{ $policies->count() }}">{{ $serial++ }}</td>
                                                    @endif

                                                    @if (is_null($lkhepPolicy->description))
                                                        {{-- Name with rowspan --}}
                                                        @if ($index === 0)
                                                            <td class="text-start align-middle" colspan="2" rowspan="{{ $policies->count() }}">{{ $name }}</td>
                                                        @endif
                                                    @else
                                                        {{-- Name with rowspan --}}
                                                        @if ($index === 0)
                                                            <td class="text-start align-middle" rowspan="{{ $policies->count() }}">{{ $name }}</td>
                                                        @endif
                                    
                                                        {{-- Description without rowspan --}}
                                                        <td class="text-start align-middle">{{ $lkhepPolicy->description }}</td>
                                                    @endif
                                
                                                    {{-- Download link without rowspan --}}
                                                    <td class="text-center align-middle">
                                                        <a href="{{ url($lkhepPolicy->downloadLink) }}" target="_blank">
                                                            <i class="fas fa-file-download" aria-hidden="true"></i>
                                                            @lang('table.download_view')
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                            
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
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
@endpush

@push('scripts')
    
@endpush