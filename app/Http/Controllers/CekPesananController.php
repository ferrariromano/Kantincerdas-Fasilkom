<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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
        $order = Order::where('uid', $uid)->with('orderItems')->first();

        if ($order) {
            // Kelompokkan order items berdasarkan tenant
            $orderItemsGrouped = $order->orderItems->groupBy('tenant_id');

            // Hitung subtotal dan waiting list untuk setiap tenant
            $subtotals = [];
            $quantities = [];
            $waitingLists = [];
            foreach ($orderItemsGrouped as $tenantId => $items) {
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
                $waitingList = Order::whereHas('orderItems', function($query) use ($tenantId) {
                        $query->where('tenant_id', $tenantId)
                              ->where('orderStatus', 'In Progress');
                    })
                    ->where('created_at', '<', $order->created_at)
                    ->count();
                $waitingLists[$tenantId] = $waitingList;
            }

            // Mengirim data ke view cek-pesanan
            return view('cekPesanan.index', [
                'active' => 'cekPesanan',
                'order' => $order,
                'orderItemsGrouped' => $orderItemsGrouped,
                'subtotals' => $subtotals,
                'quantities' => $quantities,
                'waitingLists' => $waitingLists,
                'tenantNames' => $tenantNames,
                'uid' => $uid,
                'orderName' => $order->orderName,
                'orderPhone' => $order->orderPhone,
                'orderPayment' => $order->orderPayment
            ]);
        }

        // Jika user belum memesan, hitung waiting list untuk semua tenant
        $allWaitingLists = Order::whereHas('orderItems', function ($query) {
                $query->where('orderStatus', 'In Progress');
            })
            ->with('orderItems')
            ->get()
            ->flatMap(function ($order) {
                return $order->orderItems->where('orderStatus', 'In Progress');
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

