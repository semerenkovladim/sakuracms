<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Promotion\DeletePromotionRequest;
use App\Http\Requests\Promotion\StorePromotionRequest;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function index() {
        return PromotionResource::collection(Promotion::with('products')->get());
    }

    public function create(StorePromotionRequest $request) {
        $validate = $request->validated();

        $promotion = new Promotion();
        $promotion->title = $request->title;
        $promotion->before_product = $request->before_product;
        $promotion->after_product = $request->after_product;
        $promotion->sending_at = new Carbon($request->sending_at);
        $promotion->created_at = Carbon::now();
        $promotion->updated_at = Carbon::now();
        $promotion->save();
        foreach($request->products_id as $product) {
            $promotion->products()->attach($product);
        }

        return response()->json([], 200);

    }

    public function delete($id, DeletePromotionRequest $request) {
        $validate = $request->validated();

        $promotion = Promotion::find($id);
        $promotion->delete();

        return response()->json([], 200);
    }
}
