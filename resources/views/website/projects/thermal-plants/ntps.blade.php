@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">@lang('navigationMenu.projects') </a>/</li>
                <li class="breadcrumb-item"><a href="{{ url('/' . app()->getLocale() . '/projects/thermal-plants') }}" class="bread-text">@lang('navigationMenu.thermal_plants') </a>/</li>
                <li class="breadcrumb-item"><a href="#" class="bread-text">NTPS </a></li>
            </ol>
        </nav>
    </div>
</section>

<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab" aria-controls="features" aria-selected="true">Features</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="achiv-tab" data-bs-toggle="tab" data-bs-target="#achiv-tab-pane" type="button" role="tab" aria-controls="achiv-tab-pane" aria-selected="false">Achievements</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="generation-tab" data-bs-toggle="tab" data-bs-target="#generation" type="button" role="tab" aria-controls="generation" aria-selected="false">Generation Status</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab" aria-controls="gallery" aria-selected="false">Gallery</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Features Tab -->
                    <div class="tab-pane fade show active" id="features" role="tabpanel" aria-labelledby="features-tab">
                        <div class="mt-3 mb-3">
                            <h5 class="line-vertical">Features</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td colspan="3">Namrup Thermal Power Station</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Capacity</td>
                                        <td colspan="3">41 MW (1 X 17 MW + 1 X 15 MW + 1 X 9 MW)</td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td colspan="3">Namrup, District - Dibrugarh, ASSAM,PIN - 786622</td>                               
                                    </tr>
                                    <tr>
                                        <td rowspan="3" colspan="2" class="align-middle">Approach</td>
                                        <td>By Air</td>
                                        <td colspan="1">66.2 KM from Mohanbari Air Port , Dibrugarh via NH 215.</td>
                                    </tr>
                                    <tr>
                                        <td>By Rail</td>
                                        <td colspan="1">67.3 KM from Dibrugarh Railway station.</td>
                                    </tr>
                                    <tr>
                                        <td>By Road</td>
                                        <td colspan="1">70 KM from Dibrugarh ASTC Bus Stand.</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="6" class="align-middle">Date of Commissioning</td>
                                        <td colspan="3">Unit-I	--- 	Decommissioned</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Unit-II	--- 	1965</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Unit-III	--- 	1965</td>
                                    </tr> 
                                    <tr>
                                        <td colspan="3">Unit-IV	--- 	Decommissioned</td>
                                    </tr> 
                                    <tr>
                                        <td colspan="3">Unit-V	--- 	Decommissioned</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Unit-VI	--- 	1985</td>
                                    </tr>				
                                    <tr>
                                        <td>Beneficiary States</td>
                                        <td colspan="3">Assam</td>
                                    </tr>    
                                    <tr>
                                        <td rowspan="7" class="align-middle">Technical Features</td>
                                        <td colspan="2">Type of Fuel</td>
                                        <td colspan="2">Natural Gas</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Source of fuel</td>
                                        <td colspan="2">Oil India Ltd, Duliajan, Assam</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Source of Water for consumptive use</td>
                                        <td colspan="2">Dilli River</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Generator Type</td>
                                        <td colspan="2">Hydrogen Cooled/Air Cooled</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Evacuation System</td>
                                        <td colspan="2">33KV,66KV,132KV,220KV</td>
                                    </tr>	
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Achievements Tab -->
                    <div class="tab-pane fade" id="achiv-tab-pane" role="tabpanel" aria-labelledby="achiv-tab" tabindex="0">
                        <div class="mt-3 mb-3">
                            <h5 class="line-vertical ">Achievements</h5>

                            <ul>
                                <li>Prestigious Fifth India Power Award 2012.</li>
                            </ul>

                        </div>
                    </div>

                    <!-- Generation Status Tab -->
                    <div class="tab-pane fade" id="generation" role="tabpanel" aria-labelledby="generation-tab">
                        <div class="mt-3 mb-3">
                            <h5 class="line-vertical">Generation Status</h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <table id="generation-table" class="table table-bordered text-center table-striped">
                                        <thead>
                                            <tr>
                                                <th>Financial Year</th>
                                                <th>Generation Status of NTPS in MU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be populated dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-7">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Tab -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="mt-3 mb-3">
                            <h5 class="line-vertical">Contact</h5>
                            @php
                                $contact = App\Models\Contact::where('designation', 'LIKE', '%Namrup Thermal Power Station%')
                                    ->orWhere('designation', 'LIKE', '%NTPS%')
                                    ->orWhere('designation', 'LIKE', '%Namrup Replacement Power Plant%')
                                    ->orWhere('designation', 'LIKE', '%NRPP%')
                                    ->first();
                                $designation = $contact ? explode(',', $contact->designation)[0] : null;
                            @endphp
                            <table class="table table-bordered">
                                <tbody>
                                    <tr><td>Project Head</td><td>{{ $contact->name ?? 'N/A' }}</td></tr>
                                    <tr><td>Designation</td><td>{{ $designation ?? 'N/A' }}</td></tr>
                                    <tr><td>Email</td><td>{{ $contact->email ?? 'N/A' }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Gallery Tab -->
                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                        <div class="mt-3 mb-3">
                            <h4 class="line-vertical">Gallery</h4>
                            <div class="row">
                                <!-- Gallery images -->
                                @php
                                    // Fetch the visible gallery files for NTPS event
                                    $galleryFiles = \App\Models\Gallery::with(['galleryFiles' => function ($query) {
                                            $query->where('is_visible', true);
                                        }])
                                        ->where('gallery_category', 'Power Stations')
                                        ->where('event_name', 'NTPS')
                                        ->where('is_visible', true)
                                        ->latest()
                                        ->get();
                                @endphp

                                @foreach ($galleryFiles as $gallery)
                                    @foreach ($gallery->galleryFiles as $galleryFile)
                                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                            <a href="{{ asset($galleryFile->downloadLink) }}" class="fancybox" rel="ligthbox">
                                                <img src="{{ asset($galleryFile->downloadLink) }}" class="zoom img-fluid" alt="{{ $galleryFile->file_name ?? 'Gallery Image' }}">
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach
                                <!-- Add additional images as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Styles for the table headers */
    .table th {
        background-color: #d1e7dd !important; 
        text-align: start !important;
    }
    tbody tr {
        text-align: start;
    }
    #generation-table th {
        background-color: #d1e7dd !important; 
        text-align: center !important;
    }
    #generation-table tbody tr {
        text-align: center;
    }
    .green {
        background - color: #6fb936;
    }
    .thumb {
        margin-bottom: 30px;
    }
    img.zoom {
        width: 100%;
        height: 200px;
        border-radius:5px;
        object-fit:cover;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        -o-transition: all .3s ease-in-out;
        -ms-transition: all .3s ease-in-out;
    }
            
    .transition {
        -webkit-transform: scale(1.2); 
        -moz-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }
    
    .modal-header {
    
        border-bottom: none;
    }
    .modal-title {
            color:# 000;
    }
    .modal - footer {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        // Define the generation data as an array of objects
        const generationData = [
            { year: "FY 2019-20", generation: 252.863 },
            { year: "FY 2020-21", generation: 231.079 },
            { year: "FY 2021-22", generation: 157.096 },
            { year: "FY 2022-23", generation: 192.855 },
            { year: "FY 2023-24", generation: 132.359 }
        ];

        // Sort the data by year in descending order for the table
        const tableData = [...generationData].sort((a, b) => {
            // Extract the years as integers for comparison
            const yearA = parseInt(a.year.split(" ")[1]);
            const yearB = parseInt(b.year.split(" ")[1]);
            return yearB - yearA; // Descending order
        });

        // Populate the table dynamically
        const tableBody = document.querySelector("#generation-table tbody");
        tableData.forEach(item => {
            const row = `<tr><td>${item.year}</td><td>${item.generation.toFixed(3)}</td></tr>`;
            tableBody.innerHTML += row;
        });

        // Extract labels and data for the chart (keep chronological order)
        const labels = generationData.map(item => item.year);
        const data = generationData.map(item => item.generation);

        // Create the chart
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Generation Status",
                    data: data,
                    borderColor: "rgba(0,0,255,1.0)",
                    backgroundColor: "rgba(0,0,255,0.3)",
                    tension: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { 
                        // beginAtZero: true, 
                        // min: 100, 
                        // max: 600, 
                        title: { display: true, text: 'Generation in MU' } 
                    },
                    x: { 
                        title: { display: true, text: 'Financial Year' } 
                    }
                },
                plugins: {
                    title: { 
                        display: true, 
                        text: 'Total Generation Status NTPS (Last Five Years)', 
                        font: { size: 25 } 
                    }
                }
            }
        });
    });
</script>
@endpush
