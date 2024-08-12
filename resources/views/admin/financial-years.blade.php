@extends('adminlte::page')

@section('title', 'Financial Year Management')

@section('content_header')
    <h1>Financial Year Management</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Financial Year List</h2>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#yearModal"><i class="fas fa-plus"></i> Add Financial Year</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Year</th>
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

    <!-- Financial Year Modal -->
    <div class="modal fade" id="yearModal" tabindex="-1" aria-labelledby="yearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="yearModalLabel">Add Financial Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="year_form" method="POST">
                        @csrf
                        <input type="hidden" id="yearID" name="yearID">
                        <div class="form-group">
                            <label for="year">Financial Year</label>
                            <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" placeholder="Enter Financial Year" required>
                            @error('year')
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('financial-years.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'year', name: 'year' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#year_form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = "{{ route('financial-years.store') }}";

                if ($('#yearID').val()) {
                    url = "{{ route('financial-years.update', ':id') }}".replace(':id', $('#yearID').val());
                    formData += '&_method=PUT';
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#yearModal').modal('hide');
                        $('#year_form').trigger('reset');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        });
                    }
                });
            });

            $(document).on('click', '.edit-button', function() {
                var id = $(this).data('id');
                $.get("{{ route('financial-years.show', ':id') }}".replace(':id', id), function(data) {
                    $('#yearID').val(data.id);
                    $('#year').val(data.year);
                    $('#yearModalLabel').text('Update Financial Year');
                    $('#saveBtn').text('Update');
                    $('#yearModal').modal('show');
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
                            url: "{{ route('financial-years.destroy', ':id') }}".replace(':id', id),
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.success,
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong!',
                                });
                            }
                        });
                    }
                })
            });

            $('#yearModal').on('hidden.bs.modal', function () {
                $('#year_form').trigger('reset');
                $('#yearID').val('');
                $('#yearModalLabel').text('Add Financial Year');
                $('#saveBtn').text('Save');
            });
        });
    </script>
@stop
