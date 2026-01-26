@extends('layouts.frontend')

@section('title', app()->getLocale() === 'ar' ? 'الاخبار' : 'News')

@section('content')
<section class="py-20">
    <div class="container mx-auto px-4">

        <h1 class="text-4xl font-extrabold mb-10 text-center">
            {{ app()->getLocale() === 'ar' ? 'الاخبار' : 'News' }}
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach($news as $item)
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                {{-- IMAGE --}}
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image) }}"
                         class="w-full h-full object-cover">
                </div>

                {{-- CONTENT --}}
                <div class="p-6">
                    <span class="text-sm text-gray-400">
                        {{ $item->published_at->format('Y-m-d') }}
                    </span>

                    <h3 class="font-bold text-lg mt-2 mb-3">
                        {{ $item->title }}
                    </h3>

                    <p class="text-gray-600 text-sm mb-4">
                        {{ Str::limit($item->excerpt, 120) }}
                    </p>

                    <a href="{{ route('news.show', $item) }}"
                       class="text-primary font-semibold hover:underline">
                       {{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }}
                       →
                    </a>
                </div>
            </div>
            @endforeach

        </div>

        <div class="mt-12">
            {{ $news->links() }}
        </div>

    </div>
</section>
@endsection
