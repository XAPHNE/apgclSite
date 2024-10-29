@extends('components.layouts.adminLTE')

@section('title')
    Publications
@endsection

@section('page_title')
    Publications
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Documents</li>
    <li class="breadcrumb-item active">Publications</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Publications List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addNewPublicationModal" id="addPublicationButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="publicationsTable" class="table display compact table-bordered table-hover" style="width: 100%">
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
                        @foreach ($publications as $publication)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $publication->name }}</td>
                                <td class="text-center align-middle">{{ $publication->description }}</td>
                                {{-- <td class="text-center"><a href="{{ url($publication->downloadLink) }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a></td> --}}
                                <td class="text-center align-middle">
                                    @if ($publication->visibility)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($publication->news_n_events)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($publication->new_badge)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <a class="btn btn-info" href="{{ url($publication->downloadLink) }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a>
                                    <button class="btn btn-warning edit-button"
                                        data-id="{{ $publication->id }}"
                                        data-name="{{ $publication->name }}"
                                        data-description="{{ $publication->description }}"
                                        data-downloadlink="{{ $publication->downloadLink }}"
                                        data-visibility="{{ $publication->visibility }}"
                                        data-news_n_events="{{ $publication->news_n_events }}"
                                        data-new_badge="{{ $publication->new_badge }}"><i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $publication->id }}"><i class="fas fa-trash-alt"></i>
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

<!-- Add/Edit Publication Modal -->
<div class="modal fade" id="addNewPublicationModal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalTitle">Add New Publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="publicationForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="publicationName" class="required">Name:</label>
                                <textarea type="text" class="form-control" id="publicationName" name="name" required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="publicationDescription" class="required">Description (Text for News & Events):</label>
                                <textarea class="form-control" id="publicationDescription" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="publicationDownloadLink">Upload File:</label>
                                <input type="file" class="form-control-file" id="publicationDownloadLink" name="downloadLink">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Visibility Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="visibility" value="0">
                                <label for="publicationIsVisible">Is Visible:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="publicationIsVisible" name="visibility" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- News & Events Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="news_n_events" value="0">
                                <label for="publicationFeatureOnNewsAndEvents">Feature on News & Events:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="publicationFeatureOnNewsAndEvents" name="news_n_events" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <!-- New Badge Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="new_badge" value="0">
                                <label for="publicationIsNewBadgeVisible">Is New:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="publicationIsNewBadgeVisible" name="new_badge" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
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

<!-- Delete Confirmation Publication Modal -->
<div class="modal fade" id="deleteConfirmationPublicationModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this publication?</p>
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
        var publicationsTable = new DataTable('#publicationsTable', {
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                }
            ],
            scrollX: true,
        });
        // Handle Add Button
        $('#addPublicationButton').on('click', function () {
            $('#modalTitle').text('Add New Publication');
            $('#publicationForm').attr('action', '{{ route('publications.store') }}');
            $('#publicationForm').attr('method', 'POST');
            $('#saveButton').text('Save');
            $('#publicationForm input[name="_method"]').remove();
            $('#publicationName').val('');
            $('#publicationDescription').val('');
            $('#publicationDownloadLink').val('');
            $('#publicationIsVisible').bootstrapToggle('off');
            $('#publicationFeatureOnNewsAndEvents').bootstrapToggle('off');
            $('#publicationIsNewBadgeVisible').bootstrapToggle('off');
            $('#addNewPublicationModal').modal('show');
        });
    
        // Handle Edit Button
        $('.edit-button').on('click', function () {
            var publicationId = $(this).data('id');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var visibility = $(this).data('visibility') ? true : false;
            var news_n_events = $(this).data('news_n_events') ? true : false;
            var new_badge = $(this).data('new_badge') ? true : false;

            $('#modalTitle').text('Update Publication');
            $('#publicationForm').attr('action', '/admin/documents/publications/' + publicationId);
            $('#publicationForm').find('input[name="_method"]').remove();
            $('#publicationForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#publicationName').val(name);
            $('#publicationDescription').val(description);
            $('#publicationDownloadLink').val('');

            // Set toggle states for each checkbox
            $('#publicationIsVisible').prop('checked', visibility).change();
            $('#publicationFeatureOnNewsAndEvents').prop('checked', news_n_events).change();
            $('#publicationIsNewBadgeVisible').prop('checked', new_badge).change();

            $('#addNewPublicationModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var publicationId = $(this).data('id');
            var deleteUrl = '/admin/documents/publications/' + publicationId;
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationFormModal').modal('show');
        });
    
        // Reset toggle state when the modal is closed
        $('#addNewFormModal').on('hidden.bs.modal', function () {
            $('#publicationForm')[0].reset();
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