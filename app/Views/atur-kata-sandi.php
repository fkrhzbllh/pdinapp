<?= $this->extend('layout/auth/template') ?>

<?= $this->section('title') ?>
<?= lang('Auth.login') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Pesan error -->
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

<form action="<?= url_to('atur-password') ?>" method="post">
    <?= csrf_field() ?>

    <!-- Email -->
    <div class="mb-2">
        <input type="password" class="form-control" name="password" autocomplete="password" placeholder="<?= lang('Auth.password') ?>" value="" required />
    </div>
    <!-- Email -->
    <div class="mb-2">
        <input type="password" class="form-control" name="password_confirm" autocomplete="password_confirm" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="" required />
    </div>

    <button type="submit" class="btn btn-danger w-100 mt-2 mb-2"><?= lang('Auth.send') ?></button>


</form>

<?= $this->endSection() ?>