{{-- Nav --}}
<ul class="navi navi-hover py-4">
    {{-- Item --}}
    @php
        $lang =app()->getLocale();
    @endphp
    @if($lang == 'en')
    <li class="navi-item">
        <a href="{{ route('change.lang','ar') }}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/008-saudi-arabia.svg') }}" alt=""/>
            </span>
            <span class="navi-text">Arabic</span>
        </a>
    </li>
    @else
    <li class="navi-item">
        <a href="{{ route('change.lang','en') }}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt=""/>
            </span>
            <span class="navi-text">English</span>
        </a>
    </li>
    @endif

</ul>
