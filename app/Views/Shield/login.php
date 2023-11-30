<?= $this->extend('layout/auth/template') ?>

<?= $this->section('content') ?>
<!-- <section id="section-konten"> -->
<div class="container d-flex justify-content-center p-5">
    <div class="container-konten col-12 col-md-8 col-xl-5">
        <div class="card-body">
            <h5 class="card-title mb-5"><?= lang('Auth.login') ?></h5>

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

            <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
            <?php endif ?>

            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="mb-2">
                    <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required />
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <input type="password" class="form-control" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required />
                </div>

                <!-- Remember me -->
                <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked<?php endif ?>>
                            <?= lang('Auth.rememberMe') ?>
                        </label>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-danger w-100 mt-2 mb-2"><?= lang('Auth.login') ?></button>

                <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                    <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
                <?php endif ?>

            </form>
            <div class="row mt-4 mb-2">
                <button type="button" class="btn btn-outline-dark w-100 mb-2">
                    <i class="bi bi-google me-2"></i>
                    Masuk dengan Google
                </button>
                <button type="button" class="btn btn-outline-primary w-100">
                    <i class="bi bi-github me-2"></i>
                    Masuk dengan GitHub
                </button>
            </div>
            <div class="row">
                <?php if (setting('Auth.allowRegistration')) : ?>
                    <p class="text-center"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- </section> -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js' integrity='sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js' integrity='sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk' crossorigin='anonymous'></script>
<?= $this->endSection() ?>