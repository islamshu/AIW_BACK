@php
    $lang = app()->getLocale();
@endphp

<section class="py-24 bg-[#0a192f]">
    <div class="container mx-auto px-4">

        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 shadow-2xl text-center">

            <div class="text-gray-300 text-lg leading-relaxed mb-10">
                {!! $data->content[$lang] ?? '' !!}
            </div>

            @if(!empty($data->button_text[$lang]))
                <div class="flex justify-center">
                    <a href="{{ $data->button_link[$lang] }}"
                       class="inline-flex items-center gap-2 px-8 py-3 rounded-full
                              bg-gradient-to-r from-[var(--sky-blue)] to-[var(--pink)]
                              text-white font-semibold shadow-lg
                              transition hover:scale-105">
                        {{ $data->button_text[$lang] }}
                        <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                    </a>
                </div>
            @endif

        </div>

    </div>
</section>
