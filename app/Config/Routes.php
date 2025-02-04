<?php

use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\UnitController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\Home;
use App\Controllers\HomeController;
use App\Controllers\PaymenController;
use App\Controllers\SaleController;
use App\Models\Cart;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/login', [AuthController::class, 'formLogin']);
$routes->get('/', [HomeController::class, 'index'], ['as' => 'home_index']);
$routes->get('/produk', [HomeController::class, 'products'], ['as' => 'home_product']);
$routes->post('/getproduct', [HomeController::class, 'getProducts'], ['as' => 'get_produk_sale']);

$routes->group('/cart', static function ($route) {
    $route->get('/', [CartController::class, 'index'], ['as' => 'cart_index']);
    $route->post('add/(:num)', [CartController::class, 'add'], ['as' => 'cart_add']);
    $route->post('update/(:num)', [CartController::class, 'update'], ['as' => 'cart_update']);
    $route->delete('delete/(:num)', [CartController::class, 'destroy'], ['as' => 'cart_delete']);
});

$routes->post('/payment', [PaymenController::class, 'payment'], ['as' => 'payment']);
$routes->get('/invoice/(:segment)', [PaymenController::class, 'invoice'], ['as' => 'invoice']);

// $routes->get('/penjualan', [SaleController::class, 'index']);
// $routes->post('/update_cart/(:num)', [SaleController::class, 'updateToCart'], ['as' => 'update_cart']);
// $routes->delete('/delete_cart/(:num)', [SaleController::class, 'deleteCart'], ['as' => 'delete_cart']);




$routes->get('/dashboard', 'Home::index');
$routes->group('/admin/kategori', static function ($route) {
    // GET
    $route->get('/', [CategoryController::class, 'index'], ['as' => 'category_index']);
    $route->get('create', [CategoryController::class, 'create'], ['as' => 'category_create']);
    $route->get('edit/(:num)', [CategoryController::class, 'edit'], ['as' => 'category_edit']);
    // POST
    $route->post('getcategories', [CategoryController::class, 'getCategory'], ['as' => 'get_category']);
    $route->post('store', [CategoryController::class, 'store'], ['as' => 'category_store']);
    $route->post('update/(:num)', [CategoryController::class, 'update'], ['as' => 'category_update']);
    $route->post('deletes', [CategoryController::class, 'deletes'], ['as' => 'category_deletes']);
    // DELETE
    $route->delete('delete/(:num)', [CategoryController::class, 'destroy'], ['as' => 'category_delete']);
});
$routes->group('admin/satuan', static function ($route) {
    // GET
    $route->get('/', [UnitController::class, 'index'], ['as' => 'unit_index']);
    $route->get('create', [UnitController::class, 'create'], ['as' => 'unit_create']);
    $route->get('edit/(:num)', [UnitController::class, 'edit'], ['as' => 'unit_edit']);
    // POST
    $route->post('getcategories', [UnitController::class, 'getUnit'], ['as' => 'get_unit']);
    $route->post('store', [UnitController::class, 'store'], ['as' => 'unit_store']);
    $route->post('update/(:num)', [UnitController::class, 'update'], ['as' => 'unit_update']);
    $route->post('deletes', [UnitController::class, 'deletes'], ['as' => 'unit_deletes']);
    // DELETE
    $route->delete('delete/(:num)', [UnitController::class, 'destroy'], ['as' => 'unit_delete']);
});
$routes->group('admin/produk', static function ($route) {
    $route->get('/', [ProductController::class, 'index'], ['as' => 'produk_index']);
    $route->post('getproducts', [ProductController::class, 'getProduk'], ['as' => 'get_produk']);
    $route->get('create', [ProductController::class, 'create'], ['as' => 'produk_create']);
    $route->post('store', [ProductController::class, 'store'], ['as' => 'produk_store']);
    $route->get('edit/(:num)', [ProductController::class, 'edit/$1'], ['as' => 'produk_edit']);
    $route->post('update/(:num)', [ProductController::class, 'update/$1'], ['as' => 'produk_update']);
    $route->delete('delete/(:num)', [ProductController::class, 'delete'], ['as' => 'produk_delete']);
    $route->post('deletes', [ProductController::class, 'deletes'], ['as' => 'produk_deletes']);
});
