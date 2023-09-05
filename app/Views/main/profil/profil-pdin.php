<?= $this->extend('layout/template') ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    // Ambil elemen-elemen yang dibutuhkan
    const navItemsToggle = $("#nav-items-toggle");
    const navList = $("#v-pills-tab");
    const navItems = $(".nav-item");
    const navItemActive = $("#nav-item-active");

    // Tambahkan event listener pada tombol hamburger
    navItemsToggle.on("click", function() {
      toggleNavList();
    });

    // Fungsi untuk menampilkan atau menyembunyikan daftar tab navigasi
    function toggleNavList() {
      navList.toggle();
    }

    function updateHamburgerToggle() {
      const activeNavItem = $(".nav-link.text-start.active");
      navItemActive.html(activeNavItem.html());
    }

    // Tambahkan event listener pada perubahan lebar layar
    $(window).on("resize", function() {
      const windowWidth = window.innerWidth;

      navList.css("display", windowWidth <= 991 ? "none" : "block");
    });

    // Tambahkan event listener pada setiap elemen li dalam daftar tab navigasi
    navItems.on("click", function() {
      const navText = $(this).text().trim();
      console.log("Anda mengklik tab navigasi:", navText);

      if (navItemsToggle.is(":visible")) {
        updateHamburgerToggle();
        toggleNavList();
      }
    });

    // Panggil fungsi
    updateHamburgerToggle();
  });
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Section konten -->
<section id="section-konten">
  <div class="container container-konten">

    <!-- Judul dan navigasi -->
    <div class="row w-100 d-lg-none">

      <!-- Tombol toggle nav items -->
      <div class="col-1 me-3 me-md-2">
        <button id="nav-items-toggle" class="btn btn-danger d-lg-none">&#9776;</button>
      </div>

      <!-- Judul -->
      <div class="col align-self-center">
        <h5 id="nav-item-active" class="my-0">Judul</h5>
      </div>
    </div>

    <hr class="border border-danger w-100 d-lg-none">

    <div class="d-flex flex-column flex-lg-row align-items-start responsive-tab-menu">

      <!--Tab -->
      <ul class=" nav flex-column nav-pills nav-tabs-dropdown col-12 col-lg-2 me-md-2" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="min-width: 192px">

        <!-- Tab link Tentang PDIN -->
        <li class="nav-item">
          <a class="nav-link text-start active" href="#" id="v-pills-tentangpdin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tentangpdin" role="tab" aria-controls="v-pills-tentangpdin" aria-selected="true">Tentang PDIN</a>
        </li>

        <!-- Tab Link Visi Misi PDIN -->
        <li class="nav-item">
          <a class="nav-link text-start" href="#" id="v-pills-visimisipdin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-visimisipdin" role="tab" aria-controls="v-pills-visimisipdin" aria-selected="false">Visi Misi PDIN</a>
        </li>

        <!-- Tab Link Arti Logo PDIN -->
        <li class="nav-item">
          <a class="nav-link text-start" href="#" id="v-pills-artilogopdin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-artilogopdin" role="tab" aria-controls="v-pills-artilogopdin" aria-selected="false">Arti Logo PDIN</a>
        </li>

        <!-- Tab Link Lokasi PDIN -->
        <li class="nav-item">
          <a class="nav-link text-start" href="#" id="v-pills-lokasipdin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-lokasipdin" role="tab" aria-controls="v-pills-lokasipdin" aria-selected="false">Pemilihan Lokasi PDIN</a>
        </li>

        <!-- Tab Link Lokasi PDIN -->
        <li class="nav-item">
          <a class="nav-link text-start" href="#" id="v-pills-pimpinanpdin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pimpinanpdin" role="tab" aria-controls="v-pills-pimpinanpdin" aria-selected="false">Pimpinan PDIN</a>
        </li>

        <!-- Tab Link Struktur PDIN -->
        <li class="nav-item">
          <a class="nav-link text-start" href="#" id="v-pills-strukturpdin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-strukturpdin" role="tab" aria-controls="v-pills-strukturpdin" aria-selected="false">Struktur Organisasi PDIN</a>
        </li>
      </ul>

      <!-- Isi tab -->
      <div class="flex-grow-1 p-1 m-0 mt-3 pt-lg-0 ms-lg-4 mt-lg-0 ms-xl-5">
        <div class="tab-content responsive-tab-content" id="v-pills-tabContent" style="max-width: 975px">

          <?php include('tentang-pdin.php'); ?>
          <?php include('visi-misi-pdin.php'); ?>
          <?php include('arti-logo-pdin.php'); ?>
          <?php include('lokasi-pdin.php'); ?>
          <?php include('pimpinan-pdin.php'); ?>
          <?php include('struktur-organisasi-pdin.php'); ?>

        </div>
      </div>
    </div>

  </div>
</section>
<?= $this->endSection() ?>