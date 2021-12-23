<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LiqPayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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



Route::middleware('guest')->group(static function () {
    Route::get('register', fn () => view('guest.register'));
    Route::get('login', fn () => view('guest.login'))->name('login');

    Route::post('register', [GuestController::class, 'register']);
    Route::post('login', [GuestController::class, 'login']);
});

Route::middleware('auth')->group(static function () {
    Route::get('/', [HomeController::class, 'main']);
    Route::get('/category/{gender}/{product_id}', [ProductController::class, 'show'])->name('showProduct');
    Route::get('/cart', [CartController::class, 'index'])->name('cartIndex');
    Route::get('/cart/delete-item/{itemId}', [CartController::class, 'deleteItemCart'])->name('deleteItemCart');
    Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/status/{invoiceId}', [LiqPayController::class, 'status'])->name('status');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/{category}', [ProductController::class, 'showCategory'])->name('showCategory');





});
