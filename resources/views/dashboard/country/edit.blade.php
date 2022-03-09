@extends('layout.default')

@section('content')
<div class="
card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">{{ __('Edit country') }}</h2>
        <div class="row">
            <div class="col-md-6">


                <div class="mb-10">
                    <label for="country_name_ar" class="required form-label">{{ __('Name ar') }}</label>
                    <input type="text" class="form-control" name="country_name_ar" placeholder="Arabic name" />
                </div>

                <div class="mb-10">
                    <label for="country_name_en" class="required form-label">{{ __('Name en') }}</label>
                    <input type="text" class="form-control" name="country_name_en" placeholder="English name" />
                </div>
                <div class="mb-10">
                    <label for="country_code" class="required form-label">{{ __('Country Code') }}</label>
                    <input type="text" class="form-control" name="country_code" placeholder="Country Code" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-10">
                    <label for="lat" class="required form-label">{{ __('Latitude') }}
                        </label>
                    <input type="number" name="lat" class="form-control " placeholder="Latitude" />
                </div>

                <div class="mb-10">
                    <label for="lng" class="required form-label">{{ __('Longitude') }}</label>
                    <input type="number" name="lng" class="form-control " placeholder="Longitude" />
                </div>

                <div class="mb-10">
                    <label for="flag" class="required form-label">{{ __('Flag') }}</label>
                    <input type="text" name="flag" class="form-control " placeholder="Flag" />
                </div>

                <div class="mb-10">
                    <label for="alph2code" class="required form-label">{{ __('Alph2code') }}</label>
                    <input type="number" name="alph2code" class="form-control " placeholder="Alph2code" />
                </div>

                <div class="mb-10">
                    <label for="alph3code" class="required form-label">{{ __('Alph3code') }}</label>
                    <input type="number" name="alph3code" class="form-control " placeholder="Alph3code" />
                </div>
            </div>
        </div>




        <div class="mb-10 ">
            <a href="#" class="btn btn-primary me-2 mb-2">{{ __('Submit') }}</a>
        </div>
    </div>
</div>


@endsection