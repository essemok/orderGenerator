<?php

namespace App\Services;

use App\Order;
use App\Product;
use Repositories\ProductRepository;

class OrderService
{
    /** Репозиторий методов полученя данных о продуктах */
    private ProductRepository $productRepository;

    /**
     * OrderService constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Генерируем заказ
     *
     * @param ProductRepository $productRepository
     * @return Order
     */
    public function generateOrder(): Order
    {
        $products = $this->productRepository->getAllProducts();
        $order = new Order();

        foreach ($products as $product) {
            if (!$this->checkConditions($order, $product)) {
                break;
            }
            $order->addProduct($product);
        }

        return $order;
    }


    /**
     * Проверяем, что текущее состояние заказа удовлетворяет требованиям
     * и следующий заказ всё не испортит
     *
     * @param Order $order
     * @param Product $product
     *
     * @return bool
     */
    public function checkConditions(Order $order, Product $product): bool
    {
        $satisfyingCondition = true;

        if (
            ($order->totalProducts > Order::MIN_PRODUCTS_COUNT)
            || (($order->getOrderPrice() + $product->price) > Order::MAX_PRICE)
        ) {
            $satisfyingCondition = false;
        }

        return $satisfyingCondition;
    }
}
