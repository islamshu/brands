{{-- Extends layout --}}

@extends('layout.default')

@section('title','Enterprise')

{{-- Content --}}

@section('content')

<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Enterprise') }}
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
                <div class="form-group col-md-6">
                    <label>{{ __('Email') }}:</label>
                    <input type="text" name="email" id="email" class="form-control form-control-solid"
                        placeholder="Enter email" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Password') }}:</label>
                    <input type="password" name="password" id="password" class="form-control form-control-solid"
                        placeholder="Enter password" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('UUID') }}:</label>
                    <input type="text" name="uuid" id="uuid" class="form-control form-control-solid"
                        placeholder="Enter uuid" required />
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('commercial_registration_number') }}:</label>
                    <input type="text" name="commercial_registration_number" id="commercial_registration_number"
                        class="form-control form-control-solid" placeholder="Enter commercial registration number"
                        required />
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('phone') }}:</label>
                    <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                        placeholder="Enter phone" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('count_of_brands') }}:</label>
                    <input type="text" name="count_of_brands" id="count_of_brands"
                        class="form-control form-control-solid" placeholder="Enter count_of_brands" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('country') }}:</label>
                    <select class="form-control selectpicker country_id" data-size="7" data-live-search="true"
                        id="country_id" multiple>

                        @foreach ($country as $item)
                        <option value="{{$item->id}}">{{$item->country_name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('curruncy') }}:</label>
                    <select class="form-control selectpicker curruncy" multiple data-size="7" name="currencies" data-live-search="true"
                        id="currencies" multiple>

                        @foreach ($curruncy as $item)
                        <option value="{{$item->id}}">{{$item->name_en}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Category') }}:</label>
                    <select class="form-control selectpicker curruncy" multiple data-size="7" name="categorys" data-live-search="true"
                        id="categorys" multiple>

                        @foreach ($categorys as $item)
                        <option value="{{$item->id}}">{{$item->name_en}}</option>
                        @endforeach
                    </select>
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
        </div>



        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>


    </form>
</div>
</div>
@endsection
@section('styles')

@endsection

@section('scripts')

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
<script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    var KTBootstrapSelect = function () {

        // Private functions
        var demos = function () {
            // minimum setup
            $('.kt-selectpicker').selectpicker();
        }

        return {
            // public functions
            init: function () {
                demos();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTBootstrapSelect.init();
    });



    $('.visibility').select2({
        theme: 'bootstrap4'
    })

    function performStore() {
        let formData = new FormData();
        formData.append('name_ar', document.getElementById('name_ar').value);
        formData.append('name_en', document.getElementById('name_en').value);
        formData.append('uuid', document.getElementById('uuid').value);
        formData.append('commercial_registration_number', document.getElementById('commercial_registration_number')
            .value);
        formData.append('email', document.getElementById('email').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('count_of_brands', document.getElementById('count_of_brands').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        var value = $('#currencies').val();
        formData.append('currencies', JSON.stringify(value));
        var value = $('#categorys').val();
        formData.append('categorys', JSON.stringify(value));
        
        formData.append('image', document.getElementById('image').files[0]);
        var value = $('#country_id').val();
        formData.append('country_id', JSON.stringify(value));
      
        store("{{ route('enterprise.store', ['locale'=>app()->getLocale()]) }}", formData)

    }

</script>

@endsection
