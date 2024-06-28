<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TenantOrderController extends Controller
{
    public function index(Request $request)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $selectedStatus = $request->input('statusFilter', 'all');

        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }]);

        if ($selectedStatus !== 'all') {
            $orders = $orders->whereHas('orderProducts', function ($query) use ($selectedStatus) {
                $query->where('orderProductStatus', $selectedStatus);
            });
        }

        $orders = $orders->paginate(10);

        $subtotals = [];
        $statuses = [];

        foreach ($orders as $order) {
            $orderProducts = $order->orderProducts;
            $subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $subtotals[$order->id] = $subtotal;

            $statuses[$order->id] = $this->calculateOrderStatus($order);

            $order->save();
        }

        return view('tenantOrders.index', compact('orders', 'subtotals', 'statuses', 'selectedStatus'));
    }

    public function show($id)
    {
        $order = Order::with('orderProducts')->find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }
        return view('tenantOrders.show', compact('order'));
    }

    public function edit($id)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $order = Order::where('id', $id)
            ->with(['orderProducts' => function ($query) use ($tenantId) {
                $query->where('tenant_id', $tenantId);
            }])
            ->firstOrFail();

        $subtotals = [];
        $orderProducts = $order->orderProducts;
        $subtotal = $orderProducts->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        $subtotals[$order->id] = $subtotal;

        return view('tenantOrders.edit', compact('order', 'orderProducts', 'subtotals'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'orderProductStatus.*' => 'required|string|in:Pending,Completed,Canceled,In Progress',
        ]);

        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $order = Order::where('id', $id)
            ->with(['orderProducts' => function ($query) use ($tenantId) {
                $query->where('tenant_id', $tenantId);
            }])
            ->firstOrFail();

        foreach ($order->orderProducts as $item) {
            if (isset($validatedData['orderProductStatus'][$item->id])) {
                $item->orderProductStatus = $validatedData['orderProductStatus'][$item->id];
                $item->save();
            }
        }

        $this->recalculateOrderStatus($order);

        return redirect()->route('tenantOrders.index')->with('success', 'Pesanan dan item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        $order->delete();

        return redirect()->route('tenantOrders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    private function recalculateOrderStatus($order)
    {
        // Ensure we consider all order products for the given order
        $order->load('orderProducts');
        $order->orderStatus = $this->calculateOrderStatus($order);
        $order->save();
    }

    private function calculateOrderStatus($order)
    {
        // Check if all order products are completed
        $allCompleted = $order->orderProducts->every(function ($item) {
            return $item->orderProductStatus === 'Completed';
        });

        if ($allCompleted) {
            return 'Completed';
        }

        return 'Uncompleted';
    }

    public function inProgress(Request $request)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)->where('orderProductStatus', 'In Progress');
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->paginate(10);

        $subtotals = [];
        $statuses = [];

        foreach ($orders as $order) {
            $orderProducts = $order->orderProducts;
            $subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $subtotals[$order->id] = $subtotal;

            $statuses[$order->id] = $this->calculateOrderStatus($order);

            $order->save();
        }

        return view('tenantOrders.inProgress', compact('orders', 'subtotals', 'statuses'));
    }
}


