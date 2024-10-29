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
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Standard Forms List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addNewFormModal" id="addFormButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="formsTable" class="table display nowrap table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            {{-- <th class="text-center nosort">View</th> --}}
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
                                <td class="text-center">{{ $form->name }}</td>
                                <td class="text-center">{{ $form->description }}</td>
                                {{-- <td class="text-center"><a href="{{ url($form->downloadLink) }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a></td> --}}
                                <td class="text-center">
                                    @if ($form->visibility)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($form->news_n_events)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($form->new_badge)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="{{ url($form->downloadLink) }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a>
                                    <button class="btn btn-warning edit-button"
                                        data-id="{{ $form->id }}"
                                        data-name="{{ $form->name }}"
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
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
                                <label for="formName" class="required">Name:</label>
                                <textarea type="text" class="form-control" id="formName" name="name" required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="formDescription" class="required">Description (Text for News & Events):</label>
                                <textarea class="form-control" id="formDescription" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="formDownloadLink">Upload File:</label>
                                <input type="file" class="form-control-file" id="formDownloadLink" name="downloadLink">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Visibility Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="visibility" value="0">
                                <label for="formIsVisible">Is Visible:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="formIsVisible" name="visibility" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- News & Events Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="news_n_events" value="0">
                                <label for="formFeatureOnNewsAndEvents">Feature on News & Events:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="formFeatureOnNewsAndEvents" name="news_n_events" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <!-- New Badge Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="new_badge" value="0">
                                <label for="formIsNewBadgeVisible">Is New:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="formIsNewBadgeVisible" name="new_badge" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
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
        var formsTable = new DataTable('#formsTable', {
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                }
            ],
            scrollX: true,
        });
        // Handle Add Button
        $('#addFormButton').on('click', function () {
            $('#modalTitle').text('Add New Form');
            $('#formForm').attr('action', '{{ route('standard-forms.store') }}');
            $('#formForm').attr('method', 'POST');
            $('#saveButton').text('Save');
            $('#formForm input[name="_method"]').remove();
            $('#formName').val('');
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
            var name = $(this).data('name');
            var description = $(this).data('description');
            var visibility = $(this).data('visibility') ? true : false;
            var news_n_events = $(this).data('news_n_events') ? true : false;
            var new_badge = $(this).data('new_badge') ? true : false;

            $('#modalTitle').text('Update Form');
            $('#formForm').attr('action', '/admin/documents/standard-forms/' + formId);
            $('#formForm').find('input[name="_method"]').remove();
            $('#formForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#formName').val(name);
            $('#formDescription').val(description);
            $('#formDownloadLink').val('');

            // Set toggle states for each checkbox
            $('#formIsVisible').prop('checked', visibility).change();
            $('#formFeatureOnNewsAndEvents').prop('checked', news_n_events).change();
            $('#formIsNewBadgeVisible').prop('checked', new_badge).change();

            $('#addNewFormModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var formId = $(this).data('id');
            var deleteUrl = '/admin/documents/standard-forms/' + formId;
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