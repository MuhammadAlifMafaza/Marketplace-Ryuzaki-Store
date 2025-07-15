<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/admin/dashboard') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/Logo_nobg.png'); ?>" class="img-fluid" alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3">Ryuzaki <sup>Store</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/karyawan/' . session()->get('jabatan') . '/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Main Menu</div>

    <?php if (session()->get('jabatan') == ('admin')): ?>
        <!-- Admin Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Products</span>
            </a>
            <div id="collapseProducts" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Products:</h6>
                    <a class="collapse-item" href="<?= base_url('/karyawan/admin/products') ?>">List Products</a>
                    <a class="collapse-item" href="<?= base_url('/karyawan/admin/product-sub-categories') ?>">Sub Categories</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/karyawan/admin/categories') ?>">
                <i class="fas fa-fw fa-list"></i>
                <span>Categories</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span>
            </a>
            <div id="collapseUsers" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customer:</h6>
                    <a class="collapse-item" href="/list-Customer">Customer</a>
                    <a class="collapse-item" href="/list-Seller">Seller</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Karyawan:</h6>
                    <a class="collapse-item" href="#">Admin</a>
                    <a class="collapse-item" href="#">Kurir</a>
                    <a class="collapse-item" href="#">Owner</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (session()->get('jabatan') == ('owner')): ?>
        <!-- Owner Menu -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/karyawan/owner/laporan') ?>">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/karyawan/owner/statistik') ?>">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Statistik</span>
            </a>
        </li>
    <?php endif; ?>

    <?php if (session()->get('jabatan') == ('kurir')): ?>
        <!-- Kurir Menu -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/karyawan/kurir/pengiriman') ?>">
                <i class="fas fa-fw fa-truck"></i>
                <span>Kelola Pengiriman</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/karyawan/kurir/orders') ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Pesanan</span>
            </a>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
