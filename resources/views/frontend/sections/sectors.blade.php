<section class="py-20 bg-[#112240]">
    <div class="container mx-auto px-4">


        @php
              $sectors = App\Models\Sector::where('is_active', true)
        ->orderBy('order')
        ->limit(3)
        ->get();
        $count = App\Models\Sector::where('is_active', true)
        ->orderBy('order')
        ->count()
        @endphp
        {{-- العنوان --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-6 fade-in">
                {{ __('القطاعات الاستراتيجية') }}
            </h2>
            <p class="text-xl text-[#a8b2d1] max-w-3xl mx-auto fade-in">
                {{ __('نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية') }}
            </p>
        </div>

        {{-- القطاعات --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($sectors as $index => $sector)
                <div class="bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                     style="transition-delay: {{ $index * 0.1 }}s;">

                    {{-- الصورة / الأيقونة --}}
                    <div class="relative h-48 overflow-hidden">

                        {{-- Badge --}}
                        @if($sector->badge_text)
                            <div class="sector-badge">
                                {{ $sector->getTranslation('badge_text', app()->getLocale()) }}
                            </div>
                        @endif

                        {{-- خلفية --}}
                        <div class="w-full h-full bg-gradient-to-r
                            from-[{{ $sector->gradient_from }}]
                            to-[{{ $sector->gradient_to }}]
                            flex items-center justify-center">

                            @if($sector->icon)
                                <i class="{{ $sector->icon }} text-white text-6xl floating-icon"></i>
                            @endif
                        </div>

                        {{-- Overlay --}}
                        <div class="image-overlay">
                            <h4 class="text-white font-bold text-lg">
                                {{ $sector->getTranslation('title', app()->getLocale()) }}
                            </h4>
                        </div>
                    </div>

                    {{-- المحتوى --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3">
                            {{ $sector->getTranslation('title', app()->getLocale()) }}
                        </h3>

                        <p class="text-[#8892b0]">
                            {!!  $sector->getTranslation('description', app()->getLocale()) !!}
                        </p>

                        
                    </div>
                </div>
            @endforeach

        </div>

        {{-- زر عرض الكل --}}
        @if(get_general_value('sectors_enabled'))
        @if($count > count($sectors))
        <div class="text-center mt-12 fade-in">

            <a href="/sectors"
               class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
               text-white font-bold py-3 px-8 rounded-full inline-flex items-center gap-2
               hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                <span>{{ __('عرض جميع القطاعات') }}</span>
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        @endif
        @endif

    </div>
</section>
