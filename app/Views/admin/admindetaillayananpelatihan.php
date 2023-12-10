<?= $this->extend('layout/admin/admin-template') ?>

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
    <h3 class="mb-3"><?= $pelatihan['nama_pelatihan'] ?></h3>

    <p class="mb-2"><?= $pelatihan['deskripsi_pelatihan'] ?></p>

    <?php
    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy');
    $formatter2 = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'hh:mm z');
    ?>

    <p class="mb-2 fw-bold" style="font-size: medium;"><?= $formatter->format(date_create($pelatihan['tgl_mulai'])) . ' - ' . $formatter->format(date_create($pelatihan['tgl_selesai'])) ?></p>

    <p class="mb-2"><?= $formatter2->format(date_create($pelatihan['waktu_mulai'])) . ' - ' . $formatter2->format(date_create($pelatihan['waktu_selesai'])) ?></p>

    <div class="col-6 col-md-6">
        <a class="btn btn-outline-danger mb-3" href="<?= base_url() . 'DashboardAdmin/tambah-peserta/' . $pelatihan['uuid'] ?>">Tambah
            Peserta</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped display" id="tablejadwal1" style="width: 100%;">
            <thead>
                <tr>
                    <!-- <td>No</td> -->
                    <td>Nama Peserta</td>
                    <td>Email</td>
                    <td>Kontak</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peserta as $key => $a) : ?>
                    <tr>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['email'] ?></td>
                        <td><?= $a['kontak'] ?></td>
                        <td>
                            <a href="/DashboardAdmin/update-peserta/<?= $a['uuid_peserta_pelatihan'] ?>" class="btn btn-warning">Edit</a>
                            <!-- <form action="/DashboardAdmin/update-peserta" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" value="<?php echo $a['uuid_peserta_pelatihan'] ?>" name="uuid">
                                <button class="btn btn-warning" type="submit">Edit</button>
                            </form> -->
                            <form action="/DashboardAdmin/peserta/<?php echo $a['id_peserta_pelatihan'] . '/' . $a['id_pelatihan'] . '/' . $pelatihan['uuid'] ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
        $('#tablejadwal1').DataTable({
            "columns": [
                null,
                null,
                null,
                {
                    "width": "15%"
                }
            ],
            "order": [
                [2, "asc"]
            ],
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
<?= $this->endSection() ?>