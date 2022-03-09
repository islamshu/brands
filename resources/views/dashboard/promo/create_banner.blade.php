@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Create Banner') }}
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                </div>
            </div>
        </div>
        <form class="form" method="post" id='create_form' enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label>{{ __('Link') }}: ({{ __('optional') }})</label>
                        <input type="text" name="link" id="link" class="form-control form-control-solid" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label>{{ __('show affter') }}:</label>
                        <select class="form-control" name="homeslider_id" id="homeslider_id">
                            <option value="">{{ __('Choose') }}</option>
                            @foreach ($homeslider as $item)
                                <option value="{{ $item->id }}">{{ $item->title_en }}</option>
                            @endforeach

                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label>{{ __('Start at') }}:</label>
                        <input type="date" name="start_at" id="start_at" class="form-control form-control-solid" />
                    </div>
                    <div class="form-group col-md-6 ">
                        <label>{{ __('End at') }}:</label>
                        <input type="date" name="end_at" id="end_at" class="form-control form-control-solid" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label>{{ __('image') }}:</label>
                        <input type="file" name="image" id="image" class="form-control form-control-solid" />
                    </div>
                    
                </div>
            </div>

    </div>


    <div class="card-footer">
        <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
    </div>

    </form>
    </div>
    </div>
@endsection


@section('scripts')



    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function performStore() {
            let formData = new FormData();
            if (document.getElementById('link') != null) {

                formData.append('link', document.getElementById('link').value);
            }

            formData.append('homeslider_id', document.getElementById('homeslider_id').value);
            formData.append('start_at', document.getElementById('start_at').value);
            formData.append('end_at', document.getElementById('end_at').value);
            formData.append('image', document.getElementById('image').files[0]);
            store("{{ route('store_item', [app()->getLocale(), 'banner', $city_id]) }}", formData)

        }
    </script>
@endsection
