@php
    $isAr = app()->getLocale() === 'ar';

    $title = $isAr
        ? ($data['title_ar'] ?? '')
        : ($data['title_en'] ?? '');

    $desc = $isAr
        ? ($data['desc_ar'] ?? '')
        : ($data['desc_en'] ?? '');

    $ctaText = $isAr
        ? ($data['cta_text_ar'] ?? null)
        : ($data['cta_text_en'] ?? null);

    $ctaUrl = $data['cta_url'] ?? null;

    $imageId = $data['image_id'] ?? null;
    $media   = $imageId ? \App\Models\Media::find($imageId) : null;

    $hasImage = !empty($media);
@endphp

<section class="relative bg-[#0a192f] overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="min-h-[75vh] flex items-center py-20">

            {{-- GRID --}}
            <div class="
                grid gap-14 items-center w-full
                {{ $hasImage ? 'grid-cols-1 lg:grid-cols-2' : 'grid-cols-1' }}
            ">

                {{-- TEXT --}}
                <div class="
                    {{ $hasImage
                        ? ($isAr ? 'lg:order-2 text-right' : 'lg:order-1 text-left')
                        : 'text-center'
                    }}
                ">

                    

                    {{-- Title --}}
                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                        <span class="bg-gradient-to-r from-[#00b4d8] via-[#a8b2d1] to-[#ff5d8f] bg-clip-text text-transparent">
                            {{ $title }}
                        </span>
                    </h1>

                    {{-- Description --}}
                    @if($desc)
                        <div class="
                            mt-6 text-base md:text-lg text-[#a8b2d1] leading-relaxed
                            {{ $hasImage
                                ? 'max-w-xl ' . ($isAr ? 'ms-auto' : '')
                                : 'max-w-3xl mx-auto'
                            }}
                        ">
                            {!! $desc !!}
                        </div>
                    @endif

                    @if($ctaText && $ctaUrl)
                        <div class="mt-10 {{ !$hasImage ? 'flex justify-center' : '' }}">
                            <a href="{{ $ctaUrl }}"
                               class="
                                   inline-flex items-center gap-2
                                   rounded-full
                                   bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                                   px-8 py-4
                                   text-white font-semibold
                                   shadow-lg
                                   hover:scale-105 transition
                               ">
                                {{ $ctaText }}
                            </a>
                        </div>
                    @endif
                </div>

                {{-- IMAGE --}}
                @if($hasImage)
                    <div class="{{ $isAr ? 'lg:order-1' : 'lg:order-2' }}">
                        <div class="relative flex justify-center">

                            {{-- Glow --}}
                            <div class="absolute -inset-6 rounded-[32px]
                                bg-gradient-to-r from-[#00b4d8]/20 to-[#ff5d8f]/20
                                blur-2xl
                            "></div>

                            {{-- Image --}}
                            <img
                                src="{{ $media->url }}"
                                alt="{{ $media->alt ?? $title }}"
                                class="
                                    relative
                                    w-full max-w-lg
                                    rounded-[32px]
                                    shadow-2xl
                                    object-cover
                                "
                            >
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
