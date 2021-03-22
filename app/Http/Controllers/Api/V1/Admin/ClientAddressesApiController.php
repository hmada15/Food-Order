<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientAddressRequest;
use App\Http\Requests\UpdateClientAddressRequest;
use App\Http\Resources\Admin\ClientAddressResource;
use App\Models\ClientAddress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientAddressesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('client_address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientAddressResource(ClientAddress::with(['client'])->get());
    }

    public function store(StoreClientAddressRequest $request)
    {
        $clientAddress = ClientAddress::create($request->all());

        return (new ClientAddressResource($clientAddress))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientAddress $clientAddress)
    {
        abort_if(Gate::denies('client_address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientAddressResource($clientAddress->load(['client']));
    }

    public function update(UpdateClientAddressRequest $request, ClientAddress $clientAddress)
    {
        $clientAddress->update($request->all());

        return (new ClientAddressResource($clientAddress))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientAddress $clientAddress)
    {
        abort_if(Gate::denies('client_address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientAddress->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
