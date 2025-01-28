<?php

use App\Controllers\AuthController;
use App\Controllers\SatuanController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', [AuthController::class, 'formLogin']);

$routes->get('/kategori', [CategoryController::class, 'index'], ['as' => 'kategori_index']);
$routes->post('/kategori/store', [CategoryController::class, 'store'], ['as' => 'kategori_store']);
$routes->post('/kategori/update/(:num)', [CategoryController::class, 'update'], ['as' => 'kategori_update']);
$routes->delete('/kategori/delete/(:num)', [CategoryController::class, 'destroy'], ['as' => 'kategori_delete']);

$routes->get('/satuan', [SatuanController::class, 'index'], ['as' => 'satuan_index']);
$routes->post('/satuan/store', [SatuanController::class, 'store'], ['as' => 'satuan_store']);
$routes->post('/satuan/update/(:num)', [SatuanController::class, 'update'], ['as' => 'satuan_update']);
$routes->delete('/satuan/delete/(:num)', [SatuanController::class, 'destroy'], ['as' => 'satuan_delete']);

$routes->group('produk', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', [ProductController::class, 'index'], ['as' => 'produk_index']);
    $routes->post('getproducts', [ProductController::class, 'getProduk'], ['as' => 'get_produk']);
    $routes->get('create', [ProductController::class, 'create'], ['as' => 'produk_create']);
    $routes->post('store', [ProductController::class, 'store'], ['as' => 'produk_store']);
    $routes->get('edit/(:num)', [ProductController::class, 'edit/$1'], ['as' => 'produk_edit']);
    $routes->post('update/(:num)', [ProductController::class, 'update/$1'], ['as' => 'produk_update']);
    $routes->delete('delete/(:num)', [ProductController::class, 'delete'], ['as' => 'produk_delete']);
    $routes->post('deletes', [ProductController::class, 'deletes'], ['as' => 'produk_deletes']);
});
