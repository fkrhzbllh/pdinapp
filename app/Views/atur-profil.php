<?= $this->extend('layout/user/user-template') ?>

<? //= $this->section('title') 
?>
<!-- Atur Profil -->
<? //= $this->endSection() 
?>

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

<!-- Pesan sukses -->
<?php if (session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
    </div>
<?php endif; ?>

<!-- Foto profil -->
<div class="text-center mt-5 mb-5">
    <img class="mb-3" src="https://ui-avatars.com/api/?size=128&name=<?= urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) ?>&rounded=true&background=d82328&color=ffffff&bold=true" alt="" />
    <h2 class="fw-bold mb-5"><?= auth()->user()->first_name ?> (<?= auth()->user()->getGroups()[0] ?>)</h2>
</div>

<h4>Atur Profil</h4>
<p>Atur nama depan dan nama belakang di bawah ini.
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
    <p>Dengan mengganti Email, Anda setuju untuk mengubah Email identitas penyewa dan peserta Anda.</p>
    <div class="mb-2">
        <input type="email" class="form-control" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= auth()->user()->getEmail() ?>" required />
    </div>

    <button type="submit" class="btn btn-danger w-100 mt-2 mb-2"><?= lang('Auth.send') ?></button>

</form>

<h4>Atur kata sandi</h4>
<form action="<?= url_to('atur-profil-kata-sandi') ?>" method="post">
    <?= csrf_field() ?>

    <p>Masukkan kata sandi Anda yang sekarang.</p>
    <!-- Password lama -->
    <div class="mb-2">
        <input type="password" class="form-control" name="old_password" placeholder="<?= lang('Auth.password') ?> Lama" value="" required />
    </div>
    <p>Buat kata sandi Anda yang baru.</p>
    <!-- Password baru -->
    <div class="mb-2">
        <input type="password" class="form-control" name="password" autocomplete="password" placeholder="<?= lang('Auth.password') ?>" value="" required />
    </div>
    <!-- Ulang password baru -->
    <div class="mb-2">
        <input type="password" class="form-control" name="password_confirm" autocomplete="password_confirm" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="" required />
    </div>

    <button type="submit" class="btn btn-danger w-100 mt-2 mb-2"><?= lang('Auth.send') ?></button>

</form>

<?= $this->endSection() ?>