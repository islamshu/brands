@extends('layout.default')

@section('content')
@section('styles')
<style>
    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }

</style>
@endsection
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Create City') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form method="post" action="{{route('city.store',['locale'=>app()->getLocale()])}}">
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
                        <label for="exampleSelectd">{{ __('Country') }}</label>
                      

                        <select class="form-control" id="country_id" name='country_id'>

                            @foreach($country as $one_country)
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
                </div>
                <div class="col">
                    <!--City Name Arabic-->
                    <div class="form-group">
                        <label for="basic-url" @if($errors->has('city_name'))
                            style="color: red"
                            @endif
                            >
                            {{__('City_Name')}} <small class="text-muted">Powere by Google</small>
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-pencil"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="city_name"
                                placeholder="{{__('City_Name_Arabic')}}" name="city_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="" id="dataInputs"></div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
    </form>
</div>




@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('#city_name').on('keydown blur', function () {
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
                    <input type='hidden' name='city_name_en' value='` + name + `'>
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
            document.getElementById("country_id").value = "";
            document.getElementById("city_name_english").value = "";
            document.getElementById("city_name").value = "";
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
