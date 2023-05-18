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
				<div class="col-lg-8">
					<h4 class="mt-2 text-pdin-merah">
						<?= $ruangan['nama'] ?>
					</h4>
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
									<p class="p-0">Pameran, Rapat, Pelatihan</p>
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
										<?= $ruangan['lantai']?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php // echo dd($fotoruangan)?>

					<h5 class="mt-4 mb-3">Foto Ruangan</h5>
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
					</div>
					<!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
					<div class="swiper-pagination"></div>
				</div>
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
							<p class="bg-success text-white d-inline p-1 rounded-2">
								Rp 500.000
							</p>
							<p class="fw-bold mt-3 mb-2">Syarat & Ketentuan:</p>
							<p class="">
								this section to tell your visitors a little bit about your
								publication, writers, content, or something else entirely.
								Totally up to you.
							</p>
							<!-- <dl class="row p-0 m-0">
                      <dt class="col-sm-4 p-0 m-0">Kapasitas</dt>
                      <dd class="col-sm-8 p-0 m-0">
                        <p>5000 orang.</p>
                      </dd>
                      <dt class="col-sm-4 p-0 m-0">Luas</dt>
                      <dd class="col-sm-8 p-0 m-0">
                        <p>3.02x3.02m</p>
                      </dd>
                      <dt class="col-sm-4 p-0 m-0 pe-1">Sarana Pendukung</dt>
                      <dd class="col-sm-8 p-0 m-0">
                        <p>
                          LED Projector, Kursi, Meja, dan, Air Conditioner,
                          Sound System
                        </p>
                      </dd>
                      <dt class="col-sm-4 p-0 m-0">Tarif</dt>
                      <dd class="col-sm-8 p-0 m-0">
                        <p>Rp 105.000/Jam</p>
                      </dd>
                    </dl> -->
							<div class="w-100 mt-4 mb-2">
								<a class="btn btn-danger d-block m-2 m-xl-0 mb-lg-2" href="" target="_blank">Sewa</a>
							</div>
						</div>
					</div>

					<!-- <div class="pt-4 ps-2">
                  <h5 class="">Share</h5>
                  
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      class="form-control bg-light text-secondary"
                      placeholder=""
                      aria-label=""
                      aria-describedby="copy-link"
                      value="https://www.pdin.id/rilismedia/grand+launching+pusat+design+industri+nasional"
                      id="myInput"
                    />
                    <div class="input-group-append">
                      <div class="tooltip"></div>
                      <button
                        class="btn btn-danger btn-lg rounded-start-0"
                        type="button"
                        onclick="myFunction()"
                        onmouseout="outFunc()"
                      >
                        <span class="bi-link"></span>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div
                      class="d-flex flex-grow-1 justify-content-center justify-content-xl-between flex-wrap"
                    >
                      <a
                        class="btn btn-facebook-1 m-2 m-xl-0 mb-lg-2"
                        href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fcss-tricks.com%2F"
                        target="_blank"
                        ><span class="bi bi-facebook me-2"></span>Facebook</a
                      >
                      <a
                        class="btn btn-twitter-1 m-2 m-xl-0 mb-lg-2"
                        href="https://twitter.com/intent/tweet
                      ?url=http%3A%2F%2Fcss-tricks.com%2F
                      &text=Tips%2C+Tricks%2C+and+Techniques+on+using+Cascading+Style+Sheets.
                      &hashtags=css,html"
                        target="_blank"
                        ><span class="bi bi-twitter me-2"></span>Twitter</a
                      >
  
                      <a
                        class="btn btn-linkedin-1 m-2 m-xl-0 mb-lg-2"
                        href="https://www.linkedin.com/sharing/share-offsite/?url=https://css-tricks.com"
                        target="_blank"
                        ><span class="bi bi-linkedin me-2"></span>LinkedIn</a
                      >
                    </div>
                  </div>
                </div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container padding-tambahan bg-pdin-abu-terang"></div>
