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
            @can('View Tender File')
                <div class="card card-success">
                    <div class="card-header">
                        @can('Add Tender File')
                            <div class="card-tools">
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="p-3 card">
                                    @if ($tender->is_archived)
                                        <p>
                                            <span class="badge bg-success">Archived</span>
                                        </p>
                                    @else
                                        <p>
                                            <span class="badge bg-secondary">Not Archived</span>
                                        </p>
                                    @endif
                                    <p>
                                        <strong class="d-inline">Tender No:</strong>
                                        <span class="ms-2">{{ $tender->tender_no }}</span>
                                    </p>
                                    <p>
                                        <strong class="d-inline">Department:</strong>
                                        <span class="ms-2">{{ $tender->department }}</span>
                                    </p>
                                    <p>
                                        <strong class="d-inline">Financial Year:</strong>
                                        <span class="ms-2">{{ $tender->financialYear->year }}</span>
                                    </p>
                                    <p>
                                        <strong class="d-inline">Folder Name:</strong>
                                        <span class="ms-2">{{ $tender->directory_name }}</span>
                                    </p>
                                    <p>
                                        <strong class="d-inline">Tender Details:</strong>
                                        <span class="ms-2">{{ $tender->description }}</span>
                                    </p>
                                    @can('Update Tender')  
                                    <div class="card-footer d-flex justify-content-end gap-2">
                                        <button class="btn btn-warning" id="editButton"
                                                data-id="{{ $tender->id }}"
                                                data-financial_year_id="{{ $tender->financial_year_id }}"
                                                data-tender_no="{{ $tender->tender_no }}"
                                                data-description="{{ $tender->description }}"
                                                data-directory_name="{{ $tender->directory_name }}"
                                                data-is_archived="{{ $tender->is_archived }}"
                                                data-department="{{ $tender->department }}">
                                            <i title="Update" class="fas fa-edit"></i> Edit
                                        </button>

                                        @hasrole('Super Admin')
                                            @if ($tender->for_review)
                                                <form action="{{ route('tenders.approve', $tender->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success">Approve & Publish</button>
                                                </form>
                                            @endif
                                        @endhasrole
                                    </div>
                                    @endcan
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
                                            @canany(['Update Tender File', 'Delete Tender File'])
                                                <!-- Buttons Column -->
                                                <div class="col-4">
                                                    @can('Update Tender File')
                                                        <button class="btn btn-sm btn-warning update-button"
                                                                data-id="{{ $tenderFile->id }}"
                                                                data-name="{{ $tenderFile->name }}"
                                                                data-downloadLink="{{ $tenderFile->downloadLink }}">
                                                            <i title="Update" class="fas fa-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @can('Delete Tender File')
                                                        <button class="btn btn-sm btn-danger delete-button"
                                                                data-id="{{ $tenderFile->id }}">
                                                            <i title="Delete" class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endcan
                                                </div>
                                            @endcanany
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
            @else
                <div class="d-flex justify-content-center align-items-center vh-100">
                    <div class="text-center">
                        <h4 class="text-danger">You do not have permission to view this content.</h4>
                    </div>
                </div>
            @endcan
        </div>
    </div>

    @can('View Tender File')
        @canany(['Add Tender File', 'Update Tender File'])
            <!-- Add/Update Upload File Modal -->
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
        @endcanany

        @canany(['Add Tender', 'Update Tender'])
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
                                            <label for="financialYear" class="form-label required">Financial Year:</label>
                                            <select name="financial_year_id" id="financialYear" class="form-select required" required disabled>
                                                <option selected disabled>Select</option>
                                                @foreach($financialYears as $financialYear)
                                                    <option value="{{ $financialYear->id }}">{{ $financialYear->year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="department" class="required">Department:</label>
                                            <select id="department" name="department" class="form-select" required @unlessrole('Super Admin') disabled @endunlessrole>
                                                <option value="" disabled>Select</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department }}" 
                                                        @if (auth()->user()->department === $department || old('department') === $department) 
                                                            selected 
                                                        @endif>
                                                        {{ $department }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @unlessrole('Super Admin')
                                                <input type="hidden" name="department" value="{{ auth()->user()->department }}">
                                            @endunlessrole
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="tenderNo" class="form-label required">Tender No.:</label>
                                            <input type="text" class="form-control required" id="tenderNo" name="tender_no" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="directoryName" class="form-label required">Folder Name:</label>
                                        <input id="directoryName" type="text" class="form-control required" name="directory_name" required disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="description" class="form-label required">Tender Details:</label>
                                            <textarea class="form-control required" id="description" name="description" required></textarea>
                                        </div>
                                    </div>
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
        @endcanany

        @can('Delete Tender File')
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
        @endcan
    @endcan
@endsection

@can('View Tender File')
    @push('styles')
        @canany(['Update Tender', 'Add Tender File', 'Update Tender File'])
            @can('Update Tender')
                <style>
                    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
                    .toggle.ios .toggle-handle { border-radius: 20px; }
                </style>
            @endcan
            @canany(['Add Tender File', 'Update Tender File'])
                <style>
                    .required:after {
                        content: " *";
                        color: red;
                    }
                </style>
            @endcanany
        @endcanany
    @endpush

    @push('scripts')
    <script>
        $(document).ready(function () {
            @can('Add Tender File')
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
            @endcan

            @can('Update Tender')
                // Handle Edit Button for Tender Details
                $('#editButton').on('click', function () {
                    var id = $(this).data('id');
                    var financial_year_id = $(this).data('financial_year_id');
                    var tender_no = $(this).data('tender_no');
                    var description = $(this).data('description');
                    var directory_name = $(this).data('directory_name');
                    var is_archived = $(this).data('is_archived') ? true : false;
                    var department = $(this).data('department');

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
                    $('#department').val(department);

                    // Update modal appearance
                    $('#updateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
                    $('#saveButton').removeClass('btn-success').addClass('btn-warning').text('Update');

                    // Set toggle states for each checkbox
                    $('#isArchived').prop('checked', is_archived).change();

                    // Show the modal
                    $('#updateModal').modal('show');
                });
            @endcan
        
            @can('Update Tender File')
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
            @endcan
        
            @can('Delete Tender File')
                // Handle Delete Button
                $('.delete-button').on('click', function () {
                    var id = $(this).data('id');
                    var tenderId = '{{ $tender->id }}';
                    var deleteUrl = `/admin/tenders/${tenderId}/tender-files/${id}`;
                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteConfirmationModal').modal('show');
                });
            @endcan
        
            @can('Update Tender')
                // Reset toggle state when the modal is closed
                $('#addUpdateModal').on('hidden.bs.modal', function () {
                    $('#addUpdateForm')[0].reset();
                    $('.visibility-toggle').each(function() {
                        $(this).bootstrapToggle('off');
                    });
                });
            @endcan
        });
        </script>
        <script>
            @canany(['Update Tender', 'Add Tender File', 'Update Tender File', 'Delete Tender File'])
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

            @canany(['Update Tender', 'Add Tender File', 'Update Tender File'])
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