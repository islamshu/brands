@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Subscribe') }}
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
                @if(Auth::user()->hasRole('Admin'))
                <div class="form-group col-md-12 customer_type">
                    <div class="rule">
                        <label>{{ __('Custome Type') }}:</label>
                        <select class="form-control form-control-solid visibility" name="sub_type"
                            id="sub_type">
                            <option value="Enterprise">{{ __('Enterprise') }}</option>
                            <option value="Vendor">{{ __('Brand') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12 Enterprise" style="display: none">
                    <div class="Enterprise">
                        <label>{{ __('Enterprise') }}:</label>
                        <select class="form-control form-control-solid enterprise" name="enterprises_id"
                            id="enterprises_id">
                            <option value="" selected disabled>{{ __('Chose enterprise') }}</option>

                            @foreach ($enterprises as $item)
                            <option value="{{$item->id}}">{{$item->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12 Vendor" style="display: none">
                    <div class="Vendor">
                        <label>{{ __('Brands') }}:</label>
                        <select class="form-control form-control-solid enterprise" name="brands_id"
                            id="brands_id">
                            <option value="" selected disabled>{{ __('Chose Brand') }}</option>

                            @foreach ($brands as $item)
                            <option value="{{$item->id}}">{{$item->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @endif
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

             
                <div class="form-group col-md-6 trial_class"  >
                    <label>{{ __('Days of trial') }}:</label>
                    <input type="number" name="days_of_trial" id="days_of_trial" class="form-control form-control-solid"
                        placeholder="Enter Days of trial" required />
                </div>
        
                <div class="form-group col-md-6">
                    <label>{{ __('Balance') }}:</label>
                    <input type="number" name="balance" id="balance" class="form-control form-control-solid"
                        placeholder="Enter balance" required />
                </div>
                <div class="form-group col-md-6 trial_class"  >
                    <label>{{ __('Start Day') }}:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-solid"
                        placeholder="{{ __('Start Day') }}" required />
                </div>
        
                <div class="form-group col-md-6 trial_class"  >
                    <label>{{ __('End Day') }}:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-solid"
                        placeholder="{{ __('End Day') }}" required />
                </div>
      
              
                <div class="form-group col-md-6">
                    <div class="image-input image-input-outline" id="kt_image_4"
                        style="background-image: url(assets/media/>users/blank.png)">
                        <div class="image-input-wrapper" style="background-image: url()"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="image" id="image" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
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
      $("#type_paid").change(function () {
        var paid = $(this).children("option:selected").val();
        if (paid == "trial") {
            $('.trial_class').show();
           
        } else if (paid == "paid") {
            $('.trial_class').hide();
           
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
        formData.append('name_ar', document.getElementById('name_ar').value);
        formData.append('name_en', document.getElementById('name_en').value);
    
        formData.append('balance', document.getElementById('balance').value);
        // formData.append('expire_date_type', document.getElementById('expire_date_type').value);

        formData.append('start_date', document.getElementById('start_date').value);

        formData.append('end_date', document.getElementById('end_date').value);
        formData.append('days_of_trial', document.getElementById('days_of_trial').value);

        formData.append('type_paid', 'TRIAL');
        formData.append('image', document.getElementById('image').files[0]);
        // if (document.getElementById('number_of_dayes') != null) {
        //     formData.append('number_of_dayes', document.getElementById('number_of_dayes').value);
        // }
        




    
        store("{{ route('subscription.store', ['locale'=>app()->getLocale()]) }}", formData)

    }

</script>
@endsection
