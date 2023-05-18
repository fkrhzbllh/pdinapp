<div class="container">
	<div class="row">
		<div class="column">
			<h1 class="mt-3">fasilitas</h1>

			<!-- <div class="d-flex flex-row">
                <ul class="nav nav-pills mb-3 justify-content-left" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-ruangan-tab" data-bs-toggle="pill" data-bs-target="#pills-ruangan" type="button" role="tab" aria-controls="pills-ruangan" aria-selected="true">Ruangan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-alat-tab" data-bs-toggle="pill" data-bs-target="#pills-alat" type="button" role="tab" aria-controls="pills-alat" aria-selected="false">Alat</button>
                    </li>
                </ul>
                <div class="input-group ms-auto" style="width: fit-content;height: fit-content;" id="input-group">
                    <span class="input-group-text">Filter</span>
                    <select class="form-select ms-auto" aria-label="Default select example" id="filter" style="width: fit-content;height: fit-content;">
                        <option selected value="all">Semua</option>
                        <option value="Pameran">Pameran</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Meeting">Ruang Pertemuan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <input type="text" class="form-control ms-3" style="height: fit-content; width:fit-content;" id="cariruangan" placeholder="Cari ruangan...">
                <input type="text" class="form-control ms-auto" style="height: fit-content; width:fit-content; display:none;" id="carialat" placeholder="Cari alat...">
            </div> -->

			<!-- <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel" aria-labelledby="pills-ruangan-tab" tabindex="0">
                    <div class="row justify-content-start mb-5">
                        <?php foreach($ruangan as $key => $r) : ?>
			<div
				class="col-4 <?= $r['tipe']?> mb-3">
				<div class="card">
					<?php if (!is_null($fotoruangan[$key])) :?>
					<img class="card-img-top"
						src="<?= base_url()?>uploads/<?= $fotoruangan[$key]['nama_file'] ?>">
					<?php else :?>
					<img class="card-img-top"
						src="<?php echo base_url() ?>Logo-PDIN.png"
						onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'">
					<?php endif; ?>
					<div class="card-body">
						<p class="small">Lantai
							<?= $r['lantai'] ?>
						</p>
						<h3 class="card-title">
							<?= $r['nama'] ?>
						</h3>
						<p class="card-text">
							<?= $r['deskripsi'] ?>
						</p>
						<a href="/fasilitas/ruang/<?php echo $r['slug']; ?>"
							class="stretched-link"></a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php //echo $pager->links('ruangan','pager')?>
	</div>
	<div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab" tabindex="0">
		<div class="row justify-content-start mb-5">
			<?php foreach($alat as $key => $a) : ?>
			<div class="col-4">
				<div class="card">
					<?php if (!is_null($fotoalat[$key])) :?>
					<img class="card-img-top"
						src="<?= base_url()?>uploads/<?= $fotoalat[$key]['nama_file'] ?>">
					<?php else :?>
					<img class="card-img-top"
						src="<?php echo base_url() ?>Logo-PDIN.png"
						onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'">
					<?php endif; ?>
					<div class="card-body">
						<h3 class="card-title">
							<?= $a['nama'] ?>
						</h3>
						<p class="card-text">
							<?= $a['deskripsi'] ?>
						</p>
						<a href="/fasilitas/alat/<?php echo $a['slug']; ?>"
							class="stretched-link"></a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php // echo $pager->links('alat','pager')?>
	</div>
