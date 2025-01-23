<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::with('items.meal')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'customer_name' => 'required|string',
            'delivery_fee' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'taxes' => 'required|numeric',
            'location' => 'required|string',
            'notes' => 'nullable|string',
            'voucher' => 'nullable|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.meal_id' => 'required|exists:meals,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        $orderData = [
            'restaurant_id' => $validated['restaurant_id'],
            'customer_name' => $validated['customer_name'],
            'delivery_fee' => $validated['delivery_fee'],
            'total_amount' => $validated['total_amount'],
            'taxes' => $validated['taxes'],
            'location' => $validated['location'],
            'notes' => $validated['notes'],
            'voucher' => $validated['voucher'],
            'payment_method' => $validated['payment_method'],
        ];
    
        $order = Order::create($orderData);
    
        foreach ($validated['items'] as $item) {
            $order->items()->create($item);
        }
    
        return response()->json($order->load('items.meal'), 201);
    }
    
    public function show($id)
    {
        return response()->json(Order::with('items.meal')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'delivery_fee' => 'nullable|numeric',
            'taxes' => 'nullable|numeric',
            'location' => 'nullable|string',
            'notes' => 'nullable|string',
            'voucher' => 'nullable|string',
            'payment_method' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return response()->json($order->load('items.meal'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
