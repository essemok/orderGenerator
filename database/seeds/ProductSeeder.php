<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /** @const int Общее количество заказов */
    private const NUMBER_OF_PRODUCTS = 10000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Закидываем в транзакции, а то уж ооочень долго ждать 10 000 инсертов
        DB::transaction(function () {
            factory(Product::class, self::NUMBER_OF_PRODUCTS)->create();
        });
    }
}
