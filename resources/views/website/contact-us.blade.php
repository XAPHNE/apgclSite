@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.contact_us') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical">@lang('navigationMenu.contact_us')</h4>
            <div class="table-responsive">
                <table id="contactTable" class="table-bordered table table-striped" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>@lang('table.serial_num')</th>
                            <th>@lang('table.name')</th>
                            <th>@lang('table.designation')</th>
                            <th>@lang('table.email')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach ($contacts as $contact)
                        <tr>
                            <td class="text-center">{{ $serial++ }}</td>
                            <td class="text-start">{{ $contact->name }}</td>
                            <td class="text-start">{{ $contact->designation }}</td>
                            <td class="text-start">{{ $contact->email }}</td>
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
    <script>
        $(document).ready(function() {
            $('#contactTable').DataTable({
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, 'All']
                ],
                columnDefs: [
                    {
                        targets: 'nosort',
                        orderable: false,
                        searchable: false,
                    }
                ],
            });
        });
    </script>
@endpush