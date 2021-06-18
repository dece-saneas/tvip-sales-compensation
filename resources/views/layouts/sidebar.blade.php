<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="brand-image rounded elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>TVIP</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ HelperMenu::active('route',['dashboard']) }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">STORES</li>
                @can('product-index')
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ HelperMenu::active('url',['products*']) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product</p>
                    </a>
                </li>
                @endcan
                @role('Super Admin')
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ route('core.users.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('core.roles.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('core.permissions.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>