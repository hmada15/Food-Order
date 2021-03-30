<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\TaxValue;
use App\Models\DeliveryFee;
use Illuminate\Http\Request;
use App\Models\ClientAddress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\MassDestroyOrderRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class OrdersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['client', 'address', 'products', 'tax', 'delivery_fee'])->get();

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

        $clients = Client::with('clientAddress')->get();

        /* $addresses = ClientAddress::all()->pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), ''); */

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxes = TaxValue::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delivery_fees = DeliveryFee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('clients', 'products', 'taxes', 'delivery_fees'));
    }

    public function store(StoreOrderRequest $request)
    {
        $all_products_prices = [];
        //Get product prices
        foreach($request->products as $id){
            $product = Product::where("id", $id)->get(["regular_price", "sale_price"])->first();
            array_push($all_products_prices,!empty($product->sale_price) ? $product->sale_price : $product->regular_price);
        }
        //Multiply product prices by number_of_product
        foreach ($all_products_prices as $key => $price) {
            $total[] = $price * $request->number_of_product[$key];
        }
        //Get the total amount of order
        $amount = array_sum($total);

        $order = Order::create([
            "client_id"=> $request->client_id,
            "address_id"=> $request->address_id,
            "payment_method"=> $request->payment_method,
            "tax_id"=> $request->tax_id,
            "delivery_fee_id"=> $request->delivery_fee_id,
            "status"=> $request->status,
            "total_amount"=> $amount,
            "note"=> $request->note
        ]);

        $order->products()->sync($request->input('products', []));

        $ids = json_decode(json_encode($order->products()->allRelatedIds()), true);

        $productss = array_combine($ids,$request->number_of_product);

        foreach ($productss as $id => $productee){
            $order->products()->updateExistingPivot($id, ['number_of_product' => $productee]);
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $order->id]);
        }

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::with('clientAddress')->get();

        /* $addresses = ClientAddress::all()->pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), ''); */

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxes = TaxValue::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delivery_fees = DeliveryFee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('client', 'address', 'products', 'tax', 'delivery_fee');

        return view('admin.orders.edit', compact('clients', 'products', 'taxes', 'delivery_fees', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $all_products_prices = [];
        //Get product prices
        foreach($request->products as $id){
            $product = Product::where("id", $id)->get(["regular_price", "sale_price"])->first();
            array_push($all_products_prices,!empty($product->sale_price) ? $product->sale_price : $product->regular_price);
        }
        //Multiply product prices by number_of_product
        foreach ($all_products_prices as $key => $price) {
            $total[] = $price * $request->number_of_product[$key];
        }
        //Get the total amount of order
        $amount = array_sum($total);

        $order->update([
            "client_id"=> $request->client_id,
            "address_id"=> $request->address_id,
            "payment_method"=> $request->payment_method,
            "tax_id"=> $request->tax_id,
            "delivery_fee_id"=> $request->delivery_fee_id,
            "status"=> $request->status,
            "total_amount"=> $amount,
            "note"=> $request->note,
        ]);

        $order->products()->sync($request->input('products', []));

        $ids = json_decode(json_encode($order->products()->allRelatedIds()), true);

        $productss = array_combine($ids,$request->number_of_product);

        foreach ($productss as $id => $productee){
            $order->products()->updateExistingPivot($id, ['number_of_product' => $productee]);
        }

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('client', 'address', 'products', 'tax', 'delivery_fee');

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
