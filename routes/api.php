<?php

Route::post('login', 'Api\v1\AuthController@login');
Route::post('register', 'Api\v1\AuthController@register');

//Nmaespace group remove because IDE extension don't regonise it
Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Clients
    Route::get('client', 'Api\V1\ClientsApiController@index')->name("client.index");
    Route::PUT('client', 'Api\V1\ClientsApiController@update')->name("client.update");
    Route::delete('client', 'Api\V1\ClientsApiController@destroy')->name("client.destroy");

    // Client Addresses
    Route::apiResource('client-addresses', 'Api\V1\ClientAddressesApiController')->except("show");

    // Orders
    Route::apiResource('orders', 'Api\V1\OrdersApiController')->except('update', "destroy");
});

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {

    // Product Categories
    Route::apiResource('product-categories', 'Api\V1\ProductCategoryApiController')->only("index", "show");
    // Product Tags
    Route::apiResource('product-tags', 'Api\V1\ProductTagApiController')->only("index", "show");
    // Products
    Route::apiResource('products', 'Api\V1\ProductApiController')->only("index", "show");
    // Product Attributes
    Route::apiResource('product-attributes', 'Api\V1\ProductAttributesApiController')->only("index", "show");
    // Brands
    Route::apiResource('brands', 'Api\V1\BrandsApiController')->only("index", "show");
    // Tax Values
    Route::apiResource('tax-values', 'Api\V1\TaxValuesApiController')->only("index", "show");
    // Delivery Fees
    Route::apiResource('delivery-fees', 'Api\V1\DeliveryFeesApiController')->only("index", "show");
});
