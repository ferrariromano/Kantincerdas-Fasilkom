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

        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }]);

        $orders = $orders->paginate(10);

        $orders->transform(function ($order) {
            $orderProducts = $order->orderProducts;
            $order->subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $order->status = $this->calculateOrderStatus($order);
            return $order;
        });

        return view('tenantOrders.index', [
            'orders' => $orders,
            'subtotals' => $orders->pluck('subtotal', 'id'),
            'statuses' => $orders->pluck('status', 'id'),
        ]);
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

        $order->subtotal = $order->orderProducts->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('tenantOrders.edit', [
            'order' => $order,
            'orderProducts' => $order->orderProducts,
            'subtotals' => [$order->id => $order->subtotal]
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'orderProductStatus.*' => 'required|string|in:Pending,Completed,Cancelled,In Progress',
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
        $order->load('orderProducts');
        $order->orderStatus = $this->calculateOrderStatus($order);
        $order->save();
    }

    private function calculateOrderStatus($order)
    {
        $allCompleted = $order->orderProducts->every(function ($item) {
            return $item->orderProductStatus === 'Completed';
        });

        return $allCompleted ? 'Completed' : 'Uncompleted';
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

        $orders->transform(function ($order) {
            $orderProducts = $order->orderProducts;
            $order->subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $order->status = $this->calculateOrderStatus($order);
            return $order;
        });

        return view('tenantOrders.inProgress', [
            'orders' => $orders,
            'subtotals' => $orders->pluck('subtotal', 'id'),
            'statuses' => $orders->pluck('status', 'id'),
        ]);
    }

    public function completed(Request $request)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)->where('orderProductStatus', 'Completed');
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->paginate(10);

        $orders->transform(function ($order) {
            $orderProducts = $order->orderProducts;
            $order->subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $order->status = $this->calculateOrderStatus($order);
            return $order;
        });

        return view('tenantOrders.completed', [
            'orders' => $orders,
            'subtotals' => $orders->pluck('subtotal', 'id'),
            'statuses' => $orders->pluck('status', 'id'),
        ]);
    }
}
