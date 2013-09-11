<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'produk';
$route['404_override'] = '';
// Kategori
$route['kategori'] = 'kategori/index';
$route['kategori/(:any)'] = 'kategori/index/$1';
// Produk
$route['produk'] = 'produk/index';
$route['produk/(:any)'] = 'produk/index/$1';
// Pelanggan
$route['pelanggan/'] = 'pelanggan/index';
$route['pelanggan/(:num)-(:any)'] = 'pelanggan/index/$1';
$route['admin/pelanggan/(:num)-(:any)'] = 'admin/pelanggan/index/$1';
// Pesanan
$route['admin/pesanan/(:num)'] = 'admin/pesanan/index/$1';
// Admin
$route['admin'] = 'admin/dashboard';
$route['admin/(:num)-(:any)'] = 'admin/dashboard/index/$1';
$route['admin/login'] = 'admin/dashboard/login';
$route['admin/data-admin'] = 'admin/dashboard/data-admin';
$route['admin/aktif/(:num)'] = 'admin/dashboard/aktif/$1';
$route['admin/nonaktif/(:num)'] = 'admin/dashboard/nonaktif/$1';
$route['admin/tambah'] = 'admin/dashboard/tambah';
$route['admin/logout'] = 'admin/dashboard/logout';
$route['admin/help'] = 'admin/dashboard/help';
// Admin produk
$route['admin/produk/(:num)'] = 'admin/produk/index/$1';
// Halaman informasi
$route['informasi/(:any)'] = 'informasi/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */