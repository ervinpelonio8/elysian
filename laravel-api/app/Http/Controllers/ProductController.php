<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request->file('image'));
        }

        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'sold_count' => 0,
                'image' => $imagePath,
            ]);

            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function uploadImage($image)
    {
        try {
            return $image->store('images/products', 'public');
        } catch (\Exception $e) {
            throw new \Exception("Error uploading image: " . $e->getMessage());
        }
    }

    public function get_all(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 items per page
        $products = Product::paginate($perPage);
        return response()->json($products);
    }

    public function get_one($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
}
