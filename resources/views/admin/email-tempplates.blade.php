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
                                        data-signature="{{ $emailTemplate->signature }}"><i title="View" class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $emailTemplate->id }}"
                                        data-subject="{{ $emailTemplate->subject }}"
                                        data-email_body="{{ $emailTemplate->email_body }}"
                                        data-signature="{{ $emailTemplate->signature }}"><i title="Update" class="fas fa-edit"></i>
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
                $('#saveButton').show();
                $('#addUpdateModal').modal('show');
            });

            // Handle View Button
            $(document).on('click', '.view-button', function () {
                var subject = $(this).data('subject');
                var email_body = $(this).data('email_body');
                var signature = $(this).data('signature');
                $('#modalTitle').text('View Email Template');
                $('#subject').val(subject).prop('readonly', true);
                $('#email_body').val(email_body).prop('readonly', true);
                $('#signature').val(signature).prop('readonly', true);
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

                $('#modalTitle').text('Update Email Template');
                $('#addUpdateForm').attr('action', '/admin/email-templates/' + id);
                $('#addUpdateForm').find('input[name="_method"]').remove();
                $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
                $('#saveButton').text('Update');
                $('#subject').val(subject).prop('readonly', false);
                $('#email_body').val(email_body).prop('readonly', false);
                $('#signature').val(signature).prop('readonly', false);
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