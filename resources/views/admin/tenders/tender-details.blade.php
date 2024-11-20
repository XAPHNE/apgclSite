@extends('components.layouts.adminLTE')

@section('title')
    Tender Details
@endsection

@section('page_title')
    Tender Details
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('admin/tenders') }}" class="text-decoration-none">Tenders</a></li>
    <li class="breadcrumb-item active">Tender Details</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="p-3 m-1 card">
                            <p>
                                <strong class="d-inline">Tender No:</strong>
                                <span class="ms-2">{{ $tender->tender_no }}</span>
                            </p>
                            <p>
                                <strong class="d-inline">Financial Year:</strong>
                                <span class="ms-2">{{ $tender->financialYear->year }}</span>
                            </p>
                            <p>
                                <strong class="d-inline">Directory Name:</strong>
                                <span class="ms-2">{{ $tender->directory_name }}</span>
                            </p>
                            <p>
                                <strong>Tender Description:</strong><br>
                                <span>{{ $tender->description }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3 m-1 card">
                            <h5>Uploaded Files:</h5>
                            @foreach ($tenderFiles as $tenderFile)
                                <div class="mb-2 row justify-content-between">
                                    <!-- Anchor Tag Column -->
                                    <div class="col">
                                        <a href="{{ url($tenderFile->downloadLink) }}" class="text-decoration-none" target="_blank">
                                            <i class="fas fa-file-download" aria-hidden="true"></i> {{ $tenderFile->name }}
                                        </a>
                                    </div>
                                    <!-- Buttons Column -->
                                    <div class="col">
                                        <button class="btn btn-sm btn-warning update-button"
                                                data-id="{{ $tenderFile->id }}"
                                                data-name="{{ $tenderFile->name }}"
                                                data-downloadLink="{{ $tenderFile->downloadLink }}">
                                            <i title="Update" class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-button"
                                                data-id="{{ $tenderFile->id }}">
                                            <i title="Delete" class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="card-footer">
                <!-- Card Footer goes here -->
            </div>
        </div>
    </div>
</div>

<!-- Add/Update Modal -->
<div class="modal fade" id="addUpdateModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Add New Tender File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="tenderId" name="tender_id" value="{{ $tender->id }}">
                    <div class="form-group">
                        <label for="name" class="required">File Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Tender File?</p>
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
@endsection

@push('styles')
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
        // Handle Add Button
        $('#addButton').on('click', function () {
            $('#modalTitle').text('Add New Tender File');
            $('#addUpdateForm').attr('action', '{{ route('tenders.tender-files.store', ['tender' => $tender->id]) }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#downloadLink').attr('required', true);
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');

            // Add asterisk to indicate required field
            $('label[for="downloadLink"]').html('Upload File: <span style="color: red;">*</span>');

            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#name').val('');
            $('#downloadLink').val('');
            $('#addUpdateModal').modal('show');
        });
    
        // Handle Update Button
        $('.update-button').on('click', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var tenderId = '{{ $tender->id }}';

            $('#modalTitle').text('Update Tender File');
            $('#addUpdateForm').attr('action', `/admin/tenders/${tenderId}/tender-files/${id}`);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#name').val(name);
            $('#downloadLink').val('');
            $('#downloadLink').removeAttr('required');
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning').text('Update');

            // Remove asterisk as field is not required
            $('label[for="downloadLink"]').html('Upload File:');

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var tenderId = '{{ $tender->id }}';
            var deleteUrl = `/admin/tenders/${tenderId}/tender-files/${id}`;
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationModal').modal('show');
        });
    
        // Reset toggle state when the modal is closed
        $('#addUpdateModal').on('hidden.bs.modal', function () {
            $('#addUpdateForm')[0].reset();
            $('.visibility-toggle').each(function() {
                $(this).bootstrapToggle('off');
            });
        });
    });
    </script>
    <script>
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
    </script>
@endpush