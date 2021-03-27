<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\DeleteCurrencyRequest;
use App\Http\Requests\Currency\StoreCurrencyRequest;
use App\Http\Requests\Currency\UpdateCurrencyRequest;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    public function index() {
        $currencies = Currency::all();

        return response()->json([
            $currencies
        ], 200);
    }

    public function show($id) {
        $currency = Currency::find($id);

        return response()->json([
            $currency
        ], 200);
    }

    public function create(StoreCurrencyRequest $request) {
        $validate = $request->validated();

        $currency = new Currency();
        $currency->title = $request->title;
        $currency->iso = $request->iso;
        $currency->ratio = $request->ratio;
        $currency->created_at = Carbon::now();
        $currency->updated_at = Carbon::now();

        $currency->save();

        return response()->json([], 200);
    }

    public function update($id, UpdateCurrencyRequest $request) {
        $validate = $request->validated();

        $currency = Currency::find($id);
        $currency->title = $request->title;
        $currency->iso = $request->iso;
        $currency->ratio = $request->ratio;
        $currency->updated_at = Carbon::now();
        $currency->save();

        return response()->json([], 200);
    }

    public function delete($id, DeleteCurrencyRequest $request) {
        $validate = $request->validated();

        $currency = Currency::find($id);
        $currency->delete();

        return response()->json([], 200);
    }
}
