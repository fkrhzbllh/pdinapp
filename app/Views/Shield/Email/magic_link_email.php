<html>

<head>
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= lang('Auth.magicLinkSubject') ?></title>
</head>

<body>
    <br>
    <b><?= lang('Auth.magicLinkSubject') ?>, <?= lang('Auth.login') ?>:</b>
    <br>
    <a href="<?= url_to('verify-magic-link') ?>?token=<?= $token ?>"><?= lang('Auth.login') ?></a>
    <br>
    <br>
    <b><?= lang('Auth.emailInfo') ?></b>
    <p><?= lang('Auth.emailIpAddress') ?> <?= esc($ipAddress) ?></p>
    <p><?= lang('Auth.emailDevice') ?> <?= esc($userAgent) ?></p>
    <p><?= lang('Auth.emailDate') ?> <?= esc($date) ?></p>
</body>

</html>