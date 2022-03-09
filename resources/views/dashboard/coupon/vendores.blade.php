@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Vendors') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('branch number') }}</th>
                        <th>{{ __('offer number') }}</th>
                        <th>{{ __('Active Offer') }}</th>
                        <th>{{ __('Paid Offer') }}</th>
                        <th>{{ __('Free Offer') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $item)
                        <td><img src="{{ asset('images/brand/'.$item->image) }}" width="50" height="50" alt=""></td>
                        <td>{{ $item->name_en }}</td>
                        <td>{{ $item->branches->count() }}</td>
                        <td>{{ $item->offers->count() }}</td>
                        <td>{{App\Models\Coupon::where('vendor_id',$item->id)->where('end_at','>',\Carbon\Carbon::now())->where('start_at','<',\Carbon\Carbon::now())->count()}}</td>
                        <td>{{App\Models\Coupon::where('vendor_id',$item->id)->where('member_type','paid')->count()}}</td>
                        <td>{{App\Models\Coupon::where('vendor_id',$item->id)->where('member_type','free')->count()}}</td>
          

                        <td class="pr-0 text-left">


                               
                                <a href="{{ route('vendor.get_copoun', [ app()->getLocale(),$item->id]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <i class="fa fa-eye"> </i>
                                </a>
                     

                           

                        </td>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        $(function() {
            
        });

        function performdelete(id) {
            var url = '{{ route('offers.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
