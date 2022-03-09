@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Code') }}</h2>
            @if(Route::currentRouteName() == 'used_code' || Route::currentRouteName() == 'not_used_code' )
            @if(Route::currentRouteName() == 'used_code')
            <a href="{{ route('export_code',[app()->getLocale(),'used', $code_id]) }}" class="btn btn-primary">{{ __('Export') }}</a>
            @else
            <a href="{{ route('export_code',[app()->getLocale(),'not', $code_id]) }}" class="btn btn-primary">{{ __('Export') }}</a>

            @endif
            @endif
            @if(Route::currentRouteName() == 'code.show')
            <a href="{{ route('export_code',[app()->getLocale(),'all', $code_id]) }}" class="btn btn-primary">{{ __('Export') }}</a>
            @endif


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('code') }}</th>
                        <th>{{ __('is used') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $item)
                        <td>{{ $item->code }}</td>
                        <td>
                            @if($item->is_used == '0')
                            <i class="fa fa-times fa-2x " style="color: red" aria-hidden="true"></i>
                            @else

                            <i class="fa fa-check fa-2x " style="color: green" aria-hidden="true"></i>
                        @endif
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
        $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0 ;
            let id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('code.update_status',app()->getLocale()) }}',
                data: {'status': status, 'id': id},
                success: function (data) {
                    console.log(data.message);
                }
            });
        });
    });
    </script>
    <script>
        $(function() {
            
        });

        function performdelete(id) {
            var url = '{{ route('code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
