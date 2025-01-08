@extends('components.layouts.adminLTE')

@section('title')
    Daily Generation
@endsection

@section('page_title')
    Daily Generation
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Daily Generation</li>
@endsection

@section('content')
    <div class="row">
        <div class="col col-sm-12">
            @can('View Daily Generation')
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="d-inline">Daily Generation List</h3>
                        @can('Add Daily Generation')
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
                                    <th class="text-center align-middle">Description</th>
                                    <th class="text-center align-middle">Updated By</th>
                                    <th class="text-center align-middle">Updated At</th>
                                    <th class="text-center align-middle nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailyGenerations as $dailyGeneration)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $dailyGeneration->description }}</td>
                                        <td class="text-center align-middle">{{ $dailyGeneration->updater->name }}</td>
                                        <td class="text-center align-middle">{{ $dailyGeneration->updated_at->format('M d Y, h:i A') }}</td>
                                            <td class="text-center align-middle" style="white-space: nowrap;">
                                                <a class="btn btn-info" href="{{ url($dailyGeneration->downloadLink) }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a>
                                                @can('Update Daily Generation')
                                                    <button class="btn btn-warning update-button"
                                                        data-id="{{ $dailyGeneration->id }}"
                                                        data-description="{{ $dailyGeneration->description }}"
                                                        data-downloadlink="{{ $dailyGeneration->downloadLink }}"><i title="Update" class="fas fa-edit"></i>
                                                    </button>
                                                @endcan
                                                @can('Delete Daily Generation')
                                                    <button class="btn btn-danger delete-button"
                                                            data-id="{{ $dailyGeneration->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                            </td>
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

    @can('View Daily Generation')
        @canany(['Add Daily Generation', 'Update Daily Generation'])
            <!-- Add/Update Modal -->
            <div class="modal fade" id="addUpdateModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="modalTitle">Add New Daily Generation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="description" class="required">Description:</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="downloadLink">Upload File:</label>
                                    <input type="file" class="form-control" id="downloadLink" name="downloadLink">
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

        @can('Delete Daily Generation')
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteConfirmationModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Daily Generation?</p>
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

@can('View Daily Generation')
    @canany(['Add Daily Generation', 'Update Daily Generation'])
        @push('styles')
        <style>
            .required:after {
                content: " *";
                color: red;
            }
        </style>
        @endpush
    @endcanany

    @push('scripts')
    <script>
        $(document).ready(function () {
            @can('View Daily Generation')
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
            @endcan
            @can('Add Daily Generation')
                // Handle Add Button
                $('#addButton').on('click', function () {
                    $('#modalTitle').text('Add New Daily Generation');
                    $('#addUpdateForm').attr('action', '{{ route('daily-generation.store') }}');
                    $('#addUpdateForm').attr('method', 'POST');
                    $('#downloadLink').attr('required', true);
                    $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
                    $('#saveButton').removeClass('btn-warning').addClass('btn-success');

                    // Add asterisk to indicate required field
                    $('label[for="downloadLink"]').html('Upload File: <span style="color: red;">*</span>');

                    $('#saveButton').text('Save');
                    $('#addUpdateForm input[name="_method"]').remove();
                    $('#description').val('');
                    $('#downloadLink').val('');
                    $('#addUpdateModal').modal('show');
                });
            @endcan
        
            @can('Update Daily Generation')
                // Handle Update Button
                $(document).on('click', '.update-button', function () {
                    var id = $(this).data('id');
                    var description = $(this).data('description');

                    $('#modalTitle').text('Update Daily Generation');
                    $('#addUpdateForm').attr('action', '/admin/daily-generation/' + id);
                    $('#addUpdateForm').find('input[name="_method"]').remove();
                    $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
                    $('#saveButton').text('Update');
                    $('#description').val(description);
                    $('#downloadLink').val('');
                    $('#downloadLink').removeAttr('required');
                    $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
                    $('#saveButton').removeClass('btn-success').addClass('btn-warning');

                    // Remove asterisk as field is not required
                    $('label[for="downloadLink"]').html('Upload File:');

                    $('#addUpdateModal').modal('show');
                });
            @endcan
        
            @can('Delete Daily Generation')
                // Handle Delete Button
                $(document).on('click', '.delete-button', function () {
                    var id = $(this).data('id');
                    var deleteUrl = '/admin/daily-generation/' + id;
                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteConfirmationModal').modal('show');
                });
            @endcan
        });
        </script>
        <script>
            @canany('Add Daily Generation', 'Update Daily Generation', 'Delete Daily Generation')
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
                
            @canany(['Add Daily Generation', 'Update Daily Generation'])
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