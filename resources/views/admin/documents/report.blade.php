@extends('components.layouts.adminLTE')

@section('title')
    Reports
@endsection

@section('page_title')
    Reports
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Documents</li>
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="row">
    <div class="col col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="d-inline">Reports List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addNewModal" id="addButton"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table display compact table-bordered table-hover" style="width: 100%">
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
                        @foreach ($reports as $report)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $report->name }}</td>
                                <td class="text-center align-middle">{{ $report->description }}</td>
                                <td class="text-center align-middle">
                                    @if ($report->visibility)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($report->news_n_events)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($report->new_badge)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap;">
                                    <a class="btn btn-info" href="{{ url($report->downloadLink) }}" target="_blank"><i title="View/Download" class="fas fa-eye"></i></a>
                                    <button class="btn btn-warning update-button"
                                        data-id="{{ $report->id }}"
                                        data-name="{{ $report->name }}"
                                        data-description="{{ $report->description }}"
                                        data-downloadlink="{{ $report->downloadLink }}"
                                        data-visibility="{{ $report->visibility }}"
                                        data-news_n_events="{{ $report->news_n_events }}"
                                        data-new_badge="{{ $report->new_badge }}"><i title="Update" class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger delete-button"
                                            data-id="{{ $report->id }}"><i title="Delete" class="fas fa-trash-alt"></i>
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
                <h5 class="modal-title" id="modalTitle">Add New Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addUpdateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="required">Name:</label>
                                <textarea type="text" class="form-control" id="name" name="name" required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="description" class="required">Description (Text for News & Events):</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="downloadLink">Upload File:</label>
                                <input type="file" class="form-control-file" id="downloadLink" name="downloadLink">
                            </div>
                        </div>
                        <div class="col">
                            <!-- Visibility Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="visibility" value="0">
                                <label for="isVisible">Is Visible:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isVisible" name="visibility" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- News & Events Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="news_n_events" value="0">
                                <label for="featureOnNewsAndEvents">Feature on News & Events:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="featureOnNewsAndEvents" name="news_n_events" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="col">
                            <!-- New Badge Checkbox with Hidden Input -->
                            <div class="form-group">
                                <input type="hidden" name="new_badge" value="0">
                                <label for="isNewBadgeVisible">Is New:</label>
                                <input type="checkbox" class="form-control visibility-toggle" id="isNewBadgeVisible" name="new_badge" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-style="ios" data-onstyle="success" data-offstyle="danger">
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this report?</p>
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
            $('#modalTitle').text('Add New Report');
            $('#addUpdateForm').attr('action', '{{ route('reports.store') }}');
            $('#addUpdateForm').attr('method', 'POST');
            $('#saveButton').text('Save');
            $('#addUpdateForm input[name="_method"]').remove();
            $('#name').val('');
            $('#description').val('');
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
            var description = $(this).data('description');
            var visibility = $(this).data('visibility') ? true : false;
            var news_n_events = $(this).data('news_n_events') ? true : false;
            var new_badge = $(this).data('new_badge') ? true : false;

            $('#modalTitle').text('Update Report');
            $('#addUpdateForm').attr('action', '/admin/documents/reports/' + id);
            $('#addUpdateForm').find('input[name="_method"]').remove();
            $('#addUpdateForm').append('<input type="hidden" name="_method" value="PATCH">');
            $('#saveButton').text('Update');
            $('#name').val(name);
            $('#description').val(description);
            $('#downloadLink').val('');

            // Set toggle states for each checkbox
            $('#isVisible').prop('checked', visibility).change();
            $('#featureOnNewsAndEvents').prop('checked', news_n_events).change();
            $('#isNewBadgeVisible').prop('checked', new_badge).change();

            $('#addUpdateModal').modal('show');
        });
    
        // Handle Delete Button
        $('.delete-button').on('click', function () {
            var id = $(this).data('id');
            var deleteUrl = '/admin/documents/reports/' + id;
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
    </script>
@endpush