@extends('layout.default')
@section('content')
<div class="card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('Reference numbers') }}</h2>


        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>{{ __('logo') }}</th>
                    <th>{{ __('Name en') }}</th>
                    <th>{{ __('total groubs') }}</th>
                    <th>{{ __('Active Codes') }}</th>
                    <th>{{ __('Deactive Codes') }}</th>
                    <th>{{ __('Action') }}</th>


                 </tr>
            </thead>
            <tbody>
                    @foreach ($vendors as $item) 
                    <td><img src="{{ asset('images/brand/'.$item->image)}}" width="50" height="50" alt=""></td>
  
                    <td>{{$item->name_en}}</td>
                    <td>{{ $item->code_permfomed->count() }}</td>
                    <td>{{ $item->code_permfomed->where('status',1)->count() }}</td>
                    <td>{{ $item->code_permfomed->where('status',0)->count() }}</td>
                    <td >

                        <a href="{{ route('vendor.get_perfomed_vendor', [app()->getLocale(),$item->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                          <i class="fa fa-eye"></i>
                        </a>
                    
                      
                       
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
<script src="{{asset('crudjs/crud.js')}}"></script>
 <script>
    
    function performdelete(id) {
        var url = '{{ route('subscription.destroy',[ ":id" ,'locale'=>app()->getLocale()]) }}';
        url = url.replace(':id', id);


        confirmDestroy(url)
    }
</script>
@endsection