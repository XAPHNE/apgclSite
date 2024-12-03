<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-decoration-none">
        <img src="{{ asset('admin-assets/dist/img/Logo1222.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
        <span style="display:block; text-align:center; width:80%; margin: 0 auto" class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="image">
                <i class="text-white fas fa-user-circle fa-2x"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-decoration-none">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Sidebar menu items -->
                @hasrole('Super Admin')
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endhasrole
                @hasrole('Super Admin|Tender Uploader')
                <li class="nav-item">
                    <a href="{{ route('tenders.index') }}" class="nav-link {{ Request::is('admin/tenders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-file-invoice text-green me-2"></i>
                        <p>Tenders</p>
                    </a>
                </li>
                @endhasrole
                @hasrole('Super Admin')
                <li class="nav-item">
                    <a href="{{ route('news-and-events.index') }}" class="nav-link {{ Route::is('news-and-events.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell text-green me-2"></i>
                        <p>News & Events</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('board-of-directors.*', 'gallery.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('board-of-directors.*', 'gallery.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-badge text-green me-2"></i>
                        <p>About Us<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('board-of-directors.index') }}" class="nav-link {{ Route::is('board-of-directors.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Board of Directors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gallery.index') }}" class="nav-link {{ Route::is('gallery.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gallery</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('apprenticeship.*', 'recruitments.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/career*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card-alt text-green me-2"></i>
                        <p>Career<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('apprenticeship.index') }}" class="nav-link {{ Route::is('apprenticeship.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Apprenticeship</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('recruitments.index') }}" class="nav-link {{ Route::is('recruitments.*') ? 'active' : '' }}">
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
                        <li class="nav-item"><a href="{{ route('rosters.index') }}" class="nav-link {{ Route::is('rosters.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Roster</p></a></li>
                        <li class="nav-item"><a href="{{ route('acts.index') }}" class="nav-link {{ Route::is('acts.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Acts</p></a></li>
                        <li class="nav-item"><a href="{{ route('policies.index') }}" class="nav-link {{ Route::is('policies.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Policies</p></a></li>
                        <li class="nav-item"><a href="{{ route('service-rules.index') }}" class="nav-link {{ Route::is('service-rules.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Service Rules</p></a></li>
                        <li class="nav-item"><a href="{{ route('certificates.index') }}" class="nav-link {{ Route::is('certificates.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Certificates</p></a></li>
                        <li class="nav-item"><a href="{{ route('tariff-order.index') }}" class="nav-link {{ Route::is('tariff-order.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Tariff Order</p></a></li>
                        <li class="nav-item"><a href="{{ route('tariff-petition.index') }}" class="nav-link {{ Route::is('tariff-petition.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Tariff Petition</p></a></li>
                        <li class="nav-item"><a href="{{ route('right-to-information.index') }}" class="nav-link {{ Route::is('right-to-information.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Right to Information</p></a></li>
                        <li class="nav-item"><a href="{{ route('annual-statements.index') }}" class="nav-link {{ Route::is('annual-statements.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Annual Statement</p></a></li>
                        <li class="nav-item"><a href="{{ route('annual-returns.index') }}" class="nav-link {{ Route::is('annual-returns.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Annual Returns</p></a></li>
                        <li class="nav-item"><a href="{{ route('reports.index') }}" class="nav-link {{ Route::is('reports.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Reports</p></a></li>
                        <li class="nav-item"><a href="{{ route('publications.index') }}" class="nav-link {{ Route::is('publications.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Publications</p></a></li>
                        <li class="nav-item"><a href="{{ route('standard-forms.index') }}" class="nav-link {{ Route::is('standard-forms.*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Standard Forms</p></a></li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('ongoing-projects.*', 'projects-in-pipeline.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('ongoing-projects.*', 'projects-in-pipeline.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-badge text-green me-2"></i>
                        <p>Projects<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('ongoing-projects.index') }}" class="nav-link {{ Route::is('ongoing-projects.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>On going</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('projects-in-pipeline.index') }}" class="nav-link {{ Route::is('projects-in-pipeline.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>In Pipeline</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasrole
                @hasrole('Super Admin|Daily Generation Updater')
                <li class="nav-item">
                    <a href="{{ route('daily-generation.index') }}" class="nav-link {{ Route::is('daily-generation.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-lightbulb text-green me-2"></i>
                        <p>Daily Generation</p>
                    </a>
                </li>
                @endhasrole
                @hasrole('Super Admin')
                <li class="nav-item">
                    <a href="{{ route('calendars.index') }}" class="nav-link {{ Route::is('calendars.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar text-green me-2"></i>
                        <p>Calendar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('disaster-management.index') }}" class="nav-link {{ Route::is('disaster-management.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-triangle text-green me-2"></i>
                        <p>Disaster Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dam-safety.index') }}" class="nav-link {{ Route::is('dam-safety.*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-building-shield text-green me-2"></i>
                        <p>Dam Safety</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact-us.index') }}" class="nav-link {{ Route::is('contact-us.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book text-green me-2"></i>
                        <p>Contacts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('corporate-social-responsibility.index') }}" class="nav-link {{ Route::is('corporate-social-responsibility.*') ? 'active' : '' }}">
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
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Route::is('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users text-green me-2"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('roles.*', 'permissions.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('roles.*', 'permissions.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-person-circle-check text-green me-2"></i>
                        <p>Roles & Permissions<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ Route::is('roles.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link {{ Route::is('permissions.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasrole
            </ul>
        </nav>
    </div>
</aside>
