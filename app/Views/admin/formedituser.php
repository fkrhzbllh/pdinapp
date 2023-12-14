<?= $this->extend('layout/admin/admin-template') ?>

<?= $this->section('content') ?>

<div class="bg-white col-12 p-5">
    <h3 class="mb-3"><?= 'Edit User' ?></h3>

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

    <form action="<?= '/DashboardAdmin/saveUpdateUser/' ?>" method="post">
        <?= csrf_field() ?>
        <?= \Config\Services::validation()->listErrors() ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <input type="email" class="form-control" value="<?= old('email') ? old('email') : $user['secret'] ?>" name="email" inputmode="email" autocomplete="email" required>
            </div>
            <div class="invalid-feedback">
                <?= validation_show_error('email'); ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
                <input type="username" class="form-control" value="<?= old('username') ? old('username') : $user['username'] ?>" name="username" inputmode="text" autocomplete="username" required>
            </div>
            <div class="invalid-feedback">
                <?= validation_show_error('username'); ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">Nama Depan</label>
            <div class="input-group">
                <input type="text" class="form-control" value="<?= old('first_name') ? old('first_name') : $user['first_name'] ?>" name="first_name" inputmode="text" autocomplete="first_name" required>
            </div>
            <div class="invalid-feedback">
                <?= validation_show_error('first_name'); ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Nama Belakang</label>
            <div class="input-group">
                <input type="text" class="form-control" value="<?= old('last_name') ? old('last_name') : $user['last_name'] ?>" name="last_name" inputmode="text" autocomplete="last_name" required>
            </div>
            <div class="invalid-feedback">
                <?= validation_show_error('last_name'); ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="grup" class="form-label">Grup</label>
            <div class="input-group">
                <select name="group" class="form-select ms-auto" aria-label="Default select example">
                    <option selected value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="pemerintah">Pemerintah</option>
                    <option value="perusahaan">Perusahaan</option>
                    <option value="pelajar">Pelajar</option>
                    <option value="mitra">Mitra</option>
                </select>
            </div>
        </div>

        <!-- <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" value="<?= old('password') ?>" name="password" inputmode="text" autocomplete="new-password" required>
            </div>
            <div class="invalid-feedback">
                <?= validation_show_error('password'); ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirm" class="form-label">Konfirmasi Password</label>
            <div class="input-group">
                <input type="password" class="form-control" value="<?= old('password_confirm') ?>" name="password_confirm" inputmode="text" autocomplete="new-password" required>
            </div>
            <div class="invalid-feedback">
                <?= validation_show_error('email'); ?>
            </div>
        </div> -->

        <input type="hidden" name="id" value="<?= old('id') ? old('id') : $user['id'] ?>" />
        <input type="hidden" name="uuid" value="<?= old('uuid') ? old('uuid') : $uuid ?>" />
        <input type="hidden" name="username_old" value="<?= old('username_old') ? old('username_old') : $user['username'] ?>" />
        <input type="hidden" name="email_old" value="<?= old('email_old') ? old('email_old') : $user['secret'] ?>" />

        <div class="d-grid col-12 col-md-8 mx-auto m-3">
            <button type="submit" class="btn btn-danger btn-block"><?= 'Edit User' ?></button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>