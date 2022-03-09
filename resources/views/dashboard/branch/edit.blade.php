@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Edit Branch
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
                {{-- <div class="form-group col-md-12">
                    <select class="form-control select2 vendor" id="kt_select2_1" name="param">
                        <option value='null'>chose Vendor</option>
                        @foreach ($vendor as $item)
                        <option value={{$item->id}} @if($item->id == $branch->vendor_id ) selected @endif>{{$item->name_en}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group col-md-6">
                    <label>Name ar:</label>
                    <input type="text" name="name_ar" id="name_ar" value="{{ $branch->name_ar }}" class="form-control form-control-solid"
                        placeholder="Enter Name" required />
                </div>
                <div class="form-group col-md-6">
                    <label>Name en:</label>
                    <input type="text" name="name_en" id="name_en"  value="{{ $branch->name_en }}"  class="form-control form-control-solid"
                        placeholder="Enter Name" required />
                </div>

                {{-- <div class="form-group col-md-6">
                    <label>Email:</label>
                    <input type="text" name="email" id="email"  value="{{ $email }}" class="form-control form-control-solid"
                        placeholder="Enter email" required />
                </div> --}}
               
                @php
                $lang = app()->getLocale();
                @endphp
                <div class="form-group col-md-6">
                    <label>phone:</label>
                    <input type="text" name="phone" id="phone"  value="{{ $branch->phone }}" class="form-control form-control-solid"
                        placeholder="Enter phone" required />
                </div>
                <div class="form-group col-md-6">
                    <label>city:</label>
                    <select class="city custom-select " id="city_id" name="city_id">
                        <option value="0" disabled="true" selected="true">City Name</option>
                        @foreach (\App\Models\Vendor_cities::where('vendor_id',$branch->vendor_id)->where('status','active')->with('city')->get() as $item)
                            <option value="{{ $item->city->id }} " @if($branch->city_id == $item->city->id ) selected @endif> @if($lang =='en') {{ $item->city->city_name_english }} @else {{ $item->city->city_name }} @endif  </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    {{-- @php
                        $vednor = App\Models\Vendor::find($branch->vendor_id)
                    @endphp --}}

                    <label>Neighborhood:</label>
                    <select class="neighborhood custom-select" id="neighborhood_id"  name="neighborhood_id">
                        <option  value="" disabled="true" selected="true">Neighborhood Name</option>
                        @foreach (\App\Models\enterprise_neighborhood::where('enterprise_id',@$branch->vendor->enterprise->id)->where('status',1)->with('neighborhood')->get(); as $item) 
                        <option value="{{ $item->neighborhood->id }} " @if($branch->neighborhood_id ==  $item->neighborhood->id ) selected @endif> @if($lang =='en')   {{ $item->neighborhood->neighborhood_name_english }} @else {{$item->neighborhood->neighborhood_name }} @endif</option>
                    @endforeach

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>street:</label>
                    <input type="text" name="street" id="street"  value="{{ $branch->street }}" class="form-control form-control-solid"
                        placeholder="Enter uuid" required />
                </div>

                <div class="form-group col-md-6">
                    <label>Latitude</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control"  value="{{ $branch->latitude }}" placeholder="Ex: 27,85487" id="latitude"
                            name="latitude">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Longitude</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control"  value="{{ $branch->longitude }}" placeholder="Ex: 27,85487" id="longitude"
                            name="longitude">
                    </div>
                </div>
                <div class="col-12">
                    <div id="mapGoogle" style="width: 100%; height: 400px;"></div>
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDL_Iurzw7shb69C_H4GLxzETOgHWrzHEw"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script>
    //map
    var map, marker, infoWindow;
    initMap();

    function initMap() {
        map = new google.maps.Map(document.getElementById('mapGoogle'), {
            zoom: 18,
            center: {
                lat: 59.909144,
                lng: 10.7436936
            },
        });
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            //icon: image,
            animation: google.maps.Animation.DROP,
            position: {
                lat: 59.909144,
                lng: 10.7436936
            }
        });
        marker.addListener('click', toggleBounce);
        //END CUSTOM MARKER ICON
        google.maps.event.addListener(marker, 'dragend', function (evt) {
            $('#latitude').val(evt.latLng.lat());
            $('#longitude').val(evt.latLng.lng());
        });
        // GET POSITION
        infoWindow = new google.maps.InfoWindow;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                $('#latitude').val(position.coords.latitude);
                $('#longitude').val(position.coords.longitude);
                marker.setPosition(pos);
                marker.setTitle('Your position is ' + (Math.round(pos.lat * 100) / 100) + ", " + (Math.round(pos
                    .lng * 100) / 100));
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        //END GET POSITION
    }
    //BOUNCE WHEN MARKER IS PRESSED
    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
    //END BOUNCE WHEN MARKER IS PRESSED
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

</script>
<script>
    $(document).ready(function () {

        $(document).on('change', '.vendor', function () {
            // console.log("hmm its change");

            var cat_id = $(this).val();
           
            // console.log(cat_id);
            var div = $(this).parent();

            var op = " ";

            $.ajax({
                type: 'get',
                url: "{{route('vendorCitiesAjax',['locale'=>app()->getLocale()])}}",
                data: {
                    'id': cat_id,
                },
                success: function (data) {
                    $('#city_id').html(new Option('chose city', '0'));
                    for (var i = 0; i < data.length; i++) {
                        $('#city_id').append(new Option(data[i].city.city_name_english,
                            data[i].city.id));

                    }
                },
                error: function () {

                }
            });
        });
    });
    $(document).ready(function () {

        $(document).on('change', '.city', function () {
            // console.log("hmm its change");

            var city_id = $(this).val();
            // console.log(cat_id);
            var vendor_id  ="{{ $branch->vendor_id }}";
        
            var div = $(this).parent();

            var op = " ";
            var lang = "{{ $lang }}"

            $.ajax({
                type: 'get',
                url: "{{route('vendorNeighborhoodAjax',['locale'=>app()->getLocale()])}}",
                data: {
                    'city_id': city_id,
                    'vendor_id':vendor_id
                },
                success: function (data) {
                    $('#neighborhood_id').html(new Option('chose neighborhood', '0'));
                    for (var i = 0; i < data.length; i++) {
                        if(lang == 'en'){
                        $('#neighborhood_id').append(new Option(data[i].neighborhood
                            .neighborhood_name_english, data[i].neighborhood.id));
                            }else{
                                $('#neighborhood_id').append(new Option(data[i].neighborhood
                            .neighborhood_name, data[i].neighborhood.id));
                            }

                    }
                },
                error: function () {

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
    $("select.visibility").change(function () {
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

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    function performStore() {
        let formData = new FormData();
        formData.append('name_ar', document.getElementById('name_ar').value);
        formData.append('name_en', document.getElementById('name_en').value);
        if (document.getElementById('street') != null) {
                formData.append('street', document.getElementById('street').value);
        }      
          formData.append('phone', document.getElementById('phone').value);
        // formData.append('email', document.getElementById('email').value);
        formData.append('longitude', document.getElementById('longitude').value);
        formData.append('latitude', document.getElementById('latitude').value);
        formData.append('city_id', document.getElementById('city_id').value);
        formData.append('neighborhood_id', document.getElementById('neighborhood_id').value);
        update("{{ route('update-branch', ['locale'=>app()->getLocale(),$branch->id]) }}", formData)
    }

</script>
<script>
    var KTSelect2 = function () {
        // Private functions
        var demos = function () {
            // basic
            $('#kt_select2_1').select2({
                placeholder: "Select a state"
            });

            // nested
            $('#kt_select2_2').select2({
                placeholder: "Select a state"
            });

            // multi select
            $('#kt_select2_3').select2({
                placeholder: "Select a state",
            });

            // basic
            $('#kt_select2_4').select2({
                placeholder: "Select a state",
                allowClear: true
            });

            // loading data from array
            var data = [{
                id: 0,
                text: 'Enhancement'
            }, {
                id: 1,
                text: 'Bug'
            }, {
                id: 2,
                text: 'Duplicate'
            }, {
                id: 3,
                text: 'Invalid'
            }, {
                id: 4,
                text: 'Wontfix'
            }];

            $('#kt_select2_5').select2({
                placeholder: "Select a value",
                data: data
            });

            // loading remote data

            function formatRepo(repo) {
                if (repo.loading) return repo.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";
                if (repo.description) {
                    markup += "<div class='select2-result-repository__description'>" + repo.description +
                        "</div>";
                }
                markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo
                    .forks_count + " Forks</div>" +
                    "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo
                    .stargazers_count + " Stars</div>" +
                    "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo
                    .watchers_count + " Watchers</div>" +
                    "</div>" +
                    "</div></div>";
                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.full_name || repo.text;
            }

            $("#kt_select2_6").select2({
                placeholder: "Search for git repositories",
                allowClear: true,
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });

            // custom styles

            // tagging support
            $('#kt_select2_12_1, #kt_select2_12_2, #kt_select2_12_3, #kt_select2_12_4').select2({
                placeholder: "Select an option",
            });

            // disabled mode
            $('#kt_select2_7').select2({
                placeholder: "Select an option"
            });

            // disabled results
            $('#kt_select2_8').select2({
                placeholder: "Select an option"
            });

            // limiting the number of selections
            $('#kt_select2_9').select2({
                placeholder: "Select an option",
                maximumSelectionLength: 2
            });

            // hiding the search box
            $('#kt_select2_10').select2({
                placeholder: "Select an option",
                minimumResultsForSearch: Infinity
            });

            // tagging support
            $('#kt_select2_11').select2({
                placeholder: "Add a tag",
                tags: true
            });

            // disabled results
            $('.kt-select2-general').select2({
                placeholder: "Select an option"
            });
        }

        var modalDemos = function () {
            $('#kt_select2_modal').on('shown.bs.modal', function () {
                // basic
                $('#kt_select2_1_modal').select2({
                    placeholder: "Select a state"
                });

                // nested
                $('#kt_select2_2_modal').select2({
                    placeholder: "Select a state"
                });

                // multi select
                $('#kt_select2_3_modal').select2({
                    placeholder: "Select a state",
                });

                // basic
                $('#kt_select2_4_modal').select2({
                    placeholder: "Select a state",
                    allowClear: true
                });
            });
        }

        // Public functions
        return {
            init: function () {
                demos();
                modalDemos();
            }
        };
    }();

    // Initialization
    jQuery(document).ready(function () {
        KTSelect2.init();
    });

</script>
@endsection
