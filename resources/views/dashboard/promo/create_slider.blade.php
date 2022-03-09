@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Slider') }}
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
                <div class="form-group col-md-7">
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
            </div>
            <div class="row">
              
                <div class="form-group col-md-6">
                    <label>{{ __('type') }}:</label>
                    <select class="form-control form-control-solid restricted" name="type" id="type">
                        <option value="" selected disabled>{{'chose'}}</option>

                        <option value="vendor">{{ __('brand') }}</option>
                        <option value="branch">{{ __('branch') }}</option>
                        <option value="link">{{ __('link') }}</option>
                        <option value="image">{{ __('image') }}</option>

                    </select>
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
                <div class="form-group col-md-6 branch_id" style="display: none" >
                    <div class="">
                        <label>{{ __('Branch') }}:</label>
                        <select class="form-control form-control-solid " name="branch_id"
                            id="branch_id">

                            <option value="" selected disabled>{{'chose'}}</option>
                            @foreach ($branchs as $item)
                            <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6 link" style="display: none">
                    <label>{{ __('link') }}:</label>
                    <input type="url" name="link" id="link" class="form-control form-control-solid"
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
           
        } else{
            $('.categoty_id').hide();
           
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

        formData.append('image', document.getElementById('image').files[0]);
        formData.append('show_as', document.getElementById('show_as').value);
        formData.append('type', document.getElementById('type').value);
        formData.append('start_date', document.getElementById('start_date').value);
        formData.append('end_date', document.getElementById('end_date').value);
        
        
        if (document.getElementById('categoty_id') != null) {
            formData.append('categoty_id', document.getElementById('categoty_id').value);
        }
        if (document.getElementById('vendor_id') != null) {
            formData.append('vendor_id', document.getElementById('vendor_id').value);
        }
        if (document.getElementById('branch_id') != null) {
            formData.append('branch_id', document.getElementById('branch_id').value);
        }
        
        if (document.getElementById('type') != null) {
            formData.append('type', document.getElementById('type').value);
        }
     



    
        store("{{ route('store_item',[app()->getLocale(),'slider',$city_id]) }}", formData)

    }

</script>
@endsection
