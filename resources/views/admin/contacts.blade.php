@extends('adminlte::page')

@section('title', 'Contact Management')

@section('content_header')
    <h1>Contact Management</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Contact List</h2>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#contactModal"><i class="fas fa-plus"></i> Add Contact</button>
                </div>
                <div class="card-body">
                    <table class="table table-hover datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Location</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Add Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="contact_form" method="POST">
                        @csrf
                        <input type="hidden" id="contactID" name="contactID">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="Enter Designation" required>
                            @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Enter Location" required>
                                <option>-----Select------</option>
                                <option value="HQ">HQ</option>
                                <option value="NTPS">NTPS</option>
                                <option value="LTPS">LTPS</option>
                                <option value="LKHEP">LKHEP</option>
                                <option value="KLHEP">KLHEP</option>
                                <option value="Narengi">Narengi</option>
                                <option value="Jagiroad">Jagiroad</option>
                            </select>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="number" class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority" placeholder="Enter Priority" required>
                            @error('priority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/admin-assets/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contacts.index') }}",
                columns: [
                    { data: 'priority', name: 'priority', searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'designation', name: 'designation' },
                    { data: 'location', name: 'location' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#contact_form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = "{{ route('contacts.store') }}";

                if ($('#contactID').val()) {
                    url = "{{ route('contacts.update', ':id') }}".replace(':id', $('#contactID').val());
                    formData += '&_method=PUT';
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#contact_form').trigger('reset');
                        $('#contactModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Contact saved successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                });
            });

            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                $.get("{{ route('contacts.show', ':id') }}".replace(':id', id), function(data) {
                    $('#contactID').val(data.id);
                    $('#name').val(data.name);
                    $('#designation').val(data.designation);
                    $('#location').val(data.location);
                    $('#priority').val(data.priority);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#contactModalLabel').text('Update Contact');
                    $('#saveBtn').text('Update');
                    $('#contactModal').modal('show');
                });
            });

            $(document).on('click', '.delete-button', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ route('contacts.destroy', ':id') }}".replace(':id', id),
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Contact has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                });
                            }
                        });
                    }
                });
            });

            $('#contactModal').on('hidden.bs.modal', function () {
                $('#contact_form').trigger('reset');
                $('#contactID').val('');
                $('#contactModalLabel').text('Add Contact');
                $('#saveBtn').text('Save');
            });
        });
    </script>
@stop
