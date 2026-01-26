{{-- ================= NEWS SECTION ================= --}}
@php
$latestNews = App\Models\News::where('is_active', true)
    ->whereNotNull('published_at')
    ->orderByDesc('published_at')
    ->take(3)
    ->get();
$count = App\Models\News::where('is_active', true)->count();

@endphp
@if($count > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
   
        {{-- TITLE --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold mb-2">
                {{ app()->getLocale() === 'ar' ? 'آخر الاخبار' : 'Latest News' }}

            </h2>
            <p class="text-gray-500">
                {{ app()->getLocale() === 'ar' ? 'تابع أحدث المستجدات وأخبار الشركة' : 'Follow the latest updates and company news.' }}
            </p>
        </div>

        {{-- NEWS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach ($latestNews as $news)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    {{-- IMAGE --}}
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover">
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">
                        <span class="text-sm text-gray-400">
                            {{ $news->published_at->format('Y-m-d') }}
                        </span>

                        <h3 class="font-bold text-lg mt-2 mb-3">
                            {{ $news->title }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($news->excerpt, 120) }}
                        </p>

                        <a href="{{ route('news.show', $news) }}" class="text-primary font-semibold hover:underline">
                            {{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }}
                            →
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- VIEW ALL --}}
        @if (get_general_value(key: 'news_enabled') && $count > count($latestNews))
            <div class="text-center mt-16 fade-in">
                <a href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-3 px-12 py-4 rounded-full font-bold text-white
                       transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                    style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                ">
                    {{ app()->getLocale() === 'ar' ? 'رؤية جميع الاخبار' : 'View All News' }}
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        @endif

    </div>
</section>
@endif
