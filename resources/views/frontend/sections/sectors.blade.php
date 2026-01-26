
@php
$sectors = App\Models\Sector::where('is_active', true)
    ->orderBy('order')
    ->limit(3)
    ->get();

$count = App\Models\Sector::where('is_active', true)->count();
@endphp
@if($count > 0)
<section class="py-20 relative overflow-hidden"
    style="
        background:
            linear-gradient(
                180deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 85%, var(--primary-color))
            );
    ">
    <div class="container mx-auto px-4 relative z-10">


        {{-- ===== TITLE ===== --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-6 fade-in"
                style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                    -webkit-background-clip: text;
                    color: transparent;
                ">
                {{ __('القطاعات الاستراتيجية') }}
            </h2>

            <p class="text-xl max-w-3xl mx-auto fade-in"
                style="color: color-mix(in srgb, var(--text-color) 70%, transparent);">
                {{ __('نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية') }}
            </p>
        </div>

        {{-- ===== SECTORS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($sectors as $index => $sector)
                <div class="rounded-2xl overflow-hidden fade-in
                           transition-all duration-300
                           hover:-translate-y-2 hover:shadow-2xl"
                    style="
                        background: rgba(255,255,255,0.04);
                        border: 1px solid rgba(255,255,255,0.08);
                        backdrop-filter: blur(6px);
                        transition-delay: {{ $index * 0.1 }}s;
                    ">

                    {{-- IMAGE / ICON --}}
                    <div class="relative h-48 overflow-hidden">

                        {{-- BADGE --}}
                        @if ($sector->badge_text)
                            <div class="absolute top-4 start-4 z-10 px-4 py-1 rounded-full text-sm font-bold text-white"
                                style="
                                    background: linear-gradient(
                                        135deg,
                                        var(--primary-color),
                                        var(--secondary-color)
                                    );
                                ">
                                {{ $sector->getTranslation('badge_text', app()->getLocale()) }}
                            </div>
                        @endif

                        {{-- GRADIENT ICON AREA --}}
                        <div class="w-full h-full flex items-center justify-center"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    color-mix(in srgb, var(--primary-color) 35%, transparent),
                                    color-mix(in srgb, var(--secondary-color) 35%, transparent)
                                );
                            ">
                            @if ($sector->icon)
                                <i class="{{ $sector->icon }} text-white text-6xl"></i>
                            @endif
                        </div>

                        {{-- OVERLAY TITLE --}}
                        <div class="absolute inset-0 flex items-end p-4"
                            style="
                                background: linear-gradient(
                                    to top,
                                    rgba(0,0,0,.55),
                                    transparent
                                );
                            ">
                            <h4 class="text-white font-bold text-lg">
                                {{ $sector->getTranslation('title', app()->getLocale()) }}
                            </h4>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3">
                            {{ $sector->getTranslation('title', app()->getLocale()) }}
                        </h3>

                        <p style="color: color-mix(in srgb, var(--text-color) 70%, transparent);">
                            {!! $sector->getTranslation('description', app()->getLocale()) !!}
                        </p>
                    </div>

                </div>
            @endforeach

        </div>

        {{-- ===== VIEW ALL BUTTON ===== --}}
        @if (get_general_value(key: 'sectors_enabled') && $count > count($sectors))
            <div class="text-center mt-12 fade-in">
                <a href="/sectors"
                    class="inline-flex items-center gap-2 px-8 py-3 rounded-full font-bold text-white
                           transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    style="
                        background: linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );
                    ">
                    <span> {{ app()->getLocale() === 'ar' ? 'رؤية جميع القطاعات' : 'View All Sectors' }}
                    </span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        @endif

    </div>

    {{-- Decorative Glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--primary-color) 20%, transparent),
                    transparent 70%
                );
            ">
        </div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--secondary-color) 20%, transparent),
                    transparent 70%
                );
            ">
        </div>
    </div>

</section>
@endif
