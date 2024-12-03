@extends('components.layouts.adminLTE')

@section('title')
    Gallery
@endsection

@section('page_title')
    Gallery
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Gallery</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Gallery List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Thumbnail</th>
                            <th class="text-center align-middle">Category</th>
                            <th class="text-center align-middle">Event Name</th>
                            <th class="text-center align-middle"> Event Description</th>
                            <th class="text-center align-middle nosort">Visibility</th>
                            <th class="text-center align-middle nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ url('admin/about-us/gallery/' . $gallery->id) }}">
                                        <img src="{{ asset($gallery->thumbnail) }}" class="rounded-circle" alt="{{ $gallery->event_name }} Thumbnail" style="max-height: 50px;">
                                    </a>
                                </td>
                                <td class="text-center align-middle">{{ $gallery->gallery_category }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ url('admin/about-us/gallery/' . $gallery->id) }}" class="text-decoration-none">
                                        {{ $gallery->event_name }}
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ url('admin/about-us/gallery/' . $gallery->id) }}" class="text-decoration-none">
                                        {{ $gallery->event_description }}
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    @if ($gallery->is_visible)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $gallery->id }}"
                                        data-gallery_category="{{ $gallery->gallery_category }}"
                                        data-event_name="{{ $gallery->event_name }}"
                                        data-event_description="{{ $gallery->event_description }}"
                                        data-thumbnail="{{ $gallery->thumbnail }}"
                                        data-is_visible="{{ $gallery->is_visible }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $gallery->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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

<!-- Add/Update Modal -->
<div class="modal fade" id="addUpdateModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Add New Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="galleryCategory" class="required">Gallery Category:</label>
                                <select id="galleryCategory" name="gallery_category" class="form-select" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($galleryCategories as $galleryCategory)
                                    <option value="{{ $galleryCategory }}">{{ $galleryCategory }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="eventName" class="required">Event Name:</label>
                                <input type="text" class="form-control" id="eventName" name="event_name" required></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="eventDescription" class="required">Event Description:</label>
                                <textarea class="form-control" id="eventDescription" name="event_description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="thumbnail">Upload Thubmnail:</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Visibility Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="is_visible" value="0">
                                <label for="isVisible">Is Visible:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isVisible" name="is_visible" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="saveButton">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Gallery?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
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
        var table = new DataTable('#table', {
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                    searchable: false,
                }
            ],
            scrollX: true,
        });
        // Handle Add Button
        $('#addButton').on('click', function () {
            $('#modalTitle').text('Add New Gallery');
            $('#addUpdateForm').attr('action', '{{ route('gallery.store') }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#thumbnail').attr('required', true);
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');

            // Add asterisk to indicate required field
            $('label[for="thumbnail"]').html('Upload Thumbnail: <span style="color: red;">*</span>');

            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#galleryCategory option:selected').prop('selected', false);
            $('#galleryCategory option:first').prop('selected', true);
            $('#eventName').val('');
            $('#eventDescription').val('');
            $('#thumbnail').val('');
            $('#isVisible').bootstrapToggle('off');
            $('#addUpdateModal').modal('show');
        });
    
        // Handle Update Button
        $('.update-button').on('click', function () {
            var id = $(this).data('id');
            var gallery_category = $(this).data('gallery_category');
            var event_name = $(this).data('event_name');
            var event_description = $(this).data('event_description');
            var is_visible = $(this).data('is_visible') ? true : false;

            $('#modalTitle').text('Update Gallery');
            $('#addUpdateForm').attr('action', '/admin/about-us/gallery/' + id);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#galleryCategory').val(gallery_category).attr('disabled', true);
            $('#eventName').val(event_name).attr('disabled', true);
            $('#eventDescription').val(event_description);
            $('#thumbnail').val('');
            $('#thumbnail').removeAttr('required');
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning');

            // Remove asterisk as field is not required
            $('label[for="thumbnail"]').html('Upload Thumbnail:');

            // Set toggle states for each checkbox
            $('#isVisible').prop('checked', is_visible).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var deleteUrl = '/admin/about-us/gallery/' + id;
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationModal').modal('show');
        });
    
        // Reset toggle state when the modal is closed
        $('#addUpdateModal').on('hidden.bs.modal', function () {
            $('#addUpdateForm')[0].reset();
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

        // Check if there are validation errors and display them in SweetAlert
        @if ($errors->any())
            let errorMessages = `<ul style="text-align: left;">`;
            @foreach ($errors->all() as $error)
                errorMessages += `<li>{{ $error }}</li>`;
            @endforeach
            errorMessages += `</ul>`;

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: errorMessages,
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush