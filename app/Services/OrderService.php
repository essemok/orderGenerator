<?php

namespace App\Services;

use App\Order;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
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
     * Генерируем заказ из уникальных товаров
     * (каждого товара не более одной единицы)
     *
     * @param ProductRepository $productRepository
     * @return Order
     */
    public function generateUniqueProductsOrder(): Order
    {
        $products = $this->productRepository->getAllProducts();
        $order = new Order();


        foreach ($products as $product) {
            $productsInOrder = $order->getProductsCount();
            $estimatedPrice = $order->getOrderPrice() + $product->price;

            if (!$this->checkConditions($productsInOrder, $estimatedPrice)) {
                break;
            }
            $order->addProduct($product);
        }

        return $order;
    }

    /**
     * Генерируем заказ из повторяющихся товаров
     * (каждый товар можем положить в карзину сколько угодно раз)
     *
     * @param ProductRepository $productRepository
     * @return Order
     */
    public function generateDuplicateProductsOrder(): Order
    {
        $products = $this->productRepository->getAllProducts(true);
        $order = new Order();

        $this->fillOrder($order, $products);

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
    private function checkConditions(int $productsInOrder, int $estimatedPrice): bool
    {
        $satisfyingCondition = true;

        if (($productsInOrder > Order::MAX_PRODUCTS_COUNT) || ($estimatedPrice > Order::MAX_PRICE)) {
            $satisfyingCondition = false;
        }

        return $satisfyingCondition;
    }

    /**
     * Заполняем заказ продуктами
     *
     * @param int $productsCount
     * @param Order $order
     * @param Collection $products
     */
    private function fillOrder(Order $order, Collection $products): void
    {
        $productsInOrder = $order->getProductsCount();
        $firstElement = $products->first();
        $lastElement = $products->last();

        $estimatedPrice = $order->getOrderPrice() + $firstElement->price + (8 * $lastElement->price);

        if ($this->checkConditions($productsInOrder, $estimatedPrice)) {
            $order->addProducts(1, $firstElement);
            $order->addProducts(8, $lastElement);
            $this->fillOrder($order, $products);
        } else {
            $order->addProducts(20, $lastElement);
        }

    }
}
