<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TenantOrderController extends Controller
{
    public function index()
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $orders = Order::whereHas('orderProducts', function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function($query) use ($tenantId) {
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

            $allCompleted = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Completed';
            });

            if ($allCompleted) {
                $statuses[$order->id] = 'Completed';
            } else {
                $statuses[$order->id] = 'Uncompleted';
            }
        }

        // dd($subtotals);
        // dd($orders);
        return view('tenantOrders.index', compact('orders', 'subtotals', 'statuses'));

    }

    public function show($id)
    {
        // Get a specific order by ID
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

        $orderProducts = OrderProduct::where('tenant_id', $tenantId)
        ->with(['order', 'product'])
        ->get();

        $orders = Order::whereHas('orderProducts', function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->get();

        $subtotals = [];

        foreach ($orders as $order) {
            $orderProducts = $order->orderProducts;
            $subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $subtotals[$order->id] = $subtotal;
        }

        $order = Order::with('orderProducts')->find($id);

        return view('tenantOrders.edit', compact('order', 'orderProducts', 'subtotals'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data pesanan
        $validatedData = $request->validate([
            'orderStatus.*' => 'required|string|in:UnCompleted, Completed',
            'orderProductStatus.*' => 'required|string|in:Pending,Completed,Canceled,In Progress',
        ]);

        $order = Order::with('orderProducts')->findOrFail($id);

        $allCompleted = true;

        foreach ($order->orderProducts as $item) {
            if (isset($validatedData['orderProductStatus'][$item->id])) {
                $item->orderProductStatus = $validatedData['orderProductStatus'][$item->id];
                $item->update();

                if ($item->orderProductStatus !== 'Completed') {
                    $allCompleted = false;
                }
            }
        }

        $tenantId = $order->orderProducts->first()->tenant_id;
        if ($allCompleted) {
            Order::whereHas('orderProducts', function ($query) use ($tenantId) {
                $query->where('tenant_id', $tenantId);
            })->update(['orderStatus' => 'Completed']);
        } else {
            Order::whereHas('orderProducts', function ($query) use ($tenantId) {
                $query->where('tenant_id', $tenantId);
            })->update(['orderStatus' => 'Uncompleted']);
        }

        return redirect()->route('tenantOrders.index')->with('success', 'Pesanan dan item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Find the order by ID
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Delete the order
        $order->delete();

        return redirect()->route('tenantOrders.index')->with('success', 'Pesanan berhasil dihapus.');
    }


    public function markInProgress($id)
    {
        $order = Order::with('orderProducts')->find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ubah status semua item pesanan
        foreach ($order->orderProducts as $item) {
            $item->orderStatus = OrderProduct::STATUS_IN_PROGRESS;
            $item->save();
        }

        // Kalkulasi ulang status pesanan
        $order->calculateStatus();

        return redirect()->route('tenantOrders.show', $id)->with('success', 'Status pesanan dan item berhasil diperbarui.');
    }
}
