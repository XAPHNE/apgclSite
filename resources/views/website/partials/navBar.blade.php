<div class="theme-switcher">
    <label id="switch" class="switch custum">
        <input type="checkbox" onchange="toggleTheme()" id="slider"  class="custom-input">
        <span class="slider round"></span>
    </label>
</div>
<header>
<div class="topbar">
    <div class="container-fluid">
        <div class="topbar-content">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="top-contact-area mbl-none">
                         <div class="row">
                            <div class="col-2 st-wd">
                                <a class="navbar-brand d-flex " href="{{ url('/' . app()->getLocale()) }}">
                                    <img class="black-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" />
                                    <img class="white-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" />
                                </a> 
                            </div>
                            <div class="col-10">
                                <span class="mt-5">
                                    <h4 class="text-black fs-5 mt-3">ASSAM POWER GENERATION CORPORATION LTD.</h4>
                                    <div class="text-black">অসম শক্তি উৎপাদন নিগম লিমিটেড</div>
                                </span>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="top-contact-area">
                        <ul>
                            <li>
                                <a href="#stmc">@lang('header.skip_to_main_content') |</a>
                            </li>
                            <li>
                                <a href="site_map.php">@lang('header.site_map') |</a>
                            </li>
                            <li>
                                <a href="screen_reader.php">@lang('header.screen_reader') |</a>
                            </li>
                            <li>
                                <span class="me-1" style="cursor:pointer;" onclick="setFontSize(14)">-@lang('header.font_size')</span>
                                <span class="me-1" style="cursor:pointer;"onclick="setFontSize(16)">@lang('header.font_size')</span>
                                <span  style="cursor:pointer;" onclick="setFontSize(18)">@lang('header.font_size')+ |</span>
                            </li>

                            @if (App::getLocale() == 'as')
                                <li>
                                    <a id="english" href="#" onclick="changeLocale('en')">English |</a>
                                </li>
                            @else
                                <li>
                                    <a id="assamese" href="#" onclick="changeLocale('as')">অসমীয়া |</a>
                                </li>
                                
                            @endif


                            <li>
                            <div class="dropdown account-details">
                            <a class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">@lang('header.employee_corner')</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="https://mail.apgcl.org/" target="_blank">@lang('header.employee_mail')</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="https://dashboard.apgcl.org/" target="_blank">@lang('header.apgcl_dashboard')</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="https://epragati.apgcl.org:44900/irj/portal" target="_blank">@lang('header.apgcl_ess/mss_portal')</a>
                                </li>
                            </ul>
                        </div>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-right-area d-flex">
                    <div class="indian-logo">
                        {{-- <img class="" src="{{ asset('website-assets/images/home/logo_amrit.png') }}" alt="logo" /> --}}
                     </div>
                     <div class="menu-sidebar">
                            <form>
                                <div class="input-group m-search-box">
                                    <input type="text" class="form-control" placeholder="@lang('header.search')" required>
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="header-area">
        <div class="navbar-area">
            <div class="main-responsive-nav">
                <div class="containe">
                    <div class="mobile-nav">
                        <a href="{{ url('/' . app()->getLocale()) }}" class="logo" style="position-relative">
                            {{-- <img class="black-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" /> --}}
                            <img class="black-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" width="50px" />
                            <img class="white-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" />

                             <span class="mt-5 mobile-st">
                                        <h4 class="text-black fs-5 mt-5">ASSAM POWER GENERATION CORPORATION LTD.</h4>
                                        <div class="text-black stmobile">অসম শক্তি উৎপাদন নিগম লিমিটেড</div>
                                    </span>
                        </a>
                        <ul class="menu-sidebar menu-small-device">
                            <li><button class="popup-button"><i class="fas fa-search"></i></button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand d-lg-none" href="{{ url('/' . app()->getLocale()) }}">
                            <img class="black-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" />
                            <img class="white-logo" src="{{ asset('website-assets/images/logo.png') }}" alt="logo" />
                        </a> 
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">@lang('navigationMenu.home')</a></li>
                                <li class="nav-item plus-icon">
                                    <a href="#" class="nav-link dropdown-toggle">@lang('navigationMenu.about_us') <i class="fas fa-long-arrow-alt-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/about-us/company-profile') }}" class="nav-link">@lang('navigationMenu.company_profile')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/about-us/board-of-directors') }}" class="nav-link">@lang('navigationMenu.board_of_directors')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/about-us/offices') }}" class="nav-link">@lang('navigationMenu.offices')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/about-us/gallery') }}" class="nav-link">@lang('navigationMenu.gallery')</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">@lang('navigationMenu.documents')  <i class="fas fa-long-arrow-alt-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/rosters') }}" class="nav-link">@lang('navigationMenu.roster')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/acts-policies-service-rules') }}" class="nav-link">@lang('navigationMenu.acts/policies/service_rules')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/certificates') }}" class="nav-link">@lang('navigationMenu.certificates')</a></li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link dropdown-toggle">@lang('navigationMenu.tariff')  <i class="fas fa-caret-right"></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/tariff-order') }}" class="nav-link">@lang('navigationMenu.tariff_order')</a></li>
                                                <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/tariff-petition') }}" class="nav-link">@lang('navigationMenu.tariff_petition')</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/right-to-information') }}" class="nav-link">@lang('navigationMenu.right_to_information')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/annual-statements') }}" class="nav-link">@lang('navigationMenu.annual_statement')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/annual-returns') }}" class="nav-link">@lang('navigationMenu.annual_return')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/reports') }}" class="nav-link">@lang('navigationMenu.reports')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/publications') }}" class="nav-link">@lang('navigationMenu.publication')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/documents/standard-forms') }}" class="nav-link">@lang('navigationMenu.standard_forms')</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">@lang('navigationMenu.ongoing_projects') <i class="fas fa-long-arrow-alt-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="hydro.php" class="nav-link">@lang('navigationMenu.hydro_plants')</a></li>
                                        <li class="nav-item"><a href="thermal.php" class="nav-link">@lang('navigationMenu.thermal_plants')</a></li>
                                        <li class="nav-item"><a href="ongoing.php" class="nav-link">@lang('navigationMenu.ongoing_projects')</a></li>
                                        <li class="nav-item"><a href="pipeline.php" class="nav-link">@lang('navigationMenu.projects_in_pipeline')</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">@lang('navigationMenu.tenders')  <i class="fas fa-long-arrow-alt-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="tenders.php" class="nav-link">@lang('navigationMenu.current_financial_year')</a></li>
                                        <li class="nav-item"><a href="previous_tenders.php" class="nav-link">@lang('navigationMenu.previous_financial_year')</a></li>
                                        <li class="nav-item"><a href="archive.php" class="nav-link">@lang('navigationMenu.archive')</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">@lang('navigationMenu.career')  <i class="fas fa-long-arrow-alt-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="internship.php" class="nav-link">@lang('navigationMenu.internship')</a></li>
                                        <li class="nav-item"><a href="apprenticeship.php" class="nav-link">@lang('navigationMenu.apprenticeship')</a></li>
                                        <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/career/recruitments') }}" class="nav-link">@lang('navigationMenu.recruitment')</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/disaster-management') }}" class="nav-link">@lang('navigationMenu.disaster_management')</a></li>
                                <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/dam-safety') }}" class="nav-link">@lang('navigationMenu.dam_safety')</a></li>
                                <li class="nav-item"><a href="{{ url('/' . app()->getLocale() . '/contact-us') }}" class="nav-link">@lang('navigationMenu.contact_us')</a></li>
                            </ul>
                            <div class="menu-sidebar d-lg-none">
                                <form>
                                    <div class="input-group m-search-box">
                                        <input type="text" class="form-control" placeholder="Search" required>
                                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>