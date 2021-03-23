<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusesController extends Controller
{
    public function all() {
        $order_statuses = OrderStatus::all();

        return response()->json([
            $order_statuses
        ], 200);
    }
}
