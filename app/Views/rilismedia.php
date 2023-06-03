    <!-- ======= Judul Section ======= -->
    <section id="background-hitam-atas" class="d-flex align-items-center">
      <div class="container">
        <div class="text-center">
          <h2 class="text-light my-4">Artikel</h2>
          <p class="text-light lh-base">
            Artikel dan berita terkait Pusat Desain Industri Nasional adalah
            sebagai berikut.
          </p>
        </div>
      </div>
    </section>
    <!-- End Hero -->

    <!-- ======= isi Section ======= -->
    <section id="isi-section">
      <div class="container p-3">
        <div class="bg-white shadow-sm rounded-5 p-4 p-sm-5" id="">
          <!-- judul section -->
          <!-- Swiper -->
          <!-- Swiper -->
          <div class="swiper mySwiper mb-4">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="card border border-0">
                  <div class="row g-0">
                    <div class="col-md-6 position-relative">
                      <img src="<?= base_url() ?>assets/galeri-1.jpg"
                        class="card-img fit-cover w-100 h-100 img-slider-artikel" alt="..." />
                    </div>

                    <div class="col-md-6">
                      <div class="card-body p-md-5 bg-light text-slider-artikel">
                        <p class="text-danger mb-3 fs-18"><b>Pameran</b></p>
                        <h3 class="card-title mb-3">
                          <a class="link-dark text-decoration-none crop-text-2" href="rilismediadetail.html"
                            target="_blank">Grand Launching Pusat Desain Industri Nasional di
                            Yogyakarta asdasd asd asd asdasdsd</a>
                        </h3>

                        <p class="card-text crop-text-4 mb-3">
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit. Voluptate vero obcaecati natus adipisci
                          necessitatibus eius, enim vel sit ad reiciendis.
                          consectetur adipisicing elit. Voluptate vero obcaecati
                          natus adipisci necessitatibus eius, enim vel sit ad
                          reiciendasdni reiciendis.
                        </p>
                        <!-- <span class="badge rounded-pill bg-dark">Tag1</span> -->
                        <p class="card-text crop-text-2 mb-3">
                          <b>Pusat Desain Industri Nasional</b> - 23 Mei 2023
                        </p>
                      </div>

                      <!-- <div class="card-footer text-end text-muted">
                        Last updated today.
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card border border-0">
                  <div class="row g-0">
                    <div class="col-md-6 position-relative">
                      <img src="<?= base_url() ?>assets/galeri-1.jpg"
                        class="card-img fit-cover w-100 h-100 img-slider-artikel" alt="..." />
                    </div>

                    <div class="col-md-6">
                      <div class="card-body p-md-5 bg-light text-slider-artikel">
                        <p class="text-danger mb-3 fs-18"><b>Pameran</b></p>
                        <h3 class="card-title mb-3">
                          <a class="link-dark text-decoration-none crop-text-2" href="rilismediadetail.html"
                            target="_blank">Grand Launching Pusat Desain Industri Nasional di
                            Yogyakarta asdasd asd asd asdasdsd</a>
                        </h3>

                        <p class="card-text crop-text-4 mb-3">
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit. Voluptate vero obcaecati natus adipisci
                          necessitatibus eius, enim vel sit ad reiciendis.
                          consectetur adipisicing elit. Voluptate vero obcaecati
                          natus adipisci necessitatibus eius, enim vel sit ad
                          reiciendasdni reiciendis.
                        </p>
                        <!-- <span class="badge rounded-pill bg-dark">Tag1</span> -->
                        <p class="card-text crop-text-2 mb-3">
                          <b>Pusat Desain Industri Nasional</b> - 23 Mei 2023
                        </p>
                      </div>

                      <!-- <div class="card-footer text-end text-muted">
                        Last updated today.
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
            <div class="swiper-pagination"></div>
          </div>

          <!-- garis pemisah -->
          <div class="row">
            <div class="col-12 mx-0 my-3 p-0">
              <hr />
            </div>
          </div>
          <!-- kontent bawah -->
          <div class="row p-3 p-md-0">
            <!-- konten samping kiri / recent post -->
            <div class="col-lg-9">
              <!-- Judul -->
              <div class="row mt-4 mb-4">
                <div class="col-12 p-0 m-0">
                  <h4>Artikel Terbaru</h4>
                </div>
              </div>
              <!-- berita -->
              <?php foreach ($artikel as $key => $a) :?>
              <div class="row pe-lg-4 mb-4">
                <div class="card p-0 m-0 border-0">
                  <div class="row g-0">
                    <div class="col-md-4 position-relative">
                      <img
                        src="<?php echo base_url() . 'uploads/' . $a['featured_image']?>"
                        class="card-img fit-cover w-100 h-100" alt="..." />
                    </div>

                    <div class="col-md-8">
                      <div class="card-body bg-light p-md-4">
                        <p class="text-danger mb-lg-2">
                          <b><?php echo $a['kategori']; ?></b>
                        </p>
                        <h4 class="card-title">
                          <a class="link-dark text-decoration-none crop-text-2"
                            href="/rilis-media/<?php echo $a['slug'] ?>"
                            target="_blank"><?php echo $a['judul']; ?></a>
                        </h4>

                        <div class="card-text crop-text-2 mb-3">
                          <?php echo $a['konten'] ?>
                        </div>
                        <!-- <span class="badge rounded-pill bg-dark">Tag1</span> -->
                        <p class="card-text crop-text-2 mb-3">
                          <b>Pusat Desain Industri Nasional</b> -
                          <?php $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta');
              	echo $formatter->format(date_create($a['tgl_terbit'])) ?>
                        </p>
                      </div>

                      <!-- <div class="card-footer text-end text-muted">
                          Last updated today.
                        </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              <!-- berita -->
              <!-- <div class="row pe-lg-4 mb-4">
                <div class="col-12 col-md-4 p-0">
                  <img
                    src="./assets/galeri-2.jpg"
                    class="background-rilismedia-launching rounded-start-2"
                    style="max-height: 237px"
                    alt=""
                  />
                </div>
                <div
                  class="col-12 col-md-8 bg-light pt-2 px-3 px-lg-4 rounded-end-2"
                >
                  <div class="flex-column m-0 pt-2 pt-lg-3">
                    <p class="text-success mb-lg-2"><b>Pameran</b></p>
                    <h5>
                      <a href="" class="my-lg-3 crop-text-2"
                        >Grand Launching Pusat Desain Industri Nasional di
                        Yogyakarta asdasd asd asd asdasdsd
                      </a>
                    </h5>
                    <p class="mb-3 me-5 crop-text-2">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                      Voluptate vero obcaecati natus adipisci necessitatibus
                      eius, enim vel sit ad reiciendis. consectetur adipisicing
                      elit. Voluptate vero obcaecati natus adipisci
                      necessitatibus eius, enim vel sit ad reiciendasdni
                      reiciendis.
                    </p>
                    <div class="">
                      <p>
                        <strong>Pusat Desain Industri Nasional</strong>
                        <span class="mx-1">-</span>
                        23 Juni 2023
                      </p>
                    </div>
                  </div>
                </div>
              </div> -->

              <!-- pagination -->
              <div class="row mt-4 mb-2">
                <div class="col-12 p-0 m-0">
                  <div class="d-flex">
                    <?php echo $pager->links('artikel', 'pager') ?>
                    <!-- <ul class="pagination m-0">
                      <li class="page-item">
                        <a class="page-link text-black" href="#">Previous</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link text-black" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link text-black" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link text-black" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link text-black" href="#">Next</a>
                      </li>
                    </ul>
                    <div class="flex-grow-1 px-4">
                      <hr />
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- konten samping kanan -->
            <div class="col-lg-3">
              <!-- Pencarian -->
              <div class="row mt-4 mb-2">
                <div class="col-12 m-0 p-0">
                  <h5>Cari Artikel</h5>
                  <div class="mt-3">
                    <!-- input pencarian -->
                    <form action="" method="post">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Artikel"
                          aria-label="" aria-describedby="" id="" name="keyword" />
                        <div class="input-group-append">
                          <div class="tooltip"></div>
                          <button class="btn btn-danger rounded-start-0" type="submit">
                            <span class="bi bi-search"></span>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Kategori -->
              <!-- <div class="row mt-4 mb-2">
                <div class="col-12 m-0 p-0">
                  <h5>Kategori</h5>
                   
                </div>
              </div> -->
              <!-- Artikel Pilihan -->
              <div class="row my-2">
                <!-- recent -->
                <div class="col p-0 m-0 pt-4">
                  <h5 class="mb-3">Artikel Pilihan</h5>

                  <!-- berita -->
                  <div class="row mb-3 mx-0">
                    <div class="card px-0 border-0">
                      <div class="row g-0">
                        <div class="col-3 position-relative">
                          <img
                            src="<?= base_url() ?>assets/galeri-5.jpg"
                            class="card-img fit-cover w-100 h-100" alt="..." />
                        </div>
                        <div class="col-9">
                          <div class="card-body p-3 p-sm-4 p-lg-2 bg-body-tertiary">
                            <p class="card-title">
                              <a class="link-dark text-decoration-none crop-text-2" href="#" target="_blank"><b>
                                  Grand Launching Pusat Desain Industri Nasional
                                  di Yogyakarta
                                </b></a>
                            </p>

                            <!-- <span class="badge rounded-pill bg-dark">Tag1</span> -->
                            <small class="card-text crop-text-2">
                              Pameran | 23 Mei 2023</small>
                          </div>

                          <!-- <div class="card-footer text-end text-muted">
                            Last updated today.
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- pagination berita -->
          <!-- blog single -->
        </div>
      </div>
      <div class="container p-3"></div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('.mySwiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
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