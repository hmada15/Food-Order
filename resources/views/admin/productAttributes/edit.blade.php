@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productAttribute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-attributes.update", [$productAttribute->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productAttribute.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productAttribute->name) }}" required>
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
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productAttribute->product->id ?? '') == $id ? 'selected' : '' }}>{{ $product }}</option>
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
                        <option value="{{ $id }}" {{ (old('parent_attribute_id') ? old('parent_attribute_id') : $productAttribute->parent_attribute->id ?? '') == $id ? 'selected' : '' }}>{{ $parent_attribute }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_attribute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.parent_attribute_helper') }}</span>
            </div>
            @php $productAttribute_name_value = json_decode($productAttribute->name_value,true); @endphp
            <div class="form-group" id="dynamic_field">
                <div id="dynamic_field">

                    <label for="name">{{ trans('cruds.productAttribute.fields.attribute_value') }}</label>

                    @foreach ($productAttribute_name_value as $name => $value)
                        <div class="form-row mb-2" id="row{{ $loop->iteration }}">
                            <input type="text" class="form-control col-5 mr-4" name="attribute_name[]"value="{{ $name }}"placeholder="{{ trans('cruds.productAttribute.fields.value_placeholder_name') }}">
                            <input type="number" class="form-control col-5 mr-4" name="value[]" value="{{ $value }}"placeholder="{{ trans('cruds.productAttribute.fields.value_placeholder_value') }}">

                            @if ($loop->index == 0)
                                <button type="button" name="add" id="add" class="btn btn-primary">Add More</button>
                            @else
                                <button type="button" name="remove" id="{{ $loop->iteration }}"
                                    class="btn btn-danger btn_remove">X</button>
                            @endif
                        </div>
                    @endforeach
                    @if ($errors->has('attribute_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('attribute_name') }}
                        </div>
                    @endif
                    @if ($errors->has('value'))
                        <div class="invalid-feedback">
                            {{ $errors->first('value') }}
                        </div>
                    @endif
                </div>
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
<?php $count = count($productAttribute_name_value); ?>
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var i = {{ $count }};
            $("#add").click(function() {
                i++;
                $('#dynamic_field').append('<div class="form-row mb-2" id="row' + i +
                    '"> <input type="text" class="form-control col-5 mr-4" name="attribute_name[]" placeholder="{{ trans('cruds.productAttribute.fields.value_placeholder_name') }}"> <input type="number" class="form-control col-5 mr-4" name="value[]" placeholder="{{ trans('cruds.productAttribute.fields.value_placeholder_value') }}"> <button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">X</button> </div>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });

    </script>
@endsection
