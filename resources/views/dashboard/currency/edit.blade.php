@extends('layout.default')

@section('content')
<div class="
card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">Edit City</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-10">
                    <label for="city_name" class="required form-label">Arabic name</label>
                    <input type="text" class="form-control" name="city_name" placeholder="Enter Arabic name" />
                </div>

                <div class="mb-10">
                    <label for="city_name_english" class="required form-label">English name</label>
                    <input type="text" class="form-control" name="city_name_english" placeholder="Enter English name" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-10">
                    <label for="lat" class="required form-label">Latitude
                        Number</label>
                    <input type="number" name="lat" class="form-control " placeholder="Latitude" />
                </div>

                <div class="mb-10">
                    <label for="lng" class="required form-label">Longitude</label>
                    <input type="number" name="lng" class="form-control " placeholder="Longitude" />
                </div>

                <div class="mb-10">
                    <label for="country_id" class="required form-label">Select Country</label>
                    <select name="country_id" class="form-control ">
                        <option>City1</option>
                        <option>City1</option>
                        <option>City1</option>
                        <option>City1</option>
                        <option>City1</option>
                    </select>
                </div>

            </div>
        </div>


        <div class="mb-10 ">
            <a href="#" class="btn btn-primary me-2 mb-2">Submit</a>
        </div>
    </div>
</div>


@endsection