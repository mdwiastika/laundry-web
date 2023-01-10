<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Models\DetailTransaksi;
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
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'postLogin']);
    Route::post('/register', [AuthController::class, 'postRegister']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'main']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Admin Role
Route::middleware(['auth'])->group(function () {
    Route::resource('/customer', CustomerController::class);
    Route::resource('/paket', PaketController::class);
    Route::resource('/transaksi', TransaksiController::class);
});

// Owner Role
Route::middleware(['auth', 'is_owner'])->group(function () {
});

// Kasir Role
Route::middleware(['auth', 'is_kasir'])->group(function () {
});
