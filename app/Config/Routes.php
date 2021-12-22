<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Beranda');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Beranda::index');
$routes->get('/tentangDesa', 'TentangDesa::index');

$routes->get('/informasiKemasyarakatan', 'Informasi\InformasiKemasyarakatan::index');
$routes->get('/informasiKemasyarakatan/list', 'Informasi\InformasiKemasyarakatan::list');
$routes->post('/informasiKemasyarakatan/list', 'Informasi\InformasiKemasyarakatan::list');
$routes->get('/informasiKemasyarakatan/create', 'Informasi\InformasiKemasyarakatan::create', ['filter' => 'role:super-admin,admin']);
$routes->post('/informasiKemasyarakatan/save', 'Informasi\InformasiKemasyarakatan::save', ['filter' => 'role:super-admin,admin']);
$routes->get('/informasiKemasyarakatan/edit/(:segment)', 'Informasi\InformasiKemasyarakatan::edit/$1', ['filter' => 'role:super-admin,admin']);
$routes->post('/informasiKemasyarakatan/update/(:segment)', 'Informasi\InformasiKemasyarakatan::update/$1', ['filter' => 'role:super-admin,admin']);
$routes->delete('/informasiKemasyarakatan/(:segment)', 'Informasi\InformasiKemasyarakatan::delete/$1', ['filter' => 'role:super-admin,admin']);
$routes->get('/informasiKemasyarakatan/(:segment)', 'Informasi\InformasiKemasyarakatan::detail/$1');

$routes->get('/cekDataDiri', 'Kependudukan\CekDataDiri::index', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/cekDataDiri', 'Kependudukan\CekDataDiri::index', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/cekDataDiri/create', 'Kependudukan\CekDataDiri::create', ['filter' => 'role:super-admin,admin']);
$routes->post('/cekDataDiri/save', 'Kependudukan\CekDataDiri::save', ['filter' => 'role:super-admin,admin']);
$routes->post('/cekDataDiri/import', 'Kependudukan\CekDataDiri::import', ['filter' => 'role:super-admin,admin']);
$routes->get('/cekDataDiri/edit/(:segment)', 'Kependudukan\CekDataDiri::edit/$1', ['filter' => 'role:super-admin,admin']);
$routes->post('/cekDataDiri/update/(:segment)', 'Kependudukan\CekDataDiri::update/$1', ['filter' => 'role:super-admin,admin']);
$routes->delete('/cekDataDiri/(:segment)', 'Kependudukan\CekDataDiri::delete/$1', ['filter' => 'role:super-admin,admin']);
$routes->get('/cekDataDiri/(:segment)', 'Kependudukan\CekDataDiri::detail/$1', ['filter' => 'role:super-admin,admin,user']);

