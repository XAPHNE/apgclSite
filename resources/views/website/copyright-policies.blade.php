@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text text-uppercase">@lang('footer.copyright_policies') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical text-uppercase">@lang('footer.copyright_policies')</h4>
            <div class="col-md-12">
                <div class="mt-4 stt-3">
                    <p id="content">
                        The material/content featured on this website are in the public domain and as such may be reproduced free of charge after taking proper permission subject to the condition that the material be reproduced accurately and not in any derogatory manner or in a misleading context. Whenever the material is being published or issued to others, the source must be prominently acknowledged. However, the permission to reproduce material/content excludes the material that is subject to copyright of a third party. Authorisation to reproduce such material must be obtained beforehand from the copyright holders concerned.
                    </p>
                </div>
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