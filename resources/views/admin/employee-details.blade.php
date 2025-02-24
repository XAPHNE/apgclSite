@extends('components.layouts.adminLTE')

@section('title')
    Employees
@endsection

@section('page_title')
    Employees
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Employees</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Employee List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Name</th>
                            <th class="text-center align-middle">Date of Birth</th>
                            <th class="text-center align-middle">Date of Joining</th>
                            <th class="text-center align-middle">Date of Retirement</th>
                            <th class="text-center align-middle">Official Email</th>
                            <th class="text-center align-middle">Personal Email</th>
                            <th class="text-center align-middle">Phone</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDetails as $employeeDetail)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->title . ' ' . $employeeDetail->first_name . ' ' . $employeeDetail->last_name }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->dob ? $employeeDetail->dob->format('M d, Y') : 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->doj ? $employeeDetail->doj->format('M d, Y') : 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->dor ? $employeeDetail->dor->format('M d, Y') : 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->email_official ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->email_personal ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $employeeDetail->phone ?? 'N/A' }}</td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $employeeDetail->id }}"
                                        data-title="{{ $employeeDetail->title }}"
                                        data-first_name="{{ $employeeDetail->first_name }}"
                                        data-last_name="{{ $employeeDetail->last_name }}"
                                        data-dob="{{ $employeeDetail->dob ? $employeeDetail->dob->format('Y-m-d') : '' }}"
                                        data-doj="{{ $employeeDetail->doj ? $employeeDetail->doj->format('Y-m-d') : '' }}"
                                        data-dor="{{ $employeeDetail->dor ? $employeeDetail->dor->format('Y-m-d') : '' }}"
                                        data-email_official="{{ $employeeDetail->email_official }}"
                                        data-email_personal="{{ $employeeDetail->email_personal }}"
                                        data-phone="{{ $employeeDetail->phone }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $employeeDetail->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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
                <h5 class="modal-title" id="modalTitle">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="title" class="required">Title:</label>
                                <select class="form-control" id="title" name="title" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($titles as $title)
                                    <option value="{{ $title }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="first_name" class="required">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="last_name" class="required">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="doj">Date of Joining:</label>
                                <input type="date" class="form-control" id="doj" name="doj">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dor">Date of Retirement:</label>
                                <input type="date" class="form-control" id="dor" name="dor">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email_official">Official Email:</label>
                                <input type="email" class="form-control" id="email_official" name="email_official">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email_personal">Personal Email:</label>
                                <input type="email" class="form-control" id="email_personal" name="email_personal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
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
                <p>Are you sure you want to delete this Employee?</p>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
                stateSave: true,
            });
            
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "in", // Default country (India)
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            // Ensure full number with country code is submitted
            $("form").on("submit", function () {
                $("#phone").val(iti.getNumber()); // Set input value to the full international number
            });
            
            // Handle Add Button
            $('#addButton').on('click', function () {
                $('#modalTitle').text('Add New Employee');
                $('#addUpdateForm').attr('action', '{{ route('employee-details.store') }}');
                $('#addUpdateForm').attr('method', 'POST');
                $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
                $('#saveButton').removeClass('btn-warning').addClass('btn-success');
                $('#saveButton').text('Save');
                $('#addUpdateForm input[name="_method"]').remove();
                $('#title').val('');
                $('#first_name').val('');
                $('#last_name').val('');
                $('#dob').val('');
                $('#doj').val('');
                $('#dor').val('');
                $('#email_official').val('');
                $('#email_personal').val('');
                iti.setNumber('');
                $('#addUpdateModal').modal('show');
            });
        
            // Handle Update Button
            $(document).on('click', '.update-button', function () {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var first_name = $(this).data('first_name');
                var last_name = $(this).data('last_name');
                var dob = $(this).data('dob');
                var doj = $(this).data('doj');
                var dor = $(this).data('dor');
                var email_official = $(this).data('email_official');
                var email_personal = $(this).data('email_personal');
                var phone = $(this).data('phone');

                $('#modalTitle').text('Update Employee');
                $('#addUpdateForm').attr('action', '/admin/employee-details/' + id);
                $('#addUpdateForm').find('input[name="_method"]').remove();
                $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
                $('#saveButton').text('Update');
                $('#title').val(title);
                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#dob').val(dob);
                $('#doj').val(doj);
                $('#dor').val(dor);
                $('#email_official').val(email_official);
                $('#email_personal').val(email_personal);
                iti.setNumber(phone ? String(phone) : '');
                $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
                $('#saveButton').removeClass('btn-success').addClass('btn-warning');
                $('#addUpdateModal').modal('show');
            });
        
            // Handle Delete Button
            $(document).on('click', '.delete-button', function () {
                var id = $(this).data('id');
                var deleteUrl = '/admin/employee-details/' + id;
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteConfirmationModal').modal('show');
            });
        
            // Reset modal on close
            $('#addUpdateModal').on('hidden.bs.modal', function () {
                $('#addUpdateForm')[0].reset();
                iti.setNumber(''); // Clear intl-tel-input
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