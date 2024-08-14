@extends('adminlte::page')

@section('title', 'Daily Generation Management')

@section('content_header')
    <h1>Daily Generation Management</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Daily Generation Records</h2>
                    @if ($recordCount == 0)
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#dailyGenerationModal"><i class="fas fa-plus"></i> Add Record</button>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped datatable" id="datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Download Link</th>
                                <th>Last Update</th>
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

    <!-- Daily Generation Modal -->
    <div class="modal fade" id="dailyGenerationModal" tabindex="-1" aria-labelledby="dailyGenerationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dailyGenerationModalLabel">Add Daily Generation Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dailyGeneration_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="dailyGenerationID" name="dailyGenerationID">
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
                ajax: "{{ route('daily-generation.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'description', name: 'description' },
                    { data: 'downloadLink', name: 'downloadLink', orderable: false, searchable: false },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#dailyGeneration_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('daily-generation.store') }}";

                if ($('#dailyGenerationID').val()) {
                    url = "{{ route('daily-generation.update', ':id') }}".replace(':id', $('#dailyGenerationID').val());
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#dailyGeneration_form').trigger('reset');
                        $('#dailyGenerationModal').modal('hide');
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
                $.get("{{ route('daily-generation.show', ':id') }}".replace(':id', id), function(data) {
                    $('#dailyGenerationID').val(data.id);
                    $('#description').val(data.description);
                    $('#dailyGenerationModalLabel').text('Update Daily Generation Record');
                    $('#saveBtn').text('Update');
                    $('#dailyGenerationModal').modal('show');
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
                            url: "{{ route('daily-generation.destroy', ':id') }}".replace(':id', id),
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

            $('#dailyGenerationModal').on('hidden.bs.modal', function () {
                $('#dailyGeneration_form').trigger('reset');
                $('#dailyGenerationID').val('');
                $('#dailyGenerationModalLabel').text('Add Daily Generation Record');
                $('#saveBtn').text('Save');
            });
        });
    </script>
@stop
