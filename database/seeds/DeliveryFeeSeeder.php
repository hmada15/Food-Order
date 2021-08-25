<?php

use App\Models\DeliveryFee;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DeliveryFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {

            $Delivery_fee = [
                [
                    "name" => $faker->name,
                    "amount" => $faker->numberBetween(1, 30),
                    'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = null),
                ],
            ];

            DeliveryFee::insert($Delivery_fee);
        }
    }
}
