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
                            <div>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        {{ __('Add Cover') }}
                                    </button>
                    
                                  
                                </div>
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"> {{ __('Add Cover') }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                        
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('cover.post', [app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}" id="">
                                                    <label for="">{{ __('add images') }}</label>
                                                    <input type="file" multiple class="form-control" name="images[]" id="">
                                                    <br>
                                                    <input type="submit" value="Save" class="btn btn-info" id="">
                                                </form>
                                            </div>
                        
                        
                        
                                            <!-- Modal footer -->
                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">All Cover</span>
                            </h3>
                            {{-- @if (auth()->user()->hasPermission(['create-vendor']))
                                <div class="card-toolbar">
                                    <a href="{{ route('vendor.create', ['locale' => app()->getLocale()]) }}"
                                        class="btn btn-info font-weight-bolder font-size-sm">New Brands</a>
                                </div>
                            @endif --}}
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
                                                <th>{{ __('image') }}</th>
                                       
                                                <th>{{ __('Action') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($images as $item)

                                            <td><img src="{{ asset('images/vendor_cover/'.$item->image)}}" width="50" height="50" alt=""></td>
                                            
                                                
                                                <td class="pr-0 ">
                                                 


                                                    
                                                    <form method="post" style="display: inline" >
                                                        <button type="button"onclick="performdelete('{{ $item->id }}')" class="btn btn-icon btn-light btn-hover-primary btn-sm"><span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                                        </span> </button>
                                                        </form>
                                                </td>
                                                </tr>
                                            @endforeach


                                        </tbody>

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
                var url = '{{ route('vendor_cover.destroy', [':id', 'locale' => app()->getLocale()]) }}';
                url = url.replace(':id', id);


                confirmDestroy(url)
            }
        </script>
    @endsection
