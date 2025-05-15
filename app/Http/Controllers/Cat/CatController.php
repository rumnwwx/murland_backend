<?php

namespace App\Http\Controllers\Cat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCatRequest;
use App\Http\Requests\Cat\CreateReviewRequest;
use App\Http\Requests\Cat\CreateOrderRequest;
use App\Http\Requests\Cat\CreateOrderCatRequest;
use App\Models\Cat;
use App\Models\Order;
use App\Models\OrderCat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::query()->where(['status' => 'available'])->get();

        return response()->json($cats)->setStatusCode(200);
    }

    public function createOrder(CreateOrderRequest $request)
    {
        $order = Order::query()->create($request->validated());

        return response()->json(['order' => $order], 200);
    }

    public function createOrderCat(CreateOrderCatRequest $request)
    {
        $order_cats = OrderCat::query()->create($request->validated());

        return response()->json(['order_cats' => $order_cats], 200);
    }

}
