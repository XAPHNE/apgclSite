@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text text-uppercase">@lang('header.screen_reader') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical text-uppercase">@lang('header.screen_reader')</h4>
            <div class="table-responsive">
                <table class="table-bordered table table-striped dataTable" style="width:100%">
                    <thead>
                        <tr class="bg-primary">
                            <th>@lang('table.serial_num')</th>
                            <th>Screen Reader</th>
                            <th>Website</th>
                            <th>Free/Commercial</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Screen Access For All (SAFA) </td>
                            <td>
                                <a href="http://safa-reader.software.informer.com/download/">
                                    http://safa-reader.software.informer.com/download/
                                </a>
                            </td>
                            <td>Free
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Non Visual Desktop Access (NVDA) </td>
                            <td>
                                <a href="http://safa-reader.software.informer.com/download/">
                                    http://safa-reader.software.informer.com/download/
                                </a>
                            </td>
                            <td>Free
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>System Access To Go </td>
                            <td>
                                <a href="http://www.satogo.com/">
                                    http://www.satogo.com/
                                </a>
                            </td>
                            <td>Free
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>Thunder </td>
                            <td>
                                <a href="http://www.screenreader.net/index.php">
                                    http://www.screenreader.net/index.php
                            </td>
                            <td>Free
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>WebAnywhere </td>
                            <td>
                                <a href="http://webanywhere.cs.washington.edu/wa.php">
                                    http://webanywhere.cs.washington.edu/wa.php
                                </a>
                            </td>
                            <td>Free
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>Hal </td>
                            <td>
                                <a href="http://www.yourdolphin.co.uk/productdetail.asp">
                                    http://www.yourdolphin.co.uk/productdetail.asp
                                </a>
                            </td>
                            <td>Commercial
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>JAWS </td>
                            <td>
                                <a href="http://www.freedomscientific.com">
                                    http://www.freedomscientific.com
                                </a>
                            </td>
                            <td>Commercial
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td>Supernova </td>
                            <td>
                                <a href="http://www.yourdolphin.co.uk/productdetail.asp">
                                    http://www.yourdolphin.co.uk/productdetail.asp
                                </a>
                            </td>
                            <td>Commercial
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td>Window-Eyes </td>
                            <td>
                                <a href="http://www.gwmicro.com/Window-Eyes/">
                                    http://www.gwmicro.com/Window-Eyes/
                                </a>
                            </td>
                            <td>Commercial
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

@push('styles')
<style type="text/css">
    .table  th {
        background-color: #d1e7dd !important; 
        text-align: center !important;
    }
    tbody tr {
        text-align: center;
    }
</style>
@endpush

@push('scripts')
    
@endpush