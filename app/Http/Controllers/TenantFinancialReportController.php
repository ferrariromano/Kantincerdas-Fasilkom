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

        // Get the financial report data for the authenticated tenant
        $financialReportData = $this->getFinancialReportData($tenantId);

        // Return the view with the financial report data
        return view('tenantFinancialReport.index', compact('financialReportData'));
    }

    public function getFinancialReportData($tenantId)
    {
        // Fetch all orders for the current tenant with orderProducts relation
        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->get();

        $totalRevenue = 0;
        $completedOrdersCount = 0;
        $inProgressOrdersCount = 0;
        $cancelledOrdersCount = 0;
        $pendingOrdersCount = 0;
        $shippingOrdersCount = 0;
        $deliveredOrdersCount = 0;
        $totalOrdersCount = $orders->count();

        foreach ($orders as $order) {
            $orderProducts = $order->orderProducts;
            $subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            $totalRevenue += $subtotal;

            switch ($order->orderStatus) {
                case 'Completed':
                    $completedOrdersCount++;
                    $deliveredOrdersCount++;
                    break;
                case 'In Progress':
                    $inProgressOrdersCount++;
                    break;
                case 'Cancelled':
                    $cancelledOrdersCount++;
                    break;
                case 'Pending':
                    $pendingOrdersCount++;
                    break;
                case 'Shipping':
                    $shippingOrdersCount++;
                    break;
            }
        }

        // Return an array containing the financial report data
        return [
            'totalRevenue' => $totalRevenue,
            'totalOrdersCount' => $totalOrdersCount,
            'completedOrdersCount' => $completedOrdersCount,
            'inProgressOrdersCount' => $inProgressOrdersCount,
            'cancelledOrdersCount' => $cancelledOrdersCount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'shippingOrdersCount' => $shippingOrdersCount,
            'deliveredOrdersCount' => $deliveredOrdersCount,
        ];
    }
}
