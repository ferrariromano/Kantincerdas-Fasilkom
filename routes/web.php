<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CekPesananController;
use App\Http\Controllers\TenantAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TenantOrderController;
use App\Http\Controllers\TenantFinancialReportController;
use App\Http\Controllers\TenantDashboardController;


Route::get('/', function () {
    return view('beranda', [
        'active' => 'beranda'
    ]);
});

Route::get('/login', [TenantAuthController::class, 'showLoginForm'])->name('tenant.login');
Route::post('/login', [TenantAuthController::class, 'login']);
Route::post('/logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');

Route::middleware(['auth.tenant'])->group(function () {
    Route::get('/dashboard/{dashboard}', [TenantDashboardController::class, 'dashboard'])->name('tenant.dashboard');
});

Route::get('menu', [ProductController::class, 'listActiveProducts'])->name('menu.index');

// CRUD routes for products
Route::middleware(['auth.tenant'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Route::resource('products', ProductController::class);

Route::post('/submitOrder', [OrderController::class, 'submitOrder'])->name('submitOrder');

Route::get('cekPesanan/{uid}', [CekPesananController::class, 'showOrder'])->name('cekPesanan');

// Route::post('/submit-order', [OrderController::class, 'submitOrder'])->name('submitOrder');


// Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
// Route::post('/payment/snap-token', [PaymentController::class, 'processPayment']);

Route::post('/submit-order', [OrderController::class, 'submitOrder']);



Route::middleware(['auth.tenant'])->group(function () {
    Route::get('orders/incoming', [TenantOrderController::class, 'incoming'])->name('tenantOrders.incoming');
    Route::get('orders', [TenantOrderController::class, 'index'])->name('tenantOrders.index');
    Route::get('orders/create', [TenantOrderController::class, 'create'])->name('tenantOrders.create');
    Route::post('orders', [TenantOrderController::class, 'store'])->name('tenantOrders.store');
    Route::get('orders/{order}/edit', [TenantOrderController::class, 'edit'])->name('tenantOrders.edit');
    Route::put('orders/{order}', [TenantOrderController::class, 'update'])->name('tenantOrders.update');
    Route::delete('orders/{order}', [TenantOrderController::class, 'destroy'])->name('tenantOrders.destroy');
    Route::get('orders/{order}', [TenantOrderController::class, 'show'])->name('tenantOrders.show');
    Route::get('/tenantOrders/in-progress', [TenantOrderController::class, 'inProgress'])->name('tenantOrders.inProgress');
    Route::get('/tenantOrders/completed', [TenantOrderController::class, 'completed'])->name('tenantOrders.completed');
});
Route::middleware(['auth.tenant'])->prefix('tenant')->group(function () {
    Route::get('/tenant-financial-report', [TenantFinancialReportController::class, 'index'])->name('tenantFinancialReport.index');
});
