<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard-user">
        <img class="w-50" src="<?= base_url() ?>assets/logo-pdin-merah-abu.png" id="logo" alt="Logo_PDIN" />
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if (auth()->user()->inGroup("admin")) : ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="/DashboardAdmin">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dasbor Admin</span>
            </a>
        </li>

    <?php endif; ?>

    <!-- Heading -->
    <div class="sidebar-heading">
        Layanan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($current_page == 'usersewaruangan') ? 'active' : '' ?>">
        <a class="nav-link" href="/dashboard-user/layanan-sewa-ruangan">
            <i class="icon bi bi-door-open-fill"></i>
            <span>Sewa Ruangan</span>
        </a>
    </li>
    <li class="nav-item <?= ($current_page == 'usersewaalat') ? 'active' : '' ?>">
        <a class="nav-link" href="/dashboard-user/layanan-sewa-alat">
            <i class="icon bi bi-tools"></i>
            <span>Sewa Alat</span>
        </a>
    </li>
    <li class="nav-item <?= ($current_page == 'userpelatihan') ? 'active' : '' ?>">
        <a class="nav-link" href="/dashboard-user/layanan-pelatihan">
            <i class="icon bi bi-person-arms-up"></i>
            <span>Pelatihan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->