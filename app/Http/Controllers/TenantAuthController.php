<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class TenantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.tenant-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nama_tenant', 'password');

        if (Auth::guard('tenant')->attempt($credentials)) {
            // Ambil informasi tenant saat ini
            $tenant = Auth::guard('tenant')->user();

            // Tentukan tampilan dashboard berdasarkan id_tenant
            $dashboardView = $tenant->id_tenant % 2 === 0 ? 'dashboard_b' : 'dashboard_a';

            return redirect()->route('dashboard', ['dashboard' => $dashboardView]);
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function dashboard($dashboard)
    {
        // Tentukan tipe dashboard berdasarkan parameter
        $dashboardType = $dashboard;

        // dd($dashboardType);

        return view('dashboard', ['dashboardType' => $dashboardType]);
    }
    public function logout()
    {
        Auth::guard('tenant')->logout();

        return redirect('/login');
    }
}
