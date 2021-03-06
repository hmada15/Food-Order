<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductAttributeRequest;
use App\Http\Requests\StoreProductAttributeRequest;
use App\Http\Requests\UpdateProductAttributeRequest;
use App\Models\Product;
use App\Models\ProductAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductAttributesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttributes = ProductAttribute::with(['product', 'parent_attribute'])->get();

        $products = Product::get();

        $product_attributes = ProductAttribute::get();

        return view('admin.productAttributes.index', compact('productAttributes', 'products', 'product_attributes'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parent_attributes = ProductAttribute::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productAttributes.create', compact('products', 'parent_attributes'));
    }

    public function store(StoreProductAttributeRequest $request)
    {
        $request->merge([
            'name_value' => json_encode(array_combine($request->attribute_name, $request->value)),
        ]);

        $productAttribute = ProductAttribute::create($request->all());

        return redirect()->route('admin.product-attributes.index');
    }

    public function show(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttribute->load('product', 'parent_attribute');

        return view('admin.productAttributes.show', compact('productAttribute'));
    }

    public function edit(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parent_attributes = ProductAttribute::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productAttribute->load('product', 'parent_attribute');

        return view('admin.productAttributes.edit', compact('products', 'parent_attributes', 'productAttribute'));
    }

    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $request->merge([
            'name_value' => json_encode(array_combine($request->attribute_name, $request->value)),
        ]);

        $productAttribute->update($request->all());

        return redirect()->route('admin.product-attributes.index');
    }

    public function destroy(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductAttributeRequest $request)
    {
        ProductAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