<!-- </div> -->
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
<div class="container mt-3">
	<div class="row justify-content-center align-items-center">
		<?php if(session()->getFlashdata('sukses')) : ?>
		<div class="alert alert-success" role="alert">
			<?= session()->getFlashdata('sukses') ?>
		</div>
		<?php endif; ?>
		<div class="card mb-3">
			<?php if (is_array($fotoruangan) && sizeof($fotoruangan) > 1):?>
			<div id="carouselExampleIndicators" class="carousel slide card-img-top">
				<div class="carousel-indicators">
					<?php foreach ($fotoruangan as $key => $value) :?>
					<?php if ($key == 0) :?>
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
						class="active" aria-current="true" aria-label="Slide 1"></button>
					<?php else :?>
					<button type="button" data-bs-target="#carouselExampleIndicators"
						data-bs-slide-to="<?= $key ?>"
						aria-label="Slide <?= $key - 1 ?>"></button>
					<!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
					<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<div class="carousel-inner">
					<?php foreach ($fotoruangan as $key => $value) :?>
					<?php if ($key == 0) :?>
					<div class="carousel-item active">
						<img src="<?php echo base_url() ?>uploads/<?= $value['nama_file']?>"
							class="d-block w-100" alt="...">
					</div>
					<?php else :?>
					<div class="carousel-item">
						<img src="<?php echo base_url() ?>uploads/<?= $value['nama_file']?>"
							class="d-block w-100" alt="...">
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
					<!-- <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="...">
                        </div> -->
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
					data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
					data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
			<?php elseif (is_array($fotoruangan) && isset($fotoruangan[0])) :?>
			<img src="<?php echo base_url() ?>uploads/<?= $fotoruangan[0]['nama_file'] ?>"
				class="card-img-top" alt="tidak ada gambar"
				onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'">
			<?php else :?>
			<img src="<?php echo base_url() ?>uploads/<?= $fotoruangan['nama_file'] ?>"
				class="card-img-top" alt="tidak ada gambar"
				onerror="this.onerror=null; this.src='<?php echo base_url() ?>Logo-PDIN.png'">
			<?php endif; ?>
			<div class="card-body">
				<h5 class="card-title">
					<?= $ruangan['nama'] ?>
				</h5>
				<p class="card-text">
					<?= $ruangan['deskripsi'] ?>
				</p>
				<p class="border border-1 rounded border-danger"
					style="padding-left: 10px; padding-right: 10px; width:fit-content;">
					<?= $ruangan['tipe'] ?>
				</p>
				<p class="card-text">Kapasitas :
					<b><?= $ruangan['kapasitas']?></b>
				</p>
				<p class="card-text">Fasilitas :
					<b><?= $ruangan['fasilitas']?></b>
				</p>
				<p class="card-text">Ukuran :
					<b><?= $ruangan['ukuran']?></b>
				</p>
				<p class="card-text mb-5">Biaya sewa :
					<b><?= $ruangan['biaya_sewa']?></b>
				</p>
				<a class="btn btn-primary"
					href="/fasilitas/sewaruangan/<?= $ruangan['id'] ?>">Sewa
					Ruangan</a>
				<p class="card-text mb-2">Jadwal Sewa : </p>

				<?php //d($jadwal_sewa)?>
				<script>
					//const element = document.getElementById("kt_docs_fullcalendar_basic");

					var todayDate = moment().startOf("day");
					var YM = todayDate.format("YYYY-MM");
					var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
					var TODAY = todayDate.format("YYYY-MM-DD");
					var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

					var calendarEl = document.getElementById("kt_docs_fullcalendar_basic");
					var calendar = new FullCalendar.Calendar(calendarEl, {
						headerToolbar: {
							left: "prev,next today",
							center: "title",
							right: "dayGridMonth,timeGridWeek,listMonth"
						},

						height: 800,
						contentHeight: 780,
						aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

						nowIndicator: true,
						now: TODAY + "T09:25:00", // just for demo

						views: {
							dayGridMonth: {
								buttonText: "month"
							},
							timeGridWeek: {
								buttonText: "week"
							}
						},

						initialView: "dayGridMonth",
						initialDate: TODAY,

						editable: true,
						dayMaxEvents: true, // allow "more" link when too many events
						navLinks: true,
						events: [

						],

						eventContent: function(info) {
							var element = $(info.el);

							if (info.event.extendedProps && info.event.extendedProps.description) {
								if (element.hasClass("fc-day-grid-event")) {
									element.data("content", info.event.extendedProps.description);
									element.data("placement", "top");
									KTApp.initPopover(element);
								} else if (element.hasClass("fc-time-grid-event")) {
									element.find(".fc-title").append("<div class=", fc - description, ">" + info.event
										.extendedProps.description + "</div>");
								} else if (element.find(".fc-list-item-title").lenght !== 0) {
									element.find(".fc-list-item-title").append("<div class=", fc - description, ">" + info
										.event.extendedProps.description + "</div>");
								}
							}
						}
					});

					calendar.render();
				</script>

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						var calendarEl = document.getElementById('calendar');
						var calendar = new FullCalendar.Calendar(calendarEl, {
							headerToolbar: {
								left: "prev,next,today",
								center: "title",
								right: "dayGridMonth,timeGridWeek,listMonth"
							},

							height: 800,
							contentHeight: 780,
							aspectRatio: 3,

							nowIndicator: true,
							now: TODAY, // just for demo

							views: {
								dayGridMonth: {
									buttonText: "month"
								},
								timeGridWeek: {
									buttonText: "week"
								}
							},

							initialView: 'dayGridMonth',

							editable: true,
							dayMaxEvents: true, // allow "more" link when too many events
							navLinks: true,
							events: <?php echo (isset($jadwal_sewa)) ? json_encode($jadwal_sewa) : null; ?> , //array kegiatan -> objek kegiatan

							eventTimeFormat: { // like '14:30:00'
								// day: '2-digit',
								// month: '2-digit',
								// year: '4-digit',
								hour: '2-digit',
								minute: '2-digit',
								second: '2-digit',
								meridiem: false
							},

							eventClick: function(info) {
								//var mulai = info.event.start.format("DD-MM-YYYY");

								alert('Kegiatan: ' + info.event.title + '\n' + 'Mulai: ' + info.event.start);
								//alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
								//alert('View: ' + info.view.type);

								// change the border color just for fun
								//info.el.style.borderColor = 'red';

								//modal harusnya tapi ngga bisa
								// Swal.fire({
								//     text: "Are you sure you want to delete this event?",
								//     icon: "warning",
								//     showCancelButton: true,
								//     buttonsStyling: false,
								//     confirmButtonText: "Yes, delete it!",
								//     cancelButtonText: "No, return",
								//     customClass: {
								//         confirmButton: "btn btn-primary",
								//         cancelButton: "btn btn-active-light"
								//     }
								// }).then(function (result) {
								//     if (result.value) {
								//         arg.event.remove()
								//     } else if (result.dismiss === "cancel") {
								//         Swal.fire({
								//             text: "Event was not deleted!.",
								//             icon: "error",
								//             buttonsStyling: false,
								//             confirmButtonText: "Ok, got it!",
								//             customClass: {
								//                 confirmButton: "btn btn-primary",
								//             }
								//         });
								//     }
								// });
							}

						});
						calendar.render();
					});
				</script>
				<div id="calendar" style="width: 1000px;"></div>
			</div>
		</div>
	</div>
</div>