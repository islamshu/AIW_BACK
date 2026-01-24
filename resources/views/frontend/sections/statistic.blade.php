<section
    class="py-16 relative overflow-hidden"
    style="
        background:
            linear-gradient(
                180deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 88%, var(--primary-color))
            );
    "
>
    <div class="container mx-auto px-4 relative z-10">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            @foreach (App\Models\HomeStat::orderBy('order')->get() as $index => $sta)

                <div
                    class="text-center fade-in transition-all duration-300 hover:-translate-y-1"
                    style="transition-delay: {{ $index * 0.1 }}s;"
                >

                    {{-- VALUE --}}
                    <div
                        class="text-3xl md:text-4xl font-extrabold mb-2"
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
                        {{ $sta->value }}
                    </div>

                    {{-- LABEL --}}
                    <div
                        class="text-sm md:text-base font-medium"
                        style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                    >
                        {{ $sta->label }}
                    </div>

                </div>

            @endforeach

        </div>
    </div>

    {{-- Decorative Glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-24 -right-24 w-72 h-72 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--primary-color) 18%, transparent),
                    transparent 70%
                );
            "
        ></div>
        <div
            class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--secondary-color) 18%, transparent),
                    transparent 70%
                );
            "
        ></div>
    </div>

</section>
