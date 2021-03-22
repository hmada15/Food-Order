<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaxValueRequest;
use App\Http\Requests\StoreTaxValueRequest;
use App\Http\Requests\UpdateTaxValueRequest;
use App\Models\TaxValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxValuesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tax_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxValues = TaxValue::all();

        return view('admin.taxValues.index', compact('taxValues'));
    }

    public function create()
    {
        abort_if(Gate::denies('tax_value_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxValues.create');
    }

    public function store(StoreTaxValueRequest $request)
    {
        $taxValue = TaxValue::create($request->all());

        return redirect()->route('admin.tax-values.index');
    }

    public function edit(TaxValue $taxValue)
    {
        abort_if(Gate::denies('tax_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxValues.edit', compact('taxValue'));
    }

    public function update(UpdateTaxValueRequest $request, TaxValue $taxValue)
    {
        $taxValue->update($request->all());

        return redirect()->route('admin.tax-values.index');
    }

    public function show(TaxValue $taxValue)
    {
        abort_if(Gate::denies('tax_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxValues.show', compact('taxValue'));
    }

    public function destroy(TaxValue $taxValue)
    {
        abort_if(Gate::denies('tax_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxValue->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxValueRequest $request)
    {
        TaxValue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
