@extends('components.layouts.adminLTE')

@section('title')
    Contact Us
@endsection

@section('page_title')
    Contact Us
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Contact Us</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Contact Us List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle nosort">Priority</th>
                            <th class="text-center align-middle">Name</th>
                            <th class="text-center align-middle">Designation</th>
                            {{-- <th class="text-center align-middle nosort">View</th> --}}
                            <th class="text-center align-middle nosort">Phone</th>
                            <th class="text-center align-middle nosort">Email</th>
                            <th class="text-center align-middle nosort">Office</th>
                            <th class="text-center align-middle nosort">Office Address</th>
                            <th class="text-center align-middle nosort">Office Bearer</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="text-center align-middle">{{ $contact->priority }}</td>
                                <td class="text-center align-middle">{{ $contact->name }}</td>
                                <td class="text-center align-middle">{{ $contact->designation }}</td>
                                <td class="text-center align-middle">{{ $contact->phone ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $contact->email ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $contact->office_name ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $contact->office_address ?? 'N/A' }}</td>
                                <td class="text-center align-middle">
                                    @if ($contact->is_office_bearer)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $contact->id }}"
                                        data-name="{{ $contact->name }}"
                                        data-designation="{{ $contact->designation }}"
                                        data-priority="{{ $contact->priority }}"
                                        data-phone="{{ $contact->phone }}"
                                        data-email="{{ $contact->email }}"
                                        data-office_name="{{ $contact->office_name }}"
                                        data-office_address="{{ $contact->office_address }}"
                                        data-is_office_bearer="{{ $contact->is_office_bearer }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $contact->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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
                <h5 class="modal-title" id="modalTitle">Add New Contact</h5>
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
                                <input type="text" class="form-control" id="designation" name="designation" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="number" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label required" for="priority">Priority:</label>
                                <input type="number" class="form-control" id="priority" name="priority" required>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Is Office Bearer Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_office_bearer" value="0">
                                <label for="isOfficeBearer">Is Office Bearer:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isOfficeBearer" name="is_office_bearer" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officeName">Office Name:</label>
                                <input type="text" class="form-control" id="officeName" name="office_name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="officeAddress">Office Address:</label>
                                <textarea type="text" class="form-control" id="officeAddress" name="office_address"></textarea>
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
                <p>Are you sure you want to delete this contact?</p>
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
            $('#modalTitle').text('Add New Contact');
            $('#addUpdateForm').attr('action', '{{ route('contact-us.store') }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');

            // Add asterisk to indicate required field

            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#name').val('');
            $('#designation').val('');
            $('#priority').val('');
            $('#phone').val('');
            $('#email').val('');
            $('#officeName').val('');
            $('#officeAddress').val('');
            $('#isOfficeBearer').bootstrapToggle('off');
            $('#addUpdateModal').modal('show');
        });
    
        // Handle Update Button
        $('.update-button').on('click', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var designation = $(this).data('designation');
            var priority = $(this).data('priority');
            var phone = $(this).data('phone');
            var email = $(this).data('email');
            var office_name = $(this).data('office_name');
            var office_address = $(this).data('office_address');
            var is_office_bearer = $(this).data('is_office_bearer') ? true : false;

            $('#modalTitle').text('Update Contact');
            $('#addUpdateForm').attr('action', '/admin/contact-us/' + id);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#name').val(name);
            $('#designation').val(designation);
            $('#priority').val(priority);
            $('#phone').val(phone);
            $('#email').val(email);
            $('#officeName').val(office_name);
            $('#officeAddress').val(office_address);
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning');

            // Remove asterisk as field is not required

            // Set toggle states for each checkbox
            $('#isOfficeBearer').prop('checked', is_office_bearer).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var deleteUrl = '/admin/contact-us/' + id;
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