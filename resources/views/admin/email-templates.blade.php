@extends('components.layouts.adminLTE')

@section('title')
    Email Templates
@endsection

@section('page_title')
    Email Templates
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Email Templates</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Email Template List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-start">Subject</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emailTemplates as $emailTemplate)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $emailTemplate->subject }}</td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-info view-button"
                                        data-subject="{{ $emailTemplate->subject }}"
                                        data-email_body="{{ $emailTemplate->email_body }}"
                                        data-signature="{{ $emailTemplate->signature }}"
                                        data-is_birthday="{{ $emailTemplate->is_birthday }}"
                                        data-is_joining_aniversery="{{ $emailTemplate->is_joining_aniversery }}"
                                        data-is_retirement="{{ $emailTemplate->is_retirement }}"
                                        data-is_holiday="{{ $emailTemplate->is_holiday }}"
                                        data-event_id="{{ $emailTemplate->event_id }}"><i title="View" class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $emailTemplate->id }}"
                                        data-subject="{{ $emailTemplate->subject }}"
                                        data-email_body="{{ $emailTemplate->email_body }}"
                                        data-signature="{{ $emailTemplate->signature }}"
                                        data-is_birthday="{{ $emailTemplate->is_birthday }}"
                                        data-is_joining_aniversery="{{ $emailTemplate->is_joining_aniversery }}"
                                        data-is_retirement="{{ $emailTemplate->is_retirement }}"
                                        data-is_holiday="{{ $emailTemplate->is_holiday }}"
                                        data-event_id="{{ $emailTemplate->event_id }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $emailTemplate->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Add New Email Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject" class="required">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="email_body" class="required">Email Body:</label>
                        <textarea class="form-control" id="email_body" name="email_body" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="signature" class="required">Signature:</label>
                        <textarea class="form-control" id="signature" name="signature" rows="4" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="is_birthday" value="0">
                                <label for="is_birthday" class="required">Is Birthday:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="is_birthday" name="is_birthday" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="is_birthday" value="0">
                                <label for="is_joining_aniversery" class="required">Is Joining Aniversery:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="is_joining_aniversery" name="is_joining_aniversery" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="is_birthday" value="0">
                                <label for="is_retirement" class="required">Is Retirement:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="is_retirement" name="is_retirement" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="is_birthday" value="0">
                                <label for="is_holiday" class="required">Is Holiday:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="is_holiday" name="is_holiday" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div id="eventDropdownContainer" style="display: none;">
                        <div class="form-group">
                            <label for="event_id" class="required">Holiday Event:</label>
                            <select class="form-control" id="event_id" name="event_id">
                                <option value="" disabled selected>Select</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">
                                        {{ $event->public_holidays }}
                                    </option>
                                @endforeach
                            </select>
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
                <p>Are you sure you want to delete this Email Template?</p>
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

            $('.visibility-toggle').on('change', function () {
                if ($(this).prop('checked')) {
                    $('.visibility-toggle').not(this).bootstrapToggle('off');
                }
                toggleEventDropdown();
            });

            // Show/hide event dropdown based on "Is Holiday" toggle
            function toggleEventDropdown() {
                if ($('#is_holiday').prop('checked')) {
                    $('#eventDropdownContainer').show(); // Show event dropdown
                } else {
                    $('#eventDropdownContainer').hide(); // Hide event dropdown
                    $('#event_id').val(''); // Reset event selection
                }
            }

            // Call the function on toggle change
            $('#is_holiday').on('change', function () {
                toggleEventDropdown();
            });

            // Call on modal open to set initial state
            toggleEventDropdown();

            // Handle Add Button
            $('#addButton').on('click', function () {
                $('#modalTitle').text('Add New Email Template');
                $('#addUpdateForm').attr('action', '{{ route('email-templates.store') }}');
                $('#addUpdateForm').attr('method', 'POST');
                $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
                $('#saveButton').removeClass('btn-warning').addClass('btn-success');
                $('#saveButton').text('Save');
                $('#addUpdateForm input[name="_method"]').remove();
                $('#subject').val('').prop('readonly', false);
                $('#email_body').val('').prop('readonly', false);
                $('#signature').val('').prop('readonly', false);
                $('#event_id').val('').prop('disabled', false);
                $('.visibility-toggle').each(function () {
                    $(this).bootstrapToggle('off');
                });
                $('#saveButton').show();
                $('#addUpdateModal').modal('show');
            });

            // Handle View Button
            $(document).on('click', '.view-button', function () {
                var subject = $(this).data('subject');
                var email_body = $(this).data('email_body');
                var signature = $(this).data('signature');
                var is_birthday = $(this).data('is_birthday');
                var is_joining_aniversery = $(this).data('is_joining_aniversery');
                var is_retirement = $(this).data('is_retirement');
                var is_holiday = $(this).data('is_holiday');
                var event_id = $(this).data('event_id');
                $('#modalTitle').text('View Email Template');
                $('#subject').val(subject).prop('readonly', true);
                $('#email_body').val(email_body).prop('readonly', true);
                $('#signature').val(signature).prop('readonly', true);
                $('#is_birthday').bootstrapToggle(is_birthday ? 'on' : 'off').prop('disabled', true);
                $('#is_joining_aniversery').bootstrapToggle(is_joining_aniversery ? 'on' : 'off').prop('disabled', true);
                $('#is_retirement').bootstrapToggle(is_retirement ? 'on' : 'off').prop('disabled', true);
                $('#is_holiday').bootstrapToggle(is_holiday ? 'on' : 'off').prop('disabled', true);
                if (is_holiday) {
                    $('#eventDropdownContainer').show();
                    $('#event_id').val(event_id).prop('disabled', true);
                } else {
                    $('#eventDropdownContainer').hide();
                    $('#event_id').val('').prop('disabled', true);
                }
                $('#addUpdateModal .modal-header').removeClass('bg-success bg-warning').addClass('bg-info');
                $('#saveButton').hide();
                $('#addUpdateModal').modal('show');
            })
        
            // Handle Update Button
            $(document).on('click', '.update-button', function () {
                var id = $(this).data('id');
                var subject = $(this).data('subject');
                var email_body = $(this).data('email_body');
                var signature = $(this).data('signature');
                var is_birthday = $(this).data('is_birthday') ? true : false;
                var is_joining_aniversery = $(this).data('is_joining_aniversery') ? true : false;
                var is_retirement = $(this).data('is_retirement') ? true : false;
                var is_holiday = $(this).data('is_holiday') ? true : false;
                var event_id = $(this).data('event_id');

                $('#modalTitle').text('Update Email Template');
                $('#addUpdateForm').attr('action', '/admin/email-templates/' + id);
                $('#addUpdateForm').find('input[name="_method"]').remove();
                $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
                $('#saveButton').text('Update');
                $('#subject').val(subject).prop('readonly', false);
                $('#email_body').val(email_body).prop('readonly', false);
                $('#signature').val(signature).prop('readonly', false);
                $('#event_id').prop('disabled', false);
                $('#is_birthday').bootstrapToggle(is_birthday ? true : false).prop('disabled', false);
                $('#is_joining_aniversery').bootstrapToggle(is_joining_aniversery  ? true : false).prop('disabled', false);
                $('#is_retirement').bootstrapToggle(is_retirement  ? true : false).prop('disabled', false);
                $('#is_holiday').bootstrapToggle(is_holiday ? 'on' : 'off').prop('disabled', false);
                if (is_holiday) {
                    $('#eventDropdownContainer').show();
                    $('#event_id').val(event_id).prop('disabled', false);
                } else {
                    $('#eventDropdownContainer').hide();
                    $('#event_id').val('').prop('disabled', false);
                }
                $('#addUpdateModal .modal-header').removeClass('bg-success bg-info').addClass('bg-warning');
                $('#saveButton').removeClass('btn-success').addClass('btn-warning');
                $('#addUpdateModal').modal('show');
            });
        
            // Handle Delete Button
            $(document).on('click', '.delete-button', function () {
                var id = $(this).data('id');
                var deleteUrl = '/admin/email-templates/' + id;
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteConfirmationModal').modal('show');
            });
            
            // Reset modal when closed
            $('#addUpdateModal').on('hidden.bs.modal', function () {
                $('#addUpdateForm')[0].reset();
                $('.visibility-toggle').each(function() {
                        $(this).bootstrapToggle('off');
                    });
                $('#eventDropdownContainer').hide();
                $('#saveButton').show();
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