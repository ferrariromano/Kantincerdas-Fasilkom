<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CekPesananController extends Controller
{
    public function showOrder($uid)
    {

        $tenantNames = [
            1 => "Left Canteen",
            2 => "Right Canteen"
        ];
        // Cek apakah user sudah melakukan pesanan
        $order = Order::where('uid', $uid)->with('orderProducts')->first();

        if ($order) {
            // Kelompokkan order items berdasarkan tenant
            $orderProductsGrouped = $order->orderProducts->groupBy('tenant_id');

            // Hitung subtotal dan waiting list untuk setiap tenant
            $subtotals = [];
            $quantities = [];
            $waitingLists = [];
            $statuses = [];

            foreach ($orderProductsGrouped as $tenantId => $items) {
                // Menghitung subtotal untuk tenant ini
                $subtotal = $items->sum(function ($item) {
                    return $item->quantity * $item->price;
                });
                $subtotals[$tenantId] = $subtotal;

                // Menghitung total item untuk tenant ini
                $quantity = $items->sum(function ($item) {
                    return $item->quantity;
                });
                $quantities[$tenantId] = $quantity;

                // Menghitung waiting list untuk tenant ini
                $waitingList = Order::whereHas('orderProducts', function($query) use ($tenantId) {
                        $query->where('tenant_id', $tenantId)
                              ->where('orderProductStatus', 'In Progress');
                    })
                    ->where('created_at', '<', $order->created_at)
                    ->count();
                $waitingLists[$tenantId] = $waitingList;

                // Kalkulasi status pesanan
                $allInProgress = $items->every(function ($item) {
                    return $item->isInProgress();
                });
                $allCompleted = $items->every(function ($item) {
                    return $item->isCompleted();
                });

                if ($allInProgress) {
                    $statuses[$tenantId] = strtolower(OrderProduct::STATUS_IN_PROGRESS);
                } elseif ($allCompleted) {
                    $statuses[$tenantId] = strtolower(OrderProduct::STATUS_COMPLETED);
                } else {
                    $statuses[$tenantId] = strtolower(OrderProduct::STATUS_PENDING);
                }
            }

            // Mengirim data ke view cek-pesanan
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
                'orderPayment' => $order->orderPayment
            ]);
        }

        // Jika user belum memesan, hitung waiting list untuk semua tenant
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

        // Mengirim data ke view cek-pesanan-empty
        return view('cekPesanan.default', [
            'active' => 'cekPesanan',
            'waitingLists' => $allWaitingLists,
            'tenantNames' => $tenantNames,
            'uid' => $uid,
        ]);
    }
}

