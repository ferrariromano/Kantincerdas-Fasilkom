<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('beranda', [
        'active' => 'beranda'
    ]);
});

Route::get('/menu', [ProductController::class, 'index']);

