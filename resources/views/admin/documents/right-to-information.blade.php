@extends('adminlte::page')

@section('title', 'RTI')

@section('content_header')
    <h1>Right to Information</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center mb-2">
                        <h4 class="card-title">Right to Information Table</h4>
                        <button onclick="scrollFunction()" class="btn btn-success  ml-auto">Add
                            Data</button> <!-- scrollFuction -used for -->
                    </div>
                    <table class="table table-striped datatable" id="rti" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="row" class="text-center">S. No.</th>
                                <th>Description</th>
                                <th>Download</th>
                                <th>Action</th>
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
                    <form name="add_rti" id="add_rti" method="post" class="needs-validation"
                        novalidate>
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
                            <label for="uploadFile" class="col-sm-2 col-form-label">Upload:</label>
                            <div class="col-sm-10">
                                <input type="file"
                                    class="form-control {{ $errors->has('uploadFile') ? 'error' : '' }}"
                                    id="uploadFile" name="uploadFile"
                                    aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                @if ($errors->has('uploadFile'))
                                    <div class="error">
                                        <span
                                            class="text-danger">{{ $errors->first('uploadFile') }}</span>
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
                    <h5 class="modal-title" id="editModalLabel">Edit RTI Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 grid-margin strech-card">
                        <div class="card">
                            <div class="card-body">
                                <form name="edit_rti" id="edit_rti" method="post" class="needs-validation"
                                    novalidate>
                                    <!-- validation code -->
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="rtiID" id="rtiID">
                                    <input type="hidden" id="fileLink" name="fileLink">
                                    
                                    <!-- input description -->
                                    <div class="row mb-4">
                                        <label for="editDescription"
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
                                        <label for="edituploadFile" class="col-sm-2 col-form-label">Upload:</label>
                                        <div class="col-sm-10">
                                            <input type="file"
                                                class="form-control {{ $errors->has('edituploadFile') ? 'error' : '' }}"
                                                id="edituploadFile" name="edituploadFile"
                                                aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                            @if ($errors->has('edituploadFile'))
                                                <div class="error">
                                                    <span
                                                        class="text-danger">{{ $errors->first('edituploadFile') }}</span>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete RTI Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="delete_rti" id="delete_rti">
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

@section('js')
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
            $('#rti').DataTable({
                "paging": true,
                "lengthchange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                info: true,

                ajax: "{{ route('right-to-information.index') }}",

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
                                '<i class="fas fa-download"></i><a href="' +
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
            $('#add_rti').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: "/right-to-information",
                    data: formData,
                    success: function(response) {
                        if(response.code == 0){                            
                                Swal.fire({
                                icon: 'info',
                                title: response.error,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                            printErrorMsg(response.error);
                        }else if(response.code == 1){
                            $('#add_rti').trigger('reset');
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
                    url: "/right-to-information/"+id+"/edit",
                    success: function(response) {
                        $('#rtiID').val(id)
                        $('#editDescription').val(response.rti.description);
                        $('#fileLink').val(response.rti.downloadLink);

                    }
                });

                // update data

                $('#edit_rti').submit(function(e) {
                    
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    var formData = new FormData(this);

                    $.ajax({
                        type: "post",
                        url: "/right-to-information/"+id,
                        data: formData,
                        success: function(response) {
                        if(response.code == 0){                            
                                Swal.fire({
                                icon: 'info',
                                title: response.error,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                            printErrorMsg(response.error);
                        }else if(response.code == 1){
                                $('#editModal').modal('hide');
                                $('#edit_rti').trigger('reset');
                                Swal.fire({
                                icon: 'success',
                                title:'Your Data has been Saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                        }else{
                                $('#editModal').modal('hide');
                                Swal.fire({
                                icon: 'info',
                                title:'Something went wrong',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            datatableReload();
                        }
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

            $('#delete_rti').submit(function(e) {

                var id =$('#delete_id').val();

                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "DELETE",
                    url: "/right-to-information/"+id,
                    data: formData,
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        datatableReload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Your Data has been Deleted',
                            showConfirmButton: false,
                            timer: 1500
                        })
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
@stop