<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

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
        Route::get('/product/{id}', 'show')->name('show.product');
        // Route::post('/uploadFoto', 'savePhoto')->name('uplodad.photo');
    });
    
Route::controller(OrderController::class)
    // ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::post('/order', 'create')->name('addToCart');
        Route::get('/cart', 'cart')->name('cart');
        Route::delete('/cart', 'deleteProduct')->name('cart.deleteProduct');
        Route::post('/cart', 'payOrder')->name('cart.payOrder');
        Route::patch('/cart', 'updateOrder')->name('cart.updateOrder');
        Route::get('/my-order', 'showMyOrders')->name('my.order');
        Route::post('/my-order', 'showMyOrdersPost')->name('my.order.post');
    });

Route::controller(StripeController::class)
     ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/test', 'index')->name('home');
        Route::post('/checkout', 'checkout')->name('checkout');
        Route::get('/success', 'success')->name('success');
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
