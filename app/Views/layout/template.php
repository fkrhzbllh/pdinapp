<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta dipisah -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="<?= base_url() ?>favicon.ico" />

    <title><?php if (!empty($judul_halaman)) {
                echo $judul_halaman;
            } ?>
    </title>

    <!-- Dipisah -->
    <!-- Bootstrap core CSS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Import Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <!-- End Bootstrap Icon -->

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- import aos animasi on scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Import Custom CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-navs-tabs.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-button.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-container.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-footer.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-modal.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-navbar.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-section.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-text.css" type="text/css" />
    <!-- End Custom CSS -->

    <!-- Script -->
    <?= $this->renderSection('style'); ?>

</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <?= $this->include('layout/navbar'); ?>

    <!-- Page content -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <?= $this->include('layout/footer'); ?>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- Calendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/locales-all.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Script -->
    <?= $this->renderSection('script'); ?>

</body>

</html>