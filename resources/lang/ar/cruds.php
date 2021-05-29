<?php

return [
    'userManagement'    => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission'        => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'              => [
        'title'          => 'أدوار',
        'title_singular' => 'دور',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'              => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'productManagement' => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'productCategory'   => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'photo'                  => 'Photo',
            'photo_helper'           => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => ' ',
            'slug'                   => 'Slug',
            'slug_helper'            => ' ',
            'parent_category'        => 'Parent Category',
            'parent_category_helper' => ' ',
            'is_publish'             => 'Is publish',
            'is_publish_helper'      => ' ',
        ],
    ],
    'productTag'        => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
        ],
    ],
    'product'           => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'tag'                  => 'Tags',
            'tag_helper'           => ' ',
            'photo'                => 'Photo',
            'photo_helper'         => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => ' ',
            'regular_price'        => 'Regular Price',
            'regular_price_helper' => ' ',
            'sale_price'           => 'Sale Price',
            'sale_price_helper'    => ' ',
            'sku'                  => 'Sku',
            'sku_helper'           => ' ',
            'in_stock'             => 'In Stock',
            'in_stock_helper'      => ' ',
            'is_publish'             => 'Is publish',
            'is_publish_helper'      => ' ',
            'slug'                 => 'Slug',
            'slug_helper'          => ' ',
            'brand'                => 'Brand',
            'brand_helper'         => ' ',
            'category'             => 'Category',
            'category_helper'      => ' ',
        ],
    ],
    'clintManagement'   => [
        'title'          => 'Clint Management',
        'title_singular' => 'Clint Management',
    ],
    'client'            => [
        'title'          => 'Clients',
        'title_singular' => 'Client',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'phone_number'             => 'Phone Number',
            'phone_number_helper'      => ' ',
            'gender'                   => 'Gender',
            'gender_helper'            => ' ',
            'language'                 => 'Language',
            'language_helper'          => ' ',
            'note'                     => 'Note',
            'note_helper'              => ' ',
            'email_verified_at'        => 'Email Verified At',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'date_of_birth'            => 'Date Of Birth',
            'date_of_birth_helper'     => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'clientAddress'     => [
        'title'          => 'Client Addresses',
        'title_singular' => 'Client Address',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'client'                  => 'Client',
            'client_helper'           => ' ',
            'area'                    => 'Area',
            'area_helper'             => ' ',
            'street_name'             => 'Street Name',
            'street_name_helper'      => ' ',
            'building_type'           => 'Building Type',
            'building_type_helper'    => ' ',
            'building_name'           => 'Building Name/number',
            'building_name_helper'    => ' ',
            'floor_number'            => 'Floor Number',
            'floor_number_helper'     => ' ',
            'apartment_number'        => 'Apartment Number',
            'apartment_number_helper' => ' ',
            'landmark'                => 'Landmark/known place',
            'landmark_helper'         => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'option'            => [
        'title'          => 'Options',
        'title_singular' => 'Option',
    ],
    'productAttribute'  => [
        'title'          => 'Product Attributes',
        'title_singular' => 'Product Attribute',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Name',
            'name_helper'             => ' ',
            'product'                 => 'Product',
            'product_helper'          => ' ',
            'name_value'              => 'Name Value',
            'name_value_helper'       => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'parent_attribute'        => 'Parent Attribute',
            'parent_attribute_helper' => ' ',
        ],
    ],
    'brand'             => [
        'title'          => 'Brands',
        'title_singular' => 'Brand',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'order'             => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'client'                   => 'Client',
            'client_helper'            => ' ',
            'product'                  => 'Product',
            'product_helper'           => ' ',
            'number_of_product'        => 'Number Of Product',
            'number_of_product_helper' => ' ',
            'payment_method'           => 'Payment Method',
            'payment_method_helper'    => ' ',
            'total_amount'             => 'Total Amount',
            'total_amount_helper'      => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'address'                  => 'Address',
            'address_helper'           => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
            'note'                     => 'Note',
            'note_helper'              => ' ',
            'tax'                      => 'Tax',
            'tax_helper'               => ' ',
            'delivery_fee'             => 'Delivery Fee',
            'delivery_fee_helper'      => ' ',
        ],
    ],
    'taxValue'          => [
        'title'          => 'Tax Values',
        'title_singular' => 'Tax Value',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'amount'            => 'Amount',
            'amount_helper'     => 'Tax amount in percent without % sign, Example: 14 to indicate that the tax is 14%',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'deliveryFee'       => [
        'title'          => 'Delivery Fees',
        'title_singular' => 'Delivery Fee',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'amount'            => 'Amount',
            'amount_helper'     => ' ',
            'note'              => 'Note',
            'note_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
