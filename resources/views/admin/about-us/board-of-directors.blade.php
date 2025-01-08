@extends('components.layouts.adminLTE')

@section('title')
    Board of Directors
@endsection

@section('page_title')
    Board of Directors
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">About Us</li>
    <li class="breadcrumb-item active">Board of Directors</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Board of Directors List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle nosort">Avatar</th>
                            <th class="text-center align-middle">Name</th>
                            <th class="text-center align-middle">Designation</th>
                            <th class="text-center align-middle">Organisation</th>
                            <th class="text-center align-middle nosort">Chairman</th>
                            <th class="text-center align-middle nosort">MD</th>
                            <th class="text-center align-middle nosort">Gov.t Rep.</th>
                            <th class="text-center align-middle nosort">Indi. Director</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boardOfDirectors as $boardOfDirector)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle"><img src="{{ asset($boardOfDirector->downloadLink) }}" class="rounded-circle" height="50px" width="50px" alt="{{ $boardOfDirector->name }}'s Avatar"></td>
                                <td class="text-center align-middle">{{ $boardOfDirector->name }}</td>
                                <td class="text-center align-middle">{{ $boardOfDirector->designation }}</td>
                                <td class="text-center align-middle">{!! $boardOfDirector->organisation !!}</td>
                                <td class="text-center align-middle">
                                    @if ($boardOfDirector->is_chairman)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($boardOfDirector->is_md)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($boardOfDirector->is_gov_rep)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($boardOfDirector->is_indi_ditr)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $boardOfDirector->id }}"
                                        data-name="{{ $boardOfDirector->name }}"
                                        data-designation="{{ $boardOfDirector->designation }}"
                                        data-organisation="{{ $boardOfDirector->organisation }}"
                                        data-downloadlink="{{ $boardOfDirector->downloadLink }}"
                                        data-is_chairman="{{ $boardOfDirector->is_chairman }}"
                                        data-is_md="{{ $boardOfDirector->is_md }}"
                                        data-is_gov_rep="{{ $boardOfDirector->is_gov_rep }}"
                                        data-is_indi_ditr="{{ $boardOfDirector->is_indi_ditr }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $boardOfDirector->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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
                <h5 class="modal-title" id="modalTitle">Add New Board of Director</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="required">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="designation" class="required">Designation:</label>
                                <input class="form-control" id="designation" name="designation" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="required" for="organisation">Organisation:</label>
                                <input type="text" class="form-control" id="organisation" name="organisation">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="downloadLink">Upload Profile Picture:</label>
                                <input type="file" class="form-control" id="downloadLink" name="downloadLink">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_chairman" value="0">
                                <label for="isChairman">Is Chairman:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isChairman" name="is_chairman" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_md" value="0">
                                <label for="isMD">Is MD:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isMD" name="is_md" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_gov_rep" value="0">
                                <label for="isGovRep">Is Govt. Rep:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isGovRep" name="is_gov_rep" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_indi_ditr" value="0">
                                <label for="isIndiDitr">Is Indi. Director:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isIndiDitr" name="is_indi_ditr" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Board of Director?</p>
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
            $('#modalTitle').text('Add New Board of Director');
            $('#addUpdateForm').attr('action', '{{ route('board-of-directors.store') }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#downloadLink').attr('required', true);
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');

            // Add asterisk to indicate required field
            $('label[for="downloadLink"]').html('Upload File: <span style="color: red;">*</span>');

            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#name').val('');
            $('#designation').val('');
            $('#organisation').val('');
            $('#downloadLink').val('');
            $('#isChairman').bootstrapToggle('off');
            $('#isMD').bootstrapToggle('off');
            $('#isGovRep').bootstrapToggle('off');
            $('#isIndiDitr').bootstrapToggle('off');
            $('#addUpdateModal').modal('show');
        });
    
        // Handle Update Button
        $(document).on('click', '.update-button', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var designation = $(this).data('designation');
            var organisation = $(this).data('organisation');
            var is_chairman = $(this).data('is_chairman') ? true : false;
            var is_md = $(this).data('is_md') ? true : false;
            var is_gov_rep = $(this).data('is_gov_rep') ? true : false;
            var is_indi_ditr = $(this).data('is_indi_ditr') ? true : false;

            $('#modalTitle').text('Update Board of Director');
            $('#addUpdateForm').attr('action', '/admin/about-us/board-of-directors/' + id);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#name').val(name);
            $('#designation').val(designation);
            $('#organisation').val(organisation);
            $('#downloadLink').val('');
            $('#downloadLink').removeAttr('required');
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning');

            // Remove asterisk as field is not required
            $('label[for="downloadLink"]').html('Upload File:');

            // Set toggle states for each checkbox
            $('#isChairman').prop('checked', is_chairman).change();
            $('#isMD').prop('checked', is_md).change();
            $('#isGovRep').prop('checked', is_gov_rep).change();
            $('#isIndiDitr').prop('checked', is_indi_ditr).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $(document).on('click', '.delete-button', function () {
            var id = $(this).data('id');
            var deleteUrl = '/admin/about-us/board-of-directors/' + id;
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