<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TenantFinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $singleDate = $request->input('single_date');
        $dateRange = $request->input('date_range');
        $startDate = null;
        $endDate = null;

        if ($singleDate) {
            $startDate = \Carbon\Carbon::parse($singleDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($singleDate)->endOfDay();
        } elseif ($dateRange) {
            $dates = explode(' to ', $dateRange);
            $startDate = isset($dates[0]) ? \Carbon\Carbon::parse($dates[0])->startOfDay() : null;
            $endDate = isset($dates[1]) ? \Carbon\Carbon::parse($dates[1])->endOfDay() : $startDate;
        }

        // Get the financial report data for the authenticated tenant
        $financialReportData = $this->getFinancialReportData($tenantId, $startDate, $endDate);

        // Fetch all completed orders for the current tenant with orderProducts relation
        $ordersQuery = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)
                  ->where('orderProductStatus', 'Completed');
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)
                  ->where('orderProductStatus', 'Completed');
        }]);

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $orders = $ordersQuery->get();

        $statuses = $orders->pluck('orderStatus', 'id');
        $subtotals = $orders->mapWithKeys(function ($order) {
            $subtotal = $order->orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            return [$order->id => $subtotal];
        });

        // Return the view with the financial report data and orders
        return view('tenantFinancialReport.index', compact('financialReportData', 'orders', 'statuses', 'subtotals'));
    }

    public function getFinancialReportData($tenantId, $startDate = null, $endDate = null)
    {
        // Fetch all completed orders for the current tenant with orderProducts relation
        $ordersQuery = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)
                  ->where('orderProductStatus', 'Completed');
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)
                  ->where('orderProductStatus', 'Completed');
        }]);

        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $orders = $ordersQuery->get();

        $totalRevenue = 0;
        $totalOrdersCount = $orders->count();

        $monthlyOrders = array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0);

        foreach ($orders as $order) {
            $orderProducts = $order->orderProducts;
            $subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            $totalRevenue += $subtotal;

            $month = $order->created_at->format('M');
            $monthlyOrders[$month] += $subtotal;
        }

        // Return an array containing the financial report data
        return [
            'totalRevenue' => $totalRevenue,
            'totalOrdersCount' => $totalOrdersCount,
            'completedOrdersCount' => $totalOrdersCount,  // Semua order yang diambil adalah yang "Completed"
            'monthlyOrders' => array_values($monthlyOrders),
        ];
    }
}
