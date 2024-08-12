@extends('adminlte::page')

@section('title', 'Disaster Management')

@section('content_header')
    <h1>Disaster Management</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Disaster Management Records</h2>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#disasterModal"><i class="fas fa-plus"></i> Add Record</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>File Name</th>
                                <th>File Link</th>
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

    <!-- Disaster Management Modal -->
    <div class="modal fade" id="disasterModal" tabindex="-1" aria-labelledby="disasterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disasterModalLabel">Add Disaster Management Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="disaster_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="disasterID" name="disasterID">
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
                            <label for="fileLink">File</label>
                            <input type="file" class="form-control @error('fileLink') is-invalid @enderror" id="fileLink" name="fileLink">
                            @error('fileLink')
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('disaster-management.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'description', name: 'description' },
                    { data: 'fileName', name: 'fileName' },
                    { data: 'fileLink', name: 'fileLink', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#disaster_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('disaster-management.store') }}";

                if ($('#disasterID').val()) {
                    url = "{{ route('disaster-management.update', ':id') }}".replace(':id', $('#disasterID').val());
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#disaster_form').trigger('reset');
                        $('#disasterModal').modal('hide');
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
                $.get("{{ route('disaster-management.show', ':id') }}".replace(':id', id), function(data) {
                    $('#disasterID').val(data.id);
                    $('#description').val(data.description);
                    $('#disasterModalLabel').text('Update Disaster Management Record');
                    $('#saveBtn').text('Update');
                    $('#disasterModal').modal('show');
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
                            url: "{{ route('disaster-management.destroy', ':id') }}".replace(':id', id),
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

            $('#disasterModal').on('hidden.bs.modal', function () {
                $('#disaster_form').trigger('reset');
                $('#disasterID').val('');
                $('#disasterModalLabel').text('Add Disaster Management Record');
                $('#saveBtn').text('Save');
            });
        });
    </script>
@stop
