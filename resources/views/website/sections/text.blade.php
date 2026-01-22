@php
    // ================= TEXT =================
    $textAr  = $data['text_ar'] ?? '';
    $textEn  = $data['text_en'] ?? '';
    $content = app()->getLocale() === 'ar' ? $textAr : $textEn;
    $isAr    = app()->getLocale() === 'ar';

    // ================= IMAGE =================
    $image    = $data['image'] ?? null;
    $hasImage = !empty($image);

    // settings
    $imgPosition = $data['image_position'] ?? 'right'; // left | right | top | bottom
    $imgSize     = $data['image_size'] ?? 'md';        // sm | md | lg | full
    $imgStyle    = $data['image_style'] ?? 'rounded';  // rounded | circle | square
    $imgShadow   = $data['image_shadow'] ?? 'md';      // none | sm | md | lg

    // ================= GRID LOGIC =================
    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']);

    // توزيع الأعمدة حسب حجم الصورة
    if ($isSideImage) {
        $gridCols = match($imgSize) {
            'sm' => 'lg:grid-cols-[1fr_3fr]',   // صورة 25%
            'lg' => 'lg:grid-cols-[2fr_3fr]',   // صورة ~40%
            default => 'lg:grid-cols-2',        // 50 / 50
        };

        // لو الصورة على اليسار نبدّل الأعمدة
        if ($imgPosition === 'left') {
            $gridCols = str_replace('[1fr_3fr]', '[3fr_1fr]', $gridCols);
            $gridCols = str_replace('[2fr_3fr]', '[3fr_2fr]', $gridCols);
        }
    }

    // ================= IMAGE STYLE =================
    $imgRadius = match($imgStyle) {
        'circle' => 'rounded-full',
        'square' => 'rounded-none',
        default  => 'rounded-[28px]',
    };

    $imgShadowClass = match($imgShadow) {
        'none' => '',
        'sm'   => 'shadow-md',
        'lg'   => 'shadow-[0_30px_80px_rgba(0,0,0,.45)]',
        default => 'shadow-2xl',
    };
@endphp

<section class="relative">
    <div class="container mx-auto px-4">
        <div class="py-20">

            {{-- ================= IMAGE TOP ================= --}}
            @if($hasImage && $imgPosition === 'top')
                <div class="flex justify-center mb-14">
                    <img src="{{ $image }}"
                         class="w-full max-w-3xl {{ $imgRadius }} {{ $imgShadowClass }} object-cover">
                </div>
            @endif

            {{-- ================= GRID ================= --}}
            <div class="
                grid gap-14 items-center
                {{ $isSideImage ? $gridCols : 'grid-cols-1' }}
            ">

                {{-- ================= IMAGE (LEFT / RIGHT) ================= --}}
                @if($hasImage && $isSideImage)
                    <div class="flex justify-center">
                        <div class="relative w-full">

                            {{-- Glow --}}
                            <div class="absolute -inset-4 {{ $imgRadius }}
                                bg-gradient-to-r from-[#00b4d8]/20 to-[#ff5d8f]/20
                                blur-2xl"></div>

                            <img src="{{ $image }}"
                                 alt="Section image"
                                 class="
                                    relative w-full
                                    {{ $imgRadius }}
                                    {{ $imgShadowClass }}
                                    object-cover
                                 ">
                        </div>
                    </div>
                @endif

                {{-- ================= TEXT ================= --}}
                <div class="{{ $isAr ? 'text-right' : 'text-left' }}">
                    <div class="relative h-full">

                        {{-- Card background --}}
                        <div class="
                            absolute inset-0
                            rounded-3xl
                            bg-white/5
                            backdrop-blur-md
                            border border-white/10
                        "></div>

                        <div class="relative px-10 py-14">

                            <div class="
                                prose prose-lg
                                {{ $isSideImage ? 'max-w-none' : 'max-w-3xl mx-auto' }}

                                prose-headings:text-white
                                prose-headings:font-extrabold
                                prose-headings:tracking-tight

                                prose-h2:text-3xl
                                prose-h3:text-2xl

                                prose-p:text-[#a8b2d1]
                                prose-p:leading-relaxed

                                prose-strong:text-white

                                prose-a:text-[#00b4d8]
                                hover:prose-a:underline

                                prose-ul:text-[#a8b2d1]
                                prose-li:marker:text-[#00b4d8]

                                prose-blockquote:border-s-4
                                prose-blockquote:border-[#00b4d8]
                                prose-blockquote:bg-white/5
                                prose-blockquote:text-white
                                prose-blockquote:rounded-xl
                                prose-blockquote:px-6
                                prose-blockquote:py-4
                                prose-blockquote:not-italic
                            ">
                                {!! $content !!}
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- ================= IMAGE BOTTOM ================= --}}
            @if($hasImage && $imgPosition === 'bottom')
                <div class="flex justify-center mt-14">
                    <img src="{{ $image }}"
                         class="w-full max-w-3xl {{ $imgRadius }} {{ $imgShadowClass }} object-cover">
                </div>
            @endif

        </div>
    </div>
</section>
