<?php

use App\Models\Brand;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i < 10; $i++) {
            $brand = [
                [
                    'name' => $faker->word,
                    'slug' => $faker->word,
                    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
                ],
            ];

            Brand::insert($brand);
        }
    }
}
