@php
    use App\Models\Page;
    use App\Models\Job;
    use App\Models\News;
    use App\Models\HomeService;
    use App\Models\Sector;

    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
    $logo = get_general_value('website_logo');

    /* =========================
       CONTENT CHECKS
    ========================= */

    $hasNews = News::where('is_active', 1)
        ->whereDate('published_at', '<=', now())
        ->exists();

    $hasHomeServices = HomeService::where('is_active', true)->exists();

    $hasSectors = Sector::where('is_active', 1)->exists();

    $hasJobs = Job::where('is_active', 1)
        ->whereDate('publish_from', '<=', now())
        ->where(function ($q) {
            $q->whereNull('publish_to')
              ->orWhereDate('publish_to', '>=', now());
        })
        ->exists();

    $hasExtraPages = $navPages->whereNotIn('slug', $excludedSlugs)->count();
@endphp

<nav
    class="fixed top-0 w-full backdrop-blur-sm z-50 py-4"
    style="
        background: color-mix(in srgb, var(--bg-color) 92%, transparent);
        border-bottom: 1px solid
            color-mix(in srgb, var(--primary-color) 25%, transparent);
    "
>
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            {{-- LOGO --}}
            <a href="/" class="flex items-center gap-4 group">
                @if($logo)
                    <img
                        src="{{ asset('storage/' . $logo) }}"
                        class="h-14 md:h-16 max-w-[220px] object-contain
                               transition-transform duration-300
                               group-hover:scale-105">
                @else
                    <div
                        class="h-14 md:h-16 px-6 rounded-lg flex items-center
                               justify-center text-white font-bold text-xl"
                        style="background:linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );">
                        AIW
                    </div>
                @endif

                <span class="font-bold text-lg md:text-xl"
                      style="color:var(--text-color)">
                    {!! get_general_value('website_name_'.app()->getLocale()) !!}
                </span>
            </a>

            {{-- ================= DESKTOP MENU ================= --}}
            <div class="hidden md:flex items-center gap-7 text-[15px]">

                {{-- Home (Primary & Highlighted) --}}
                <a href="/"
                   class="flex gap-2 items-center font-bold"
                   style="color:var(--primary-color)">
                    <i class="fas fa-home"></i>
                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                </a>
                {{-- Pages Dropdown (Secondary) --}}
                @if($hasExtraPages)
                <div class="relative group">

                    <a href="javascript:void(0)"
                    class="flex items-center gap-2 transition-colors
                           relative group"
                    style="color:var(--text-color)">
                 
                     <i class="fas fa-file-alt"></i>
                     {{ app()->getLocale() === 'ar' ? 'الصفحات' : 'Pages' }}
                     <i class="fas fa-chevron-down text-xs opacity-70"></i>
                 </a>
                 

                    <div
                        class="absolute top-full right-0 mt-3 min-w-[230px]
                               bg-white rounded-xl shadow-xl border border-gray-100
                               opacity-0 invisible group-hover:opacity-100
                               group-hover:visible transition-all duration-300 z-50">

                        <ul class="py-2">
                            @foreach($navPages as $page)
                                @continue(in_array($page->slug, $excludedSlugs))
                                <li>
                                    <a href="{{ url($page->slug) }}"
                                       class="flex items-center gap-3 px-4 py-2 text-sm
                                              hover:bg-gray-50 transition">
                                        <i class="fas fa-circle-dot text-[8px] text-gray-400"></i>
                                        {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Services --}}
                @if(get_general_value('services_enabled') && $hasHomeServices)
                <a href="/services"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-layer-group"></i>
                    {{ app()->getLocale() === 'ar' ? 'الخدمات' : 'Services' }}
                </a>
                @endif

                {{-- News --}}
                @if(get_general_value('news_enabled') && $hasNews)
                <a href="/news"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-newspaper"></i>
                    {{ app()->getLocale() === 'ar' ? 'الأخبار' : 'News' }}
                </a>
                @endif

                {{-- Sectors --}}
                @if(get_general_value('sectors_enabled') && $hasSectors)
                <a href="/sectors"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-industry"></i>
                    {{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}
                </a>
                @endif

                {{-- Jobs (Primary – conditional by existence) --}}
                @if($hasJobs)
                <a href="/jobs"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-briefcase"></i>
                    {{ app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs' }}
                </a>
                @endif

                

                {{-- Contact --}}
                <a href="/contact"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-envelope"></i>
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>

                {{-- Language --}}
                <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                   class="px-5 py-2.5 rounded-full font-semibold text-white
                          transition-all hover:scale-105"
                   style="background:linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                   );">
                    {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                </a>
            </div>

            {{-- MOBILE TOGGLE --}}
            <button id="menuToggle"
                    class="md:hidden text-2xl"
                    style="color:var(--text-color)">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        {{-- ================= MOBILE MENU ================= --}}
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">

                <a href="/">{{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}</a>

                @if(get_general_value('services_enabled') && $hasHomeServices)
                    <a href="/services">{{ app()->getLocale() === 'ar' ? 'الخدمات' : 'Services' }}</a>
                @endif

                @if(get_general_value('news_enabled') && $hasNews)
                    <a href="/news">{{ app()->getLocale() === 'ar' ? 'الأخبار' : 'News' }}</a>
                @endif

                @if(get_general_value('sectors_enabled') && $hasSectors)
                    <a href="/sectors">{{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}</a>
                @endif

                @if($hasJobs)
                    <a href="/jobs">{{ app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs' }}</a>
                @endif

                {{-- Pages --}}
                @foreach($navPages as $page)
                    @continue(in_array($page->slug, $excludedSlugs))
                    <a href="{{ url($page->slug) }}">
                        {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                    </a>
                @endforeach

                <a href="/contact">
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>
            </div>
        </div>

    </div>
</nav>
