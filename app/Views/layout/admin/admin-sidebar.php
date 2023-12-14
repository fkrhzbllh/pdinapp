<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <img class="w-50" src="<?= base_url() ?>assets/logo-pdin-merah-abu.png" id="logo" alt="Logo_PDIN" />
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Rilis Media
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($current_page == 'adminrilismedia') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/rilis-media">
            <i class="icon bi bi-newspaper"></i>
            <span>Rilis Media</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Fasilitas
    </div>

    <li class="nav-item <?= ($current_page == 'adminruangan') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/ruangan">
            <i class="icon bi bi-door-open-fill"></i>
            <span>Ruangan</span>
        </a>
    </li>
    <li class="nav-item <?= ($current_page == 'adminalat') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/alat">
            <i class="icon bi bi-tools"></i>
            <span>Alat</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Kegiatan
    </div>

    <li class="nav-item <?= ($current_page == 'adminkegiatan') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/kegiatan">
            <i class="icon bi bi-activity"></i>
            <span>Kegiatan</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Layanan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($current_page == 'adminsewaruangan') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/layanan-sewa-ruangan">
            <i class="icon bi bi-door-open-fill"></i>
            <span>Sewa Ruangan</span>
        </a>
    </li>
    <li class="nav-item <?= ($current_page == 'adminsewaalat') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/layanan-sewa-alat">
            <i class="icon bi bi-tools"></i>
            <span>Sewa Alat</span>
        </a>
    </li>
    <li class="nav-item <?= ($current_page == 'adminpelatihan') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/layanan-pelatihan">
            <i class="icon bi bi-person-arms-up"></i>
            <span>Pelatihan</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <li class="nav-item <?= ($current_page == 'adminmanajemenuser') ? 'active' : '' ?>">
        <a class="nav-link" href="/DashboardAdmin/manajemen-user">
            <i class="icon bi bi-people-fill"></i>
            <span>Manajemen User</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengguna
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard-user">
            <i class="bi bi-person-fill"></i>
            <span>Dasbor Pengguna</span>
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