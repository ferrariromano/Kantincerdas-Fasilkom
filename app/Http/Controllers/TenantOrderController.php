<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\OrderUpdated;


class TenantOrderController extends Controller
{
    public function index(Request $request)
    {
        // Panggil metode untuk menghapus order products yang pending
        $this->deletePendingOrderProducts();

        // Ambil tenant yang sedang login
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        // Ambil orders yang terkait dengan tenant yang sedang login
        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])->paginate(10);

        // Transformasi data untuk menghitung subtotal dan status
        $orders->transform(function ($order) {
            $orderProducts = $order->orderProducts;
            $order->subtotal = $orderProducts->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $order->status = $this->calculateOrderStatus($order);
            return $order;
        });

        // Kirim data ke view
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

        $orderTotalAmounts = $order->orderTotalAmounts;

        foreach ($order->orderProducts as $item) {
            if (isset($validatedData['orderProductStatus'][$item->id])) {
                if ($validatedData['orderProductStatus'][$item->id] === 'Cancelled') {
                    // Kurangi total order amount dengan harga produk yang dibatalkan
                    $orderTotalAmounts -= $item->quantity * $item->price;
                    $item->delete();
                } else {
                    $item->orderProductStatus = $validatedData['orderProductStatus'][$item->id];
                    $item->save();
                }
            }
        }

        // Perbarui total amount order
        $order->orderTotalAmounts = $orderTotalAmounts;
        $order->save();

        // Setelah menangani pembaruan dan penghapusan, hitung ulang status order
        $this->recalculateOrderStatus($order);

        // Jika order tidak memiliki produk lagi setelah penghapusan, hapus order itu sendiri
        if ($order->orderProducts()->count() == 0) {
            $order->delete();
        }

        // Trigger the OrderUpdated event
        event(new OrderUpdated($order));

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

        // Fetch orders with 'In Progress' status and order them by 'updated_at'
        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId)
                  ->where('orderProductStatus', 'In Progress');
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }])
        ->orderBy('updated_at', 'asc') // Urutkan berdasarkan 'updated_at'
        ->paginate(10);

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

    private function deletePendingOrderProducts()
    {
        // Ambil semua produk order yang statusnya Pending lebih dari 30 detik
        $pendingProducts = OrderProduct::where('orderProductStatus', 'Pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(5))
            ->get();

        $orderIds = [];

        foreach ($pendingProducts as $product) {
            $orderIds[] = $product->order_id;
            $product->delete();
        }

        // Hapus order yang tidak memiliki produk order terkait
        $emptyOrders = Order::whereDoesntHave('orderProducts')->whereIn('id', $orderIds)->get();

        foreach ($emptyOrders as $order) {
            $order->delete();
        }
    }
}
