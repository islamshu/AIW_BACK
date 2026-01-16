@php
    $items  = $data['items'] ?? [];
    $locale = app()->getLocale();
@endphp

<section class="relative py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach($items as $item)
                @php
                    $label = $locale === 'ar' ? ($item['label_ar'] ?? '') : ($item['label_en'] ?? '');
                    $value = $item['value'] ?? '';
                    $icon  = $item['icon'] ?? null;
                @endphp

                <div class="p-6 rounded-2xl border border-gray-100 shadow-sm">
                    @if($icon)
                        <i class="{{ $icon }} text-3xl text-[#00b4d8] mb-3"></i>
                    @endif
                    <div class="text-3xl font-extrabold text-[#0a192f]">{{ $value }}</div>
                    <div class="mt-1 text-gray-600">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
