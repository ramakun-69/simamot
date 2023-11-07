<?php

use App\Controllers\Home;
use App\Controllers\Dashboard;
use Myth\Auth\Config\Services;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);


$routes->get('/', 'Dashboard::index');
$routes->post('/chart-penyewaan', 'Home::showChartPenyewaan');
$routes->post('/chart-transaksi', 'Home::showChartTransaksi');
$routes->get('countNamaUser', 'Home::countNamaUser');
$routes->post('ajax/getFilteredData', 'Userad::getFilteredData');

$routes->group('users', function ($r) {
    $r->get('/', 'Users::index');
    $r->get('index', 'Users::index');
    $r->get('create', 'Users::create');
    $r->get('edit/(:any)', 'Users::edit/$1');
    $r->post('edit/(:any)', 'Users::set_password/$1');
    $r->delete('(:num)', 'Users::delete/$1');
    $r->get('(:any)', 'Users::detail/$1');
});




$routes->group('userad', function ($r) {
    //Routes untuk mengakses method index() di controller Book.
    $r->get('/', 'Userad::index');
    //Routes untuk mengakses Create Book
    $r->get('create', 'Userad::create');
    //Routes untuk menambah buku
    $r->post('create', 'Userad::save');
    //Routes untuk mengakses edit book
    $r->get('edit/(:any)', 'Userad::edit/$1');
    //Routes untuk mengupdate buku
    $r->post('edit/(:any)', 'Userad::update/$1');
    //Routes untuk delete
    $r->delete('(:num)', 'Userad::delete/$1');
    //Routes untuk mengakses routing book
    $r->get('(:any)', 'Userad::detail/$1');
    $r->post('import', 'Userad::importData');
});

$routes->group('report', function ($r) {
    //Routes untuk mengakses method index() di controller Book.
    $r->get('/', 'Report::index');
    $r->get('exportpdf', 'Report::exportPDF');
    $r->get('exportpdfAkutansi', 'Report::exportPDFAkutansi');
});
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
