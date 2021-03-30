<?php

namespace App\Http\Controllers\Api\V1;

use Gate;
use Illuminate\Http\Request;
use App\Models\ClientAddress;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientAddressResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ApiStoreClientAddressRequest;
use App\Http\Requests\ApiUpdateClientAddressRequest;

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
        if(!$request->client_id){$request['client_id'] = auth()->id();}

        $clientAddress = ClientAddress::create($request->all());

        return (new ClientAddressResource($clientAddress))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(ApiUpdateClientAddressRequest $request, $id)
    {

        $clientAddress = ClientAddress::Authorized()->where('id', $id)->firstOrFail();

        if(!$request->client_id){$request['client_id'] = auth()->id();}

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
