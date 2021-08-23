<?php

use App\Models\ProductCategory;
use Faker\Generator as Faker;
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
        factory(ProductCategory::class, 10)->create();
    }
}
