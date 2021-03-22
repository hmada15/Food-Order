<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryFeeRequest;
use App\Http\Requests\UpdateDeliveryFeeRequest;
use App\Http\Resources\Admin\DeliveryFeeResource;
use App\Models\DeliveryFee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryFeesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('delivery_fee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryFeeResource(DeliveryFee::all());
    }

    public function store(StoreDeliveryFeeRequest $request)
    {
        $deliveryFee = DeliveryFee::create($request->all());

        return (new DeliveryFeeResource($deliveryFee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DeliveryFee $deliveryFee)
    {
        abort_if(Gate::denies('delivery_fee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryFeeResource($deliveryFee);
    }

    public function update(UpdateDeliveryFeeRequest $request, DeliveryFee $deliveryFee)
    {
        $deliveryFee->update($request->all());

        return (new DeliveryFeeResource($deliveryFee))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DeliveryFee $deliveryFee)
    {
        abort_if(Gate::denies('delivery_fee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryFee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
