@php
    $isAr = app()->getLocale() === 'ar';

    // عنوان القسم
    $sectionTitle = $isAr
        ? ($data['title_ar'] ?? null)
        : ($data['title_en'] ?? null);

    // عناصر الريبيتر
    $items = $data['items'] ?? [];
    if (!is_array($items) || count($items) === 0) return;

    // طريقة العرض
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
            <h2
                class="text-2xl md:text-3xl font-extrabold tracking-tight"
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
                @endphp

                <div
                    class="rounded-3xl p-8 backdrop-blur-md border
                           transition-all duration-300
                           hover:-translate-y-2"
                    style="
                        background: color-mix(in srgb, var(--bg-color) 85%, white);
                        border-color: color-mix(in srgb, var(--text-color) 12%, transparent);
                    "
                >
                    <div class="flex items-center gap-4 mb-4">

                        <div
                            class="h-14 w-14 flex items-center justify-center rounded-2xl"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                opacity: .18;
                            "
                        >
                            <i class="{{ $icon }}" style="color: var(--primary-color)"></i>
                        </div>

                        @if($title)
                            <h3 class="text-lg font-bold text-[var(--text-color)]">
                                {{ $title }}
                            </h3>
                        @endif
                    </div>

                    @if($desc)
                        <p
                            class="text-sm leading-relaxed"
                            style="color: color-mix(in srgb, var(--text-color) 75%, transparent);"
                        >
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
        <div
            class="rounded-3xl p-10 backdrop-blur-md border"
            style="
                background: color-mix(in srgb, var(--bg-color) 85%, white);
                border-color: color-mix(in srgb, var(--text-color) 12%, transparent);
            "
        >
            <div class="grid {{ $grid }} gap-8">

                @foreach($items as $item)
                    @php
                        $title = $isAr ? ($item['title_ar'] ?? '') : ($item['title_en'] ?? '');
                        $desc  = $isAr ? ($item['desc_ar'] ?? '')  : ($item['desc_en'] ?? '');
                        $icon  = $item['icon'] ?? 'fa-regular fa-star';
                    @endphp

                    <div class="flex gap-4 items-start">

                        <div
                            class="h-12 w-12 flex items-center justify-center rounded-xl flex-shrink-0"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                opacity: .18;
                            "
                        >
                            <i class="{{ $icon }}" style="color: var(--primary-color)"></i>
                        </div>

                        <div>
                            @if($title)
                                <h4 class="text-base font-bold text-[var(--text-color)] mb-1">
                                    {{ $title }}
                                </h4>
                            @endif

                            @if($desc)
                                <p
                                    class="text-sm leading-relaxed"
                                    style="color: color-mix(in srgb, var(--text-color) 75%, transparent);"
                                >
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
