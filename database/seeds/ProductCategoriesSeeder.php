<?php

use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i < 10; $i++) {
            $productCategory = [
                [
                    'name' => $faker->word,
                    'slug' => $faker->word,
                    'parent_category_id' => null,
                    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'is_publish' => Arr::random(['option-yes', 'option-no']),
                    'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
                ],
            ];

            ProductCategory::insert($productCategory);
        }
    }
}
