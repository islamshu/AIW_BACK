@php
    $isAr = app()->getLocale() === 'ar';

    /* ================= TEXT ================= */
    $title = $isAr ? ($data['title_ar'] ?? '') : ($data['title_en'] ?? '');
    $desc  = $isAr ? ($data['desc_ar'] ?? '')  : ($data['desc_en'] ?? '');

    $ctaText = $isAr ? ($data['cta_text_ar'] ?? null) : ($data['cta_text_en'] ?? null);
    $ctaUrl  = $data['cta_url'] ?? null;

    /* ================= IMAGE ================= */
    $imageId = $data['image_id'] ?? null;
    $media   = $imageId ? \App\Models\Media::find($imageId) : null;
    $hasImage = !empty($media);

    $imgPosition = $data['image_position'] ?? 'right';
    $imgSize     = $data['image_size'] ?? 'md';
    $imgStyle    = $data['image_style'] ?? 'rounded';
    $imgShadow   = $data['image_shadow'] ?? 'md';

    $imgMaxWidth = match ($imgSize) {
        'sm'   => '220px',
        'md'   => '360px',
        'lg'   => '520px',
        'full' => '100%',
        default => '360px',
    };

    $imgRadius = match ($imgStyle) {
        'circle' => 'rounded-full',
        'square' => 'rounded-none',
        default  => 'rounded-3xl',
    };

    $imgShadowClass = match ($imgShadow) {
        'none' => '',
        'sm'   => 'shadow-md',
        'lg'   => 'shadow-[0_30px_80px_rgba(0,0,0,.45)]',
        default => 'shadow-2xl',
    };

    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']);
@endphp

<section
    dir="{{ $isAr ? 'rtl' : 'ltr' }}"
    class="relative overflow-hidden"
    style="
        background:
            linear-gradient(
                180deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 88%, var(--primary-color))
            );
    "
>
    <div class="container mx-auto px-4 py-20 relative z-10">

        {{-- IMAGE TOP --}}
        @if($hasImage && $imgPosition === 'top')
            <div class="flex justify-center mb-12">
                <img
                    src="{{ $media->url }}"
                    alt="{{ $media->alt ?? $title }}"
                    class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                    style="max-width: {{ $imgMaxWidth }};"
                >
            </div>
        @endif

        {{-- MAIN CONTENT --}}
        <div
            class="
                {{ $isSideImage
                    ? 'grid lg:grid-cols-2 gap-16 items-center'
                    : 'flex flex-col items-center text-center'
                }}
            "
        >

            {{-- IMAGE LEFT --}}
            @if($hasImage && $imgPosition === 'left')
                <div class="flex justify-center lg:order-1">
                    <img
                        src="{{ $media->url }}"
                        alt="{{ $media->alt ?? $title }}"
                        class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                        style="max-width: {{ $imgMaxWidth }};"
                    >
                </div>
            @endif

            {{-- TEXT --}}
            <div
                class="
                    flex flex-col
                    {{ $isSideImage
                        ? ($isAr ? 'text-right' : 'items-start text-left')
                        : 'items-center text-center'
                    }}
                    {{ $hasImage && $imgPosition === 'left' ? 'lg:order-2' : '' }}
                "
            >

                {{-- TITLE --}}
                <h1
                    class="
                        font-extrabold
                        leading-tight
                        tracking-tight
                        text-[clamp(2.2rem,4vw,3.5rem)]
                    "
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
                    {{ $title }}
                </h1>

                {{-- DESCRIPTION --}}
                @if($desc)
                    <div
                        class="
                            mt-6
                            text-[1.05rem] md:text-[1.15rem]
                            leading-[1.9]
                            {{ $isSideImage ? 'max-w-lg' : 'max-w-3xl' }}
                        "
                        style="color: color-mix(in srgb, var(--text-color) 78%, transparent);"
                    >
                        {!! $desc !!}
                    </div>
                @endif

                {{-- CTA --}}
                @if($ctaText && $ctaUrl)
                    <div class="mt-10">
                        <a
                            href="{{ $ctaUrl }}"
                            class="
                                inline-flex items-center gap-2
                                px-9 py-4
                                rounded-full
                                font-semibold
                                text-white
                                transition-all duration-300
                                hover:scale-[1.06]
                            "
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                box-shadow: 0 18px 45px
                                    color-mix(in srgb, var(--primary-color) 40%, transparent);
                            "
                        >
                            {{ $ctaText }}
                        </a>
                    </div>
                @endif

            </div>

            {{-- IMAGE RIGHT --}}
            @if($hasImage && $imgPosition === 'right')
                <div class="flex justify-center lg:order-2">
                    <img
                        src="{{ $media->url }}"
                        alt="{{ $media->alt ?? $title }}"
                        class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                        style="max-width: {{ $imgMaxWidth }};"
                    >
                </div>
            @endif

        </div>

        {{-- IMAGE BOTTOM --}}
        @if($hasImage && $imgPosition === 'bottom')
            <div class="flex justify-center mt-12">
                <img
                    src="{{ $media->url }}"
                    alt="{{ $media->alt ?? $title }}"
                    class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                    style="max-width: {{ $imgMaxWidth }};"
                >
            </div>
        @endif

    </div>

    {{-- DIVIDER --}}
    <div
        class="absolute inset-x-0 bottom-0 h-px"
        style="
            background: linear-gradient(
                90deg,
                transparent,
                var(--primary-color),
                transparent
            );
            opacity: .25;
        "
    ></div>
</section>
