<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Halaman-halaman utama
$routes->get('/', 'Beranda::index');
$routes->get('/fasilitas', 'Fasilitas::index');
$routes->get('/kegiatan', 'Kegiatan::index');
$routes->get('/galeri', 'Galeri::index');
$routes->post('/galeri', 'Galeri::index');
$routes->get('/ProfilPDIN', 'ProfilPdin::index');
$routes->get('/kontak', 'Kontak::index');
$routes->get('/rilis-media', 'RilisMedia::index');
$routes->post('/rilis-media', 'RilisMedia::index');

// Halaman Login
service('auth')->routes($routes);
$routes->get('/atur-kata-sandi', 'AturKataSandi::index');
$routes->post('/atur-kata-sandi', 'AturKataSandi::aturPassword', ['as' => 'atur-password']);
$routes->get('/atur-profil', 'AturProfil', ['as' => 'atur-profil']);
$routes->post('/atur-profil', 'AturProfil::aturProfil', ['as' => 'atur-profil']);
// $routes->get('/register', 'RegisterController::registerView', ['as' => 'register']);
// $routes->get('/login/magic-link', 'MagicLinkController::loginView', ['as' => 'magic-link']);
// $routes->post('/login/magic-link', 'MagicLinkController::loginAction');
// $routes->post('/login/verify-magic-link', 'MagicLinkController::verify');

// Halaman detail ruangan dan alat
$routes->get('/fasilitas/ruang/(:segment)', 'Fasilitas::detailRuangan/$1');
$routes->get('/fasilitas/alat/(:segment)', 'Fasilitas::detailAlat/$1');

// Halaman detail rilis media
$routes->get('/rilis-media/(:any)', 'RilisMedia::detail/$1');

