<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h3>Ubah Data Peserta</h3>

    <form id="updatepesertabaru" class="mt-3" action="/DashboardAdmin/saveUpdatePeserta" method="post">
        <?php echo csrf_field() ?>
        <div class="row g-3">
            <?= \Config\Services::validation()->listErrors() ?>
            <div class="col-12">
                <label for="nama" class="form-label">Nama Peserta</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="" value="<?= old('nama') ? old('nama') : $peserta['nama'] ?>" name="nama" autofocus>
                <div class="invalid-feedback">
                    <?= validation_show_error('nama'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="you@example.com" name="email" value="<?= old('email') ? old('email') : $peserta['email'] ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('email'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <label for="kontak" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?= (validation_show_error('kontak')) ? 'is-invalid' : ''; ?>" id="kontak" placeholder="6281234567890" name="kontak" value="<?= old('kontak') ? old('kontak') : $peserta['kontak'] ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('kontak'); ?>
                </div>
            </div>

            <input type="hidden" name="emailLama" value="<?= old('emailLama') ? old('emailLama') : $peserta['email'] ?>" id="emailLama">
            <input type="hidden" name="id" value="<?= old('id') ? old('id') : $peserta['id'] ?>" id="id">
            <input type="hidden" name="uuidPeserta" value="<?= old('uuidPeserta') ? old('uuidPeserta') : $uuidPeserta ?>" id="uuidPeserta">
            <input type="hidden" name="uuidPelatihan" value="<?= old('uuidPelatihan') ? old('uuidPelatihan') : $uuidPelatihan ?>" id="uuidPelatihan">
            <button class="w-100 btn btn-primary btn-lg mt-5 mb-5" type="submit" id="submit">Ubah Peserta</button>

        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->endSection() ?>