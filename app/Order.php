<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Модель для таблицы "orders".
 *
 * Таблица 'orders' содержит следующие поля :
 * @property int id      Идентификатор заказа
 * @property int user_id Идентификатор пользователя, которому принадлежит заказ
 */
class Order extends Model
{
    /** @const int  Минимальная стоимость заказа*/
    public const MIN_PRICE = 2600000;

    /** @const int  Максимальная стоимость заказа*/
    public const MAX_PRICE = 3000000;

    /** @const int Минимальное кол-во продуктов в заказе*/
    public const MIN_PRODUCTS_COUNT = 2500;

    /** @const int  Максимальное кол-во продуктов в заказе*/
    public const MAX_PRODUCTS_COUNT = 3000;

    /**
     * Название таблицы в БД
     *
     * @var string
     */
    protected string $table = 'orders';

    /**
     * Набор продуктов, входящих в заказ
     *
     * @var Product[]
     */
    private array $products = [];

    /**
     * Общаяя цена заказа
     *
     * @var int
     */
    private int $orderPrice = 0;

    /**
     * Общее кол-во едениц продуктов в заказе
     *
     * @var int
     */
    private int $orderProductsCount = 0;

    /**
     * Получаем пользователя, которому принадлежит заказ
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Получаем все продукты, которые есть в заказе
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'orders_products',
            'order_id',
            'product_id'
        );
    }

    /**
     * Добавляем несколько продуктов в заказ
     *
     * @param $value
     * @param Product $product
     */
    public function addProducts($value, Product $product)
    {
        while($value) {
            $this->addProduct($product);
            $value--;
        }
    }

    /**
     * Добавляем продукт в заказ
     *
     * @param Product $products
     */
    public function addProduct(Product $product): void
    {
        $this->products[] = $product;

        $this->addPrice($product->price);

        $this->setProductsCount();
    }

    /**
     * Получаем список всех продуктов
     *
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Получаем текущую стоимость заказа
     *
     * @return int
     */
    public function getOrderPrice(): int
    {
        return $this->orderPrice;
    }

    /**
     * Получаем кол-во товаров в заказе
     *
     * @return int
     */
    public function getProductsCount(): int
    {
        return $this->orderProductsCount;
    }

    /**
     * Добавляем стоимость добавляемого товара к общей цене
     *
     * @param int $price
     */
    private function addPrice(int $price): void
    {
        $this->orderPrice += $price;
    }

    /**
     * Увеличиваем общее кол-во товаров на еденицу
     */
    private function setProductsCount(): void
    {
        ++$this->orderProductsCount;
    }

}
