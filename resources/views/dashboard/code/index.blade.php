@extends('layout.default')
@section('content')
    <div class="card card-docs mb-2">
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('All Code') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('name') }}</th>
                        <th>{{ __('packege name') }}</th>
                        <th>{{ __('Expire') }}</th>
                        <th>{{ __('number of codes') }}</th>
                        <th>{{ __('Used Code') }}</th>
                        <th>{{ __('Not Used Code') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $code)
                    @if(app()->getLocale() == 'ar')
                        <td>{{ $code->name_ar }}</td>
                        <td>{{ @$code->sub->name_ar }}</td>
                        @else
                        <td>{{ $code->name_en }}</td>
                        <td>{{ @$code->sub->name_en }}</td>
                        @endif
                        <td>{{ $code->start_at }}
                        <br>
                        {{ $code->end_at }}
                    </td>
                        <td>  <a href="{{ route('code.show', [ $code->id, 'locale' => app()->getLocale()]) }}">{{ $code->number_of_code }}</a> </td>
                        
                        @php
                            $used= App\Models\CodeSubscription::where('sub_id',$code->sub_id)->where('is_used',1)->count();

                            $remain = App\Models\CodeSubscription::where('sub_id',$code->sub_id)->where('is_used',0)->count();
                        @endphp
                        <td> <a href="{{ route('used_code', [ $code->id, 'locale' => app()->getLocale()]) }}"> {{ $used }} </a></td>
                        <td> <a href="{{ route('not_used_code', [ $code->id, 'locale' => app()->getLocale()]) }}"> {{ $remain }}</a></td>
                        <td>
                            @if (auth()->user()->isAbleTo(['update-activition_code']))

                            <input type="checkbox" data-id="{{ $code->id }}" name="status" class="js-switch" {{ $code->status ==  1 ? 'checked' : '' }}>
                            @endif
                        </td>
                        <td class="pr-0 text-left">
                            @if (auth()->user()->isAbleTo(['update-activition_code']))

                            
                                <a href="{{ route('code.edit', [ $code->id, 'locale' => app()->getLocale()]) }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                 <i class="fa fa-edit"></i>
                                </a>
                                @endif
                                @if (auth()->user()->isAbleTo(['delete-activition_code']))


                                <form method="post" style="display: inline">
                                    <button type="button" onclick="performdelete('{{ $code->id }}')"
                                        class="btn btn-icon btn-light btn-hover-primary btn-sm"><span
                                            class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <path
                                                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                        fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
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
