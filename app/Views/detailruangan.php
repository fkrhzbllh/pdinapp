<div class="bg-pdin-abu-terang px-2">
	<div class="container padding-tambahan bg-pdin-abu-terang"></div>
	<div class="container mt-5">
		<div class="mt-5 px-2">
			<div class="row p-5 pt-4 g-3 bg-white shadow-sm rounded-5">
				<?php if(session()->getFlashdata('sukses')) : ?>
				<div class="alert alert-success" role="alert">
					<?= session()->getFlashdata('sukses') ?>
				</div>
				<?php endif; ?>
				<!-- breadcrumb -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Beranda</a></li>
						<li class="breadcrumb-item"><a
								href="<?= ($admin) ? '/admin' : '/fasilitas' ?>">Fasilitas</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							<?php echo $ruangan['nama'] ?>
						</li>
					</ol>
				</nav>
				<div class="col-lg-8">
					<h4 class="mt-2 text-pdin-merah">
						<?= $ruangan['nama'] ?>
						<span class="m-3">
							<?php if ($admin) : ?>
							<a href="/admin/updateruangan/<?= $ruangan['slug'] ?>"
								class="btn btn-warning">Edit</a>
							<form
								action="/admin/ruang/<?php echo $ruangan['id']?>"
								method="post" class="d-inline">
								<?= csrf_field(); ?>
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit"
									onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
							</form>
							<?php endif; ?>
						</span>
					</h4>

					<h5 class="mt-4 mb-3">Foto Ruangan</h5>
					<?php if (is_array($fotoruangan) && sizeof($fotoruangan) > 1): ?>
					<!-- Swiper -->
					<div class="swiper mySwiper mb-2 pe-2">
						<div class="swiper-wrapper">
							<?php foreach ($fotoruangan as $key => $f): ?>
							<div class="swiper-slide">
								<img src="<?= base_url() . 'uploads/' . $f['nama_file'] ?>"
									alt="" class="img-fluid object-fit-cover rounded-4 mb-3"
									style="width: 100%; max-height: 450px" />
							</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<?php elseif (is_array($fotoruangan) && isset($fotoruangan[0])) :?>
					<!-- Swiper -->
					<div class="swiper mySwiper mb-2 pe-2">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<img src="<?= base_url() . 'uploads/' . $fotoruangan[0]['nama_file'] ?>"
									alt="" class="img-fluid object-fit-cover rounded-4 mb-3"
									style="width: 100%; max-height: 450px"
									onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'" />
							</div>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<?php else :?>
					<!-- Swiper -->
					<div class="swiper mySwiper mb-2 pe-2">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<img src="<?= base_url() . 'uploads/' . $fotoruangan['nama_file'] ?>"
									alt="" class="img-fluid object-fit-cover rounded-4 mb-3"
									style="width: 100%; max-height: 450px"
									onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'" />
							</div>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<?php endif; ?>

					<h5 class="mt-4 mb-3">Deskripsi</h5>
					<p class="mb-3">
						<?= $ruangan['deskripsi'] ?>
					</p>
					<div class="row p-0 m-0 mb-3">
						<!-- Tipe Ruangan -->
						<div class="col-md-4 p-0 m-0">
							<div class="row p-0 m-0 mb-2">
								<div class="col-1 m-0 p-0 align-self-start">
									<div class="text-center">
										<i class="bi bi-tag-fill" style="font-size: 14px; color: black"></i>
									</div>
								</div>
								<div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
									<p class="p-0 m-0 mb-1 fw-bold">Tipe:</p>
									<p class="p-0">Ruang
										<?= $ruangan['tipe'] ?>
									</p>
								</div>
							</div>
						</div>
						<!-- kegunaan Ruangan -->
						<div class="col-md-4 p-0 m-0">
							<div class="row p-0 m-0 mb-2">
								<div class="col-1 m-0 p-0 align-self-start">
									<div class="text-center">
										<i class="bi bi-archive-fill" style="font-size: 14px; color: black"></i>
									</div>
								</div>
								<div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
									<p class="p-0 m-0 mb-1 fw-bold">Kegunaan:</p>
									<p class="p-0">
										<?= $ruangan['kegunaan']?>
									</p>
								</div>
							</div>
						</div>
						<!-- Kapasitas Ruangan -->
						<div class="col-md-4 p-0 m-0">
							<div class="row p-0 m-0 mb-2">
								<div class="col-1 m-0 p-0 align-self-start">
									<div class="text-center">
										<i class="bi bi-people-fill" style="font-size: 14px; color: black"></i>
									</div>
								</div>
								<div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
									<p class="p-0 m-0 mb-1 fw-bold">Kapasitas:</p>
									<p class="p-0">
										<?= $ruangan['kapasitas']?>
										orang
									</p>
								</div>
							</div>
						</div>

						<!-- Luas Ruangan -->
						<div class="col-md-4 p-0 m-0">
							<div class="row p-0 m-0 mb-2">
								<div class="col-1 m-0 p-0 align-self-start">
									<div class="text-center">
										<i class="bi bi-aspect-ratio-fill" style="font-size: 14px; color: black"></i>
									</div>
								</div>
								<div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
									<p class="p-0 m-0 mb-1 fw-bold">Luas:</p>
									<p class="p-0">
										<?= $ruangan['luas']?>
										meter persegi
									</p>
								</div>
							</div>
						</div>
						<!-- Ukuran Ruangan -->
						<div class="col-md-4 p-0 m-0">
							<div class="row p-0 m-0 mb-2">
								<div class="col-1 m-0 p-0 align-self-start">
									<div class="text-center">
										<i class="bi bi-x-square-fill" style="font-size: 14px; color: black"></i>
									</div>
								</div>
								<div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
									<p class="p-0 m-0 mb-1 fw-bold">Ukuran:</p>
									<p class="p-0">
										<?= $ruangan['ukuran']?>
									</p>
								</div>
							</div>
						</div>
						<!-- Lantai Ruangan -->
						<div class="col-md-4 p-0 m-0">
							<div class="row p-0 m-0 mb-2">
								<div class="col-1 m-0 p-0 align-self-start">
									<div class="text-center">
										<i class="bi bi-stack" style="font-size: 14px; color: black"></i>
									</div>
								</div>
								<div class="col-10 text-start p-0 m-0 ms-1 align-self-end">
									<p class="p-0 m-0 mb-1 fw-bold">Lantai:</p>
									<p class="p-0">
										<?php if ($ruangan['lantai'] == 0) : echo 'Floor Ground'?>
										<?php else : echo $ruangan['lantai']; ?>
										<?php endif; ?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php // echo dd($fotoruangan)?>


					<!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
					<!-- <h5 class="mt-4 mb-3">
                <span><i class="bi bi-calendar-week text-black me-2"></i></span>
                Jadwal Pemakaian
              </h5> -->
					<h5 class="mt-4 mb-3">Jadwal Pemakaian</h5>
					<div class="pe-2">
						<div class="rounded-4 border border-1 border-opacity-50 p-4">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
				<!-- samping sticky -->
				<div class="col-lg-4">
					<div class="position-sticky mt-2" style="top: 8rem">
						<div class="ps-md-2">
							<div class="p-4 mb-3 bg-white rounded-4 border border-1">
								<h5 class="">Sewa Fasilitas</h5>
								<hr />
								<p class="fw-bold mb-2">Tarif Sewa:</p>
								<p class="bg-success text-white d-inline p-1 rounded-2" id="sewa">
									<?php // $ruangan['biaya_sewa']?>

								</p>
								<p class="fw-bold mt-3 mb-2">Syarat & Ketentuan:</p>
								<p class="">
									this section to tell your visitors a little bit about your
									publication, writers, content, or something else entirely.
									Totally up to you.
								</p>

								<div class="w-100 mt-4 mb-2">
									<a class="btn btn-danger d-block m-2 m-xl-0 mb-lg-2"
										href="https://wa.me/628978087902/?text=Halo%2C%20Admin%20PDIN.%0ASaya%20ingin%20bertanya%20tentang%20beberapa%20hal.%0A"
										target="_blank">Sewa</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container padding-tambahan bg-pdin-abu-terang"></div>
</div>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper('.mySwiper', {
		slidesPerView: 1,
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
	});
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			themeSystem: 'bootstrap5',
			locale: 'id',
			events: <?php echo (isset($jadwal_sewa)) ? json_encode($jadwal_sewa) : null; ?> , //array kegiatan -> objek kegiatan
		});
		calendar.render();
	});
</script>

<script>
	$(document).ready(function() {
		const formatter = new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR',

			// These options are needed to round to whole numbers if that's what you want.
			//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
			//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
		});
		var
			$biaya = <?php echo $ruangan['biaya_sewa']; ?> ;
		$('#sewa').text(formatter.format($biaya));
	});
</script>