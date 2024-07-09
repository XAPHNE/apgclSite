@extends('layouts.guest')

@section('content')
    <!-- banner section start  -->
    <div class="home-banner">
        <div class="">
            <div class="banner-slider-area owl-carousel">
                <div class="single-banner-slide owl-theme" data-dot="01">
                    <img src="{{ asset('website-assets/images/home/slider-1.jpg') }}" alt="image">
                </div>
            <div class="single-banner-slide owl-theme" data-dot="02">
                <img src="{{ asset('website-assets/images/home/slider-2.jpg') }}" alt="image">
            </div>
            <div class="single-banner-slide owl-theme" data-dot="03">
                <img src="{{ asset('website-assets/images/home/slider-3.jpg') }}" alt="image">
            </div>
            <div class="single-banner-slide owl-theme" data-dot="04">
                <img src="{{ asset('website-assets/images/home/slider-4.jpg') }}" alt="image">
            </div>
            <div class="single-banner-slide owl-theme" data-dot="05">
                <img src="{{ asset('website-assets/images/home/slider-5.jpg') }}" alt="image">
            </div>
        </div>
    </div>
    <!-- banner section close  -->
    <!-- two Grid Section start -->
    <div class="two-grid-home pt-70">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="grid-home-1 rounded">
                        <div class=" shadow  border rounded">
                            <div class="grid-head p-3">
                                <h4 class="text-white mb-0">
                                    <span class="me-2 "><i class="fas fa-address-card border-end pe-3" aria-hidden="true"></i></span>@lang('companyProfile.about_us_title')
                                </h4>
                            </div>
                            <div class="grid-text p-4">
                                <p>
                                    @lang('companyProfile.about_us_description') <span><a href="#">[ + @lang('homePage.view_more') ]</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="grid-home-1 rounded">
                        <div class=" shadow  border rounded">
                            <div class="grid-head p-3">
                                <h4 class="text-white mb-0">
                                    <span class="me-2 "><i class="fas fa-address-card border-end pe-3" aria-hidden="true"></i></span>@lang('homePage.news_and_events')
                                </h4>
                            </div>
                            <div class="grid-text p-4">
                                <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" height="230" scrollamount="3">
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Orders/MSHEP Tariff Order.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">MSHEP Tariff Order</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="https://www.ndtv.com/india-news/assam-has-vast-renewable-energy-potential-needs-policy-overhaul-experts-5331048">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Assam Has Vast Renewable Energy Potential, Needs Policy Overhaul: Experts - NDTV</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="recruitment/Doc_Ver_JM_2024.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Document Verification of JM(Electrical), JM(Mechanical), JM(IT) and JM(Instrumentation) in APGCL</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="recruitment/Pre-employment_Medical_Inv.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Pre-employment Medical Investigations for New Appointees</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="recruitment/NPS_new_appointees.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">NPS related notification for New Appointees</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="recruitment/merged_noti_veri_AM Elec_HR.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Notification &amp; Corrigendum regarding Document Verification for the post of AM (Electrical) and AM (HR)</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Employment Notice _Engagement of Special Officer.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Engagement of Special Officer in APGCL</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="https://www.facebook.com/share/2tkYPhgVZcxW4qx7/?mibextid=WC7FNe">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Address by MD,APGCL at Indian Electrical and Electronics Manufacturers' Association - 2024</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/APGCL_OIL JV.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">APGCL,OIL - Joint Venture for Green Energy Sector .</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Notification of reservation roster for promotion_APGCL.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Notification of reservation roster for promotion_APGCL.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Petitions/APGCL Tariff Petition 2024-25 Abridge.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Abridge of the APGCL Tariff Petition for F.Y. 2024-25</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Petitions/APGCL_Tariff_Petition 2024-25.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">APGCL Tariff Petition for F.Y. 2024-25</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="calendar/Holiday List 2024.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Holiday List for 2024</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/sexual_harassment_committee.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Office order regarding Sexual Harassment at Work Place.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Notice_tariff_23_24.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Public Notice on Generation Tariff Order for FY: 2023-24.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Noti_technical_assist_hydro.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Notification of Issue of RFP for the Consultancy Package "Technical Assistance for Capacity Building on Hydropower Projects".</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/dcrg.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Death Cum Retirement Gratuity (DCRG) in respect of regular employees of APGCL covered under National Pension System (NPS).</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="https://cwc.gov.in/vacancies">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">CWC Advertisement for Empanelment of Technical Experts for Dam Safety as per the Dam Safety Act 2021</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="certificates/pfc_certificate.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">We are pleased to intimate that APGCL has been rated as A++ against earlier rating A by Power Finance Corporation Ltd.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Petitions/APGCL_Tariff_Petition_2023-24.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">APGCL Tariff Petition for F.Y. 2023-24.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Petitions/APGCL_Consolidated_Petition_2023-24.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">APGCL Consolidated Petition for F.Y. 2023-24.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Notice English.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">English Public Notice on Tariff Petition FY: 2023-24.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Notice Assamese.pdf">
                                                <h6><img src="{{ asset('website-assets/images/home/new-1.gif') }}">Assamese Public Notice on Tariff Petition FY: 2023-24.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="gallery_ndsa.php">
                                                <h6>Regional Review Meeting of E &amp; NE Regions States of the National Dam Safety Authority (NDSA)</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Petitions/Abridge_MSHEP_petition_08_2022.pdf">
                                                <h6>Abridge of the MSHEP tariff Petition (Petition No 08/2022). </h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="tarrifs/Tariff Petitions/Tariff_Petition_MSHEP.pdf">
                                                <h6>MSHEP Tariff Petition (Petition No 08/2022). </h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Scan_Namrup-derating.pdf">
                                                <h6>Derating of NTPS. </h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/APGCL_Tariff_Order_2022_23.pdf">
                                                <h6>Tarrif Order-APGCL-2022-23</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Tariff Order NRPP-2022-23.pdf">
                                                <h6>Tarrif Order-NRPP-2022-23 </h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Award of Contract- package 3 LKHEP.pdf">
                                                <h6>Award of Contract of Package-3 (Electro-mechanical works)of 120 MW Lower Kopili Hydro Electric Project(LKHEP).</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/CRTDP.pdf">
                                                <h6>Draft Combined Resettlement and Tribal Development Plan.</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="news">
                                        <div class="news-content">
                                            <a target="_blank" href="news_events/Env Clearance.pdf">
                                                <h6>Environment Clearance for Lower Kopili HEP (120MW).</h6>
                                            </a>
                                        </div>
                                    </div>
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- two Grid Section close -->


    <!-- section counter start -->
    <div class="fun-facts pt-70 pb-100">
        <div class="container">
            <div class="counter">
                <div class="row justify-content-center">
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="fas fa-chart-line counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="50">00</span>+</h2>
                            <p>Years Of Experience</p>
                        </div>
                    </div>
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="fas fa-industry counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="6">00</span>+</h2>
                            <p>Power Projects</p>
                        </div>
                    </div>
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="far fa-smile counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="750">00</span>+</h2>
                            <p>Qualified Professionals</p>
                        </div>
                    </div>
                    <div class="col-lg col-md-4 col-sm-4 col-6">
                        <div class="fun-facts-card">
                            <i class="fas fa-bolt counter-icon" aria-hidden="true"></i>
                            <h2><span class="odometer" data-count="26000">00</span>+ MU</h2>
                            <p>Electricity Generated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- section counter close -->


    <!-- section partner start -->

    <section>
        <div class="container">
            <div class="text-center">
                <h2>@lang('homePage.partners_who_support_us')</h2>
                <div class="divider mx-auto my-4"></div>
            </div>
        </div>
    </section>
    <section class="pb-20">
        <div class="brand">
            <div class="container-fluid">
                <div class="brands-slider owl-carousel">
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/aegcl-logo.jpg') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/aegcl-logo.jpg') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/aerc.jpg') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/aerc.jpg') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/assam_gov.png') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/assam_gov.png') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/dap.png') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/dap.png') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/digital-india.jpg') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/digital-india.jpg') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/logo_amrit.png') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/logo_amrit.png') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/mop.png') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/mop.png') }}" alt="image">
                    </div>
                    <div class="brand-single-img">
                        <img class="br-img" src="{{ asset('website-assets/images/home/nic.jpg') }}" alt="image">
                        <img class="on-hover" src="{{ asset('website-assets/images/home/nic.jpg') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection