@php
    /** @var \App\Models\HomeSection $section */

    $lang = app()->getLocale();

    /*
    |--------------------------------------------------------------------------
    | CONTENT (من contentable)
    |--------------------------------------------------------------------------
    */
    $content = $section->contentable->content[$lang] ?? '';

    /*
    |--------------------------------------------------------------------------
    | BUTTON (من home_sections)
    |--------------------------------------------------------------------------
    */
    $buttonText = $section->button_text[$lang] ?? null;
    $buttonLink = $section->button_link ?? null;
@endphp

<section
    class="py-24 relative overflow-hidden"
    style="
        background:
            linear-gradient(
                135deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 85%, var(--primary-color))
            );
    "
>
    <div class="container mx-auto px-4 relative z-10">

        <div
            class="rounded-2xl p-10 backdrop-blur-md border border-white/10 shadow-2xl text-center"
            style="background: rgba(255,255,255,0.04)"
        >

            {{-- ================= CONTENT ================= --}}
            @if($content)
                <div
                    class="text-lg leading-relaxed mb-10 max-w-3xl mx-auto"
                    style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                >
                    {!! $content !!}
                </div>
            @endif

            {{-- ================= BUTTON ================= --}}
            @if($buttonText && $buttonLink)
                <div class="flex justify-center">
                    <a
                        href="{{ $buttonLink }}"
                        class="
                            inline-flex items-center gap-3
                            px-9 py-4
                            rounded-full
                            font-semibold
                            text-white
                            transition-all duration-300
                            hover:-translate-y-1
                            hover:shadow-2xl
                        "
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                        "
                    >
                        {{ $buttonText }}

                        @if($lang === 'ar')
                            <i class="fas fa-arrow-left"></i>
                        @else
                            <i class="fas fa-arrow-right"></i>
                        @endif
                    </a>
                </div>
            @endif

        </div>

    </div>

    {{-- ================= DIVIDER ================= --}}
    <div
        class="absolute inset-x-0 bottom-0 h-px"
        style="
            background: linear-gradient(
                90deg,
                transparent,
                var(--primary-color),
                transparent
            );
            opacity: .3;
        "
    ></div>
</section>
