<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

// ...existing code...
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
Route::post('/dashboard', [AuthController::class, 'index'])->name('dashboard');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/beli/{id}', [ProdukController::class, 'beli'])->name('beli');
Route::middleware('auth')->group(function () {
Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
        // ...existing code...

        // Route untuk dashboard admin
Route::middleware('auth:admin')->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        });

        // Route untuk dashboard customer
Route::middleware('auth:customer')->group(function () {
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard']);
        });
Route::resource('produk', ProdukController::class);
        });
    // ...existing code...
});;
