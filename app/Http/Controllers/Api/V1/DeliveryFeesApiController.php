<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryFeeResource;
use App\Models\DeliveryFee;

class DeliveryFeesApiController extends Controller
{
    public function index()
    {
        return new DeliveryFeeResource(DeliveryFee::all());
    }

    public function show(DeliveryFee $deliveryFee)
    {
        return new DeliveryFeeResource($deliveryFee);
    }
}
