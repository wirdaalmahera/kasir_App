<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">Kasir App</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/dashboard"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
                <a href="" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>
            @if(auth()->user()->role=='admin')
            <li class="dropdown">
                <a href="/admin/produk" class="nav-link"><i class="fas fa-boxes"></i><span>Produk</span></a>
            </li>
            @endif
            @if(auth()->user()->role == 'kasir') 
            <li class="dropdown">
                <a href="/kasir/penjualan" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Penjualan</span></a>
            </li>
            @endif
            @if(auth()->user()->role == 'kasir') 
            <li class="dropdown">
                <a href="/kasir/penjualan/pelanggan" class="nav-link"><i class="fas fa-users"></i><span>Pelanggan</span></a>
            </li>
            @endif
            @if(auth()->user()->role=='admin')
            <li class="dropdown">
                <a href="/admin/user" class="nav-link"><i class="fas fa-users"></i><span>User</span></a>
            </li>
            @endif
        </ul>
    </aside>
</div>
