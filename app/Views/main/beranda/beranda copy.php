<?php

/**
 * TODO: 
 * Tambah styling kustom ke swiper
 * Pindah script ke footer
 */

helper('text'); ?>
<?= $this->extend('layout/template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-beranda.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-hero.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-full-calendar.css" type="text/css" />

<!-- Swiper style -->
<style>
	#navbar-nav a {
		font-size: 14px;
		/* color: var(--color-surface); */
		font-weight: 600;
		text-decoration: none;
	}

	.swiper-slide-fasilitas {
		background-position: center;
		background-size: cover;
		width: 512px;
		height: 25vh;
		/* border-radius: var(--border-radius-primary); */
	}

	.swiper-slide-fasilitas img {
		transition: 0.3s;
		display: block;
		object-fit: cover;
		width: 512px;
		height: 25vh;
		border-radius: var(--border-radius-primary);
	}

	.swiper-slide-fasilitas img.active {
		box-shadow: 0px 0px 20px var(--color-surface-transparent);
	}

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
		background: var(--color-surface-inverse-transparent);
		/* background-image: linear-gradient(to bottom,
				var(--color-surface-transparent),
				var(--color-surface-inverse-transparent) 40%,
				transparent 60%); */
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Garis Batas -->
<?php //include('garis-pembatas.php'); 
?>
<!-- Section Hero -->
<section id="hero" class="section shadow-lg d-flex align-items-center">
	<div class="pic-wrapper">
		<figure class="pic-1"></figure>
		<figure class="pic-2"></figure>
		<figure class="pic-3"></figure>
		<figure class="pic-4"></figure>
	</div>
	<div class="container p-5 text-light" id="hero-container" data-aos="slide-up">
		<div class="col-12 col-md-10 col-lg-8 col-xxl-6 ms-md-5">
			<!-- <h1 class="display-1" style="color: var(--color-secondary)">
			<font style="color: var(--color-primary)">Pusat Desain</font> Industri Nasional
		</h1> -->
			<p class="display-5 mb-0 lh-sm">
				Mewujudkan Sinergi <b>Desain dan Inovasi</b> bersama.
			</p>
			<p class="display-4 mb-4 lh-sm fw-bold">
				Memajukan Industri Kecil dan Menengah di Indonesia.
			</p>
			<img class="mb-4" style="width:25vw" src="<?= base_url() ?>assets/logo-pdin-putih.png" id="logo" alt="Logo_PDIN" />
			<!-- <a href="/ProfilPDIN" class="btn-lihat-profil">Lihat Profil</a> -->
		</div>
	</div>
</section>
<!-- End Hero -->

<!-- Section Layanan -->
<section id="layanan" class="section layanan">
	<div class="container" data-aos="fade-up">

		<!-- Konten layanan -->
		<div class="row justify-content-around">
			<div class="col-md-6 col-xl-4 mt-4 mt-md-0">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
					<i class="bi bi-lightbulb"></i>
					<h4><a href="#">Pengembangan Produk</a></h4>
					<p class="me-md-4">
						PDIN mendukung dan memfasilitasi proses pengembangan produk
						kreatif, mulai dari tahap riset produk hingga tahap pengembangan
						prototipe.
					</p>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mt-4 mt-md-0">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
					<i class="bi bi-door-open"></i>
					<h4><a href="#">Sewa Ruang & Alat</a></h4>
					<p>
						PDIN menyediakan berbagai fasilitas terbaik untuk
						mendukung proses pengembangan produk, pameran, pertemuan, dan
						kegiatan lainnya.
					</p>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mt-4 mt-md-0">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
					<i class="bi bi-easel"></i>
					<h4><a href="#">Workshop Pelatihan</a></h4>
					<p>
						PDIN rutin menyelenggarakan pelatihan tentang beberapa bidang
						industri kreatif untuk meningkatkan wawasan dan keterampilan
						pelaku industri kreatif.
					</p>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mt-4 mt-md-0">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
					<i class="bi bi-people"></i>
					<h4><a href="#">Konsultasi</a></h4>
					<p>
						PDIN menyediakan layanan pendampingan dan konseling yang dapat
						digunakan pelaku industri kreatif agar pengembangan produk
						berjalan sesuai harapan.
					</p>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mt-4 mt-md-0">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
					<i class="bi bi-megaphone"></i>
					<h4><a href="#">Promosi</a></h4>
					<p>
						PDIN membantu pelaku industri kreatif dalam mempublikasikan dan
						memasarkan kegiatan dan produk kreatif melalui store, pameran,
						dan media daring.
					</p>
				</div>
			</div>
			<div class="col-md-6 col-xl-4 mt-4 mt-md-0">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
					<i class="bi bi-collection"></i>
					<h4><a href="#">Bank Data</a></h4>
					<p>
						PDIN menyediakan berbagai sumber daya informasi, seperti buku,
						daftar material, dan hasil riset pasar untuk menunjang proses
						pengembangan produk.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Layanan Section -->

