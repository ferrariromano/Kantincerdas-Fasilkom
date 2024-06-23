<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        // Find the order by ID
        $order = Order::with('orderProducts')->find($validatedData['order_id']);

        // Check if order exists and payment method is non-cash
        if (!$order || $order->orderPayment !== 'non-tunai') {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan atau metode pembayaran bukan non-tunai.'
            ], 400);
        }

        // Configure Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
        Log::info('Midtrans configured.');

        // Prepare transaction details
        $transaction_details = [
            'order_id' => $order->id,
            'gross_amount' => $order->orderTotalAmounts,
        ];
        Log::info('Transaction details prepared.', ['transaction_details' => $transaction_details]);

        // Prepare item details
        $item_details = [];
        foreach ($order->orderProducts as $item) {
            $item_details[] = [
                'id' => $item->product_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => 'Item ' . $item->product_id
            ];
        }
        Log::info('Item details prepared.', ['item_details' => $item_details]);

        // Prepare customer details
        $customer_details = [
            'first_name' => $order->orderName,
            'phone' => $order->orderPhone,
        ];
        Log::info('Customer details prepared.', ['customer_details' => $customer_details]);

        // Prepare parameters for Snap API
        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];
        Log::info('Params for Snap API prepared.', ['params' => $params]);

        try {
            // Get Snap Token
            $snapToken = Snap::getSnapToken($params);
            Log::info('Midtrans Snap Token obtained.', ['snap_token' => $snapToken]);

            return response()->json([
                'success' => true,
                'message' => 'Token berhasil diperoleh',
                'snap_token' => $snapToken,
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
