<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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


Route::get('menu', [ProductController::class, 'listActiveProducts'])->name('menu.index');

// CRUD routes for products
Route::middleware(['auth.tenant'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index')->middleware('auth.tenant');;
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::resource('products', ProductController::class);

Route::post('/submitOrder', [OrderController::class, 'submitOrder'])->name('submitOrder');
