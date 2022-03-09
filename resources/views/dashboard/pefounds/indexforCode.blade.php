@extends('layout.default')

@section('content')
    <div class="card card-docs mb-2">
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"> {{ __('Code perfored') }}</span>
            </h3>
            <div class="card-toolbar">
                @if (auth()->user()->isAbleTo(['create-reference']))

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    {{ __('generate groub') }}
                </button>
                @endif

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalupload">
                    {{ __('upload excel') }}
                </button>
                <form action="{{ route('download.code',app()->getLocale()) }}" style="    display: contents;" method="get">
               
                <button type="submit" class="btn btn-primary" >
                    {{ __('Download Excel') }}
                </button>
            </form>
            </div>


        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"> {{ __('generate groub') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('perfomeds.store', [app()->getLocale()]) }}" method="post">
                            @csrf
                            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}" id="">
                            <label for="">{{ __('number of codes') }}</label>
                            <input type="number" class="form-control" name="total_codes" id="">
                            <br>
                            <input type="submit" value="Save" class="btn btn-info" id="">
                        </form>
                    </div>



                    <!-- Modal footer -->

                </div>
            </div>
        </div>
        <div class="modal" id="myModalupload">
          <div class="modal-dialog">
              <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h4 class="modal-title"> {{ __('upload') }}
                      </h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <form action="{{ route('vendor.Codeimport', [app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="vendor_id" value="{{ $vendor->id }}" id="">
                          <label for="">{{ __('Upload file') }}</label>
                          <input type="file" class="form-control" name="file" id="">
                          <br>
                          <input type="submit" value="Save" class="btn btn-info" id="">
                      </form>
                  </div>



                  <!-- Modal footer -->

              </div>
          </div>
      </div>
      @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible" style="text-align: center ">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach  
                              
                      </div>
                    </div>
                </div>
                @php
                            $code = Session::get('CodePermfomed');
                            $code->delete();

                @endphp
                @endif
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
            <h2 class="mb-3">{{ __('Reference numbers') }}</h2>


            <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                id="kt_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">

                        <th>{{ __('total codes') }}</th>
                        <th>{{ __('total used codes') }}</th>
                        <th>{{ __('total unused codes') }}</th>
                        <th>{{ __('Status') }}</th>

                        <th>{{ __('Action') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendor->code_permfomed as $item)

                        <td>{{ $item->total_codes }}</td>
                        <td>{{ $item->codes->where('is_user', 1)->count() }}</td>
                        <td>{{ $item->codes->where('is_user', 0)->count() }}</td>
                        <td>
                            <input type="checkbox" data-id="{{ $item->id }}" name="status" class="js-switch" {{ $item->status == 1 ? 'checked' : '' }}>
                            </td>
                        <td>

                            <a href="{{ route('vendor.get_perfomed_vendor_code', [app()->getLocale(), $item->id]) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('vendor.get_perfomed_vendor_status', [app()->getLocale(),$item->id,1]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-circle"></i>
                              </a>
                              <a href="{{ route('vendor.get_perfomed_vendor_status', [app()->getLocale(),$item->id,0]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <i class="fa fa-square" aria-hidden="true"></i>
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
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function performdelete(id) {
            var url = '{{ route('subscription.destroy', [':id', 'locale' => app()->getLocale()]) }}';
            url = url.replace(':id', id);


            confirmDestroy(url)
        }
    </script>
    <script>
        $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let userId = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('pefromeds.update.status',app()->getLocale()) }}',
                data: {'status': status, 'user_id': userId},
                success: function (data) {
                    console.log(data.message);
                }
            });
        });
    });
    </script>
@endsection
