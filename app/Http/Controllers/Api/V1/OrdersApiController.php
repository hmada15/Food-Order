<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;

class OrdersApiController extends Controller
{

    public function index()
    {
        return OrderResource::collection(Order::Authorized()->with(['address', 'products', 'tax', 'delivery_fee'])->get());
    }

    public function store(ApiStoreOrderRequest $request, CreateOrderAction $createOrderAction)
    {

        $createOrderAction->execute($request);

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show($id)
    {
        try {
            $order = Order::Authorized()->with(['client', 'address', 'products', 'tax', 'delivery_fee'])->findOrFail($id);
        } catch (\Throwable $th) {
            abort(404, "Unauthorized Or Not found");
        }
        return new OrderResource($order);
    }

}
