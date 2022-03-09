@extends('layout.default')

@section('content')
    <div class="card card-custom">

        <div class="card-header">
            <h3 class="card-title">
                {{ __('edit user') }}
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
                                <select class="form-control form-control-solid visibility" name="model_type"
                                    id="model_type">
                                    <option value="" selected disabled>{{ __('chose') }}</option>

                                    <option value="enterprice" @if ($user->model_type == 'enterprice') selected @endif>{{ __('Enterprise') }}</option>
                                    <option value="brands" @if ($user->brands == 'brands') selected @endif>{{ __('Brand') }}</option>
                                </select>
                            </div>
                        </div>

                        @if ($user->ent_id != null)
                            <div class="form-group col-md-6 Enterprise">
                                <div class="Enterprise">
                                    <label>{{ __('Enterprise') }}:</label>
                                    <select class="form-control form-control-solid enterprise" name="enterprise_id"
                                        id="enterprise_id">
                                        <option value="" selected disabled>{{ __('Chose enterprise') }}</option>

                                        @foreach ($enterprises as $item)
                                            <option value="{{ $item->id }}" @if ($user->ent_id == $item->id) selected @endif>
                                                {{ $item->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @endif
                        @if ($user->vendor_id != null)

                            <div class="form-group col-md-12" id="brand_ajax">
                                <label>{{ __('brand') }}:</label>
                                <select class="city custom-select vendor_id " id="vendor_id" name="vendor_ids">
                                    <option value="0" disabled="true" selected="true">{{ __('Brand name') }}</option>
                                    @foreach (App\Models\Vendor::where('enterprise_id',$user->ent_id)->get() as $item)
                                    <option value="{{ $item->id }}" @if ($user->vendor_id == $item->id) selected @endif>
                                        {{ $item->name_en }}</option>   
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @endif
                        @if (Auth::user()->hasRole('Enterprises'))



                            <div class="form-group col-md-12" id="brand_ajax">
                                <label>{{ __('brand') }}:</label>
                                <select class="city custom-select vendor_id " id="vendor_id" name="vendor_id">
                                    <option value="0" disabled="true" selected="true">{{ __('Brand name') }}</option>
                                    @foreach (App\Models\Vendor::where('enterprise_id',auth()->user()->ent_id)->get() as $item))
                                    <option value="{{ $item->id }}" @if($user->vendor_id == $item->id ) selectd @endif>{{ $item->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label>{{ __('username') }}:</label>
                            <input type="text" name="username" value="{{ $user->username }}" id="username"
                                class="form-control form-control-solid" placeholder="{{ __('username') }}" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('email') }}:</label>
                            <input type="email" name="email" value="{{ $user->email }}" id="email"
                                class="form-control form-control-solid" placeholder="{{ __('email') }} " required />
                        </div>
                        <div class="form-group col-md-6 trial_class">
                            <label>{{ __('Paasword') }}:</label>
                            <input type="password" name="password" id="password" class="form-control form-control-solid"
                                placeholder="{{ __('password') }}" required />
                        </div>


                        <div class="form-group col-md-6 trial_class">
                            <label>{{ __('address') }}:</label>
                            <input type="text" name="address" value="{{ $user->address }}" id="address"
                                class="form-control form-control-solid" placeholder="address" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Roles') }}:</label>
                            <select class="form-control form-control-solid restricted" name="role" id="role">
                                @foreach ($rols as $item)
                                    <option value="{{ $item->name }}" @if($user->hasRole($item->name) == $item->name) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
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
            formData.append('username', document.getElementById('username').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('role', document.getElementById('role').value);


            if (document.getElementById('vendor_id') != null) {

                formData.append('vendor_id', document.getElementById('vendor_id').value);
            }

            if (document.getElementById('enterprise_id') != null) {
                formData.append('enterprise_id', document.getElementById('enterprise_id').value);
            }


            if (document.getElementById('model_type') != null) {

                formData.append('model_type', document.getElementById('model_type').value);
            }

            store("{{ route('update-user.user', ['locale' => app()->getLocale(),$user->id]) }}", formData);

        }
    </script>
@endsection
