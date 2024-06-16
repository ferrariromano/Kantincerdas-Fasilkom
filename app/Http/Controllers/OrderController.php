<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function submitOrder(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order-name' => 'required|string|max:255',
            'order-phone' => 'required|string|max:255',
            'order-payment' => 'required|string|in:tunai,non-tunai',
            'additional' => 'nullable|string',
            'order-items' => 'required|string',
            'orderTotalAmounts' => 'required|numeric',
            'uid' => 'required|string'
        ]);

        $uid = $request->input('uid');

        // Check if the user has pending orders
        if (Order::hasPendingOrders($uid)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda masih memiliki pesanan yang belum selesai.'
            ], 400);
        }

        // Create the order
        $order = new Order();
        $order->uid = $uid;
        $order->orderName = $validatedData['order-name'];
        $order->orderPhone = $validatedData['order-phone'];
        $order->orderNotes = $validatedData['additional'];
        $order->orderTotalAmounts = $validatedData['orderTotalAmounts'];
        $order->orderStatus = 'Pending';
        $order->orderPayment = $validatedData['order-payment'];
        $order->save();

        // Get the order items from the request
        $orderItems = json_decode($validatedData['order-items'], true);

        // Create order items
        foreach ($orderItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->tenant_id = $item['tenant_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->orderStatus = 'Pending';
            $orderItem->save();
        }

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Pemesanan Berhasil',
            'uid' => $uid
        ]);
    }

}
