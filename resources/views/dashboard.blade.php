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
                <a href="javascript:void(0);" class="small-box-footer" onclick="showSection('tenders')">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $tendersForReviewCount }}</h3>
                  <p>Tenders for Review</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document-text"></i>
                </div>
                <a href="javascript:void(0);" class="small-box-footer" onclick="showSection('tenders-for-review')">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
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
                                <tr class="table-primary">
                                    <th class="text-center">#</th>
                                    <th class="text-center nosort">Description</th>
                                    <th class="text-center nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestEntriesNewNAE as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-start align-middle">{{ $item->description }}</td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-info" href="{{ asset($item->downloadLink) }}" target="_blank">
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
                                <tr class="table-primary">
                                    <th class="text-center">#</th>
                                    <th class="text-center nosort">Description</th>
                                    <th class="text-center nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestEntriesNAE as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-start align-middle">{{ $item->description }}</td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-info" href="{{ asset($item->downloadLink) }}" target="_blank">
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

        <!-- Tenders -->
        <div id="tenders" class="table-section" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Tenders @if($currentFY)({{ $currentFY->year }})@endif</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" style="width:100%">
                            <thead>
                                <tr class="table-primary">
                                    <th class="text-center">#</th>
                                    <th class="text-center nosort">Tender No.</th>
                                    <th class="text-center nosort">Description</th>
                                    <th class="text-center nosort">Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenders as $tender)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-start align-middle">
                                            <a href="{{ url('admin/tenders/' . $tender->id) }}" class="text-decoration-none">
                                                {{ $tender->tender_no }}
                                            </a>
                                        </td>
                                        <td class="text-start align-middle">{{ $tender->description }}</td>
                                        <td class="text-start align-middle">
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($tender->tenderFiles as $tenderFile)
                                                    <a href="{{ url($tenderFile->downloadLink) }}" target="_blank" class="btn btn-link p-0 text-nowrap text-decoration-none">
                                                        <i class="fas fa-file-download" aria-hidden="true"></i>
                                                        {{ $tenderFile->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenders For Review -->
        <div id="tenders-for-review" class="table-section" style="display: none;">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title">Tenders For Review</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" style="width:100%">
                            <thead>
                                <tr class="table-primary">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Financial Year</th>
                                    <th class="text-center">Tender No.</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tendersForReview as $tender)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $tender->financialYear->year }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ url('admin/tenders/' . $tender->id) }}" class="text-decoration-none">
                                                {{ $tender->tender_no }}
                                            </a>
                                        </td>
                                        <td class="text-start align-middle">{{ $tender->description }}</td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('tenders.approve', $tender->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success text-nowrap">
                                                    <i class="fas fa-check"></i> Approve & Publish
                                                </button>
                                            </form>
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
    <style>
        .dataTable th {
            white-space: nowrap;
            text-align: center;
        }
    </style>
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
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.table-section').forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            const sectionToShow = document.getElementById(sectionId);
            sectionToShow.style.display = 'block';

            // Reinitialize the DataTable
            const table = sectionToShow.querySelector('.dataTable');
            if (!$.fn.DataTable.isDataTable(table)) {
                $(table).DataTable({
                    columnDefs: [
                        {
                            targets: 'nosort',
                            orderable: false,
                        }
                    ],
                    scrollX: true,
                    autoWidth: false,
                });
            }
        }
    </script>
@endpush
