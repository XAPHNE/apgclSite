@extends('components.layouts.adminLTE')

@section('title')
    Standard Forms
@endsection

@section('page_title')
    Standard Forms
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Documents</li>
    <li class="breadcrumb-item active">Standard Forms</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="d-inline">Standard Forms</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addNewFormModal" id="addFormButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="formsTable" class="table display nowrap table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">#</th>
                            <th class="text-center">Description</th>
                            <th class="text-center nosort">Download Link</th>
                            <th class="text-center nosort">Visibility</th>
                            <th class="text-center nosort">News & Events</th>
                            <th class="text-center nosort">New Badge</th>
                            <th class="text-center nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($standardForms as $form)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $form->description }}</td>
                                <td class="text-center"><a href="{{ $form->downloadLink }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a></td>
                                <td class="text-center">{{ $form->visibility }}</td>
                                <td class="text-center">{{ $form->news_n_events }}</td>
                                <td class="text-center">{{ $form->new_badge }}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning edit-button"
                                        data-id="{{ $form->id }}"
                                        data-description="{{ $form->description }}"
                                        data-downloadlink="{{ $form->downloadLink }}"
                                        data-visibility="{{ $form->visibility }}"
                                        data-news_n_events="{{ $form->news_n_events }}"
                                        data-new_badge="{{ $form->new_badge }}"><i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $form->id }}"><i class="fas fa-trash-alt"></i>
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

<!-- Add/Edit Form Modal -->
<div class="modal fade" id="addNewFormModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formDescription">Description:</label>
                            <textarea type="text" class="form-control" id="formDescription" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formDownloadLink">Upload File:</label>
                            <input type="file" class="form-control" id="formDownloadLink" name="downloadLink">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formIsVisible">Is Visible:</label>
                            <input type="checkbox" class="form-control visibility-toggle" id="formIsVisible" name="visibility" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formFeatureOnNewsAndEvents">Feature on News & Events:</label>
                            <input type="checkbox" class="form-control visibility-toggle" id="formFeatureOnNewsAndEvents" name="news_n_events" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formIsNewBadgeVisible">Is New:</label>
                            <input type="checkbox" class="form-control visibility-toggle" id="formIsNewBadgeVisible" name="new_badge" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="saveButton">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Form Modal -->
<div class="modal fade" id="deleteConfirmationFormModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this form?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
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
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        var formsTable = new DataTable('#formsTable', {
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                }
            ],
        });
        // Handle Add Button
        $('#addFormButton').on('click', function () {
            $('#modalTitle').text('Add New Form');
            $('#formForm').attr('action', '{{ route('documents.standard-forms.store') }}');
            $('#formForm').attr('method', 'POST');
            $('#saveButton').text('Save');
            $('#formForm input[name="_method"]').remove();
            $('#formDescription').val('');
            $('#formDownloadLink').val('');
            $('#formIsVisible').bootstrapToggle('off');
            $('#formFeatureOnNewsAndEvents').bootstrapToggle('off');
            $('#formIsNewBadgeVisible').bootstrapToggle('off');
            $('#addNewFormModal').modal('show');
        });
    
        // Handle Edit Button
        $('.edit-button').on('click', function () {
            var formId = $(this).data('id');
            var description = $(this).data('description');
            var visibility = $(this).data('visibility');
            var news_n_events = $(this).data('news_n_events');
            var new_badge = $(this).data('new_badge');
    
            $('#modalTitle').text('Update Form');
            $('#formForm').attr('action', '/forms/' + formId);
            $('#formForm').find('input[name="_method"]').remove();
            $('#formForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#formDescription').val(description);
            $('#formDownloadLink').val('');
            $('#formIsVisible').bootstrapToggle(visibility === 'Yes' ? 'on' : 'off');
            $('#formFeatureOnNewsAndEvents').bootstrapToggle(news_n_events === 'Yes' ? 'on' : 'off');
            $('#formIsNewBadgeVisible').bootstrapToggle(new_badge === 'Yes' ? 'on' : 'off');
            $('#addNewFormModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var formId = $(this).data('id');
            var deleteUrl = '/forms/' + formId;
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationFormModal').modal('show');
        });
    
        // Reset toggle state when the modal is closed
        $('#addNewFormModal').on('hidden.bs.modal', function () {
            $('#formForm')[0].reset();
            $('.visibility-toggle').each(function() {
                $(this).bootstrapToggle('off');
            });
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
    </script>
@endpush