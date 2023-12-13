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

        <li class="divider" data-text="layanan">Layanan</li>

        <li>
            <a href="<?= base_url() ?>dashboard-user/layanan-sewa-ruangan" class="<?= ($current_page == 'usersewaruangan') ? 'active' : '' ?>"><i class="icon bi bi-door-open-fill"></i>Sewa Ruangan</a>
        </li>
        <li>
            <a href="<?= base_url() ?>dashboard-user/layanan-sewa-alat" class="<?= ($current_page == 'usersewaalat') ? 'active' : '' ?>"><i class="icon bi bi-tools"></i>Sewa Alat</a>
        </li>
        <li>
            <a href="<?= base_url() ?>dashboard-user/layanan-pelatihan" class="<?= ($current_page == 'userpelatihan') ? 'active' : '' ?>"><i class="icon bi bi-person-arms-up"></i>Pelatihan</a>
        </li>

    </ul>
</div>
<!-- SIDEBAR -->