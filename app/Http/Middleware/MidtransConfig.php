<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class MidtransConfig
{
    public function handle(Request $request, Closure $next)
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        Log::info('Midtrans Configured: ', [
            'serverKey' => config('services.midtrans.serverKey'),
            'isProduction' => config('services.midtrans.isProduction'),
            'isSanitized' => config('services.midtrans.isSanitized'),
            'is3ds' => config('services.midtrans.is3ds')
        ]);

        return $next($request);
    }
}
