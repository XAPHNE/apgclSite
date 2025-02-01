@extends('components.layouts.adminLTE')

@section('title')
    Events
@endsection

@section('page_title')
    Events
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Events</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Event List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Month</th>
                            <th class="text-center align-middle">Date</th>
                            <th class="text-center align-middle">Day</th>
                            <th class="text-center align-middle">Public Holidays</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $event->month }}</td>
                                <td class="text-center align-middle">{{ $event->date->format('M d, Y') }}</td>
                                <td class="text-center align-middle">{{ $event->day }}</td>
                                <td class="text-center align-middle">{{ $event->public_holidays }}</td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $event->id }}"
                                        data-month="{{ $event->month }}"
                                        data-date="{{ $event->date->format('Y-m-d') }}"
                                        data-day="{{ $event->day }}"
                                        data-public_holidays="{{ $event->public_holidays }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $event->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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
                <h5 class="modal-title" id="modalTitle">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="month" class="required">Month:</label>
                                <select class="form-control" id="month" name="month" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="date" class="required">Date:</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="day" class="required">Day:</label>
                                <select class="form-control" id="day" name="day" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($days as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="public_holidays" class="required">Public Holidays:</label>
                                <input type="text" class="form-control" id="public_holidays" name="public_holidays" required>
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
                <p>Are you sure you want to delete this Event?</p>
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
                $('#modalTitle').text('Add New Event');
                $('#addUpdateForm').attr('action', '{{ route('events.store') }}');
                $('#addUpdateForm').attr('method', 'POST');
                $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
                $('#saveButton').removeClass('btn-warning').addClass('btn-success');
                $('#saveButton').text('Save');
                $('#addUpdateForm input[name="_method"]').remove();
                $('#month').val('');
                $('#date').val('');
                $('#day').val('');
                $('#public_holidays').val('');
                $('#addUpdateModal').modal('show');
            });
        
            // Handle Update Button
            $(document).on('click', '.update-button', function () {
                var id = $(this).data('id');
                var month = $(this).data('month');
                var date = $(this).data('date');
                var day = $(this).data('day');
                var public_holidays = $(this).data('public_holidays');

                $('#modalTitle').text('Update Event');
                $('#addUpdateForm').attr('action', '/admin/events/' + id);
                $('#addUpdateForm').find('input[name="_method"]').remove();
                $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
                $('#saveButton').text('Update');
                $('#month').val(month);
                $('#date').val(date);
                $('#day').val(day);
                $('#public_holidays').val(public_holidays);
                $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
                $('#saveButton').removeClass('btn-success').addClass('btn-warning');
                $('#addUpdateModal').modal('show');
            });
        
            // Handle Delete Button
            $(document).on('click', '.delete-button', function () {
                var id = $(this).data('id');
                var deleteUrl = '/admin/events/' + id;
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteConfirmationModal').modal('show');
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