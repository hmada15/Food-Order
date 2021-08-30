<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ClientsApiController extends Controller
{
    public function index()
    {
        return new ClientResource(auth()->user());
    }

    public function update(UpdateClientRequest $request)
    {
        $client = auth()->user();

        $client->update($request->all());

        return (new ClientResource($client))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy()
    {

        $client = auth()->user();

        $client->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
