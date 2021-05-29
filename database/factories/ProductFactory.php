<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->word,
        'brand_id' => rand(1, 10),
        'description' => $faker->sentences,
        'regular_price' => rand(1000, 10000),
        'sale_price' => rand(1000, 10000),
        'sku' => 123,
        'in_stock' => 'option-yes',
        'is_publish' => 'option-yes',
        'category_id' => rand(1, 10),
    ];
});
