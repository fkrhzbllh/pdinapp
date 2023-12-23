<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Sewa Alat</h3>

    <!-- === Nav === -->
    <div class="col mt-1">
        <ul class="nav nav-tabs nav-justified" role="tablist" id="navs-tab-2">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="penyewa-lama" data-bs-toggle="tab" data-bs-target="#tab-penyewa-lama" role="tab" aria-controls="tab-penyewa-lama" aria-selected="true">Penyewa Lama</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="penyewa-baru" data-bs-toggle="tab" data-bs-target="#tab-penyewa-baru" role="tab" aria-controls="tab-penyewa-baru" aria-selected="false">Penyewa Baru</button>
            </li>
        </ul>
    </div>

    <!-- koknten tab -->
    <div class="tab-content">
        <!-- tab tambah penyewa lama -->
        <div class="tab-pane active" id="tab-penyewa-lama" role="tabpanel" aria-labelledby="penyewa-lama" tabindex="0">
            <form id="sewaalat" class="mt-3" action="/DashboardAdmin/saveTambahSewaAlatPenyewaLama" method="post">
                <?php echo csrf_field() ?>
                <div class="row g-3">
                    <?= \Config\Services::validation()->listErrors() ?>

                    <div class="col-12">
                        <label for="penyewa" class="form-label">Penyewa &emsp;
                        </label>
                        <select class="form-select <?= (validation_show_error('penyewa')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="penyewa" name="penyewa">
                            <option selected disabled>Pilih Penyewa</option>
                            <?php foreach ($penyewa as $p) : ?>

                                <option value="<?= $p['id'] ?>">
                                    <?= $p['nama'] . ' - ' . $p['email'] ?>
                                </option>

                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('penyewa'); ?>
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
                            <input id="tanggalMulai" class="form-control <?= (validation_show_error('tanggalMulai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulai" value="<?= old('tanggalMulai') ?>" />
                            <div class="invalid-feedback">
                                <?= validation_show_error('tanggalMulai'); ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                            <input id="tanggalSelesai" class="form-control <?= (validation_show_error('tanggalSelesai')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesai" value="<?= old('tanggalSelesai') ?>" />
                            <div class="invalid-feedback">
                                <?= validation_show_error('tanggalSelesai'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="w-100 btn btn-danger mt-5 mb-5" type="submit" id="submit">Sewa Alat</button>
            </form>
        </div>

        <!-- tab tambah penyewa baru -->
        <div class="tab-pane" id="tab-penyewa-baru" role="tabpanel" aria-labelledby="penyewa-baru" tabindex="0">
            <form id="tambahpenyewabaru" class="mt-3" action="/DashboardAdmin/saveTambahSewaAlatPenyewaBaru" method="post">
                <?php echo csrf_field() ?>
                <div class="row g-3">
                    <?= \Config\Services::validation()->listErrors() ?>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama Penyewa</label>
                        <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ?>" name="nama" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>

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
                        <label for="kegiatanPenyewaBaru" class="form-label">Nama Kegiatan</label>
                        <input type="text" class="form-control <?= (validation_show_error('namaKegiatanPenyewaBaru')) ? 'is-invalid' : ''; ?>" id="kegiatanPenyewaBaru" placeholder="" value="<?= old('namaKegiatanPenyewaBaru') ?>" name="namaKegiatanPenyewaBaru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('namaKegiatanPenyewaBaru'); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="deskripsiKegiatanPenyewaBaru" class="form-label">Deskripsi Kegiatan</label>
                        <input type="text" class="form-control <?= (validation_show_error('deskripsiKegiatanPenyewaBaru')) ? 'is-invalid' : ''; ?>" id="deskripsiKegiatanPenyewaBaru" placeholder="" value="<?= old('deskripsiKegiatanPenyewaBaru') ?>" name="deskripsiKegiatanPenyewaBaru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('deskripsiKegiatanPenyewaBaru'); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="alatPenyewaBaru" class="form-label">Alat yang Dipinjam &emsp;
                        </label>
                        <select class="form-select <?= (validation_show_error('alatPenyewaBaru')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="alatPenyewaBaru" name="alatPenyewaBaru">
                            <option selected disabled>Pilih Alat</option>
                            <?php foreach ($alat as $a) : ?>
                                <?php if ($id_alat == $a['id'] || old('alatPenyewaBaru') == $a['id']) : ?>
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
                            <?= validation_show_error('alatPenyewaBaru'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="tanggalMulai2" class="form-label">Tanggal Mulai</label>
                            <input id="tanggalMulai2" class="form-control <?= (validation_show_error('tanggalMulaiPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalMulaiPenyewaBaru" value="<?= old('tanggalMulaiPenyewaBaru') ?>" />
                            <div class="invalid-feedback">
                                <?= validation_show_error('tanggalMulaiPenyewaBaru'); ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="tanggalSelesai2" class="form-label">Tanggal Selesai</label>
                            <input id="tanggalSelesai2" class="form-control <?= (validation_show_error('tanggalSelesaiPenyewaBaru')) ? 'is-invalid' : ''; ?>" type="datetime-local" name="tanggalSelesaiPenyewaBaru" value="<?= old('tanggalSelesaiPenyewaBaru') ?>" />
                            <div class="invalid-feedback">
                                <?= validation_show_error('tanggalSelesaiPenyewaBaru'); ?>
                            </div>
                        </div>
                    </div>

                    <button class="w-100 btn btn-danger mt-5 mb-5" type="submit" id="submitPenyewaBaru">Sewa Alat</button>

                </div>
            </form>
        </div>
    </div>
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
    var start = document.getElementById('tanggalMulai2');
    var end = document.getElementById('tanggalSelesai2');
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
        var alat = document.getElementById('alat');
        alat.removeAttribute('disabled');
    });
</script>

<script>
    var submit = document.getElementById('submitPenyewaBaru');
    submit.addEventListener('click', function() {
        var alat = document.getElementById('alat');
        alat.removeAttribute('disabled');
    });
</script>
<?= $this->endSection() ?>