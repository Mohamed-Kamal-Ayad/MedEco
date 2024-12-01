<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pharmacy\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Phar;

class OrderController extends Controller
{
    /**
     * Get all orders.
     */
    public function getAllOrders()
    {
        $orders = Order::with('items')->get();
        return OrderResource::collection($orders);
    }

    /**
     * Get a specific order by ID.
     */
    public function getOrderById(Order $order)
    {
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return OrderResource::make($order->load('items'));
    }

    /**
     * Mark an order as completed.
     */
    public function markOrderAsCompleted(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validated = $request->validate([
            'is_completed' => 'required|boolean',
            'notes' => 'nullable|string',
        ]);

        $order->update([
            'is_completed' => $validated['is_completed'],
            'notes' => $validated['notes'] ?? $order->notes,
        ]);

        return response()->json(['message' => 'Order marked as completed successfully.'], 200);
    }

    /**
     * Cancel an order.
     */
    public function cancelOrder($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order canceled successfully.'], 200);
    }
}
