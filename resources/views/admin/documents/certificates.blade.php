@extends('adminlte::page')

@section('title', 'Certificate Management')

@section('content_header')
    <h1>Certificate Management</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center mb-2">
                        <h4 class="card-title">Certificate Table</h4>
                        <button onclick="scrollFunction()" class="btn btn-success  ml-auto">Add
                            Data</button> <!-- scrollFuction -used for -->
                    </div>
                    <table class="table table-striped datatable" id="certificate" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="row" class="text-center"> S. No. </th>
                                <th> Description </th>
                                <th> Download </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="addDetails" class="col-lg-12 grid-margin strech-card">
            <div class="card">
                <div class="card-body">
                    <form name="add_certificate" id="add_certificate" method="post"
                        class="needs-validation" novalidate>
                        <!-- validation code -->
                        @csrf
                        <!-- input description -->
                        <div class="row mb-4">
                            <label for="description"
                                class="col-sm-2 col-form-label">Description:</label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="form-control {{ $errors->has('description') ? 'error' : '' }}"
                                    id="description" name="description" autocomplete="off"
                                    aria-describedby="inputGroupPrepend" required>
                                @if ($errors->has('description'))
                                    <div class="error">
                                        <span
                                            class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- input download link -->
                        <div class="row mb-4">
                            <label for="downloadLink" class="col-sm-2 col-form-label">Upload:</label>
                            <div class="col-sm-10">
                                <input type="file"
                                    class="form-control {{ $errors->has('downloadLink') ? 'error' : '' }}"
                                    id="downloadLink" name="downloadLink"
                                    aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                @if ($errors->has('downloadLink'))
                                    <div class="error">
                                        <span
                                            class="text-danger">{{ $errors->first('downloadLink') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <input type="submit" class="btn btn-success" name="send" value="ADD" />
                        <!-- submit button -->

                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Certificate Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 grid-margin strech-card">
                        <div class="card">
                            <div class="card-body">
                                <form name="edit_certificate" id="edit_certificate" method="post"
                                    class="needs-validation" novalidate>
                                    <!-- validation code -->
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="certificateID" id="certificateID">
                                    <input type="hidden" id="fileLink" name="fileLink">
                                    
                                    <!-- input description -->
                                    <div class="row mb-4">
                                        <label for="description"
                                            class="col-sm-2 col-form-label">Description:</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control {{ $errors->has('editDescription') ? 'error' : '' }}"
                                                id="editDescription" name="editDescription" autocomplete="off"
                                                aria-describedby="inputGroupPrepend" required>
                                            @if ($errors->has('editDescription'))
                                                <div class="error">
                                                    <span
                                                        class="text-danger">{{ $errors->first('editDescription') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>



                                    <!-- input download link -->
                                    <div class="row mb-4">
                                        <label for="downloadLink" class="col-sm-2 col-form-label">Upload:</label>
                                        <div class="col-sm-10">
                                            <input type="file"
                                                class="form-control {{ $errors->has('editDownloadLink') ? 'error' : '' }}"
                                                id="editDownloadLink" name="editDownloadLink"
                                                aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                            @if ($errors->has('editDownloadLink'))
                                                <div class="error">
                                                    <span
                                                        class="text-danger">{{ $errors->first('editDownloadLink') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">CLOSE</button>
                                        <button type="submit" class="btn updateBtn btn-success">UPDATE
                                            DATA</button>
                                    </div>
                                    <!-- submit button -->

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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Certificate Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="delete_certificate" id="delete_certificate">
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
    {{-- <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" /> --}}
@stop

@section('js')
    <!-- custom script for edit Modal -->
    <!-- dataTable Scripts -->
    {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script> --}}
    <script>
        function datatableReload() {
            var table = $('.datatable').DataTable();
            table.ajax.reload();
        }

        function scrollFunction() {
            const element = document.getElementById("addDetails");
            element.scrollIntoView({
                behavior: "smooth"
            });
        }
    </script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {
            // Datatable
            $('#certificate').DataTable({
                "paging": true,
                "lengthchange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                info: true,

                ajax: "{{ route('certificate.index') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'downloadLink',
                        name: 'downloadLink',
                        render: function(data) {
                            return '<div style="word-wrap: break-word;">' +
                                '<i class="mdi mdi-file-pdf menu-icon" style="color:red;"></i><a href="' +
                                data + '" target="_blank"> Download/View </a></div>'
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Add Details
            $('#add_certificate').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: "/certificate",
                    data: formData,
                    success: function(response) {
                        if(response.code == 0){
                            printErrorMsg(response.error);
                        }else if(response.code == 1){
                            $('#add_certificate').trigger('reset');
                            Swal.fire({
                                icon: 'success',
                                title:'Your Data has been Saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                        }else{
                            Swal.fire({
                                icon: 'info',
                                title:'Something went wrong',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                        }


                    },

                    // success: function(response) {
                    //     $('#add_certificate').trigger('reset');
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'Your Data has been Saved',
                    //         showConfirmButton: false,
                    //         timer: 1500
                    //     })
                    //     datatableReload();
                    // },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
            // open to edit data

            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id'); //to take data
                $('#editModal').modal('show');

                // edit function work
                $.ajax({
                    type: "get",
                    url: "/certificate/"+id+"/edit",
                    success: function(response) {
                        $('#certificateID').val(id)
                        $('#editDescription').val(response.certificate.description);
                        $('#fileLink').val(response.certificate.downloadLink);
                    }
                });

                // update data

                $('#edit_certificate').submit(function(e) {

                    e.stopImmediatePropagation();
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        type: "post",
                        url: "/certificate/"+id,
                        data: formData,
                        success: function(response) {
                            $('#edit_certificate').trigger('reset');
                            $('#editModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Your Data has been Saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });

            });

            // click to open delete modal

            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id'); //to take data
                $('#deleteModal').modal('show');
                $('#delete_id').val(id);

            });

            // delete model work

            $('#delete_certificate').submit(function(e) {

                var id =$('#delete_id').val();

                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "DELETE",
                    url: "/certificate/"+id,
                    data: formData,
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Your Data has been Deleted',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        datatableReload();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            function printErrorMsg (msg) {
                $.each( msg, function( key, value ) {
                    alert(value);
            });
            }

        });
    </script>
    <!-- custom script for edit Modal -->
@stop