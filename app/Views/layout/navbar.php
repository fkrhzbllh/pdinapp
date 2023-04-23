<body class="bg-light">
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <a class="navbar-brand" href=<?= base_url() ;?>>PDIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href=<?= base_url()?>>Beranda<span class="sr-only">(current)</span></a>
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
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
          <li class="nav-item">
            <a class="nav-link disabled" href="<?= base_url()?>login">Login</a>
          </li>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
    