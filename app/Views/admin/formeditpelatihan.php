<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Edit Pelatihan</h3>
    <form id="formpelatihan" class="mt-3" action="/DashboardAdmin/saveUpdatePelatihan" method="post" enctype="multipart/form-data">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="namaPelatihan" class="form-label">Nama Pelatihan</label>
                <input type="text" class="form-control <?= (validation_show_error('namaPelatihan')) ? 'is-invalid' : ''; ?>" id="namaPelatihan" placeholder="" value="<?= old('namaPelatihan') ? old('namaPelatihan') : $pelatihan['nama_pelatihan'] ?>" name="namaPelatihan" autofocus required>
                <div class="invalid-feedback">
                    <?= validation_show_error('namaPelatihan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiPelatihan" class="form-label">Deskripsi Pelatihan</label>
                <textarea class="form-control <?= (validation_show_error('deskripsiPelatihan')) ? 'is-invalid' : ''; ?>" id="deskripsiPelatihan" placeholder="" name="deskripsiPelatihan"><?= old('deskripsiPelatihan') ? old('deskripsiPelatihan') : $pelatihan['deskripsi_pelatihan'] ?></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiPelatihan'); ?>
                </div>
            </div>

            <?php $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-dd'); ?>
            <?php $formatter2 = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'hh:mm'); ?>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                    <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulai')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalMulai" value="<?= old('tanggalMulai') ? old('tanggalMulai') : $formatter->format(date_create($pelatihan['tgl_mulai'])) ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                    <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesai')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalSelesai" value="<?= old('tanggalSelesai') ? old('tanggalSelesai') : $formatter->format(date_create($pelatihan['tgl_selesai'])) ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesai'); ?>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                    <input id="waktuMulai" class="form-control <?= (validation_show_error('waktuMulai')) ? 'is-invalid' : ''; ?>" type="time" name="waktuMulai" value="<?= old('waktuMulai') ? old('waktuMulai') : $formatter2->format(date_create($pelatihan['waktu_mulai'])) ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('waktuMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                    <input id="waktuSelesai" class="form-control <?= (validation_show_error('waktuSelesai')) ? 'is-invalid' : ''; ?>" type="time" name="waktuSelesai" value="<?= old('waktuSelesai') ? old('waktuSelesai') : $formatter2->format(date_create($pelatihan['waktu_selesai'])) ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('waktuSelesai'); ?>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= old('id') ? old('id') : $pelatihan['id'] ?>" />
            <input type="hidden" name="uuid" value="<?= old('uuid') ? old('uuid') : $uuid ?>" />

            <button class="w-100 btn btn-danger mt-5" type="submit">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    var start = document.getElementById('tanggalMulai');
    var end = document.getElementById('tanggalSelesai');
    var tanggal = new Date();
    var dd = String(tanggal.getDate()).padStart(2, '0');
    var mm = String(tanggal.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = tanggal.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;
    // start.min = today;
    // end.min = today;

    start.addEventListener('change', function() {
        if (start.value)
            end.min = start.value;
    }, false);
    end.addEventListener('change', function() {
        if (end.value)
            start.max = end.value;
    }, false);
</script>

<?= $this->endSection() ?>