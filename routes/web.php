<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CheckPrivilegesController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/checkPrivileges', [CheckPrivilegesController::class, 'index']);

Route::get('/', [LayoutController::class, 'showProdyctBoard'])->name('home');
Route::get('/item/{id}', [LayoutController::class, 'show'])->name('show.product');
Route::post('/', [LayoutController::class, 'getCategory'])->name('category.get');
// /////

Route::controller(AdminController::class)
    ->middleware(['auth', 'admin', 'verified'])->group(function () {
        Route::get('/admin', 'dashboard')->name('dashboard');
        Route::get('/admin/users', 'usersList')->name('admin.usersList');
        Route::get('/admin/users/{id}', 'userInfo')->name('admin.userInfo');
        Route::patch('/admin/users/{id}', 'userEdit')->name('admin.userEdit');
    });

Route::controller(ProductController::class)
    ->middleware(['auth', 'admin', 'verified'])->group(function () {
        Route::get('/products', 'list')->name('products');
        Route::get('/products/create', 'create')->name('product.create');
        Route::post('/products', 'store')->name('product.store');
        Route::patch('/products/{id}', 'update')->name('product.update');
    });

Route::controller(AdminOrderController::class)
    ->middleware(['auth', 'admin','verified'])
    ->group(function () {
        Route::get('/orders', 'list')->name('orders');
        Route::patch('/orders/{id}', 'updateStatus')->name('orders.update.status');
    });

Route::controller(OrderController::class)
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::post('/order', 'create')->name('addToCart');
        Route::get('/cart', 'cart')->name('cart');
        Route::delete('/cart', 'removeDetalsOrderCart')->name('cart.deleteProduct');
        Route::post('/cart', 'payOrder')->name('cart.payOrder');
        Route::patch('/cart', 'updateCart')->name('cart.updateOrder');
        Route::patch('/cart/shipment', 'setShipmentMethod')->name('cart.setShipmentMethod');
        Route::get('/my-order', 'showMyOrders')->name('my.order');
        Route::post('/my-order', 'post')->name('my.order.post');
    });

Route::controller(CategoryController::class)
    ->middleware(['admin', 'auth'])
    ->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::post('/categories', 'create')->name('categories.create');
        Route::put('/categories/{id?}', 'edit')->name('categories.edit');
        Route::delete('/categories/{id}/{parentId?}', [CategoryController::class, 'delete'])->name('categories.delete');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'setAddress'])
        ->name('profile.address');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile/{product}', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



require __DIR__ . '/auth.php';
