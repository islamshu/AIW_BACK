@php
    $textAr  = $data['text_ar'] ?? '';
    $textEn  = $data['text_en'] ?? '';
    $content = app()->getLocale() === 'ar' ? $textAr : $textEn;
    $isAr    = app()->getLocale() === 'ar';

    $image    = $data['image'] ?? null;
    $hasImage = !empty($image);

    $imgPosition = $data['image_position'] ?? 'right';
    $imgSize     = $data['image_size'] ?? 'md';
    $imgStyle    = $data['image_style'] ?? 'rounded';
    $imgShadow   = $data['image_shadow'] ?? 'md';

    $imgRadius = match($imgStyle) {
        'circle' => 'rounded-full',
        'square' => 'rounded-none',
        default  => 'rounded-3xl',
    };

    $imgShadowClass = match($imgShadow) {
        'none' => '',
        'sm'   => 'shadow-md',
        'lg'   => 'shadow-[0_30px_80px_rgba(0,0,0,.45)]',
        default => 'shadow-2xl',
    };

    $imgMaxWidth = match($imgSize) {
        'sm' => 'max-w-[220px]',
        'md' => 'max-w-[360px]',
        'lg' => 'max-w-[520px]',
        'full' => 'w-full',
        default => 'max-w-[360px]',
    };

    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']) && $imgSize !== 'full';

    if ($isSideImage) {
        $gridCols = match($imgSize) {
            'sm' => $imgPosition === 'left'
                ? 'lg:grid-cols-[1fr_3fr]'
                : 'lg:grid-cols-[3fr_1fr]',

            'md' => 'lg:grid-cols-2',

            'lg' => $imgPosition === 'left'
                ? 'lg:grid-cols-[2fr_3fr]'
                : 'lg:grid-cols-[3fr_2fr]',

            default => 'lg:grid-cols-2',
        };
    }
@endphp

<section class="relative overflow-hidden">
    <div class="container mx-auto px-4 py-20">

        {{-- IMAGE TOP --}}
        @if($hasImage && $imgPosition === 'top')
            <div class="flex justify-center mb-14">
                <img src="{{ $image }}" class="{{ $imgMaxWidth }} {{ $imgRadius }} {{ $imgShadowClass }}">
            </div>
        @endif

        {{-- SIDE IMAGE --}}
        @if($hasImage && $isSideImage)
            <div class="grid gap-12 items-center {{ $gridCols }}">

                @if($imgPosition === 'left')
                    {{-- IMAGE --}}
                    <div class="flex justify-center">
                        <img src="{{ $image }}" class="{{ $imgMaxWidth }} {{ $imgRadius }} {{ $imgShadowClass }}">
                    </div>
                @endif

                {{-- TEXT --}}
                <div class="{{ $isAr ? 'text-right' : 'text-left' }}">
                    <div class="bg-white/80 rounded-3xl px-10 py-14 shadow-sm">
                        {!! $content !!}
                    </div>
                </div>

                @if($imgPosition === 'right')
                    {{-- IMAGE --}}
                    <div class="flex justify-center">
                        <img src="{{ $image }}" class="{{ $imgMaxWidth }} {{ $imgRadius }} {{ $imgShadowClass }}">
                    </div>
                @endif

            </div>
        @endif

        {{-- NO SIDE IMAGE --}}
        @if(!$isSideImage)
            <div class="{{ $isAr ? 'text-right' : 'text-left' }}">
                {!! $content !!}
            </div>
        @endif

        {{-- IMAGE BOTTOM --}}
        @if($hasImage && $imgPosition === 'bottom')
            <div class="flex justify-center mt-14">
                <img src="{{ $image }}" class="{{ $imgMaxWidth }} {{ $imgRadius }} {{ $imgShadowClass }}">
            </div>
        @endif

    </div>
</section>
