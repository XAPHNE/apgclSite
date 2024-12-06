@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item text-uppercase"><a href="#" class="bread-text">@lang('footer.privacy_policies') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical text-uppercase">@lang('footer.privacy_policies')</h4>
            <div class="col-md-12">
                <div class="mt-4 stt-3">
                    <p id="content">
                        As a general rule, this website does not automatically collect any personal information about the visitors to the site. Users can generally visit this Site without revealing personal information, unless they choose to provide such information. Any Personal information collected shall be used only for the stated purpose and shall NOT be shared with any other department/organization (public/private).
                    </p>
                    <p id="content">
                        This site may contain links to other sites whose data protection and privacy practices may differ from that of APGCL. APGCL is not responsible for the content and privacy practices of these external websites and encourages its users to consult the privacy policies of those sites.
                    </p>
                    <p id="content">
                        This Website never collects information or creates individual profiles for commercial marketing.
                    </p>
                    <p id="content">
                        APGCL will not share personal data of visitors with advertisers, sponsors, and other third parties without the user’s express consent. However, APGCL may release specific personal information about its website visitors, if required to do so in order to comply with any valid legal process such as a search warrant, court order etc.
                    </p>
                    <p>
                        By using www.apgcl.org, visitors consent to the collection and use of the information as we have outlined in this policy.
                    </p>
                    <p>
                        APGCL may decide to change this Privacy Policy from time to time. Any such changes will be posted on this page so that visitors are always aware of the information that is collected, how it is used and under what circumstances the information may be disclosed. Unauthorised attempts to upload or change information on this service are strictly prohibited and may be punishable under the Information Technology Act 2000.
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