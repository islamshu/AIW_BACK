@foreach($sectors as $sector)
<div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in appear">

    <div class="relative">
        @if($sector->badge_text)
            <div class="sector-badge">
                {{ $sector->getTranslation('badge_text', app()->getLocale()) }}
            </div>
        @endif

        <div class="h-48 bg-gradient-to-r
            from-[{{ $sector->gradient_from }}]
            to-[{{ $sector->gradient_to }}]
            flex items-center justify-center">

            @if($sector->icon)
                <i class="{{ $sector->icon }} text-white text-6xl sector-icon"></i>
            @endif
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-white mb-3">
            {{ $sector->getTranslation('title', app()->getLocale()) }}
        </h3>

        <p class="text-[#8892b0] mb-4">
            {!! $sector->getTranslation('description', app()->getLocale()) !!}
        </p>

        {{-- Market --}}
        @if($sector->market_value && $sector->market_percent)
            <div class="mb-2 flex justify-between">
                <span class="text-sm text-[#a8b2d1]">{{ __('حجم السوق') }}</span>
                <span class="text-sm font-bold text-[#00b4d8]">
                    {{ $sector->market_value }}B
                </span>
            </div>

            <div class="w-full bg-gray-700 rounded-full h-2">
                <div class="market-size-bar h-2 rounded-full"
                     style="width: {{ $sector->market_percent }}%"></div>
            </div>
        @endif
    </div>

</div>
@endforeach
