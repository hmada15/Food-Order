@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productAttribute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-attributes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productAttribute.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.productAttribute.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_attribute_id">{{ trans('cruds.productAttribute.fields.parent_attribute') }}</label>
                <select class="form-control select2 {{ $errors->has('parent_attribute') ? 'is-invalid' : '' }}" name="parent_attribute_id" id="parent_attribute_id">
                    @foreach($parent_attributes as $id => $parent_attribute)
                        <option value="{{ $id }}" {{ old('parent_attribute_id') == $id ? 'selected' : '' }}>{{ $parent_attribute }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_attribute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.parent_attribute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_value">{{ trans('cruds.productAttribute.fields.name_value') }}</label>
                <input class="form-control {{ $errors->has('name_value') ? 'is-invalid' : '' }}" type="text" name="name_value" id="name_value" value="{{ old('name_value', '') }}" required>
                @if($errors->has('name_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.name_value_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection