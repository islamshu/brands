@extends('layout.default')

@section('content')
<div class="
card card-docs mb-2">
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">

        <h2 class="mb-3">Edit Neighborhood</h2>

        <div class="mb-10">
            <label for="neighborhood_name" class="required form-label">Neighborhood Arabic Name</label>
            <input type="text" class="form-control" name="neighborhood_name" placeholder="Enter Arabic name" />
        </div>

        <div class="mb-10">
            <label for="neighborhood_name_english" class="required form-label">Neighborhood English Name</label>
            <input type="text" class="form-control" name="neighborhood_name_english" placeholder="Enter English name" />
        </div>

        <div class="mb-10">
            <label for="lat" class="required form-label">LAT</label>
            <input type="text" class="form-control" name="lat" placeholder="Enter Latitude" />
        </div>

        <div class="mb-10">
            <label for="lng" class="required form-label">LNG</label>
            <input type="number" name="lng" class="form-control " placeholder="Enter Longitude" />
        </div>

        <div class="mb-10">
            <label for="city_id" class="required form-label">Select City</label>
            <select name="city_id" class="form-control ">
                <option>City1</option>
                <option>City1</option>
                <option>City1</option>
                <option>City1</option>
                <option>City1</option>
            </select>
        </div>



        <div class="mb-10 ">
            <a href="#" class="btn btn-primary me-2 mb-2">Submit</a>
        </div>
    </div>
</div>


@endsection