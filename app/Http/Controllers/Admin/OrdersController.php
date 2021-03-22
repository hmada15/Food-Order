<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\Product;
use App\Models\TaxValue;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['client', 'address', 'product', 'tax', 'delivery_fee'])->get();

        $clients = Client::get();

        $client_addresses = ClientAddress::get();

        $products = Product::get();

        $tax_values = TaxValue::get();

        $delivery_fees = DeliveryFee::get();

        return view('admin.orders.index', compact('orders', 'clients', 'client_addresses', 'products', 'tax_values', 'delivery_fees'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = ClientAddress::all()->pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxes = TaxValue::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delivery_fees = DeliveryFee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('clients', 'addresses', 'products', 'taxes', 'delivery_fees'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $order->id]);
        }

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = ClientAddress::all()->pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxes = TaxValue::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delivery_fees = DeliveryFee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('client', 'address', 'product', 'tax', 'delivery_fee');

        return view('admin.orders.edit', compact('clients', 'addresses', 'products', 'taxes', 'delivery_fees', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('client', 'address', 'product', 'tax', 'delivery_fee');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('order_create') && Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Order();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
