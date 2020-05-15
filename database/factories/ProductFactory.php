<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

/** Фабрика для генерации случайных продуктов с человеческими именами (допустим, роботов) */
$factory->define(Product::class, function (Faker $faker) {
    return [
        'id'    => $faker->unique()->randomNumber(9),
        'name'  => $faker->unique()->name,
        'price' => $faker->numberBetween(1, 10000),
    ];
});
