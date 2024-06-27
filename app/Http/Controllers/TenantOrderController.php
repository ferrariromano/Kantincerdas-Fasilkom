<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TenantOrderController extends Controller
{
    public function index(Request $request)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        // Ambil nilai dari select box statusFilter
        $selectedStatus = $request->input('statusFilter', 'all');

        // Fetch orders and apply the status filter
        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }]);

        // Apply the status filter if selectedStatus is not 'all'
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

            $allCompleted = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Completed';
            });

            $allPending = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Pending';
            });

            $allCancelled = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Cancelled';
            });

            $hasInProgress = $orderProducts->contains(function ($item) {
                return $item->orderProductStatus === 'In Progress';
            });

            if ($allCompleted) {
                $statuses[$order->id] = 'Completed';
                $order->orderStatus = 'Completed'; // Update orderStatus
            } elseif ($allPending || $allCancelled) {
                $statuses[$order->id] = 'Uncompleted';
                $order->orderStatus = 'Uncompleted'; // Update orderStatus
            } elseif ($hasInProgress) {
                $statuses[$order->id] = 'In Progress';
                $order->orderStatus = 'In Progress'; // Update orderStatus
            } else {
                $statuses[$order->id] = 'In Progress';
                $order->orderStatus = 'In Progress'; // Update orderStatus
            }

            $order->save(); // Save the updated orderStatus
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

        $orderProducts = OrderProduct::where('tenant_id', $tenantId)
            ->with(['order', 'product'])
            ->get();

        $orders = Order::whereHas('orderProducts', function ($query) use ($tenantId) {
            $query->where('tenant_id', $tenantId);
        })->with(['orderProducts' => function ($query) use ($tenantId) {
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
        // Validate order data
        $validatedData = $request->validate([
            'orderProductStatus.*' => 'required|string|in:Pending,Completed,Canceled,In Progress',
        ]);

        $order = Order::with('orderProducts')->findOrFail($id);

        // Update each order product status
        foreach ($order->orderProducts as $item) {
            if (isset($validatedData['orderProductStatus'][$item->id])) {
                $item->orderProductStatus = $validatedData['orderProductStatus'][$item->id];
                $item->save();
            }
        }

        // Recalculate order status
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

    public function markInProgress($id)
    {
        $order = Order::with('orderProducts')->find($id);
        if (!$order) {
            return redirect()->route('tenantOrders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Update status for all order products
        foreach ($order->orderProducts as $item) {
            $item->orderProductStatus = 'In Progress';
            $item->save();
        }

        // Recalculate order status
        $this->recalculateOrderStatus($order);

        return redirect()->route('tenantOrders.show', $id)->with('success', 'Status pesanan dan item berhasil diperbarui.');
    }

    private function recalculateOrderStatus($order)
    {
        $allCompleted = true;

        foreach ($order->orderProducts as $item) {
            if ($item->orderProductStatus !== 'Completed') {
                $allCompleted = false;
                break;
            }
        }

        if ($allCompleted) {
            $order->orderStatus = 'Completed';
        } else {
            $order->orderStatus = 'Uncompleted';
        }

        $order->save();
    }


    public function inProgress(Request $request)
    {
        $tenant = Auth::guard('tenant')->user();
        $tenantId = $tenant->id_tenant;

        // Fetch orders with status 'In Progress'
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

            $allCompleted = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Completed';
            });

            $allPending = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Pending';
            });

            $allCancelled = $orderProducts->every(function ($item) {
                return $item->orderProductStatus === 'Cancelled';
            });

            $hasInProgress = $orderProducts->contains(function ($item) {
                return $item->orderProductStatus === 'In Progress';
            });

            if ($allCompleted) {
                $statuses[$order->id] = 'Completed';
                $order->orderStatus = 'Completed'; // Update orderStatus
            } elseif ($allPending || $allCancelled) {
                $statuses[$order->id] = 'Uncompleted';
                $order->orderStatus = 'Uncompleted'; // Update orderStatus
            } elseif ($hasInProgress) {
                $statuses[$order->id] = 'In Progress';
                $order->orderStatus = 'In Progress'; // Update orderStatus
            } else {
                $statuses[$order->id] = 'In Progress';
                $order->orderStatus = 'In Progress'; // Update orderStatus
            }

            $order->save(); // Save the updated orderStatus
        }

        return view('tenantOrders.inProgress', compact('orders', 'subtotals', 'statuses'));
    }

}
