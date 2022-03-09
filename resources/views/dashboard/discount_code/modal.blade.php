<table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
id="kt_datatable">
<thead>
    <tr class="fw-bold fs-6 text-gray-800">
        <th>{{ __('code') }}</th>
        <th>{{ __('total') }}</th>
        <th>{{ __('total usage') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($codes as $item)
    @php
        $dis = App\Models\Discount::find($item->discount_id);
    @endphp
    <tr>
    <td>{{ $item->code }}</td>
    <td>{{ $dis->value}}</td>
    <td>{{ App\Models\PromocodeUser::where('promocode',$item->code)->count()}}</td>
    </tr>
    @endforeach
  
</tbody>
</table>