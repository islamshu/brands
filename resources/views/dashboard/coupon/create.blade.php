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
                        <label for="exampleTextarea">{{ __('Desc ar') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="desc_ar" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Desc en') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="desc_en" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Terms ar') }}</label>
                        <textarea class="form-control" id="tearm_ar" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea">{{ __('Terms en') }} </label>
                        <textarea class="form-control" id="tearm_en" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('Member Type') }}:</label>
                        <select class="form-control form-control-solid restricted" name="member_type" id="member_type">
                            <option value="PREMIUM">{{ __('PREMIUM') }}</option>
                            <option value="Trial">{{ __('Trial') }}</option>
                            <option value="Free">{{ __('Free') }}</option>
                            <option value="All">{{ __('All') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 trial_class">
                        <label>{{ __('Promocode') }}:</label>
                        <input type="text" name="promocode" id="promocode" class="form-control form-control-solid"
                            placeholder="{{ __('Promocode') }}" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('type') }}:</label>
                        <select class="form-control form-control-solid restricted" name="type" id="type">
                            <option value="amount">{{ __('amount') }}</option>
                            <option value="percentage">{{ __('percentage') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 trial_class">
                        <label>{{ __('Value') }}:</label>
                        <input type="number" name="value" id="value" class="form-control form-control-solid"
                            placeholder="value" required />
                    </div>
                    <div class=" form-group col-md-6 form-group">
                        <label>{{ __('Start time') }}</label>
                        <input type="datetime-local" class="form-control form-control-solid form-control-lg" name="start_at"
                            id="start_at" placeholder="start_at" />
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="form-group col-md-6 form-group">
                        <label>{{ __('End time') }}</label>
                        <input type="datetime-local" class="form-control form-control-solid form-control-lg" name="end_at"
                            id="end_at" placeholder="end_at" />
                    </div>
                    <div class="form-group col-md-6 form-group">
                        <label>{{ __('Store Link') }}</label>
                        <input type="url" class="form-control form-control-solid form-control-lg" name="store_link"
                            id="store_link" placeholder="{{ __('Store Link') }}" />
                    </div>

                    

                    <div class="form-group col-md-6">
                        <div class="rule">
                            <label>{{ __('special days') }}:</label>
                            <select class="form-control form-control-solid restricted" name="special_days"
                                id="special_days">
                                <option value="" disabled selected>{{ __('choose') }}</option>

                                <option value="active">{{ __('active') }}</option>
                                <option value="deactive">{{ __('deactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 days" style="display: none">
                        <div class="rule">
                            <label>{{ __('days') }}:</label>
                            <select class="form-control form-control-solid restricted" multiple name="days[]" id="days">
                                <option value="Saturday">{{ __('Saturday') }}</option>
                                <option value="Sunday">{{ __('Sunday') }}</option>
                                <option value="Monday">{{ __('Monday') }}</option>
                                <option value="Tuesday">{{ __('Tuesday') }}</option>
                                <option value="Wednesday">{{ __('Wednesday') }}</option>
                                <option value="Thursday">{{ __('Thursday') }}</option>
                                <option value="Friday">{{ __('Friday') }}</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="rule">
                            <label>{{ __('special days') }}:</label>
                            <select class="form-control form-control-solid restricted" name="special_time"
                                id="special_time">
                                <option value="" disabled selected>{{ __('choose') }}</option>

                                <option value="active">{{ __('active') }}</option>
                                <option value="deactive">{{ __('deactive') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row times" style="display: none">
                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_0" name="from_0"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_0" name="to_0"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_1" name="from_1"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_1" name="to_1"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_2" name="from_2"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_2" name="to_2"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_3" name="from_3"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_3" name="to_3"
                            placeholder="time to" />
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_4" name="from_4"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_4" name="to_4"
                            placeholder="time to" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_5" name="from_5"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_5" name="to_5"
                            placeholder="time to" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time form') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="from_6" name="from_6"
                            placeholder="time form" />
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('time to') }}</label>
                        <input type="time" class="form-control form-control-solid form-control-lg" id="to_6" name="to_6"
                            placeholder="time to" />
                    </div>
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
        <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
    </div>

    </form>
    </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

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
            });
        });
    </script>
    <script>
        $('#enterprise_id').on('change', function() {
            let valenterprice = this.value;
            $.ajax({
                type: "get",
                url: '{{ route('get_brands', app()->getLocale()) }}',
                data: {
                    "enteprice_id": valenterprice
                },
                success: function(data) {

                    $('#brand_ajax').css("display", "block")

                    $('.vendor_id').html(new Option('chose brand', '0'));
                    for (var i = 0; i < data.length; i++) {
                        $('.vendor_id').append(new Option(data[i].name_en,
                            data[i].id));

                    }
                }
            });



        });
        $('#model_type').on('change', function() {
            let val = this.value;
            if (val == 'enterprice') {
                $('.Enterprise').css("display", "block")
                $('.Vendor').css("display", "none")
                $('#brand_ajax').css("display", "block")

            } else if (val == 'brands') {
                $.ajax({
                    type: "get",
                    url: '{{ route('get_brands', app()->getLocale()) }}',
                    data: {
                        "enteprice_id": null
                    },
                    success: function(data) {

                        $('#brand_ajax').css("display", "block")
                        $('.Enterprise').css("display", "none")

                        $('.vendor_id').html(new Option('chose brand', '0'));
                        for (var i = 0; i < data.length; i++) {
                            $('.vendor_id').append(new Option(data[i].name_en,
                                data[i].id));

                        }
                    }
                });

            }

        });
        $('#special_days').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.days').css("display", "block")
            } else if (val == 'deactive') {
                $('.days').css("display", "none")

            }
        });
        $('#special_time').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.times').css("display", "flex")
            } else if (val == 'deactive') {
                $('.times').css("display", "none")

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
        $("#type").change(function() {
            var paid = $(this).children("option:selected").val();
            if (paid == "trial") {
                $('.trial_class').show();

            } else if (paid == "paid") {
                $('.trial_class').hide();

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
            formData.append('desc_en', document.getElementById('desc_en').value);
            formData.append('desc_ar', document.getElementById('desc_ar').value);

            formData.append('special_days', document.getElementById('special_days').value);
            formData.append('special_time', document.getElementById('special_time').value);
            formData.append('type', document.getElementById('type').value);
            formData.append('value', document.getElementById('value').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('member_type', document.getElementById('member_type').value);
            formData.append('promocode', document.getElementById('promocode').value);

            
            formData.append('vendor_id', '{{ $vendor->id }}');

            
            if (document.getElementById('days') != null) {
                var value = $('#days').val();
                formData.append('days', JSON.stringify(value));
            }
            if (document.getElementById('start_at') != null) {
                formData.append('start_at', document.getElementById('start_at').value);
            }
            if (document.getElementById('store_link') != null) {
                formData.append('store_link', document.getElementById('store_link').value);
            }
            if (document.getElementById('tearm_ar') != null) {
                formData.append('tearm_ar', document.getElementById('tearm_ar').value);
            }
            if (document.getElementById('tearm_en') != null) {
                formData.append('tearm_en', document.getElementById('tearm_en').value);
            }
            
            if (document.getElementById('end_at') != null) {
                formData.append('end_at', document.getElementById('end_at').value);
            }
            if (document.getElementById('enterprise_id') != null) {
                formData.append('enterprise_id', document.getElementById('enterprise_id').value);
            }
            if (document.getElementById('enterprise_id') != null) {
                formData.append('enterprise_id', document.getElementById('enterprise_id').value);
            }

                if (document.getElementById('model_type') != null) {

                    formData.append('model_type', document.getElementById('model_type').value);
                }

                if (document.getElementById('from_0') != null) {
                    formData.append('from_0', document.getElementById('from_0').value);
                }
                if (document.getElementById('from_1') != null) {
                    formData.append('from_1', document.getElementById('from_1').value);
                }
                if (document.getElementById('from_2') != null) {
                    formData.append('from_2', document.getElementById('from_2').value);
                }
                if (document.getElementById('from_3') != null) {
                    formData.append('from_3', document.getElementById('from_3').value);
                }
                if (document.getElementById('from_4') != null) {
                    formData.append('from_4', document.getElementById('from_4').value);
                }
                if (document.getElementById('from_5') != null) {
                    formData.append('from_5', document.getElementById('from_5').value);
                }
                if (document.getElementById('from_6') != null) {
                    formData.append('from_6', document.getElementById('from_6').value);
                }
                if (document.getElementById('to_0') != null) {
                    formData.append('to_0', document.getElementById('to_0').value);
                }
                if (document.getElementById('to_1') != null) {
                    formData.append('to_1', document.getElementById('to_1').value);
                }
                if (document.getElementById('to_2') != null) {
                    formData.append('to_2', document.getElementById('to_2').value);
                }
                if (document.getElementById('to_3') != null) {
                    formData.append('to_3', document.getElementById('to_3').value);
                }
                if (document.getElementById('to_4') != null) {
                    formData.append('to_4', document.getElementById('to_4').value);
                }
                if (document.getElementById('to_5') != null) {
                    formData.append('to_5', document.getElementById('to_5').value);
                }
                if (document.getElementById('to_6') != null) {
                    formData.append('to_6', document.getElementById('to_6').value);
                }
                store("{{ route('coupun.store', ['locale' => app()->getLocale()]) }}", formData);

            }
    </script>
@endsection
