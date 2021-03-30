<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductAttributeResource;
use App\Models\ProductAttribute;

class ProductAttributesApiController extends Controller
{
    public function index()
    {
        return new ProductAttributeResource(ProductAttribute::with(['product', 'parent_attribute'])->get());
    }

    public function show(ProductAttribute $productAttribute)
    {
        return new ProductAttributeResource($productAttribute->load(['product', 'parent_attribute']));
    }
}
