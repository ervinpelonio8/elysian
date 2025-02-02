<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.product_id' => 'required|exists:products,id',
            'orders.*.user_id' => 'required|exists:users,id',
            'orders.*.quantity' => 'required|integer|min:1',
        ]);

        \DB::beginTransaction();

        try {
            foreach ($request->orders as $orderData) {
                $product = Product::findOrFail($orderData['product_id']);
                if ($product->quantity < $orderData['quantity']) {
                    return response()->json([
                        'error' => 'Insufficient stock for product '
                            . $product->name
                    ], 400);
                }

                Order::create([
                    'user_id' => $orderData['user_id'],
                    'product_id' => $orderData['product_id'],
                    'quantity' => $orderData['quantity'],
                ]);

                $product->quantity -= $orderData['quantity'];

                $product->sold_count += $orderData['quantity'];
                $product->save();
            }

            Cart::where('user_id', $request->orders[0]['user_id'])->delete();

            \DB::commit();

            return response()->json(['message' => 'Order successfully created'], 201);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            \DB::rollBack();

            // Return the error message
            return response()->json(['error' => 'Failed to create order: ' . $e->getMessage()], 500);
        }
    }
}
