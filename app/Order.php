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
    /**
     * Название таблицы в БД
     *
     * @var string
     */
    protected string $table = 'orders';

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
}
