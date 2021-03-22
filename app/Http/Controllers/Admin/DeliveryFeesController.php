<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDeliveryFeeRequest;
use App\Http\Requests\StoreDeliveryFeeRequest;
use App\Http\Requests\UpdateDeliveryFeeRequest;
use App\Models\DeliveryFee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryFeesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('delivery_fee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryFees = DeliveryFee::all();

        return view('admin.deliveryFees.index', compact('deliveryFees'));
    }

    public function create()
    {
        abort_if(Gate::denies('delivery_fee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.deliveryFees.create');
    }

    public function store(StoreDeliveryFeeRequest $request)
    {
        $deliveryFee = DeliveryFee::create($request->all());

        return redirect()->route('admin.delivery-fees.index');
    }

    public function edit(DeliveryFee $deliveryFee)
    {
        abort_if(Gate::denies('delivery_fee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.deliveryFees.edit', compact('deliveryFee'));
    }

    public function update(UpdateDeliveryFeeRequest $request, DeliveryFee $deliveryFee)
    {
        $deliveryFee->update($request->all());

        return redirect()->route('admin.delivery-fees.index');
    }

    public function show(DeliveryFee $deliveryFee)
    {
        abort_if(Gate::denies('delivery_fee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.deliveryFees.show', compact('deliveryFee'));
    }

    public function destroy(DeliveryFee $deliveryFee)
    {
        abort_if(Gate::denies('delivery_fee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryFee->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeliveryFeeRequest $request)
    {
        DeliveryFee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
