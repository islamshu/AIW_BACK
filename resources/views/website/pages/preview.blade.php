@extends('layouts.frontend')
@section('title', $page->title_ar)

@section('content')

{{-- ================= PAGE PREVIEW ================= --}}
{{-- Page: {{ $page->id }} / {{ $page->slug ?? '' }} --}}

@forelse($layouts as $layout)

    {{-- ================= LAYOUT ROW ================= --}}
    <section class="w-full py-14 md:py-20">
        <div class="container mx-auto px-4">

            {{-- Grid 12 --}}
            <div class="grid grid-cols-12 gap-6 md:gap-10">

                @foreach($layout['columns'] as $column)

                    @php
                        $colSpan = (int) ($column['col'] ?? 12);
                        if ($colSpan < 1 || $colSpan > 12) {
                            $colSpan = 12;
                        }
                    @endphp

                    <div class="col-span-12 lg:col-span-{{ $colSpan }}">

                        {{-- Sections --}}
                        @forelse($column['sections'] as $section)

                            @php
                                $data = is_array($section->data)
                                    ? $section->data
                                    : json_decode($section->data ?? '[]', true);
                            @endphp

                            <div class="mb-10 last:mb-0">

                                @includeIf(
                                    'website.sections.' . $section->type,
                                    [
                                        'section' => $section,
                                        'data'    => $data,
                                        'page'    => $page,
                                        'col'     => $colSpan, // 👈 مهم كما طلبت
                                    ]
                                )

                            </div>

                        @empty
                          
                        @endforelse

                    </div>

                @endforeach

            </div>
        </div>
    </section>
    {{-- ================= END LAYOUT ROW ================= --}}

@empty
    {{-- لا يوجد Layouts --}}
    <section class="py-24">
        <div class="container mx-auto px-4">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-10 text-center">
                <h2 class="text-2xl font-bold mb-2">
                    لا يوجد محتوى بعد
                </h2>
                <p class="text-white/60">
                    هذه الصفحة لا تحتوي على أي أقسام حالياً
                </p>
            </div>
        </div>
    </section>
@endforelse

@endsection
