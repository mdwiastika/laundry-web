<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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
    return redirect('/login');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('post-login');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('post-register');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'main'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Role Only
Route::middleware(['auth'])->group(function () {
    Route::resource('/member', MemberController::class)->middleware('customer_ok');
    Route::resource('/paket', PaketController::class)->middleware('is_admin');
    Route::resource('/user', UserController::class)->middleware('is_admin');
    Route::resource('/outlet', OutletController::class)->middleware('is_admin');
    Route::resource('/transaksi', TransaksiController::class)->middleware('customer_ok');
    Route::get('/laporan', [LaporanController::class, 'main'])->name('laporan');
    Route::get('/laporan/{start}/{end}', [LaporanController::class, 'search'])->name('laporan-search');
});
