<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CekPesananController extends Controller
{
    public function listActiveProducts()
    {
        return view('cekPesanan.index', [
            'active' => 'cekPesanan'
        ]);
    }
}