$routes->group('', ['filter' => 'admin'], static function ($routes) {

	// Dashboard Admin Alat
	$routes->get('/DashboardAdmin/alat', 'Admin\AlatAdmin::index');

	$routes->get('/DashboardAdmin/tambah-alat', 'Admin\AlatAdmin::tambahAlat');
	$routes->post('/DashboardAdmin/saveTambahAlat', 'Admin\AlatAdmin::saveTambahAlat/$1');

	$routes->get('/DashboardAdmin/update-alat/(:any)', 'Admin\AlatAdmin::updateAlat/$1');
	$routes->post('/DashboardAdmin/saveUpdateAlat/(:num)', 'Admin\AlatAdmin::saveUpdateAlat/$1');

	$routes->delete('/DashboardAdmin/alat/(:num)', 'Admin\AlatAdmin::deleteAlat/$1');

	// $routes->get('/DashboardAdmin/sewa-alat/(:any)', 'Admin\AlatAdmin::listSewaAlat/$1');
	// $routes->get('/DashboardAdmin/tambah-sewa-alat/(:any)', 'Admin\AlatAdmin::tambahSewaAlat/$1');
	// $routes->get('/DashboardAdmin/tambah-sewa-alat/', 'Admin\AlatAdmin::tambahSewaAlat');
	// $routes->post('/DashboardAdmin/saveTambahSewaAlat', 'Admin\AlatAdmin::saveTambahSewaAlat');

	// $routes->get('/DashboardAdmin/update-sewa-alat/(:any)', 'Admin\AlatAdmin::updateSewaAlat/$1');
	// $routes->post('/DashboardAdmin/saveUpdateSewaAlat/(:num)/(:num)', 'Admin\AlatAdmin::saveUpdateSewaAlat/$1/$2');

	// $routes->delete('/DashboardAdmin/sewaAlat/(:num)', 'Admin\AlatAdmin::deleteSewaAlat/$1');


	// Dashboard Admin Kegiatan
	$routes->get('/DashboardAdmin/kegiatan', 'Admin\KegiatanAdmin::index');

	$routes->get('/DashboardAdmin/tambah-kegiatan', 'Admin\KegiatanAdmin::tambahKegiatan');
	$routes->post('/DashboardAdmin/saveTambahKegiatan', 'Admin\KegiatanAdmin::saveTambahKegiatan/$1');

	$routes->get('/DashboardAdmin/update-kegiatan/(:any)', 'Admin\KegiatanAdmin::updateKegiatan/$1');
	$routes->post('/DashboardAdmin/saveUpdateKegiatan/(:num)', 'Admin\KegiatanAdmin::saveUpdateKegiatan/$1');

	$routes->delete('/DashboardAdmin/kegiatan/(:num)', 'Admin\KegiatanAdmin::deleteKegiatan/$1');


	// Dashboard Admin Rilis Media
	$routes->get('/DashboardAdmin', 'Admin\RilisMediaAdmin::index');
	$routes->get('/DashboardAdmin/rilis-media', 'Admin\RilisMediaAdmin::index');

	$routes->get('/DashboardAdmin/tambah-rilis-media', 'Admin\RilisMediaAdmin::tambahRilisMedia');
	$routes->post('/DashboardAdmin/saveTambahRilisMedia', 'Admin\RilisMediaAdmin::saveTambahRilisMedia/$1');

	$routes->get('/DashboardAdmin/update-rilis-media/(:any)', 'Admin\RilisMediaAdmin::updateRilisMedia/$1');
	$routes->post('/DashboardAdmin/saveUpdateRilisMedia/(:num)', 'Admin\RilisMediaAdmin::saveUpdateRilisMedia/$1');

	$routes->delete('/DashboardAdmin/rilismedia/(:num)', 'Admin\RilisMediaAdmin::deleteRilisMedia/$1');


	// Dashboard Admin Ruangan
	$routes->get('/DashboardAdmin/ruangan', 'Admin\RuanganAdmin::index');

	$routes->get('/DashboardAdmin/tambah-ruangan', 'Admin\RuanganAdmin::tambahRuangan');
	$routes->post('/DashboardAdmin/saveTambahRuangan', 'Admin\RuanganAdmin::saveTambahRuangan/$1');

	$routes->get('/DashboardAdmin/update-ruangan/(:any)', 'Admin\RuanganAdmin::updateRuangan/$1');
	$routes->post('/DashboardAdmin/saveUpdateRuangan/(:num)', 'Admin\RuanganAdmin::saveUpdateRuangan/$1');

	$routes->delete('/DashboardAdmin/ruangan/(:num)', 'Admin\RuanganAdmin::deleteRuangan/$1');

	$routes->get('/DashboardAdmin/sewa-ruangan/(:any)', 'Admin\RuanganAdmin::listSewaRuangan/$1');

	// $routes->get('/DashboardAdmin/tambah-sewa-ruangan/(:any)', 'Admin\RuanganAdmin::tambahSewaRuangan/$1');
	// $routes->get('/DashboardAdmin/tambah-sewa-ruangan/', 'Admin\RuanganAdmin::tambahSewaRuangan');
	// $routes->post('/DashboardAdmin/saveTambahSewaRuangan', 'Admin\RuanganAdmin::saveTambahSewaRuangan');

	// $routes->get('/DashboardAdmin/update-sewa-ruangan/(:any)', 'Admin\RuanganAdmin::updateSewaRuangan/$1');
	// $routes->post('/DashboardAdmin/saveUpdateSewaRuangan/(:num)/(:num)', 'Admin\RuanganAdmin::saveUpdateSewaRuangan/$1/$2');

	// $routes->delete('/DashboardAdmin/sewaRuangan/(:num)', 'Admin\RuanganAdmin::deleteSewaRuangan/$1');


	// Dashboard Admin Layanan sewa ruangan
	$routes->get('/DashboardAdmin/layanan-sewa-ruangan', 'Admin\LayananSewaRuanganAdmin::listSewaRuangan');

	$routes->get('/DashboardAdmin/tambah-sewa-ruangan/(:any)', 'Admin\LayananSewaRuanganAdmin::tambahSewaRuangan/$1');
	$routes->get('/DashboardAdmin/tambah-sewa-ruangan/', 'Admin\LayananSewaRuanganAdmin::tambahSewaRuangan');
	$routes->post('/DashboardAdmin/saveTambahSewaRuangan', 'Admin\LayananSewaRuanganAdmin::saveTambahSewaRuangan');

	$routes->get('/DashboardAdmin/update-sewa-ruangan/(:any)', 'Admin\LayananSewaRuanganAdmin::updateSewaRuangan/$1');
	$routes->post('/DashboardAdmin/saveUpdateSewaRuangan/(:num)/(:num)', 'Admin\LayananSewaRuanganAdmin::saveUpdateSewaRuangan/$1/$2');

	$routes->delete('/DashboardAdmin/sewaRuangan/(:num)', 'Admin\LayananSewaRuanganAdmin::deleteSewaRuangan/$1');

	// Dashboard Admin Layanan sewa alat
	$routes->get('/DashboardAdmin/layanan-sewa-alat', 'Admin\LayananSewaAlatAdmin::listSewaAlat');

	$routes->get('/DashboardAdmin/tambah-sewa-alat/(:any)', 'Admin\LayananSewaAlatAdmin::tambahSewaAlat/$1');
	$routes->get('/DashboardAdmin/tambah-sewa-alat/', 'Admin\LayananSewaAlatAdmin::tambahSewaAlat');
	$routes->post('/DashboardAdmin/saveTambahSewaAlat', 'Admin\LayananSewaAlatAdmin::saveTambahSewaAlat');

	$routes->get('/DashboardAdmin/update-sewa-alat/(:any)', 'Admin\LayananSewaAlatAdmin::updateSewaAlat/$1');
	$routes->post('/DashboardAdmin/saveUpdateSewaAlat/(:num)/(:num)', 'Admin\LayananSewaAlatAdmin::saveUpdateSewaAlat/$1/$2');

	$routes->delete('/DashboardAdmin/sewaAlat/(:num)', 'Admin\LayananSewaAlatAdmin::deleteSewaAlat/$1');

	// Dashboard Admin Layanan Pelatihan
	$routes->get('/DashboardAdmin/layanan-pelatihan', 'Admin\LayananPelatihanAdmin::listPelatihan');

	$routes->get('/DashboardAdmin/tambah-pelatihan/(:any)', 'Admin\LayananPelatihanAdmin::tambahPelatihan/$1');
	$routes->get('/DashboardAdmin/tambah-pelatihan/', 'Admin\LayananPelatihanAdmin::tambahPelatihan');
	$routes->post('/DashboardAdmin/saveTambahPelatihan', 'Admin\LayananPelatihanAdmin::saveTambahPelatihan');

	$routes->get('/DashboardAdmin/update-pelatihan/(:any)', 'Admin\LayananPelatihanAdmin::updatePelatihan/$1');
	$routes->get('/DashboardAdmin/update-pelatihan', 'Admin\LayananPelatihanAdmin::updatePelatihan');
	$routes->post('/DashboardAdmin/update-pelatihan', 'Admin\LayananPelatihanAdmin::updatePelatihan');
	$routes->post('/DashboardAdmin/saveUpdatePelatihan', 'Admin\LayananPelatihanAdmin::saveUpdatePelatihan');

	$routes->get('/DashboardAdmin/detail-pelatihan/(:any)', 'Admin\LayananPelatihanAdmin::detailPelatihan/$1');
	$routes->get('/DashboardAdmin/tambah-peserta/(:any)', 'Admin\LayananPelatihanAdmin::tambahPeserta/$1');
	$routes->post('/DashboardAdmin/saveTambahPesertaLama', 'Admin\LayananPelatihanAdmin::saveTambahPesertaLama');
	$routes->post('/DashboardAdmin/saveTambahPesertaBaru', 'Admin\LayananPelatihanAdmin::saveTambahPesertaBaru');
	$routes->get('/DashboardAdmin/update-peserta/(:any)/(:any)', 'Admin\LayananPelatihanAdmin::updatePeserta/$1/$2');
	$routes->post('/DashboardAdmin/saveUpdatePeserta', 'Admin\LayananPelatihanAdmin::saveUpdatePeserta');

	$routes->delete('/DashboardAdmin/pelatihan/(:num)', 'Admin\LayananPelatihanAdmin::deletePelatihan/$1');
	$routes->delete('/DashboardAdmin/peserta/(:num)/(:num)/(:any)', 'Admin\LayananPelatihanAdmin::deletePeserta/$1/$2/$3');

	// Manajemen User
	$routes->get('/DashboardAdmin/manajemen-user', 'Admin\ManajemenUserAdmin::index');
	$routes->get('/DashboardAdmin/tambah-user', 'Admin\ManajemenUserAdmin::tambahUser');
	$routes->post('/DashboardAdmin/saveTambahUser', 'Admin\ManajemenUserAdmin::saveTambahUser/$1');

	$routes->get('/DashboardAdmin/update-user/(:any)', 'Admin\ManajemenUserAdmin::updateUser/$1');
	$routes->post('/DashboardAdmin/update-user', 'Admin\ManajemenUserAdmin::updateUser');
	$routes->get('/DashboardAdmin/update-user', 'Admin\ManajemenUserAdmin::updateUser');

	$routes->post('/DashboardAdmin/saveUpdateUser/(:num)', 'Admin\ManajemenUserAdmin::saveUpdateUser/$1');
	$routes->post('/DashboardAdmin/saveUpdateUser/', 'Admin\ManajemenUserAdmin::saveUpdateUser/$1');
	$routes->delete('/DashboardAdmin/manajemen-user/(:num)', 'Admin\ManajemenUserAdmin::deleteUser/$1');
});


