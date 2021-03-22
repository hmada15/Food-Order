@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productAttribute.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productAttribute.fields.id') }}
                        </th>
                        <td>
                            {{ $productAttribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productAttribute.fields.name') }}
                        </th>
                        <td>
                            {{ $productAttribute->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productAttribute.fields.product') }}
                        </th>
                        <td>
                            {{ $productAttribute->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productAttribute.fields.parent_attribute') }}
                        </th>
                        <td>
                            {{ $productAttribute->parent_attribute->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productAttribute.fields.name_value') }}
                        </th>
                        <td>
                            {{ $productAttribute->name_value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection