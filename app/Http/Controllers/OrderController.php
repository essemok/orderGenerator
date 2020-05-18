<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

class OrderController extends Controller
{
    /**
     * Обрабатываем запрос на формирование заказа
     * состоящего из уникальных товаров
     *
     * @param OrderService $orderService
     */
    public function generateUniqueProductsOrder(OrderService $orderService)
    {
        $order = $orderService->generateUniqueProductsOrder();

        dd($order);
    }

    /**
     * Обрабатываем запрос на формирование заказа
     * из повторяющихся элементов
     *
     * @param OrderService $orderService
     */
    public function generateDuplicateProductsOrder(OrderService $orderService)
    {
        $order = $orderService->generateDuplicateProductsOrder();

        dd($order);
    }
}
