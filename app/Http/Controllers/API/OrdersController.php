<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DeleteOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Mail\FeedbackMail;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function index() {
        return OrderResource::collection(Order::with(['user', 'status', 'products'])->paginate(15));
    }

    public function delete($id, DeleteOrderRequest $request) {
        $validate = $request->validated();

        $order = Order::find($id);
        $order->delete();
        return response()->json([], 200);
    }

    public function show($id) {
        return new OrderResource(Order::with(['user', 'status', 'products'])->find($id));
    }

    public function update($id, UpdateOrderRequest $request) {
        $validate = $request->validated();

        $order = Order::find($id);
        $order->status()->dissociate();
        $status = OrderStatus::find($request->status_id);
        $order->status()->associate($status);
        $order->save();
        $order->user();
        $order_id = $order->id;
        $username = $order->user->username;
        $sendStatus = $status->title;
        $toEmail = $order->user->email;
        Mail::to($toEmail)->send(new FeedbackMail($order_id, $username, $sendStatus));
        return response()->json([], 200);
    }
}
