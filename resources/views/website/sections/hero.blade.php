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

    $imgPosition = $data['image_position'] ?? 'right'; // top | bottom | left | right
    $imgSize     = $data['image_size'] ?? 'md';        // sm | md | lg | full
    $imgStyle    = $data['image_style'] ?? 'rounded';  // rounded | circle | square
    $imgShadow   = $data['image_shadow'] ?? 'md';      // none | sm | md | lg

    /* ================= IMAGE SIZE (REAL SIZE) ================= */
    $imgMaxWidth = match ($imgSize) {
        'sm'   => '220px',
        'md'   => '360px',
        'lg'   => '520px',
        'full' => '100%',
        default => '360px',
    };

    /* ================= IMAGE STYLE ================= */
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

<section class="relative bg-[#0a192f] overflow-hidden">
    <div class="container mx-auto px-4 py-20">

        {{-- IMAGE TOP --}}
        @if($hasImage && $imgPosition === 'top')
            <div class="flex justify-center mb-10">
                <img
                    src="{{ $media->url }}"
                    alt="{{ $media->alt ?? $title }}"
                    class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                    style="max-width: {{ $imgMaxWidth }}; height:auto;"
                >
            </div>
        @endif

        {{-- CONTENT --}}
        <div class="
            {{ $isSideImage ? 'grid lg:grid-cols-2 gap-14 items-center' : 'text-center' }}
        ">

            {{-- IMAGE LEFT --}}
            @if($hasImage && $imgPosition === 'left')
                <div class="flex justify-center">
                    <img
                        src="{{ $media->url }}"
                        alt="{{ $media->alt ?? $title }}"
                        class="{{ $imgRadius }} {{ $imgShadowClass }} object-contain"
                        style="max-width: {{ $imgMaxWidth }}; height:auto;"
                    >
                </div>
            @endif

            {{-- TEXT --}}
            <div class="{{ $isAr ? 'text-right' : 'text-left' }}">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                    <span class="bg-gradient-to-r from-[#00b4d8] via-[#a8b2d1] to-[#ff5d8f]
                                 bg-clip-text text-transparent">
                        {{ $title }}
                    </span>
                </h1>

                @if($desc)
                    <div class="mt-6 text-base md:text-lg text-[#a8b2d1] leading-relaxed
                        {{ $isSideImage ? 'max-w-xl' : 'max-w-3xl mx-auto' }}">
                        {!! $desc !!}
                    </div>
                @endif

                @if($ctaText && $ctaUrl)
                    <div class="mt-8 {{ !$isSideImage ? 'flex justify-center' : '' }}">
                        <a href="{{ $ctaUrl }}"
                           class="inline-flex items-center gap-2
                                  rounded-full
                                  bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                                  px-8 py-4
                                  text-white font-semibold
                                  shadow-lg
                                  hover:scale-105 transition">
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
                        style="max-width: {{ $imgMaxWidth }}; height:auto;"
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
                    style="max-width: {{ $imgMaxWidth }}; height:auto;"
                >
            </div>
        @endif

    </div>
</section>
