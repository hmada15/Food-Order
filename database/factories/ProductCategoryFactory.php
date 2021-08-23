<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->word,
        'parent_category_id' => null,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'is_publish' => Arr::random(['option-yes', 'option-no']),
        'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
    ];
});
