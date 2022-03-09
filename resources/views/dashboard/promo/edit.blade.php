@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Edit Code') }}
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
                        <input type="text" name="name_ar" value="{{ $code->name_ar }}" id="name_ar" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Name en') }}:</label>
                        <input type="text" name="name_en" value="{{ $code->name_en }}"  id="name_en" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6 Enterprise" >
                        <div class="Enterprise">
                            <label>{{ __('Choose the package') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="sub_id"
                                id="sub_id">
                                @foreach ($subs as $item)
                                    
                              
                                <option value="{{ $item->id }}" @if($code->sub_id == $item->id) selected @endif >{{$item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 Enterprise" @if($code->type != 'multi') style="display : none"  @endif  > 
                        <div class="Enterprise">
                            <label>{{ __('Type') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type"
                                id="type">
                                <option value="" selected disabled >{{ __('chose option') }}</option>

                                <option value="single" @if($code->type == 'single') selected @endif >{{ __('single') }}</option>
                                <option value="multi" @if($code->type == 'multi') selected @endif >{{ __('multi') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 typecode" @if($code->type == 'multi') style="display:none"  @endif >
                        <div class="Enterprise">
                            <label>{{ __('type of code') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_code"
                                id="type_code">
                                <option value="" selected disabled >{{ __('chose option') }}</option>

                                <option value="auto" @if($code->type_code == 'auto') selected @endif >{{ __('auto') }}</option>
                                <option value="manual" @if($code->type_code == 'manual') selected @endif >{{ __('manual') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 code" style="display: none">
                        <div class="code">
                            <label>{{ __('code') }}:</label>
                          <input type="text" value="{{ $code->code }}" name="code" class="form-control" id="code">
                        </div>
                    </div>
                    <div class="form-group col-md-6 codenumber" @if($code->type != 'multi') style="display : none"  @endif >
                        <label>{{ __('number of code') }}</label>
                        <input type="integer" value="{{ $code->number_of_code }}" class="form-control form-control-solid form-control-lg"
                            name="number_of_code" id="number_of_code" placeholder="number_of_code"  />
                    </div>
                    <div class="form-group col-md-6 Enterprise" >
                        <div class="Enterprise">
                            <label>{{ __('Typeof limit') }}:</label>
                            <select class="form-control form-control-solid enterprise" name="type_of_limit"
                                id="type_of_limit">
                                <option value="" selected disabled >{{ __('chose option') }}</option>

                                <option value="limit" @if($code->type_of_limit == 'limit') selected @endif >{{ __('limit') }}</option>
                                <option value="unlimit" @if($code->type_of_limit == 'unlimit') selected @endif >{{ __('unlimit') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <div class="row timelimit" @if($code->type_of_limit != 'limit') style="display: none" @endif>
                    <div class="form-group col-md-6">
                        <label>{{ __('Start date') }}</label>
                        <input type="date" class="form-control form-control-solid form-control-lg"
                            name="start_at" value="{{ $code->start_at }}" id="start_at" placeholder="start_at"  />
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="form-group col-md-6">
                        <label>{{ __('End date') }}</label>
                        <input type="date" class="form-control form-control-solid form-control-lg"
                            name="end_at" value="{{ $code->end_at }}" id="end_at" placeholder="end_at"  />
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
       
                store("{{ route('update-code.code', ['locale' => app()->getLocale() , $code->id]) }}", formData);

            }
    </script>
@endsection
