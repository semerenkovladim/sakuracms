<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function all() {
        $products = Product::with(['category', 'images'])->get();

        return response()->json([
            $products
        ], 200);
    }

    public function delete($id) {
        $product  = Product::find($id);
        $product->delete();
        return response()->json([], 200);
    }
}
