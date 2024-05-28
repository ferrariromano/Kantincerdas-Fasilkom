<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TenantAuthController;



Route::get('/', function () {
    return view('beranda', [
        'active' => 'beranda'
    ]);
});

Route::get('/login', [TenantAuthController::class, 'showLoginForm'])->name('tenant.login');
Route::post('/login', [TenantAuthController::class, 'login']);
Route::post('/logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');

Route::middleware(['auth.tenant'])->group(function () {
    Route::get('/dashboard/{dashboard}', [TenantAuthController::class, 'dashboard'])->name('dashboard')->middleware('auth.tenant');
});




Route::get('/menu', [ProductController::class, 'index']);
// Route::get('/product/{id}', [ProductController::class, 'getProduct'])->name('product.get');

// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');


Route::resource('products', ProductController::class);
