@extends('adminlte::page')

@section('title', 'Calendar Management')

@section('content_header')
    <h1>Calendar Management</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Calendar Records</h2>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#calendarModal"><i class="fas fa-plus"></i> Add Record</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Download Link</th>
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

    <!-- Calendar Modal -->
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Add Calendar Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="calendar_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="calendarID" name="calendarID">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter Description" required>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="downloadLink">File</label>
                            <input type="file" class="form-control @error('downloadLink') is-invalid @enderror" id="downloadLink" name="downloadLink">
                            @error('downloadLink')
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
                ajax: "{{ route('calendar.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'description', name: 'description' },
                    { data: 'downloadLink', name: 'downloadLink', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#calendar_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('calendar.store') }}";

                if ($('#calendarID').val()) {
                    url = "{{ route('calendar.update', ':id') }}".replace(':id', $('#calendarID').val());
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#calendar_form').trigger('reset');
                        $('#calendarModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Record saved successfully',
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

            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                $.get("{{ route('calendar.show', ':id') }}".replace(':id', id), function(data) {
                    $('#calendarID').val(data.id);
                    $('#description').val(data.description);
                    $('#calendarModalLabel').text('Update Calendar Record');
                    $('#saveBtn').text('Update');
                    $('#calendarModal').modal('show');
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
                            url: "{{ route('calendar.destroy', ':id') }}".replace(':id', id),
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Record has been deleted.',
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

            $('#calendarModal').on('hidden.bs.modal', function () {
                $('#calendar_form').trigger('reset');
                $('#calendarID').val('');
                $('#calendarModalLabel').text('Add Calendar Record');
                $('#saveBtn').text('Save');
            });
        });
    </script>
@stop
