<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user/lihat_barang';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth';
$route['logout'] = 'auth/logout';

$route['nama'] = 'nama_barang';
$route['nama/ubah/(:any)'] = 'nama_barang/ubah/$1';
$route['nama/hapus/(:any)'] = 'nama_barang/hapus/$1';

//$route['ruangan'] = 'ruangan';
$route['ruangan/ubah/(:any)'] = 'ruangan/ubah/$1';
$route['ruangan/hapus/(:any)'] = 'ruangan/hapus/$1';

//$route['kondisi'] = 'kondisi';
$route['kondisi/ubah/(:any)'] = 'kondisi/ubah/$1';
$route['kondisi/hapus/(:any)'] = 'kondisi/hapus/$1';

$route['profile'] = 'user';
$route['profile/ubah'] = 'user';
$route['profile/password'] = 'user';
$route['profile/reset_foto'] = 'user/reset_foto';

$route['dashboard'] = 'petugas';
$route['users'] = 'petugas/users';
$route['users/ubah/(:any)'] = 'petugas/ubah_users/$1';
$route['users/hapus/(:any)'] = 'petugas/hapus_users/$1';
//$route['users/reset_foto/(:any)'] = 'user/reset_foto/$1';
$route['users/ubah_status'] = 'petugas/ubah_status';

//$route['role'] = 'role';
$route['role/ubah/(:any)'] = 'role/ubah/$1';
$route['role/hapus/(:any)'] = 'role/hapus/$1';


$route['info'] = 'user/lihat_barang';
$route['info/detail'] = 'user/detail_barang';

$route['barang'] = 'barang';
$route['barang/ubah'] = 'barang/ubah_barang';
$route['barang/hapus'] = 'barang/hapus_barang';

$route['transaksi_masuk'] = 'barang/transaksi_masuk';
//$route['transaksi_keluar'] = 'inventory/transaksi_keluar';

$route['laporan'] = 'barang/cetak_laporan';
$route['cetak'] = 'barang/cetak';