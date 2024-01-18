<?php

/**
 * TODO:
 * Sosmed belum work
 * Responsivitas sidebar belum diatur
 */
?>
<?= $this->extend('layout/template') ?>

<?= $this->section('meta') ?>
<meta name="description" content="<?= $artikel['excerp'] ?>">
<?= $this->endSection() ?>

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
						<input type="text" class="form-control bg-light text-secondary" placeholder="" aria-label="" aria-describedby="copy-link" value="<?= base_url() . 'rilis-media/' . $artikel['slug'] ?>" id="myInput" />
						<div class="input-group-append">
							<div class="tooltip"></div>
							<button class="btn btn-danger btn-lg rounded-start-0" type="button" onclick="myFunction()" onmouseout="outFunc()">
								<span class="bi-link"></span>
							</button>
						</div>
					</div>

					<!-- Tombol share sosmed -->
					<div class="d-flex flex-grow-1 justify-content-center justify-content-xl-between flex-wrap">
						<div class="fb-share-button" data-href="<?= 'https://' . base_url() . 'rilis-media/' . $artikel['slug'] ?>" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= 'https://pdin.id/' . 'rilis-media/' . $artikel['slug'] ?>" class="fb-xfbml-parse-ignore btn btn-facebook-1 m-2 m-xl-0 mb-lg-2"><span class="bi bi-facebook me-2"></span>Share</a></div>
						<a class="twitter-share-button btn btn-twitter-1 m-2 m-xl-0 mb-lg-2" href="https://twitter.com/intent/tweet?url=<?= 'https://pdin.id/' . 'rilis-media/' . $artikel['slug'] ?>&via=pdin_id" data-size="large" data-url="<?= base_url() . 'rilis-media/' . $artikel['slug'] ?>" target="_blank">
							<span class="bi bi-twitter me-2"></span>Tweet
						</a>
						<a class="btn btn-linkedin-1 m-2 m-xl-0 mb-lg-2" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= 'https://' . urlencode('pdin.id/' . 'rilis-media/' . $artikel['slug']) ?>" target="_blank"><small><span class="bi bi-linkedin me-2"></span>LinkedIn</small></a>
						<!-- <a class="btn btn-facebook-1 m-2 m-xl-0 mb-lg-2" href="#" target=""><small><span class="bi bi-facebook me-2"></span>Facebook</small></a> -->
						<!-- <a class="btn btn-twitter-1 m-2 m-xl-0 mb-lg-2" href="#" target=""><small><span class="bi bi-twitter me-2"></span>Twitter</small></a> -->
						<!-- <a class="btn btn-linkedin-1 m-2 m-xl-0 mb-lg-2" href="#" target=""><small><span class="bi bi-linkedin me-2"></span>LinkedIn</small></a> -->
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
											<a class="link-dark text-decoration-none crop-text-2" href="<?= base_url() . 'rilis-media/' . $a['slug'] ?>">
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

<?= $this->section('script') ?>
<!-- Copy input -->
<script>
	function myFunction() {
		var copyText = document.getElementById('myInput');
		copyText.select();
		copyText.setSelectionRange(0, 99999);
		navigator.clipboard.writeText(copyText.value);
	}
</script>

<!-- share facebook -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0" nonce="APU2E6xs"></script>

<!-- share linkedin -->
<script src="https://platform.linkedin.com/in.js" type="text/javascript">
	lang: en_US
</script>
<script type="IN/Share" data-url="https://www.linkedin.com"></script>

<?= $this->endSection() ?>