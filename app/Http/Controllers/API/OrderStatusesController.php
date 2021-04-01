<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderStatusResource;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusesController extends Controller
{
    public function index() {
        return OrderStatusResource::collection(OrderStatus::all());
    }
}
