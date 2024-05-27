<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TenantAuthController;


Route::get('/', function () {
    return view('beranda', [
        'active' => 'beranda'
    ]);
});

Route::get('/login', [TenantAuthController::class, 'showLoginForm'])->name('tenant.loginForm');
Route::post('/login', [TenantAuthController::class, 'login'])->name('tenant.login');
// Route::middleware(['auth:tenant'])->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Welcome to the tenant dashboard!';
//     })->name('dashboard');
// });

Route::middleware(['auth:tenant'])->group(function () {
    Route::get('/dashboard/{dashboard}', [TenantAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/tenant/logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');
});

Route::get('/menu', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'getProduct'])->name('product.get');

