@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.product.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brand_id">{{ trans('cruds.product.fields.brand') }}</label>
                <select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}" name="brand_id" id="brand_id">
                    @foreach($brands as $id => $brand)
                        <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
                @if($errors->has('brand'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brand') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="regular_price">{{ trans('cruds.product.fields.regular_price') }}</label>
                <input class="form-control {{ $errors->has('regular_price') ? 'is-invalid' : '' }}" type="number" name="regular_price" id="regular_price" value="{{ old('regular_price', '') }}" step="0.01" required>
                @if($errors->has('regular_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('regular_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.regular_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sale_price">{{ trans('cruds.product.fields.sale_price') }}</label>
                <input class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}" type="number" name="sale_price" id="sale_price" value="{{ old('sale_price', '') }}" step="0.01">
                @if($errors->has('sale_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sale_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.sale_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sku">{{ trans('cruds.product.fields.sku') }}</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="number" name="sku" id="sku" value="{{ old('sku', '') }}" step="1">
                @if($errors->has('sku'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sku') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.product.fields.in_stock') }}</label>
                @foreach(App\Models\Product::IN_STOCK_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('in_stock') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="in_stock_{{ $key }}" name="in_stock" value="{{ $key }}" {{ old('in_stock', 'option-yes') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="in_stock_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('in_stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('in_stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.in_stock_helper') }}</span>
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
                xhr.open('POST', '/admin/products/ckmedia', true);
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
                data.append('crud_id', '{{ $product->id ?? 0 }}');
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

<script>
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->photo)
      var files = {!! json_encode($product->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
