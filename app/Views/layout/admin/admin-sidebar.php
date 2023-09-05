<!-- SIDEBAR -->
<div id="sidebar">
    <a href="#" class="brand">
        <!-- <i class="icon bi bi-grid-fill"> </i> -->
        <div class="icon">
            <!-- <img src="<?= base_url() ?>assets/Logo-PDIN.png"
                    -->
            <img src="<?= base_url() ?>favicon.ico" style="height: 24px; width: 24px" alt="" class="rounded-1" />
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
            <a href="<?= base_url() ?>DashboardAdmin/rilis-media" class="<?= ($current_page == 'adminrilismedia') ? 'active' : '' ?>"><i class="icon bi bi-newspaper"></i>Rilis Media</a>
        </li>

        <li class="divider" data-text="fasilitas">Fasilitas</li>

        <li>
            <a href="<?= base_url() ?>DashboardAdmin/ruangan" class="<?= ($current_page == 'adminruangan') ? 'active' : '' ?>"><i class="icon bi bi-door-open-fill"></i>Ruangan</a>
        </li>
        <li>
            <a href="<?= base_url() ?>DashboardAdmin/alat" class="<?= ($current_page == 'adminalat') ? 'active' : '' ?>"><i class="icon bi bi-tools"></i>Alat</a>
        </li>
        <li class="divider" data-text="kegiatan">Kegiatan</li>
        <li>
            <a href="<?= base_url() ?>DashboardAdmin/kegiatan" class="<?= ($current_page == 'adminkegiatan') ? 'active' : '' ?>"><i class="icon bi bi-activity"></i>Kegiatan</a>
        </li>

    </ul>
</div>
<!-- SIDEBAR -->