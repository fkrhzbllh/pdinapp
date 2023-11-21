<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="container">
    <form id="sewaalat" class="mt-3" action="/DashboardAdmin/saveTambahSewaAlat" method="post">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <h3>Sewa Alat</h3>
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama Penyewa</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ?>" name="nama" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <!-- <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username" placeholder="Username" required="">
                    <div class="invalid-feedback">
                        Your username is required.
                    </div>
                </div>
            </div> -->

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="you@example.com" name="email" value="<?= old('email') ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('email'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?= (validation_show_error('nomorTelepon')) ? 'is-invalid' : ''; ?>" id="nomorTelepon" placeholder="6281234567890" name="nomorTelepon" value="<?= old('nomorTelepon') ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('nomorTelepon'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text" class="form-control <?= (validation_show_error('instansi')) ? 'is-invalid' : ''; ?>" id="instansi" placeholder="" value="<?= old('instansi') ?>" name="instansi">
                <div class="invalid-feedback">
                    <?= validation_show_error('instansi'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('namaKegiatan')) ? 'is-invalid' : ''; ?>" id="kegiatan" placeholder="" value="<?= old('namaKegiatan') ?>" name="namaKegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('namaKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                <input type="text" class="form-control <?= (validation_show_error('deskripsiKegiatan')) ? 'is-invalid' : ''; ?>" id="deskripsiKegiatan" placeholder="" value="<?= old('deskripsiKegiatan') ?>" name="deskripsiKegiatan">
                <div class="invalid-feedback">
                    <?= validation_show_error('deskripsiKegiatan'); ?>
                </div>
            </div>

            <div class="col-12">
                <label for="alat" class="form-label">Alat yang Dipinjam &emsp;
                    <!-- <span id="ubahruangan">ubah</span> -->
                </label>
                <select class="form-select <?= (validation_show_error('alat')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="alat" name="alat">
                    <option selected disabled>Pilih Alat</option>
                    <?php foreach ($alat as $a) : ?>
                        <?php if ($id_alat == $a['id'] || old('alat') == $a['id']) : ?>
                            <option selected value="<?= $a['id'] ?>">
                                <?= $a['nama'] ?>
                            </option>
                        <?php else : ?>
                            <option value="<?= $a['id'] ?>">
                                <?= $a['nama'] ?>
                            </option>
                            <?= d($a['id']) ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('alat'); ?>
                </div>
            </div>

            <?php $formatter2 = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'yyyy-MM-ddThh:mm'); ?>

            <div class="row">
                <div class="col-sm-6">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                    <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulai" value="<?= old('tanggalMulai') ?>" step="3600" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalMulai'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                    <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesai" value="<?= old('tanggalSelesai') ?>" step="60" />
                    <div class="invalid-feedback">
                        <?= validation_show_error('tanggalSelesai'); ?>
                    </div>
                </div>
            </div>
        </div>
        <button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit" id="submit">Sewa Alat</button>
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


<script>
    var submit = document.getElementById('submit');
    submit.addEventListener('click', function() {
        var ruangan = document.getElementById('ruangan');
        ruangan.removeAttribute('disabled');
    });
</script>
<?= $this->endSection() ?>