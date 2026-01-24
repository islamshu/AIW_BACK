@php
    use App\Models\Page;

    $footerPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
@endphp

<footer
    class="relative pt-20 pb-8 overflow-hidden"
    style="
        background: var(--bg-color);
        border-top: 1px solid
            color-mix(in srgb, var(--primary-color) 25%, transparent);
    "
>

    {{-- Background Decorations --}}
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: var(--primary-color);
                opacity: .08;
            "
        ></div>

        <div
            class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: var(--secondary-color);
                opacity: .08;
            "
        ></div>
    </div>

    <div class="relative container mx-auto px-4">

        {{-- DESCRIPTION --}}
        <div class="max-w-3xl mx-auto text-center mb-16">
            <p
                class="text-sm md:text-base leading-relaxed"
                style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
            >
                {!! get_general_value('description_'.app()->getLocale()) !!}
            </p>

            <div
                class="w-24 h-[2px] mx-auto mt-6 rounded-full"
                style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                "
            ></div>
        </div>

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16 text-center md:text-start">

            {{-- LOGO --}}
            <div class="flex justify-center md:justify-start">
                <img
                    src="{{ asset('storage/'.get_general_value('website_logo')) }}"
                    alt="Logo"
                    class="object-contain drop-shadow-xl
                           max-w-[180px] md:max-w-[220px] lg:max-w-[260px]"
                >
            </div>

            {{-- QUICK LINKS --}}
            <div>
                <h5 class="font-semibold mb-4" style="color: var(--text-color)">
                    {{ app()->getLocale() === 'ar' ? 'روابط سريعة' : 'Quick Links' }}
                </h5>

                <ul class="space-y-3">
                    <li>
                        <a href="/"
                           class="transition"
                           style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                           onmouseover="this.style.color='var(--primary-color)'"
                           onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                            {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                        </a>
                    </li>

                    @foreach($footerPages as $page)
                        @continue(in_array($page->slug, $excludedSlugs))
                        <li>
                            <a href="{{ url($page->slug) }}"
                               class="transition"
                               style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                               onmouseover="this.style.color='var(--primary-color)'"
                               onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                                {{ $page->title[app()->getLocale()] ?? $page->title['ar'] }}
                            </a>
                        </li>
                    @endforeach

                    @if(get_general_value('sectors_enabled'))
                        <li>
                            <a href="/sectors"
                               class="transition"
                               style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                               onmouseover="this.style.color='var(--primary-color)'"
                               onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                                {{ app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors' }}
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="/contact"
                           class="transition"
                           style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                           onmouseover="this.style.color='var(--primary-color)'"
                           onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                            {{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div>
                <h5 class="font-semibold mb-4" style="color: var(--text-color)">
                    {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Get in Touch' }}
                </h5>

                <ul
                    class="space-y-4 text-sm"
                    style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                >
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <i class="fas fa-envelope" style="color: var(--primary-color)"></i>
                        {{ get_general_value('website_email') }}
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <i class="fas fa-phone" style="color: var(--primary-color)"></i>
                        {{ get_general_value('phone') }}
                    </li>
                </ul>
            </div>

        </div>

        {{-- BOTTOM --}}
        <div
            class="pt-6 text-center text-sm"
            style="
                border-top: 1px solid
                    color-mix(in srgb, var(--primary-color) 25%, transparent);
                color: color-mix(in srgb, var(--text-color) 65%, transparent);
            "
        >
            © {{ date('Y') }}
            <span class="font-semibold" style="color: var(--text-color)">
                {{ get_general_value('website_name_'.app()->getLocale()) }}
            </span>
            — {{ app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}
        </div>

    </div>
</footer>
