<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('tenant')->check()) {
            return redirect('/login');
        }

        // Ambil informasi tenant saat ini
        $tenant = Auth::guard('tenant')->user();

        // Tentukan tampilan dashboard berdasarkan tenant
        $dashboardView = $tenant->id_tenant % 2 === 0 ? 'dashboard_a' : 'dashboard_b';

        // Set session untuk menentukan tampilan dashboard
        $request->session()->put('dashboard_view', $dashboardView);

        return $next($request);
    }
}

