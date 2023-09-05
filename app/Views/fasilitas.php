<?php

/**
 * TODO: 
 * Rapikan & kasih dokumentasi
 * Pindah script ke footer
 */

helper('text'); ?>
<?= $this->extend('layout/template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<!-- Swiper style -->
<style>
	.swiper-slide {
		background-position: center;
		background-size: cover;
		width: 512px;
		height: 256px;
		border-radius: var(--border-radius-primary);
	}

	.swiper-slide img {
		display: block;
		object-fit: cover;
		width: 512px;
		height: 256px;
		border-radius: var(--border-radius-primary);
	}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Section judul -->
<section class="d-flex align-items-center p-0" style="margin-top: 160px;">
	<div class="container">
		<div class="col-12">

			<!-- Swiper fasilitas -->
			<div class="swiper swiper-fasilitas">
				<div class="swiper-wrapper">

					<!-- Tampilkan ruangan berfoto -->
					<?php foreach ($ruangan_berfoto as $key => $r) : ?>
						<div class="swiper-slide rounded-4">
							<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>">
								<img src="<?= base_url() ?>uploads/<?= $foto_ruangan_berfoto[$key]['nama_file'] ?>" id="foto-ruangan-<?= $key ?>">
							</a>
						</div>
					<?php endforeach; ?>
				</div>

				<!-- Paginasi -->
				<div class="swiper-pagination"></div>
			</div>

			<!-- Penjelasan fasilitas -->
			<div class="text-center">
				<div class="row">
					<div class="col-12 col-xl-6 mx-auto">

						<!-- Lantai fasilitas -->
						<p class="text-danger fw-bold mt-4 mb-2" id="fasilitas-lantai">Lantai</p>

						<!-- Nama fasilitas -->
						<h2 class="mb-4" id="fasilitas-judul">Fasilitas</h2>

						<!-- Deskripsi pendek fasilitas -->
						<p id="fasilitas-deskripsi" class="fs-6">Deskripsi fasilitas</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- Akhir section judul  -->


<!-- Section konten -->
<section id="section-konten-secondary">
	<div class="container container-konten">

		<!-- Section judul konten -->
		<div class="row" data-aos="fade-up">

			<!-- Kolom tab navigasi -->
			<div class="col-12 col-md-6  ">

				<!-- Tab navigasi -->
				<ul class="nav nav-pills pill-merah mb-3" id="pills-tab" role="tablist">

					<!-- Tab Ruangan -->
					<li class="nav-item" role="presentation">
						<button class="nav-link  active" id="pills-ruangan-tab" data-bs-toggle="pill" data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan" aria-selected="true">Ruangan</button>
					</li>

					<!-- Tab Alat -->
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill" data-bs-target="#pills-alat" type="button" role="tab" aria-controls="pills-alat" aria-selected="false">Alat</button>
					</li>

				</ul>
			</div>

			<!-- Kolom filter -->
			<div class="col-12 col-md-6">
				<div class="row">

					<!-- Filter tipe ruangan -->
					<div class="col-12 col-sm-6 my-1">
						<div class="input-group" id="input-group">
							<select class="form-select ms-auto" aria-label="Default select example" id="filter">
								<option selected value="all">Semua Tipe Ruangan</option>
								<?php foreach ($tipe_ruangan as $key => $tr) : ?>
									<option value="<?= $tr['tipe'] ?>"><?= $tr['tipe'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<!-- Filter pencarian -->
					<div class="col-12 col-sm-6 my-1">
						<div id="input-cari-ruangan" class="input-group mb-3">

							<!-- Input pencarian ruangan -->
							<input type="text" class="form-control " id="cariruangan" placeholder="Cari ruangan...">
							<span class="input-group-text bi-search text-bg-danger" id=""></span>

						</div>

						<div id="input-cari-alat" style=" display:none;" class="input-group mb-3">

							<!-- Input pencarian alat -->
							<input type="text" class="form-control " id="carialat" placeholder="Cari alat...">
							<span class="input-group-text bi-search text-bg-danger" id=""></span>

						</div>
					</div>
					<!-- Akhir filter pencarian -->

				</div>
			</div>
			<!-- Akhir kolom filter -->

		</div>
		<!-- Akhir section judul konten -->

		<!-- Section konten tab -->
		<div class="tab-content" id="pills-tabContent" data-aos="fade-up">

			<!-- Konten tab ruangan -->
			<div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel" aria-labelledby="pills-ruangan-tab" tabindex="0">

				<?php if ($admin) : ?>
					<a class="btn btn-success mb-3" href="<?= base_url() . 'admin/tambahruangan' ?>">Tambah
						Ruangan</a>
				<?php endif; ?>

				<!-- Daftar ruangan -->
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">

					<!-- Ruangan tidak ditemukan -->
					<p id="ruangan-tidak-ditemukan">Tidak ditemukan</p>

					<!-- Card ruangan -->
					<?php foreach ($ruangan as $key => $r) : ?>

						<?php
						$tipe_ruangan = $r['tipe']; // Masukkan tipe ke class untuk filter 
						?>
						<div class="col <?= $tipe_ruangan ?> mb-3">
							<div class="card">
								<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>" class="">

									<!-- Foto ruangan -->
									<?php if (!is_null($fotoruangan[$key])) : ?>

										<!-- Gambar ruangan -->
										<img class="card-img-top object-fit-cover" src="<?= base_url() ?>uploads/<?= $fotoruangan[$key]['nama_file'] ?>" width="100%" height="200">

									<?php else : ?>

										<!-- Gambar ruangan default -->
										<img class="card-img-top object-fit-scale" src="<?php echo base_url() ?>assets/Logo-PDIN.png" onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'" width="100%" height="200">

									<?php endif; ?>
									<!-- Akhir foto ruangan -->

									<!-- Judul ruangan -->
									<div class="card-title px-3 pt-3">

										<!-- Lantai ruangan -->
										<p class="text-danger fw-bold mb-2">Lantai
											<?php if ($r['lantai'] == 0) {
												echo 'Floor Ground';
											} else {
												echo $r['lantai'];
											} ?>
										</p>

										<!-- Judul ruangan -->
										<h5 class="crop-text-1" id="namaruangan">
											<?= $r['nama'] ?>
										</h5>

									</div>
									<!-- Akhir judul ruangan -->

									<!-- Deskripsi ruangan -->
									<div class="card-body pt-0">

										<!-- Teks deskripsi -->
										<p class="card-text crop-text-2">
											<?= $r['deskripsi'] ?>
										</p>

										<!-- Admin -->
										<?php if ($admin) : ?>

											<!-- Edit ruangan -->
											<a href="/admin/updateruangan/<?= $r['slug'] ?>" class="btn btn-warning">Edit</a>

											<!-- Hapus ruangan -->
											<form action="/admin/ruang/<?php echo $r['id'] ?>" method="post" class="d-inline">
												<?= csrf_field(); ?>
												<input type="hidden" name="_method" value="DELETE">
												<button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
											</form>

										<?php endif; ?>

									</div>
									<!-- Akhir deskripsi ruangan -->
								</a>
							</div>
						</div>

					<?php endforeach; ?>
					<!-- Akhir card ruangan -->

				</div>
				<!-- Akhir daftar ruangan -->

			</div>
			<!-- Akhir konten tab ruangan -->

			<!-- Konten tab alat -->
			<div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab" tabindex="0">

				<?php if ($admin) : ?>
					<!-- Admin -->
					<a class="btn btn-success mb-3" href="<?= base_url() . 'admin/tambahalat' ?>">Tambah
						Alat</a>
				<?php endif; ?>

				<!-- Daftar alat -->
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">

					<!-- Card alat -->
					<?php foreach ($alat as $key => $r) : ?>
						<div class="col mb-3">
							<div class="card">

								<!-- Link alat -->
								<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>">

									<!-- Foto alat -->
									<?php if (!is_null($fotoalat[$key])) : // Apabila alat memiliki foto 
									?>

										<!-- Gambar alat -->
										<img class="card-img-top object-fit-cover" src="<?= base_url() ?>uploads/<?= $fotoalat[$key]['nama_file'] ?>" width="100%" height="200">


									<?php else : // Apabila alat tidak memiliki foto 
									?>

										<!-- Gambar alat default -->
										<img class="card-img-top object-fit-scale" src="<?php echo base_url() ?>assets/Logo-PDIN.png" onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'" width="100%" height="200">

									<?php endif; ?>
									<!-- Akhir foto alat -->

									<!-- Nama alat -->
									<div class="card-title px-3 pt-3">
										<h5 class="crop-text-1" id="namaalat">
											<?= $r['nama'] ?>
										</h5>
									</div>
									<!-- Akhir nama alat -->

									<!-- Deskripsi alat -->
									<div class="card-body pt-0">
										<p class="card-text">
											<?= $r['deskripsi'] ?>
										</p>
									</div>
									<!-- Akhir deskripsi alat -->
								</a>

							</div>
						</div>
					<?php endforeach; ?>
					<!-- Akhir card alat -->

				</div>
				<!-- Akhir daftar alat -->

			</div>
			<!-- Akhir konten tab alat -->

		</div>
		<!-- Akhir section isi konten -->


	</div>
	<div class="container p-3"></div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Fitur cari ruangan dan alat -->
<script>
	$(document).ready(function() {
		$("#ruangan-tidak-ditemukan").hide();
		$("#cariruangan").on("keyup", function() {
			var keyword = $(this).val().toLowerCase();
			var ruanganNotFound = true; // Flag to track if matching element is not found

			$("#pills-ruangan").children().children().each(function() {
				var namaruanganText = $(this).find('#namaruangan').text().toLowerCase();
				var isMatch = namaruanganText.indexOf(keyword) > -1;

				$(this).toggle(isMatch);

				if (isMatch) {
					ruanganNotFound = false; // At least one matching element found
				}
			});

			// Show/hide "ruangan-tidak-ditemukan" based on the flag
			if (ruanganNotFound) {
				$("#ruangan-tidak-ditemukan").show();
			} else {
				$("#ruangan-tidak-ditemukan").hide();
			}
		});
	});
</script>

<!-- Toggle kolom filter dan cari -->
<script>
	$(document).ready(function() {
		$('#pills-tab').find('button').on('show.bs.tab', function() {
			$('#input-group').toggle();
			$('#input-cari-ruangan').toggle();
			$('#input-cari-alat').toggle();
		});
	});
</script>

<!-- Fitur filter ruangan -->
<script>
	$(document).ready(function() {
		$("#filter").on("change", function() {
			var value = $(this).val();
			$("#pills-ruangan").children().children().filter(function() {
				if (value == 'all') {
					$("#cariruangan").on("keyup", function() {
						var keyword = $(this).val().toLowerCase();
						$("#pills-ruangan").children().children().filter(function() {
							$(this).toggle($(this).find('#namaruangan').text()
								.toLowerCase().indexOf(
									keyword) > -1);
						});
					});
					$(this).show();

					var keyword = $("#cariruangan").val().toLowerCase();
					$("#pills-ruangan").children().children().filter(function() {
						$(this).toggle($(this).find('#namaruangan').text().toLowerCase()
							.indexOf(keyword) > -1);
					});
				} else {
					$("#cariruangan").on("keyup", function() {
						var keyword = $(this).val().toLowerCase();
						$("#pills-ruangan").children().children().filter(function() {
							$(this).toggle($(this).find('#namaruangan').text()
								.toLowerCase().indexOf(
									keyword) > -1 && $(this).hasClass(value));
						});
					});

					var keyword = $("#cariruangan").val().toLowerCase();
					$("#pills-ruangan").children().children().filter(function() {
						$(this).toggle($(this).find('#namaruangan').text().toLowerCase()
							.indexOf(keyword) > -
							1 && $(this).hasClass(value));
					});
					$(this).toggle($(this).find('#namaruangan').text().toLowerCase().indexOf(
							keyword) > -
						1 && $(this).hasClass(value));
				}
			});
		});
	});
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Initialisasi swiper fasilitas -->
<script>
	var swiperFasilitas = new Swiper(".swiper-fasilitas", {
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
		const wordLimit = 20;
		var ruanganBerfoto = <?= json_encode($ruangan_berfoto); ?>;
		var currentSlideIndex = 0;
		var namaRuangan = ruanganBerfoto[0].nama;
		var lantaiRuangan = "Lantai " + ruanganBerfoto[0].lantai;
		var deskripsiRuangan = ruanganBerfoto[0].deskripsi;

		// Truncate the description to the specified word limit
		var words = deskripsiRuangan.split(' ').slice(0, wordLimit);
		deskripsiRuangan = words.join(' ') + "...";

		$("#fasilitas-judul").text(namaRuangan);
		$("#fasilitas-lantai").text(lantaiRuangan);
		$("#fasilitas-deskripsi").text(deskripsiRuangan);

		swiperFasilitas.on('slideChange', function() {

			const index = swiperFasilitas.realIndex;

			namaRuangan = ruanganBerfoto[index].nama;
			lantaiRuangan = "Lantai " + ruanganBerfoto[index].lantai;
			deskripsiRuangan = ruanganBerfoto[index].deskripsi;

			// Truncate the description to the specified word limit
			var words = deskripsiRuangan.split(' ').slice(0, wordLimit);
			deskripsiRuangan = words.join(' ') + "...";

			$("#fasilitas-judul").text(namaRuangan);
			$("#fasilitas-lantai").text(lantaiRuangan);
			$("#fasilitas-deskripsi").text(deskripsiRuangan);
		});

	});
</script>
<?= $this->endSection() ?>