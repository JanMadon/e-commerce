<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CheckPrivilegesController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



// Route::get('/', function () {
//     return Inertia::render('Home', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/checkPrivileges', [CheckPrivilegesController::class, 'index']);

Route::get('/', [ProductController::class, 'list'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('show.product');
Route::post('/', [LayoutController::class, 'getCategory'])->name('category.get');
// /////

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)
    ->middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin/user-list', 'usersList')->name('admin.usersList');
    });

Route::controller(ProductController::class)
    ->middleware(['auth', 'verified'])->group(function () {
        Route::get('/addedProducts', 'list')->name('list.products');
        Route::get('/addProducts', 'form')->name('form.add.product');
        Route::post('/addProducts', 'create')->name('create.add.product');
        //Route::get('/product/{id}', 'show')->name('show.product');
        // Route::post('/uploadFoto', 'savePhoto')->name('uplodad.photo');
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
    });

Route::controller(AdminController::class)
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/admin', 'dashboard')->name('admin.dashboard');
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
