@extends('components.layouts.adminLTE')

@section('title')
    Tenders
@endsection

@section('page_title')
    Tenders
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Tenders</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Tender List</h3>
                <div class="card-tools">
                    <a href="{{ url('admin/tenders/financial-years') }}" type="button" class="btn btn-danger">Add Financial Years</a>
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Financial Year</th>
                            <th class="text-center align-middle">Tender No</th>
                            <th class="text-center align-middle">Tender Details</th>
                            <th class="text-center align-middle nosort">Archived</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tenders as $tender)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $tender->financialYear->year }}</td>
                                <td class="text-center align-middle"><a href="{{ url('admin/tenders/' . $tender->id) }}" class="text-decoration-none">{{ $tender->tender_no }}</a></td>
                                <td class="text-center align-middle">{{ $tender->description }}</td>
                                <td class="text-center align-middle">
                                    @if ($tender->is_archived)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $tender->id }}"
                                        data-financial_year_id="{{ $tender->financialYear->year }}"
                                        data-tender_no="{{ $tender->tender_no }}"
                                        data-description="{{ $tender->description }}"
                                        data-is_archived="{{ $tender->is_archived }}"
                                        data-directory_name="{{ $tender->directory_name }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $tender->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
                                    </button>
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
    </div>
</div>

<!-- Add/Update Modal -->
<div class="modal fade" id="addUpdateModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Add New Tender</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
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
                            <!-- Archive Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_archived" value="0">
                                <label for="isArchived">Is Archived:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isArchived" name="is_archived" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Select Existing Folder:</label>
                            <select class="form-select">
                                <option selected disabled>Select</option>
                                @foreach($tenders as $tender)
                                    <option value="{{ $tender->directory_name }}">{{ $tender->directory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="directoryName" class="form-label">Directory Name</label>
                            <input id="directoryName" type="text" class="form-control required" name="directory_name" required>
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
            $('#modalTitle').text('Add New Tender');
            $('#addUpdateForm').attr('action', '{{ route('tenders.store') }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');

            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#financialYear').val('');
            $('#tenderNo').val('');
            $('#description').val('');
            $('#directoryName').val('');
            $('#isArchived').bootstrapToggle('off');
            $('#addUpdateModal').modal('show');
        });
    
        // Handle Update Button
        $('.update-button').on('click', function () {
            var id = $(this).data('id');
            var financial_year_id = $(this).data('financial_year_id');
            var tender_no = $(this).data('tender_no');
            var description = $(this).data('description');
            var directory_name = $(this).data('directory_name');
            var is_archived = $(this).data('is_archived') ? true : false;

            $('#modalTitle').text('Update Tender');
            $('#addUpdateForm').attr('action', '/admin/tenders/' + id);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#financialYear').val(financial_year_id);
            $('#tenderNo').val(tender_no);
            $('#description').val(description);
            $('#directoryName').val(directory_name);
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning');

            // Set toggle states for each checkbox
            $('#isArchived').prop('checked', is_archived).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var deleteUrl = '/admin/tenders/' + id;
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