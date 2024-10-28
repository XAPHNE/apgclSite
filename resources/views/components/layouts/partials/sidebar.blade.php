<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
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
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add your sidebar menu items here -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Dashboard
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user-management') }}" class="nav-link {{ Request::is('user-management*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users text-green"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-file-invoice text-green"></i>
                        <p>
                            Tenders
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            News & Events
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            About Us
                            <i class="right fas fa-angle-left"></i>
                        </p>
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
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Career
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Internship</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recruitment</p>
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
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('admin/documents*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Documents
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Acts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Policies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Rules</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Certificates</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tariff Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tariff Petition</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Right to Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Annual Statement</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Annual Returns</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Publications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/documents/standard-forms') }}" class="nav-link {{ Request::is('admin/documents/standard-forms*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Standard Forms</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Daily Generation
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Calendar
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Disaster Management
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            Contacts
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-green"></i>
                        <p>
                            CSR
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('ticket-management') }}" class="nav-link {{ Request::is('ticket-management*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-receipt text-green"></i>
                        <p>
                            Tickets
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li> --}}
                <li class="nav-header">Settings</li>
                <li class="nav-item">
                    <a href="{{ url('profile') }}" class="nav-link {{ Request::is('profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user text-green"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>