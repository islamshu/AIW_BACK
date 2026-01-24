@php
    $lang = app()->getLocale();
@endphp

<section
    class="py-24 relative"
    style="
        background:
            linear-gradient(
                180deg,
                color-mix(in srgb, var(--bg-color) 96%, transparent),
                var(--bg-color)
            );
    "
>
    <div class="container mx-auto px-4">

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($data->items as $item)
                <div
                    class="rounded-2xl p-8 fade-in
                           transition-all duration-300
                           hover:-translate-y-2 hover:shadow-2xl"
                    style="
                        background: rgba(255,255,255,0.04);
                        border: 1px solid rgba(255,255,255,0.08);
                        backdrop-filter: blur(6px);
                    "
                >

                    <h4
                        class="text-xl font-bold mb-3"
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
                        {{ $item['title'][$lang] ?? '' }}
                    </h4>

                    <p
                        class="leading-relaxed"
                        style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                    >
                        {{ $item['desc'][$lang] ?? '' }}
                    </p>

                </div>
            @endforeach

        </div>

    </div>
</section>
