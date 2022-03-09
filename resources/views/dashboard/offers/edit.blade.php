@extends('layout.default')
@section('styles')
    <link href="{{ asset('css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin::Wizard-->
            <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
                <!--begin::Wizard Nav-->
                <div class="wizard-nav border-bottom">
                    <div class="wizard-steps p-8 p-lg-10">
                        <!--begin::Wizard Step 1 Nav-->
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-bus-stop"></i>
                                <h3 class="wizard-title">1. {{ __('Fist step') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Wizard Step 1 Nav-->
                        <!--begin::Wizard Step 2 Nav-->
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <i class="wizard-icon flaticon-list"></i>
                                <h3 class="wizard-title">2. {{ __('Secand step') }}</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3"
                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                            x="11" y="5" width="2" height="14" rx="1" />
                                        <path
                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg> --}}
                                <!--end::Svg Icon-->
                            </span>
                        </div>

                    </div>
                </div>
                <!--end::Wizard Nav-->
                <!--begin::Wizard Body-->
                <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-12">
                        <!--begin::Wizard Form-->
                        {{-- <form class="form" id="kt_form"> --}}
                        <form class="form" method="post" id='kt_form' enctype="multipart/form-data">

                            <!--begin::Wizard Step 1-->
                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                <h3 class="mb-10 font-weight-bold text-dark">{{ __('General Info') }}</h3>
                                <!--begin::Input-->
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>{{ __('Name ar') }}:</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg"
                                                id="name_ar" name="name_ar" value="{{ $offer->name_ar }}" required placeholder="Name ar" />
                                            <span class="form-text text-muted">{{ __('Name ar') }} .</span>
                                        </div>
                                    </div>
                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>{{ __('Name en') }}:</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg"
                                                id="name_en" name="name_en" value="{{ $offer->name_en }}" required placeholder="Name en" />
                                            <span class="form-text text-muted">{{ __('Name en') }} .</span>
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->user()->hasRole('Admin'))
                                    <div class="row">
                                        <div class="col-xl-6">

                                            <div class="form-group">
                                                <label>{{ __('offer type') }}</label>
                                                <select required class="form-control form-control-solid form-control-lg"
                                                    id="offer_type" name="offer_type">
                                                    <option value="" selected disabled>{{ __('choose type') }}</option>
                                                    <option value="enterprice" @if($offer->offer_type == 'enterprice') selectd @endif >{{ __('Enterprice') }}</option>
                                                    <option value="brand"  @if($offer->offer_type == 'brand') selectd @endif>{{ __('brand') }}</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6 enterprice " id="enterprice" style="display: none">
                                            <!--begin::Input-->
                                            <div class="form-group ">
                                                <label>{{ __('Enterprice') }}</label>
                                                <select class="form-control form-control-solid form-control-lg"
                                                    id="enterprises_id" required name="enterprises_id">
                                                    <option value="" selected disabled>{{ __('choose enterprises') }}
                                                    </option>
                                                    @foreach ($enterprise as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name_en }}
                                                        </option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="form-group col-md-6" id="brand_ajax" style="display: none">
                                            <label>{{ __('brand') }}:</label>
                                            <select class="city custom-select " id="vendor_id" name="vendor_id">
                                                <option value="0" disabled="true" selected="true">{{ __('Brand name') }}
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                @endif
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Desc ar') }}</label>

                                        <textarea class="form-control" required name="desc_ar" id="desc_ar" cols="5"
                                            rows="5">{{ $offer->desc_ar}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Desc en') }}</label>

                                        <textarea class="form-control" name="desc_en" id="desc_en" cols="5"
                                            rows="5">{{ $offer->desc_en}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Terms ar') }}</label>

                                        <textarea class="form-control" name="terms_ar" id="terms_ar" cols="5"
                                            rows="5">{{ $offer->terms_ar}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Terms en') }}</label>

                                        <textarea class="form-control" name="terms_en" id="terms_en" cols="5"
                                            rows="5">{{ $offer->terms_en}}</textarea>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-xl-6">
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Member type') }}</label>
                                            <select class="form-control form-control-solid form-control-lg" id="member_type"
                                                name="member_type">
                                                <option value="free" @if($offer->member_type == 'free') selected @endif>{{ __('free') }}</option>
                                                <option value="paid" @if($offer->member_type == 'paid') selected @endif>{{ __('paid') }}</option>
                                                <option value="all" @if($offer->member_type == 'all') selected @endif>{{ __('all') }}</option>

                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Usege member') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="usege_member" name="usege_member">
                                                <option value="" selected disabled>{{ __('chose') }}</option>
                                                <option value="limit" @if($offer->usege_member == 'limit') selected @endif>{{ __('limit') }}</option>
                                                <option value="unlimit" @if($offer->usege_member == 'unlimit') selected @endif>{{ __('unlimit') }}</option>

                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <div class="col-xl-6 usage_member_number" @if($offer->usege_member == 'unlimit') style="display: none" @else style="display: block"  @endif>
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label>{{ __('Usage member number') }}</label>
                                            <input type="number" class="form-control form-control-solid form-control-lg" value="{{ $offer->usage_member_number}}"
                                                id="usage_member_number" name="usage_member_number"
                                                placeholder="Usage member number" />
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-xl-6">
                                        <!--begin::Select-->
                                        <div class="form-group">
                                            <label>{{ __('Usege system') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="usege_system" name="usege_system">
                                                <option value="" selected disabled>{{ __('chose') }}</option>

                                                <option value="limit" @if($offer->usege_system == 'limit') selected @endif>{{ __('limit') }}</option>
                                                <option value="unlimit" @if($offer->usege_system == 'unlimit') selected @endif>{{ __('unlimit') }}</option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 usage_number_system" @if($offer->usege_system == 'unlimit') style="display: none" @else style="display: block" @endif >
                                        <!--begin::Input-->
                                        <div class="form-group ">
                                            <label>{{ __('Usage number system') }}</label>
                                            <input type="number" class="form-control form-control-solid form-control-lg"
                                                id="usage_number_system" name="usage_number_system" value="{{ $offer->usage_number_system}}"
                                                placeholder="Usage member number" />
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                       
                                        <!--end::Select-->
                                    </div>
                                
                                <!--end::Input-->

                                <div class="row">



                                    
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Model Of Offer') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="offer_type_2" id="offer_type_2">
                                                <option value="" disabled selected>{{ __('chose') }}</option>

                                                <option value="buyOneGetOne" @if(@$offer->offertype->offer_type == 'buyOneGetOne') selected @endif>{{ __('buyOneGetOne') }}</option>
                                                <option value="special_discount" @if(@$offer->offertype->offer_type == 'special_discount') selected @endif>{{ __('special discount') }}</option>
                                                <option value="general_offer" @if(@$offer->offertype->offer_type== 'general_offer') selected @endif>{{ __('general discount') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 price_offer " @if(@$offer->offertype->offer_type == 'buyOneGetOne' || @$offer->offertype->offer_type == 'special_discount' ) style="display: block" @else style="display: none" @endif >
                                        <label>{{ __('Price') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="price" name="price" value="{{ @$offer->offertype->price }}" placeholder="Price after discount" />
                                    </div>
                                    <div class="col-md-6 price_befor_discount" @if(@$offer->offertype->offer_type == 'special_discount') style="display: block" @else style="display: none"@endif >
                                        <label>{{ __('Price befor discount') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="price_befor_discount" name="price_befor_discount" value="{{ @$offer->offertype->price_befor_discount }}"
                                            placeholder="Price befor discount" />
                                    </div>
                                    <div class="col-md-6 discont_value"  @if(@$offer->offertype->offer_type == 'general_offer') style="display: block" @else style="display: none"@endif>
                                        <label>{{ __('Discount value') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="discount_value" name="discount_value" placeholder="Discount value" value="{{ @$offer->offertype->discount_value }} " />
                                    </div>
                                    <div class="col-md-6 discont_value"  @if(@$offer->offertype->offer_type == 'general_offer') style="display: block" @else style="display: none"@endif>
                                      <label>{{ __('Discount Type') }}</label>
                                        <select  class="form-control form-control-solid form-control-lg"
                                            name="discount_type" id="discount_type">
                                            <option value="" selected disabled>{{ __('choese') }}</option>
                                            <option value="value" @if(@$offer->offertype->discount_type == 'value') selected @endif >{{ __('value') }}</option>
                                            <option value="persantage" @if(@$offer->offertype->discount_type == 'persantage') selected @endif>{{ __('persantage') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">

                                        <div class="image-input image-input-outline" id="kt_image_4"
                                            style="background-image: url(assets/media/>users/blank.png)">
                                            <label>{{ __('Primary image') }}</label>

                                            <div class="image-input-wrapper" style="background-image: url({{ asset('images/primary_offer/'.@$offer->offerimage->primary_image) }})"></div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="primary_image" id="primary_image"
                                                    accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="primary_image" id="primary_image" />
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">

                                        <div class="image-input image-input-outline" id="kt_image"
                                            style="background-image: url()">
                                            <label> {{ __('images') }}</label>
                                            <div class="image-input-wrapper" style="background-image: url({{ asset('images/primary_offer/'.@$offer->offerimage->image[0]) }})"></div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" multiple name="image[]" id="image"
                                                    accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="image" id="image" />
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                               
                            </div>

                            <!--end::Wizard Step 1-->
                            <!--begin::Wizard Step 2-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="mb-10 font-weight-bold text-dark">{{ __('DataTime info') }}</h4>
                                <!--begin::Input-->
                                <div class="row">



                                <!--end::Input-->
                                <!--begin::Input-->
                                
                                <div class="col-md-6">

                                <div class="form-group">
                                    <label>{{ __('Start time') }}</label>
                                    <input type="datetime" value="{{ $offer->start_time }}" class="form-control form-control-solid form-control-lg"
                                        name="start_time" id="start_time" placeholder="start_time" />
                                </div>
                                </div>
                                <div class="col-md-6">

                                <!--end::Input-->
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>{{ __('End time') }}</label>
                                    <input type="datetime" value="{{ $offer->end_time }}" class=" form-control form-control-solid form-control-lg"
                                        name="end_time" id="end_time" placeholder="end_time" />
                                </div>
                                </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Exchange points') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="exchange_points" id="exchange_points">
                                                <option value="" selected disabled>{{ __('chose ') }}</option>

                                                <option value="active"  @if($offer->exchange_points == 'active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive"  @if($offer->exchange_points == 'deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ponitex" @if($offer->exchange_points == 'active')  style="display: block" @else style="display: none" @endif >

                                        <label>{{ __('points') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="points" name="points" placeholder="Usage member number" value="{{ $offer->points }}" />


                                    </div>
                               
                                    <div class="col-md-6 ponitex" @if($offer->exchange_points == 'active')  style="display: block" @else style="display: none" @endif >
                                        <label>{{ __('Exchange points number') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="exchange_points_number" name="exchange_points_number" value="{{ $offer->exchange_points_number }}"
                                            placeholder="Usage member number" />
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Exchange cash') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="exchange_cash" id="exchange_cash">
                                                <option value="" selected disabled>{{ __('chose ') }}</option>

                                                <option value="active" @if($offer->exchange_cash == 'active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive" @if($offer->exchange_cash == 'deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 exchange_cash_number" @if($offer->exchange_cash == 'active') style="display:block" @else style="display: none" @endif>
                                        <label>{{ __('Exchange cash number') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="exchange_cash_number" name="exchange_cash_number" value="{{ $offer->exchange_cash_number }}"
                                            placeholder="Usage member number" />
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('Payment type') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="payment_type" id="payment_type">
                                                <option value="cash" @if($offer->payment_type =='cash') selected @endif>{{ __('cash') }}</option>
                                                <option value="visa" @if($offer->payment_type =='visa') selected @endif>{{ __('visa') }}</option>

                                            </select>
                                        </div>
                                    </div>



                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Datetime use') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="datetime_use" name="datetime_use">
                                                <option value="">{{ __('chose') }}</option>
                                                <option value="active" @if($offer->datetime_use =='active') selected @endif>{{ __('active') }}</option>
                                                <option value="deactive" @if($offer->datetime_use =='deactive') selected @endif>{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 datetime_use" @if($offer->datetime_use =='active')  style="display: block" @else style="display: none" @endif>
                                        <div class="form-group ">
                                            <label>{{ __('Datatime use type') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="datatime_use_type" name="datatime_use_type">
                                                <option value="days" @if($offer->datatime_use_type =='days') selected @endif  >{{ __('days') }}</option>
                                                <option value="hours" @if($offer->datatime_use_type =='hours') selected @endif>{{ __('hours') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 datetime_use" @if($offer->datetime_use =='active')  style="display: block" @else style="display: none" @endif>
                                        <label>{{ __('Datatime number ') }}</label>
                                        <input type="number" class="form-control form-control-solid form-control-lg"
                                            id="datatime_number" name="datatime_number" value="{{ $offer->datatime_number }}" placeholder="Usage member number"  />
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="form-group ">
                                            <label>{{ __('Is Offer') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="is_offer" name="datatime_use_type">
                                                <option value="1" @if($offer->is_offer == 1) selected @endif >{{ __('yes') }}</option>
                                                <option value="0" @if($offer->is_offer == 0) selected @endif>{{ __('no') }}</option>
    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="form-group ">
                                            <label>{{ __('is Voucher') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="is_voucher" >
                                                <option value="1" @if($offer->is_voucher == 1) selected @endif >{{ __('yes') }}</option>
                                                <option value="0" @if($offer->is_voucher == 0) selected @endif>{{ __('no') }}</option>
    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="form-group ">
                                            <label>{{ __('is Flash Deal') }}</label>
                                            <select class="form-control form-control-solid form-control-lg"
                                                id="is_flashdeal" name="datatime_use_type">
                                                <option value="1" @if($offer->is_flashdeal == 1) selected @endif >{{ __('yes') }}</option>
                                                <option value="0" @if($offer->is_flashdeal == 0) selected @endif>{{ __('no') }}</option>
    
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Sort') }}</label>
                                            <input type="number" value="{{ $offer->sort }}" class="form-control form-control-solid form-control-lg" name="sort"
                                                id="sort" placeholder="sort" />
                                        </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>{{ __('specific days') }}</label>
                                            <select name="delivery" class="form-control form-control-solid form-control-lg"
                                                name="specific_days" id="specific_days">
                                                <option value="" selected disabled>{{ __('chose ') }}</option>
                                                <option value="active" @if($offer->specific_days =='active') selected @endif >{{ __('active') }}</option>
                                                <option value="deactive" @if($offer->specific_days =='deactive') selected @endif >{{ __('deactive') }}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row specific_days" @if($offer->specific_days =='active') style="display: block" @else style="display: none" @endif>
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_0" name="from_0" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_0" name="to_0" placeholder="time to" />
                                    </div>
                                </div>
                                <div class="row specific_days" style="display: none">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_1" name="from_1" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_1" name="to_1" placeholder="time to" />
                                    </div>
                                </div>
                                <div class="row specific_days" style="display: none">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_2" name="from_2" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_2" name="to_2" placeholder="time to" />
                                    </div>
                                </div>
                                <div class="row specific_days" style="display: none">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_3" name="from_3" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_3" name="to_3" placeholder="time to" />
                                    </div>
                                </div>
                                <div class="row specific_days" style="display: none">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_4" name="from_4" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_4" name="to_4" placeholder="time to" />
                                    </div>
                                </div>
                                <div class="row specific_days" style="display: none">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_5" name="from_5" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_5" name="to_5" placeholder="time to" />
                                    </div>
                                </div>
                                <div class="row specific_days" style="display: none">
                                    <div class="col-md-6">
                                        <label>{{ __('time form') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="from_6" name="from_6" placeholder="time form" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ __('time to') }}</label>
                                        <input type="time" class="form-control form-control-solid form-control-lg"
                                            id="to_6" name="to_6" placeholder="time to" />
                                    </div>
                                </div>








                            </div>




                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                <div class="mr-2">
                                    <button type="button"
                                        class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                                        data-wizard-type="action-prev">{{ __('Previous') }}</button>
                                </div>
                                <div>
                                    <button type="button"
                                        class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                        onclick="performStore()"
                                        data-wizard-type="action-submit">{{ __('Submit') }}</button>

                                    <button type="button"
                                        class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                                        data-wizard-type="action-next">{{ __('Next') }}</button>
                                </div>
                            </div>
                            <!--end::Wizard Actions-->
                        </form>
                        <!--end::Wizard Form-->
                    </div>
                </div>
                <!--end::Wizard Body-->
            </div>
            <!--end::Wizard-->
        </div>
        <!--end::Wizard-->
    </div>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDL_Iurzw7shb69C_H4GLxzETOgHWrzHEw"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/pages/custom/wizard/wizard-1.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{ asset('crudjs/crud.js') }}"></script>


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
        var avatar4 = new KTImageInput('kt_image');

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
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>

    <script>
        $('#systemCoupon_use').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.count_systemCoupon_use').css("display", "block")

            } else {
                $('.count_systemCoupon_use').css("display", "none")

            }
        });
        $('#specific_days').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.specific_days').css("display", "flex")

            } else {
                $('.specific_days').css("display", "none")

            }
        });


        $('#datetime_use').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.datetime_use').css("display", "block")

            } else {
                $('.datetime_use').css("display", "none")

            }
        });


        $('#exchange_cash').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.exchange_cash_number').css("display", "block")

            } else {
                $('.exchange_cash_number').css("display", "none")

            }
        });


        $('#exchange_points').on('change', function() {
            let val = this.value;
            if (val == 'active') {
                $('.ponitex').css("display", "block")

            } else {
                $('.ponitex').css("display", "none")

            }
        });
        $('#usege_member').on('change', function() {
            let val = this.value;
            if (val == 'limit') {
                $('.usage_member_number').css("display", "block")

            } else {
                $('.usage_member_number').css("display", "none")

            }
        });


        $('#usege_system').on('change', function() {
            let val = this.value;
            if (val == 'limit') {
                $('.usage_number_system').css("display", "block")

            } else {
                $('.usage_number_system').css("display", "none")

            }
        });
        $('#offer_type_2').on('change', function() {
            let val = this.value;
            // alert(val);
            if (val == 'buyOneGetOne') {
                $('.price_offer').css("display", "block");
                $('.price_befor_discount').css("display", "none");
                $('.discont_value').css("display", "none");


            } else if (val == 'special_discount') {
                $('.price_offer').css("display", "block");
                $('.price_befor_discount').css("display", "block");
                $('.discont_value').css("display", "none");
            } else if (val == 'general_offer') {
                $('.price_offer').css("display", "none");
                $('.price_befor_discount').css("display", "none");
                $('.discont_value').css("display", "block");
            }
        });




        $('#offer_type').on('change', function() {
            let val = this.value;
            if (val == 'enterprice') {
                enterprice
                $('.enterprice').css("display", "block")
                $('.brand_class').css("display", "none")

            } else if (val == 'brand') {
                $('.enterprice').css("display", "none")

                $.ajax({
                    type: "get",
                    url: '{{ route('get_brands', app()->getLocale()) }}',
                    data: {
                        "enteprice_id": 'none'
                    },
                    success: function(data) {

                        $('#brand_ajax').css("display", "block")

                        $('#vendor_id').html(new Option('chose brand', '0'));
                        for (var i = 0; i < data.length; i++) {
                            $('#vendor_id').append(new Option(data[i].name_en,
                                data[i].id));

                        }
                    }
                });

            }

        });
        $('#enterprises_id').on('change', function() {
            let valenterprice = this.value;
            $.ajax({
                type: "get",
                url: '{{ route('get_brands', app()->getLocale()) }}',
                data: {
                    "enteprice_id": valenterprice
                },
                success: function(data) {

                    $('#brand_ajax').css("display", "block")

                    $('#vendor_id').html(new Option('chose brand', '0'));
                    for (var i = 0; i < data.length; i++) {
                        $('#vendor_id').append(new Option(data[i].name_en,
                            data[i].id));

                    }
                }
            });



        });
    </script>

    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>

   
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <script>
        function performStore() {
            let formData = new FormData();
            if (document.getElementById('enterprises_id') != null) {
                formData.append('enterprises_id', document.getElementById('enterprises_id').value);
            }
            if (document.getElementById('offer_type') != null) {
                formData.append('offer_type', document.getElementById('offer_type').value);
            }

            formData.append('vendor_id', '{{ $offer->vendor_id }}');

            formData.append('name_ar', document.getElementById('name_ar').value);
            formData.append('name_en', document.getElementById('name_en').value);
            formData.append('desc_en', document.getElementById('desc_en').value);
            formData.append('desc_ar', document.getElementById('desc_ar').value);
            formData.append('is_offer', document.getElementById('is_offer').value);
            formData.append('is_flashdeal', document.getElementById('is_flashdeal').value);
            formData.append('is_voucher', document.getElementById('is_voucher').value);

            formData.append('member_type', document.getElementById('member_type').value);
            formData.append('usege_member', document.getElementById('usege_member').value);
            formData.append('usege_system', document.getElementById('usege_system').value);
            // formData.append('usage_number_system', document.getElementById('usage_number_system').value);
            formData.append('offer_type_2', document.getElementById('offer_type_2').value);

            formData.append('specific_days', document.getElementById('specific_days').value);
            if (document.getElementById('price') != null) {
                formData.append('price', document.getElementById('price').value);
            }
            if (document.getElementById('terms_ar') != null) {
                formData.append('terms_ar', document.getElementById('terms_ar').value);
            }
            if (document.getElementById('terms_en') != null) {
                formData.append('terms_en', document.getElementById('terms_en').value);
            }
            if (document.getElementById('usage_member_number') != null) {
                formData.append('usage_member_number', document.getElementById('usage_member_number').value);
            }
            if (document.getElementById('discount_value') != null) {
                formData.append('discount_value', document.getElementById('discount_value').value);
            }
            if (document.getElementById('discount_type') != null) {
                formData.append('discount_type', document.getElementById('discount_type').value);
            }

            //   if (document.getElementById('offer_type_2') != null) {
            // formData.append('offer_type_2', document.getElementById('offer_type_2').value);
            //   }
            if (document.getElementById('from_0') != null) {
                formData.append('from_0', document.getElementById('from_0').value);
            }

            if (document.getElementById('usage_number_system') != null) {
                formData.append('usage_number_system', document.getElementById('usage_number_system').value);
            }
            if (document.getElementById('to_0') != null) {
                formData.append('to_0', document.getElementById('to_0').value);
            }
            if (document.getElementById('from_1') != null) {
                formData.append('from_1', document.getElementById('from_1').value);
            }
            if (document.getElementById('to_1') != null) {
                formData.append('to_1', document.getElementById('to_1').value);
            }
            if (document.getElementById('from_2') != null) {
                formData.append('from_2', document.getElementById('from_2').value);
            }
            if (document.getElementById('to_2') != null) {
                formData.append('to_2', document.getElementById('to_2').value);
            }
            if (document.getElementById('from_3') != null) {
                formData.append('from_3', document.getElementById('from_3').value);
            }
            if (document.getElementById('to_3') != null) {
                formData.append('to_3', document.getElementById('to_3').value);
            }
            if (document.getElementById('from_4') != null) {
                formData.append('from_4', document.getElementById('from_4').value);
            }
            if (document.getElementById('to_4') != null) {
                formData.append('to_4', document.getElementById('to_4').value);
            }
            if (document.getElementById('from_5') != null) {
                formData.append('from_5', document.getElementById('from_5').value);
            }
            if (document.getElementById('to_5') != null) {
                formData.append('to_5', document.getElementById('to_5').value);
            }
            if (document.getElementById('from_6') != null) {
                formData.append('from_6', document.getElementById('from_6').value);
            }
            if (document.getElementById('to_6') != null) {
                formData.append('to_6', document.getElementById('to_6').value);
            }


            formData.append('primary_image', document.getElementById('primary_image').files[0]);

            let TotalImages = $('#image')[0].files.length; //Total Images
            let images = $('#image')[0];
            for (let i = 0; i < TotalImages; i++) {
                formData.append('image' + i, images.files[i]);
            }
            formData.append('TotalImages', TotalImages);
            formData.append('datetime_use', document.getElementById('datetime_use').value);
            if (document.getElementById('datatime_use_type') != null) {
                formData.append('datatime_use_type', document.getElementById('datatime_use_type').value);
            }
            if (document.getElementById('datatime_number') != null) {
                formData.append('datatime_number', document.getElementById('datatime_number').value);
            }
            if (document.getElementById('points') != null) {
                formData.append('points', document.getElementById('points').value);
            }
            formData.append('exchange_cash', document.getElementById('exchange_cash').value);
            // if (document.getElementById('count_systemCoupon_use') != null) {
            //     formData.append('count_systemCoupon_use', document.getElementById('count_systemCoupon_use').value);
            // }
            if (document.getElementById('exchange_points') != null) {
                formData.append('exchange_points', document.getElementById('exchange_points').value);
            }
            if (document.getElementById('exchange_points_number') != null) {
                formData.append('exchange_points_number', document.getElementById('exchange_points_number').value);
            }
            if (document.getElementById('exchange_cash_number') != null) {
                formData.append('exchange_cash_number', document.getElementById('exchange_cash_number').value);
            }

            formData.append('payment_type', document.getElementById('payment_type').value);
            formData.append('sort', document.getElementById('sort').value);
            formData.append('start_time', document.getElementById('start_time').value);
            formData.append('end_time', document.getElementById('end_time').value);




            store("{{ route('update-offer', ['locale' => app()->getLocale() , $offer->id]) }}", formData)
        }
    </script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
@endsection
