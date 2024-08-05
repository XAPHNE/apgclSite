@extends('adminlte::page')

@section('title', 'Department Management')

@section('content_header')
    <h1>Department Management</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center mb-2">
                        <h4 class="card-title">Department Table</h4>
                        <button id="departmentBtn" name="departmentBtn" type="button"
                            class="btn btn-dark m-2 ml-auto">
                            <span class="">
                            </span>Add Department
                        </button>
                    </div>
                    <table class="table table-striped datatable" id="department" style="width: 100%">
                        <thead>
                            <tr>
                                <th> S. No. </th>
                                <th> Department Name </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="delete_department" id="delete_department">
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
            // Datatable
            $('#department').DataTable({
                "paging": true,
                "lengthchange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                info: true,

                ajax: "{{ route('department.index') }}",

                order: [
                    [1, 'desc']
                ],

                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'department', name: 'department' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button data-id="${row.id}" class="btn btn-danger btn-sm deleteBtn">
                                    <span class="icon-bg"><i class="fas fa-trash-alt"></i></span>
                                </button>`;
                        }
                    },
                ]
            });

            // Add Details
            $(document).on('click', '#departmentBtn', function() {
                Swal.fire({
                    title: 'Enter the Department',
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'ADD',
                    showLoaderOnConfirm: true,
                    inputValidator: function(data) {
                        if (!data) {
                            return 'Please enter a Department';
                        }
                    },
                    preConfirm: function(data) {
                        return new Promise(function(resolve, reject) {
                            if (data) {
                                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                                $.ajax({
                                    url: '/add-department',
                                    type: 'POST',
                                    data: {
                                        department: data,
                                        _token: csrf_token
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            $('#department').DataTable().ajax.reload();
                                            Swal.fire({
                                                title: 'Success!',
                                                text: response.success,
                                                icon: 'success'
                                            });
                                        } else if (response.error) {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: response.error,
                                                icon: 'error'
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'An error occurred while saving data: ' + error,
                                            icon: 'error'
                                        });
                                    }
                                });
                            }
                        });
                    },
                    allowOutsideClick: false
                });
            });

            // Trigger Delete Modal
            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteModal').modal('show');
            });

            // Handle Delete Action
            $('#delete_department').on('submit', function(e) {
                e.preventDefault();
                var delete_id = $('#delete_id').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/delete-department',
                    type: 'POST',
                    data: {
                        delete_id: delete_id,
                        _token: csrf_token
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#department').DataTable().ajax.reload();
                            $('#deleteModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Department has been deleted successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else if (response.error) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.error,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while deleting the department: ' + error,
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
    <!-- custom script for edit Modal -->
@stop