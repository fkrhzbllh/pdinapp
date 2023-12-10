<?= $this->extend('layout/auth/template') ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<br>
<p><b><?= lang('Auth.checkYourEmail') ?></b></p>

<p><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>

<?= $this->endSection() ?>