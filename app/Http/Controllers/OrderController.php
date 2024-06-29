<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        Config::$curlOptions = array(
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        );
    }


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
        // Generate a new UID if there are completed orders with the same UID
        $completedOrders = Order::where('uid', $uid)->where('orderStatus', 'Completed')->exists();
        if ($completedOrders) {
            $uid = 'uid-' . uniqid();
        }

        // Create the order
        $order = new Order();
        $order->uid = $uid;
        $order->orderName = $validatedData['order-name'];
        $order->orderPhone = $validatedData['order-phone'];
        $order->orderNotes = $validatedData['additional'];
        $order->orderTotalAmounts = $validatedData['orderTotalAmounts'];
        $order->orderStatus = 'Uncompleted';
        $order->orderPayment = $validatedData['order-payment'];
        $order->save();

        // Decode the order items
        $orderProducts = json_decode($validatedData['order-items'], true);

        // Check for JSON errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid order items JSON format',
                'error' => json_last_error_msg()
            ], 400);
        }

        // Log the order items for debugging
        Log::info('Order Items: ', ['orderProducts' => $orderProducts]);

        // Create order items
        foreach ($orderProducts as $item) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item['product_id'];
            $orderProduct->tenant_id = $item['tenant_id'];
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->price = $item['price'];
            $orderProduct->orderProductStatus = 'Pending';
            $orderProduct->save();
        }

        // Check if payment method is non-tunai
        if ($order->orderPayment === 'non-tunai') {
            // Create transaction details for Midtrans
            $transactionDetails = [
                'order_id' => $order->id,
                'gross_amount' => $order->orderTotalAmounts,
            ];

            // Create item details for Midtrans
            $itemDetails = [];
            foreach ($orderProducts as $item) {
                $itemDetails[] = [
                    'id' => $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'name' => 'Product ' . $item['product_id'],
                ];
            }

            // Log transaction details for debugging
            Log::info('Transaction Details: ', ['transactionDetails' => $transactionDetails]);
            Log::info('Item Details: ', ['itemDetails' => $itemDetails]);

            // Create customer details for Midtrans
            $customerDetails = [
                'first_name' => $order->orderName,
                'phone' => $order->orderPhone,
            ];

            // Log customer details for debugging
            Log::info('Customer Details: ', ['customerDetails' => $customerDetails]);

            // Create Midtrans Snap transaction
            $params = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
            ];

            // Log the parameters sent to Midtrans
            Log::info('Midtrans Parameters: ', ['params' => $params]);

            try {
                $snapToken = Snap::getSnapToken($params);
                Log::info('Midtrans Snap Token: ', ['snapToken' => $snapToken]);
            } catch (\Exception $e) {
                Log::error('Midtrans Snap Token Error: ', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to generate Midtrans Snap token.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            // Return JSON response with Snap token for non-tunai payment
            return response()->json([
                'success' => true,
                'message' => 'Pemesanan Berhasil',
                'uid' => $uid,
                'snap_token' => $snapToken,
            ]);
        }

        // Return JSON response for tunai payment
        return response()->json([
            'success' => true,
            'message' => 'Pemesanan Berhasil',
            'uid' => $uid
        ]);
    }
}
