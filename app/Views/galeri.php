<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/styles/style-galeri.css" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Section konten  -->
<section id="section-konten">
  <div class="container container-konten">
    <!-- <div class="bg-white rounded-5 p-5 shadow-sm" id=""> -->

    <!-- Judul -->
    <div class="d-flex flex-column flex-sm-row text-center justify-content-center justify-content-md-between mb-4 p-2">

      <!-- Garis -->
      <div class="col-lg-2 p-0 m-0 text-start">
        <h4 class="ms-2">Galeri</h4>
      </div>
      <div class="col-lg-6 p-0 m-0 pe-3">
        <hr />
      </div>

      <!-- Input pencarian -->
      <div class="col-lg-4 ps-md-4">
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

    <!-- Foto -->
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
    <!-- Paginasi -->
    <div class="row mt-4 mb-2 justify-content-center ">
      <div class="col-6 p-3 m-0 justify-content-center">
        <?php echo $pager->links('galeri', 'pager') ?>
      </div>
    </div>

    <!-- </div> -->

  </div>
  </div>
  <div class="container p-3"></div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper("#swiper-galeri", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 1000,
      modifier: 1,
      slideShadows: false,
    }
  });
</script>
<?= $this->endSection() ?>