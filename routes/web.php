<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
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

Route::controller(SignUpController::class)->prefix('auth')->group(function () {
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/auth-signup', 'auth_signup')->name('auth_signup');
});

Route::controller(SignInController::class)->prefix('auth')->group(function () {
    Route::get('/signin', 'signin')->name('signin');
    Route::post('/auth-signin', 'auth_signin')->name('auth_signin');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'home')->name('welcome');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::resource('/categories', CategoryController::class);
Route::resource('/products', ProductController::class);
