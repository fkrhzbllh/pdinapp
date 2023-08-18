<div class="px-5 pt-3 pb-5 col-12 bg-white">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/DashboardAdmin/ruangan">Ruangan</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo 'Sewa' . $ruangan['nama'] ?>
            </li>
        </ol>
    </nav>
    <?php if(session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
    </div>
    <?php elseif(session()->getFlashdata('gagal')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('gagal') ?>
    </div>
    <?php endif; ?>
    <h3 class="mb-3">Sewa <?= $ruangan['nama'] ?>
    </h3>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="row">
                <div class="col-6 col-md-6">
                    <a class="btn btn-outline-danger mb-3"
                        href="<?= base_url() . 'DashboardAdmin/tambah-sewa-ruangan/' . $ruangan['slug']?>">Tambah
                        Sewa Ruangan</a>
                </div>
                <!-- === Nav === -->
                <div class="col-6 col-md-6">
                    <ul class="nav nav-underline justify-content-end" role="tablist" id="navs-tab">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tabel-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-tabel" role="tab" aria-controls="nav-tabel" aria-selected="true"><i
                                    class="bi bi-table me-1"></i>Tabel</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-kalender-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-kalender" role="tab" aria-controls="nav-kalender"
                                aria-selected="false"><i class="bi bi-calendar-event me-1"></i>Kalender</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- input pencarian -->
        <!-- <div class="col-12 col-md-6">
            <form action="" method="post">
                <div class="input-group mb-3 ps-5">
                    <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Ruangan"
                        aria-label="" aria-describedby="" id="" name="keyword" />
                    <div class="input-group-append">
                        <div class="tooltip"></div>
                        <button class="btn btn-danger rounded-start-0" type="submit">
                            <span class="bi bi-search"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div> -->
    </div>
    <div class="tab-content" id="navs-tabContent">
        <div class="tab-pane fade show active" id="nav-tabel" role="tabpanel" aria-labelledby="nav-tabel-tab"
            tabindex="0">
            <div class="table-responsive">
                <table class="table align-middle table-bordered" id="tablejadwal" style="width: 100%;">
                    <thead>
                        <tr>
                            <!-- <td>No</td> -->
                            <td>Nama Kegiatan</td>
                            <td>Nama Penyewa</td>
                            <td>No. Telepon</td>
                            <!-- <td>Instansi</td> -->
                            <td>Waktu Mulai Sewa</td>
                            <td>Waktu selesai Sewa</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jadwal as $key => $a):?>
                        <tr>
                            <!-- <td><?php // echo ($pager_current - 1) * $per_page + ($key + 1)?>
                            </td> -->
                            <td><?= $a['nama_kegiatan']?>
                            </td>
                            <td><?= $penyewa[$key]['nama']?>
                            </td>
                            <td><?= $penyewa[$key]['kontak']?>
                            </td>
                            <!-- <td><?= $penyewa[$key]['nama_instansi'] ?>
                            </td> -->
                            <td
                                data-sort="<?php echo strtotime($a['tgl_mulai_sewa'])?>">
                                <?php if($ruangan['tipe'] == 'Pameran') {
                                	$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                	echo $formatter->format(date_create($a['tgl_mulai_sewa']));
                                } else {
                                	$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                	echo $formatter->format(date_create($a['tgl_mulai_sewa']));
                                } ?>
                            </td>
                            <td
                                data-sort="<?php echo strtotime($a['tgl_mulai_sewa'])?>">
                                <?php if($ruangan['tipe'] == 'Pameran') {
                                	$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
                                	echo $formatter->format(date_create($a['tgl_akhir_sewa']));
                                } else {
                                	$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy HH:mm z');
                                	echo $formatter->format(date_create($a['tgl_akhir_sewa']));
                                } ?>
                            </td>
                            <td>
                                <!-- <a href="/DashboardAdmin/update-sewa-ruangan/<?= $a['id'] ?>"
                                class="btn btn-warning">Edit</a> -->
                                <form action="/DashboardAdmin/update-sewa-ruangan" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden"
                                        value="<?php echo $a['id']?>"
                                        name="id">
                                    <button class="btn btn-warning" type="submit">Edit</button>
                                </form>
                                <form
                                    action="/DashboardAdmin/sewaRuangan/<?php echo $a['id']?>"
                                    method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-kalender" role="tabpanel" aria-labelledby="nav-kalender-tab" tabindex="0">
            <div id="calendar"></div>
            <div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-black border border-0">
                            <h1 class="modal-title fs-4 text-white" id="exampleModalLabel">
                                Detail Kegiatan Penyewaan
                            </h1>

                            <button type="button" class="btn-close bg-secondary me-1" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                                                <i class="bi bi-calendar-event"
                                                    style="font-size: 14px; color: 8c8c8c"></i>
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
                                                <i class="bi bi-calendar-event"
                                                    style="font-size: 14px; color: 8c8c8c"></i>
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
            <?php  echo d($events)?>
            <?php // echo $pager->links('artikel', 'pager')?>
        </div>

        <script>
            $(document).ready(function() {
                $('#tablejadwal').DataTable({
                    "columns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        {
                            "width": "15%"
                        }
                    ],
                    "order": [
                        [3, "asc"]
                    ]
                });
            });
        </script>

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
                    events: <?php echo json_encode($events)?> , //array sewa -> objek sewa

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

                        // $('.modal-body').find('#tgl_akhir_sewa').text(arg.event.end);
                        // $('.modal-body').find('#tempat').text(arg.event
                        //     .extendedProps.tempat);
                        // $('.modal-body').find('#link_pendaftaran').text(arg
                        //     .event.extendedProps
                        //     .link_pendaftaran);
                        // $('.modal-body').find('#link_pendaftaran').attr("href",
                        //     arg.event.extendedProps
                        //     .link_pendaftaran);
                        // $('.modal-body').find('#link_virtual').text(arg.event
                        //     .extendedProps
                        //     .link_virtual);
                        // $('.modal-body').find('#link_virtual').attr("href", arg
                        //     .event.extendedProps
                        //     .link_virtual);
                        // $('.modal-body').find('#poster').attr('src', arg.event
                        //     .extendedProps.poster);
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