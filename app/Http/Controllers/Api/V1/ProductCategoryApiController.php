<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;

class ProductCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new ProductCategoryResource(ProductCategory::isPublish()->with(['parent_category'])->get());
    }
    public function show(ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory->isPublish()->load(['parent_category']));
    }

}
