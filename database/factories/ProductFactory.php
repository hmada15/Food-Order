<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->word,
        'brand_id' => rand(1, 9),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'regular_price' => rand(1000, 10000),
        'sale_price' => rand(1000, 10000),
        'sku' => uniqid(),
        'in_stock' => Arr::random(['option-yes', 'option-no']),
        'is_publish' => Arr::random(['option-yes', 'option-no']),
        'category_id' => rand(1, 9),
        'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
    ];
});
