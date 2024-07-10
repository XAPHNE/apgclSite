@extends('layouts.guest')

@section('content')

    <style type="">
        .table  th {
            background-color: #d1e7dd !important; 
            text-align: center !important;
        }
        tbody tr {
            text-align: center;
        }
    </style>
    <section class="pt-3 pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bread-text">
                    <li class="breadcrumb-item"><a href="#" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> Home /</a></li>
                    <li class="breadcrumb-item"><a href="#" class="bread-text">Certificates </a></li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <h4 class="line-vertical">Certificates</h4>
                <div class="table-responsive">
                    <table id="actstable" class=" table-bordered table table-striped" style="width:100%">
                        <thead>
                            <tr class="bg-primary">
                                <th>SL. No.</th>
                                <th>Description</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>CEA Registration Certificate of NTPS</td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_NTPS.pdf') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>CEA Registration Certificate of NRPP       </td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_NRPP.pdf') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>CEA Registration Certificate of LTPS       </td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_LTPS.pdf') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>CEA Registration Certificate of LRPP       </td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_LRPP.pdf') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>CEA Registration Certificate of KLHEP     </td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_KLHEP.pdf') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>CEA Registration Certificate of MSHEP     </td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_MSHEP.pdf') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>Energy Saving Certificate of PAT Cycle 2 of LTPS       </td>
                                <td>
                                     <a href="{{ asset('website-assets/pdf/certificate/bee_certificate.jpeg') }}">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection