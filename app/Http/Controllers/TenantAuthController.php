<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use Illuminate\Support\Str;

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

            // Set session untuk tenant_id dan tenant_name
            $request->session()->put('tenant_id', $tenant->id_tenant);
            $request->session()->put('tenant_name', $tenant->nama_tenant);

            // Dapatkan nama tenant yang telah di-slug
            $dashboard = Str::slug($tenant->nama_tenant);

            // Arahkan pengguna ke dashboard dengan parameter nama_tenant
            return redirect()->route('tenant.dashboard', ['dashboard' => $dashboard]);
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::guard('tenant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('tenant.login'); // Mengarahkan ke halaman login
    }
}
