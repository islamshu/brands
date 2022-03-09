@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Countries') }}</h2>


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Country Code') }}</th>
                    <th>{{ __('Name ar') }}</th>
                    <th>{{ __('Name en') }}</th>
                    <th>{{ __('latitude') }}</th>
                    <th>{{ __('longitude') }}</th>
                    <th>{{ __('Flag') }}</th>
                    <th>{{ __('alph3code') }}</th>
                 </tr>
            </thead>
            <tbody>
                    @foreach ($country as $item)   
                    <td>{{$item->country_code}}</td>
                    <td>{{$item->country_name_ar}}</td>
                    <td>{{$item->country_name_en}}</td>
                    <td>{{$item->lat}}</td>
                    <td>{{$item->lng}}</td>
                    <td><img src="{{$item->flag}}" style="width: 30px"></td>
                    <td>{{$item->alph2code}}</td>
               </tr>
                  @endforeach
                 

            </tbody>
        
        </table>


    </div>
</div>

@endsection

@section('styles')

 @endsection

@section('scripts')
 <script>
    
</script>
@endsection