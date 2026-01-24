@php
    use App\Models\Page;
    use App\Models\Job;

    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
    $logo = get_general_value('website_logo');

    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
    $logo = get_general_value('website_logo');

    // 👇 هل يوجد وظائف منشورة؟
    $hasJobs = Job::where('is_active', 1)
        ->whereDate('publish_from', '<=', now())
        ->where(function ($q) {
            $q->whereNull('publish_to')
              ->orWhereDate('publish_to', '>=', now());
        })
        ->exists();
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

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-4 group">
                @if($logo)
                    <img
                        src="{{ asset('storage/' . $logo) }}"
                        alt="Logo"
                        class="h-16 md:h-20 w-auto max-w-[280px] object-contain
                               transition-transform duration-300
                               group-hover:scale-105"
                    >
                @else
                    <div
                        class="h-16 md:h-20 px-6 rounded-lg flex items-center justify-center text-white font-bold text-2xl"
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                        "
                    >
                        AIW
                    </div>
                @endif

                <div class="flex flex-col">
                    <span class="font-bold text-xl md:text-2xl"
                          style="color: var(--text-color)">
                        {!! get_general_value('website_name_'.app()->getLocale()) !!}
                    </span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">

                {{-- Home --}}
                <a href="/"
                   class="flex gap-2 items-center transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-home"></i>
                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                </a>

                {{-- Dynamic Pages --}}
                @foreach($navPages as $page)
                    @continue(in_array($page->slug, $excludedSlugs))

                    <a href="{{ url($page->slug) }}"
                       class="flex gap-2 items-center transition-colors duration-300"
                       style="color: var(--text-color)"
                       onmouseover="this.style.color='var(--primary-color)'"
                       onmouseout="this.style.color='var(--text-color)'">
                        <i class="fas fa-circle-dot text-xs"></i>
                        {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                    </a>
                @endforeach

                {{-- Sectors --}}
                @if(get_general_value('sectors_enabled'))
                <a href="/sectors"
                   class="flex gap-2 items-center transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-industry"></i>
                    {{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}
                </a>
                @endif
                @if($hasJobs)
                <a href="/jobs"
                class="flex gap-2 items-center transition-colors duration-300"
                style="color: var(--text-color)"
                onmouseover="this.style.color='var(--primary-color)'"
                onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-briefcase"></i>
                    {{ app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs' }}
                </a>
                @endif


                {{-- Contact --}}
                <a href="/contact"
                   class="flex gap-2 items-center transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-envelope"></i>
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>

                {{-- Language --}}
                <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                   class="px-5 py-2.5 rounded-full font-semibold text-white transition-all duration-300 hover:scale-105"
                   style="
                        background: linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );
                   ">
                    {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                </a>
            </div>

            {{-- Mobile Toggle --}}
            <button id="menuToggle"
                class="md:hidden text-2xl transition-colors duration-300"
                style="color: var(--text-color)"
                onmouseover="this.style.color='var(--primary-color)'"
                onmouseout="this.style.color='var(--text-color)'">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">

                @foreach(['/' => 'الرئيسية'] as $url => $label)
                <a href="{{ $url }}"
                   class="transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    {{ app()->getLocale() === 'ar' ? $label : 'Home' }}
                </a>
                @endforeach

                @foreach($navPages as $page)
                    @continue(in_array($page->slug, $excludedSlugs))
                    <a href="{{ url($page->slug) }}"
                       class="transition-colors duration-300"
                       style="color: var(--text-color)"
                       onmouseover="this.style.color='var(--primary-color)'"
                       onmouseout="this.style.color='var(--text-color)'">
                        {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                    </a>
                @endforeach
                @if(get_general_value('sectors_enabled'))

                <a href="/sectors"
                   class="transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    {{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}
                </a>
                @endif
                @if($hasJobs)
                <a href="/jobs"
                class="transition-colors duration-300"
                style="color: var(--text-color)"
                onmouseover="this.style.color='var(--primary-color)'"
                onmouseout="this.style.color='var(--text-color)'">
                    {{ app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs' }}
                </a>
                @endif

                <a href="/contact"
                   class="transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>

            </div>
        </div>

    </div>
</nav>
