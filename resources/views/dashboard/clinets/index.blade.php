@extends('layout.default')
@section('styles')
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #abb9ac;
        }

    </style>
@endsection
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Users') }}</h2>

            @if (Session::has('success'))
                <div class="row mr-2 ml-2">
                    <button type="text" class="btn btn-lg btn-block btn-outline-success btn-success white mb-2"
                        id="type-error">{{ Session::get('success') }}
                    </button>
                </div>
            @endif

            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('email') }}</th>
                        {{-- <th>{{ __('acount status') }}</th> --}}

                        <th>{{ __('last Login Date') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($type == 'subs')
                        @foreach ($clinets as $item)
                            <td>{{ $item->client->name }}</td>
                            <td>{{ $item->client->phone }}</td>
                            <td>{{ $item->client->email }}</td>
                            {{-- <td>{{ $item->client->type_of_subscribe }}</td> --}}

                            <td>{{ $item->client->last_login }}</td>
                            <td class="pr-0 text-left">



                                <a href="{{ route('clinets.show', [app()->getLocale(), $item->client->id]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <i class="fa fa-eye"> </i>
                                </a>




                            </td>
                            </tr>
                        @endforeach
                    @elseif($type == 'client')
                        @foreach ($clinets as $item)
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->last_login }}</td>
                            <td class="pr-0 text-left">
                                @if (auth()->user()->isAbleTo(['create-client']))

                                <div class="dropdown">
                                    <button class="dropbtn">{{ __('Action') }}</button>
                                    <div class="dropdown-content">
                                        <a
                                            href="{{ route('clinets.show', [app()->getLocale(), $item->id]) }}">{{ __('show') }}</a>
                                        <a data-toggle="modal" data-target="#myModal"
                                            onclick="make('{{ $item->id }}')">Send Notofication</a>
                                        
                                        <a data-toggle="modal" data-target="#addSub"
                                            onclick="makenew_fun({{ $item->id }})">Add Subscribe</a>

                                    </div>
                                    @endif


                                    {{-- <a href="{{ route('clinets.show', [app()->getLocale(), $item->id]) }}"
                            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                            <i class="fa fa-eye"> </i>
                        </a> --}}




                            </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>

            </table>


        </div>
    </div>
    <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Send Notofication') }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="addToCart-modal-body">
                    <div class="c-preloader text-center p-3">
                        <i class="las la-spinner la-spin la-3x"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn ok">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fase" id="addSub" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Add Subscribe') }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="addToCart-modal-body_sub">
                    <div class="c-preloader text-center p-3">
                        <i class="las la-spinner la-spin la-3x"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn ok">Ok</button>
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
        function make(id) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('send_notification', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },

                success: function(data) {

                    $('#addToCart-modal-body').html(data);


                }
            });

        }
        function makenew_fun(id) {
            $("#addSub").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('add_sub_to_client', app()->getLocale()) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },

                success: function(data) {

                    $('#addToCart-modal-body_sub').html(data);


                }
            });

        }

        

        function performdelete(id) {
            var url = '{{ route('offers.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection
