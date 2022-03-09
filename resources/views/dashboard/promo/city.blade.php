@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('Select City') }}</h2>
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9 mt-10">
                @foreach ($city as $cou)

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="{{ route('get_elemet_by_type', [app()->getLocale(),$type, $cou->city->id ]) }}" class="text-gray-800 text-hover-primary ">
                                <!--begin::Image-->
                                <div class=" symbol-75px mb-5 text-center">
                                    <img src="{{  $cou->city->image  }}" style="    max-width: 150px;" alt="">
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bolder mb-2">{{ $cou->city->city_name_english }}</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
               @endforeach
            </div>


            {{-- <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('name') }}</th>
                        <th>{{ __('image') }}</th>
                        <th>{{ __('Action') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($city as $cou)

                        <td>{{ $cou->city->city_name_english }}</td>
                        <td>{{ $cou->city->city_name_english}}</td>
                     
                        <td class="pr-0 text-left">
                                <a href="{{ route('get_city_for_country', [ $cou->city->id,$type, 'locale' => app()->getLocale()]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                      <i class="fa fa-eye"></i>
                                    </span>
                                </a>

                               

                        </td>
                        </tr>
                    @endforeach


                </tbody>

            </table> --}}


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
            var url = '{{ route('code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
