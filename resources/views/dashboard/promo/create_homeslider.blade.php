@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Home Slider') }}
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
                <div class="form-group col-md-6 " >
                    <label>{{ __('Title ar') }}:</label>
                    <input type="text" name="title_ar" id="title_ar" class="form-control form-control-solid"
                          />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 " >
                    <label>{{ __('Title en') }}:</label>
                    <input type="text" name="title_en" id="title_en" class="form-control form-control-solid"
                          />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2 " >
                    <label>{{ __('color') }}:</label>
                    <input type="color" name="color" id="color" class="form-control form-control-solid"
                          />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2 " >
                    <label>{{ __('sort') }}:</label>
                    <input type="number" name="sort" id="sort" class="form-control form-control-solid"
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

        formData.append('title_ar', document.getElementById('title_ar').value);
        formData.append('title_en', document.getElementById('title_en').value);
        formData.append('color', document.getElementById('color').value);
        formData.append('sort', document.getElementById('sort').value);
      store("{{ route('store_item',[app()->getLocale(),'homeslider',$city_id]) }}", formData)

    }

</script>
@endsection