$routes->group('', ['filter' => 'user'], static function ($routes) {
	$routes->get('/dashboard-user', 'User\LayananSewaRuanganUser::listSewaRuangan');
	// Dashboard User Layanan sewa ruangan
	$routes->get('/dashboard-user/layanan-sewa-ruangan', 'User\LayananSewaRuanganUser::listSewaRuangan');

	$routes->get('/dashboard-user/tambah-sewa-ruangan/(:any)', 'User\LayananSewaRuanganUser::tambahSewaRuangan/$1');
	$routes->get('/dashboard-user/tambah-sewa-ruangan/', 'User\LayananSewaRuanganUser::tambahSewaRuangan');
	$routes->post('/dashboard-user/saveTambahSewaRuangan', 'User\LayananSewaRuanganUser::saveTambahSewaRuangan');

	$routes->get('/dashboard-user/update-sewa-ruangan/(:any)', 'User\LayananSewaRuanganUser::updateSewaRuangan/$1');
	$routes->post('/dashboard-user/saveUpdateSewaRuangan/(:num)/(:num)', 'User\LayananSewaRuanganUser::saveUpdateSewaRuangan/$1/$2');

	$routes->delete('/dashboard-user/sewaRuangan/(:num)', 'User\LayananSewaRuanganUser::deleteSewaRuangan/$1');

	// Dashboard User Layanan sewa alat
	$routes->get('/dashboard-user/layanan-sewa-alat', 'User\LayananSewaAlatUser::listSewaAlat');

	$routes->get('/dashboard-user/tambah-sewa-alat/(:any)', 'User\LayananSewaAlatUser::tambahSewaAlat/$1');
	$routes->get('/dashboard-user/tambah-sewa-alat/', 'User\LayananSewaAlatUser::tambahSewaAlat');
	$routes->post('/dashboard-user/saveTambahSewaAlat', 'User\LayananSewaAlatUser::saveTambahSewaAlat');

	$routes->get('/dashboard-user/update-sewa-alat/(:any)', 'User\LayananSewaAlatUser::updateSewaAlat/$1');
	$routes->post('/dashboard-user/saveUpdateSewaAlat/(:num)/(:num)', 'User\LayananSewaAlatUser::saveUpdateSewaAlat/$1/$2');

	$routes->delete('/dashboard-user/sewaAlat/(:num)', 'User\LayananSewaAlatUser::deleteSewaAlat/$1');

	// Dashboard User Layanan Pelatihan
	$routes->get('/dashboard-user/layanan-pelatihan', 'User\LayananPelatihanUser::listPelatihan');

	$routes->get('/dashboard-user/tambah-pelatihan/(:any)', 'User\LayananPelatihanUser::tambahPelatihan/$1');
	$routes->get('/dashboard-user/tambah-pelatihan/', 'User\LayananPelatihanUser::tambahPelatihan');
	$routes->post('/dashboard-user/saveTambahPelatihan', 'User\LayananPelatihanUser::saveTambahPelatihan');

	$routes->get('/dashboard-user/update-pelatihan/(:any)', 'User\LayananPelatihanUser::updatePelatihan/$1');
	$routes->get('/dashboard-user/update-pelatihan', 'User\LayananPelatihanUser::updatePelatihan');
	$routes->post('/dashboard-user/update-pelatihan', 'User\LayananPelatihanUser::updatePelatihan');
	$routes->post('/dashboard-user/saveUpdatePelatihan', 'User\LayananPelatihanUser::saveUpdatePelatihan');

	$routes->delete('/dashboard-user/pelatihan/(:num)', 'User\LayananPelatihanUser::deletePelatihan/$1');
});

service('auth')->routes($routes);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
