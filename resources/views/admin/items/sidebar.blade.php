<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
        <img src="{{ asset('css/howsit2.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Howsit Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('/images/profile/' .Auth::user()->profile_image) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('/profile') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            @can('user-list')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            @endcan
            @can('role-list')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                        Roles
                        </p>
                    </a>
                </li>
            @endcan
            @can('feed-list')
                <li class="nav-item">
                    <a href="{{ route('feeds.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Feed
                        </p>
                    </a>
                </li>
            @endcan

            {{-- @can('saldo-list') --}}
                <li class="nav-item">
                    <a href="{{ route('saldos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Balance
                        </p>
                    </a>
                </li>
            {{-- @endcan --}}
            
            {{-- @can('saldo-list') --}}
                <li class="nav-item">
                    <a href="{{ route('money.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Money
                        </p>
                    </a>
                </li>
            {{-- @endcan --}}
            
            {{-- @can('saldo-list') --}}
                <li class="nav-item">
                    <a href="{{ route('shares.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-donate"></i>
                        <p>
                            Shares
                        </p>
                    </a>
                </li>
            {{-- @endcan --}}
            
            {{-- @can('saldo-list') --}}
                <li class="nav-item">
                    <a href="{{ route('loans.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            Loans
                        </p>
                    </a>
                </li>
            {{-- @endcan --}}

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-door-open"></i>
                    <p>
                    {{ __('Logout') }}
                    </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

