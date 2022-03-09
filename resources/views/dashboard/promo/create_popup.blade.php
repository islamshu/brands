@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Pop up') }}
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
                <div class="form-group col-md-6 Enterprise" >
                        <label>{{ __('Type Show') }}:</label>
                        <select class="form-control form-control-solid " name="type_show"
                            id="type_show">

                            <option value="" selected disabled>{{'chose'}}</option>
                            <option value="image">{{ __('image') }}</option>
                            <option value="text">{{ __('text') }}</option>

                        </select>
                </div>
               
                
                <div class="form-group col-md-6 text" style="display: none">
                    <label>{{ __('Text') }}:</label>
                    <textarea name="text" id="text" class="form-control" rows="2"></textarea>
                
                </div>
                <div class="form-group col-md-6 image" style="display: none">
                    <label>{{ __('Image') }}:</label>
                    <input type="file" name="image" id="image" class="form-control form-control-solid"
                         required />
                </div>
                <div class="form-group col-md-6 Enterprise" >
                    <div class="Enterprise">
                        <label>{{ __('Home/Category') }}:</label>
                        <select class="form-control form-control-solid " name="show_as"
                            id="show_as">

                            <option value="" selected disabled>{{'chose'}}</option>
                            <option value="brand">{{ __('brand') }}</option>
                            <option value="home">{{ __('home') }}</option>
                            <option value="category">{{ __('category') }}</option>
                    

                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6 categoty_id" style="display: none" >
                    <div class="Enterprise">
                        <label>{{ __('category') }}:</label>
                        <select class="form-control form-control-solid " name="categoty_id"
                            id="categoty_id">

                            <option value="" selected disabled>{{'chose'}}</option>
                            @foreach ($categorys as $item)
                            <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6 vendor_id" style="display: none" >
                    <div class="">
                        <label>{{ __('Brands') }}:</label>
                        <select class="form-control form-control-solid " name="vendor_id"
                            id="vendor_id">

                            <option value="" selected disabled>{{'chose'}}</option>
                            @foreach ($brands as $item)
                            <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6 " >
                    <label>{{ __('Type Show') }}:</label>
                    <select class="form-control form-control-solid " name="show_for"
                        id="show_for">

                        <option value="" selected disabled>{{'chose'}}</option>
                        <option value="piad">{{ __('piad') }}</option>
                        <option value="trial">{{ __('trial') }}</option>
                        <option value="free">{{ __('free') }}</option>
                        <option value="all">{{ __('all') }}</option>
                    </select>
            </div>
            </div>
            <div class="row">
              
                <div class="form-group col-md-6">
                    <label>{{ __('Appears for a time') }}:</label>
                    <select class="form-control form-control-solid restricted" name="num_show" id="num_show">
                        <option value="" selected disabled>{{'chose'}}</option>

                        <option value="once">{{ __('once') }}</option>
                        <option value="every_time">{{ __('every_time') }}</option>
                        <option value="hour">{{ __('hour') }}</option>

                    </select>
                </div>
          
                
                <div class="form-group col-md-6 hour" style="display: none">
                    <label>{{ __('Nubmer of Hour') }}:</label>
                    <input type="number" name="number_of_hour" id="number_of_hour" class="form-control form-control-solid"
                          />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 " >
                    <label>{{ __('start date') }}:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-solid"
                          />
                </div>
                <div class="form-group col-md-6 " >
                    <label>{{ __('end date') }}:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-solid"
                          />
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
<script>
    $(document).ready(function () {

        $(document).on('change', '.enterprise', function () {
            // console.log("hmm its change");

            var cat_id = $(this).val();
            // console.log(cat_id);
            var div = $(this).parent();

            var op = " ";

            $.ajax({
                type: 'get',
                url: "{{route('countriesAjax',['locale'=>app()->getLocale()])}}",
                data: {
                    'id': cat_id
                },
                success: function (data) {
                    $('#country_id').html(new Option('choose country', '0'));
                    for (var i = 0; i < data.length; i++) {

                        $('#country_id').append(new Option(data[i].country.country_name_ar,
                            data[i].country.id));

                    }
                },
                error: function () {

                }
            });
        });
    });

</script>
<script>
  $('#sub_type').on('change', function() {
            let val = this.value;
            if (val == 'Enterprise') {
                $('.Enterprise').css("display", "block")
                $('.Vendor').css("display", "none")

            } else if (val == 'Vendor') {
                $('.Enterprise').css("display", "none")
                $('.Vendor').css("display", "block")

            }

        });

</script>
<script>
    var avatar4 = new KTImageInput('kt_image_4');

    avatar4.on('cancel', function (imageInput) {
        swal.fire({
            title: 'Image successfully canceled !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar4.on('change', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar4.on('remove', function (imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

</script>
{{-- <script>
    var avatar5 = new KTImageInput('kt_image_5');

    avatar5.on('cancel', function (imageInput) {
        swal.fire({
            title: 'Image successfully canceled !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar5.on('change', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar5.on('remove', function (imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

</script> --}}
<script>
      $("#show_as").change(function () {
        var paid = $(this).children("option:selected").val();
        if (paid == "category") {
            $('.categoty_id').show();
            $('.vendor_id').hide();
           
        } else if(paid == "home"){
            $('.vendor_id').hide();
            $('.categoty_id').hide();
       
    } else if(paid == "brand"){
            $('.vendor_id').show();
            $('.categoty_id').hide();
        
    } 
    });
    $("#num_show").change(function () {
        var paid = $(this).children("option:selected").val();
        if (paid == "hour") {
            $('.hour').show();
      
           
        } else {
            $('.hour').hide();
        }  
    
    });
    
    $("#type_show").change(function () {
        var paid = $(this).children("option:selected").val();
        if (paid == "image") {
            $('.image').show();
            $('.text').hide();

        } else if(paid == "text"){
            $('.text').show();
            $('.image').hide();

        }
    });

    
    $("#type").change(function () {
        var paid = $(this).children("option:selected").val();
        if (paid == "vendor") {
            $('.vendor_id').show();
            $('.branch_id').hide();
            $('.link').hide();
        } else if(paid == "branch"){
            $('.vendor_id').hide();
            $('.branch_id').show();
            $('.link').hide();   
       
    } else if(paid == "link"){
            $('.vendor_id').hide();
            $('.branch_id').hide();
            $('.link').show();   
        
    } else if(paid == "image"){
            $('.vendor_id').hide();
            $('.branch_id').hide();
            $('.link').hide();   
        }
    });
</script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    function performStore() {
        let formData = new FormData();

        formData.append('show_as', document.getElementById('show_as').value);
        formData.append('start_date', document.getElementById('start_date').value);
        formData.append('end_date', document.getElementById('end_date').value);
        formData.append('num_show', document.getElementById('num_show').value);

        formData.append('type_show', document.getElementById('type_show').value);
        formData.append('show_for', document.getElementById('show_for').value);

        
        if (document.getElementById('image') != null) {
            formData.append('image', document.getElementById('image').files[0]);
        }
        if (document.getElementById('text') != null) {
            formData.append('text', document.getElementById('text').value);
        }

        
        if (document.getElementById('categoty_id') != null) {
            formData.append('categoty_id', document.getElementById('categoty_id').value);
        }
        if (document.getElementById('vendor_id') != null) {
            formData.append('vendor_id', document.getElementById('vendor_id').value);
        }
        if (document.getElementById('number_of_hour') != null) {
            formData.append('number_of_hour', document.getElementById('number_of_hour').value);
        }
       
   
     



    
        store("{{ route('store_item',[app()->getLocale(),'popup',$city_id]) }}", formData)

    }

</script>
@endsection
