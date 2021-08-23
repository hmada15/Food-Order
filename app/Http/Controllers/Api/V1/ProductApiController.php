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
        //isPublish and isCategoryPUblish are local scope on Product model
        return new ProductResource(Product::isPublish()->isCategoryPUblish()->with(['tags', 'brand', 'category'])->get());
    }

    public function show($id)
    {
        try {
            $product = Product::isPublish()->isCategoryPublish()->with(['tags', 'brand', 'category'])->findOrFail($id);
        } catch (\Throwable $th) {
            abort(404, "Not found");
        }
        return new ProductResource($product);
    }

}
