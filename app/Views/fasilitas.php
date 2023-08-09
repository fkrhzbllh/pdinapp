<!-- ======= Judul Section ======= -->
<section id="background-hitam-atas" class="d-flex align-items-center">
	<div class="container">
		<div class="text-center">
			<h2 class="text-light my-4">Fasilitas</h2>
			<p class="text-light lh-base">
				Informasi terkait semua Fasilitas yang ada di Pusat Desain Industri
				Nasional adalah sebagai berikut.
			</p>
		</div>
	</div>
</section>
<!-- End Hero -->


<!-- ======= isi Section ======= -->
<section id="isi-section">
	<div class="container p-3">
		<div class="bg-white rounded-5 py-5 px-5 shadow-sm" id="">
			<!-- judul section -->
			<div class="row" data-aos="fade-up">
				<!-- <div class="d-flex flex-row"> -->
				<div class="col-12 col-md-6  ">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item pill-ruangan-alat me-1" role="presentation">
							<button class="nav-link active" id="pills-ruangan-tab" data-bs-toggle="pill"
								data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan"
								aria-selected="true">Ruangan</button>
						</li>
						<li class="nav-item pill-ruangan-alat" role="presentation">
							<button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill"
								data-bs-target="#pills-alat" type="button" role="tab" aria-controls="pills-alat"
								aria-selected="false">Alat</button>
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
									<option value="Pameran">Pameran</option>
									<option value="Kantor">Kantor</option>
									<option value="Meeting">Ruang Pertemuan</option>
									<option value="Pengembangan">Ruang Pengembangan</option>
									<option value="Lainnya">Lainnya</option>
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


			<!-- <div class="d-flex flex-column flex-sm-row text-center justify-content-center justify-content-md-between mb-4"
				data-aos="fade-up">
				<ul class="nav nav-pills mb-3 justify-content-left" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="pills-ruangan-tab" data-bs-toggle="pill"
							data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan"
							aria-selected="true">Ruangan</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill" data-bs-target="#pills-alat"
							type="button" role="tab" aria-controls="pills-alat" aria-selected="false">Alat</button>
					</li>
				</ul>
				<div class="input-group ms-auto" style="width: fit-content;height: fit-content;" id="input-group">
					<span class="input-group-text">Filter</span>
					<select class="form-select ms-auto" aria-label="Default select example" id="filter"
						style="width: fit-content;height: fit-content;">
						<option selected value="all">Semua</option>
						<option value="Pameran">Pameran</option>
						<option value="Kantor">Kantor</option>
						<option value="Meeting">Ruang Pertemuan</option>
						<option value="Pengembangan">Ruang Pengembangan</option>
						<option value="Lainnya">Lainnya</option>
					</select>
				</div>
				<input type="text" class="form-control ms-3" style="height: fit-content; width:fit-content;"
					id="cariruangan" placeholder="Cari ruangan...">
				<input type="text" class="form-control ms-auto"
					style="height: fit-content; width:fit-content; display:none;" id="carialat"
					placeholder="Cari alat...">
			</div> -->

			<div class="tab-content" id="pills-tabContent" data-aos="fade-up">
				<div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel"
					aria-labelledby="pills-ruangan-tab" tabindex="0">
					<?php if ($admin) : ?>
					<a class="btn btn-success mb-3"
						href="<?= base_url() . 'admin/tambahruangan'?>">Tambah
						Ruangan</a>
					<?php endif; ?>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">

						<!-- card ruangan -->
						<?php foreach($ruangan as $key => $r) : ?>

						<div
							class="col <?= $r['tipe']?> mb-3">
							<div class="card">

								<?php if (!is_null($fotoruangan[$key])) :?>
								<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>"
									class="">
									<img class="card-img-top object-fit-cover"
										src="<?= base_url()?>uploads/<?= $fotoruangan[$key]['nama_file'] ?>"
										width="100%" height="200">
								</a>
								<?php else :?>
								<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>"
									class="">
									<img class="card-img-top object-fit-scale"
										src="<?php echo base_url() ?>assets/Logo-PDIN.png"
										onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'"
										width="100%" height="200">
								</a>
								<?php endif; ?>
								<!-- <h5 class="card-header">Featured</h5> -->
								<div class="card-title px-3 pt-3">
									<p class="text-danger fw-bold mb-2">Lantai
										<?php if($r['lantai'] == 0) {
											echo 'Floor Ground';
										} else {
											echo $r['lantai'];
										} ?>
									</p>
									<a href="<?= ($admin) ? '/admin/ruang/' . $r['slug'] : '/fasilitas/ruang/' . $r['slug']; ?>"
										class="">
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
									<a href="/admin/updateruangan/<?= $r['slug'] ?>"
										class="btn btn-warning">Edit</a>
									<form
										action="/admin/ruang/<?php echo $r['id']?>"
										method="post" class="d-inline">
										<?= csrf_field(); ?>
										<input type="hidden" name="_method" value="DELETE">
										<button class="btn btn-danger" type="submit"
											onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
									</form>

									<?php endif; ?>
									<!-- <a href="/fasilitas/ruang/<?php echo $r['slug']; ?>"
									class="btn btn-primary">Detail
									</a> -->
								</div>
							</div>
						</div>

						<?php endforeach; ?>

					</div>
				</div>
				<div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab"
					tabindex="0">
					<?php if ($admin) : ?>
					<a class="btn btn-success mb-3"
						href="<?= base_url() . 'admin/tambahalat'?>">Tambah
						Alat</a>
					<?php endif; ?>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">
						<!-- card alat -->
						<?php foreach($alat as $key => $r) : ?>
						<div class="col mb-3">
							<div class="card">
								<?php if (!is_null($fotoalat[$key])) :?>
								<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>"
									class="">
									<img class="card-img-top object-fit-cover"
										src="<?= base_url()?>uploads/<?= $fotoalat[$key]['nama_file'] ?>"
										width="100%" height="200">
								</a>
								<?php else :?>
								<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>"
									class="">
									<img class="card-img-top object-fit-scale"
										src="<?php echo base_url() ?>assets/Logo-PDIN.png"
										onerror="this.onerror=null; this.src='<?php echo base_url() ?>assets/Logo-PDIN.png'"
										width="100%" height="200">
								</a>
								<?php endif; ?>
								<!-- <h5 class="card-header">Featured</h5> -->
								<div class="card-title px-3 pt-3">
									<a href="<?= ($admin) ? '/admin/alat/' . $r['slug'] : '/fasilitas/alat/' . $r['slug']; ?>"
										class="">
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
	</div>
	<div class="container p-3"></div>
</section>


<!-- fitur cari ruangan dan alat -->
<script>
	$(document).ready(function() {
		$("#cariruangan").on("keyup", function() {
			var keyword = $(this).val().toLowerCase();
			$("#pills-ruangan").children().children().filter(function() {
				$(this).toggle($(this).find('#namaruangan').text().toLowerCase().indexOf(keyword) >
					-1)
			});
		});
		$("#carialat").on("keyup", function() {
			var keyword = $(this).val().toLowerCase();
			$("#pills-alat").children().children().filter(function() {
				$(this).toggle($(this).find('#namaalat').text().toLowerCase().indexOf(keyword) > -
					1)
			});
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

<!-- fitur filter ruangan -->
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