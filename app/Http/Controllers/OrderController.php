<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        try {
            // Log incoming request data
            Log::info('Request Data: ', $request->all());

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
            $email = $request->input('email', 'default@example.com'); // Provide a default email if not available

            // Log the raw order items
            Log::info('Order Items (Raw): ' . $validatedData['order-items']);

            // Decode order items
            $orderItems = json_decode($validatedData['order-items'], true);

            // Log the decoded order items
            Log::info('Decoded Order Items: ', $orderItems);

            // Ensure orderItems is an array
            if (!is_array($orderItems)) {
                throw new \Exception('Order items are not in the expected format.');
            }

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
            $order->orderStatus = 'Uncompleted';
            $order->orderPayment = $validatedData['order-payment'];
            $order->save();

            // Create order items
            foreach ($orderItems as $index => $item) {
                // Log each item being processed
                Log::info('Processing Item: ', $item);

                // Check for required keys and log if they are missing
                if (!isset($item['product_id'])) {
                    Log::error("Missing key 'product_id' in order item at index $index: ", $item);
                    throw new \Exception("Missing key 'product_id' in order item at index $index");
                }
                if (!isset($item['tenant_id'])) {
                    Log::error("Missing key 'tenant_id' in order item at index $index: ", $item);
                    throw new \Exception("Missing key 'tenant_id' in order item at index $index");
                }
                if (!isset($item['quantity'])) {
                    Log::error("Missing key 'quantity' in order item at index $index: ", $item);
                    throw new \Exception("Missing key 'quantity' in order item at index $index");
                }
                if (!isset($item['price'])) {
                    Log::error("Missing key 'price' in order item at index $index: ", $item);
                    throw new \Exception("Missing key 'price' in order item at index $index");
                }

                $orderItem = new OrderProduct();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['product_id'];
                $orderItem->tenant_id = $item['tenant_id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price'];
                $orderItem->orderProductStatus = 'Pending';
                $orderItem->save();
            }

            // Create Midtrans transaction if the payment method is non-tunai
            if ($validatedData['order-payment'] == 'non-tunai') {
                \Midtrans\Config::$isProduction = false; // Set to false for sandbox mode

                // Use the provided server key
                \Midtrans\Config::$serverKey = 'SB-Mid-server-W_DOo24IdxdbLoiEBrhQl92y';
                $authString = base64_encode(\Midtrans\Config::$serverKey . ':'); // Midtrans uses basic auth with server key as the username and no password

                // Set the necessary headers
                $headers = [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . $authString,
                ];

                $params = [
                    'transaction_details' => [
                        'order_id' => uniqid(),
                        'gross_amount' => (int) $validatedData['orderTotalAmounts'],
                    ],
                    'customer_details' => [
                        'first_name' => $validatedData['order-name'],
                        'last_name' => '', // Ensure last_name is explicitly set
                        'email' => $email, // Provide a valid email
                        'phone' => $validatedData['order-phone'],
                    ],
                    'item_details' => array_map(function ($item) {
                        return [
                            'id' => $item['product_id'],
                            'price' => (int) $item['price'],
                            'quantity' => (int) $item['quantity'],
                            'name' => $item['name']
                        ];
                    }, $orderItems)
                ];

                // Log the parameters sent to Midtrans for debugging
                Log::info('Midtrans Params: ', $params);

                try {
                    $response = Http::withHeaders($headers)
                        ->withOptions([
                            'verify' => false, // Disable SSL verification for sandbox
                        ])
                        ->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

                    $responseBody = $response->json();

                    // Log the response from Midtrans
                    Log::info('Midtrans Response: ', $responseBody);

                    if ($response->successful() && isset($responseBody['token'])) {
                        // Update order products status to "In Progress"
                        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
                        foreach ($orderProducts as $orderProduct) {
                            $orderProduct->orderProductStatus = 'In Progress';
                            $orderProduct->save();
                        }

                        return response()->json([
                            'success' => true,
                            'message' => 'In Progress',
                            'uid' => $uid,
                            'snap_token' => $responseBody['token']
                        ]);
                    } else {
                        Log::error('Midtrans API Error: ', ['response' => $responseBody, 'status' => $response->status(), 'headers' => $response->headers()]);
                        return response()->json(['error' => 'Failed to retrieve Snap token from Midtrans.'], 500);
                    }
                } catch (\Exception $e) {
                    Log::error('Midtrans Error: ', ['error' => $e->getMessage()]);
                    return response()->json(['error' => $e->getMessage()], 500);
                }
            }

            // Return JSON response for tunai payment
            return response()->json([
                'success' => true,
                'message' => 'Pemesanan Berhasil',
                'uid' => $uid
            ]);
        } catch (\Exception $e) {
            Log::error('Order Submission Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
