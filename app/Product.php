<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Модель для таблицы "products".
 *
 * Таблица 'products' содержит следующие поля :
 * @property int    id      Идентификатор продукта
 * @property string name    Название продукта
 * @property int    price   Цена продукта
 */
class Product extends Model
{
    /**
     * Название таблицы в БД
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Получаем все заказы в которых присутствует продукт
     *
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            'orders_products',
            'product_id',
            'order_id'
        );
    }


}
