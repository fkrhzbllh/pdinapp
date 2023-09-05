    <?php

    /**
     * TODO: 
     * Tambah styling kustom ke swiper
     * Pindah script ke footer
     */

    helper('text'); ?>
    <?= $this->extend('layout/template') ?>

    <?= $this->section('content') ?>
    <!-- Konten section -->
    <section id="section-konten">
      <div class="container container-konten">

        <!-- Swiper -->
        <div class="row mb-4">
          <div class="swiper" id="swiper-artikel">
            <div class="swiper-wrapper">

              <!-- Swiper artikel terbaru -->
              <?php foreach ($artikelTerbaru as $i => $a) : ?>
                <div class="swiper-slide">
                  <div class="card">
                    <div class="row">

                      <!-- Gambar artikel -->
                      <div class="col-md-6 position-relative">
                        <img src="<?php echo base_url() . 'uploads/' . $a['featured_image'] ?>" class="ratio ratio-4x3 object-fit-cover h-100" alt="..." />
                      </div>

                      <!-- Body artikel -->
                      <div class="col-md-6">
                        <div class="card-body p-md-5">

                          <!-- Kategori -->
                          <p class="text-danger mb-3"><b><?php echo $a['kategori']; ?></b></p>

                          <!-- Judul -->
                          <h3 class="card-title mb-3">
                            <a class="link-dark text-decoration-none crop-text-2" href="rilis-media/<?= $a['slug']; ?>"><?= $a['judul']; ?></a>
                          </h3>

                          <!-- Ringkasan -->
                          <p class="card-text crop-text-4 mb-3">
                            <?= word_limiter($a['meta_description'], 10); ?>
                          </p>

                          <!-- Tanggal -->
                          <p class="card-text crop-text-2 mb-3">
                            <b>Pusat Desain Industri Nasional</b> - <?= $a['tgl_terbit']; ?>
                          </p>
                        </div>

                      </div>
                      <!-- Akhir body artikel -->

                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              <!-- Akhir swiper artikel terbaru -->
            </div>

            <div class="swiper-pagination"></div>

          </div>

        </div>
        <!-- Akhir Swiper -->

        <!-- Konten utama -->
        <div class="row p-3 p-md-0">

          <!-- Konten utama kiri -->
          <div class="col-lg-9">

            <!-- Daftar artikel terbaru -->
            <?php foreach ($artikel as $key => $a) : ?>
              <div class="card bg-light mb-3">
                <div class="row g-0">

                  <!-- Gambar artikel -->
                  <div class="col-md-4">
                    <img src="<?php echo base_url() . 'uploads/' . $a['featured_image'] ?>" class="img-fluid rounded-start object-fit-cover h-100" alt="..." />
                  </div>

                  <!-- Ringkasan artikel -->
                  <div class="col-md-8">

                    <!-- Header artikel -->
                    <div class="card-header text-muted">
                      <div class="row">
                        <div class="col-6">
                          <p class="text-danger mb-lg-2">
                            <b><?php echo $a['kategori']; ?></b>
                          </p>
                        </div>
                        <div class="col-6 text-end">
                          <?php echo $a['tgl_terbit_terformat']; ?>
                        </div>
                      </div>
                    </div>

                    <!-- Body artikel -->
                    <div class="card-body">
                      <h4 class="card-title">
                        <a class="link-dark text-decoration-none crop-text-2" href="/rilis-media/<?php echo $a['slug'] ?>" target="_blank"><?php echo $a['judul']; ?></a>
                      </h4>

                      <div class="card-text crop-text-2 mb-3">
                        <?php echo $a['konten'] ?>
                      </div>

                      <p class="card-text crop-text-2 mb-3">
                        <b>Pusat Desain Industri Nasional</b>
                      </p>
                    </div>

                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <!-- Akhir artikel terbaru -->

            <!-- Paginasi -->
            <div class="d-flex">
              <?php echo $pager->links('artikel', 'pager') ?>
            </div>
            <!-- Akhir paginasi -->

          </div>
          <!-- Akhir konten utama kiri -->

          <!-- Sidebar kanan -->
          <div class="col-lg-3">

            <!-- Pencarian -->
            <div class="row">
              <form action="" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Artikel" aria-label="" aria-describedby="" id="" name="keyword" />
                  <div class="input-group-append">
                    <div class="tooltip"></div>
                    <button class="btn btn-danger rounded-start-0" type="submit">
                      <span class="bi bi-search"></span>
                    </button>
                  </div>
                </div>
              </form>
            </div>

            <!-- Artikel pilihan -->
            <div class="row">
              <h5 class="mb-3">Artikel Pilihan</h5>
            </div>

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
          <!-- Akhir sidebar kanan -->

        </div>
        <!-- Akhir konten utama -->

      </div>
    </section>
    <!-- Akhir konten section -->
    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('#swiper-artikel', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
          delay: 25000,
          disableOnInteraction: true,
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
    <?= $this->endSection() ?>