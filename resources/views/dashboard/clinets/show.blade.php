@extends('layout.default')

@section('title')
    {{ __('Members') }}
@endsection


@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/animate-css/vivify.min.css') }}">
    <style>
        .col {
            margin: 1% !important
        }

        .text-muted {
            font-size: 16px
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="  text-left p-4">
                            <div class="circle" style="font-size: 20px;
                                font-weight: 600;">
                                Client Info
                            </div>

                        </div>
                        <hr>
                        <div class="row" style="margin: 2% !important">
                            <div class="col">
                                <small class="text-muted">Phone: </small>
                                <p>{{ @$member->phone }}</p>
                                <hr>
                                <small class="text-muted">Email address: </small>
                                <p>{{ @$member->email == null ? '-' : @$member->email }}</p>
                                <hr>
                                <small class="text-muted">Last Visit: </small>
                                <p>{{ @$member->last_login }}</p>
                                <hr>
                                <small class="text-muted">Natonality: </small>
                                <p class="m-b-0">
                                    {{ @$member->nationality == null ? '-' : @$member->nationality }}</p>
                                <hr>

                                <small class="text-muted">Device: </small>
                                <p class="m-b-0">
                                <p class="m-b-0">
                                    {{ @$member->mobile_type == null ? '-' : @$member->mobile_type }}</p>

                                </p>
                            </div>

                            <div class="col">
                                <small class="text-muted">Country: </small>
                                <p>{{ @$member->country->country_name_ar == null ? '-' : @$member->country->country_name_ar }}
                                </p>
                                <hr>
                                <small class="text-muted">City: </small>
                                <p>{{ @$member->city->city_name == null ? '-' : @$member->city->city_name }}</p>
                                <hr>
                                <small class="text-muted">Created at : </small>
                                <p class="m-b-0">{{ @$member->created_at == null ? '-' : @$member->created_at }}
                                </p>
                                <hr>
                                <small class="text-muted">Gender: </small>
                                <p class="m-b-0">{{ @$member->gender == null ? '-' : @$member->gender }}</p>
                                <hr>

                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

            </div>
        </div> <br>
        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="  text-left p-4">
                            <div class="circle" style="font-size: 20px;
                                font-weight: 600;">
                               Subscription Info
                            </div>

                        </div>
                        <hr>
                        <div class="row" style="margin: 2% !important">
                            <div class="col">
                                <small class="text-muted">Number of Oparation: </small>
                                <p>{{ @$member->number_of_operations }}</p>
                                <hr>
                                <small class="text-muted">Type Of Subscribe: </small>
                                <p>{{ @$member->type_of_subscribe == null ? '-' : @$member->type_of_subscribe }}</p>
                                <hr>
                                <small class="text-muted">How to subscribe: </small>
                                <p>{{ __(@$member->subs->last()->payment_type)}}</p>
                                <hr>
                                <small class="text-muted">Status: </small>
                                <p class="m-b-0">
                                    {{  __(@$member->subs->last()->status)}}</p>
                                <hr>

                                <small class="text-muted">expiry date: </small>
                                <p class="m-b-0">
                                <p class="m-b-0">
                                    {{ $member->expire_date != null ?  $member->expire_date : '_'}}
                                </p>
                                <hr>
                            </div>

                            <div class="col">
                                <small class="text-muted">Points No: </small>
                                <p>{{ @$member->points_no }}
                                </p>
                                <hr>
                                <small class="text-muted">Offers saving: </small>
                                <p>{{ @$member->offers_saving  }}
                                </p>
                                <hr>
                                <small class="text-muted">Coupon Saving : </small>
                                <p class="m-b-0">{{ @$member->coupon_saving  }}
                                </p>
                                <hr>
                                <small class="text-muted">Used Offers No: </small>
                                <p class="m-b-0">{{ @$member->used_offers_no }}</p>
                                <hr>
                                <small class="text-muted">Credit: </small>
                                <p class="m-b-0">{{ @$member->credit  }}</p>
                                <hr>

                                

                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection


@section('js')
    
    <script src="{{ asset('dashboard/assets/assets/bundles/chartist.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/mainscripts.bundle.js') }}"></script>

    <script src="{{ asset('dashboard/assets/assets/bundles/flotscripts.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/assets/bundles/knob.bundle.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDL_Iurzw7shb69C_H4GLxzETOgHWrzHEw"></script>
  
@endsection
