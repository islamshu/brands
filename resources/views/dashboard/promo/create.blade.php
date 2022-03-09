@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Create Code') }}
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
                    <div class="form-group col-md-6">
                        <label>{{ __('Name ar') }}:</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Name en') }}:</label>
                        <input type="text" name="name_en" id="name_en" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6 Enterprise" >
                        <div class="Enterprise">
                            <label>{{ __('Choose the package') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="sub_id"
                                id="sub_id">
                                @foreach ($subs as $item)
                                    
                              
                                <option value="{{ $item->id }}" >{{$item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Enterprise" >
                        <div class="Enterprise">
                            <label>{{ __('Type') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type"
                                id="type">
                                <option value="" selected disabled >{{ __('chose option') }}</option>

                                <option value="single" >{{ __('single') }}</option>
                                <option value="multi" >{{ __('multi') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 typecode" >
                        <div class="Enterprise">
                            <label>{{ __('type of code') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_code"
                                id="type_code">
                                <option value="" selected disabled >{{ __('chose option') }}</option>

                                <option value="auto" >{{ __('auto') }}</option>
                                <option value="manual" >{{ __('manual') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 code" style="display: none">
                        <div class="code">
                            <label>{{ __('code') }}:</label>
                          <input type="text" name="code" class="form-control" id="code">
                        </div>
                    </div>
                    <div class="form-group col-md-6 codenumber" style="display: none">
                        <label>{{ __('number of code') }}</label>
                        <input type="integer" class="form-control form-control-solid form-control-lg"
                            name="number_of_code" id="number_of_code" placeholder="number_of_code"  />
                    </div>
                    <div class="form-group col-md-6 Enterprise" >
                        <div class="Enterprise">
                            <label>{{ __('Typeof limit') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_of_limit"
                                id="type_of_limit">
                                <option value="" selected disabled >{{ __('chose option') }}</option>

                                <option value="limit" >{{ __('limit') }}</option>
                                <option value="unlimit" >{{ __('unlimit') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="row timelimit"style="display: none">
                    <div class="form-group col-md-6">
                        <label>{{ __('Start date') }}</label>
                        <input type="date" class="form-control form-control-solid form-control-lg"
                            name="start_at" id="start_time" placeholder="start_time"  />
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="form-group col-md-6">
                        <label>{{ __('End date') }}</label>
                        <input type="date" class="form-control form-control-solid form-control-lg"
                            name="end_at" id="end_time" placeholder="end_time"  />
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
    <script>
            $('#type').on('change', function() {

            var type = $('#type').val();

            var typeOfCode = $('#type_code').val();
            if(type == 'multi'){
                $('.codenumber').css("display", "block")
                $('.typecode').css("display", "none")

            }else{
                $('.codenumber').css("display", "none")
                $('.typecode').css("display", "block")

            }
    

        });
            $('#type_code').on('change', function() {

            var type = $('#type').val();
            var typeOfCode = $('#type_code').val();

            if(type == 'single' &&  typeOfCode == 'manual'){
            $('.code').css("display", "block")
            $('.codenumber').css("display", "none")

        }else if(type == 'multi'){
                $('.codenumber').css("display", "none")
                $('.typecode').css("display", "none")

            }else{
            $('.code').css("display", "none")
            $('.codenumber').css("display", "block")

            }

        });
        $('#type_of_limit').on('change', function() {

            var type = $('#type_of_limit').val();

            if(type == 'limit'){
            $('.timelimit').css("display", "inline")

            }else{
            $('.timelimit').css("display", "none")

            }

            });

        
 
   
 
   
    </script>
 

 
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function performStore() {
            let formData = new FormData();
            
            formData.append('name_ar', document.getElementById('name_ar').value);
            formData.append('name_en', document.getElementById('name_en').value);
            formData.append('sub_id', document.getElementById('sub_id').value);
            formData.append('type', document.getElementById('type').value);
            formData.append('type_code', document.getElementById('type_code').value);
            formData.append('type_of_limit', document.getElementById('type_of_limit').value);


            if (document.getElementById('number_of_code') != null) {

                formData.append('number_of_code', document.getElementById('number_of_code').value);
            }
            if (document.getElementById('code') != null) {

            formData.append('code', document.getElementById('code').value);
            }
           
            if (document.getElementById('start_at') != null) {
                formData.append('start_at', document.getElementById('start_at').value);
            }
            if (document.getElementById('end_at') != null) {
                formData.append('end_at', document.getElementById('end_at').value);
            }
       
                store("{{ route('code.store', ['locale' => app()->getLocale()]) }}", formData);

            }
    </script>
@endsection
