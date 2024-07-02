<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        // Hitung jumlah pesanan pending dan in progress
        $pendingOrdersCount = $this->countOrdersByStatus($tenant->id_tenant, 'Pending');
        $inProgressOrdersCount = $this->countOrdersByStatus($tenant->id_tenant, 'In Progress');
        $CompletedOrdersCount = $this->countOrdersByStatus($tenant->id_tenant, 'Completed');

        // Kirim data tenant dan data laporan keuangan ke tampilan
        return view('dashboard.home', [
            'tenant' => $tenant,
            'financialReportData' => $financialReportData,
            'pendingOrdersCount' => $pendingOrdersCount,
            'inProgressOrdersCount' => $inProgressOrdersCount,
            'completedOrdersCount' => $CompletedOrdersCount
        ]);
    }

    private function countOrdersByStatus($tenantId, $status)
    {
        return Order::whereHas('orderProducts', function ($query) use ($tenantId, $status) {
            $query->where('tenant_id', $tenantId)
                  ->where('orderProductStatus', $status);
        })->count();
    }
}
