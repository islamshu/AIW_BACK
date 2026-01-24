@extends('layouts.frontend')

@section('title', app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs')

@section('content')
<section
    class="min-h-[70vh] flex items-center justify-center relative overflow-hidden"
    style="background: var(--bg-color);"
>

    {{-- Decorative Background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-3xl"
            style="background: var(--primary-color); opacity: .08;"
        ></div>
        <div
            class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full blur-3xl"
            style="background: var(--secondary-color); opacity: .08;"
        ></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-xl mx-auto text-center fade-in">

            {{-- Icon --}}
            <div class="mb-8 flex justify-center">
                <div
                    class="w-20 h-20 rounded-full flex items-center justify-center"
                    style="background: color-mix(in srgb, var(--primary-color) 15%, transparent);"
                >
                    <i class="fas fa-briefcase text-3xl"
                       style="color: var(--primary-color)"></i>
                </div>
            </div>

            {{-- Title --}}
            <h1
                class="text-3xl md:text-4xl font-extrabold mb-4"
                style="color: var(--text-color)"
            >
                {{ app()->getLocale() === 'ar'
                    ? 'لا توجد وظائف متاحة حالياً'
                    : 'No Open Positions at the Moment' }}
            </h1>

            {{-- Description --}}
            <p
                class="leading-relaxed mb-10"
                style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
            >
                {{ app()->getLocale() === 'ar'
                    ? 'نشكرك على اهتمامك بالانضمام إلينا. لا توجد وظائف مفتوحة حالياً، لكننا نعمل باستمرار على إضافة فرص جديدة. يرجى زيارة الصفحة لاحقًا.'
                    : 'Thank you for your interest in joining us. There are currently no open positions, but we are always working on new opportunities. Please check back later.' }}
            </p>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row justify-center gap-4">

                <a href="/"
                   class="px-8 py-3 rounded-full font-semibold text-white transition hover:scale-105"
                   style="
                        background: linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );
                   ">
                    {{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                </a>

                <a href="/contact"
                   class="px-8 py-3 rounded-full font-semibold transition"
                   style="
                        color: var(--primary-color);
                        border: 1px solid color-mix(in srgb, var(--primary-color) 40%, transparent);
                   "
                   onmouseover="this.style.background='color-mix(in srgb, var(--primary-color) 8%, transparent)'"
                   onmouseout="this.style.background='transparent'">
                    {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
                </a>

            </div>

        </div>
    </div>
</section>
@endsection
