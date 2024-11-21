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
                    <div class="col-8">
                        <div class="p-3 card">
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
                                <strong class="d-inline">Tender Description:</strong>
                                <span class="ms-2">{{ $tender->description }}</span>
                            </p>
                            <div class="card-footer d-flex justify-content-end">
                                <button class="btn btn-warning" id="editButton"
                                        data-id="{{ $tender->id }}"
                                        data-financial_year_id="{{ $tender->financial_year_id }}"
                                        data-tender_no="{{ $tender->tender_no }}"
                                        data-description="{{ $tender->description }}"
                                        data-directory_name="{{ $tender->directory_name }}"
                                        data-is_archived="{{ $tender->is_archived }}">
                                    <i title="Update" class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 card">
                            <h5>Uploaded Files:</h5>
                            @foreach ($tenderFiles as $tenderFile)
                                <div class="mb-2 row">
                                    <!-- Anchor Tag Column -->
                                    <div class="col">
                                        <a href="{{ url($tenderFile->downloadLink) }}" class="text-decoration-none" target="_blank">
                                            <i class="fas fa-file-download" aria-hidden="true"></i> {{ $tenderFile->name }}
                                        </a>
                                    </div>
                                    <!-- Buttons Column -->
                                    <div class="col-4">
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

<!-- Add/Update Upfoad File Modal -->
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

<!-- Add/Update Tender Modal -->
<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Update Tender</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="financialYear" class="form-label">Financial Year:</label>
                                <select name="financial_year_id" id="financialYear" class="form-select required" required>
                                    <option selected disabled>Select</option>
                                    @foreach($financialYears as $financialYear)
                                        <option value="{{ $financialYear->id }}">{{ $financialYear->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tenderNo" class="form-label">Tender No.:</label>
                                <input type="text" class="form-control required" id="tenderNo" name="tender_no" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control required" id="description" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <label for="directoryName" class="form-label">Directory Name</label>
                            <input id="directoryName" type="text" class="form-control required" name="directory_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Archive Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_archived" value="0">
                                <label for="isArchived">Is Archived:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isArchived" name="is_archived" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="saveButton">Update</button>
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

        // Handle Edit Button for Tender Details
        $('#editButton').on('click', function () {
            var id = $(this).data('id');
            var financial_year_id = $(this).data('financial_year_id');
            var tender_no = $(this).data('tender_no');
            var description = $(this).data('description');
            var directory_name = $(this).data('directory_name');
            var is_archived = $(this).data('is_archived') ? true : false;

            // Debugging logs
            console.log('Edit button clicked');
            console.log({ id, financial_year_id, tender_no, description, directory_name, is_archived });

            // Update the modal title and form action
            $('#modalTitle').text('Update Tender');
            $('#updateForm').attr('action', `/admin/tenders/${id}`);
            $('#updateForm').find('input[name="_method"]').remove();
            $('#updateForm').append('<input type="hidden" name="_method" value="PATCH">');

            // Pre-fill form fields
            $('#financialYear').val(financial_year_id);
            $('#tenderNo').val(tender_no);
            $('#description').val(description);
            $('#directoryName').val(directory_name);

            // Update modal appearance
            $('#updateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning').text('Update');

            // Set toggle states for each checkbox
            $('#isArchived').prop('checked', is_archived).change();

            // Show the modal
            $('#updateModal').modal('show');
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