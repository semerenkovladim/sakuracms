<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function index() {
        $promotions = Promotion::with('products')->get();

        return response()->json([
            $promotions
        ], 200);
    }

    public function show($id) {
        $promotion = Promotion::with('products')->find($id);

        return response()->json([
            $promotion
        ], 200);
    }

    public function create(Request $request) {
        $promotion = new Promotion();
        $promotion->title = $request->title;
        $promotion->before_product = $request->before_product;
        $promotion->after_product = $request->after_product;
        $promotion->sending_at = new Carbon($request->sending_at);
        foreach($request->products as $product) {
            $promotion->products()->attach($product);
        }
        $promotion->created_at = Carbon::now();
        $promotion->updated_at = Carbon::now();
        $promotion->save();

        return response()->json([], 200);

    }

    public function update($id, Request $request) {
        $promotion = Promotion::with('products')->get();
        $promotion->title = $request->title;
        $promotion->before_product = $request->before_product;
        $promotion->after_product = $request->after_product;
        $promotion->products()->detach();
        foreach($request->products as $product) {
            $promotion->products()->attach($product);
        }
        $promotion->sending_at = new Carbon($request->sending_at);
        $promotion->updated_at = Carbon::now();
        $promotion->save();

        return response()->json([], 200);
    }

    public function delete($id) {
        $promotion = Promotion::find($id);
        $promotion->delete();

        return response()->json([], 200);
    }
}
