<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','AIW')</title>
    
    <!-- Favicons متعددة التنسيقات -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/' . get_general_value('website_logo')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . get_general_value('website_logo')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . get_general_value('website_logo')) }}">
    <link rel="manifest" href="{{ asset('storage/' . get_general_value('website_logo')) }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . get_general_value('website_logo')) }}" type="image/x-icon">

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
        .sector-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, var(--sky-blue), var(--pink));
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
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
@include('frontend.inc.navbar')
{{-- ================================================= --}}
{{-- PAGE CONTENT --}}
{{-- ================================================= --}}
<main class="pt-32">
    @yield('content')
</main>

{{-- ================================================= --}}
{{-- FOOTER --}}
{{-- ================================================= --}}
@include('frontend.inc.footer')

{{-- Floating Buttons --}}
<div class="fixed bottom-8 left-8 flex flex-col gap-4 z-40">

    <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
        class="w-12 h-12 rounded-full
               bg-gradient-to-br from-[#112240] to-[#1b2b4a]
               flex items-center justify-center
               text-white
               shadow-2xl border border-white/10
               hover:from-[#00b4d8] hover:to-[#ff5d8f]
               transition-all duration-300"
        title="{{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}">
     
         <i class="fas fa-language text-lg"></i>
     
     </a>
     
    {{-- Scroll To Top --}}


    <button id="scrollTop"
        class="w-12 h-12 rounded-full bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
               flex items-center justify-center text-white shadow-xl hover:scale-110 transition">
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
@yield('scripts')

</body>
</html>
