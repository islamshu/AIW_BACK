@php
    $titleAr = $data['title_ar'] ?? '';
    $titleEn = $data['title_en'] ?? '';
    $descAr  = $data['desc_ar'] ?? '';
    $descEn  = $data['desc_en'] ?? '';

    $btnTextAr = $data['button_text_ar'] ?? '';
    $btnTextEn = $data['button_text_en'] ?? '';
    $btnUrl    = $data['button_url'] ?? '#';

    $bgId  = $data['background_image_id'] ?? null;
    $media = $bgId ? \App\Models\Media::find($bgId) : null;

    $title = app()->getLocale() === 'ar' ? $titleAr : $titleEn;
    $desc  = app()->getLocale() === 'ar' ? $descAr  : $descEn;
    $btn   = app()->getLocale() === 'ar' ? $btnTextAr : $btnTextEn;
@endphp

<section class="relative isolate overflow-hidden py-24">
    <div class="absolute inset-0 bg-[#0a192f]"></div>

    @if($media)
        <div class="absolute inset-0">
            <img src="{{ $media->url }}" alt="" class="w-full h-full object-cover opacity-30">
        </div>
    @endif

    <div class="absolute inset-0 bg-gradient-to-r from-[#0a192f]/80 to-[#0a192f]/95"></div>

    <div class="relative container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">{{ $title }}</h2>
        <div class="max-w-2xl mx-auto text-[#a8b2d1] mb-8">{!! $desc !!}</div>

        @if($btn && $btnUrl)
            <a href="{{ $btnUrl }}"
               class="inline-flex items-center rounded-full bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                      px-8 py-4 text-white font-semibold shadow-lg hover:scale-105 transition">
                {{ $btn }}
            </a>
        @endif
    </div>
</section>
