@extends('components.layouts.adminLTE')

@section('title')
    {{ $gallery->event_name }} Gallery
@endsection

@section('page_title')
    {{ $gallery->event_name }} Gallery
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Gallery</li>
    <li class="breadcrumb-item active">{{ $gallery->event_name }} Gallery</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">{{ $gallery->event_name }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($galleryFiles as $galleryFile)
                        <div class="col-md-3 mb-3">
                            <div class="card image-card">
                                <img src="{{ url($galleryFile->downloadLink) }}" class="card-img-top" alt="{{ $galleryFile->name }}">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $galleryFile->name }}</h5>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    @if ($galleryFile->is_visible)
                                        <span class="badge text-bg-success d-inline-flex align-items-center">Visible</span>&nbsp;
                                    @else
                                        <span class="badge text-bg-secondary d-inline-flex align-items-center">Hidden</span>&nbsp;
                                    @endif
                                    <button class="btn btn-sm btn-warning update-button"
                                            data-id="{{ $galleryFile->id }}"
                                            data-name="{{ $galleryFile->name }}"
                                            data-visibility="{{ $galleryFile->is_visible }}">
                                        <i title="Update" class="fas fa-edit"></i> Edit
                                    </button>&nbsp;
                                    <button class="btn btn-sm btn-danger delete-button" data-id="{{ $galleryFile->id }}">
                                        <i title="Delete" class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No media found in this gallery.</p>
                    @endforelse
                </div>                
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
                <h5 class="modal-title" id="modalTitle">Add New Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="required">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required></input>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="downloadLink">Upload File:</label>
                                <input type="file" class="form-control" id="downloadLink" name="downloadLink">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Visibility Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="visibility" value="0">
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
                <p>Are you sure you want to delete this Media?</p>
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

    .toggle.ios .toggle-on,
    .toggle.ios .toggle-off {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        line-height: normal;
    }
</style>
<style>
    .required:after {
        content: " *";
        color: red;
    }
</style>
<style>
    .image-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .image-card img {
        width: 100%;
        height: 200px; /* Set a fixed height for consistency */
        object-fit: cover; /* Crop the image while maintaining aspect ratio */
        object-position: center; /* Center the image within the container */
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
            $('#modalTitle').text('Add New Media');
            $('#addUpdateForm').attr('action', '{{ route('gallery.gallery-files.store', ['gallery' => $gallery->id]) }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#downloadLink').attr('required', true);
            $('#addUpdateModal .modal-header').removeClass('bg-warning').addClass('bg-success');
            $('#saveButton').removeClass('btn-warning').addClass('btn-success');

            // Add asterisk to indicate required field
            $('label[for="downloadLink"]').html('Upload File: <span style="color: red;">*</span>');

            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#name').val('');
            $('#downloadLink').val('');
            $('#isVisible').bootstrapToggle('off');
            $('#featureOnNewsAndEvents').bootstrapToggle('off');
            $('#isNewBadgeVisible').bootstrapToggle('off');
            $('#addUpdateModal').modal('show');
        });
    
        // Handle Update Button
        $('.update-button').on('click', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var galleryId = '{{ $gallery->id }}';
            var is_visible = $(this).data('visibility') ? true : false;

            $('#modalTitle').text('Update Media');
            $('#addUpdateForm').attr('action', `/admin/gallery/${galleryId}/gallery-files/${id}`);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#name').val(name);
            $('#downloadLink').val('');
            $('#downloadLink').removeAttr('required');
            $('#addUpdateModal .modal-header').removeClass('bg-success').addClass('bg-warning');
            $('#saveButton').removeClass('btn-success').addClass('btn-warning');

            // Remove asterisk as field is not required
            $('label[for="downloadLink"]').html('Upload File:');

            // Set toggle states for each checkbox
            $('#isVisible').prop('checked', is_visible).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var galleryId = '{{ $gallery->id }}'; // Assuming you have the gallery ID available
            var deleteUrl = `/admin/gallery/${galleryId}/gallery-files/${id}`;
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