<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-decoration-none">
        <img src="{{ asset('admin-assets/dist/img/Logo1222.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
        <span style="display:block; text-align:center; width:80%; margin: 0 auto" class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-circle fa-2x text-white"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-decoration-none">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Sidebar menu items -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user-management') }}" class="nav-link {{ Request::is('user-management*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users text-green me-2"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-file-invoice text-green me-2"></i>
                        <p>Tenders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/news-and-events') }}" class="nav-link {{ Request::is('admin/news-and-events*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell text-green me-2"></i>
                        <p>News & Events</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/about-us*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/about-us*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-badge text-green me-2"></i>
                        <p>About Us<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Board of Directors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Offices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gallery</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('admin/career*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/career*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card-alt text-green me-2"></i>
                        <p>Career<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Apprenticeship</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/career/recruitments') }}" class="nav-link {{ Request::is('admin/career/recruitments*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recruitment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('admin/documents*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/documents*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file text-green me-2"></i>
                        <p>Documents<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{ url('admin/documents/rosters') }}" class="nav-link {{ Request::is('admin/documents/rosters*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Roster</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/acts') }}" class="nav-link {{ Request::is('admin/documents/acts*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Acts</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/policies') }}" class="nav-link {{ Request::is('admin/documents/policies*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Policies</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/service-rules') }}" class="nav-link {{ Request::is('admin/documents/service-rules*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Service Rules</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/certificates') }}" class="nav-link {{ Request::is('admin/documents/certificates*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Certificates</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/tariff-order') }}" class="nav-link {{ Request::is('admin/documents/tariff-order*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Tariff Order</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/tariff-petition') }}" class="nav-link {{ Request::is('admin/documents/tariff-petition*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Tariff Petition</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/right-to-information') }}" class="nav-link {{ Request::is('admin/documents/right-to-information*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Right to Information</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/annual-statements') }}" class="nav-link {{ Request::is('admin/documents/annual-statements*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Annual Statement</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/annual-returns') }}" class="nav-link {{ Request::is('admin/documents/annual-returns*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Annual Returns</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/reports') }}" class="nav-link {{ Request::is('admin/documents/reports*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Reports</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/publications') }}" class="nav-link {{ Request::is('admin/documents/publications*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Publications</p></a></li>
                        <li class="nav-item"><a href="{{ url('admin/documents/standard-forms') }}" class="nav-link {{ Request::is('admin/documents/standard-forms*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Standard Forms</p></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/daily-generation') }}" class="nav-link {{ Request::is('admin/daily-generation*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-lightbulb text-green me-2"></i>
                        <p>Daily Generation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/calendars') }}" class="nav-link {{ Request::is('admin/calendars*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar text-green me-2"></i>
                        <p>Calendar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/disaster-management') }}" class="nav-link {{ Request::is('admin/disaster-management*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-triangle text-green me-2"></i>
                        <p>Disaster Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/dam-safety') }}" class="nav-link {{ Request::is('admin/admin/dam-safety*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-building-shield text-green me-2"></i>
                        <p>Dam Safety</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/contact-us') }}" class="nav-link {{ Request::is('admin/contact-us*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book text-green me-2"></i>
                        <p>Contacts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/corporate-social-responsibility') }}" class="nav-link {{ Request::is('admin/corporate-social-responsibility*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hands-helping text-green me-2"></i>
                        <p>CSR</p>
                    </a>
                </li>
                <li class="nav-header">Settings</li>
                <li class="nav-item">
                    <a href="{{ url('profile') }}" class="nav-link {{ Request::is('profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user text-green me-2"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
