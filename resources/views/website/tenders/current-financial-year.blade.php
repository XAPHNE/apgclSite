@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.tenders') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.current_financial_year') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">F.Y.- {{ $financialYear->year }} @lang('navigationMenu.tenders')</h4>
            <div class="table-responsive">
                <table id="tenders-table" class="table-bordered table table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>Tender No.</th>
                            <th>Tender Details</th>
                            <th class="nosort">@lang('table.download')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tenders as $tender)
                            @if (!$tender->is_archived)
                                <tr>
                                    <td class="text-start">{{ $tender->tender_no }}</td>
                                    <td class="text-start">{{ $tender->description }}</td>
                                    <td>
                                        @foreach ($tender->tenderFiles as $tenderFile)
                                            <p><a href="{{ url($tenderFile->downloadLink) }}" target="_blank">
                                                <i class="fas fa-file-download" aria-hidden="true"></i>
                                                {{ $tenderFile->name }}
                                            </a></p>
                                        @endforeach
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
    tbody tr {
        text-align: center;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tenders-table').DataTable({
            "ordering": false,
            columnDefs: [
                { width: 100, targets: 0 },
                { width: 350, targets: 1 },
                { width: 111, targets: 2 },
            ],
        });
    });
</script>
@endpush