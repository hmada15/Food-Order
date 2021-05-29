<?php

use App\Models\Product;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i < 100; $i++) {

            $array = ['option-yes', 'option-no'];
            $rand = array_rand($array);

            $product = [
                [
                    'name' => $faker->word,
                    'slug' => $faker->word,
                    'brand_id' => rand(1, 9),
                    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'regular_price' => rand(1000, 10000),
                    'sale_price' => rand(1000, 10000),
                    'sku' => uniqid(),
                    'in_stock' =>   Arr::random(['option-yes', 'option-no']),
                    'is_publish' => Arr::random(['option-yes', 'option-no']),
                    'category_id' => rand(1, 9),
                    'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
                ],
            ];

            Product::insert($product);
        }
    }
}
