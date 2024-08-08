@extends('adminlte::page')

@section('title', 'Add Admin')

@section('content_header')
    <h1>Add Admin Accounts</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center mb-2">
                        <h4 class="card-title"> Admins Data </h4>
                    </div>
                    <table class="table table-striped datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Department </th>
                                <th> Roles </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="auth col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo" style="text-align:center">
                            <img width="100 px" src="{{ asset('admin-assets/img/APGCL_logo_mini.png') }}">
                        </div>
                        <form id="add_user" class="pt-3" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror form-control-lg" id="name" name="name" placeholder="Name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror form-control-lg" id="email" name="email" placeholder="Email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror form-control-lg" id="password" name="password" placeholder="Password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control form-control-lg" id="department" name="department" aria-describedby="inputGroupPrepend">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
                                    @endforeach
                                </select>
                                <!-- Error msg -->
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
                                <!-- Error msg -->
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Contact Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 grid-margin strech-card">
                        <div class="card">
                            <div class="card-body">
                                <form name="edit_user" id="edit_user" method="POST" class="needs-validation">
                                    <!-- validation code -->
                                    @csrf

                                    <input type="hidden" name="userID" id="userID" />

                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror form-control-lg"
                                            id="editname" name="editname" placeholder="Name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror form-control-lg"
                                            id="editemail" name="editemail" placeholder="Email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">CLOSE</button>
                                        <button type="submit" class="btn updateBtn btn-success">UPDATE
                                            DATA</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit modal ended -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Disaster Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="delete_user" id="delete_user">
                        @csrf
                        <h3>The Selected entry will be deleted</h3>
                        <input type="hidden" id="delete_id" name="delete_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button class="btn confirmBtn btn-danger">CONFIRM</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/admin-assets/css/custom.css"> --}}
@stop

@section('js')
    {{-- Add here extra js --}}
    <script src="{{ asset('admin-assets/js/custom.js') }}"></script>
    <!-- custom script for edit Modal -->
    <script>
        $(document).ready(function() {

            $('#add_user').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('register-user') }}",
                    data: formData,
                    success: function(response) {
                        $('#add_user').trigger('reset');
                        datatableReload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Your Data has been Saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error: function(response) {
                        swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $('#datatable').DataTable({
                "paging": true,
                "lengthchange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                info: true,

                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 50, "All"],
                ],

                ajax: "{{ route('add-user') }}",

                columns: [{
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: null,
                        name: 'role',
                        render: function(data, type, row) {
                            return '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.admin == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="admin">Admin</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.tender == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="tender">Tender</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.newsEvent == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="newsEvent">News & Event</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.about == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="about">About Us</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.career == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="career">Career</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.document == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="document">Documents</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.disaster == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="disaster">Disaster Management</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.contact == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="contact">Contact</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.corporate == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="corporate">Corporate Social <br> Responsibility</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.calendar == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="calendar">Calendar & Holidays</label>' +
                                '</div>' +
                                '<div class="form-check">' +
                                '@csrf<input type="checkbox" class="form-check-input" data-id="' +
                                row.id + '"' + (row.dailyGeneration == 1 ? 'checked' : '') + '>' +
                                '<label class="form-check-label" id="dailyGeneration">Daily Generations</label>' +
                                '</div>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function() {
                    // Attach a click event handler to the checkboxes
                    $('#datatable tbody').on('click', 'input[type="checkbox"]', function() {
                        // Get the ID of the row from the checkbox value
                        var id = $(this).data('id');
                        var role = $(this).closest('div.form-check').find(
                            'label.form-check-label').attr(
                            'id');
                        var check = $(this).is(':checked') ? 1 : 0;
                        $.ajax({
                            url: '/update-role',
                            type: 'POST',
                            data: {
                                id: id,
                                check: check,
                                role: role,
                                _token: csrf_token
                            },
                            success: function() {
                                // Do something on success, if needed
                                datatableReload();
                            }
                        });

                    });
                }
            });

            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id'); //to take data
                $('#editModal').modal('show');

                $.ajax({
                    type: "get",
                    url: "/editUser/" + id,
                    success: function(response) {
                        $('#userID').val(id)
                        $('#editname').val(response.user.name);
                        $('#editemail').val(response.user.email);
                    }
                });
            });

            $('#edit_user').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: "update-user",
                    data: formData,
                    success: function(response) {
                        $('#editModal').modal('hide');
                        datatableReload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Your Data has been Updated',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id'); //to take data
                $('#deleteModal').modal('show');
                $('#delete_id').val(id);
            });
            $('#delete_user').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "deleteUser",
                    data: formData,
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        datatableReload();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

        });
    </script>
@stop