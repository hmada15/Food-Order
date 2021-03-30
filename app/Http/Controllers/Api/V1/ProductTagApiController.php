<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductTagResource;
use App\Models\ProductTag;

class ProductTagApiController extends Controller
{
    public function index()
    {
        return new ProductTagResource(ProductTag::all());
    }

    public function show(ProductTag $productTag)
    {
        return new ProductTagResource($productTag);
    }
}
