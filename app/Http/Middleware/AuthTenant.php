<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class AuthTenant
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('tenant')->check()) {
            return redirect('/tenant/login');
        }

        // Dapatkan tenant yang sedang login
        $tenant = Auth::guard('tenant')->user();

        // Menambahkan tenant ke request sehingga dapat digunakan di view
        $request->attributes->set('tenant', $tenant);

        // Menambahkan tenant ke semua view secara otomatis
        view()->share('tenant', $tenant);

        return $next($request);
    }
}
