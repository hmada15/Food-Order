<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tags
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Client Addresses
    Route::apiResource('client-addresses', 'ClientAddressesApiController');

    // Product Attributes
    Route::apiResource('product-attributes', 'ProductAttributesApiController');

    // Brands
    Route::post('brands/media', 'BrandsApiController@storeMedia')->name('brands.storeMedia');
    Route::apiResource('brands', 'BrandsApiController');

    // Orders
    Route::post('orders/media', 'OrdersApiController@storeMedia')->name('orders.storeMedia');
    Route::apiResource('orders', 'OrdersApiController');

    // Tax Values
    Route::apiResource('tax-values', 'TaxValuesApiController');

    // Delivery Fees
    Route::apiResource('delivery-fees', 'DeliveryFeesApiController');
});
