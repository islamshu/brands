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
                                <div class="symbol-label" style="background-image:url({{URL::asset('images/brand/'.$vendor->image)}})">
                                </div>
                                <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                            </div>
                            <h4 class="font-weight-bold my-2"> @if(app()->getLocale() == "en"){{$vendor->name_en}}
                                @elseif(app()->getLocale() == "ar")
                                {{$vendor->name_ar}}
                                @endif</h4>
                            {{-- <div class="text-muted mb-2">Application Developer</div> --}}
                            {{-- <span class="label label-light-warning label-inline font-weight-bold label-lg">Active</span> --}}
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->

                        <!--end::Contact-->
                        <!--begin::Nav-->
                        @if(Auth::user()->hasRole('Admin'))
                        <a href="{{route('vendor.edit', ['vendor'=>$vendor->id,'locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Edit vendor
                             </a>
                               <a href="{{route('vendor.index', ['user->vendor'=>$vendor->id,'locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Brands
                            Info</a>
                        @endif
                          @if(Auth::user()->hasRole('vendors'))
                        <a href="{{route('vendor.index', ['locale'=>app()->getLocale()])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Brands
                            Info</a>
                            @endif
                        <a href="{{route('country-vendor', ['locale'=>app()->getLocale(),$vendor->id])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Countries
                            </a>
                        <a href="{{route('city-vendor', ['locale'=>app()->getLocale(),$vendor->id])}}"
                            class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block">Cities
                            </a>
                        <a href="{{route('neighborhoods-vendor', ['locale'=>app()->getLocale(),$vendor->id])}}"
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
                  
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-0">
                        <!--begin::Table-->
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <!--begin::Details-->
                                <div class="d-flex mb-9">
                                    <!--begin: Pic-->
                                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                        <div class="symbol symbol-50 symbol-lg-120">
                                            <img src="{{URL::asset('/uploads/'.$vendor->qr_image)}}" width="200" height="200" alt="image" />
                                        </div>
                                        <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                            <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div class="d-flex justify-content-between flex-wrap mt-1">
                                            <div class="d-flex mr-3">
                                                <a
                                                    class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">@if(app()->getLocale()
                                                    == "en"){{$vendor->name_en}}
                                                    @elseif(app()->getLocale() == "ar")
                                                    {{$vendor->name_ar}}
                                                    @endif</a>

                                            </div>

                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Content-->
                                        <div class="d-flex flex-wrap justify-content-between mt-1">
                                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                                <div class="d-flex flex-wrap mb-4">
                                                    <a
                                                        class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i
                                                            class="flaticon2-new-email mr-2 font-size-lg"></i>{{@$vendor->user->email}}</a>
                                                            <a
                                                            class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                            <i
                                                                class="fa fa-phone font-size-lg"></i>  {{$vendor->mobile}}</a>
                                                    
                                                    <a class="text-dark-50 text-hover-primary font-weight-bold">
                                                        <i
                                                            class="flaticon2-placeholder mr-2 font-size-lg"></i>{{$vendor->address}}</a>
                                                </div>
                                                <div class="d-flex flex-wrap mb-4">
                                                    <a
                                                        class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i
                                                            class=" mr-2 font-size-lg"></i>{{ __('Branch Count') }}: {{$vendor->branches->count()}} </a>
                                                    <a
                                                        class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i
                                                            class=" mr-2 font-size-lg"></i>{{ __('Offer Count') }}: {{$vendor->offers->count()}}</a>
                                        
                                                </div>
                                                <div class="d-flex flex-wrap mb-4">
                                                    <a
                                                        class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i
                                                            class=" mr-2 font-size-lg"></i>{{ __('Visitor Count') }}: {{$vendor->visitor}} </a>
                                                    <a
                                                        class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i
                                                            class=" mr-2 font-size-lg"></i>{{ __('Sales Count') }}: {{$vendor->visitor}}</a>
                                        
                                                </div>
                                      
                                            </div>
                                        
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Items-->
                                <div class="d-flex align-items-center flex-wrap mt-8">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                        <span class="mr-4">
                                            <i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">Earnings</span>
                                            <span class="font-weight-bolder font-size-h5">
                                                <span class="text-dark-50 font-weight-bold">$</span>249,500</span>
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                        <span class="mr-4">
                                            <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">Expenses</span>
                                            <span class="font-weight-bolder font-size-h5">
                                                <span class="text-dark-50 font-weight-bold">$</span>164,700</span>
                                        </div>
                                    </div>
                           
                                    <!--end::Item-->
                                    <!--begin::Item-->
                             
                                    <!--end::Item-->
                                </div>
                                <!--begin::Items-->
                            </div>
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
