<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\TenantFinancialReportController;

class TenantDashboardController extends Controller
{
    public function dashboard($dashboard)
    {
        // Find the tenant based on the name
        $tenant = Tenant::where('nama_tenant', $dashboard)->firstOrFail();

        // Create an instance of TenantFinancialReportController
        $financialReportController = new TenantFinancialReportController();

        // Get the financial report data for the tenant
        $financialReportData = $financialReportController->getFinancialReportData($tenant->id);

        // Send tenant data and financial report data to the view
        return view('dashboard.home', [
            'tenant' => $tenant,
            'financialReportData' => $financialReportData
        ]);
    }
}
