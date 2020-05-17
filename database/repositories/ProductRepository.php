<?php

namespace Repositories;

use App\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    /**
     * Получаем данные по всем доступным в базе продуктам
     *
     * @param bool $desc
     * @return Collection
     */
    public function getAllProducts(bool $desc = false): Collection
    {
        return Product::all()->sortBy('price', SORT_NUMERIC, $desc);
    }
}
