<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="bg-white col-12 p-5" id="">
    <h3 class="mb-3">Tambah Pelatihan</h3>

    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
    <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
                <?php foreach (session('errors') as $error) : ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
            <?php else : ?>
                <?= session('errors') ?>
            <?php endif ?>
        </div>
    <?php endif ?>

    <form id="formpelatihan" class="mt-3" action="/DashboardAdmin/saveTambahPelatihan" method="post" enctype="multipart/form-data">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="namaPelatihan" class="form-label">Nama Pelatihan</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="namaPelatihan" placeholder="" value="<?= old('namaPelatihan') ?>" name="namaPelatihan" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('namaPelatihan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiPelatihan" class="form-label">Deskripsi Pelatihan</label>
                <textarea class="form-control <?= (validation_show_error('deskripsiPelatihan')) ? 'is-invalid' : ''; ?>" id="deskripsiPelatihan" placeholder="" value="<?= old('deskripsiPelatihan') ?>" name="deskripsiPelatihan"></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiPelatihan'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                    <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulai')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalMulai" value="<?= old('tanggalMulai') ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                    <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesai')) ? 'is-invalid' : ''; ?>" type="date" name="tanggalSelesai" value="<?= old('tanggalSelesai') ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesai'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                    <input id="waktuMulai" class="form-control <?= (validation_show_error('waktuMulai')) ? 'is-invalid' : ''; ?>" type="time" name="waktuMulai" value="<?= old('waktuMulai') ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('waktuMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                    <input id="waktuSelesai" class="form-control <?= (validation_show_error('waktuSelesai')) ? 'is-invalid' : ''; ?>" type="time" name="waktuSelesai" value="<?= old('waktuSelesai') ?>" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('waktuSelesai'); ?>
                    </div>
                </div>
            </div>

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
    start.min = today;
    end.min = today;

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