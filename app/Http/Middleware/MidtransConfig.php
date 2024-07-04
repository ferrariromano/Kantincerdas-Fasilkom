<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MidtransConfig
{
    public function handle(Request $request, Closure $next)
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
                // Disable SSL verification
        \Midtrans\Config::$curlOptions = array(
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        );

        return $next($request);
    }
}
