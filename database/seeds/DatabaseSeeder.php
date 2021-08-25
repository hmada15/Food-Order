<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            ProductCategoriesSeeder::class,
            BrandsSeeder::class,
            ProductsSeeder::class,
            DeliveryFeeSeeder::class,
            TaxSeeder::class,
        ]);
    }
}
