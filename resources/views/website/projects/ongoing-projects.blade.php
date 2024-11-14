@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.ongoing_projects') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">@lang('navigationMenu.ongoing_projects')</h4>
            <div class="table-responsive">
                <table class="table-bordered table table-striped dataTable" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>@lang('table.serial_num')</th>
                            <th>@lang('table.projects')</th>
                            <th class="nosort">@lang('table.capacity') (MW)</th>
                            <th class="nosort">@lang('table.location')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach ($ongoingProjects as $ongoingProject)
                            <tr>
                                <td class="text-center">{{ $serial++ }}</td>
                                <td class="text-start">
                                    <a href="{{ is_null($ongoingProject->link) ? '#' : url('/' . app()->getLocale() . '/projects/ongoing-projects/' . $ongoingProject->link ?? '#') }}">
                                        {{ $ongoingProject->name }}
                                    </a>
                                </td>
                                <td class="text-center">{{ $ongoingProject->capacity }}</td>
                                <td class="text-center">{{ $ongoingProject->location }}</td>
                            </tr>
                        @endforeach
                            
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
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