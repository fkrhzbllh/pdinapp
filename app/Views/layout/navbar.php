<body class="d-flex flex-column min-vh-100">
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg fixed-top" id="navbar" aria-label="Offcanvas navbar large">
		<div class="container container-fluid">
			<div class="navbar-brand text-center">
				<a class="" href="/">
					<img src="<?= base_url() ?>assets/logo-pdin-merah-abu.png" id="logo" alt="Logo_PDIN" />
				</a>
			</div>

			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title" id="offcanvasNavbar2Label">
						<img src="<?= base_url() ?>assets/logo-pdin-merah-abu.png" id="logoPdin" alt="Logo_PDIN" style="max-height: 35px" />
					</h5>
					<button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-end flex-grow-1" id="navbarNav">
						<li class="nav-item px-2">
							<a class="nav-link <?= ($current_page == 'beranda') ? 'active' : '' ?>" href=<?= base_url() ?>>Beranda</a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link <?= ($current_page == 'profil') ? 'active' : '' ?>" href="<?= base_url() ?>ProfilPDIN">Profil</a>
						</li>

						<li class="nav-item px-2">
							<a class="nav-link <?= ($current_page == 'fasilitas') ? 'active' : '' ?>" href="<?= base_url() ?>fasilitas">Fasilitas</a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link <?= ($current_page == 'kegiatan') ? 'active' : '' ?>" href="<?= base_url() ?>kegiatan">Kegiatan</a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link <?= ($current_page == 'galeri') ? 'active' : '' ?>" href="<?= base_url() ?>galeri">Galeri</a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link <?= ($current_page == 'rilismedia') ? 'active' : '' ?>" href="<?= base_url() ?>rilis-media">Rilis
								Media
							</a>
						</li>
						<li class="nav-item ps-2">
							<a class="nav-link <?= ($current_page == 'kontak') ? 'active' : '' ?>" href="<?= base_url() ?>kontak">Kontak</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- End Navbar -->