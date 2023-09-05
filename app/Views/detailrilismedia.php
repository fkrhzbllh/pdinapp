<?php

/**
 * TODO:
 * Sosmed belum work
 * Responsivitas sidebar belum diatur
 */
?>
<?= $this->extend('layout/template') ?>

<?= $this->section('style') ?>
<!-- Pindah ke style -->
<style>
	/* Style sidebar */
	.sticky-top {
		top: 5rem;
	}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section id="section-konten">
	<div class="container container-konten">
		<div class="row">

			<!-- Konten artikel -->
			<div class="col-lg-8">

				<!-- Breadcrumb -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">

						<!-- TODO: Hardcoded breadcrumb -->
						<li class="breadcrumb-item"><a href="/">Beranda</a></li>
						<li class="breadcrumb-item"><a href="/rilis-media">Rilis Media</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<?php echo $artikel['judul'] ?>
						</li>
					</ol>
				</nav>

				<!-- Judul artikel -->
				<h3 class="mb-2">
					<?php echo $artikel['judul'] ?>
				</h3>

				<!-- Tanggal TODO: Hardcoded 'Rilis Media' and 'PDIN text' -->
				<p class="mt-3 mb-2">
					Rilis Media -
					<?= $artikel['tgl_terbit_terformat'] ?>
					- Pusat Desain Industri Nasional
				</p>
				<img src="<?php echo base_url() . 'uploads/' . $artikel['featured_image'] ?>" alt="" class="img-fluid object-fit-cover rounded-2 my-3" style="width: 100%; max-height: 450px" />
				<?= $artikel['konten'] ?>
			</div>
			<!-- Akhir konten artikel -->

			<!-- Sidebar sticky -->
			<div class="col-lg-4">
				<div class="sticky-top">

					<!-- Judul sidebar -->
					<h5>Share</h5>

					<!-- Input link siap copy -->
					<div class="input-group mb-3">
						<input type="text" class="form-control bg-light text-secondary" placeholder="" aria-label="" aria-describedby="copy-link" value="<?= base_url() . 'rilismedia/' . $artikel['slug'] ?>" id="myInput" />
						<div class="input-group-append">
							<div class="tooltip"></div>
							<button class="btn btn-danger btn-lg rounded-start-0" type="button" onclick="myFunction()" onmouseout="outFunc()">
								<span class="bi-link"></span>
							</button>
						</div>
					</div>

					<!-- Tombol share sosmed -->
					<div class="d-flex flex-grow-1 justify-content-center justify-content-xl-between flex-wrap">
						<a class="btn btn-facebook-1 m-2 m-xl-0 mb-lg-2" href="#" target=""><small><span class="bi bi-facebook me-2"></span>Facebook</small></a>
						<a class="btn btn-twitter-1 m-2 m-xl-0 mb-lg-2" href="#" target=""><small><span class="bi bi-twitter me-2"></span>Twitter</small></a>

						<a class="btn btn-linkedin-1 m-2 m-xl-0 mb-lg-2" href="#" target=""><small><span class="bi bi-linkedin me-2"></span>LinkedIn</small></a>
					</div>

					<!-- Artikel pilihan -->
					<h5 class="my-3">Untuk Anda</h5>

					<?php foreach ($artikelPilihan as $i => $a) : ?>

						<!-- Item artikel -->
						<div class="card mb-2">
							<div class="row g-0">

								<!-- Gambar kegiatan -->
								<div class="col-3 position-relative">
									<img src="<?php echo base_url() . 'uploads/' . $a['featured_image'] ?>" class="card-img object-fit-cover w-100 h-100" alt="..." />
								</div>

								<!-- Ringkasan kegiatan -->
								<div class="col-9">

									<!-- Body kegiatan -->
									<div class="card-body p-2">

										<!-- Judul kegiatan -->
										<p class="card-title">
											<a class="link-dark text-decoration-none crop-text-2" href="#" target="_blank">
												<b>
													<?php echo $a['judul']; ?>
												</b>
											</a>
										</p>

										<!-- Kategori dan tanggal terbit -->
										<small class="card-text crop-text-2">
											<?php echo $a['kategori']; ?> | <?php echo $a['tgl_terbit_terformat']; ?></small>
									</div>
									<!-- Akhir body kegiatan -->

								</div>
								<!-- Akhir ringkasan kegiatan -->

							</div>
						</div>
						<!-- Akhir item artikel -->
					<?php endforeach; ?>

				</div>
			</div>
			<!-- Akhir sidebar sticky -->

		</div>
	</div>
</section>
<?= $this->endSection() ?>