<!-- Fasilitas Section -->
<section id="section-fasilitas" class="section section-bg-pdin-quaternary d-flex align-items-center">
	<div class="container">

		<!--Judul -->
		<div class="container p-3">

			<div class="text-center">
				<!-- <h3 class="text-light highlight-header mb-4" data-aos="fade-up" data-aos-delay="300">
					FASILITAS
				</h3> -->
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-7 col-xxl-7">
						<h3 class="text-light mb-3 lh-base fw-normal" data-aos="fade-up" data-aos-delay="350">
							"Nadi Desain untuk IKM Unggul, Sinergi dan Inovasi Merajut, Desain Membentuk Masa Depan, Bersama Industri Kreatif, Indonesia Berkilau di Mata Dunia."
						</h3>

						<!-- Tombol lihat semua fasilitas -->
						<a class="btn btn-outline-light position-relative z-3 text-light" href="/fasilitas">
							Lihat Semua Fasilitas <span class="ps-1 bi-arrow-right "></span>
						</a>

					</div>
				</div>
			</div>

		</div>

		<div class="container p-3">
			<div class="col-12 text-center">
			</div>
		</div>

		<!-- Konten fasilitas -->
		<div class="container px-4" data-aos="fade-left" data-aos-delay="500">
			<div class="col-12 text-center">

				<!-- Swiper -->
				<div class="swiper" id="swiper-fasilitas">
					<div class="swiper-wrapper mb-2">
						<!-- Setiap ruangan yang memiliki foto akan ditampilkan pada swiper -->
						<?php foreach ($ruangan_berfoto as $key => $r) : ?>
							<div class="swiper-slide swiper-slide-fasilitas py-3">
								<img src="<?= base_url() ?>uploads/<?= $foto_ruangan_berfoto[$key]['nama_file'] ?>" id="foto-ruangan-<?= $key ?>">
								<div class="card-img-overlay text-white d-flex flex-column justify-content-end mx-4 mb-3">
									<!-- Nama ruangan -->
									<h4 class="card-title" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"><?= $r['nama'] ?></h4>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<!-- <div class="swiper-pagination"></div> -->
				</div>



			</div>
		</div>

	</div>
</section>
<!-- End Fasilitas Section -->

<!-- Kegiatan -->
<section id="section-kegiatan" class="section d-flex align-items-center">
	<div class="section-slideshow">

	</div>
	<div class="container p-3" data-aos="fade-up">

		<!-- Swiper kegiatan -->
		<div class="row mb-4">
			<div class="swiper" id="swiper-artikel">
				<div class="swiper-wrapper">

					<!-- Swiper artikel terbaru -->
					<?php foreach ($artikelTerbaru as $i => $a) : ?>
						<div class="swiper-slide d-flex align-items-center">
							<div class="container">
								<div class="row">

									<!-- Gambar artikel -->
									<div class="col-md-6 position-relative" style="height: 256px;">

									</div>

									<!-- Body artikel -->
									<div class="col-md-6">
										<div class="card-body p-md-5">

											<!-- Kategori -->
											<p class="text-danger fs-5 mb-3"><b><?php echo $a['kategori']; ?></b></p>


											<!-- Judul -->
											<h3 class="card-title fs-2 mb-3">
												<a class="link-dark text-decoration-none crop-text-2" href="rilis-media/<?= $a['slug']; ?>"><?= $a['judul']; ?></a>
											</h3>

											<!-- Tanggal -->
											<p class="card-text crop-text-2 mb-3">
												<b><?= $a['tgl_terbit_terformat']; ?></b>
											</p>

											<!-- Ringkasan -->
											<p class="card-text fs-5 crop-text-4 mb-3">
												<?= word_limiter($a['meta_description'], 50); ?>
											</p>

										</div>

									</div>
									<!-- Akhir body artikel -->

								</div>
							</div>
						</div>
					<?php endforeach; ?>
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

