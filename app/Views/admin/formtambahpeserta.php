<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Tambah Peserta <?= $pelatihan['nama_pelatihan'] ?></h3>

    <!-- === Nav === -->
    <div class="col mt-1">
        <ul class="nav nav-tabs nav-justified" role="tablist" id="navs-tab-2">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="peserta-lama" data-bs-toggle="tab" data-bs-target="#tab-peserta-lama" role="tab" aria-controls="tab-peserta-lama" aria-selected="true">Peserta Lama</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="peserta-baru" data-bs-toggle="tab" data-bs-target="#tab-peserta-baru" role="tab" aria-controls="tab-peserta-baru" aria-selected="false">Peserta Baru</button>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane active" id="tab-peserta-lama" role="tabpanel" aria-labelledby="peserta-lama" tabindex="0">
            <form id="tambahpesertalama" class="mt-3" action="/DashboardAdmin/saveTambahPesertaLama" method="post">
                <?php echo csrf_field() ?>
                <div class="row g-3">
                    <?= \Config\Services::validation()->listErrors() ?>

                    <div class="col-12">
                        <label for="peserta" class="form-label">Peserta &emsp;
                            <!-- <span id="ubahpeserta">ubah</span> -->
                        </label>
                        <select class="form-select <?= (validation_show_error('peserta')) ? 'is-invalid' : ''; ?>" aria-label="Default select" id="peserta" name="peserta">
                            <option selected disabled>Pilih Peserta</option>
                            <?php foreach ($peserta as $p) : ?>

                                <option value="<?= $p['id'] ?>">
                                    <?= $p['nama'] . ' - ' . $p['email'] ?>
                                </option>

                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('peserta'); ?>
                        </div>
                    </div>

                    <input type="hidden" name="uuid" value="<?= old('uuid') ? old('uuid') : $pelatihan['uuid'] ?>" id="uuid">
                    <input type="hidden" name="id_pelatihan" value="<?= old('id_pelatihan') ? old('id_pelatihan') : $pelatihan['id'] ?>" id="id_pelatihan">
                    <button class="w-100 btn btn-danger mt-5 mb-5" type="submit" id="submit">Tambah Peserta</button>

                </div>
            </form>
        </div>
        <div class="tab-pane" id="tab-peserta-baru" role="tabpanel" aria-labelledby="peserta-baru" tabindex="0">
            <form id="tambahpesertabaru" class="mt-3" action="/DashboardAdmin/saveTambahPesertaBaru" method="post">
                <?php echo csrf_field() ?>
                <div class="row g-3">
                    <?= \Config\Services::validation()->listErrors() ?>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama Peserta</label>
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
                        <label for="kontak" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control <?= (validation_show_error('kontak')) ? 'is-invalid' : ''; ?>" id="kontak" placeholder="6281234567890" name="kontak" value="<?= old('kontak') ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kontak'); ?>
                        </div>
                    </div>

                    <input type="hidden" name="uuid" value="<?= old('uuid') ? old('uuid') : $pelatihan['uuid'] ?>" id="uuid">
                    <input type="hidden" name="id_pelatihan" value="<?= old('id_pelatihan') ? old('id_pelatihan') : $pelatihan['id'] ?>" id="id_pelatihan">
                    <button class="w-100 btn btn-danger mt-5 mb-5" type="submit" id="submit">Tambah Peserta</button>

                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->endSection() ?>