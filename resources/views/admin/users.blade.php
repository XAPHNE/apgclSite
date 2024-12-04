@extends('components.layouts.adminLTE')

@section('title')
    Users
@endsection

@section('page_title')
    Users
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">User List</h3>
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
                            <th class="text-center align-middle">Email</th>
                            <th class="text-center align-middle">Roles</th>
                            <th class="text-center align-middle">Department</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle text-start">{{ $user->name }}</td>
                                <td class="align-middle text-start">{{ $user->email }}</td>
                                <td class="align-middle text-start">
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-secondary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle">{{ $user->department }}</td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button 
                                        class="btn btn-info assign-roles-button" 
                                        data-user-id="{{ $user->id }}" 
                                        data-user-roles="{{ $user->roles->pluck('name')->toJson() }}">
                                        Assign Roles
                                    </button>
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-department="{{ $user->department }}"
                                        data-must_change_passwd="{{ $user->must_change_passwd }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $user->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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

<!-- Assign Role Modal -->
<div class="modal fade" id="assignRolesModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="assignRolesForm" method="POST">
                @csrf
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Assign Roles to User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <div id="roles">
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="roles[]" 
                                        value="{{ $role->name }}" 
                                        id="role-{{ $role->id }}">
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add/Update Modal -->
<div class="modal fade" id="addUpdateModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="required">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required pattern="[A-Za-z\s]+" title="Name should contain only letters and spaces.">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email" class="required">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password" class="required">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required minlength="10" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{10,}" title="Password must be at least 10 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.">
                                    <button type="button" class="btn btn-outline-secondary toggle-password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="password_confirmation" class="required">Confirm Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="10">
                                    <button type="button" class="btn btn-outline-secondary toggle-password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="department" class="required">Department:</label>
                                <select id="department" name="department" class="form-select" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department }}">{{ $department }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Visibility Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="must_change_passwd" value="0">
                                <label for="mustChangePassword">Must Change Password:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="mustChangePassword" name="must_change_passwd" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
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
                <p>Are you sure you want to delete this User?</p>
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
    document.querySelectorAll('.assign-roles-button').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');
            const userRoles = JSON.parse(this.getAttribute('data-user-roles')); // Get assigned roles from the button

            // Reset checkboxes
            document.querySelectorAll('#assignRolesModal .form-check-input').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Check roles for the selected user
            userRoles.forEach(role => {
                const checkbox = document.querySelector(`#assignRolesModal .form-check-input[value="${role}"]`);
                if (checkbox) checkbox.checked = true;
            });

            // Update form action dynamically
            document.getElementById('assignRolesForm').setAttribute('action', `/admin/users/${userId}/assign-roles`);

            // Show the modal
            $('#assignRolesModal').modal('show');
        });
    });
</script>
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
        $('.toggle-password').on('click', function () {
            const passwordField = $(this).siblings('input');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);

            // Toggle icon class
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
        // Handle Add Button
        $('#addButton').on('click', function () {
            $('#modalTitle').text('Add New User');
            $('#addUpdateForm').attr('action', '{{ route('users.store') }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');
            
            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#name').val('');
            $('#email').val('');
            $('#password').val('');
            $('#password_confirmation').val('');
            $('#mustChangePassword').bootstrapToggle('on');
            $('#addUpdateModal').modal('show');
        });
    
        $('.update-button').on('click', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var department = $(this).data('department');
            var must_change_passwd = $(this).data('must_change_passwd') ? true : false;

            $('#modalTitle').text('Update User');
            $('#addUpdateForm').attr('action', '/admin/users/' + id);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');

            // Populate form fields
            $('#name').val(name);
            $('#email').val(email);
            $('#password').val('');
            $('#password_confirmation').val('');
            $('#department').val(department);

            // Remove 'required' attribute for password fields in update mode
            $('#password').removeAttr('required');
            $('#password_confirmation').removeAttr('required');

            // Update labels: remove asterisk and required class in update mode
            $('label[for="password"]').removeClass('required').text('Password:');
            $('label[for="password_confirmation"]').removeClass('required').text('Confirm Password:');

            // Update modal styling for update mode
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning');

            // Set toggle states for each checkbox
            $('#mustChangePassword').prop('checked', must_change_passwd).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var deleteUrl = '/admin/users/' + id;
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationModal').modal('show');
        });
    
        // Reset toggle state when the modal is closed
        $('#addUpdateModal').on('hidden.bs.modal', function () {
            $('#addUpdateForm')[0].reset();
            $('.visibility-toggle').each(function() {
                $(this).bootstrapToggle('off');
            });
            // Reset labels to include asterisk (for add mode)
            $('label[for="password"]').html('Password: <span style="color: red;">*</span>');
            $('label[for="password_confirmation"]').html('Confirm Password: <span style="color: red;">*</span>');

            // Add required attribute back for add mode
            $('#password').attr('required', true);
            $('#password_confirmation').attr('required', true);
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