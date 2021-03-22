@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientAddress.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client-addresses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.clientAddress.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area">{{ trans('cruds.clientAddress.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', '') }}">
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="street_name">{{ trans('cruds.clientAddress.fields.street_name') }}</label>
                <input class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}" type="text" name="street_name" id="street_name" value="{{ old('street_name', '') }}">
                @if($errors->has('street_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('street_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.street_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.clientAddress.fields.building_type') }}</label>
                <select class="form-control {{ $errors->has('building_type') ? 'is-invalid' : '' }}" name="building_type" id="building_type">
                    <option value disabled {{ old('building_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ClientAddress::BUILDING_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('building_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('building_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('building_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.building_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="building_name">{{ trans('cruds.clientAddress.fields.building_name') }}</label>
                <input class="form-control {{ $errors->has('building_name') ? 'is-invalid' : '' }}" type="text" name="building_name" id="building_name" value="{{ old('building_name', '') }}">
                @if($errors->has('building_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('building_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.building_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="floor_number">{{ trans('cruds.clientAddress.fields.floor_number') }}</label>
                <input class="form-control {{ $errors->has('floor_number') ? 'is-invalid' : '' }}" type="text" name="floor_number" id="floor_number" value="{{ old('floor_number', '') }}">
                @if($errors->has('floor_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('floor_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.floor_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="apartment_number">{{ trans('cruds.clientAddress.fields.apartment_number') }}</label>
                <input class="form-control {{ $errors->has('apartment_number') ? 'is-invalid' : '' }}" type="text" name="apartment_number" id="apartment_number" value="{{ old('apartment_number', '') }}">
                @if($errors->has('apartment_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('apartment_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.apartment_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="landmark">{{ trans('cruds.clientAddress.fields.landmark') }}</label>
                <input class="form-control {{ $errors->has('landmark') ? 'is-invalid' : '' }}" type="text" name="landmark" id="landmark" value="{{ old('landmark', '') }}">
                @if($errors->has('landmark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('landmark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientAddress.fields.landmark_helper') }}</span>
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