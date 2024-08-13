@extends('adminlte::page')

@section('title', 'Corporate Social Responsibility (CSR)')

@section('content_header')
    <h1>Corporate Social Responsibility (CSR)</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">CSR Records</h2>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#csrModal"><i class="fas fa-plus"></i> Add Record</button>
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

    <!-- CSR Modal -->
    <div class="modal fade" id="csrModal" tabindex="-1" aria-labelledby="csrModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="csrModalLabel">Add CSR Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="csr_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="csrID" name="csrID">
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
                ajax: "{{ route('corporate-social-responsibility.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'description', name: 'description' },
                    { data: 'downloadLink', name: 'downloadLink', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#csr_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('corporate-social-responsibility.store') }}";

                if ($('#csrID').val()) {
                    url = "{{ route('corporate-social-responsibility.update', ':id') }}".replace(':id', $('#csrID').val());
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#csr_form').trigger('reset');
                        $('#csrModal').modal('hide');
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
                $.get("{{ route('corporate-social-responsibility.show', ':id') }}".replace(':id', id), function(data) {
                    $('#csrID').val(data.id);
                    $('#description').val(data.description);
                    $('#csrModalLabel').text('Update CSR Record');
                    $('#saveBtn').text('Update');
                    $('#csrModal').modal('show');
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
                            url: "{{ route('corporate-social-responsibility.destroy', ':id') }}".replace(':id', id),
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

            $('#csrModal').on('hidden.bs.modal', function () {
                $('#csr_form').trigger('reset');
                $('#csrID').val('');
                $('#csrModalLabel').text('Add CSR Record');
                $('#saveBtn').text('Save');
            });
        });
    </script>
@stop
