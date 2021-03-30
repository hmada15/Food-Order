<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaxValueResource;
use App\Models\TaxValue;

class TaxValuesApiController extends Controller
{
    public function index()
    {
        return new TaxValueResource(TaxValue::all());
    }

    public function show(TaxValue $taxValue)
    {
        return new TaxValueResource($taxValue);
    }
}
