@extends('layout.default')
@section('content')
    <div class="
card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div style="float:right;">
                <a href="{{ route('general_notofication.create',app()->getLocale()) }}" class="btn btn-info">{{ __('Create new notofication') }}</a>
            </div>
            <br>
            <h2 class="mb-3">{{ __('All Notofication') }}</h2>
            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Body') }}</th>
                        <th>{{ __('vendor') }}</th>
                        <th>{{ __('offer') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($notofications as $item)
                        <tr>
                            <td>{{ @$item->title_en }}</td>
                            <td>{{ @$item->body_en }}</td>
                            <td>{{ @$item->vendor->name_en != null ? @$item->vendor->name_en : '-'  }}</td>
                            <td>{{ @$item->offer->name_en != null ? @$item->offer->name_en : '-'  }}</td>                        </tr>
                    @endforeach


                </tbody>

            </table>


        </div>
    </div>

@endsection

@section('styles')

    <link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>


    </script>
    <script>
        function performdelete(id) {
            var url = '{{ route('currency.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
