<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'order_qty' => [
                'required',
                'integer',
                'min:1',
                'max:' . Product::find($request->product_id)->quantity,
            ],
        ]);

        $existingCartItem = Cart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->order_qty += $request->order_qty;
            $existingCartItem->order_qty = min($existingCartItem->order_qty, Product::find($request->product_id)->quantity);
            $existingCartItem->save();

            return response()->json(['message' => 'Product quantity updated in cart', 'cart' => $existingCartItem], 200);
        }

        $cartItem = Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'order_qty' => $request->order_qty
        ]);

        return response()->json(['message' => 'Added to cart', 'cart' => $cartItem], 201);
    }

    public function get_all($user_id)
    {
        $user = \App\Models\User::find($user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $cartItems = Cart::where('user_id', $user_id)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.quantity as stock',
                'products.image',
                'carts.order_qty'
            )
            ->get();

        return response()->json($cartItems);
    }


    public function remove_one(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $cartItem = Cart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }
}
