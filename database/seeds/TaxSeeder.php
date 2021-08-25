<?php

use App\Models\TaxValue;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {

            $tax = [
                [
                    "name" => $faker->name,
                    "amount" => $faker->numberBetween(1, 30),
                    'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
                ],
            ];

            TaxValue::insert($tax);
        }
    }
}
