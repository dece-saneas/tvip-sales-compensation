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
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ HelperMenu::active('route',['dashboard']) }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @can('view product')
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ HelperMenu::active('route',['products.index', 'products.create']) }}">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <p>Produk</p>
                    </a>
                </li>
                @endcan
                @can('ciew supply')
                <li class="nav-item">
                    <a href="{{ route('supplies.index') }}" class="nav-link {{ HelperMenu::active('url',['products/supplies*']) }}">
                        <i class="fas fa-dolly-flatbed nav-icon"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                @endcan
                @can('create order')
                <li class="nav-item">
                    <a href="{{ route('carts.index') }}" class="nav-link">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>Keranjang @if(count($data['carts']) > 0) <span class="badge badge-primary right">{{ count($data['carts']) }}</span> @endif</p>
                    </a>
                </li>
                @endcan
                @can('view order')
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="fas fa-receipt nav-icon"></i>
                        <p>Pesanan @if(count($data['invoices']) > 0) <span class="badge badge-primary right">{{ count($data['invoices']) }}</span> @endif</p>
                    </a>
                </li>
                @endcan
                @can('view user')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ HelperMenu::active('url',['users*']) }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>User</p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>