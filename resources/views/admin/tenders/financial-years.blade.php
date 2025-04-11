@extends('components.layouts.adminLTE')

@section('title')
    Financial Years
@endsection

@section('page_title')
    Financial Years
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('admin/tenders') }}">Tenders</a></li>
    <li class="breadcrumb-item active">Financial Years</li>
@endsection

@section('content')
    <div class="row">
        <div class="col col-sm-12">
            @can('View Financial Year')
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="d-inline">Financial Year List</h3>
                        @can('Add Financial Year')
                            <div class="card-tools">
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                            <thead>
                                <tr class="table-primary">
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Financial Years</th>
                                    @canany(['Update Financial Year', 'Delete Financial Year'])
                                        <th class="text-center align-middle nosort">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($financialYears as $financialYear)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $financialYear->year }}</td>
                                        @canany(['Update Financial Year', 'Delete Financial Year'])
                                            <td class="text-center align-middle" style="white-space: nowrap;">
                                                @can('Archive Financial Year Tenders')
                                                    @php
                                                        $allArchived = $financialYear->tenders->every(fn($t) => $t->is_archived);
                                                    @endphp
                                                    <button class="btn toggle-archive-button {{ $allArchived ? 'btn-secondary' : 'btn-info' }}"
                                                            data-id="{{ $financialYear->id }}"
                                                            data-year="{{ $financialYear->year }}"
                                                            data-status="{{ $allArchived ? 'unarchive' : 'archive' }}">
                                                        <i class="fas {{ $allArchived ? 'fa-undo' : 'fa-archive' }}"
                                                        title="{{ $allArchived ? 'Unarchive Tenders' : 'Archive Tenders' }}"></i>
                                                    </button>
                                                @endcan
                                                @can('Update Financial Year')
                                                    <button class="btn btn-warning update-button"
                                                        data-id="{{ $financialYear->id }}"
                                                        data-year="{{ $financialYear->year }}"><i title="Update" class="fas fa-edit"></i>
                                                    </button>
                                                @endcan
                                                @can('Delete Financial Year')
                                                    <button class="btn btn-danger delete-button"
                                                            data-id="{{ $financialYear->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- Card Footer goes here -->
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-center align-items-center vh-100">
                    <div class="text-center">
                        <h4 class="text-danger">You do not have permission to view this content.</h4>
                    </div>
                </div>
            @endcan
        </div>
    </div>

    @can('View Financial Year')
        @canany(['Add Financial Year', 'Update Financial Year'])
            <!-- Add/Update Modal -->
            <div class="modal fade" id="addUpdateModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="modalTitle">Add New Financial Year</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="year" class="required">Financial Year:</label>
                                            <input type="text" class="form-control" id="year" name="year" placeholder="YYYY-YYYY" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success" id="saveButton">Save</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        @endcanany

        @can('Delete Financial Year')
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteConfirmationModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Financial Year?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endcan
@endsection

@can('View Financial Year')
    @push('styles')
        @canany(['Add Financial Year', 'Update Financial Year'])
            <style>
                .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
                .toggle.ios .toggle-handle { border-radius: 20px; }
            </style>
            <style>
                .required:after {
                    content: " *";
                    color: red;
                }
            </style>
        @endcanany
    @endpush

    @push('scripts')
    <script>
        $(document).ready(function () {
            var table = new DataTable('#table', {
                columnDefs: [
                    {
                        targets: 'nosort',
                        orderable: false,
                        searchable: false,
                    }
                ],
                scrollX: true,
            });
            @can('Add Financial Year')
                // Handle Add Button
                $('#addButton').on('click', function () {
                    $('#modalTitle').text('Add New Financial Year');
                    $('#addUpdateForm').attr('action', '{{ route('financial-years.store') }}');
                    $('#addUpdateForm').attr('method', 'POST');
                    $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
                    $('#saveButton').removeClass('btn-warning').addClass('btn-success');

                    $('#saveButton').text('Save');
                    $('#addUpdateForm input[name="_method"]').remove();
                    $('#year').val('');
                    $('#addUpdateModal').modal('show');
                });
            @endcan
        
            @can('Update Financial Year')
                // Handle Update Button
                $(document).on('click', '.update-button', function () {
                    var id = $(this).data('id');
                    var year = $(this).data('year');

                    $('#modalTitle').text('Update Financial Year');
                    $('#addUpdateForm').attr('action', '/admin/tenders/financial-years/' + id);
                    $('#addUpdateForm').find('input[name="_method"]').remove();
                    $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
                    $('#saveButton').text('Update');
                    $('#year').val(year);
                    $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
                    $('#saveButton').removeClass('btn-success').addClass('btn-warning');

                    $('#addUpdateModal').modal('show');
                });
            @endcan
        
            @can('Delete Financial Year')
                // Handle Delete Button
                $(document).on('click', '.delete-button', function () {
                    var id = $(this).data('id');
                    var deleteUrl = '/admin/tenders/financial-years/' + id;
                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteConfirmationModal').modal('show');
                });
            @endcan

            @can('Archive Financial Year Tenders')
                $(document).on('click', '.toggle-archive-button', function () {
                    var id = $(this).data('id');
                    var year = $(this).data('year');
                    var status = $(this).data('status');

                    var actionText = status === 'archive' ? 'archive' : 'unarchive';
                    var confirmText = status === 'archive' ? 'Yes, Archive' : 'Yes, Unarchive';

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `This will ${actionText} all tenders for the year: ` + year,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: confirmText,
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let toggleForm = $('<form>', {
                                'method': 'POST',
                                'action': '/admin/tenders/financial-years/' + id + '/toggle-archive'
                            });

                            toggleForm.append('@csrf');
                            toggleForm.append('<input type="hidden" name="_method" value="POST">');
                            $('body').append(toggleForm);
                            toggleForm.submit();
                        }
                    });
                });
            @endcan
        });
        </script>
        <script>
            @canany(['Add Financial Year', 'Update Financial Year', 'Delete Financial Year'])
                // Check if there's a success message in the session
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                    });
                @endif
            
                // Check if there's an error message in the session
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ session('error') }}',
                    });
                @endif
            @endcanany

            @canany(['Add Financial Year', 'Update Financial Year'])
                // Check if there are validation errors and display them in SweetAlert
                @if ($errors->any())
                    let errorMessages = `<ul style="text-align: left;">`;
                    @foreach ($errors->all() as $error)
                        errorMessages += `<li>{{ $error }}</li>`;
                    @endforeach
                    errorMessages += `</ul>`;

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages,
                        confirmButtonText: 'OK'
                    });
                @endif
            @endcanany
        </script>
    @endpush
@endcan