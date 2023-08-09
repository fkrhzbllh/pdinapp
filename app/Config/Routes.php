<?php

namespace Config;

use App\Controllers\FullCalendar;

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
$routes->get('/', 'Beranda::index');
// $routes->get('/sewa-ruang', 'SewaRuang::index');
$routes->get('/fasilitas', 'Fasilitas::index');
$routes->get('/kegiatan', 'Kegiatan::index');
$routes->get('/galeri', 'Galeri::index');

$routes->get('/fasilitas/ruang/(:segment)', 'Fasilitas::detailRuangan/$1');
$routes->get('/fasilitas/alat/(:segment)', 'Fasilitas::detailAlat/$1');

$routes->delete('/DashboardAdmin/ruang/(:num)', 'DashboardAdmin::deleteRuangan/$1');
$routes->delete('/DashboardAdmin/alat/(:num)', 'DashboardAdmin::deleteAlat/$1');
$routes->delete('/DashboardAdmin/rilismedia/(:num)', 'DashboardAdmin::deleteRilisMedia/$1');
$routes->delete('/DashboardAdmin/kegiatan/(:num)', 'DashboardAdmin::deleteKegiatan/$1');

$routes->get('/admin/ruang/(:any)', 'Admin::detailRuangan/$1');
$routes->get('/admin/alat/(:any)', 'Admin::detailAlat/$1');

$routes->get('/rilis-media/(:any)', 'RilisMedia::detail/$1');
$routes->get('/rilis-media', 'RilisMedia::index');
$routes->post('/rilis-media', 'RilisMedia::index');

$routes->get('/ProfilPDIN', 'ProfilPdin::index');
$routes->get('/kontak', 'Kontak::index');

$routes->get('/DashboardAdmin', 'DashboardAdmin::index');
$routes->get('/DashboardAdmin/rilis-media', 'DashboardAdmin::index');
$routes->get('/DashboardAdmin/ruangan', 'DashboardAdmin::ruangan');
$routes->get('/DashboardAdmin/alat', 'DashboardAdmin::alat');
$routes->get('/DashboardAdmin/kegiatan', 'DashboardAdmin::kegiatan');

$routes->get('/DashboardAdmin/tambah-alat', 'DashboardAdmin::tambahAlat');
$routes->get('/DashboardAdmin/tambah-ruangan', 'DashboardAdmin::tambahRuangan');
$routes->get('/DashboardAdmin/tambah-kegiatan', 'DashboardAdmin::tambahKegiatan');
$routes->get('/DashboardAdmin/tambah-rilis-media', 'DashboardAdmin::tambahRilisMedia');
$routes->post('/DashboardAdmin/saveTambahAlat', 'DashboardAdmin::saveTambahAlat/$1');
$routes->post('/DashboardAdmin/saveTambahRuangan', 'DashboardAdmin::saveTambahRuangan/$1');
$routes->post('/DashboardAdmin/saveTambahKegiatan', 'DashboardAdmin::saveTambahKegiatan/$1');
$routes->post('/DashboardAdmin/saveTambahRilisMedia', 'DashboardAdmin::saveTambahRilisMedia/$1');

$routes->get('/DashboardAdmin/update-alat/(:any)', 'DashboardAdmin::updateAlat/$1');
$routes->get('/DashboardAdmin/update-ruangan/(:any)', 'DashboardAdmin::updateRuangan/$1');
$routes->get('/DashboardAdmin/update-kegiatan/(:any)', 'DashboardAdmin::updateKegiatan/$1');
$routes->get('/DashboardAdmin/update-rilis-media/(:any)', 'DashboardAdmin::updateRilisMedia/$1');
$routes->post('/DashboardAdmin/saveUpdateAlat/(:num)', 'DashboardAdmin::saveUpdateAlat/$1');
$routes->post('/DashboardAdmin/saveUpdateRuangan/(:num)', 'DashboardAdmin::saveUpdateRuangan/$1');
$routes->post('/DashboardAdmin/saveUpdateKegiatan/(:num)', 'DashboardAdmin::saveUpdateKegiatan/$1');
$routes->post('/DashboardAdmin/saveUpdateRilisMedia/(:num)', 'DashboardAdmin::saveUpdateRilisMedia/$1');

$routes->get('/DashboardAdmin/sewa-alat/(:any)', 'DashboardAdmin::listSewaAlat/$1');
$routes->get('/DashboardAdmin/sewa-ruangan/(:any)', 'DashboardAdmin::listSewaRuangan/$1');
$routes->get('/DashboardAdmin/tambah-sewa-alat/(:any)', 'DashboardAdmin::tambahSewaAlat/$1');
$routes->get('/DashboardAdmin/tambah-sewa-ruangan/(:any)', 'DashboardAdmin::tambahSewaRuangan/$1');
$routes->get('/DashboardAdmin/tambah-sewa-alat/', 'DashboardAdmin::tambahSewaAlat');
$routes->get('/DashboardAdmin/tambah-sewa-ruangan/', 'DashboardAdmin::tambahSewaRuangan');
$routes->post('/DashboardAdmin/saveTambahSewaAlat', 'DashboardAdmin::saveTambahSewaAlat');
$routes->post('/DashboardAdmin/saveTambahSewaRuangan', 'DashboardAdmin::saveTambahSewaRuangan');

// $routes->get('/DashboardAdmin/update-sewa-alat/(:any)', 'DashboardAdmin::updateSewaAlat/$1');
// $routes->get('/DashboardAdmin/update-sewa-ruangan/(:any)', 'DashboardAdmin::updateSewaRuangan/$1');
$routes->post('/DashboardAdmin/update-sewa-alat', 'DashboardAdmin::updateSewaAlat');
$routes->post('/DashboardAdmin/update-sewa-ruangan', 'DashboardAdmin::updateSewaRuangan');
$routes->post('/DashboardAdmin/saveUpdateSewaAlat/(:num)/(:num)', 'DashboardAdmin::saveUpdateSewaAlat/$1/$2');
$routes->post('/DashboardAdmin/saveUpdateSewaRuangan/(:num)/(:num)', 'DashboardAdmin::saveUpdateSewaRuangan/$1/$2');
$routes->delete('/DashboardAdmin/sewaRuangan/(:num)', 'DashboardAdmin::deleteSewaRuangan/$1');
$routes->delete('/DashboardAdmin/sewaAlat/(:num)', 'DashboardAdmin::deleteSewaAlat/$1');
// $routes->get('/dashboard', 'Dashboardadmin::index');

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
