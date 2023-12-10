<?= $this->extend('layout/auth/template') ?>

<?= $this->section('title') ?>
Atur Profil
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="text-center mb-5">
    <img class="mb-3" src="https://ui-avatars.com/api/?size=128&name=<?= urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) ?>&rounded=true&background=d82328&color=ffffff&bold=true" alt="" />
    <h2 class="fw-bold mb-5"><?= auth()->user()->first_name ?></h2>
</div>
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
<h4>Atur Profil</h4>
<form action="<?= url_to('atur-profil') ?>" method="post" class="mb-4">
    <?= csrf_field() ?>

    <!-- Nama Depan -->
    <div class="mb-2">
        <input type="text" class="form-control" name="first_name" placeholder="Nama Depan" value="<?= auth()->user()->first_name ?>" required />
    </div>
    <!-- Nama Belakang -->
    <div class="mb-2">
        <input type="text" class="form-control" name="last_name" placeholder="Nama Belakang" value="<?= auth()->user()->last_name ?>" required />
    </div>
    <!-- Email -->
    <div class="mb-2">
        <input type="email" class="form-control" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= auth()->user()->getEmail() ?>" required />
    </div>

    <button type="submit" class="btn btn-danger w-100 mt-2 mb-2"><?= lang('Auth.send') ?></button>

</form>

<h4>Atur kata sandi</h4>
<form action="<?= url_to('atur-password') ?>" method="post">
    <?= csrf_field() ?>

    <!-- Email -->
    <div class="mb-2">
        <input type="password" class="form-control" name="old_password" placeholder="<?= lang('Auth.password') ?> Lama" value="" required />
    </div>
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