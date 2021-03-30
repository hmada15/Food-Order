<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new ProductResource(Product::with(['tags', 'brand', 'category'])->get());
    }

    public function show(Product $product)
    {
       return new ProductResource($product->load(['tags', 'brand', 'category']));
    }

}
