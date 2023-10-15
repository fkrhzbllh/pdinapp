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
        background: var(--color-surface-transparent-8);
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
        background-image: linear-gradient(to right,
                var(--color-surface),
                var(--color-surface-transparent-8) 40%,
                transparent 60%);
        pointer-events: none;
    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (max-width: 768px) {
        #section-kegiatan-terakhir .section-slideshow::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom,
                    var(--color-surface),
                    var(--color-surface-transparent-8) 40%,
                    transparent 60%);
            pointer-events: none;
        }
    }

    /* Ikon kegiatan */
    .bi-kegiatan {
        margin-right: 16px;
    }

    .card-title.judul-kegiatan:hover {
        cursor: pointer;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Section Hero -->
<section id="hero" class="shadow-lg d-flex align-items-center">
    <div class="section-slideshow" style="background-image:url('<?= base_url() . 'uploads/' . $kegiatan_mendatang_atau_terakhir['poster']; ?>')"></div>
    <div class="container position-relative" id="hero-container">
        <div class="row d-flex align-items-center">
            <div class="col-9">
                <!-- Kategori -->
                <p class="text-danger fs-3 mb-3"><b><?= $kegiatan_mendatang_atau_terakhir['hari_tersisa']; ?></b></p>

                <!-- Judul -->
                <h3 class="card-title fs-1 mb-3">
                    <a class="link-dark text-decoration-none crop-text-2" href="rilis-media/"><?= $kegiatan_mendatang_atau_terakhir['nama_kegiatan']; ?></a>
                </h3>

                <!-- Tanggal -->
                <p class="card-text crop-text-2 mb-3">
                    <b><?= $kegiatan_mendatang_atau_terakhir['tgl_mulai_terformat']; ?></b>
                </p>

                <!-- Ringkasan -->
                <p class="card-text fs-4 crop-text-4 mb-3">
                    <?= $kegiatan_mendatang_atau_terakhir['tempat']; ?>
                </p>

                <button class="btn btn-danger btn-lg">Selengkapnya</button>
            </div>
            <div class="col-3">
                <img class="w-100 rounded-4" src="<?= base_url() . 'uploads/' . $kegiatan_mendatang_atau_terakhir['poster']; ?>">
            </div>
        </div>
    </div>
</section>
<!-- Section konten -->
<section id="section-konten">
    <div class="container">
        <div class="row">

            <!-- Kalender -->
            <div class="col-6">
                <div id="calendar"></div>
            </div>

            <!-- Daftar acara -->
            <div class="col-6">

                <!-- Acara -->
                <div class="fc" id="container-acara">
                    <div class="fc-header-toolbar fc-toolbar">
                        <div class="fc-toolbar-chunk">
                            <h2 class="fc-toolbar-title">Acara</h2>
                        </div>
                        <div class="fc-toolbar-chunk">
                            <button type="button" id="btn-acara-bulan-ini" class="fc-today-button btn btn-primary"><i class="bi bi-info-circle"></i></button>
                        </div>
                    </div>

                    <!-- List acara -->
                    <div id="list-acara" class="col">
                    </div>
                </div>

                <!-- Acara akan datang -->
                <div class="fc" id="container-acara-mendatang">
                    <div class="fc-header-toolbar fc-toolbar">
                        <div class="fc-toolbar-chunk">
                            <h2 id="heading-acara-mendatang" class="fc-toolbar-title">Acara Mendatang</h2>
                        </div>
                        <div class="fc-toolbar-chunk">
                            <button type="button" id="btn-acara-mendatang" class="fc-today-button btn btn-primary"><i class="bi bi-calendar2-event"></i></button>
                        </div>
                    </div>

                    <!-- List acara -->
                    <div id="list-acara-mendatang" class="col">
                    </div>
                </div>

                <!-- Acara terakhir -->
                <div class="fc" id="container-acara-terakhir">
                    <div class="fc-header-toolbar fc-toolbar">
                        <div class="fc-toolbar-chunk">
                            <h2 class="fc-toolbar-title">Acara Terakhir</h2>
                        </div>
                        <div class="fc-toolbar-chunk">
                            <button type="button" id="btn-acara-terakhir" class="fc-today-button btn btn-primary"><i class="bi bi-calendar2-event"></i></button>
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

<!-- Kegiatan -->
<section id="section-kegiatan-terakhir" class="d-flex align-items-center">
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
                            <div class="container">
                                <div class="row">

                                    <!-- Body artikel -->
                                    <div class="col-md-6">
                                        <div class="card-body p-md-5">

                                            <!-- Kategori -->
                                            <p class="text-danger fs-5 mb-3"><b><?= $k['jenis_kegiatan'] ?></b></p>


                                            <!-- Judul -->
                                            <h3 class="card-title fs-2 mb-3">
                                                <a class="link-dark text-decoration-none crop-text-2" href="rilis-media/"><?= $k['nama_kegiatan'] ?></a>
                                            </h3>

                                            <!-- Tanggal -->
                                            <p class="card-text crop-text-2 mb-3">
                                                <b><?= $k['tgl_mulai_terformat'] ?></b>
                                            </p>

                                            <!-- Ringkasan -->
                                            <p class="card-text fs-5 crop-text-4 mb-3">
                                                <?= $k['tempat'] ?>
                                            </p>

                                        </div>

                                    </div>
                                    <!-- Akhir body artikel -->

                                    <!-- Gambar artikel -->
                                    <div class="col-md-6 position-relative" style="height: 256px;">

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

    <!-- <div class="container align-self-end">
		<a class="btn btn-danger rounded-4" href="/rilis-media" role="button">Lihat Semua
			Kegiatan
			<span class="ps-1 bi-arrow-right"></span></a>
	</div> -->

</section>
<!-- End Kegiatan Section -->

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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            locale: 'id',
            events: <?php echo json_encode($kegiatan) ?>, //array kegiatan -> objek kegiatan

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

    });
</script>

<script>
    /////////////////////////////
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
        heading.innerHTML = ''; // Bersihkan heading untuk refresh hitungan hari

        var nextUpcomingEvent = null;

        var eventIdPrefix = 'acara-mendatang-';
        var eventId = 0;

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
            container.innerHTML = '<p>No upcoming events found.</p>';

            heading.textContent = 'No Upcoming Events';
        }

        // Update fungsi onclick pada tombol Pergi ke Acara Mendatang
        var btnAcaraMendatang = document.getElementById("btn-acara-mendatang");
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

        calendar.getEvents().forEach(function(event) {
            // Check if the event is in the past and earlier than the latestPastEvent
            if (event.end < new Date() && (!latestPastEvent || event.end > latestPastEvent.end)) {
                latestPastEvent = event;
                // console.log(event);
            }
        });

        console.log(latestPastEvent);

        if (latestPastEvent != null) {
            displayEventCard('list-acara-terakhir', latestPastEvent, eventIdPrefix + eventId);
        } else {
            // Handle the case where there are no past events
            container.innerHTML = '<p>No past events found.</p>';
        }

        // Update fungsi onclick pada tombol Pergi ke Acara Terakhir
        var btnAcaraTerakhir = document.getElementById("btn-acara-terakhir");
        btnAcaraTerakhir.onclick = function() {
            goToFormattedDate(calendar, latestPastEvent.end);
        }
    }
</script>

<script type="text/javascript">
    ////////////////////////////////////////////////////////////////
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
                    <h5 class="card-title judul-kegiatan" id="${eventId}"><i class="bi bi-pin-angle bi-kegiatan"></i>${event.title}</h5>
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