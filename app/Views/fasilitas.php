<?php

/**
 * TODO: 
 * Rapikan & kasih dokumentasi
 * Pindah script ke footer
 */

helper('text'); ?>

<!-- Section judul -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<section class="d-flex align-items-center p-0" style="margin-top: 160px;">
	<div class="container">
		<div class="col-12">

			<!-- Demo styles -->
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

			<!-- Swiper -->
			<div class=" swiper swiper-fasilitas">
				<div class="swiper-wrapper">
					<?php foreach ($ruangan_berfoto as $key => $r) : ?>
						<?php //if (!is_null($fotoruangan[$key])) : 
						?>
						<div class="swiper-slide rounded-4">
							<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>">
								<img src="<?= base_url() ?>uploads/<?= $foto_ruangan_berfoto[$key]['nama_file'] ?>" id="foto-ruangan-<?= $key ?>">
							</a>
						</div>
						<?php //endif 
						?>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>

			<div class="text-center">
				<div class="row">
					<div class="col-12 col-xl-6 mx-auto">
						<p class="text-danger fw-bold mt-4 mb-2" id="fasilitas-lantai">Lantai</p>
						<h2 class="mb-4" id="fasilitas-judul">Fasilitas</h2>
						<p id="fasilitas-deskripsi" class="fs-6">Deskripsi fasilitas</p>
					</div>
				</div>
			</div>

		</div>
	</div>
	</div>
	</div>
</section>
<!-- Akhir section judul  -->


<!-- ======= isi Section ======= -->
<section id="section-konten-secondary">
	<div class="container container-konten">

		<!-- judul section -->
		<div class="row" data-aos="fade-up">
			<!-- <div class="d-flex flex-row"> -->
			<div class="col-12 col-md-6  ">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item pill-ruangan-alat me-1" role="presentation">
						<button class="nav-link active" id="pills-ruangan-tab" data-bs-toggle="pill" data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan" aria-selected="true">Ruangan</button>
					</li>
					<li class="nav-item pill-ruangan-alat" role="presentation">
						<button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill" data-bs-target="#pills-alat" type="button" role="tab" aria-controls="pills-alat" aria-selected="false">Alat</button>
					</li>
				</ul>
			</div>
			<div class="col-12 col-md-6">
				<div class="row mb-3">
					<div class="col-12 col-sm-6 my-1">
						<div class="input-group" id="input-group">
							<!-- <span class="input-group-text">Filter</span> -->
							<select class="form-select ms-auto " aria-label="Default select example" id="filter">
								<option selected value="all">Semua Tipe Ruangan</option>
								<?php foreach ($tipe_ruangan as $key => $tr) : ?>
									<option value="<?= $tr ?>"><?= $tr ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 my-1">
						<div id="input-cari-ruangan" class="input-group mb-3">
							<input type="text" class="form-control " id="cariruangan" placeholder="Cari ruangan...">
							<span class="input-group-text bi-search text-bg-danger" id=""></span>
						</div>
						<div id="input-cari-alat" style=" display:none;" class="input-group mb-3">
							<input type="text" class="form-control " id="carialat" placeholder="Cari alat...">
							<span class="input-group-text bi-search text-bg-danger" id=""></span>
						</div>
						<!-- <input type="text" class="form-control " style="" id="cariruangan" placeholder="Cari ruangan..."> -->
						<!-- <input type="text" class="form-control " style=" display:none;" id="carialat" placeholder="Cari alat..."> -->
					</div>
					<!-- <div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
							<div class="btn btn-danger" type="button"><span class="bi bi-search"></span></div>
						</div> -->
				</div>
			</div>
		</div>

		<div class="tab-content" id="pills-tabContent" data-aos="fade-up">
			<div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel" aria-labelledby="pills-ruangan-tab" tabindex="0">
				<?php if ($admin) : ?>
					<a class="btn btn-success mb-3" href="<?= base_url() . 'admin/tambahruangan' ?>">Tambah
						Ruangan</a>
				<?php endif; ?>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">

					<p id="ruangan-tidak-ditemukan">Tidak ditemukan</p>

					<!-- card ruangan -->
					<?php foreach ($ruangan as $key => $r) : ?>

						<div class="col <?= $r['tipe'] ?> mb-3">
							<div class="card">

								<?php if (!is_null($fotoruangan[$key])) : ?>
									<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>" class="">
										<img class="card-img-top object-fit-cover" src="<?= base_url() ?>uploads/<?= $fotoruangan[$key]['nama_file'] ?>" width="100%" height="200">
									</a>
								<?php else : ?>
									<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>" class="">
										<img class="card-img-top object-fit-scale" src="<?php echo base_url() ?>assets/Logo-PDIN.png" onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'" width="100%" height="200">
									</a>
								<?php endif; ?>
								<!-- <h5 class="card-header">Featured</h5> -->
								<div class="card-title px-3 pt-3">
									<p class="text-danger fw-bold mb-2">Lantai
										<?php if ($r['lantai'] == 0) {
											echo 'Floor Ground';
										} else {
											echo $r['lantai'];
										} ?>
									</p>
									<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>" class="">
										<h5 class="crop-text-1" id="namaruangan">
											<?= $r['nama'] ?>
										</h5>
									</a>
								</div>
								<div class="card-body pt-0">

									<p class="card-text crop-text-2">
										<?= $r['deskripsi'] ?>
									</p>
									<?php if ($admin) : ?>
										<a href="/admin/updateruangan/<?= $r['slug'] ?>" class="btn btn-warning">Edit</a>
										<form action="/admin/ruang/<?php echo $r['id'] ?>" method="post" class="d-inline">
											<?= csrf_field(); ?>
											<input type="hidden" name="_method" value="DELETE">
											<button class="btn btn-danger" type="submit" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
										</form>

									<?php endif; ?>

								</div>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
			</div>
			<div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab" tabindex="0">
				<?php if ($admin) : ?>
					<a class="btn btn-success mb-3" href="<?= base_url() . 'admin/tambahalat' ?>">Tambah
						Alat</a>
				<?php endif; ?>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">
					<!-- card alat -->
					<?php foreach ($alat as $key => $r) : ?>
						<div class="col mb-3">
							<div class="card">
								<?php if (!is_null($fotoalat[$key])) : ?>
									<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>" class="">
										<img class="card-img-top object-fit-cover" src="<?= base_url() ?>uploads/<?= $fotoalat[$key]['nama_file'] ?>" width="100%" height="200">
									</a>
								<?php else : ?>
									<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>" class="">
										<img class="card-img-top object-fit-scale" src="<?php echo base_url() ?>assets/Logo-PDIN.png" onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'" width="100%" height="200">
									</a>
								<?php endif; ?>
								<!-- <h5 class="card-header">Featured</h5> -->
								<div class="card-title px-3 pt-3">
									<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>" class="">
										<h5 class="crop-text-1" id="namaalat">
											<?= $r['nama'] ?>
										</h5>
									</a>
								</div>
								<div class="card-body pt-0">
									<p class="card-text">
										<?= $r['deskripsi'] ?>
									</p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>


	</div>
	<div class="container p-3"></div>
</section>


<!-- fitur cari ruangan dan alat -->
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

<!-- toggle kolom filter dan cari -->
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