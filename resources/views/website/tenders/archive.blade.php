@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.tenders') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.archive') </a></li>
            </ol>
        </nav>
    </div>
</section>
@if(session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
    </div>
@endif

@if($financialYears->isNotEmpty())
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-2">
                        <label for="inputState"><h6>Financial Year:</h6></label>
                    </div>
                    <div class="col-2">
                        <select id="inputFY" class="form-control">
                            @foreach ($financialYears as $financialYear)
                                <option value="{{ $financialYear->id }}" {{ $financialYear->id == $selectedFinancialYearId ? 'selected' : '' }}>
                                    {{ $financialYear->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">
                F.Y. - {{ $financialYears->firstWhere('id', $selectedFinancialYearId)->year ?? '' }} 
                @lang('navigationMenu.tenders')
            </h4>
            <div class="table-responsive">
                <table id="tenders-table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>Tender No.</th>
                            <th>Tender Details</th>
                            <th class="nosort">@lang('table.download')</th>
                        </tr>
                    </thead>
                    <tbody id="tenders-body">
                        @foreach ($tenders as $tender)
                            <tr>
                                <td class="text-start">{{ $tender->tender_no }}</td>
                                <td class="text-start">{{ $tender->description }}</td>
                                <td class="text-start">
                                    @foreach ($tender->tenderFiles as $tenderFile)
                                        <p>
                                            <a href="{{ url($tenderFile->downloadLink) }}" target="_blank">
                                                <i class="fas fa-file-download" aria-hidden="true"></i>
                                                {{ $tenderFile->name }}
                                            </a>
                                        </p>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@else
    <p>No archived tenders found for any financial year.</p>
@endif
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
        let table = $('#tenders-table').DataTable({
            "ordering": false,
            columnDefs: [
                { width: 100, targets: 0 },
                { width: 350, targets: 1 },
                { width: 111, targets: 2 },
            ],
        });

        // Handle Financial Year Dropdown Change
        $('#inputFY').on('change', function () {
            const financialYearId = $(this).val();
            const selectedFinancialYear = $(this).find(':selected').text();
            const lang = '{{ app()->getLocale() }}'; // Current language

            $('.line-vertical').text(`F.Y. - ${selectedFinancialYear} @lang('navigationMenu.tenders')`);

            $.ajax({
                url: `/${lang}/tenders/archive`, // Use the correct archive route
                method: 'GET',
                data: { financial_year_id: financialYearId },
                beforeSend: function () {
                    // Optionally show a loader
                    $('#tenders-body').html('<tr><td colspan="3">Loading...</td></tr>');
                },
                success: function (response) {
                    if (response.html) {
                        // Destroy the existing DataTable
                        table.destroy();

                        // Update the table body with new data
                        $('#tenders-body').html(response.html);

                        // Reinitialize DataTable
                        table = $('#tenders-table').DataTable({
                            "ordering": false,
                            columnDefs: [
                                { width: 100, targets: 0 },
                                { width: 350, targets: 1 },
                                { width: 111, targets: 2 },
                            ],
                        });
                    } else {
                        // If no data is returned, show a placeholder message
                        $('#tenders-body').html('<tr><td colspan="3">No tenders found for the selected financial year.</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Failed to fetch tenders. Please try again.');
                    // Restore the table if an error occurs
                    $('#tenders-body').html('<tr><td colspan="3">Error loading data.</td></tr>');
                },
            });
        });
    });
</script>
@endpush