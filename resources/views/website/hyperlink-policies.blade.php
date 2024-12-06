@extends('layouts.guest')

@section('content')
<section class="pt-3 pb-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-text">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="bread-text"><i class="fas fa-home" style="color:#3ca369;" aria-hidden="true"></i> @lang('navigationMenu.home') /</a></li>
                <li class="breadcrumb-item"><a href="#" class="bread-text text-uppercase">@lang('footer.hyperlink_policies') </a></li>
            </ol>
        </nav>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <h4 class="line-vertical text-uppercase">@lang('footer.hyperlink_policies')</h4>
            <div class="col-md-12">
                <div class="mt-4 stt-3">
                    <h4>Links to external websites/portals:</h4>
                    <p id="content">
                        At many places in this website, visitors may find links to other websites/portals. These links have been placed for the convenience of the users. Assam Power Generation Corporation Limited (APGCL) is not responsible for the content and reliability of these linked websites/portals as these are maintained by third parties and also APGCL does not necessarily endorse the views expressed in them. Mere presence of the link(s) or its listing on the website should not be assumed as endorsement of any kind. APGCL does not guarantee that these links will work all the time as it has no control over availability of such links. It would be highly appreciated if information about any such dead link(s)/broken link(s) are brought to the notice of APGCL for taking appropriate action.
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mt-4 stt-3">
                    <h4>Links to APGCL-Website by other websites:</h4>
                    <p id="content">
                        Assam Power Generation Corporation Limited (APGCL) has no objection to any direct linking to the information that is hosted on this website and no prior permission is required for the same. However, APGCL must be informed about such linking to facilitate any changes or updates wherever required. Also, APGCL does not permit its pages to be directly loaded into frames on another site. The page/pages belonging to this site must load into a new browser window of the User by default.
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