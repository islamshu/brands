@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <div class="mt-10">

                <div class="row">
                    <div class="col-md-3 bg-light-primary w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                            {{-- <i class=" fa-4x"></i> --}}
                            <img src="https://pbs.twimg.com/profile_images/1422535875901149186/J5_LSmtJ_400x400.jpg" width="80" height="80" alt="">
                        </span>
                        <!--end::Svg Icon-->
                        <a href="{{ route('sms_config.index',[app()->getLocale()]) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">SMS Config</a>
                    </div>
     
            
                <div class="col-md-3 bg-light-info px-6 py-8 rounded-2 mb-7 mr-7 ml-7">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                        {{-- <i class="fa fa-user fa-4x"></i> --}}
                       <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Firebase_Logo.png/800px-Firebase_Logo.png" height="80" alt="">
                    </span>
                    <!--end::Svg Icon-->
                    <a href="{{ route('firebase_config.index',[app()->getLocale()]) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">Firebase Config  </a>
                </div>

                <div class="col-md-3 bg-light-warning px-6 py-8 rounded-2 mb-7 mr-7 ml-7">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">
                        {{-- <i class="fa fa-user fa-4x"></i> --}}
                       <img src="https://mobikul.com/wp-content/uploads/2019/03/myfatoorah-com.png" height="80" alt="">
                    </span>
                    <!--end::Svg Icon-->
                    <a href="{{ route('myfatoorah_config.index',[app()->getLocale()]) }}" style="font-weight: bold;" class="svg-icon svg-icon-3x text-center svg-icon-danger d-block my-2">Myfatoorah Config  </a>
                </div>


                
     
        
        
        </div>

            {{-- <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('name') }}</th>
                        <th>{{ __('country code') }}</th>
                        <th>{{ __('alph') }}</th>
                        <th>{{ __('Action') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $cou)

                        <td>{{ $cou->country->country_name_en }}</td>
                        <td>{{ $cou->country->country_code }}</td>
                        <td>{{ $cou->country->alph3code }}</td>
                        <td class="pr-0 text-left">
                                <a href="{{ route('get_city_for_country', [ $cou->country->id, 'locale' => app()->getLocale()]) }}"
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
