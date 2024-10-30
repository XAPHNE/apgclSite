@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.annual_statement') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">@lang('navigationMenu.annual_statement')</h4>
            <div class="table-responsive">
                <table id="table" class="table-bordered table table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>@lang('table.serial_num')</th>
                            <th width="70%">@lang('table.name')</th>
                            <th class="nosort">@lang('table.download')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach ($annualStatements as $annualStatement)
                            @if ($annualStatement->visibility)
                                <tr>
                                    <td class="text-center">{{ $serial++ }}</td>
                                    <td class="text-start">{{ $annualStatement->name }}</td>
                                    <td>
                                        <a href="{{ url($annualStatement->downloadLink) }}" target="_blank">
                                            <i class="fas fa-file-download" aria-hidden="true"></i>
                                            @lang('table.download_view')
                                    </a>
                                    </td>
                                </tr>
                            @endif
                            
                            
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