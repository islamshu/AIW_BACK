<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','AIW')</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    {{-- Base Styles --}}
    <style>
        :root {
            --navy: #0a192f;
            --sky-blue: #00b4d8;
            --pink: #ff5d8f;
        }

        body {
            font-family: 'Cairo', sans-serif;
        }

        body[dir="ltr"] {
            font-family: 'Poppins', sans-serif;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s ease, transform .8s ease;
        }

        .fade-in.appear {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity .8s ease, transform .8s ease;
        }

        .slide-in-left.appear {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity .8s ease, transform .8s ease;
        }

        .slide-in-right.appear {
            opacity: 1;
            transform: translateX(0);
        }

        .gradient-text {
            background: linear-gradient(to right, var(--sky-blue), var(--pink));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .card-hover {
            transition: all .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px -15px rgba(2,12,27,.7);
        }
    </style>

    @yield('style')
</head>

<body class="bg-[#0a192f] text-white">

{{-- ================================================= --}}
{{-- NAVBAR --}}
{{-- ================================================= --}}
<nav class="fixed top-0 w-full bg-[#0a192f]/95 backdrop-blur-sm z-50 py-4 border-b border-[#00b4d8]/10">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
                            rounded-lg flex items-center justify-center">
                    <span class="font-bold text-xl">AIW</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-lg">Advanced Innovation Works</span>
                    <span class="text-[#00b4d8] text-sm">
                        Multi-Sector Investment & Operations Group
                    </span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="/" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-home"></i> الرئيسية
                </a>
                <a href="/about" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-users"></i> من نحن
                </a>
                <a href="/sectors" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-industry"></i> القطاعات
                </a>
                <a href="/contact" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-envelope"></i> اتصل بنا
                </a>
                <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] text-white px-4 py-2 rounded-full font-semibold">
                    {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                </a>

            </div>

            {{-- Mobile Toggle --}}
            <button id="menuToggle" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">
                <a href="/" class="text-[#a8b2d1] hover:text-[#00b4d8]">الرئيسية</a>
                <a href="/about" class="text-[#a8b2d1] hover:text-[#00b4d8]">من نحن</a>
                <a href="/sectors" class="text-[#a8b2d1] hover:text-[#00b4d8]">القطاعات</a>
                <a href="/contact" class="text-[#a8b2d1] hover:text-[#00b4d8]">اتصل بنا</a>
            </div>
        </div>
    </div>
</nav>

{{-- ================================================= --}}
{{-- PAGE CONTENT --}}
{{-- ================================================= --}}
<main class="pt-32">
    @yield('content')
</main>

{{-- ================================================= --}}
{{-- FOOTER --}}
{{-- ================================================= --}}
<footer class="pt-16 pb-8 border-t border-[#00b4d8]/10">
    <div class="container mx-auto px-4 text-center text-[#8892b0]">
        <p class="mb-2">© 2024 AIW Group. جميع الحقوق محفوظة.</p>
        <p class="text-[#00b4d8] text-sm">
            Multi-Activity Company Profile – Strategic Version
        </p>
    </div>
</footer>

{{-- Floating Buttons --}}
<div class="fixed bottom-8 left-8 flex flex-col gap-4 z-40">
    <button id="scrollTop"
            class="w-12 h-12 rounded-full bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
                   flex items-center justify-center">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

{{-- Scripts --}}
<script>
    document.getElementById('menuToggle')?.addEventListener('click', () => {
        document.getElementById('mobileMenu')?.classList.toggle('hidden');
    });

    document.getElementById('scrollTop')?.addEventListener('click', () => {
        window.scrollTo({top:0,behavior:'smooth'});
    });
</script>

@yield('script')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });

    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right')
        .forEach(el => observer.observe(el));

});
</script>

</body>
</html>
