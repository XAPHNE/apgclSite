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
                    <li class="breadcrumb-item"><a href="#" class="bread-text">ACTS/POLICIES/SERVICE RULES </a></li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <h4 class="line-vertical">ACTS</h4>
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
                                <td>Companies ACT   </td>
                                <td>
                                     <a href="assets/pdf/actpdf/companys act website.pdf">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>General T&C For Supply & Erection   </td>
                                <td>
                                     <a href="assets/pdf/actpdf/general T_C.pdf">
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
    
             <div class="row mt-5">
                <h4 class="line-vertical">POLICIES</h4>
                <div class="table-responsive">
                    <table id="policytable" class=" table-bordered table table-striped" style="width:100%">
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
                                <td>Small Hydro Policies</td>
                                <td>
                                     <a href="assets/pdf/policies/Assam SHP Policy Aug 16, 2007.pdf">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Grievance Redresal Policies</td>
                                <td>
                                     <a href="assets/pdf/policies/APGCL policy.pdf">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Quality Health & Safety Policies       </td>
                                <td>
                                     <a href="assets/pdf/policies/DM_Policy V1.4- BoD Approved.pdf">
                                          <i class="fas fa-file-download" aria-hidden="true"></i>
                                          Download/View
                                     </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Document Management Policy     </td>
                                <td>
                                     <a href="assets/pdf/policies/general T_C.pdf">
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