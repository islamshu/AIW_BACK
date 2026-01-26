@extends('layouts.frontend')

@section('title', $news->title)

@section('content')
<section class="py-20">
    <div class="container mx-auto px-4 max-w-4xl">

        {{-- IMAGE --}}
        <img src="{{ asset('storage/' . $news->image) }}"
             class="rounded-2xl mb-8 w-full">

        {{-- META --}}
        <span class="text-sm text-gray-400">
            {{ $news->published_at->format('Y-m-d') }}
        </span>

        {{-- TITLE --}}
        <h1 class="text-4xl font-extrabold my-4">
            {{ $news->title }}
        </h1>

        {{-- CONTENT --}}
        <article class="prose max-w-none">
            {!! $news->content !!}
        </article>

    </div>
</section>
@endsection
