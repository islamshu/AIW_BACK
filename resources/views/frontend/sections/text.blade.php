@php
    $lang = app()->getLocale();
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

            {{-- CONTENT --}}
            <div
                class="text-lg leading-relaxed mb-10 max-w-3xl mx-auto"
                style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
            >
                {!! $data->content[$lang] ?? '' !!}
            </div>

            {{-- BUTTON --}}
            @if(!empty($data->button_text[$lang]))
                <div class="flex justify-center">
                    <a
                        href="{{ $data->button_link[$lang] }}"
                        class="inline-flex items-center gap-2
                               px-8 py-3 rounded-full font-semibold text-white
                               transition-all duration-300
                               hover:-translate-y-1 hover:shadow-2xl"
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                        "
                    >
                        {{ $data->button_text[$lang] }}
                        <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                    </a>
                </div>
            @endif

        </div>

    </div>

    {{-- Divider --}}
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
