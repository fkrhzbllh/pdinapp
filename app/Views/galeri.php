<!-- ======= Judul Section ======= -->
<section id="background-hitam-atas" class="d-flex align-items-center">
  <div class="container">
    <div class="text-center">
      <h2 class="text-light my-4">Galeri</h2>
      <p class="text-light lh-base">
        Dokumentasi terkait semua kegiatan yang ada di Pusat Desain Industri
        Nasional adalah sebagai berikut.
      </p>
    </div>
  </div>
</section>
<!-- End  -->

<!-- ======= isi Section ======= -->
<section id="isi-section">
  <div class="container p-3">
    <div class="bg-white rounded-5 p-5 shadow-sm" id="">
      <!-- judul section -->
      <div class="d-flex flex-column flex-sm-row text-center justify-content-center justify-content-md-between mb-4 p-2" data-aos="fade-up">
        <!-- garis -->
        <div class="d-none d-md-block flex-md-grow-1 p-0">
          <hr />
        </div>
        <!-- filter dropdown tipe galeri -->
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
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </div>
            </div> -->
        <!-- input pencarian -->
        <div class="ps-md-4">
          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control bg-light text-secondary" placeholder="Cari Dokumentasi" aria-label="" aria-describedby="" id="" name="keyword" />
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

      <!-- foto -->
      <div class="wrapper">
        <div class="masonry masonry--h">
          <?php foreach ($galeri as $g) : ?>
            <figure class="masonry-brick masonry-brick--h" style="width: fit-content;">
              <a href="<?= base_url() . 'uploads/' . $g['nama_file'] ?>" data-toggle="lightbox">
                <img src="<?= base_url() . 'uploads/' . $g['nama_file'] ?>" class="masonry-img" alt="Masonry Brick #1">
              </a>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- pagination -->
      <div class="row mt-4 mb-2 justify-content-center ">
        <div class="col-6 p-3 m-0 justify-content-center">
          <?php echo $pager->links('galeri', 'pager') ?>
        </div>
      </div>
    </div>


  </div>
  </div>
  <div class="container p-3"></div>
</section>