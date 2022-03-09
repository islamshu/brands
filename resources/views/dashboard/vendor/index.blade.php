@extends('layout.default')
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile 2-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->

                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">

                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Brands</span>
                            </h3>
                            @if (auth()->user()->isAbleTo(['create-vendor']))
                                <div class="card-toolbar">
                                    <a href="{{ route('vendor.create', ['locale' => app()->getLocale()]) }}"
                                        class="btn btn-info font-weight-bolder font-size-sm">New Brands</a>
                                </div>
                            @endif
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="card card-custom gutter-b">
                                <div class="card-body">
                                    <!--begin::Details-->
                                    <table
                                        class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                                        id="kt_datatable">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th class="pr-0 text-center">{{ __('image') }}</th>
                                                <th class="pr-0 text-center">{{ __('name') }}</th>
                                                {{-- <th class="pr-0 text-center">{{ __('Email') }}</th> --}}
                                                {{-- <th>{{ __('commercial_registration_number') }}</th> --}}
                                                {{-- <th class="pr-0 text-center">{{ __('Phone') }}</th> --}}
                                                <th class="pr-0 text-center">{{ __('Branch number') }}</th>
                                                <th class="pr-0 text-center">{{ __('Category') }}</th>
                                                <th class="pr-0 text-center">{{ __('Created at') }}</th>
                                                <th class="pr-0 text-center">{{ __('Status') }}</th>
                                                <th class="pr-0 text-center">{{ __('Action') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vendors as $item)

                                                <td class="pr-0 text-center"><img
                                                        src="{{ asset('images/brand/' . $item->image) }}" width="50"
                                                        height="50" alt=""></td>
                                                <td class="pr-0 text-center">
                                                    @if (app()->getLocale() == 'en')
                                                        {{ $item->name_en }}
                                                    @elseif(app()->getLocale() == "ar")
                                                        {{ $item->name_ar }}
                                                    @endif
                                                </td>
                                                {{-- <td class="pr-0 text-center">{{ @$item->user->email }}</td> --}}
                                                {{-- <td>{{ $item->commercial_registration_number }}</td> --}}
                                                {{-- <td class="pr-0 text-center">{{ $item->mobile }}</td> --}}
                                                <td class="pr-0 text-center">{{ $item->branches->count() }}</td>
                                                <td class="pr-0 text-center"><button data-toggle="modal"
                                                        data-target="#myModal" class="btn btn-outline-primary"
                                                        onclick="make('{{ $item->id }}')">{{ __('Category') }}</button>
                                                </td>



                                                <td class="pr-0 text-center">{{ $item->created_at->format('M d Y') }}
                                                </td>
                                                <td>
                                                    <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 'active' ? 'checked' : '' }}>
                                                    </td>
                                                <td class="pr-0 text-center">
                                                    @if (auth()->user()->isAbleTo(['update-vendor']))

                                                    <a href="{{ route('vendor.edit', [ 'locale' => app()->getLocale(),'vendor' => $item->id]) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endif

                                                    <a href="{{ route('vendor.show', [ 'locale' => app()->getLocale(),'vendor' => $item->id]) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                  




                                                    @if (auth()->user()->isAbleTo(['delete-vendor']))

                                                    <form method="post" style="display: inline">
                                                        <button type="button"
                                                            onclick="performdelete('{{ $item->id }}')"
                                                            class="btn btn-icon btn-light btn-hover-primary btn-sm"><span
                                                                class="svg-icon svg-icon-md svg-icon-primary">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                                <i class="fa fa-trash"></i>
                                                                <!--end::Svg Icon-->
                                                            </span> </button>
                                                    </form>
                                                    @endif
                                                    <a href="{{ route('cover.show', [app()->getLocale(), $item->id]) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <i class="fa fa-image"></i>
                                                    </a>
                                                </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                        <div class="modal fase" id="myModal" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            {{ __('Categories') }}</h5>

                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div id="addToCart-modal-body">
                                                        <div class="c-preloader text-center p-3">
                                                            <i class="las la-spinner la-spin la-3x"></i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn ok">Ok</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Advance Table Widget 5-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Profile 2-->
            </div>
            <!--end::Container-->
        </div>
    @endsection
    @section('scripts')
        <script>
            $(function() {

            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="{{ asset('crudjs/crud.js') }}"></script>
        <script>
            function performdelete(id) {
                var url = '{{ route('vendor.destroy', [':id', 'locale' => app()->getLocale()]) }}';
                url = url.replace(':id', id);


                confirmDestroy(url)
            }
        </script>
        <script>
            function make(id) {
                $("#myModal").show();

                // $('#staticBackdrop').modal();
                $('.c-preloader').show();

                $.ajax({
                    type: 'post',
                    url: "{{ route('showpostModal', app()->getLocale()) }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id
                    },

                    success: function(data) {

                        $('#addToCart-modal-body').html(data);


                    }
                });

            }
        </script>
        <script>
            $(document).ready(function(){
            $('.js-switch').change(function () {
                let status = $(this).prop('checked') === true ? 'active' : 'deactive';
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('vednor.update.status',app()->getLocale()) }}',
                    data: {'status': status, 'user_id': userId},
                    success: function (data) {
                        console.log(data.message);
                    }
                });
            });
        });
        </script>
    @endsection
