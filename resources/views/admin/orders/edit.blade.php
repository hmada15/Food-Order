@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.order.fields.client') }}</label>
                <select class="form-control  {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ (old('client_id') ? old('client_id') : $order->client->id ?? '') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address_id">{{ trans('cruds.order.fields.address') }}</label>
                <select class="form-control  {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address_id" id="address_id" required>
                    @foreach($clients as $client)
                        @foreach($client->clientAddress as  $address)
                        <option id="{{ $address->id }}" value="{{ $address->id }}" {{ (old('address_id') ? old('address_id') : $order->address->id ) == $address->id ? 'selected' : '' }}>{{ $address->street_name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.address_helper') }}</span>
            </div>
            @if (!empty(old()))
            @php $old_combine = array_combine(old("products"),old("number_of_product")) @endphp

                <div class="form-group" id="dynamic_field" style="margin-bottom: 4.5rem">
                    <label class="required" for="product_id">{{ trans('cruds.order.fields.product') }}</label>
                    @foreach ($old_combine as $product_old => $number_old)
                        <div class="form-row mb-2" id="row{{$loop->iteration}}">
                            <select class="form-control col-5 mr-4 " name="products[]" id="product_id" required>
                                @foreach($products as $id => $product)
                                    <option value="{{ $id }}" {{ $product_old == $id ? 'selected' : '' }}>{{ $product }}</option>
                                @endforeach
                            </select>

                            <input type="number" class="form-control col-5 mr-4 is-invalid" name="number_of_product[]" style="margin-left: 25px;" value="{{ $number_old}}" placeholder="{{ trans('cruds.order.fields.number_of_product') }}">
                                @if ($loop->index == 0)
                                    <button type="button" name="add" id="add" class="btn btn-primary">Add More</button>
                                @else
                                    <button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn_remove">X</button>
                                @endif
                        </div>

                        @if($errors->has('product_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_id') }}
                            </div>
                        @endif
                        @if($errors->has('number_of_product'))
                            <div class="invalid-feedback">
                                {{ $errors->first('number_of_product') }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @else

                <div class="form-group" id="dynamic_field" >
                    <label class="required" for="product_id">{{ trans('cruds.order.fields.product') }}</label>
                    @foreach ($order->products as $order_product)

                        <div class="form-row mb-2" id="row{{$loop->iteration}}">
                            <select class="form-control col-5 mr-4 " name="products[]" id="product_id" required>
                                @foreach($products as $id => $product)
                                <option value="{{ $id }}" {{ $order_product->id  == $id ? 'selected' : '' }}>{{ $product }}</option>
                                @endforeach
                            </select>
                            <input type="number"
                                class="form-control col-5 mr-4" name="number_of_product[]" style="margin-left: 25px;"
                                value="{{$order_product->pivot->number_of_product ?? '' }}"
                                placeholder="{{ trans('cruds.order.fields.number_of_product') }}"
                                >
                                @if ($loop->index == 0)
                                    <button type="button" name="add" id="add" class="btn btn-primary">Add More</button>
                                @else
                                    <button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn_remove">X</button>
                                @endif
                        </div>

                        @if($errors->has('product_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_id') }}
                            </div>
                        @endif
                        @if($errors->has('number_of_product'))
                            <div class="invalid-feedback">
                                {{ $errors->first('number_of_product') }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label class="required">{{ trans('cruds.order.fields.payment_method') }}</label>
                <select class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method" id="payment_method" required>
                    <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::PAYMENT_METHOD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_method', $order->payment_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax_id">{{ trans('cruds.order.fields.tax') }}</label>
                <select class="form-control  {{ $errors->has('tax') ? 'is-invalid' : '' }}" name="tax_id" id="tax_id">
                    @foreach($taxes as $id => $tax)
                        <option value="{{ $id }}" {{ (old('tax_id') ? old('tax_id') : $order->tax->id ?? '') == $id ? 'selected' : '' }}>{{ $tax }}</option>
                    @endforeach
                </select>
                @if($errors->has('tax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.tax_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_fee_id">{{ trans('cruds.order.fields.delivery_fee') }}</label>
                <select class="form-control  {{ $errors->has('delivery_fee') ? 'is-invalid' : '' }}" name="delivery_fee_id" id="delivery_fee_id">
                    @foreach($delivery_fees as $id => $delivery_fee)
                        <option value="{{ $id }}" {{ (old('delivery_fee_id') ? old('delivery_fee_id') : $order->delivery_fee->id ?? '') == $id ? 'selected' : '' }}>{{ $delivery_fee }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_fee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_fee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.delivery_fee_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="total_amount">{{ trans('cruds.order.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $order->total_amount) }}" step="0.01" required>
                @if($errors->has('total_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.total_amount_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="note">{{ trans('cruds.order.fields.note') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{!! old('note', $order->note) !!}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.note_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/orders/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $order->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>
<?php $count =  count($order->products) ?>
<script type="text/javascript">
    $(document).ready(function(){

      var i = {{$count}};

      $("#add").click(function(){
        i++;
        $('#dynamic_field').append('<div class="form-row mb-2" id="row'+i+'"><select class="form-control col-5 mr-4 " name="products[]" required>@foreach($products as $id => $product)<option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $product }}</option>@endforeach</select><input type="number" class="form-control col-5 mr-4" name="number_of_product[]"  value="{{ old('Value', '') }}" placeholder="{{ trans('cruds.order.fields.number_of_product') }}"> <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button> </div>');
    });

      $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
      });

    });
</script>
<script>
    $('#client_id').change(function() {
        $('#address_id option').hide();
        $('#address_id option[id="' + $(this).val() + '"]').show();
        if ($('#address_id option[id="' + $(this).val() + '"]').length) {
            $('#address_id option[id="' + $(this).val() + '"]').first().prop('selected', true);
        }
        else {
            $('#address_id').val('');
        };
    });
</script>
@endsection
