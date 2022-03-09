@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create Neighborhood') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form method="post" action="{{route('neighborhood.store',['locale'=>app()->getLocale()])}}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="alert {{session()->get('status')}} alert-dismissible fade show" role="alert">
            <span> {{ session()->get('message') }}<span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
        @endif
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">

                    <div class="form-group">
                        <label for="basic-url" @if($errors->has('country_id'))
                            style="color: red"
                            @endif
                            >
                            {{__('Country')}}
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    <i class="icon-pencil"></i>
                                </label>
                            </div>
                            <select class="custom-select" id="country_id" name="country_id"
                                @if($errors->has('country_id'))
                                style="border: 1px solid red"
                                @endif
                                >
                                <option value="">{{__('Choose_Country')}}...</option>

                                @foreach($countries as $one_country)
                                <option data-code="{{$one_country->alph2code}}" value="{{$one_country->id}}">
                                    @if(app()->getLocale() == "en")
                                    {{$one_country->country_name_en}}
                                    @elseif(app()->getLocale() == "ar")
                                    {{$one_country->country_name_ar}}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('country_id'))
                        <p style="color: red">{{$errors->first('country_id')}}</p>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <!--City Name Arabic-->
                    <div class="form-group">
                        <label for="basic-url">
                            {{__('City')}}
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    <i class="icon-pencil"></i>
                                </label>
                            </div>
                            <select class="custom-select" name="city_id" id="city_id">
                                <option value="">{{__('Choose_City')}}...</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <!--neighborhood_name_Arabic-->
                    <div class="form-group">
                        <label for="basic-url">
                            {{__('Neighborhood_Name')}} <small class="text-muted">Powere by Google</small>
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-pencil"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="neighborhood_name"
                                placeholder="{{__('Neighborhood_Name_Arabic')}}" name="neighborhood_name"
                                aria-label="Username" aria-describedby="basic-addon1"
                                value="{{Session::get('neighborhood_name')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="" id="dataInputs"></div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
    </form>
</div>




@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('#country_id').on('change', function () {
            var country_id = $(this).val();
            $.ajax({
                url: "{{route('get_cites_by_country.ajax', 'ar')}}",
                type: "GET",
                data: {
                    'country_id': country_id
                },
                success: function (data) {
                    $('#city_id').html(
                        "<option value=''>{{__('Choose_City')}}...</option>");

                    $.each(data, function (key, value) {
                        $('#city_id').append('<option value="' + value.id +
                            '">' + value.city_name + '</option>');
                    });
                }
            });
        });


        $('#neighborhood_name').on('keydown', function () {
            var countryCode = ($('#country_id option:selected').data('code'));
            var cityWord = ($(this).val());
            console.log("https://maps.googleapis.com/maps/api/geocode/json?address=" + cityWord +
                "&components=country:" + countryCode +
                "&key=AIzaSyDRC6yViPhXu1Fze-C1EhtJuD_KX-Ra3p8");

            $.ajax({
                'type': "GET",
                'dataType': 'json',
                'async': false,
                'url': "https://maps.googleapis.com/maps/api/geocode/json?address=" + cityWord +
                    "&components=country:" + countryCode +
                    "&key=AIzaSyDRC6yViPhXu1Fze-C1EhtJuD_KX-Ra3p8",
                'success': function (data) {
                    if (data.results != '') {
                        console.log(data);

                        name = data.results[0].address_components[0].long_name;

                        lat = data.results[0].geometry.location.lat;
                        lng = data.results[0].geometry.location.lng;

                        $('#dataInputs').html(`
                    <input type='hidden' name='neighborhood_name_en' value='` + name + `'>
                    <input type='hidden' name='lat' value='` + lat + `'>
                    <input type='hidden' name='lng' value='` + lng + `'>
                    <table class="custom-table">
                        <tr>
                            <td>City Name: </td>
                            <td>` + name + `</td>
                        </tr>
                        <tr>
                            <td>Lat: </td>
                            <td>` + lat + `</td>
                        </tr>
                        <tr>                            
                            <td>Lng: </td>
                            <td>` + lng + `</td>
                        </tr>
                    </table>
                    `);
                        console.log(name);
                        console.log(lat);
                        console.log(lng);

                    }
                }
            });
        });

        $('.reset-btn').click(function () {
            document.getElementById("city_id").value = "";
            document.getElementById("neighborhood_name").value = "";
        });
        var success_exist = '{{Session::has('
        success_msg ')}}';
        var error_exist = '{{Session::has('
        error_msg ')}}';

        if (success_exist) {
            $context = 'success';
            $message = '{{Session::get('
            success_msg ')}}';
            $positionClass = 'toast-top-full-width';
            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $positionClass
            });
        }
        if (error_exist) {
            $context = 'error';
            $message = '{{Session::get('
            error_msg ')}}';
            $positionClass = 'toast-top-full-width';
            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $positionClass
            });
        }
    });

</script>
@endsection
