<?= $this->extend('layout/user/user-template') ?>

<?= $this->section('content') ?>
<?php helper('text') ?>

<div class="p-5 col-12 bg-white">
    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
        </div>
    <?php elseif (session()->getFlashdata('gagal')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('gagal') ?>
        </div>
    <?php endif; ?>
    <h3 class="mb-3">Sewa Ruangan</h3>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="row">
                <!-- <div class="col-6 col-md-6">
                    <a class="btn btn-outline-danger mb-3" href="<?= base_url() . 'dashboard-user/tambah-sewa-ruangan/' ?>">Tambah
                        Sewa Ruangan</a>
                </div> -->
                <!-- === Nav tabel dan kalender === -->
                <div class="col-6 col-md-6">
                    <ul class="nav nav-underline justify-content-end" role="tablist" id="navs-tab">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tabel-tab" data-bs-toggle="tab" data-bs-target="#nav-tabel" role="tab" aria-controls="nav-tabel" aria-selected="true"><i class="bi bi-table me-1"></i>Tabel</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-kalender-tab" data-bs-toggle="tab" data-bs-target="#nav-kalender" role="tab" aria-controls="nav-kalender" aria-selected="false"><i class="bi bi-calendar-event me-1"></i>Kalender</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- === Konten Nav Tabel === -->
    <div class="tab-content" id="navs-tabContent">
        <div class="tab-pane fade show active" id="nav-tabel" role="tabpanel" aria-labelledby="nav-tabel-tab" tabindex="0">

            <!-- === Nav === -->
            <div class="col mt-1">
                <ul class="nav nav-tabs nav-justified" role="tablist" id="navs-tab-2">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="jadwal-akan-datang-tab" data-bs-toggle="tab" data-bs-target="#tab-jadwal-akan-datang" role="tab" aria-controls="tab-jadwal-akan-datang" aria-selected="true">Jadwal Akan Datang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="jadwal-sedang-berlangsung-tab" data-bs-toggle="tab" data-bs-target="#tab-jadwal-sedang-berlangsung" role="tab" aria-controls="tab-jadwal-sedang-berlangsung" aria-selected="false">Jadwal Sedang Berlangsung</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="jadwal-sudah-selesai-tab" data-bs-toggle="tab" data-bs-target="#tab-jadwal-sudah-selesai" role="tab" aria-controls="tab-jadwal-sudah-selesai" aria-selected="false">Jadwal Sudah Selesai</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="tab-jadwal-akan-datang" role="tabpanel" aria-labelledby="jadwal-akan-datang-tab" tabindex="0">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped display" id="tablejadwal1" style="width: 100%;">
                            <thead>
                                <tr>
                                    <!-- <td>No</td> -->
                                    <td>Nama Kegiatan</td>
                                    <td>Ruangan</td>
                                    <td>Mulai Sewa</td>
                                    <td>Selesai Sewa</td>
                                    <!-- <td>Aksi</td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jadwalAkanDatang as $key => $a) : ?>
                                    <tr>
                                        <td><?= $a['events']['title'] ?></td>
                                        <td><?= $a['ruangan']['nama'] ?></td>
                                        <td data-sort="<?php echo strtotime($a['events']['start']) ?>">
                                            <?php if ($a['ruangan']['tipe'] == 'Pameran') {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                                echo $formatter->format(date_create($a['events']['start']));
                                            } else {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                                echo $formatter->format(date_create($a['events']['start']));
                                            } ?>
                                        </td>
                                        <td data-sort="<?php echo strtotime($a['events']['start']) ?>">
                                            <?php if ($a['ruangan']['tipe'] == 'Pameran') {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                                echo $formatter->format(date_create($a['events']['selesai']));
                                            } else {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                                echo $formatter->format(date_create($a['events']['selesai']));
                                            } ?>
                                        </td>
                                        <!-- <td>
                                            <a href="/dashboard-user/update-sewa-ruangan/<?= $a['uuid'] ?>" class="btn btn-warning">Edit</a>
                                            
                                            <form action="/dashboard-user/sewaRuangan/<?php echo $a['id'] ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab-jadwal-sedang-berlangsung" role="tabpanel" aria-labelledby="jadwal-sedang-berlangsung-tab" tabindex="0">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped display" id="tablejadwal2" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td>Nama Kegiatan</td>
                                    <td>Ruangan</td>
                                    <td>Mulai Sewa</td>
                                    <td>Selesai Sewa</td>
                                    <!-- <td>Aksi</td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jadwalSedangBerlangsung as $key => $a) : ?>
                                    <tr>
                                        <td><?= $a['events']['title'] ?></td>
                                        <td><?= $a['ruangan']['nama'] ?></td>
                                        <td data-sort="<?php echo strtotime($a['events']['start']) ?>">
                                            <?php if ($a['ruangan']['tipe'] == 'Pameran') {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                                echo $formatter->format(date_create($a['events']['start']));
                                            } else {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                                echo $formatter->format(date_create($a['events']['start']));
                                            } ?>
                                        </td>
                                        <td data-sort="<?php echo strtotime($a['events']['start']) ?>">
                                            <?php if ($a['ruangan']['tipe'] == 'Pameran') {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                                echo $formatter->format(date_create($a['events']['selesai']));
                                            } else {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                                echo $formatter->format(date_create($a['events']['selesai']));
                                            } ?>
                                        </td>
                                        <!-- <td>
                                            <a href="/dashboard-user/update-sewa-ruangan/<?= $a['uuid'] ?>" class="btn btn-warning">Edit</a>
                                            <form action="/dashboard-user/update-sewa-ruangan" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" value="<?php echo $a['id'] ?>" name="id">
                                                <button class="btn btn-warning" type="submit">Edit</button>
                                            </form>
                                            <form action="/dashboard-user/sewaRuangan/<?php echo $a['id'] ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab-jadwal-sudah-selesai" role="tabpanel" aria-labelledby="jadwal-sudah-selesai-tab" tabindex="0">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped display" id="tablejadwal3" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td>Nama Kegiatan</td>
                                    <td>Ruangan</td>
                                    <td>Mulai Sewa</td>
                                    <td>Selesai Sewa</td>
                                    <!-- <td>Aksi</td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jadwalSudahSelesai as $key => $a) : ?>
                                    <tr>
                                        <td><?= $a['events']['title'] ?></td>
                                        <td><?= $a['ruangan']['nama'] ?></td>
                                        <td data-sort="<?php echo strtotime($a['events']['start']) ?>">
                                            <?php if ($a['ruangan']['tipe'] == 'Pameran') {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                                echo $formatter->format(date_create($a['events']['start']));
                                            } else {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                                echo $formatter->format(date_create($a['events']['start']));
                                            } ?>
                                        </td>
                                        <td data-sort="<?php echo strtotime($a['events']['start']) ?>">
                                            <?php if ($a['ruangan']['tipe'] == 'Pameran') {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                                echo $formatter->format(date_create($a['events']['selesai']));
                                            } else {
                                                $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                                echo $formatter->format(date_create($a['events']['selesai']));
                                            } ?>
                                        </td>
                                        <!-- <td>
                                            <a href="/dashboard-user/update-sewa-ruangan/<?= $a['uuid'] ?>" class="btn btn-warning">Edit</a>
                                            <form action="/dashboard-user/update-sewa-ruangan" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" value="<?php echo $a['id'] ?>" name="id">
                                                <button class="btn btn-warning" type="submit">Edit</button>
                                            </form>
                                            <form action="/dashboard-user/sewaRuangan/<?php echo $a['id'] ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="nav-kalender" role="tabpanel" aria-labelledby="nav-kalender-tab" tabindex="0">
            <div id="calendar"></div>
            <div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-black border border-0">
                            <h1 class="modal-title fs-4 text-white" id="exampleModalLabel">
                                Detail Kegiatan Penyewaan
                            </h1>

                            <button type="button" class="btn-close bg-pdin-secondary me-1" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="bg-danger w-100" style="height: 4px"></div>
                        <div class="modal-body">
                            <div class="row p-2">
                                <h4 id="judul_kegiatan" class="">-</h4>
                            </div>
                            <div class="row p-2">
                                <div class="col-12 col-lg-6 ps-1">
                                    <!-- nama penyewa -->
                                    <div class="row p-0 m-0 mb-1">
                                        <div class="col-1 m-0 p-0 align-self-start">
                                            <div class="text-center">
                                                <i class="bi bi-person" style="font-size: 14px; color: 8c8c8c"></i>
                                            </div>
                                        </div>
                                        <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                            <small class="mb-1 text-secondary mt-0 pt-0">Nama Penyewa:</small>
                                            <p class="p-0 fw-bold mb-1" id="nama_penyewa">-</p>
                                        </div>
                                    </div>
                                    <!-- kontak penyewa -->
                                    <div class="row p-0 m-0 mb-1">
                                        <div class="col-1 m-0 p-0 align-self-start">
                                            <div class="text-center">
                                                <i class="bi bi-telephone" style="font-size: 14px; color: 8c8c8c"></i>
                                            </div>
                                        </div>
                                        <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                            <small class="mb-1 text-secondary">Kontak Penyewa:</small>
                                            <p class="p-0 fw-bold mb-1" id="kontak">-</p>
                                        </div>
                                    </div>
                                    <!-- Nama Instansi -->
                                    <div class="row p-0 m-0 mb-1">
                                        <div class="col-1 m-0 p-0 align-self-start">
                                            <div class="text-center">
                                                <i class="bi bi-building" style="font-size: 14px; color: 8c8c8c"></i>
                                            </div>
                                        </div>
                                        <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                            <small class="mb-1 text-secondary">Nama Instansi:</small>
                                            <p class="p-0 fw-bold mb-1" id="nama_instansi">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 ps-1">
                                    <!-- Deskripsi Kegiatan -->
                                    <div class="row p-0 m-0 mb-1">
                                        <div class="col-1 m-0 p-0 align-self-start">
                                            <div class="text-center">
                                                <i class="bi bi-activity" style="font-size: 14px; color: 8c8c8c"></i>
                                            </div>
                                        </div>
                                        <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                            <small class="mb-1 text-secondary">Deskripsi Kegiatan:</small>
                                            <p class="p-0 fw-bold mb-1" id="deskripsi_kegiatan">-</p>
                                        </div>
                                    </div>
                                    <!-- Waktu Mulai Sewa -->
                                    <div class="row p-0 m-0 mb-1">
                                        <div class="col-1 m-0 p-0 align-self-start">
                                            <div class="text-center">
                                                <i class="bi bi-calendar-event" style="font-size: 14px; color: 8c8c8c"></i>
                                            </div>
                                        </div>
                                        <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                            <small class="mb-1 text-secondary">Waktu Mulai Sewa:</small>
                                            <p class="p-0 fw-bold mb-1" id="tgl_mulai_sewa">
                                                -
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Waktu Selesai Sewa -->
                                    <div class="row p-0 m-0 mb-1">
                                        <div class="col-1 m-0 p-0 align-self-start">
                                            <div class="text-center">
                                                <i class="bi bi-calendar-event" style="font-size: 14px; color: 8c8c8c"></i>
                                            </div>
                                        </div>
                                        <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                            <small class="mb-1 text-secondary">Waktu Selesai Sewa:</small>
                                            <p class="p-0 fw-bold mb-1" id="tgl_akhir_sewa">
                                                -
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php // echo d($events) 
            ?>
            <?php // echo $pager->links('artikel', 'pager')
            ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
        $('#tablejadwal1').DataTable({
            "order": [
                [3, "asc"]
            ],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
        $('#tablejadwal2').DataTable({
            "order": [
                [3, "asc"]
            ],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
        $('#tablejadwal3').DataTable({
            "order": [
                [3, "asc"]
            ],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>

<!-- Calendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/locales-all.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            // initialView: 'listWeek',
            headerToolbar: {
                right: "today prev,next dayGridMonth,listMonth"
            },
            selectable: true,
            locale: 'id',

            //array sewa -> objek sewa

            events: <?php echo json_encode($events) ?>,

            eventTimeFormat: { // like '14:30:00'
                // day: '2-digit',
                // month: '2-digit',
                // year: '4-digit',
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },

            themeSystem: 'bootstrap5',

            eventClick: function(arg) {
                var mulai;
                var selesai;

                const formatter = new Intl.DateTimeFormat('id-ID', {
                    // dateStyle: "full",
                    // timeStyle: "long",
                    weekday: "long",
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                    timeZone: "Asia/Jakarta",
                });
                const formatter2 = new Intl.DateTimeFormat('id-ID', {
                    // dateStyle: "full",
                    // timeStyle: "long",
                    weekday: "long",
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    timeZoneName: "short",
                    timeZone: "Asia/Jakarta",
                });
                if (arg.event.extendedProps.tipe_ruangan == "Pameran") {
                    mulai = formatter.format(arg.event.start);
                    //  selesai = formatter2.format(arg.event.end);
                    selesai = formatter.format(new Date(arg.event.extendedProps
                        .selesai));

                } else {
                    mulai = formatter2.format(arg.event.start);
                    //  selesai = formatter2.format(arg.event.end);
                    selesai = formatter2.format(new Date(arg.event.extendedProps
                        .selesai));
                };

                $('.modal-header').find('#exampleModalLabel').text(arg.event
                    .extendedProps.nama_ruangan);
                $('.modal-body').find('#judul_kegiatan').text(arg.event
                    .title);
                $('.modal-body').find('#nama_penyewa').text(arg.event
                    .extendedProps
                    .nama);
                $('.modal-body').find('#kontak').text(arg.event
                    .extendedProps
                    .kontak);
                $('.modal-body').find('#nama_instansi').text(arg.event
                    .extendedProps
                    .nama_instansi);
                $('.modal-body').find('#deskripsi_kegiatan').text(arg.event
                    .extendedProps
                    .deskripsi);
                $('.modal-body').find('#tgl_mulai_sewa').text(mulai);
                $('.modal-body').find('#tgl_akhir_sewa').text(selesai);

                $('#modalKegiatan').modal('toggle');
            },
            editable: true,
            dayMaxEvents: false,
        });
        calendar.render();

        $('#navs-tab').click(function() {
            calendar.render();
        });
    });
</script>
<?= $this->endSection() ?>