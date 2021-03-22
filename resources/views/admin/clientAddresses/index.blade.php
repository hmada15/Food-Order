@extends('layouts.admin')
@section('content')
@can('client_address_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.client-addresses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.clientAddress.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.clientAddress.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ClientAddress">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.street_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.building_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.building_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.floor_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.apartment_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientAddress.fields.landmark') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($clients as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\ClientAddress::BUILDING_TYPE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientAddresses as $key => $clientAddress)
                        <tr data-entry-id="{{ $clientAddress->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $clientAddress->id ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->client->name ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->client->email ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->area ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->street_name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\ClientAddress::BUILDING_TYPE_SELECT[$clientAddress->building_type] ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->building_name ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->floor_number ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->apartment_number ?? '' }}
                            </td>
                            <td>
                                {{ $clientAddress->landmark ?? '' }}
                            </td>
                            <td>
                                @can('client_address_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.client-addresses.show', $clientAddress->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('client_address_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.client-addresses.edit', $clientAddress->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('client_address_delete')
                                    <form action="{{ route('admin.client-addresses.destroy', $clientAddress->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('client_address_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.client-addresses.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ClientAddress:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection