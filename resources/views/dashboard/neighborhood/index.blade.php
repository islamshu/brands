@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">

    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Neighborhoods') }}</h2>

        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('Name ar') }}</th>
                    <th>{{ __('Name en') }}</th>
                    <th>{{ __('Latitude') }}</th>
                    <th>{{ __('Longitude') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('status') }}</th>
                 </tr>
            </thead>
            <tbody>
                @foreach ($Neighborhoods as $item)
                @if(auth()->user()->hasRole('Enterprises'))
                <td>{{@$item->neighborhood->neighborhood_name}}</td>
                <td>{{@$item->neighborhood->neighborhood_name_english}}</td>
                <td>{{@$item->neighborhood->lat}}</td>
                <td>{{@$item->neighborhood->lng}}</td>
                <td>{{@$item->neighborhood->city->city_name_english}}</td>
                <td>
                    <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 1 ? 'checked' : '' }}>
                    </td>

                </tr>
                @else
                <tr>
                    <td>{{@$item->neighborhood_name}}</td>
                    <td>{{@$item->neighborhood_name_english}}</td>
                    <td>{{@$item->lat}}</td>
                    <td>{{@$item->lng}}</td>
                    <td>{{@$item->city->city_name_english}}</td>
                    <td>
                        <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->city->status == 1 ? 'checked' : '' }}>
                        </td>

                    </tr>
                    @endif
                    
                    @endforeach


            </tbody>
 
        </table>


    </div>
</div>

@endsection

@section('styles')

<link href="{{asset('/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('neighborhood_enterprice.update_status',app()->getLocale()) }}',
            data: {'status': status, 'id': id},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>
@endsection