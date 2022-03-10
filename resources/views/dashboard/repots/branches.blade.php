@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Branches Repots') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
   
</div>
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('All Branches') }}</h2>


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">

                    <th>{{ __('Branch name') }}</th>
                    <th>{{ __('number of transaction') }}</th>
                    <th>{{ __('totla sale') }}</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($brs as $item)
              
                    <td>{{ $item->name_ar }}</td>
                    <td>{{ get_totol_trnasaction($item->id) }}</td>
                    <td>{{ get_sum_trnasaction($item->id) }}</td>
                  

                   
                    </tr>
                @endforeach
           


            </tbody>

        </table>


    </div>
</div>




@endsection

@section('scripts')

@endsection
