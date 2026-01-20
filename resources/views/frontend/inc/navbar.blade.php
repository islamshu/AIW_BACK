@php
    use App\Models\Page;

    // جلب الصفحات المنشورة فقط
    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    // الصفحات الثابتة (لا نكررها)
    $excludedSlugs = ['home', 'sectors', 'contact'];
    
    // الحصول على رابط الشعار من الإعدادات
    $logo = get_general_value('website_logo');
@endphp

<nav class="fixed top-0 w-full bg-[#0a192f]/95 backdrop-blur-sm z-50 py-4 border-b border-[#00b4d8]/10">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-4 group">
                @if($logo)
                    {{-- عرض الشعار من النظام --}}
                    <div class="flex items-center">
                        <img
                            src="{{ asset('storage/' . $logo) }}"
                            alt="AIW Logo"
                            class="h-16 md:h-20 w-auto max-w-[280px] object-contain drop-shadow-xl
                                   transition-transform duration-300 group-hover:scale-105 group-hover:brightness-110"
                            onerror="this.style.display='none'; document.getElementById('logo-fallback').style.display='flex';"
                        />
                    </div>
                    {{-- Fallback Logo إذا فشل تحميل الصورة --}}
                    <div id="logo-fallback" class="hidden h-16 md:h-20 w-auto bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
                                rounded-lg flex items-center justify-center px-6">
                        <span class="font-bold text-2xl text-white">AIW</span>
                    </div>
                @else
                    {{-- الشعار الافتراضي --}}
                    <div class="h-16 md:h-20 w-auto bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
                                rounded-lg flex items-center justify-center px-6 shadow-xl">
                        <span class="font-bold text-3xl text-white">AIW</span>
                    </div>
                @endif
                <div class="flex flex-col">
                    <span class="font-bold text-xl md:text-2xl text-white">
                        {!!  get_general_value('website_name_'.app()->getLocale()) !!}
                    </span>
                
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">

                {{-- الرئيسية (ثابتة) --}}
                <a href="/" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2 items-center transition-colors duration-300">
                    <i class="fas fa-home"></i>
                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                </a>

                {{-- صفحات من DB --}}
                @foreach($navPages as $page)
                    @continue(in_array($page->slug, $excludedSlugs))

                    <a href="{{ url($page->slug) }}"
                       class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2 items-center transition-colors duration-300">
                        <i class="fas fa-circle-dot text-xs"></i>
                        {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                    </a>
                @endforeach

                {{-- القطاعات (ثابتة) --}}
                @if(get_general_value('sectors_enabled'))
                <a href="/sectors" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2 items-center transition-colors duration-300">
                    <i class="fas fa-industry"></i>
                    {{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}
                </a>
                @endif

                {{-- التواصل (ثابتة) --}}
                <a href="/contact" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2 items-center transition-colors duration-300">
                    <i class="fas fa-envelope"></i>
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>

                {{-- اللغة --}}
                <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                   class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                          text-white px-5 py-2.5 rounded-full font-semibold
                          hover:shadow-lg hover:shadow-[#00b4d8]/20 transition-all duration-300">
                    {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                </a>
            </div>

            {{-- Mobile Toggle --}}
            <button id="menuToggle" class="md:hidden text-2xl text-white hover:text-[#00b4d8] transition-colors duration-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">

                <a href="/" class="text-[#a8b2d1] hover:text-[#00b4d8] transition-colors duration-300">
                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}

                </a>

                @foreach($navPages as $page)
                    @continue(in_array($page->slug, $excludedSlugs))

                    <a href="{{ url($page->slug) }}"
                       class="text-[#a8b2d1] hover:text-[#00b4d8] transition-colors duration-300">
                        {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                    </a>
                @endforeach

                <a href="/sectors" class="text-[#a8b2d1] hover:text-[#00b4d8] transition-colors duration-300">
                    {{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}
                </a>

                <a href="/contact" class="text-[#a8b2d1] hover:text-[#00b4d8] transition-colors duration-300">
                    {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                </a>
            </div>
        </div>
    </div>
</nav>