$routes->get('/layanan', 'Kependudukan\Layanan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/layanan', 'Kependudukan\Layanan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/layanan/create', 'Kependudukan\Layanan::create', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/layanan/save', 'Kependudukan\Layanan::save', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/layanan/edit/(:segment)', 'Kependudukan\Layanan::edit/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/layanan/update/(:segment)', 'Kependudukan\Layanan::update/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/layanan/cetak/(:segment)', 'Kependudukan\Layanan::cetak/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->delete('/layanan/(:segment)', 'Kependudukan\Layanan::delete/$1', ['filter' => 'role:super-admin,user']);
$routes->get('/layanan/(:segment)', 'Kependudukan\Layanan::detail/$1', ['filter' => 'role:super-admin,admin,user']);

$routes->get('/inputSaranPembangunan', 'Pembangunan\InputSaranPembangunan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/inputSaranPembangunan', 'Pembangunan\InputSaranPembangunan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/inputSaranPembangunan/create', 'Pembangunan\InputSaranPembangunan::create', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/inputSaranPembangunan/save', 'Pembangunan\InputSaranPembangunan::save', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/inputSaranPembangunan/edit/(:segment)', 'Pembangunan\InputSaranPembangunan::edit/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/inputSaranPembangunan/update/(:segment)', 'Pembangunan\InputSaranPembangunan::update/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->delete('/inputSaranPembangunan/(:segment)', 'Pembangunan\InputSaranPembangunan::delete/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/inputSaranPembangunan/(:segment)', 'Pembangunan\InputSaranPembangunan::detail/$1', ['filter' => 'role:super-admin,admin,user']);

$routes->get('/inventarisHasilPembangunan', 'Pembangunan\InventarisHasilPembangunan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/inventarisHasilPembangunan', 'Pembangunan\InventarisHasilPembangunan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/inventarisHasilPembangunan/create', 'Pembangunan\InventarisHasilPembangunan::create', ['filter' => 'role:super-admin,admin']);
$routes->post('/inventarisHasilPembangunan/save', 'Pembangunan\InventarisHasilPembangunan::save', ['filter' => 'role:super-admin,admin']);
$routes->get('/inventarisHasilPembangunan/edit/(:segment)', 'Pembangunan\InventarisHasilPembangunan::edit/$1', ['filter' => 'role:super-admin,admin']);
$routes->post('/inventarisHasilPembangunan/update/(:segment)', 'Pembangunan\InventarisHasilPembangunan::update/$1', ['filter' => 'role:super-admin,admin']);
$routes->delete('/inventarisHasilPembangunan/(:segment)', 'Pembangunan\InventarisHasilPembangunan::delete/$1', ['filter' => 'role:super-admin,admin']);
$routes->get('/inventarisHasilPembangunan/(:segment)', 'Pembangunan\InventarisHasilPembangunan::detail/$1', ['filter' => 'role:super-admin,admin,user']);

$routes->get('/userList', 'Akun\UserList::index', ['filter' => 'role:super-admin,admin']);
$routes->post('/userList', 'Akun\UserList::index', ['filter' => 'role:super-admin,admin']);
$routes->get('/userList/edit/(:segment)', 'Akun\UserList::edit/$1', ['filter' => 'role:super-admin']);
$routes->post('/userList/update/(:segment)', 'Akun\UserList::update/$1', ['filter' => 'role:super-admin']);
$routes->get('/userList/editProfile/(:segment)', 'Akun\UserList::editProfile/$1', ['filter' => 'role:super-admin,admin']);
$routes->post('/userList/updateProfile/(:segment)', 'Akun\UserList::updateProfile/$1', ['filter' => 'role:super-admin,admin']);
$routes->delete('/userList/(:segment)', 'Akun\UserList::delete/$1', ['filter' => 'role:super-admin']);
$routes->post('/userList/(:segment)', 'Akun\UserList::resetPassword/$1', ['filter' => 'role:super-admin,admin']);
$routes->get('/userList/(:segment)', 'Akun\UserList::detail/$1', ['filter' => 'role:super-admin,admin']);

$routes->get('/myProfile', 'Akun\MyProfile::index', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/myProfile/gantiPassword', 'Akun\MyProfile::gantiPassword', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/myProfile/gantiPassword/(:num)', 'Akun\MyProfile::updatePassword/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/myProfile/edit', 'Akun\MyProfile::edit', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/lupaPassword', 'Akun\MyProfile::lupaPassword');
$routes->post('/lupaPassword/updateLupaPassword', 'Akun\MyProfile::updateLupaPassword');
$routes->post('/myProfile/update/(:num)', 'Akun\MyProfile::update/$1', ['filter' => 'role:super-admin,admin,user']);

$routes->get('/pesan', 'Pesan\Pesan::index', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/pesan/create/(:segment)', 'Pesan\Pesan::create/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->post('/pesan/save/(:segment)', 'Pesan\Pesan::save/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/pesan/kotakKeluar', 'Pesan\Pesan::outbox', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/pesan/kotakMasuk', 'Pesan\Pesan::inbox', ['filter' => 'role:super-admin,admin,user']);
$routes->get('/pesan/detail/(:segment)', 'Pesan\Pesan::detail/$1', ['filter' => 'role:super-admin,admin,user']);
$routes->delete('/pesan/(:segment)', 'Pesan\Pesan::delete/$1', ['filter' => 'role:super-admin,admin,user']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
