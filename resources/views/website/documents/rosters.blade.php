@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.roster') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">@lang('navigationMenu.roster')</h4>
            <div class="table-responsive">
                <table class="table-bordered table table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th width="85%">@lang('table.particulars')</th>
                            <th class="nosort">@lang('table.download')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rosters as $roster)
                            @if ($roster->visibility && $roster->is_header)
                                <tr>
                                    <td class="text-start">{{ $roster->description }}
                                    @if ($roster->new_badge)
                                        <img src="{{ asset('website-assets/images/home/new-1.gif') }}">
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{ url($roster->downloadLink) }}" target="_blank">
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
            &nbsp;
            <div class="table-responsive">
                <table class="table-bordered table table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>@lang('table.name_of_wings')</th>
                            <th width="60%">@lang('table.particulars')</th>
                            <th class="nosort">@lang('table.download')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Group rosters by name_of_wings
                            $groupedRosters = $rosters->where('visibility', true)->where('is_header', false)->groupBy('name');
                        @endphp
                
                        @foreach ($groupedRosters as $name => $rosterGroup)
                            @foreach ($rosterGroup as $index => $roster)
                                <tr>
                                    {{-- Name of Wings (Grouped using rowspan) --}}
                                    @if ($index === 0)
                                        <td class="text-center align-middle" rowspan="{{ $rosterGroup->count() }}">{{ $name }}</td>
                                    @endif
                
                                    {{-- Particulars --}}
                                    <td class="text-start align-middle">{{ $roster->description }}
                                    @if ($roster->new_badge)
                                        <img src="{{ asset('website-assets/images/home/new-1.gif') }}">
                                    @endif
                                    </td>
                
                                    {{-- Download Column --}}
                                    <td class="text-center align-middle">
                                        <a href="{{ url($roster->downloadLink) }}" target="_blank">
                                            <i class="fas fa-file-download" aria-hidden="true"></i>
                                            @lang('table.download_view')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
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