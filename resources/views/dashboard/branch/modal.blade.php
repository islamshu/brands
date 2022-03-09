@php

    $cities = App\Models\Vendor_cities::where('vendor_id',$vendor->id)->where('status','active')->with('city')->get();
@endphp
<table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
id="kt_datatable">
<thead>
    <tr class="fw-bold fs-6 text-gray-800">
        <th>{{ __('city name') }}</th>
        <th>{{ __('city id') }}</th>
        <th>{{ __('Neighborhood') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($cities as $item)
    <td>{{ $item->city->city_name }}</td>
    <td>{{ $item->city->id }}</td>
    @php
       $neighborhoods = App\Models\enterprise_neighborhood::where('enterprise_id',$vendor->enterprise_id)->where('status',1)->with('neighborhood')
        ->whereHas('neighborhood', function ($q) use ($item) {
            $q->where('city_id', $item->city->id);
          })->get()
          @endphp
          <td>
          @foreach ($neighborhoods as $key => $value) 
          
            {{ 'name : ' }}  {{ $value->neighborhood->neighborhood_name }} {{ '  '  }}{{ '  Id: ' }} {{ $value->neighborhood->id }} <br>
          
          @endforeach
        </td>
            
          
    
        
    @endforeach
</tbody>
</table>
<form class="form" method="post" action="{{ route('importBranch',[app()->getLocale(),$vendor->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Upload file') }} :</label>
                <input type="file" name="file" id="file" class="form-control form-control-solid"
                    placeholder="{{ __('Upload file') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input type="submit"  class="form-control btn btn-primary" value="{{ __('Submit') }}"
                  />
            </div>
        </div>
    </div>
</form>