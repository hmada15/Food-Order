@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientAddress.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.id') }}
                        </th>
                        <td>
                            {{ $clientAddress->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.client') }}
                        </th>
                        <td>
                            {{ $clientAddress->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.area') }}
                        </th>
                        <td>
                            {{ $clientAddress->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.street_name') }}
                        </th>
                        <td>
                            {{ $clientAddress->street_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.building_type') }}
                        </th>
                        <td>
                            {{ App\Models\ClientAddress::BUILDING_TYPE_SELECT[$clientAddress->building_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.building_name') }}
                        </th>
                        <td>
                            {{ $clientAddress->building_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.floor_number') }}
                        </th>
                        <td>
                            {{ $clientAddress->floor_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.apartment_number') }}
                        </th>
                        <td>
                            {{ $clientAddress->apartment_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientAddress.fields.landmark') }}
                        </th>
                        <td>
                            {{ $clientAddress->landmark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection