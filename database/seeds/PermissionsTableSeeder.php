<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'clint_management_access',
            ],
            [
                'id'    => 34,
                'title' => 'client_create',
            ],
            [
                'id'    => 35,
                'title' => 'client_edit',
            ],
            [
                'id'    => 36,
                'title' => 'client_show',
            ],
            [
                'id'    => 37,
                'title' => 'client_delete',
            ],
            [
                'id'    => 38,
                'title' => 'client_access',
            ],
            [
                'id'    => 39,
                'title' => 'client_address_create',
            ],
            [
                'id'    => 40,
                'title' => 'client_address_edit',
            ],
            [
                'id'    => 41,
                'title' => 'client_address_show',
            ],
            [
                'id'    => 42,
                'title' => 'client_address_delete',
            ],
            [
                'id'    => 43,
                'title' => 'client_address_access',
            ],
            [
                'id'    => 44,
                'title' => 'option_access',
            ],
            [
                'id'    => 45,
                'title' => 'product_attribute_create',
            ],
            [
                'id'    => 46,
                'title' => 'product_attribute_edit',
            ],
            [
                'id'    => 47,
                'title' => 'product_attribute_show',
            ],
            [
                'id'    => 48,
                'title' => 'product_attribute_delete',
            ],
            [
                'id'    => 49,
                'title' => 'product_attribute_access',
            ],
            [
                'id'    => 50,
                'title' => 'brand_create',
            ],
            [
                'id'    => 51,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 52,
                'title' => 'brand_show',
            ],
            [
                'id'    => 53,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 54,
                'title' => 'brand_access',
            ],
            [
                'id'    => 55,
                'title' => 'order_create',
            ],
            [
                'id'    => 56,
                'title' => 'order_edit',
            ],
            [
                'id'    => 57,
                'title' => 'order_show',
            ],
            [
                'id'    => 58,
                'title' => 'order_delete',
            ],
            [
                'id'    => 59,
                'title' => 'order_access',
            ],
            [
                'id'    => 60,
                'title' => 'tax_value_create',
            ],
            [
                'id'    => 61,
                'title' => 'tax_value_edit',
            ],
            [
                'id'    => 62,
                'title' => 'tax_value_show',
            ],
            [
                'id'    => 63,
                'title' => 'tax_value_delete',
            ],
            [
                'id'    => 64,
                'title' => 'tax_value_access',
            ],
            [
                'id'    => 65,
                'title' => 'delivery_fee_create',
            ],
            [
                'id'    => 66,
                'title' => 'delivery_fee_edit',
            ],
            [
                'id'    => 67,
                'title' => 'delivery_fee_show',
            ],
            [
                'id'    => 68,
                'title' => 'delivery_fee_delete',
            ],
            [
                'id'    => 69,
                'title' => 'delivery_fee_access',
            ],
            [
                'id'    => 70,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 71,
                'title' => 'option-accesst',
            ],
        ];

        Permission::insert($permissions);
    }
}
