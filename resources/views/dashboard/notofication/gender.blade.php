@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Promotion') }}</h2>
            <div class="mt-10">

                <div class="row">
                    <div class="col-md-3 bg-light-primary w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <div class=" symbol-75px mb-5 text-center">
                            <img src="https://ar.seaicons.com/wp-content/uploads/2016/05/male-icon.png" width="80" height="80" alt="">
                        </div>
                        <!--end::Svg Icon-->
                        <button data-toggle="modal" style="margin-left: 37%;"
                                                        data-target="#myModal" class="btn btn-outline-primary"
                                                        onclick="make(1)">الذكور</button>
                    </div>
                    <div class="col-md-3 bg-light-info w-100 h-100 px-6 py-8 rounded-2 mb-7 mr-7 ml-7 ">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <div class=" symbol-75px mb-5 text-center">
                            <img src="https://dewc.ca/wp-content/uploads/2018/08/symbol.png" width="80" height="80" alt="">
                        </div>
                        <!--end::Svg Icon-->
                        <button data-toggle="modal" style="margin-left: 37%;"
                                                        data-target="#myModal" class="btn btn-outline-primary"
                                                        onclick="make(2)">الاناث</button>
                    </div>
                        


                </div>
                <div class="modal fase" id="myModal" data-backdrop="static"
                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h5 class="modal-title" id="staticBackdropLabel">
                                {{ __('Send Notofication') }}</h5>

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
        <script>
            function make(id) {
                $("#myModal").show();

                // $('#staticBackdrop').modal();
                $('.c-preloader').show();

                $.ajax({
                    type: 'post',
                    url: "{{ route('gendernotofication', app()->getLocale()) }}",
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
    @endsection
