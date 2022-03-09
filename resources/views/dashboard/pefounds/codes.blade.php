@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('Reference numbers') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('code') }}</th>
                        <th>{{ __('status') }}</th>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $item)

                        <td>{{ $item->code }}</td>
                        <td>@if ($item->is_user == 0){{ __('Not Use') }} @else {{ __('Used') }} @endif </td>

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
        function performdelete(id) {
            var url = '{{ route('subscription.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
        $("#kt_datatable").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]

        });
    </script>

@endsection
