@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            FAQS 
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <div>
    <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
    >
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>{{ __('sort') }}</th>
            <th>{{ __('question') }}</th>
            <th>{{ __('Answer') }}</th>
          
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faqs as $item)
        
        
         <tr>
             {{-- {{ dd($item) }} --}}
             
             
           
            <td>{{$item->sort}}</td>
            @if(app()->getLocale() == 'ar')

            <td>{{$item->qus_ar}}</td>
            <td>{!! $item->answer_ar !!}</td>
            @else 
            <td>{{$item->qus_en}}</td>
            <td>{!! $item->answer_en !!}</td>
            @endif
            <td>
                @if (auth()->user()->isAbleTo(['delete-page']))

                <form method="post" style="display: inline">
                    <button type="button" onclick="performdelete({{ $item->id }})"
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
           
       
            @endforeach


    </tbody>
 
</table>
</div>
@if (auth()->user()->isAbleTo(['create-page']))

    <form class="form" method="post" method="{{ route('faqs.store',app()->getLocale()) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                {{-- <div class="form-group col-md-12">
                    <select class="form-control select2 vendor" id="kt_select2_1" name="param">
                        <option value='null'>{{ __('chose Vendor') }}</option>
                        @foreach ($vendor as $item)
                        <option value={{$item->id}}>{{$item->name_en}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group col-md-6">
                    <label> {{ __('question ar') }} :</label>
                    <input type="text" name="qus_ar" id="qus_ar" class="form-control form-control-solid"
                        placeholder="Enter question" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('question en') }} :</label>
                    <input type="text" name="qus_en" id="qus_en" class="form-control form-control-solid"
                        placeholder="Enter question" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Answer ar') }} :</label>
                    <textarea name="answer_ar" class="form-control" required id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Answer en') }} :</label>
                    <textarea name="answer_en" class="form-control" required id="" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label>{{ __('sort') }} :</label>
                    <input type="number" name="sort" id="sort" class="form-control form-control-solid"
                        placeholder="Enter sort" required />
                </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
            </div>
    </form>
    @endif
</div>
</div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>

    <script>
       

        function performdelete(id) {
            var url = '{{ route('faqs.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
@endsection