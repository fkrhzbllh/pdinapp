<?= $this->extend('layout/auth/template') ?>

<?= $this->section('title') ?>
<?= lang('Auth.register') ?>
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

<form action="<?= url_to('register') ?>" method="post">
    <?= csrf_field() ?>

    <!-- Email -->
    <div class="mb-2">
        <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required />
    </div>

    <!-- Username -->
    <div class="mb-4">
        <input type="text" class="form-control" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required />
    </div>

    <!-- Password -->
    <div class="mb-2">
        <input type="password" class="form-control" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required />
    </div>

    <!-- Password (Again) -->
    <div class="mb-4">
        <input type="password" class="form-control" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required />
    </div>

    <button type="submit" class="btn btn-danger w-100 mt-2 mb-2"><?= lang('Auth.register') ?></button>

    <p class="text-center"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>

</form>

<a href="<?= base_url('oauth/google') ?>">
    <button type="button" class="btn btn-outline-dark w-100 mb-2">
        <i class="bi bi-google me-2"></i>
        Masuk dengan Google
    </button>
</a>

<a href="<?= base_url('oauth/github') ?>">
    <button type="button" class="btn btn-outline-primary w-100">
        <i class="bi bi-github me-2"></i>
        Masuk dengan GitHub
    </button>
</a>
<?= $this->endSection() ?>