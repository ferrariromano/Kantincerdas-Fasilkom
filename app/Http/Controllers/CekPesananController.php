<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CekPesananController extends Controller
{
    public function showOrder($uid)
    {
        $tenantNames = [
            1 => "Left Canteen",
            2 => "Right Canteen"
        ];

        $this->deletePendingOrderProducts(); // Call this method before retrieving order data

        // Check if user has placed an order
        $order = Order::where('uid', $uid)->with('orderProducts')->first();

        if ($order) {
            // Group order items by tenant
            $orderProductsGrouped = $order->orderProducts->groupBy('tenant_id');

            // Calculate subtotal and waiting list for each tenant
            $subtotals = [];
            $quantities = [];
            $waitingLists = [];
            $statuses = [];
            $pendingProductsData = [];

            foreach ($orderProductsGrouped as $tenantId => $items) {
                // Calculate subtotal for this tenant
                $subtotal = $items->sum(function ($item) {
                    return $item->quantity * $item->price;
                });
                $subtotals[$tenantId] = $subtotal;

                // Calculate total items for this tenant
                $quantity = $items->sum(function ($item) {
                    return $item->quantity;
                });
                $quantities[$tenantId] = $quantity;

                // Calculate waiting list for this tenant
                $waitingList = Order::whereHas('orderProducts', function($query) use ($tenantId) {
                        $query->where('tenant_id', $tenantId)
                              ->where('orderProductStatus', 'In Progress');
                    })
                    ->where('created_at', '<', $order->created_at)
                    ->count();
                $waitingLists[$tenantId] = $waitingList;

                // Calculate order status
                $allInProgress = $items->every(function ($item) {
                    return $item->orderProductStatus == 'In Progress';
                });
                $allCompleted = $items->every(function ($item) {
                    return $item->orderProductStatus == 'Completed';
                });

                if ($allInProgress) {
                    $statuses[$tenantId] = 'in progress';
                } elseif ($allCompleted) {
                    $statuses[$tenantId] = 'completed';
                } else {
                    $statuses[$tenantId] = 'pending';
                }

                // Collect pending product data for countdown
                $pendingItem = $items->firstWhere('orderProductStatus', 'Pending');
                if ($pendingItem) {
                    $remainingTime = 30 * 60  - Carbon::now()->diffInSeconds($pendingItem->created_at);
                    $pendingProductsData[$tenantId] = [
                        'id' => $pendingItem->id,
                        'remainingTime' => $remainingTime > 0 ? $remainingTime : 0
                    ];
                }
            }

            // Send data to cek-pesanan view
            return view('cekPesanan.index', [
                'active' => 'cekPesanan',
                'order' => $order,
                'orderProductsGrouped' => $orderProductsGrouped,
                'subtotals' => $subtotals,
                'quantities' => $quantities,
                'waitingLists' => $waitingLists,
                'tenantNames' => $tenantNames,
                'statuses' => $statuses,
                'uid' => $uid,
                'orderName' => $order->orderName,
                'orderPhone' => $order->orderPhone,
                'orderPayment' => $order->orderPayment,
                'pendingProductsData' => $pendingProductsData
            ]);
        }

        // If user hasn't ordered, calculate waiting list for all tenants
        $allWaitingLists = Order::whereHas('orderProducts', function ($query) {
                $query->where('orderProductStatus', 'In Progress');
            })
            ->with('orderProducts')
            ->get()
            ->flatMap(function ($order) {
                return $order->orderProducts->where('orderProductStatus', 'In Progress');
            })
            ->groupBy('tenant_id')
            ->map(function ($items) {
                return $items->groupBy('order_id')->count();
            });

        // Send data to cek-pesanan-empty view
        return view('cekPesanan.default', [
            'active' => 'cekPesanan',
            'waitingLists' => $allWaitingLists,
            'tenantNames' => $tenantNames,
            'uid' => $uid,
        ]);
    }

    private function deletePendingOrderProducts()
    {
        // Get all order products with 'Pending' status older than 30 seconds
        $pendingProducts = OrderProduct::where('orderProductStatus', 'Pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(30))
            ->get();

        $orderIds = [];

        foreach ($pendingProducts as $product) {
            $orderIds[] = $product->order_id;
            $product->delete();
        }

        // Delete orders without related order products
        $emptyOrders = Order::whereDoesntHave('orderProducts')->whereIn('id', $orderIds)->get();

        foreach ($emptyOrders as $order) {
            $order->delete();
        }
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if ($order && $order->orderProducts->every(function ($product) {
            return $product->orderProductStatus == 'Pending';
        })) {
            $order->orderProducts()->delete();
            $order->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Pesanan tidak dapat dibatalkan.']);
    }

}
