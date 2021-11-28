<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStoreClientAddressRequest;
use App\Http\Requests\ApiUpdateClientAddressRequest;
use App\Http\Resources\ClientAddressResource;
use App\Models\ClientAddress;
use Symfony\Component\HttpFoundation\Response;

class ClientAddressesApiController extends Controller
{
    public function index()
    {
        //Authorized() is local scope inside ClientAddress model
        $clientaddress = ClientAddress::Authorized()->get();

        return new ClientAddressResource($clientaddress);
    }

    public function store(ApiStoreClientAddressRequest $request)
    {
        $request->merge([
            'client_id' => auth()->user()->id,
        ]);

        $clientAddress = ClientAddress::create($request->all());

        return (new ClientAddressResource($clientAddress))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(ApiUpdateClientAddressRequest $request, $id)
    {
        try {
            $clientAddress = ClientAddress::Authorized()->findOrFail($id);
        } catch (\Throwable $th) {
            abort(404, "Unauthorized Or Not found");
        }

        $request->merge([
            'client_id' => auth()->user()->id,
        ]);

        $clientAddress->update($request->all());

        return (new ClientAddressResource($clientAddress))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        $clientAddress = ClientAddress::Authorized()->where("id", $id)->firstOrFail();

        $clientAddress->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
