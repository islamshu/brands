@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('Create Brand') }}
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
                    @if (Auth::user()->hasRole('Admin'))
                        <div class="form-group col-md-12 customer_type">
                            <div class="rule">
                                <label>{{ __('Custome Type') }}:</label>
                                <select class="form-control form-control-solid visibility" name="customer_type"
                                    id="customer_type">
                                    <option value="Enterprise">{{ __('Enterprise') }}</option>
                                    <option value="Vendor">{{ __('Vendor') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12 Enterprise">
                            <div class="Enterprise">
                                <label>{{ __('Enterprise') }}:</label>
                                <select class="form-control form-control-solid enterprise" name="enterprise_id"
                                    id="enterprise_id">
                                    @foreach ($enterprises as $item)
                                        <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    @endif
                    <div class="form-group col-md-6">
                        <label>{{ __('Name ar') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="text" name="name_ar" id="name_ar" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Name en') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="text" name="name_en" id="name_en" class="form-control form-control-solid"
                            placeholder="Enter Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Desc ar') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="desc_ar" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Desc en') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="desc_en" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('policy ar') }} </label>
                        <textarea class="form-control" id="policy_ar" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('policy en') }}</label>
                        <textarea class="form-control" id="policy_en" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Terms ar') }}</label>

                        <textarea class="form-control" name="terms_ar" id="terms_ar" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Terms en') }}</label>

                        <textarea class="form-control" name="terms_en" id="terms_en" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Email') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="text" name="email" id="email" class="form-control form-control-solid"
                            placeholder="Enter email" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Password') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="password" name="password" id="password" class="form-control form-control-solid"
                            placeholder="Enter password" required />
                    </div>
                    @if (Auth::user()->hasRole('Admin'))
                        <div class="form-group col-md-6">
                            <label>{{ __('UUID') }}:</label>
                            <input type="text" name="uuid" id="uuid" class="form-control form-control-solid"
                                placeholder="Enter uuid" required />
                        </div>
                    @endif
                    <div class="form-group col-md-6">
                        <label>{{ __('owner name') }}:</label>
                        <input type="text" name="owner_name" id="owner_name" class="form-control form-control-solid"
                            placeholder="Enter owner name" required />
                    </div>
                    {{-- <div class="form-group col-md-6">
                    <label>{{ __('address') }}:</label>
                    <input type="text" name="address" id="address" class="form-control form-control-solid"
                        placeholder="Enter uuid" required />
                </div> --}}
                    <div class="form-group col-md-6">

                        <label>{{ __('commercial_registration_number') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="number" name="commercial_registration_number" id="commercial_registration_number"
                            class="form-control form-control-solid" placeholder="Enter commercial registration number"
                            required />
                    </div>
                    <div class="form-group col-md-6">

                        <div class="rule">
                            <label>{{ __('Type refund') }}:</label>
                            <small class="text-danger">*</small>
                            <select class="form-control form-control-solid restricted" name="type_refound"
                                id="type_refound">
                                <option value="auto">{{ __('auto') }}</option>
                                <option value="prefounded">{{ __('prefounded') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Vat Number') }}:</label>
                   
                        <input type="number" name="vat_no" id="vat_no" class="form-control form-control-solid"
                            placeholder="Enter Vat Number" required />
                    </div>
                    <div class="form-group col-md-6">
                        <div class="rule">
                            <label>{{ __('Vat Type') }}:</label>
                            <select class="form-control form-control-solid restricted" name="vat_type" id="vat_type">
                                <option value="percentage">{{ __('percentage') }}</option>
                                <option value="value">{{ __('value') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('Vat') }}:</label>
                        <input type="text" name="Vat" id="vat" class="form-control form-control-solid"
                            placeholder="Enter Vat" required />
                    </div>

                    @if (Auth::user()->hasRole('Enterprises'))
                        <div class="form-group col-md-6 country">
                            <label>{{ __('country') }}:</label>
                            <small class="text-danger">*</small>
                            <select class="form-control selectpicker country_id" data-size="7" data-live-search="true"
                                id="country_id" multiple>

                                @foreach ($country as $item)
                                    <option value="{{ $item->country->id }}">{{ $item->country->country_name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 country">
                            <label>{{ __('Category') }}:</label>
                            <small class="text-danger">*</small>
                            <select class="form-control selectpicker category_id" data-size="7" data-live-search="true"
                                id="category_id" multiple>

                                @foreach ($category->where('is_show',1) as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if (Auth::user()->hasRole('Admin'))
                        <div class="form-group col-md-6 country">
                            <label>{{ __('country') }}:</label>
                            <small class="text-danger">*</small>
                            <select class="form-control selectpicker" data-size="7" data-live-search="true" id="country_ids"
                                multiple>

                                @foreach ($country as $item)
                                    <option value="{{ $item->id }}">{{ $item->country_name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 countryAjax">
                            <div class="rule">
                                <label for="basic-url">
                                    <small class="text-danger">*</small> {{ __('Countries') }}
                                </label>
                                <select class="country_id custom-select" id="country_id" name="country_id" multiple>
                                    @foreach ($country as $item)
                                        <option value="{{ $item->id }}">{{ $item->country_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group col-md-6">
                        <label>{{ __('curruncy') }}:</label>
                        <small class="text-danger">*</small>
                        <select class="form-control selectpicker curruncy" multiple data-size="7" name="currencies"
                            data-live-search="true" id="currencies" multiple>

                            @foreach ($curruncy as $item)
                                <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('pin code') }}:</label>
                        <small class="text-danger">*</small>
                        <select class="form-control selectpicker curruncy" id="pincode">
                            <option value="0" selected>{{ __('optional') }}</option>
                            <option value="1">{{ __('Mandatory') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="code" style="display: none">
                        <label>{{ __('code number') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="number" name="code" id="codeinput" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('min limit of visitor') }}:</label>
                        <input type="number" name="visitor" id="visitor" class="form-control">

                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('min limit of sales') }}:</label>
                        <input type="number" name="sales" id="sales" class="form-control">

                    </div>


                    <div class="form-group col-md-6">
                        <label>{{ __('(Limit) The User Can Use Only One Offer?') }}:</label>
                        <small class="text-danger">*</small>
                        <select class="form-control selectpicker " id="customer_use">
                            <option value="0" selected>{{ __('deactive') }}</option>
                            <option value="1">{{ __('active') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="time_count" style="display: none">
                        <label>{{ __('Number of Hour') }}:</label>
                        <small class="text-danger">*</small>
                        <input type="number" name="number_of_hours" id="time_count_input" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ __('Start at') }}:</label>
                        <small class="text-danger">*</small>
                        <input class="form-control" type="time" name="start_at" id="start_at">
                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('End at') }}:</label>
                        <small class="text-danger">*</small>
                        <input class="form-control" type="time" name="end_at" id="end_at">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Menu link') }}:</label>
                        <input class="form-control" type="url" name="menu_link" id="menu_link">
                    </div>
                </div>
                <fieldset>
                    <legend>{{ __('Social Media') }}:</legend>
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ __('phone') }}:</label>
                        <input type="number" name="mobile" id="mobile" class="form-control form-control-solid"
                            placeholder="Enter phone" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('telephoone') }}:</label>
                        <input type="number" name="telephoone" id="telephoone" class="form-control form-control-solid"
                            placeholder="Enter telephoone" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Facebook') }}:</label>
                        <input type="url" name="facebook" id="facebook" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Twitter') }}:</label>
                        <input type="url" name="twitter" id="twitter" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Instagram') }}:</label>
                        <input type="url" name="instagram" id="instagram" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Snapchat') }}:</label>
                        <input type="url" name="snapchat" id="snapchat" class="form-control">
                    </div>
                </div>

                </fieldset>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Mian Image</label> <small class="text-danger">*</small> <br>

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


                    <div class="form-group col-md-6">
                        <label for="">Cover Images</label> <small class="text-danger">*</small> <br>
                        <div class="image-input image-input-outline" id="kt_image_5"
                            style="background-image: url(assets/media/>users/blank.png)">
                            <div class="image-input-wrapper" style="background-image: url()"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image_cover[]" multiple id="image_cover"
                                    accept=".png, .jpg, .jpeg" />
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
        $(document).ready(function() {


            $('#pincode').on('change', function() {
                let val = this.value;
                if (val == 1) {
                    $('#code').css("display", "block")


                } else if (val == 0) {
                    $('#code').css("display", "none")

                }

            });
            $('#customer_use').on('change', function() {
                let val = this.value;
                if (val == 1) {
                    $('#time_count').css("display", "block")


                } else if (val == 0) {
                    $('#time_count').css("display", "none")

                }

            });



            $(document).on('change', '.enterprise', function() {
                // console.log("hmm its change");

                var cat_id = $(this).val();
                // console.log(cat_id);
                var div = $(this).parent();

                var op = " ";

                $.ajax({
                    type: 'get',
                    url: "{{ route('countriesAjax', ['locale' => app()->getLocale()]) }}",
                    data: {
                        'id': cat_id
                    },
                    success: function(data) {
                        $('#country_id').html(new Option('choose country', '0'));
                        for (var i = 0; i < data.length; i++) {

                            $('#country_id').append(new Option(data[i].country.country_name_ar,
                                data[i].country.id));

                        }
                    },
                    error: function() {

                    }
                });
                $.ajax({
                    type: 'get',
                    url: "{{ route('get_category', ['locale' => app()->getLocale()]) }}",
                    data: {
                        'id': cat_id
                    },
                    success: function(data) {
                        $('#country_id').html(new Option('choose country', '0'));
                        for (var i = 0; i < data.length; i++) {

                            $('#country_id').append(new Option(data[i].country.country_name_ar,
                                data[i].country.id));

                        }
                    },
                    error: function() {

                    }
                });
            });
        });
    </script>
    <script>
        var visibility = $("select.visibility").children("option:selected").val();
        if (visibility == "Enterprise") {
            $('.Enterprise').show();
            $('.countryAjax').show();
            $('.country').hide();
        } else if (visibility == "Vendor") {
            $('.Enterprise').hide();
            $('.countryAjax').hide();
            $('.country').show();
        }
        $("select.visibility").change(function() {
            var visibility = $(this).children("option:selected").val();
            if (visibility == "Enterprise") {
                $('.Enterprise').show();
                $('.countryAjax').show();
                $('.country').hide();
            } else if (visibility == "Vendor") {
                $('.Enterprise').hide();
                $('.countryAjax').hide();
                $('.country').show();
            }
        });
    </script>
    <script>
        var avatar4 = new KTImageInput('kt_image_4');

        avatar4.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('change', function(imageInput) {
            swal.fire({
                title: 'Image successfully changed !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar4.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
    </script>
    <script>
        var avatar5 = new KTImageInput('kt_image_5');

        avatar5.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar5.on('change', function(imageInput) {
            swal.fire({
                title: 'Image successfully changed !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        avatar5.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
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
            formData.append('desc_en', document.getElementById('desc_en').value);
            formData.append('desc_ar', document.getElementById('desc_ar').value);

            formData.append('start_at', document.getElementById('start_at').value);
            formData.append('end_at', document.getElementById('end_at').value);

            formData.append('pincode', document.getElementById('pincode').value);
            formData.append('type_refound', document.getElementById('type_refound').value);
           
            if (document.getElementById('facebook') != null) {
                formData.append('facebook', document.getElementById('facebook').value);
            }
            if (document.getElementById('owner_name') != null) {
                formData.append('owner_name', document.getElementById('owner_name').value);
            }


            if (document.getElementById('twitter') != null) {
                formData.append('twitter', document.getElementById('twitter').value);
            }
            if (document.getElementById('instagram') != null) {
                formData.append('instagram', document.getElementById('instagram').value);
            }
            if (document.getElementById('snapchat') != null) {
                formData.append('snapchat', document.getElementById('snapchat').value);
            }

            if (document.getElementById('visitor') != null) {
                formData.append('visitor', document.getElementById('visitor').value);
            }
            if (document.getElementById('sales') != null) {
                formData.append('sales', document.getElementById('sales').value);
            }
            if (document.getElementById('policy_en') != null) {
                formData.append('policy_en', document.getElementById('policy_en').value);
            }
            if (document.getElementById('policy_ar') != null) {
                formData.append('policy_ar', document.getElementById('policy_ar').value);
            }
            if (document.getElementById('terms_ar') != null) {
                formData.append('terms_ar', document.getElementById('terms_ar').value);
            }
            if (document.getElementById('terms_en') != null) {
                formData.append('terms_en', document.getElementById('terms_en').value);
            }
            if (document.getElementById('telephoone') != null) {
                formData.append('telephoone', document.getElementById('telephoone').value);
            }


            if (document.getElementById('codeinput') != null) {
                formData.append('codeinput', document.getElementById('codeinput').value);
            }
            formData.append('customer_use', document.getElementById('customer_use').value);
            if (document.getElementById('time_count_input') != null) {
                formData.append('time_count_input', document.getElementById('time_count_input').value);
            }

            if (document.getElementById('uuid') != null) {
                formData.append('uuid', document.getElementById('uuid').value);
            }
            // formData.append('uuid', document.getElementById('uuid').value);
            var value = $('#currencies').val();
            formData.append('currencies', JSON.stringify(value));
            formData.append('commercial_registration_number', document.getElementById('commercial_registration_number')
                .value);
            formData.append('email', document.getElementById('email').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('password', document.getElementById('password').value);
            var value = $('#category_id').val();
            formData.append('category_id', JSON.stringify(value));
            if (document.getElementById('customer_type') != null) {
                formData.append('customer_type', document.getElementById('customer_type').value);
            }
            if (document.getElementById('vat') != null) {
                formData.append('vat', document.getElementById('vat').value);
            }
            if (document.getElementById('vat_type') != null) {
                formData.append('vat_type', document.getElementById('vat_type').value);
            }
         
            if (document.getElementById('menu_link') != null) {
                formData.append('menu_link', document.getElementById('menu_link').value);
            }


            if (document.getElementById('enterprise_id') != null) {
                formData.append('enterprise_id', document.getElementById('enterprise_id').value);
            }
            formData.append('image', document.getElementById('image').files[0]);
            // formData.append('image_cover', document.getElementById('image_cover').files[0]);

            let TotalImages = $('#image_cover')[0].files.length; //Total Images
            let images = $('#image_cover')[0];
            for (let i = 0; i < TotalImages; i++) {
                formData.append('image_cover' + i, images.files[i]);
            }
            formData.append('TotalImages', TotalImages);
            if (document.getElementById('country_id') != null) {
                var value = $('#country_id').val();
                formData.append('country_id', JSON.stringify(value))
            }
            if (document.getElementById('country_ids') != null) {
                var value = $('#country_ids').val();
                formData.append('country_ids', JSON.stringify(value))
            }
            store("{{ route('vendor.store', ['locale' => app()->getLocale()]) }}", formData)

        }
    </script>
@endsection
