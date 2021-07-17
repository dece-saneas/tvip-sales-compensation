<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="javascript:void(0)" class="nav-link"><i class="fas fa-info-circle mr-2"></i>Sistem Informsi Penjualan Dengan Perhitungan Reward Customer [ Sales Compensation ]</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link p-0" data-toggle="dropdown" href="javascript:void(0)">
                <img src="{{ asset('img/users/'.Auth::user()->photo) }}" class="img-circle nav-user-img" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('img/users/placeholder.jpg') }}';"><span class="nav-user-name">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('settings.index') }}" class="dropdown-item">Pengaturan</a>
                @role('Super Admin')
                <a href="{{ route('core.users.index') }}" class="dropdown-item">Manage Users</a>
                @endrole
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>                        
            </div>
        </li>
    </ul>
</nav>