<!-- Galeri Section -->
<section class="section section-bg-pdin-quaternary">
	<div class="container p-3">
		<!-- judul section -->
		<div class="text-center">
			<h3 class="text-light highlight-header mb-4" data-aos="fade-up" data-aos-delay="300">
				GALERI
			</h3>
			<!-- <div class="row justify-content-center mb-5">
				<div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-7 col-xxl-7">
					<p class="text-light lh-base mb-0" data-aos="fade-up" data-aos-delay="350">
						Kumpulan dokumentasi berupa foto dan video dari berbagai
						kegiatan kreatif yang diselenggarakan oleh Pusat Desain Industri
						Nasional
					</p>
				</div>
			</div> -->
		</div>

		<!-- Konten galeri  -->
		<div class="row" data-aos="fade-up" data-aos-delay="300">
			<?php foreach ($galeri_kegiatan as $i => $g) : ?>
				<div class="col-md-4 mt-4 <?= ($i <= 3) ? 'col-6 col-md-6 col-lg-3' : (($i == 0) ? 'col-12 col-sm-12 col-md-6 col-lg-3' : 'col-6 col-lg-2'); ?>" data-aos="fade-up" data-aos-delay="200">
					<a href="<?= base_url() . 'uploads/' . $g['nama_file'] ?>" data-toggle="lightbox">
						<img src="./uploads/<?= $g['nama_file']; ?>" class="img-fluid" alt="image" />
					</a>
				</div>
			<?php endforeach ?>
		</div>
		<!-- Akhir konten galeri -->

		<!-- Tombol bawah -->
		<div class="d-flex mt-5 text-center justify-content-center mb-5">
			<div class="w-15">
				<a class="btn btn-outline-light d-md-block" href="/galeri" role="button">Lihat Semua Foto <span class="ps-1 bi-arrow-right"></span></a>
			</div>
		</div>
	</div>
</section>
<!-- End Galeri Section -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
	var swiperFasilitas = new Swiper('#swiper-fasilitas', {
		effect: "coverflow",
		grabCursor: true,
		centeredSlides: true,
		slidesPerView: "auto",
		loop: true,
		coverflowEffect: {
			rotate: -35,
			stretch: 0,
			scale: 0.9,
			depth: 200,
			modifier: 1,
			slideShadows: false,
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		}
	});

	$(document).ready(function() {
		var fotoRuanganBerfoto = <?= json_encode($foto_ruangan_berfoto); ?>;

		// Add the 'active' class to the img element of the current slide
		$('.swiper-slide-fasilitas').eq(swiperFasilitas.activeIndex).find('img').addClass('active');

		ubahBackgroundSectionFasilitas("<?= base_url() . 'uploads/' ?>" + fotoRuanganBerfoto[swiperFasilitas.realIndex].nama_file);

		swiperFasilitas.on('slideChange', function() {
			const index = swiperFasilitas.realIndex;

			// Remove the 'active' class from all img elements inside .swiper-slide elements
			$('.swiper-slide-fasilitas img').removeClass('active');

			// Add the 'active' class to the img element of the current slide
			$('.swiper-slide-fasilitas').eq(swiperFasilitas.activeIndex).find('img').addClass('active');

			ubahBackgroundSectionFasilitas("<?= base_url() . 'uploads/' ?>" + fotoRuanganBerfoto[index].nama_file);

			// Loop through all the .swiper-slide-fasilitas elements
			$('.swiper-slide-fasilitas').each(function(index) {
				const slideContent = $(this).html();
				// console.log('Content of slide ' + (index + 1) + ':', slideContent);
			});

		});

		// Function to change the background image of the section
		function ubahBackgroundSectionFasilitas(imageUrl) {
			$('#section-fasilitas').css('background-image', 'url(' + imageUrl + ')');
		}
	});
</script>

<!-- Initialize Swiper -->
<script>
	var swiperArtikel = new Swiper('#swiper-artikel', {
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
		var artikelTerbaru = <?= json_encode($artikelTerbaru); ?>;
		var currentIndex = swiperArtikel.realIndex;

		function changeBackgroundImage(index) {
			$('#section-kegiatan .section-slideshow').fadeOut('slow', function() {
				// Update the background image
				$(this).css('background-image', 'url(' + "<?= base_url() . 'uploads/' ?>" + artikelTerbaru[index].featured_image + ')');
				// Fade back in
				$(this).fadeIn('slow');
			});
		}

		// Initialize with the first image
		changeBackgroundImage(currentIndex);

		swiperArtikel.on('slideChange', function() {
			currentIndex = swiperArtikel.realIndex;
			changeBackgroundImage(currentIndex);
		});
	});
</script>

<script>
	// Script kalender
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar-beranda');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'listWeek',
			aspectRatio: 2,
			events: <?php echo json_encode($jadwal_kegiatan) ?>,
			eventColor: '#d82328',
			height: '100%',
			// contentHeight: 230,
			// locales: allLocales,
			locale: 'id',
			headerToolbar: {
				start: 'prev', // will normally be on the left. if RTL, will be on the right
				center: 'title',
				end: 'next', // will normally be on the right. if RTL, will be on the left
			},
		});
		calendar.render();
	});
</script>
<?= $this->endSection() ?>