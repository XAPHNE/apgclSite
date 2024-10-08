@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
    <h1>User Management</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">User List</h2>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#userModal"><i class="fas fa-user-plus"></i></button>
                </div>
                <div class="card-body">
                    <table class="table table-striped datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Roles</th>
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

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="user_form" method="POST">
                        @csrf
                        <input type="hidden" id="userID" name="userID">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <select class="custom-select form-control" id="department_id" name="department_id" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roles">Assign Roles:</label><br>
                            @php
                                $roles = [
                                    'Admin' => 'admin',
                                    'Tender' => 'tender',
                                    'News & Event' => 'newsEvent',
                                    'About Us' => 'about',
                                    'Career' => 'career',
                                    'Documents' => 'document',
                                    'Disaster Management' => 'disaster',
                                    'Contact' => 'contact',
                                    'Corporate Social Responsibility' => 'corporate',
                                    'Calendar & Holidays' => 'calendar',
                                    'Daily Generations' => 'dailyGeneration'
                                ];
                            @endphp
                            @foreach ($roles as $roleLabel => $roleColumn)
                                <div class="form-check">
                                    <input type="hidden" name="{{ $roleColumn }}" value="0">
                                    <input class="form-check-input" type="checkbox" name="{{ $roleColumn }}" value="1" id="role_{{ $roleColumn }}">
                                    <label class="form-check-label" for="role_{{ $roleColumn }}">
                                        {{ $roleLabel }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" id="submit_button" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- User Modal End -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="delete_user_form">
                        @csrf
                        @method('DELETE')
                        <h3>Are you sure you want to delete this user?</h3>
                        <input type="hidden" id="delete_userID" name="userID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-danger">CONFIRM</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal End -->
@stop

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('user-management.store') }}";

                if ($('#userID').val()) {
                    url = "{{ route('user-management.update', ':id') }}".replace(':id', $('#userID').val());
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#userModal').modal('hide');
                        $('.modal-backdrop').remove();
                        $('#user_form').trigger('reset');
                        datatableReload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Data has been saved successfully',
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
                    },
                    processData: false,
                    contentType: false
                });
            });

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-management.index') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'department', name: 'department_id', searchable: false },
                    { data: 'roles', name: 'roles' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                $.get("{{ route('user-management.show', ':id') }}".replace(':id', id), function(data) {
                    $('#userID').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#department_id').val(data.department_id);
                    $('#userModalLabel').text('Update User');
                    $('#submit_button').text('Update');

                    // Remove 'required' attribute for password fields
                    $('#password').removeAttr('required');
                    $('#password-confirm').removeAttr('required');

                    // Set checkboxes based on user roles
                    $('input[name="tender"]').prop('checked', data.tender);
                    $('input[name="newsEvent"]').prop('checked', data.newsEvent);
                    $('input[name="about"]').prop('checked', data.about);
                    $('input[name="career"]').prop('checked', data.career);
                    $('input[name="document"]').prop('checked', data.document);
                    $('input[name="disaster"]').prop('checked', data.disaster);
                    $('input[name="contact"]').prop('checked', data.contact);
                    $('input[name="corporate"]').prop('checked', data.corporate);
                    $('input[name="calendar"]').prop('checked', data.calendar);
                    $('input[name="dailyGeneration"]').prop('checked', data.dailyGeneration);
                    $('input[name="admin"]').prop('checked', data.admin);

                    $('#userModal').modal('show');
                });
            });

            $('#edit_user_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('user-management.update', ':id') }}".replace(':id', $('#edit_userID').val());

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#editModal').modal('hide');
                        datatableReload();
                        Swal.fire({
                            icon: 'success',
                            title: 'User updated successfully',
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
                    },
                    processData: false,
                    contentType: false
                });
            });

            // Open the modal for deleting a user
            $(document).on('click', '.delete-button', function() {
                var id = $(this).data('id');
                $('#delete_userID').val(id);
                $('#deleteModal').modal('show');
            });

            // Handle form submission for deleting a user
            $('#delete_user_form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = "{{ route('user-management.destroy', ':id') }}".replace(':id', $('#delete_userID').val());

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        datatableReload();
                        Swal.fire({
                            icon: 'success',
                            title: 'User deleted successfully',
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


            function datatableReload() {
                $('#datatable').DataTable().ajax.reload();
            }

            $('#userModal').on('hidden.bs.modal', function () {
                $('#user_form').trigger('reset');
                $('#userID').val('');
                $('#userModalLabel').text('Add User');
                $('#submit_button').text('Register');
                $('input[type="checkbox"]').prop('checked', false);
                $('#password').attr('required', 'required');
                $('#password-confirm').attr('required', 'required'); // Add 'required' attribute back when modal is hidden
            });

            $('#userModal').on('show.bs.modal', function () {
                if (!$('#userID').val()) {
                    $('#password').attr('required', 'required');
                    $('#password-confirm').attr('required', 'required');  // Add 'required' attribute when opening for new user
                }
            });
        });
    </script>
@stop
