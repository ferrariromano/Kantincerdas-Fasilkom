<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TenantOrderController extends Controller
{
    public function index()
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $orders = Order::whereHas('orderItems', function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderItems' => function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->paginate(10);

        $subtotals = [];

        foreach ($orders as $order) {
            $orderItems = $order->orderItems;
            $subtotal = $orderItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $subtotals[$order->id] = $subtotal;
        }

        // dd($subtotals);
        // dd($orders);
        return view('tenantOrders.index', compact('orders', 'subtotals'));

    }

    public function show($id)
    {
        // Get a specific order by ID
        $order = Order::with('orderItems')->find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }
        return view('tenantOrders.show', compact('order'));
    }

    public function edit($id)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        $orderItems = OrderItem::where('tenant_id', $tenantId)
        ->with(['order', 'product'])
        ->get();

        $orders = Order::whereHas('orderItems', function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderItems' => function($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->get();

        $subtotals = [];

        foreach ($orders as $order) {
            $orderItems = $order->orderItems;
            $subtotal = $orderItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $subtotals[$order->id] = $subtotal;
        }

        $order = Order::with('orderItems')->find($id);

        return view('tenantOrders.edit', compact('order', 'orderItems', 'subtotals'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data pesanan
        $validatedData = $request->validate([
            'order-name' => 'required|string|max:255',
            'order-phone' => 'required|string|max:255',
            'order-payment' => 'required|string|in:tunai,non-tunai',
            'additional' => 'nullable|string',
            'orderTotalAmounts' => 'required|numeric',
            'orderStatus' => 'required|string|in:Pending,Completed,Canceled,In Progress',
            'itemStatus.*' => 'required|string|in:Pending,Completed,Canceled,In Progress'
        ]);

        // Cari pesanan berdasarkan ID
        $order = Order::with('orderItems')->find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Perbarui informasi pesanan
        $order->orderName = $validatedData['order-name'];
        $order->orderPhone = $validatedData['order-phone'];
        $order->orderNotes = $validatedData['additional'];
        $order->orderTotalAmounts = $validatedData['orderTotalAmounts'];
        $order->orderStatus = $validatedData['orderStatus'];
        $order->save();

        // Perbarui status item-item pesanan
        foreach ($order->orderItems as $item) {
            if (isset($validatedData['itemStatus'][$item->id])) {
                $item->orderStatus = $validatedData['itemStatus'][$item->id];
                // if ($item->orderStatus == OrderItem::STATUS_CANCELED) {
                //     $item->delete();
                // } else {
                //     $item->save();
                // }
            }
        }

        // Kalkulasi ulang status pesanan
        $order->calculateStatus();

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
        $order = Order::with('orderItems')->find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ubah status semua item pesanan
        foreach ($order->orderItems as $item) {
            $item->orderStatus = OrderItem::STATUS_IN_PROGRESS;
            $item->save();
        }

        // Kalkulasi ulang status pesanan
        $order->calculateStatus();

        return redirect()->route('tenantOrders.show', $id)->with('success', 'Status pesanan dan item berhasil diperbarui.');
    }

    // public function markItemAsCanceled($orderId, $itemId)
    // {
    //     $orderItem = OrderItem::find($itemId);
    //     if (!$orderItem) {
    //         return redirect()->route('tenantOrders.show', $orderId)->with('error', 'Item pesanan tidak ditemukan.');
    //     }

    //     // Ubah status item pesanan menjadi Canceled dan hapus
    //     $orderItem->orderStatus = OrderItem::STATUS_CANCELED;
    //     $orderItem->delete();

    //     // Kalkulasi ulang status pesanan
    //     $order = Order::find($orderId);
    //     $order->calculateStatus();

    //     return redirect()->route('tenantOrders.show', $orderId)->with('success', 'Status item pesanan berhasil diubah menjadi Canceled dan dihapus.');
    // }
}
