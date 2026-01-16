@php
    $isAr = app()->getLocale() === 'ar';

    // عنوان القسم
    $sectionTitle = $isAr
        ? ($data['title_ar'] ?? null)
        : ($data['title_en'] ?? null);

    // عناصر الريبيتر
    $items = $data['items'] ?? [];

    if (!is_array($items) || count($items) === 0) {
        return;
    }

    // طريقة العرض
    // multi  = كل عنصر داخل كارد
    // single = كل العناصر داخل كارد واحد
    $mode = $data['display_mode'] ?? 'multi';

    // عدد الأعمدة حسب عرض العمود
    if ($col >= 10) {
        $grid = 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3';
    } elseif ($col >= 7) {
        $grid = 'grid-cols-1 sm:grid-cols-2';
    } else {
        $grid = 'grid-cols-1';
    }
@endphp

<section class="relative">

    {{-- =======================
       عنوان القسم
    ======================== --}}
    @if($sectionTitle)
        <div class="mb-12 {{ $isAr ? 'text-right' : 'text-left' }}">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight
                       bg-gradient-to-r from-[#00b4d8] via-[#a8b2d1] to-[#ff5d8f]
                       bg-clip-text text-transparent">
                {{ $sectionTitle }}
            </h2>
        </div>
    @endif

    {{-- =================================================
       MODE: كل عنصر داخل كارد مستقل
    ================================================== --}}
    @if($mode === 'multi')
        <div class="grid {{ $grid }} gap-8">

            @foreach($items as $item)
                @php
                    $title = $isAr ? ($item['title_ar'] ?? '') : ($item['title_en'] ?? '');
                    $desc  = $isAr ? ($item['desc_ar'] ?? '')  : ($item['desc_en'] ?? '');
                    $icon  = $item['icon'] ?? 'fa-regular fa-star';
                    $color = $item['icon_color'] ?? '#00b4d8';
                @endphp

                <div class="rounded-3xl p-8
                            bg-white/5 backdrop-blur-md
                            border border-white/10
                            transition-all duration-300
                            hover:-translate-y-2
                            hover:border-[#00b4d8]/40
                            hover:shadow-[0_20px_40px_-20px_rgba(0,180,216,0.35)]">

                    <div class="mb-6 h-14 w-14 flex items-center justify-center rounded-2xl"
                         style="background: {{ $color }}22;">
                        <i class="{{ $icon }}" style="color: {{ $color }}"></i>
                    </div>

                    @if($title)
                        <h3 class="mb-3 text-lg font-bold text-white">
                            {{ $title }}
                        </h3>
                    @endif

                    @if($desc)
                        <p class="text-sm text-[#a8b2d1] leading-relaxed">
                            {{ $desc }}
                        </p>
                    @endif
                </div>
            @endforeach

        </div>
    @endif

    {{-- =================================================
       MODE: كل العناصر داخل كارد واحد
    ================================================== --}}
    @if($mode === 'single')
        <div class="rounded-3xl p-10
                    bg-white/5 backdrop-blur-md
                    border border-white/10">

            <div class="grid {{ $grid }} gap-8">

                @foreach($items as $item)
                    @php
                        $title = $isAr ? ($item['title_ar'] ?? '') : ($item['title_en'] ?? '');
                        $desc  = $isAr ? ($item['desc_ar'] ?? '')  : ($item['desc_en'] ?? '');
                        $icon  = $item['icon'] ?? 'fa-regular fa-star';
                        $color = $item['icon_color'] ?? '#00b4d8';
                    @endphp

                    <div class="flex gap-4 items-start">

                        <div class="h-12 w-12 flex items-center justify-center rounded-xl flex-shrink-0"
                             style="background: {{ $color }}22;">
                            <i class="{{ $icon }}" style="color: {{ $color }}"></i>
                        </div>

                        <div>
                            @if($title)
                                <h4 class="text-base font-bold text-white mb-1">
                                    {{ $title }}
                                </h4>
                            @endif

                            @if($desc)
                                <p class="text-sm text-[#a8b2d1] leading-relaxed">
                                    {{ $desc }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif

</section>
