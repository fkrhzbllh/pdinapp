<body class="bg-pdin-abu-terang">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm px-3">
      <a class="navbar-brand" href=<?= base_url() ;?>>PDIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href=<?= base_url()?>>Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>layanan">Layanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>fasilitas">Fasilitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>kegiatan">Kegiatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>galeri">Galeri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>rilismedia">Rilis Media</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>kontak">Kontak</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sewa
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?= base_url()?>fasilitas/sewaruangan">Sewa Ruangan</a>
              <a class="dropdown-item" href="<?= base_url()?>fasilitas/sewaalat">Sewa Alat</a>
              <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>fasilitas/sewaruangan">Sewa Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url()?>fasilitas/sewaruangan">Sewa Alat</a>
          </li> -->
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>

  <!-- Navbar -->
  <nav
      class="navbar navbar-expand-lg fixed-top"
      id="navbar"
      aria-label="Offcanvas navbar large"
    >
      <div class="container px-lg-0">
        <div class="row">
          <div class="col-12">
            <div class="navbar-brand text-center" id="navBrand">
              <a class="" href="/">
                <img
                  src="./assets/logo-pdin-merah-abu.png"
                  id="logoPdin"
                  alt="Logo_PDIN"
                  class=""
                />
              </a>
            </div>
          </div>
        </div>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar2"
          aria-controls="offcanvasNavbar2"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="offcanvas offcanvas-end"
          tabindex="-1"
          id="offcanvasNavbar2"
          aria-labelledby="offcanvasNavbar2Label"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
              <img
                src="./assets/logo-pdin-merah-abu.png"
                id="logoPdin"
                alt="Logo_PDIN"
                style="max-height: 35px"
              />
            </h5>
            <button
              type="button"
              class="btn-close btn-close-black"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul
              class="navbar-nav justify-content-end flex-grow-1"
              id="navbarNav"
            >
              <li class="nav-item px-2">
                <a class="nav-link" href=<?= base_url() ?>>Beranda</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="<?= base_url() ?>profilpdin">Profil</a>
              </li>

              <li class="nav-item px-2">
                <a class="nav-link" href="<?= base_url() ?>fasilitas">Fasilitas</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="<?= base_url() ?>kegiatan">Kegiatan</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="<?= base_url() ?>galeri">Galeri</a>
              </li>
              <li class="nav-item px-2">
                <a class="nav-link" href="<?= base_url() ?>rilismedia">Artikel </a>
              </li>
              <li class="nav-item ps-2">
                <a class="nav-link" href="<?= base_url() ?>kontak">Kontak</a>
              </li>
            </ul>
            <!-- <a href="" class="btn btn-danger" style="width: 120px"> F.A.Q</a> -->
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- script change navbar after scroll  -->
    <script>
      // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
      window.onscroll = function () {
        // scroll1Function();

        if (window.innerWidth < 576) {
          scrollXSFunction();
        } else if (window.innerWidth < 768) {
          scrollSMFunction();
        } else if (window.innerWidth < 992) {
          scrollMDFunction();
        } else if (window.innerWidth < 1200) {
          scrollLGFunction();
        } else if (window.innerWidth < 1400) {
          scrollXLFunction();
        } else {
          scrollXXLFunction();
        }
      };

      function scrollXXLFunction() {
        if (
          document.body.scrollTop > 80 ||
          document.documentElement.scrollTop > 80
        ) {
          // document.getElementById('navbar').style.padding = '5px 5px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(256, 256, 256, 1)';
          document.getElementById('logoPdin').style.maxHeight = '35px';
          document.getElementById('logoPdin').style.marginTop = '-16px';
          document.getElementById('navBrand').style.height = '35px';
          document.getElementById('navBrand').style.width = '100px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 0px 0px';
        } else {
          // document.getElementById('navbar').style.padding = '10px 10px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(221, 222, 222, 0.8)';
          document.getElementById('logoPdin').style.maxHeight = '85px';
          document.getElementById('navBrand').style.height = '140px';
          document.getElementById('navBrand').style.width = '330px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 41px 41px';
          document.getElementById('logoPdin').style.marginTop = '0px';
        }
      }
      function scrollXLFunction() {
        if (
          document.body.scrollTop > 80 ||
          document.documentElement.scrollTop > 80
        ) {
          // document.getElementById('navbar').style.padding = '5px 5px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(256, 256, 256, 1)';
          document.getElementById('logoPdin').style.maxHeight = '35px';
          document.getElementById('logoPdin').style.marginTop = '-20px';
          document.getElementById('navBrand').style.height = '35px';
          document.getElementById('navBrand').style.width = '100px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 0px 0px';
        } else {
          // document.getElementById('navbar').style.padding = '10px 10px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(221, 222, 222, 0.8)';
          document.getElementById('logoPdin').style.maxHeight = '70px';
          (document.getElementById('navBrand').style.height = '120px'),
            (document.getElementById('navBrand').style.width = '280px');
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 41px 41px';
          document.getElementById('logoPdin').style.marginTop = '0px';
        }
      }
      function scrollLGFunction() {
        if (
          document.body.scrollTop > 80 ||
          document.documentElement.scrollTop > 80
        ) {
          // document.getElementById('navbar').style.padding = '5px 5px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(256, 256, 256, 1)';
          document.getElementById('logoPdin').style.maxHeight = '35px';
          document.getElementById('logoPdin').style.marginTop = '-14px';
          document.getElementById('navBrand').style.height = '35px';
          document.getElementById('navBrand').style.width = '100px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 0px 0px';
        } else {
          // document.getElementById('navbar').style.padding = '10px 10px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(221, 222, 222, 0.8)';
          document.getElementById('logoPdin').style.maxHeight = '60px';
          (document.getElementById('navBrand').style.height = '100px'),
            (document.getElementById('navBrand').style.width = '240px');
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 30px 30px';
          document.getElementById('logoPdin').style.marginTop = '0px';
        }
      }
      function scrollMDFunction() {
        if (
          document.body.scrollTop > 80 ||
          document.documentElement.scrollTop > 80
        ) {
          // document.getElementById('navbar').style.padding = '5px 5px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(256, 256, 256, 1)';
          document.getElementById('logoPdin').style.maxHeight = '35px';
          document.getElementById('logoPdin').style.marginTop = '-14px';
          document.getElementById('navBrand').style.height = '35px';
          document.getElementById('navBrand').style.width = '100px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 0px 0px';
        } else {
          // document.getElementById('navbar').style.padding = '10px 10px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(221, 222, 222, 0.8)';
          document.getElementById('logoPdin').style.maxHeight = '55px';
          (document.getElementById('navBrand').style.height = '100px'),
            (document.getElementById('navBrand').style.width = '240px');
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 30px 30px';
          document.getElementById('logoPdin').style.marginTop = '0px';
        }
      }
      function scrollSMFunction() {
        if (
          document.body.scrollTop > 80 ||
          document.documentElement.scrollTop > 80
        ) {
          // document.getElementById('navbar').style.padding = '5px 5px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(256, 256, 256, 1)';
          document.getElementById('logoPdin').style.maxHeight = '35px';
          document.getElementById('logoPdin').style.marginTop = '-14px';
          document.getElementById('navBrand').style.height = '35px';
          document.getElementById('navBrand').style.width = '100px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 0px 0px';
        } else {
          // document.getElementById('navbar').style.padding = '10px 10px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(221, 222, 222, 0.8)';
          document.getElementById('logoPdin').style.maxHeight = '55px';
          (document.getElementById('navBrand').style.height = '100px'),
            (document.getElementById('navBrand').style.width = '240px');
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 30px 30px';
          document.getElementById('logoPdin').style.marginTop = '0px';
        }
      }
      function scrollXSFunction() {
        if (
          document.body.scrollTop > 80 ||
          document.documentElement.scrollTop > 80
        ) {
          // document.getElementById('navbar').style.padding = '5px 5px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(256, 256, 256, 1)';
          document.getElementById('logoPdin').style.maxHeight = '35px';
          document.getElementById('logoPdin').style.marginTop = '-30px';
          document.getElementById('navBrand').style.height = '35px';
          document.getElementById('navBrand').style.width = '100px';
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 0px 0px';
        } else {
          // document.getElementById('navbar').style.padding = '10px 10px';
          document.getElementById('navbar').style.backgroundColor =
            'rgba(221, 222, 222, 0.8)';
          document.getElementById('logoPdin').style.maxHeight = '40px';
          (document.getElementById('navBrand').style.height = '100px'),
            (document.getElementById('navBrand').style.width = '160px');
          document.getElementById('navBrand').style.borderRadius =
            '0px 0px 24px 24px';
          document.getElementById('logoPdin').style.marginTop = '0px';
        }
      }
    </script>
    