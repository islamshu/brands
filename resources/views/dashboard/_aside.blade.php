@php
$lang = app()->getLocale();
@endphp
<ul class="menu-nav">
    <li class="menu-item">
        <a href="/{{ $lang }}/home" class="menu-link">
            <span class="svg-icon menu-icon">
                <i class="fa fa-bookmark" aria-hidden="true"></i>
            </span>

            <span class="menu-text"> {{ __('Dashboard') }} </span>
        </a>
    </li>
    {{-- @can('create-enterprises') --}}

    @if (auth()->user()->hasRole(['Admin']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Roles') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Role') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/role"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/role/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li>

                </ul>
            </div>
        </li>


        {{-- <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Currency') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Currency') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/currency"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/currency/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li>

                </ul>
            </div>
        </li> --}}



        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Countries') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Countries') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/country"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/country/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li>
                </ul>
            </div>
        </li>


        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Neighborhoods') }}</span>
                <i class="menu-arrow"></i>
            </a>


            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Neighborhoods') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/neighborhood"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/neighborhood/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li>

                </ul>
            </div>
        </li>

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Translate') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Translate') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a
                            href="/{{ $lang }}/language_translate/ar" class="menu-link "><i
                                class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Arabic file') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a
                            href="/{{ $lang }}/language_translate/en" class="menu-link "><i
                                class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('English file') }}</span></a></li>

                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->hasRole(['Enterprises']))



        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="/{{ $lang }}/enterprise" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">
                    @if (auth()->user()->hasRole(['Enterprises']))
                        {{ __('Main Info') }}
                    @else
                        {{ __('Enterprises') }}
                    @endif
                </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Enterprises') }}</span></span>
                    </li>

                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/enterprise"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('show') }}</span></a></li>

                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/enterprise"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">
                                {{ __('list') }}


                            </span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/enterprise/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">
                                {{ __('create') }}


                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
    @endif
    {{-- <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
        <a href="#" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                <i class="fa fa-bookmark" aria-hidden="true"></i>
            </span>
            <span class="menu-text">{{ __('Currency') }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                            class="menu-text">{{ __('Currency') }}</span></span>
                </li>
                <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/currency"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">{{ __('List') }}</span></a></li>
                <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/currency/create"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">{{ __('Create') }}</span></a></li>

            </ul>
        </div>
    </li> --}}
    @if (auth()->user()->isAbleTo(['read-city']))

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Cities') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Cities') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/city"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    @if (auth()->user()->isAbleTo(['create-city']))
                        <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/city/create"
                                class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Create') }}</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-role']))

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Roles') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Role') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/role"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    @if (auth()->user()->hasPermission('create-role'))
                        <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/role/create"
                                class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Create') }}</span></a></li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
    {{-- {{ dd(auth()->user()->isAbleTo(['read-category'])) }} --}}
    @if (auth()->user()->isAbleTo(['read-category']))

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Category') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Category') }}</span></span>
                    </li>

                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/category"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    @if (auth()->user()->isAbleTo(['read-category']))
                        <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/category/create"
                                class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Create') }}</span></a></li>
                    @endif

                </ul>
            </div>
        </li>
    @endif

    <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
        <a href="#" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                <i class="fa fa-bookmark" aria-hidden="true"></i>
            </span>
            <span class="menu-text">{{ __('Notofication') }}</span>
            <i class="menu-arrow"></i>
        </a>

        <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                            class="menu-text">{{ __('Repots') }}</span></span>
                </li>

                <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/sales"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">{{ __('Total Transaction repots') }}</span></a></li>
                            <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/transaction_repots"
                                class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Purchases details') }}</span></a></li>
      


            </ul>
        </div>
    </li>

    {{-- {{ dd(auth()->user()->isAbleTo(['read-vendor'])) }} --}}
    @if (auth()->user()->isAbleTo(['read-vendor']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Brand') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Brand') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/vendor"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/vendor/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/upload-brands"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('upload brands') }}</span></a></li>
                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-branch']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Branchs') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Branchs') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/branch"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    {{-- <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/branch/create"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">{{ __('Create') }}</span></a></li> --}}

                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-offer']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Offers') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Offers') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/offers"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    {{-- <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/offers/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li> --}}
                </ul>
            </div>
        </li>
    @endif

    @if (auth()->user()->isAbleTo(['read-subscription']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Subscribes') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Subscribes') }}</span></span>
                    </li>
                    {{-- <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/subscription"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/subscription/create"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Create') }}</span></a></li> --}}
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/index_sub/paid"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('PREMIUM Subscribes') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/index_sub/trial"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Trial Subscribes') }}</span></a></li>


                </ul>
            </div>
        </li>
    @endif


    @if (auth()->user()->isAbleTo(['read-promocode']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('copuon') }}</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('copuon') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/coupun"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>


                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-user']))

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('User') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('User') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/user"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    @if (auth()->user()->isAbleTo(['create-user']))
                        <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/user/create"
                                class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Create') }}</span></a></li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-activition_code']))

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Activation Code') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('code') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/code"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    @if (auth()->user()->isAbleTo(['create-activition_code']))
                        <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/code/create"
                                class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Create') }}</span></a></li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-discount']))

        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Discount Code') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Discount Code') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/discount_code"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>
                    @if (auth()->user()->isAbleTo(['create-discount']))
                        <li class="menu-item " aria-haspopup="true"><a
                                href="/{{ $lang }}/discount_code/create" class="menu-link "><i
                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                    class="menu-text">{{ __('Create') }}</span></a></li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-reference']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Reference codes') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Reference codes') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/perfomeds"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('List') }}</span></a></li>


                </ul>
            </div>


        </li>
    @endif

    @if (auth()->user()->isAbleTo(['read-client']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="/{{ $lang }}/all_clients" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Clients') }}</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    @endif

    @if (auth()->user()->isAbleTo(['read-transaction']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="/{{ $lang }}/transaction" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Transaction') }}</span>
                <i class="menu-arrow"></i>
            </a>



        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-promotion']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="/{{ $lang }}/promotion" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('premotion') }}</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    @endif
    @if (auth()->user()->isAbleTo(['read-page']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="#" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Pages') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu " kt-hidden-height="80" style=""><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                                class="menu-text">{{ __('Pages') }}</span></span>
                    </li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/about_us"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('About Us') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/privacy"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('Privacy') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/termis"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('termis and condition') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/How-it-work"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('How it work') }}</span></a></li>
                    <li class="menu-item " aria-haspopup="true"><a href="/{{ $lang }}/faqs"
                            class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">{{ __('FAQs') }}</span></a></li>


                </ul>
            </div>


        </li>
    @endif
    @if (auth()->user()->isAbleTo(['update-config']))
        <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="/{{ $lang }}/config" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                </span>
                <span class="menu-text">{{ __('Config') }}</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    @endif





</ul>