</div> -->
</div>
</div>
</div>

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
			<div class="d-flex flex-column flex-sm-row text-center justify-content-center justify-content-md-between mb-4"
				data-aos="fade-up">
				<!-- <div class="d-flex flex-row"> -->
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
						<option value="Lainnya">Lainnya</option>
					</select>
				</div>
				<input type="text" class="form-control ms-3" style="height: fit-content; width:fit-content;"
					id="cariruangan" placeholder="Cari ruangan...">
				<input type="text" class="form-control ms-auto"
					style="height: fit-content; width:fit-content; display:none;" id="carialat"
					placeholder="Cari alat...">
				<!-- </div> -->

				<!-- garis -->
				<!-- <div class="d-none d-md-block flex-md-grow-1 p-0">
              <hr />
            </div> -->
				<!-- filter dropdown tipe ruangan -->
				<!-- <div class="mb-3 mx-3">
              <div class="dropdown">
                <a
                  class="btn btn-outline-dark dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Pilih Tipe Ruangan
                </a>

                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Pameran</a></li>
                  <li><a class="dropdown-item" href="#">Kantor</a></li>
                  <li><a class="dropdown-item" href="#">Lainnya</a></li>
                </ul>
              </div>
            </div> -->
				<!-- input pencarian -->
				<!-- <div class="">
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Cari Fasilitas"
                  aria-label=""
                  aria-describedby="basic-addon2"
                />
                <span
                  class="input-group-text bi-search text-bg-danger"
                  id="basic-addon2"
                ></span>
              </div>
            </div> -->
			</div>

			<div class="tab-content" id="pills-tabContent" data-aos="fade-up">
				<div class="tab-pane fade show active" id="pills-ruangan" role="tabpanel"
					aria-labelledby="pills-ruangan-tab" tabindex="0">
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">
						<!-- card ruangan -->
						<!-- <div class="col">
                        <a href="fasilitasdetail.html">
                          <div class="card">
                            <img
                              src="./assets/hero-bg-2.jpg"
                              class="card-img-top object-fit-cover"
                              width="100%"
                              height="200"
                              alt=""
                            />
                            <div class="card-title px-3 pt-3">
                              <h6 class="text-danger">Lantai 1</h6>
                              <h5>Ruang Audio Video</h5>
                            </div>
                            <div class="card-body pt-0">
                              <p class="card-text">
                                This is a wider card with supporting text below as a
                                natural lead-in to additional content. This content is a
                                little bit longer.
                              </p>
                              <div class="d-flex justify-content-end align-items-center">
                                <a href="#"
                                  ><small class="text-body-secondary"
                                    >Lihat selengkapnya</small
                                  ></a
                                >
                              </div>
                            </div>
                          </div>
                        </a>
                      </div> -->
						<!-- card ruangan -->
						<?php foreach($ruangan as $key => $r) : ?>
						<div
							class="col-4 <?= $r['tipe']?> mb-3">
							<div class="card">
								<?php if (!is_null($fotoruangan[$key])) :?>
								<img class="card-img-top object-fit-cover"
									src="<?= base_url()?>uploads/<?= $fotoruangan[$key]['nama_file'] ?>"
									width="100%" height="200">
								<?php else :?>
								<img class="card-img-top object-fit-cover"
									src="<?php echo base_url() ?>Logo-PDIN.png"
									onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'"
									width="100%" height="200">
								<?php endif; ?>
								<!-- <h5 class="card-header">Featured</h5> -->
								<div class="card-title px-3 pt-3">
									<h6 class="text-danger">Lantai
										<?= $r['lantai'] ?>
									</h6>
									<h5><?= $r['nama'] ?>
									</h5>
								</div>
								<div class="card-body pt-0">
									<p class="card-text">
										<?= $r['deskripsi'] ?>
									</p>
									<a href="/fasilitas/ruang/<?php echo $r['slug']; ?>"
										class="stretched-link"></a>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="pills-alat" role="tabpanel" aria-labelledby="pills-alat-tab" tabindex="0">
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3 mb-4">
					<!-- card alat -->
					<?php foreach($alat as $key => $r) : ?>
					<div class="col-4 mb-3">
						<div class="card">
							<?php if (!is_null($fotoalat[$key])) :?>
							<img class="card-img-top object-fit-cover"
								src="<?= base_url()?>uploads/<?= $fotoalat[$key]['nama_file'] ?>"
								width="100%" height="200">
							<?php else :?>
							<img class="card-img-top object-fit-cover"
								src="<?php echo base_url() ?>Logo-PDIN.png"
								onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'"
								width="100%" height="200">
							<?php endif; ?>
							<!-- <h5 class="card-header">Featured</h5> -->
							<div class="card-title px-3 pt-3">
								<h5><?= $r['nama'] ?>
								</h5>
							</div>
							<div class="card-body pt-0">
								<p class="card-text">
									<?= $r['deskripsi'] ?>
								</p>
								<a href="/fasilitas/alat/<?php echo $r['slug']; ?>"
									class="stretched-link"></a>
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
		$("#cariruangan").on("keyup", function() {
			var keyword = $(this).val().toLowerCase();
			$("#pills-ruangan").children().children().filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
			});
		});
		$("#carialat").on("keyup", function() {
			var keyword = $(this).val().toLowerCase();
			$("#pills-alat").children().children().filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
			});
		});
	});
</script>

<!-- toggle kolom filter dan cari -->
<script>
	$(document).ready(function() {
		$('#pills-tab').find('button').on('show.bs.tab', function() {
			$('#input-group').toggle();
			$('#cariruangan').toggle();
			$('#carialat').toggle();
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
							$(this).toggle($(this).text().toLowerCase().indexOf(
								keyword) > -1);
						});
					});
					$(this).show();

					var keyword = $("#cariruangan").val().toLowerCase();
					$("#pills-ruangan").children().children().filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
					});
				} else {
					$("#cariruangan").on("keyup", function() {
						var keyword = $(this).val().toLowerCase();
						$("#pills-ruangan").children().children().filter(function() {
							$(this).toggle($(this).text().toLowerCase().indexOf(
								keyword) > -1 && $(this).hasClass(value));
						});
					});

					var keyword = $("#cariruangan").val().toLowerCase();
					$("#pills-ruangan").children().children().filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -
							1 && $(this).hasClass(value));
					});
					$(this).toggle($(this).hasClass(value));
				}
			});
		});
	});
</script>