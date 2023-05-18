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
        <div class="bg-white shadow-sm rounded-5 py-4 px-3 p-md-5" id="">
          <!-- judul section -->
          <!-- Swiper -->
          <div class="swiper mySwiper mb-4">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="row mb-3">
                  <div class="col-12 col-md-6 p-0" style="max-height: 375px">
                    <img
                      src="./assets/galeri-5.jpg"
                      class="background-rilismedia-launching rounded-start-2"
                      style="max-height: 375px"
                      alt=""
                    />
                  </div>
                  <div
                    class="col-12 col-md-6 bg-light py-3 px-4 p-md-5 bg-light"
                  >
                    <div class="flex-column">
                      <p class="text-danger mb-2 fs-18"><b>Rilis Media</b></p>
                      <h3>
                        <a href="" class="my-3 crop-text-2"
                          >Grand Launching Pusat Desain Industri Nasional di
                          Yogyakarta</a
                        >
                      </h3>
                      <p class="mb-4 crop-text-4">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Voluptate vero obcaecati natus adipisci
                        necessitatibus eius, enim vel sit ad reiciendis.
                        consectetur adipisicing elit. Voluptate vero obcaecati
                        natus adipisci necessitatibus eius, enim vel sit ad
                        reiciendasdni reiciendis.
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
                </div>
              </div>
              <div class="swiper-slide">
                <div class="row mb-3">
                  <div class="col-12 col-md-6 p-0" style="max-height: 375px">
                    <img
                      src="./assets/galeri-5.jpg"
                      class="background-rilismedia-launching rounded-start-2"
                      style="max-height: 375px"
                      alt=""
                    />
                  </div>
                  <div
                    class="col-12 col-md-6 bg-light py-3 px-4 p-md-5 bg-light"
                  >
                    <div class="flex-column">
                      <p class="text-danger mb-2 fs-18"><b>Rilis Media</b></p>
                      <h3>
                        <a href="" class="my-3 crop-text-2"
                          >Grand Launching Pusat Desain Industri Nasional di
                          Yogyakarta</a
                        >
                      </h3>
                      <p class="mb-4 crop-text-4">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Voluptate vero obcaecati natus adipisci
                        necessitatibus eius, enim vel sit ad reiciendis.
                        consectetur adipisicing elit. Voluptate vero obcaecati
                        natus adipisci necessitatibus eius, enim vel sit ad
                        reiciendasdni reiciendis.
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
                </div>
              </div>
            </div>
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
            <div class="swiper-pagination"></div>
          </div>

          <!-- garis pemisah -->
          <div class="row">
            <div class="col-12 mx-0 my-3 p-0"><hr /></div>
          </div>
          <!-- kontent bawah -->
          <div class="row p-3 p-md-0">
            <!-- konten samping kiri / recent post -->
            <div class="col-lg-9">
              <!-- Judul -->
              <div class="row mt-4 mb-4">
                <div class="col-12 p-0 m-0"><h4>Artikel Terbaru</h4></div>
              </div>
              <!-- berita -->
              <?php foreach ($artikel as $key => $a) :?>
              <div class="row pe-lg-4 mb-4">
                <div class="col-12 col-md-4 p-0">
                  <img
                    src="<?php echo base_url().'uploads/'.$a['featured_image']?>"
                    class="background-rilismedia-launching rounded-start-2"
                    style="max-height: 237px"
                    alt=""
                  />
                </div>
                <div
                  class="col-12 col-md-8 bg-light pt-2 px-3 px-lg-4 rounded-end-2"
                >
                  <div class="flex-column m-0 pt-2 pt-lg-3">
                    <p class="text-success mb-lg-2"><b><?php echo $a['kategori']; ?></b></p>
                    <h5>
                      <a href="/rilismedia/<?php echo $a['slug'] ?>" class="my-lg-3 crop-text-2"
                        ><?php echo $a['judul']; ?>
                      </a>
                    </h5>
                    <p class="mb-3 me-5 crop-text-2">
                      <?php echo $a['konten'] ?>
                    </p>
                    <div class="">
                      <p>
                        <strong>Pusat Desain Industri Nasional</strong>
                        <span class="mx-1">-</span>
                        <?php echo $a['tgl_terbit'] ?>
                      </p>
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
                  <?php echo $pager->links('artikel','pager') ?>
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
                    <div class="input-group mb-3">
                      <input
                        type="text"
                        class="form-control bg-light text-secondary"
                        placeholder="Cari Artikel"
                        aria-label=""
                        aria-describedby=""
                        id=""
                      />
                      <div class="input-group-append">
                        <div class="tooltip"></div>
                        <button
                          class="btn btn-danger rounded-start-0"
                          type="button"
                        >
                          <span class="bi bi-search"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Kategori -->
              <div class="row mt-4 mb-2">
                <div class="col-12 m-0 p-0">
                  <h5>Kategori</h5>
                  <!-- <div class="mt-3">
                    <div class="d-flex flex-column justify-content-between">
                      <a type="button" class="btn btn-primary btn-block mb-3">
                        Rilis Media
                      </a>
                    </div>
                  </div> -->
                </div>
              </div>
              <!-- Artikel Pilihan -->
              <div class="row my-2">
                <!-- recent -->
                <div class="col p-0 m-0 pt-4">
                  <h5 class="mb-3">Artikel Pilihan</h5>
                  <!-- berita -->
                  <div class="row mb-3 mx-0">
                    <div class="col-12 col-md-6 col-lg-3 p-0">
                      <img
                        src="./assets/galeri-1.jpg"
                        class="background-rilismedia-launching rounded-start-2"
                        style="max-height: 237px; min-height: 94px"
                        alt=""
                      />
                    </div>
                    <div
                      class="col-12 col-md-6 col-lg-9 bg-light rounded-end-2"
                      style="max-height: 237px"
                    >
                      <div class="flex-column m-0 pt-2 pb-1 px-1">
                        <p class="">
                          <a href="" class="crop-text-2 lh-base fw-bold"
                            >Grand Launching Pusat Desain Industri Nasional di
                            Yogyakarta asd asd
                          </a>
                        </p>
                        <small>Pameran | 23 Juni 2023</small>
                      </div>
                    </div>
                  </div>
                  <!-- berita -->
                  <div class="row mb-3 mx-0">
                    <div class="col-12 col-md-6 col-lg-3 p-0">
                      <img
                        src="./assets/galeri-3.jpg"
                        class="background-rilismedia-launching rounded-start-2"
                        style="max-height: 237px; min-height: 94px"
                        alt=""
                      />
                    </div>
                    <div
                      class="col-12 col-md-6 col-lg-9 bg-light rounded-end-2"
                      style="max-height: 237px"
                    >
                      <div class="flex-column m-0 pt-2 pb-1 px-1">
                        <p class="">
                          <a href="" class="crop-text-2 lh-base fw-bold"
                            >Grand Launching Pusat Desain Industri Nasional di
                            Yogyakarta asd asd
                          </a>
                        </p>
                        <small>Pameran | 23 Juni 2023</small>
                      </div>
                    </div>
                  </div>
                  <!-- berita -->
                  <div class="row mb-3 mx-0">
                    <div class="col-12 col-md-6 col-lg-3 p-0">
                      <img
                        src="./assets/galeri-10.jpg"
                        class="background-rilismedia-launching rounded-start-2"
                        style="max-height: 237px; min-height: 94px"
                        alt=""
                      />
                    </div>
                    <div
                      class="col-12 col-md-6 col-lg-9 bg-light rounded-end-2"
                      style="max-height: 237px"
                    >
                      <div class="flex-column m-0 pt-2 pb-1 px-1">
                        <p class="">
                          <a href="" class="crop-text-2 lh-base fw-bold"
                            >Grand Launching Pusat Desain Industri Nasional di
                            Yogyakarta asd asd
                          </a>
                        </p>
                        <small>Pameran | 23 Juni 2023</small>
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