@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item text-uppercase"><a href="#" class="bread-text">@lang('footer.disclaimer') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical text-uppercase">@lang('footer.disclaimer')</h4>
            <div class="col-md-12">
                <div class="mt-4 stt-3">
                    <p id="content">
                        This official website of Assam Power Generation Corporation Limited (APGCL) has been developed to provide information to the general public. The information displayed in this website are for reference only and do not purport to be a legal document.
                    </p>
                    <p id="content">
                        In case of any variance between what has been stated in the website and that contained in the relevant Act, Rules, Regulations, Policy Statements etc., the latter shall prevail.
                    </p>
                    <p id="content">
                        This Website never collects information or creates individual profiles for commercial marketing.
                    </p>
                    <p id="content">
                        Certain links on the website lead to resources located on other websites maintained by third parties over whom APGCL has no control or connection. These websites are external to APGCL and when users follow these links they are leaving the APGCL site and are subject to the privacy and security policies of the external website.
                    </p>
                    <p>
                        APGCL neither endorses in any way nor offers any judgment or warranty and accepts no responsibility or liability for the authenticity, availability of any of the goods or services or for any damage, loss or harm, direct or consequential or any violation of local or international laws that may be incurred by visiting and transacting on these websites.
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