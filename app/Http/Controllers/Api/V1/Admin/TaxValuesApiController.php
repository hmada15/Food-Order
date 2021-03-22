<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaxValueRequest;
use App\Http\Requests\UpdateTaxValueRequest;
use App\Http\Resources\Admin\TaxValueResource;
use App\Models\TaxValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxValuesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tax_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaxValueResource(TaxValue::all());
    }

    public function store(StoreTaxValueRequest $request)
    {
        $taxValue = TaxValue::create($request->all());

        return (new TaxValueResource($taxValue))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TaxValue $taxValue)
    {
        abort_if(Gate::denies('tax_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaxValueResource($taxValue);
    }

    public function update(UpdateTaxValueRequest $request, TaxValue $taxValue)
    {
        $taxValue->update($request->all());

        return (new TaxValueResource($taxValue))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TaxValue $taxValue)
    {
        abort_if(Gate::denies('tax_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxValue->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
