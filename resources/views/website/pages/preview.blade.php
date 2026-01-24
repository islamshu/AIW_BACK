@extends('layouts.frontend')
@section('title', $page->title[app()->getLocale()])

@section('content')

{{-- ================= PAGE PREVIEW ================= --}}
{{-- Page: {{ $page->id }} / {{ $page->slug ?? '' }} --}}

@forelse($layouts as $layout)

    {{-- ================= LAYOUT ROW ================= --}}
    <section
        class="w-full py-14 md:py-20 relative"
        style="
            background:
                linear-gradient(
                    180deg,
                    var(--bg-color),
                    color-mix(in srgb, var(--bg-color) 90%, var(--primary-color))
                );
        "
    >
        <div class="container mx-auto px-4 relative z-10">

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

                            <div
                                class="mb-10 last:mb-0 rounded-2xl p-6 md:p-8
                                       transition-all duration-300"
                                style="
                                    background: rgba(255,255,255,0.04);
                                    border: 1px solid rgba(255,255,255,0.08);
                                    backdrop-filter: blur(6px);
                                "
                            >

                                @includeIf(
                                    'website.sections.' . $section->type,
                                    [
                                        'section' => $section,
                                        'data'    => $data,
                                        'page'    => $page,
                                        'col'     => $colSpan,
                                    ]
                                )

                            </div>

                        @empty
                        @endforelse

                    </div>

                @endforeach

            </div>
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
    {{-- ================= END LAYOUT ROW ================= --}}

@empty

    {{-- لا يوجد Layouts --}}
    <section class="py-24">
        <div class="container mx-auto px-4">
            <div
                class="rounded-2xl p-10 text-center"
                style="
                    background: rgba(255,255,255,0.04);
                    border: 1px solid rgba(255,255,255,0.08);
                "
            >
                <h2
                    class="text-2xl font-bold mb-2"
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
                    {{ __('لا يوجد محتوى بعد') }}
                </h2>

                <p style="color: color-mix(in srgb, var(--text-color) 70%, transparent);">
                    {{ __('هذه الصفحة لا تحتوي على أي أقسام حالياً') }}
                </p>
            </div>
        </div>
    </section>

@endforelse

@endsection
