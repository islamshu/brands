{{-- Mixed Widget 1 --}}

<div class="card card-custom bg-gray-100 {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 bg-danger py-5">
        <h3 class="card-title font-weight-bolder text-white">{{ __('Statistics') }}</h3>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    {{-- Navigation --}}
                    <ul class="navi navi-hover">
                        <li class="navi-header">
                            <span class="text-primary text-uppercase font-weight-bold">Add new:</span>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <i class="navi-icon flaticon2-graph-1"></i>
                                <span class="navi-text">Order</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <i class="navi-icon flaticon2-calendar-4"></i>
                                <span class="navi-text">Event</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <i class="navi-icon flaticon2-layers-1"></i>
                                <span class="navi-text">Report</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <i class="navi-icon flaticon2-calendar-4"></i>
                                <span class="navi-text">Post</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <i class="navi-icon flaticon2-file-1"></i>
                                <span class="navi-text">File</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- Body --}}
    <div class="card-body p-0 position-relative overflow-hidden">
        {{-- Chart --}}
        <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>

        {{-- Stats --}}
        <div class="card-spacer mt-n25">
            {{-- Row --}}
            <div class="row m-0">
               @if(auth()->user()->hasRole('Enterprises'))
                <div class="col-md-2 bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/General/Attachment1.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                    <a href="#" class="text-warning font-weight-bold font-size-h6">
                        {{ __('Active Brand') }} 
                        
                    </a>
                </div>
                @else
                <div class="col-md-2 bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/General/Attachment1.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                    <a href="#" class="text-warning font-weight-bold font-size-h6">
                        {{ __('Branch') }}<br>
                        
                        {{ App\Models\Branch::where('vendor_id',auth()->user()->vendor_id)->count() }}
                    </a>
                </div>
                @endif
                <div class="col-md-2 bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Address-card.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">
                        {{ __('orders') }} <br>
                        {{ App\Models\Offer::where('vendor_id',auth()->user()->vendor_id)->count() }}


                    </a>
                </div>
                <div class="col-md-2 bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Flag.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                    <a href="#" class="text-warning font-weight-bold font-size-h6">
                        {{ __('Visitor') }} <br>
                        {{ auth()->user()->vendoruser->visitor  }}


                    </a>
                </div>
                <div class="col-md-2 bg-light-success px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Add-user.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">
                        {{ __('Sales') }} <br>
                        {{ auth()->user()->vendoruser->transaction->count()  }}


                    </a>
                </div>
                <div class="col-md-2  bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Contact1.svg", "svg-icon-3x svg-icon-danger d-block my-2") }}
                    <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">
                      {{ __('Day Transaction') }} <br>
                      {{ auth()->user()->vendoruser->transaction->whereDate('created_at', \Carbon\Carbon::today())->count()  }}

                      ;

                    </a>
                </div>
            </div>
            <div class="row m-0">
               
                <div class="col-md-2 bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Shopping/Chart-bar2.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                    <a href="#" class="text-warning font-weight-bold font-size-h6">
                        {{ __('Total customer saving') }}
                    </a>
                </div>
                <div class="col-md-2 bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Outgoing-box.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">
                        {{ __('Best Brand') }}
                    </a>
                </div>
                <div class="col-md-2 bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Send.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                    <a href="#" class="text-warning font-weight-bold font-size-h6">
                        {{ __('Best Branch') }}

                    </a>
                </div>
                <div class="col-md-2 bg-light-success px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Clipboard-check.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">
                        {{ __('Best Offer') }}

                    </a>
                </div>
                <div class="col-md-2  bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">
                    {{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-3x svg-icon-danger d-block my-2") }}
                    <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">
                        {{ __('All Action') }}
                    </a>
                </div>
            </div>
            
            {{-- Row --}}
           
        </div>
    </div>
</div>
