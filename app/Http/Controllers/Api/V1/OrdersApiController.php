<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\ApiStoreOrderRequest;
use App\Http\Requests\ApiUpdateOrderRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class OrdersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return OrderResource::collection(Order::Authorized()->with(['address', 'products', 'tax', 'delivery_fee'])->get());
    }

    public function store(ApiStoreOrderRequest $request)
    {
        $all_products_prices = [];
        //Get product prices
        $products = json_decode($request->products);
        foreach($products as $id){
            $product = Product::where("id", $id)->get(["regular_price", "sale_price"])->first();
            array_push($all_products_prices,!empty($product->sale_price) ? $product->sale_price : $product->regular_price);
        }
        $number_of_product = json_decode($request->number_of_product);
        //Multiply product prices by number_of_product
        foreach ($all_products_prices as $key => $price) {
            $total[] = $price * $number_of_product[$key];
        }

        //Get the total amount of order
        $amount = array_sum($total);

        $order = Order::create([
            "client_id"=> auth()->id(),
            "address_id"=> $request->address_id,
            "payment_method"=> $request->payment_method,
            "tax_id"=> $request->tax_id,
            "delivery_fee_id"=> $request->delivery_fee_id,
            "status"=> $request->status,
            "total_amount"=> $amount,
            "note"=> $request->note
        ]);

        $order->products()->sync($products);

        $ids = json_decode(json_encode($order->products()->allRelatedIds()), true);

        $productss = array_combine($ids,$products);

        foreach ($productss as $id => $productee){
            $order->products()->updateExistingPivot($id, ['number_of_product' => $productee]);
        }

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load(['client', 'address', 'products', 'tax', 'delivery_fee']));
    }

    public function update(ApiUpdateOrderRequest $request, Order $order)
    {
        $all_products_prices = [];
        //Get product prices
        $products = json_decode($request->products);
        foreach($products as $id){
            $product = Product::where("id", $id)->get(["regular_price", "sale_price"])->first();
            array_push($all_products_prices,!empty($product->sale_price) ? $product->sale_price : $product->regular_price);
        }
        $number_of_product = json_decode($request->number_of_product);
        //Multiply product prices by number_of_product
        foreach ($all_products_prices as $key => $price) {
            $total[] = $price * $number_of_product[$key];
        }

        //Get the total amount of order
        $amount = array_sum($total);

        $order->update([
            "client_id"=> auth()->id(),
            "address_id"=> $request->address_id,
            "payment_method"=> $request->payment_method,
            "tax_id"=> $request->tax_id,
            "delivery_fee_id"=> $request->delivery_fee_id,
            "status"=> $request->status,
            "total_amount"=> $amount,
            "note"=> $request->note,
        ]);

        $order->products()->sync($products);

        $ids = json_decode(json_encode($order->products()->allRelatedIds()), true);

        $productss = array_combine($ids,$products);

        foreach ($productss as $id => $productee){
            $order->products()->updateExistingPivot($id, ['number_of_product' => $productee]);
        }

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
