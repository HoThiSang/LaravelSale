<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/{id}', [ProductController::class, 'show'])->name('detail');

Route::get('/pricing', [ProductController::class, 'showPricing'])->name('showPricing');

Route::get('/product-type/{id}', [ProductController::class, 'showProductType'])->name('showProductType');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/checkout', [HomeController::class, 'showCart'])->name('showCart');

Route::get('/login', [UserController::class, 'login'])->name('login');


Route::get('/sign-up', [UserController::class, 'signUp'])->name('sign-up');
