@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Sliders') }}</h2>
            @if (auth()->user()->isAbleTo(['create-promotion']))

            <div class="div" style="float: right">
                <a href="{{ route('create_item', [ app()->getLocale(),'homeslider',$city_id]) }}" class="btn btn-info">{{ __('create home slider') }}</a>
            </div>
            @endif
            <br>
            <div class="mt-10">

                

                <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('Title ar') }}</th>
                        <th>{{ __('Title en') }}</th>
                        <th>{{ __('Color') }}</th>
                        <th>{{ __('City') }}</th>
                        <th>{{ __('Sort') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premotions as $item)

                    <td>{{ $item->title_ar }}</td>
                    <td>{{ $item->title_en }}</td>
                    <td><input type="color" readonly="true" id="input_color" name="color" onchange="color({{ $item->id }})" ondblclick="this.readOnly='';"  value="{{ $item->color }}"></td>
                    {{-- <td ><button style="background: {{ $item->color  }}">{{ $item->color }}</button></td>   --}}
                    <td>{{ $item->city->city_name_english }}</td>
                    <td>{{ $item->sort }}</td>

                        <td class="pr-0 text-left">
                            @if (auth()->user()->isAbleTo(['update-promotion']))

                            <a href="{{ route('offer_slider', [app()->getLocale(),$item->id,$city_id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-plus"></i>
                            </a>
                            @endif
                            @if (auth()->user()->isAbleTo(['delete-promotion']))

                            <form method="post" style="display: inline">
                                <button type="button" onclick="performdelete('{{ $item->id }}')"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm"><span
                                        class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                       <i class="fa fa-trash"></i>
                                        <!--end::Svg Icon-->
                                    </span>
                                </button>
                            </form>

                            @endif
                               

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
          
            function color(id){
                var color = $('#input_color').val();
                var id = id;
                $.ajax({
                        type: 'get',
                        url: "{{ route('change_color', ['locale' => app()->getLocale()]) }}",
                        data: {
                            'color': color,
                            'id': id,
                        },
                        success: function(data) {
                         alert('change succffuly')
                        },
                        error: function() {

                        }
                    });

            }

            function performdelete(id) {
                var url = '{{ route('code.destroy', [':id', 'locale' => app()->getLocale()]) }}';
                url = url.replace(':id', id);


                confirmDestroy(url)
            }
        </script>
    @endsection
