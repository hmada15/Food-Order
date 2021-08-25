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
}
