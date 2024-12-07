@extends('components.layouts.adminLTE')

@section('title')
    Dashboard
@endsection

@section('page_title')
    Dashboard
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{ $totalNAEisNewCount }}</h3>
                    <p>News & Events <span class="badge badge-info">New</span></p>
                  </div>
                  <div class="icon">
                    <i class="fa-regular fa-bell"></i>
                  </div>
                  <a href="javascript:void(0);" class="small-box-footer" onclick="showSection('news-events-new')">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $totalNAECount }}</h3>
                  <p>News & Events</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <a href="javascript:void(0);" class="small-box-footer" onclick="showSection('news-events')">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $tenderCount }}<sup style="font-size: 20px"></sup></h3>
                  <p>Tenders @if($currentFY)({{ $currentFY->year }})@endif</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document-text"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $registeredUsersCount }}</h3>
                  <p>Registered Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
        </div>
    </section>

    <section>
        <!-- News & Events New -->
        <div id="news-events-new" class="table-section" style="display: none;">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title">News & Events (New)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" style="width:100%">
                            <thead>
                                <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestEntriesNewNAE as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $item->description }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ asset($item->link) }}" target="_blank">
                                                <i title="View/Download" class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- News & Events -->
        <div id="news-events" class="table-section" style="display: none;">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title">News & Events</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" style="width:100%">
                            <thead>
                                <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestEntriesNAE as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $item->description }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ asset($item->link) }}" target="_blank">
                                                <i title="View/Download" class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')

@endpush

@push('scripts')
<script>
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.table-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';
    }
</script>
<script>
    $(document).ready(function () {
        var table = new DataTable('.dataTable', {
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                    searchable: false,
                }
            ],
            scrollX: true,
        });
    });
</script>
@endpush
