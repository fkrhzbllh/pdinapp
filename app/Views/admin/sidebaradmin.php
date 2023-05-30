<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i|Lato:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet" />
        <!-- End Font -->
        <!-- Import Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
            crossorigin="anonymous" />
        <!-- End Bootstrap CSS -->
        <!-- Import Bootstrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <!-- End Bootstrap Icon -->
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        </link>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <!-- Import Custom CSS -->
        <link rel="stylesheet"
            href="<?= base_url() ?>assets/style.css" />
        <title>Dashboard</title>
    </head>

    <body class="bg-pdin-abu-terang">
        <!-- SIDEBAR -->
        <div id="sidebar">
            <a href="#" class="brand">
                <!-- <i class="icon bi bi-grid-fill"> </i> -->
                <div class="icon">
                    <img src="<?= base_url() ?>assets/Logo-PDIN.png"
                        style="height: 24px; width: 24px" alt="" class="rounded-1" />
                </div>
                <span>
                    <h5 class="m-0 mt-1 p-0">Dashboard</h5>
                </span>

            </a>
            <ul class="side-menu">
                <!-- <li>
                    <a href="#" class="active">
                        <i class="bi bi-grid-1x2-fill icon"></i>
                        Dashboard Utama</a>
                </li> -->
                <li class="divider" data-text="rilismedia">Rilis Media</li>
                <li>
                    <a href="<?= base_url() ?>DashboardAdmin/rilis-media"
                        class="<?= ($current_page == 'adminrilismedia') ? 'active' : '' ?>"><i
                            class="icon bi bi-pencil-fill"></i>Rilis Media</a>
                </li>

                <li class="divider" data-text="fasilitas">Fasilitas</li>

                <li>
                    <a href="<?= base_url() ?>DashboardAdmin/ruangan"
                        class="<?= ($current_page == 'adminruangan') ? 'active' : '' ?>"><i
                            class="icon bi bi-door-open-fill"></i>Ruangan</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>DashboardAdmin/alat"
                        class="<?= ($current_page == 'adminalat') ? 'active' : '' ?>"><i
                            class="icon bi bi-tools"></i>Alat</a>
                </li>
                <li class="divider" data-text="kegiatan">Kegiatan</li>
                <li>
                    <a href="<?= base_url() ?>DashboardAdmin/kegiatan"
                        class="<?= ($current_page == 'adminkegiatan') ? 'active' : '' ?>"><i
                            class="icon bi bi-activity"></i>Kegiatan</a>
                </li>

            </ul>
        </div>
        <!-- SIDEBAR -->

        <!-- Content -->
        <div id="content-dashboard" class="">
            <!-- NAVBAR -->
            <nav id="nav-dashboard" class="justify-content-between">
                <div class="toggle-sidebar p-2">
                    <i class="bi bi-list"></i>
                </div>
                <div>
                    <!-- <span class="divider"></span> -->
                    <div class="profile">
                        <div class="divider"></div>
                        <img src="<?= base_url() ?>assets/galeri-9.jpg"
                            alt="" />
                        <ul class="profile-link">
                            <li>
                                <a href="#"><i class="icon bi bi-person-circle"></i> Profile</a>
                            </li>

                            <li>
                                <a href="#"><i class="bi bi-box-arrow-left"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- NAVBAR -->