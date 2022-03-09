@extends('layout.default')
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Profile 2-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                <!--begin::Card-->
                <div class="card card-custom">
                    <!--begin::Body-->
                    <div class="card-body pt-15">
                        <!--begin::User-->
                        <div class="text-center mb-10">
                            <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                <div class="symbol-label"
                                    style="background-image:url({{URL::asset('images/enterprise/'.$enterprise->image)}})">
                                </div>
                                <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                            </div>
                            <h4 class="font-weight-bold my-2"> @if(app()->getLocale() == "en"){{$enterprise->name_en}}
                                @elseif(app()->getLocale() == "ar")
                                {{$enterprise->name_ar}}
                                @endif</h4>
                            {{-- <div class="text-muted mb-2">Application Developer</div> --}}
                            {{-- <span class="label label-light-warning label-inline font-weight-bold label-lg">Active</span> --}}
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->

                        <!--end::Contact-->
                        <!--begin::Nav-->
                        @if(Auth::user()->hasRole('Admin'))
                        <a href="{{route('enterprise.edit', ['enterprise'=>$enterprise->id,'locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Edit
                            Enterprise
                        </a>
                        <a href="{{route('Brands-index', ['enterprise'=>$enterprise->id,'locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Brands
                            Info</a>
                        @endif
                        <a href="{{route('enterprise.edit', ['enterprise'=>$enterprise->id,'locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Edit Profile
                            </a>
                            <a href="{{route('currency.index', ['locale'=>app()->getLocale()])}}"
                                class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Currency
                                </a>
                        <a href="{{route('country.index', ['locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Countries
                            </a>
                        <a href="{{route('city.index', ['locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Cities
                            </a>
                            
                        <a href="{{route('neighborhood.index', ['locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Neighborhoods
                         </a>

                        <!--end::Nav-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">

                <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    {{-- <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Brands</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href="{{route('vendor.create', ['locale'=>app()->getLocale()])}}"
                                class="btn btn-info font-weight-bolder font-size-sm">New Brands</a>
                        </div>
                    </div> --}}
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-0">
                        <!--begin::Table-->
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <!--begin::Details-->
                                <table
                                    class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
                                    id="kt_datatable">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>{{ __('Country Code') }}</th>
                                            <th>{{ __('Name ar') }}</th>
                                            <th>{{ __('Name en') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($country as $item)
                                        <td>{{$item->country->country_code}}</td>
                                        <td>{{$item->country->country_name_ar}}</td>
                                        <td>{{$item->country->country_name_en}}</td>


                                        </tr>
                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Advance Table Widget 5-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile 2-->
        </div>
        <!--end::Container-->
    </div>
    @endsection
