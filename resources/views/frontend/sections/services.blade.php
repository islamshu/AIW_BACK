@php
        $services = App\Models\HomeService::where('is_active', true)->orderBy('order')->limit(3)->get();

        $count = App\Models\HomeService::where('is_active', true)->count();
    @endphp
    @if($count > 0)
<section class="py-24 relative overflow-hidden" style="background: var(--bg-color);">
    

    <div class="container mx-auto px-4 relative z-10">

        {{-- ================= TITLE ================= --}}
        <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-6 fade-in" style="color: var(--primary-color);">
            {{ app()->getLocale() === 'ar' ? 'لماذا تختار AIW؟' : 'Why Choose AIW?' }}
        </h2>

        <p class="text-center max-w-3xl mx-auto mb-16 fade-in"
            style="color: color-mix(in srgb,var(--text-color) 70%,transparent);">
            {{ app()->getLocale() === 'ar'
                ? 'نقدّم حلولاً متكاملة تجمع بين الاستثمار الذكي والتشغيل الاحترافي لتحقيق نمو مستدام وقيمة طويلة الأمد.'
                : 'We deliver integrated solutions combining smart investment and professional operations to achieve sustainable growth and long-term value.' }}
        </p>

        {{-- ================= SERVICES GRID ================= --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            @foreach ($services as $index => $service)
                <div class="service-card card-hover fade-in" style="transition-delay: {{ $index * 0.1 }}s">

                    {{-- ICON / IMAGE --}}
                    <div class="flex items-center justify-center h-40"
                        style="background: color-mix(in srgb,var(--primary-color) 10%,transparent)">
                        @if ($service->icon)
                            <i class="{{ $service->icon }} text-5xl service-icon"
                                style="color: var(--primary-color)"></i>
                        @elseif($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}"
                                class="w-16 h-16 object-contain service-icon">
                        @endif
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold mb-3" style="color: var(--text-color)">
                            {{ $service->title }}
                        </h3>

                        <p class="text-sm mb-6 leading-relaxed"
                            style="color: color-mix(in srgb,var(--text-color) 70%,transparent)">
                            {{ Str::limit(strip_tags($service->description), 120) }}
                        </p>

                        <a href="{{ route('services.show', $service->id) }}"
                            class="inline-flex items-center gap-2 font-bold text-sm transition"
                            style="color: var(--primary-color)">
                            {{ app()->getLocale() === 'ar' ? 'عرض التفاصيل' : 'View Details' }}
                            <span>→</span>
                        </a>
                    </div>

                </div>
            @endforeach

        </div>

        {{-- ================= VIEW MORE ================= --}}

        @if (get_general_value('services_enabled') && $count > count($services))
            <div class="text-center mt-16 fade-in">
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-3 px-12 py-4 rounded-full font-bold text-white
                       transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                    style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                ">
                    {{ app()->getLocale() === 'ar' ? 'رؤية جميع الخدمات' : 'View All Services' }}
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        @endif

    </div>

    {{-- ================= DECORATIVE BACKGROUND ================= --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-3xl"
            style="background: color-mix(in srgb, var(--primary-color) 15%, transparent);"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-3xl"
            style="background: color-mix(in srgb, var(--secondary-color) 15%, transparent);"></div>
    </div>

</section>
@endif