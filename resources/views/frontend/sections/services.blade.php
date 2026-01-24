<section
    class="py-24 relative overflow-hidden"
    style="background: var(--bg-color);"
>

    <div class="container mx-auto px-4 relative z-10">

        {{-- TITLE --}}
        <h2
            class="text-3xl md:text-4xl font-extrabold text-center mb-16 fade-in"
            style="color: var(--primary-color);"
        >
            {{ app()->getLocale() === 'ar' ? 'لماذا تختار AIW؟' : 'Why Choose AIW?' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            @foreach (App\Models\HomeService::where('is_active', true)->orderBy('order')->get() as $index => $service)

                <div
                    class="rounded-2xl p-8 fade-in transition-all duration-300 hover:-translate-y-2"
                    style="
                        background: #ffffff;
                        border: 1px solid #e2e8f0;
                        transition-delay: {{ $index * 0.1 }}s;
                    "
                >

                    {{-- ICON OR IMAGE --}}
                    <div
                        class="w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-6 overflow-hidden"
                        style="
                            background: color-mix(in srgb, var(--primary-color) 12%, transparent);
                        "
                    >
                        {{-- ICON --}}
                        @if ($service->icon)
                            <i
                                class="{{ $service->icon }}"
                                style="
                                    color: var(--primary-color);
                                    font-size: 24px;
                                "
                            ></i>

                        {{-- IMAGE --}}
                        @elseif ($service->image)
                            <img
                                src="{{ asset('storage/' . $service->image) }}"
                                alt="{{ $service->title }}"
                                class="w-8 h-8 object-contain"
                            >
                        @endif
                    </div>

                    {{-- TITLE --}}
                    <h3
                        class="text-lg font-bold text-center mb-3"
                        style="color: var(--text-color);"
                    >
                        {{ $service->title }}
                    </h3>

                    {{-- DESCRIPTION --}}
                    <p
                        class="text-center text-sm leading-relaxed"
                        style="color: color-mix(in srgb, var(--text-color) 80%, transparent);"
                    >
                        {!! strip_tags($service->description) !!}
                    </p>

                </div>

            @endforeach

        </div>
    </div>

    {{-- DECORATIVE BACKGROUND --}}
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-3xl"
            style="background: color-mix(in srgb, var(--primary-color) 15%, transparent);"
        ></div>
        <div
            class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-3xl"
            style="background: color-mix(in srgb, var(--secondary-color) 15%, transparent);"
        ></div>
    </div>

</section>
