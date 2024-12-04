<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto"> <!-- Updated 'ml-auto' to 'ms-auto' for Bootstrap 5 -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        
        <!-- Profile Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#"> <!-- Updated 'data-toggle' to 'data-bs-toggle' -->
                <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <div class="p-0 dropdown-menu dropdown-menu-end" style="width: 250px; background-color: transparent; border: 0; box-shadow: none;">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                        <h5 class="widget-user-desc">
                            Role: 
                            @if (Auth::user()->roles->isNotEmpty())
                                @foreach (Auth::user()->roles as $role)
                                    <span class="badge badge-primary">{{ $role->name }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <i class="text-white fas fa-user-circle fa-5x"></i>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('profile.index') }}" class="dropdown-item">
                            <i class="mr-2 fas fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
