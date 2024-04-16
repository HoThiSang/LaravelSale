<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SendMailController;
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


Route::get('/products/{id}', [ProductController::class, 'show'])->name('detail');

Route::get('/pricing', [ProductController::class, 'showPricing'])->name('showPricing');

Route::get('/product-type/{id}', [ProductController::class, 'showProductType'])->name('showProductType');

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/login', [UserController::class, 'postLogin'])->name('postLogin');

Route::get('/sign-up', [UserController::class, 'getSignUp'])->name('sign-up');


Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign-up');

Route::get('/about-page', [HomeController::class, 'about'])->name('about-page');

Route::get('/contact-page', [HomeController::class, 'contact'])->name('contact-page');

Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');

Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('delete-cart');

Route::get('/checkout', [BillController::class, 'index'])->name('checkout-page');

Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('shopping-cart');

Route::post('/payment-checkout', [BillController::class, 'store'])->name('checkout');

Route::post('/update-cart/{id}', [CartController::class, 'updateCart'])->name('update-cart');

Route::get('/show-bill', [BillController::class, 'showBill'])->name('show-bill');

Route::post('/send-mail', [SendMailController::class, 'sendMail'])->name('sendEmail');
