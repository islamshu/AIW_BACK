@extends('layouts.frontend')

@section('title', $service->title)

@section('content')

{{-- ================= HERO ================= --}}
<section class="pt-10 relative overflow-hidden"
    style="background: linear-gradient(135deg,var(--bg-color),color-mix(in srgb,var(--bg-color) 85%,white));">

    <div class="container mx-auto px-4 text-center max-w-4xl">

        {{-- ICON --}}
        <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl"
             style="background: color-mix(in srgb,var(--primary-color) 15%,transparent)">
            @if($service->icon)
                <i class="{{ $service->icon }} text-4xl"
                   style="color: var(--primary-color)"></i>
            @elseif($service->image)
                <img src="{{ asset('storage/'.$service->image) }}"
                     class="w-10 h-10 object-contain">
            @endif
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 gradient-text">
            {{ $service->title }}
        </h1>

        <p class="text-xl"
           style="color: color-mix(in srgb,var(--text-color) 70%,transparent)">
            {{ strip_tags($service->excerpt ?? $service->description) }}
        </p>

    </div>
</section>

{{-- ================= CONTENT ================= --}}
{{-- ================= CONTENT ================= --}}
<section class="py-10" style="background: var(--bg-color)">
    <div class="container mx-auto px-4 max-w-4xl">

        <article class="prose prose-lg max-w-none"
                 style="color: var(--text-color)">
            {!! $service->long_description
                ?: $service->description !!}
        </article>

        <div class="mt-14 text-center">
            <a href="{{ route('services.index') }}"
               class="inline-block px-10 py-3 rounded-full font-bold text-white
                      transition hover:scale-105"
               style="background: linear-gradient(135deg,var(--primary-color),var(--secondary-color))">
                ← {{ __('العودة إلى الخدمات') }}
            </a>
        </div>

    </div>
</section>


@endsection
