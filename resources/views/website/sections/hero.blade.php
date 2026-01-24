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
            <div class="flex justify-center mb-10">
                <img
                    src="{{ $media->url }}"
                    alt="{{ $media->alt ?? $title }}"
                    class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                    style="max-width: {{ $imgMaxWidth }};"
                >
            </div>
        @endif

        {{-- CONTENT --}}
        <div class="{{ $isSideImage ? 'grid lg:grid-cols-2 gap-14 items-center' : 'text-center' }}">

            {{-- IMAGE LEFT --}}
            @if($hasImage && $imgPosition === 'left')
                <div class="flex justify-center">
                    <img
                        src="{{ $media->url }}"
                        alt="{{ $media->alt ?? $title }}"
                        class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                        style="max-width: {{ $imgMaxWidth }};"
                    >
                </div>
            @endif

            {{-- TEXT --}}
            <div class="{{ $isAr ? 'text-right' : 'text-left' }}">

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                    <span
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
                    </span>
                </h1>

                @if($desc)
                    <div
                        class="mt-6 text-base md:text-lg leading-relaxed
                               {{ $isSideImage ? 'max-w-xl' : 'max-w-3xl mx-auto' }}"
                        style="color: color-mix(in srgb, var(--text-color) 75%, transparent);"
                    >
                        {!! $desc !!}
                    </div>
                @endif

                @if($ctaText && $ctaUrl)
                    <div class="mt-8 {{ !$isSideImage ? 'flex justify-center' : '' }}">
                        <a
                            href="{{ $ctaUrl }}"
                            class="inline-flex items-center gap-2 px-8 py-4 rounded-full
                                   font-semibold text-white
                                   transition-all duration-300 hover:scale-105"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                box-shadow: 0 20px 50px color-mix(in srgb, var(--primary-color) 35%, transparent);
                            "
                        >
                            {{ $ctaText }}
                        </a>
                    </div>
                @endif

            </div>

            {{-- IMAGE RIGHT --}}
            @if($hasImage && $imgPosition === 'right')
                <div class="flex justify-center">
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
            <div class="flex justify-center mt-10">
                <img
                    src="{{ $media->url }}"
                    alt="{{ $media->alt ?? $title }}"
                    class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                    style="max-width: {{ $imgMaxWidth }};"
                >
            </div>
        @endif

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
            opacity: .25;
        "
    ></div>

</section>
