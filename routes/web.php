<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CekPesananController;
use App\Http\Controllers\TenantAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TenantOrderController;


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

Route::get('cekPesanan/{uid}', [CekPesananController::class, 'showOrder'])->name('cekPesanan');

Route::post('/submit-order', [OrderController::class, 'submitOrder'])->name('submitOrder');


// Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
Route::post('/payment/snap-token', [PaymentController::class, 'processPayment']);




Route::middleware(['auth.tenant'])->prefix('tenant')->group(function () {
    Route::get('orders', [TenantOrderController::class, 'index'])->name('tenantOrders.index');
    Route::get('orders/create', [TenantOrderController::class, 'create'])->name('tenantOrders.create');
    Route::post('orders', [TenantOrderController::class, 'store'])->name('tenantOrders.store');
    Route::get('orders/{order}/edit', [TenantOrderController::class, 'edit'])->name('tenantOrders.edit');
    Route::put('orders/{order}', [TenantOrderController::class, 'update'])->name('tenantOrders.update');
    Route::delete('orders/{order}', [TenantOrderController::class, 'destroy'])->name('tenantOrders.destroy');
    Route::get('orders/{order}', [TenantOrderController::class, 'show'])->name('tenantOrders.show');
    Route::post('orders/{order}/in-progress', [TenantOrderController::class, 'markInProgress'])->name('tenantOrders.inProgress');
    Route::post('orders/{order}/{item}/cancel', [TenantOrderController::class, 'markItemAsCanceled'])->name('tenantOrders.cancelItem');
});
