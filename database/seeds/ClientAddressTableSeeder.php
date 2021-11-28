<?php

use App\Models\ClientAddress;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ClientAddressTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 3; $i++) {

            $client_addres = [
                [
                    "area" => $faker->streetAddress,
                    "street_name" => $faker->streetName,
                    "building_type" => Arr::random(["option-villa", "option-apartment", "option-office"]),
                    "building_name" => $faker->name,
                    "floor_number" => $faker->numberrandomNumber(2),
                    "apartment_number" => $faker->numberrandomNumber(2),
                    "landmark" => $faker->name,
                    "client_id" => 2,
                ],
            ];

            ClientAddress::insert($client_addres);
        }
    }
}
