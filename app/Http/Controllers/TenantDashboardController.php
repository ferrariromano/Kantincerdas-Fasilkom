<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\TenantFinancialReportController;

class TenantDashboardController extends Controller
{
    public function dashboard($dashboard)
    {
        // Cari tenant berdasarkan nama
        $tenant = Tenant::where('nama_tenant', $dashboard)->firstOrFail();

        // Buat instance dari TenantFinancialReportController
        $financialReportController = new TenantFinancialReportController();

        // Ambil data laporan keuangan untuk tenant
        $financialReportData = $financialReportController->getFinancialReportData($tenant->id_tenant);

        // Ambil data pesanan
        $completedOrders = $financialReportData['completedOrdersCount'];
        $uncompletedOrders = $financialReportData['uncompletedOrdersCount'];

        // Kirim data tenant dan data laporan keuangan ke tampilan
        return view('dashboard.home', [
            'tenant' => $tenant,
            'financialReportData' => $financialReportData,
            'completedOrders' => $completedOrders,
            'uncompletedOrders' => $uncompletedOrders
        ]);
    }
}
