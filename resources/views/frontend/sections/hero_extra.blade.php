@php
    $lang = app()->getLocale();
@endphp

<section
    class="py-28 relative overflow-hidden"
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

        <div class="max-w-4xl mx-auto text-center">

            {{-- TITLE --}}
            @if(!empty($data->title[$lang]))
                <h2
                    class="text-4xl md:text-5xl font-extrabold mb-6 fade-in"
                    style="
                        background: linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );
                        -webkit-background-clip: text;
                        color: transparent;
                    "
                >
                    {{ $data->title[$lang] }}
                </h2>
            @endif

            {{-- SUBTITLE --}}
            @if(!empty($data->subtitle[$lang]))
                <div
                    class="text-lg md:text-xl leading-relaxed mb-10 fade-in"
                    style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                >
                    {!! $data->subtitle[$lang] !!}
                </div>
            @endif

            {{-- BUTTON --}}
            @if(!empty($data->button_text[$lang]))
                <div class="fade-in">
                    <a
                        href="{{ $data->button_link[$lang] ?? '#' }}"
                        class="inline-flex items-center gap-2 px-10 py-4 rounded-full
                               font-semibold text-white
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
                        <i class="fas fa-arrow-{{ $lang === 'ar' ? 'left' : 'right' }}"></i>
                    </a>
                </div>
            @endif

        </div>

    </div>

    {{-- Decorative Background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-24 -right-24 w-96 h-96 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--primary-color) 25%, transparent),
                    transparent 70%
                );
            "
        ></div>

        <div
            class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--secondary-color) 25%, transparent),
                    transparent 70%
                );
            "
        ></div>
    </div>

</section>
