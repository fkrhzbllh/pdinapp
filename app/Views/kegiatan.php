<?php
/*
Belum dirapikan
- Pindahkan css
- Pakai css khusus halaman kegiatan
- Rapikan modal
*/
?>
<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-full-calendar.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-beranda.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-hero.css" type="text/css" />
<style>
    #hero .section-slideshow::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(to bottom,
                var(--color-surface-transparent-8),
                var(--color-surface-transparent-8) 80%,
                var(--color-surface));
        pointer-events: none;
    }

    #section-kegiatan-terakhir {
        width: 100%;
        height: 100vh;
        transition: background-image 0.3s ease;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    #section-kegiatan-terakhir .section-slideshow::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(to top,
                var(--color-quaternary),
                var(--color-quaternary-transparent-8) 40%,
                transparent 60%);
        pointer-events: none;
    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {
        #section-kegiatan-terakhir .section-slideshow::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to right,
                    var(--color-quaternary),
                    var(--color-quaternary-transparent-8) 40%,
                    transparent 60%);
            pointer-events: none;
        }
    }

    /* Ikon kegiatan */
    h2 .bi,
    .judul-kegiatan .bi {
        margin-right: 16px;
    }

    .btn-sosmed .bi {
        margin-right: 8px;
    }

    .card-text.judul-kegiatan:hover {
        cursor: pointer;
    }

    /* Slideshow */
    .pic-wrapper {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    figure {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        opacity: 0;
        /*animation*/

        animation: slideShow 24s linear infinite 0s;
        -o-animation: slideShow 24s linear infinite 0s;
        -moz-animation: slideShow 24s linear infinite 0s;
        -webkit-animation: slideShow 24s linear infinite 0s;
    }

    figure::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--color-surface-transparent-8);
        pointer-events: none;
    }

    figurecaption {
        position: absolute;
        top: 50%;
        left: 50%;
        color: #fff;
    }

    .pic-1 {
        opacity: 1;
        background: url(./assets/hero-bg-1.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .pic-2 {
        animation-delay: 6s;
        -o-animation-delay: 6s;
        -moz--animation-delay: 6s;
        -webkit-animation-delay: 6s;
        background: url(./assets/hero-bg-3.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .pic-3 {
        animation-delay: 12s;
        -o-animation-delay: 12s;
        -moz--animation-delay: 12s;
        -webkit-animation-delay: 12s;
        background: url(./assets/hero-bg-4.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .pic-4 {
        animation-delay: 18s;
        -o-animation-delay: 18s;
        -moz--animation-delay: 18s;
        -webkit-animation-delay: 18s;
        background: url(./assets/hero-bg-5.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    /* keyframes*/

    @keyframes slideShow {
        0% {
            opacity: 0;
            transform: scale(1);
            -ms-transform: scale(1);
        }

        5% {
            opacity: 1
        }

        25% {
            opacity: 1;
        }

        30% {
            opacity: 0;
            transform: scale(1.1);
            -ms-transform: scale(1.1);
        }

        100% {
            opacity: 0;
            transform: scale(1);
            -ms-transformm: scale(1);
        }
    }

    @-o-keyframes slideShow {
        0% {
            opacity: 0;
            -o-transform: scale(1);
        }

        5% {
            opacity: 1
        }

        25% {
            opacity: 1;
        }

        30% {
            opacity: 0;
            -o-transform: scale(1.1);
        }

        100% {
            opacity: 0;
            -o-transformm: scale(1);
        }
    }

    @-moz-keyframes slideShow {
        0% {
            opacity: 0;
            -moz-transform: scale(1);
        }

        5% {
            opacity: 1
        }

        25% {
            opacity: 1;
        }

        30% {
            opacity: 0;
            -moz-transform: scale(1.1);
        }

        100% {
            opacity: 0;
            -moz-transformm: scale(1);
        }
    }

    @-webkit-keyframes slideShow {
        0% {
            opacity: 0;
            -webkit-transform: scale(1);
        }

        5% {
            opacity: 1
        }

        25% {
            opacity: 1;
        }

        30% {
            opacity: 0;
            -webkit-transform: scale(1.1);
        }

        100% {
            opacity: 0;
            -webkit-transformm: scale(1);
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Section Hero -->
<section id="hero" class="d-flex align-items-center">
    <div class="section-slideshow" style="background-image:url('<?= base_url() . 'uploads/' . $kegiatan_mendatang_atau_terakhir['poster']; ?>')"></div>
    <div class="container position-relative" id="hero-container">
        <div class="row gy-5 justify-content-center">
            <div class="col-12 col-xl-9 text-center">
                <!-- Kategori -->
                <p class="text-danger fs-3 mb-4"><b><?= $kegiatan_mendatang_atau_terakhir['hari_tersisa']; ?></b></p>

                <!-- Judul -->
                <h1 class="card-title fs-1 mb-3">
                    <a class="link-dark text-decoration-none crop-text-2" href="rilis-media/"><?= $kegiatan_mendatang_atau_terakhir['nama_kegiatan']; ?></a>
                </h1>

                <hr class="border border-danger border-1 opacity-100">

                <!-- Tanggal -->
                <p class="card-text fs-3 crop-text-2 mb-5">
                    <b><i class="bi bi-clock me-3"></i><?= $kegiatan_mendatang_atau_terakhir['tgl_mulai_terformat']; ?></b>
                </p>

                <button id="btn-hero-kegiatan" class="btn btn-outline-dark btn-lg">Selengkapnya<i class="bi bi-arrow-right ms-2"></i></button>
            </div>
        </div>
    </div>

    <!-- Tombol pergi ke kalender -->
    <div class="d-flex position-absolute w-100 justify-content-center align-self-end">
        <i id="btn-pergi-ke-kalender" class="display-4 bi bi-arrow-down-circle m-4"></i>
    </div>

</section>

<!-- Section konten -->
<section id="section-konten" style="min-height: 100vh">
    <div class="container">
        <div class="row">

            <!-- Kalender -->
            <div class="col-lg-6">
                <div class="card p-3 mb-2 rounded-0" id="calendar"></div>
            </div>

            <!-- Daftar acara -->
            <div class="col-lg-6">

                <!-- Acara -->
                <div class="card fc p-3 mb-2 rounded-0" id="container-acara">
                    <div class="fc-header-toolbar fc-toolbar">
                        <div class="fc-toolbar-chunk">
                            <h2 class="fc-toolbar-title"><i class="bi bi-bookmarks"></i>Acara</h2>
                        </div>
                        <div class="fc-toolbar-chunk">
                            <a tabindex="0" role="button" id="btn-acara-bulan-ini" class="fc-today-button btn btn-primary" data-bs-toggle="popover" data-bs-title="Daftar Acara" data-bs-trigger="focus" data-bs-content="Menampilkan daftar acara pada bulan terpilih"><i class="bi bi-info-circle"></i></a>
                        </div>
                    </div>

                    <!-- List acara -->
                    <div id="list-acara" class="col">
                    </div>
                </div>

                <!-- Acara akan datang -->
                <div class="card fc p-3 mb-2 rounded-0" id="container-acara-mendatang">
                    <div class="fc-header-toolbar fc-toolbar">
                        <div class="fc-toolbar-chunk">
                            <h2 id="heading-acara-mendatang" class="fc-toolbar-title"><i class="bi bi-bookmark"></i>Acara Mendatang</h2>
                        </div>
                        <div class="fc-toolbar-chunk">
                            <button type="button" id="btn-acara-mendatang" class="fc-today-button btn btn-primary"><i class="bi bi-calendar2-event"></i></button>
                            <a tabindex="0" role="button" id="btn-acara-mendatang-info" class="fc-today-button btn btn-primary" data-bs-toggle="popover" data-bs-title="Acara Mendatang" data-bs-trigger="focus" data-bs-content="Menampilkan acara terdekat yang akan diselenggarakan"><i class="bi bi-info-circle"></i></a>
                        </div>
                    </div>

                    <!-- List acara -->
                    <div id="list-acara-mendatang" class="col">
                    </div>
                </div>

                <!-- Acara terakhir -->
                <div class="card fc p-3 mb-2 rounded-0" id="container-acara-terakhir">
                    <div class="fc-header-toolbar fc-toolbar">
                        <div class="fc-toolbar-chunk">
                            <h2 class="fc-toolbar-title"><i class="bi bi-bookmark-check"></i>Acara Terakhir</h2>
                        </div>
                        <div class="fc-toolbar-chunk">
                            <button type="button" id="btn-acara-terakhir" class="fc-today-button btn btn-primary"><i class="bi bi-calendar2-event"></i></button>
                            <a tabindex="0" role="button" id="btn-acara-terakhir-info" class="fc-today-button btn btn-primary" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Acara Terakhir" data-bs-content="Menampilkan acara terakhir yang telah diselenggarakan"><i class="bi bi-info-circle"></i></a>
                        </div>
                    </div>

                    <!-- List acara -->
                    <div id="list-acara-terakhir" class="col">
                    </div>
                </div>

            </div>
            <!-- Akhir daftar acara -->

        </div>
    </div>
</section>
<!-- Akhir section konten -->

<!-- Kegiatan terakhir -->
<section id="section-kegiatan-terakhir" class="d-flex align-items-center bg-pdin-quaternary">

    <!-- Background slideshow -->
    <div class="section-slideshow"></div>

    <div class="container position-relative">

        <!-- Swiper kegiatan -->
        <div class="row mb-4">
            <div class="swiper" id="swiper-kegiatan-terakhir">
                <div class="swiper-wrapper">

                    <!-- Swiper artikel terbaru -->
                    <?php foreach ($kegiatan_terakhir as $i => $k) :
                    ?>
                        <div class="swiper-slide d-flex align-items-center">
                            <div class="container p-4">
                                <div class="row">

                                    <!-- Body artikel -->
                                    <div class="col-md-6 order-2 order-md-1">
                                        <div class="card-body p-md-5">

                                            <!-- Kategori -->
                                            <p class="text-danger fs-5 mb-3"><b><?= $k['jenis_kegiatan'] ?></b></p>

                                            <!-- Judul -->
                                            <h3 class="card-title fs-2 mb-3">
                                                <a id="link-kegiatan-terakhir-<?= $i ?>" class="link-light text-decoration-none crop-text-2"><?= $k['nama_kegiatan'] ?></a>
                                            </h3>

                                            <!-- Tanggal -->
                                            <p class="card-text text-light crop-text-2 mb-1">
                                                <i class="bi bi-clock me-2"></i><b><?= $k['tgl_mulai_terformat'] ?></b>
                                            </p>

                                            <!-- Ringkasan -->
                                            <p class="card-text text-light crop-text-4 mb-3">
                                                <i class="bi bi-geo-alt me-2"></i><?= $k['tempat'] ?>
                                            </p>

                                        </div>

                                    </div>
                                    <!-- Akhir body artikel -->

                                    <!-- Gambar artikel -->
                                    <div class="col-md-6 order-1 order-md-2" style="height: 256px;">

                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    ?>
                    <!-- Akhir swiper artikel terbaru -->
                </div>

                <div class="swiper-pagination"></div>

            </div>

        </div>
        <!-- Akhir swiper kegiatan -->

    </div>

</section>
<!-- End Kegiatan Section -->

<!-- Media Sosial -->
<section class="d-flex align-items-center" style="height: 100vh">
    <div class="pic-wrapper">
        <figure class="pic-1"></figure>
        <figure class="pic-2"></figure>
        <figure class="pic-3"></figure>
        <figure class="pic-4"></figure>
    </div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-12 col-md-10 col-xl-8 text-center mx-auto">

                <p class="fs-3 lh-base mb-4">Temukan informasi terkini tentang acara, seminar, workshop, dan berbagai kegiatan lain yang kami selenggarakan. Tetap terhubung bersama kami</p>

                <div class="d-flex flex-md-row flex-column mb-3 justify-content-center gx-1 btn-sosmed px-4">
                    <a class="btn btn-outline-dark rounded-5 m-1" href="https://www.instagram.com/pdin.id/" role="button"><i class="bi bi-instagram"></i>
                        Instagram
                    </a>
                    <a class="btn btn-outline-dark rounded-5 m-1" href="https://www.tiktok.com/@pdin_id" role="button"><i class="bi bi-tiktok"></i>
                        TikTok
                    </a>
                    <a class="btn btn-outline-dark rounded-5 m-1" href="https://www.facebook.com/profile.php?id=100090825612362&mibextid=ZbWKwL" role="button"><i class="bi bi-facebook"></i>
                        Facebook
                    </a>
                    <a class="btn btn-outline-dark rounded-5 m-1" href="https://twitter.com/pdin_id" role="button"><i class="bi bi-twitter-x"></i>
                        Twitter
                    </a>
                    <a class="btn btn-outline-dark rounded-5 m-1" href="https://www.youtube.com/@pdin_id" role="button"><i class="bi bi-youtube"></i>
                        Youtube
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Modal detail kegiatan -->
<div class="modal fade" id="modalKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Header modal -->
            <div class="modal-header border border-0">
                <h4 class="modal-title ms-2" id="judul_kegiatan">
                    -
                </h4>

                <button type="button" class="btn-close bg-pdin-secondary me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Isi modal -->
            <div class="modal-body">
                <div class="row">

                    <!-- Informasi kegiatan -->
                    <div class="col-12 col-lg-6">

                        <!-- Jenis kegiatan -->
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-balloon" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary mt-0 pt-0">Jenis Kegiatan:</small>
                                <p class="p-0 fw-bold mb-1" id="jenis_kegiatan">-</p>
                            </div>
                        </div>

                        <!-- Tipe Kegiatan -->
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-activity" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary">Tipe Kegiatan:</small>
                                <p class="p-0 fw-bold mb-1" id="tipe_kegiatan">-</p>
                            </div>
                        </div>

                        <!-- Waktu Kegiatan -->
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-calendar-event" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary">Waktu Kegiatan:</small>
                                <p class="p-0 fw-bold mb-1" id="tgl_mulai">
                                    -
                                </p>
                            </div>
                        </div>

                        <!-- Lokasi Kegiatan -->
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-geo-alt" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary">Lokasi Kegiatan:</small>
                                <p class="p-0 fw-bold mb-1" id="tempat">
                                    -
                                </p>
                            </div>
                        </div>

                        <!-- Link Pendaftaran -->
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-link-45deg" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary">Link Pendaftaran:</small>
                                <a href="" class="" id="link_pendaftaran" target="_blank">
                                    -
                                </a>
                            </div>
                        </div>

                        <!-- Link Virtual -->
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-link-45deg" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary">Link Virtual:</small>
                                <div id="link-virtual-modal-kegiatan" class="p-0 fw-bold mb-1">
                                    <a href="" class="" id="link_virtual" target="_blank">
                                        -
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir informasi kegiatan -->

                    <!-- Poster kegiatan -->
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="row p-0 m-0 mb-1">
                            <div class="col-1 m-0 p-0 align-self-start">
                                <div class="text-center">
                                    <i class="bi bi-image" style="font-size: 14px; color: 8c8c8c"></i>
                                </div>
                            </div>
                            <div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
                                <small class="mb-1 text-secondary">Poster kegiatan:</small>
                                <img src="" alt="" class="img-fluid object-fit-cover rounded-3 mt-2" id="poster" />
                            </div>
                        </div>
                    </div>
                    <!-- Akhir poster kegiatan -->

                </div>
            </div>
            <!-- Akhir isi modal -->

        </div>
    </div>
</div>
<!-- Akhir modal detail kegiatan -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    const popover = new bootstrap.Popover('.popover-dismiss', {
        trigger: 'focus'
    })
</script>

<!-- Pergi ke kalender -->
<script>
    $(document).ready(function() {
        // Pergi ke kalender
        $('#btn-pergi-ke-kalender').click(function() {
            $('html, body').animate({
                scrollTop: $('#section-konten').offset().top
            }, 500);
        });
    });
</script>

<!-- Efek fade out tombol pergi ke kalender -->
<script>
    $(document).ready(function() {
        var $scrollButton = $('#btn-pergi-ke-kalender');

        // Calculate half of the viewport height
        var viewportHeight = $(window).height();
        var maxScrollPosition = viewportHeight / 2;

        // Adjust the opacity of the button as the page is scrolled
        $(window).scroll(function() {
            var scrollPosition = $(this).scrollTop();

            // Calculate the opacity based on the scroll position
            var opacity = 1 - (scrollPosition / maxScrollPosition);

            // Ensure the opacity is within a 0 to 1 range
            opacity = Math.min(1, Math.max(0, opacity));

            // Update the button's opacity
            $scrollButton.css('opacity', opacity);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            locale: 'id',
            events: <?= json_encode($kegiatan) ?>, //array kegiatan -> objek kegiatan

            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },

            themeSystem: 'bootstrap5',

            eventClick: function(arg) {
                tampilkanModalKegiatan(arg.event);
            },
            editable: true,
            dayMaxEvents: false,
        });
        calendar.render();

        // Tampilkan modal kegiatan untuk tombol hero kegiatan
        document.getElementById("btn-hero-kegiatan").addEventListener("click", function() {
            tampilkanModalHeroKegiatan(calendar);
        });

        displayCurrentMonthEvent(calendar);
        displayLatestPastEvent(calendar);
        displayNextUpcomingEvent(calendar)

        // Refresh list acara bulan ini setiap kali pengguna mengganti bulan
        document.querySelector('.fc-next-button').addEventListener('click', function() {
            displayCurrentMonthEvent(calendar);
        });

        document.querySelector('.fc-prev-button').addEventListener('click', function() {
            displayCurrentMonthEvent(calendar);
        });

        // Section kegiatan terakhir
        var kegiatanTerakhir = filterEvents(calendar.getEvents(), <?= json_encode($kegiatan_terakhir) ?>)

        kegiatanTerakhir.forEach(function(k, i) {

            // Find the element with the matching id
            var elementId = "link-kegiatan-terakhir-" + i;
            var element = document.getElementById(elementId);

            if (element) {
                element.onclick = function() {
                    tampilkanModalKegiatan(k);
                }
            }
        });

    });
</script>

<script>
    function filterEvents(existingEvents, jsonData) {
        // Initialize an array to store the filtered events
        var filteredEvents = [];

        // Loop through the JSON data
        for (var i = 0; i < jsonData.length; i++) {
            var eventData = jsonData[i];

            // Filter the existing events based on a condition (e.g., matching event name)
            var matchingEvent = existingEvents.find(function(event) {
                // Customize this condition to match your criteria
                return event.title === eventData.nama_kegiatan;
            });

            // If a matching event is found, add it to the filtered events array
            if (matchingEvent) {
                filteredEvents.push(matchingEvent);
            }
        }

        return filteredEvents;
    }


    // Untuk kegiatan yang ada di section hero
    function tampilkanModalHeroKegiatan(calendar) {
        var nextUpcomingEvent = null;
        var latestPastEvent = null;

        calendar.getEvents().forEach(function(event) {
            if (event.start > new Date() && (!nextUpcomingEvent || event.start < nextUpcomingEvent.start)) {
                nextUpcomingEvent = event;
            }

            if (event.end < new Date() && (!latestPastEvent || event.end > latestPastEvent.end)) {
                latestPastEvent = event;
            }
        });

        if (nextUpcomingEvent) {
            tampilkanModalKegiatan(nextUpcomingEvent);
        } else if (latestPastEvent) {
            tampilkanModalKegiatan(latestPastEvent);
        } else {
            // Handle the case where there are no upcoming or past events
            console.log("No upcoming or past events found.");
        }
    }

    // Tampilkan acara bulan ini
    function displayCurrentMonthEvent(calendar) {

        document.getElementById('list-acara').innerHTML = ''; // Bersihkan list untuk refresh list acara

        var eventIdPrefix = 'acara-';
        var eventId = 0;

        calendar.getEvents().forEach(function(event) {
            if (
                event.start >= calendar.view.activeStart &&
                event.start <= calendar.view.activeEnd
            ) {
                eventId++;
                displayEventCard('list-acara', event, eventIdPrefix + eventId);
            }
        });

        if (eventId <= 0) {
            document.getElementById('container-acara').hidden = true;
        } else {
            document.getElementById('container-acara').hidden = false;
        }
    }

    // Tampilkan acara mendatang
    function displayNextUpcomingEvent(calendar) {

        var container = document.getElementById('list-acara-mendatang');
        container.innerHTML = ''; // Bersihkan list untuk refresh list acara

        var heading = document.getElementById('heading-acara-mendatang');
        // heading.innerHTML = ''; // Bersihkan heading untuk refresh hitungan hari

        var nextUpcomingEvent = null;

        var eventIdPrefix = 'acara-mendatang-';
        var eventId = 0;

        // Tombol pergi ke acara mendatang
        var btnAcaraMendatang = document.getElementById("btn-acara-mendatang");

        calendar.getEvents().forEach(function(event) {
            // Check if the event is in the future and earlier than the nextUpcomingEvent
            if (event.start > new Date() && (!nextUpcomingEvent || event.start < nextUpcomingEvent.start)) {
                nextUpcomingEvent = event;
            }
        });

        if (nextUpcomingEvent) {
            displayEventCard('list-acara-mendatang', nextUpcomingEvent, eventIdPrefix + eventId);

            // Calculate the number of days left until the event
            var currentDate = new Date();
            var daysLeft = Math.ceil((nextUpcomingEvent.start - currentDate) / (1000 * 60 * 60 * 24));

            // Update the heading with the number of days left
            heading.textContent = `dalam ${daysLeft} hari...`;
        } else {
            // Handle the case where there are no upcoming events
            container.innerHTML = '<p>Nantikan acara mendatang dari kami.</p>';

            // heading.textContent = 'Acara Mendatang';
            btnAcaraMendatang.hidden = true;
        }

        // Update fungsi onclick pada tombol Pergi ke Acara Mendatang
        btnAcaraMendatang.onclick = function() {
            goToFormattedDate(calendar, nextUpcomingEvent.start);
        }
    }

    // Tampilkan acara terakhir
    function displayLatestPastEvent(calendar) {

        var container = document.getElementById('list-acara-mendatang');
        container.innerHTML = ''; // Bersihkan list untuk refresh list acara

        var latestPastEvent = null;

        var eventIdPrefix = 'acara-terahir-';
        var eventId = 0;

        // Tombol pergi ke acara terakhir
        var btnAcaraTerakhir = document.getElementById("btn-acara-terakhir");

        calendar.getEvents().forEach(function(event) {
            // Check if the event is in the past and earlier than the latestPastEvent
            if (event.end < new Date() && (!latestPastEvent || event.end > latestPastEvent.end)) {
                latestPastEvent = event;
                // console.log(event);
            }
        });

        if (latestPastEvent != null) {
            displayEventCard('list-acara-terakhir', latestPastEvent, eventIdPrefix + eventId);
        } else {
            // Handle the case where there are no past events
            container.innerHTML = '<p>No past events found.</p>';

            btnAcaraTerakhir.hidden = true;
        }

        // Update fungsi onclick pada tombol Pergi ke Acara Terakhir
        btnAcaraTerakhir.onclick = function() {
            goToFormattedDate(calendar, latestPastEvent.end);
        }
    }
</script>

<script type="text/javascript">
    function displayEventCard(listId, event, eventId) {

        var container = document.getElementById(listId);
        var card = document.createElement('div');
        card.classList.add('col', 'mb-3');

        document.addEventListener("click", function(ev) {
            if (ev.target.id === eventId) {
                tampilkanModalKegiatan(event);
            }
        });

        card.innerHTML = `
            <div class="card rounded-0 shadow">
                <div class="card-body">
                    <p class="card-text judul-kegiatan" id="${eventId}"><i class="bi bi-pin-angle bi-kegiatan"></i>${event.title}</p>
                </div>
            </div>
        `;
        container.appendChild(card);

    }

    // Tampilkan modal detail kegiatan
    function tampilkanModalKegiatan(event) {
        const formatter = new Intl.DateTimeFormat('id-ID', {
            weekday: "long",
            day: "numeric",
            month: "long",
            year: "numeric",
            hour: "numeric",
            minute: "numeric",
            timeZoneName: "short",
            timeZone: "Asia/Jakarta",
        });
        const mulai = formatter.format(event.start);
        $('.modal-header').find('#judul_kegiatan').text(event.title);
        $('.modal-body').find('#jenis_kegiatan').text(event.extendedProps
            .jenis_kegiatan);
        $('.modal-body').find('#tipe_kegiatan').text(event.extendedProps.tipe_kegiatan);
        $('.modal-body').find('#tgl_mulai').text(mulai);
        $('.modal-body').find('#tempat').text(event.extendedProps.tempat);
        $('.modal-body').find('#link_pendaftaran').text(event.extendedProps
            .link_pendaftaran);
        $('.modal-body').find('#link_pendaftaran').attr("href", event.extendedProps
            .link_pendaftaran);
        $('.modal-body').find('#link_virtual').text(event.extendedProps.link_virtual);
        $('.modal-body').find('#link_virtual').attr("href", event.extendedProps
            .link_virtual);
        $('.modal-body').find('#poster').attr('src', event.extendedProps.poster);
        $('#modalKegiatan').modal('toggle');
    }
</script>

<script>
    // Go to date in calendar using formatted date
    function goToFormattedDate(calendar, formattedDate) {
        // Parse the formattedDate string into a JavaScript Date object
        const date = new Date(formattedDate);

        // Check if the date is valid
        if (!isNaN(date.getTime())) {
            // Use the calendar's gotoDate method to navigate to the specified date
            calendar.gotoDate(date);
        } else {
            console.error('Invalid date format:', formattedDate);
        }
    }
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiperKegiatanTerakhir = new Swiper('#swiper-kegiatan-terakhir', {
        slidesPerView: 1,
        grabCursor: true,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        }
    });

    $(document).ready(function() {
        var kegiatanTerakhir = <?= json_encode($kegiatan_terakhir); ?>;
        var currentIndex = swiperKegiatanTerakhir.realIndex;

        function changeBackgroundImage(index) {
            $('#section-kegiatan-terakhir .section-slideshow').fadeOut('slow', function() {
                // Update the background image
                $(this).css('background-image', 'url(' + "<?= base_url() . 'uploads/' ?>" + kegiatanTerakhir[index].poster + ')');
                // Fade back in
                $(this).fadeIn('slow');
            });
            console.log("<?= base_url() . 'uploads/' ?>" + kegiatanTerakhir[index].poster);
        }

        // Initialize with the first image
        changeBackgroundImage(currentIndex);

        swiperKegiatanTerakhir.on('slideChange', function() {
            currentIndex = swiperKegiatanTerakhir.realIndex;
            changeBackgroundImage(currentIndex);
        });
    });
</script>

<?= $this->endSection() ?>