<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

class OrderController extends Controller
{
    public function generate(OrderService $orderService)
    {
        $order = $orderService->generateOrder();

        dd($order);
    }
}
