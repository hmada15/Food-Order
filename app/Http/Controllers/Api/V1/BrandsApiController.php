<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new BrandResource(Brand::all());
    }

    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }
}
