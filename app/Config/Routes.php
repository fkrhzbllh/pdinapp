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

// Halaman detail ruangan dan alat
$routes->get('/fasilitas/ruang/(:segment)', 'Fasilitas::detailRuangan/$1');
$routes->get('/fasilitas/alat/(:segment)', 'Fasilitas::detailAlat/$1');

// Halaman detail rilis media
$routes->get('/rilis-media/(:any)', 'RilisMedia::detail/$1');


// Dashboard Admin Alat
$routes->get('/DashboardAdmin/alat', 'Admin\AlatAdmin::index');

$routes->get('/DashboardAdmin/tambah-alat', 'Admin\AlatAdmin::tambahAlat');
$routes->post('/DashboardAdmin/saveTambahAlat', 'Admin\AlatAdmin::saveTambahAlat/$1');

$routes->get('/DashboardAdmin/update-alat/(:any)', 'Admin\AlatAdmin::updateAlat/$1');
$routes->post('/DashboardAdmin/saveUpdateAlat/(:num)', 'Admin\AlatAdmin::saveUpdateAlat/$1');

$routes->delete('/DashboardAdmin/alat/(:num)', 'Admin\AlatAdmin::deleteAlat/$1');

$routes->get('/DashboardAdmin/sewa-alat/(:any)', 'Admin\AlatAdmin::listSewaAlat/$1');
$routes->get('/DashboardAdmin/tambah-sewa-alat/(:any)', 'Admin\AlatAdmin::tambahSewaAlat/$1');
$routes->get('/DashboardAdmin/tambah-sewa-alat/', 'Admin\AlatAdmin::tambahSewaAlat');
$routes->post('/DashboardAdmin/saveTambahSewaAlat', 'Admin\AlatAdmin::saveTambahSewaAlat');

$routes->get('/DashboardAdmin/update-sewa-alat/(:any)', 'Admin\AlatAdmin::updateSewaAlat/$1');
$routes->post('/DashboardAdmin/saveUpdateSewaAlat/(:num)/(:num)', 'Admin\AlatAdmin::saveUpdateSewaAlat/$1/$2');

$routes->delete('/DashboardAdmin/sewaAlat/(:num)', 'Admin\AlatAdmin::deleteSewaAlat/$1');


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

$routes->delete('/DashboardAdmin/ruang/(:num)', 'Admin\RuanganAdmin::deleteRuangan/$1');

$routes->get('/DashboardAdmin/sewa-ruangan/(:any)', 'Admin\RuanganAdmin::listSewaRuangan/$1');

$routes->get('/DashboardAdmin/tambah-sewa-ruangan/(:any)', 'Admin\RuanganAdmin::tambahSewaRuangan/$1');
$routes->get('/DashboardAdmin/tambah-sewa-ruangan/', 'Admin\RuanganAdmin::tambahSewaRuangan');
$routes->post('/DashboardAdmin/saveTambahSewaRuangan', 'Admin\RuanganAdmin::saveTambahSewaRuangan');

$routes->get('/DashboardAdmin/update-sewa-ruangan/(:any)', 'Admin\RuanganAdmin::updateSewaRuangan/$1');
$routes->post('/DashboardAdmin/saveUpdateSewaRuangan/(:num)/(:num)', 'Admin\RuanganAdmin::saveUpdateSewaRuangan/$1/$2');

$routes->delete('/DashboardAdmin/sewaRuangan/(:num)', 'Admin\RuanganAdmin::deleteSewaRuangan/$1');

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
