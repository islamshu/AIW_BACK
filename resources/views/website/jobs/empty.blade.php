@extends('layouts.frontend')

@section('title','الوظائف')

@section('content')
<div class="container mx-auto px-4 max-w-4xl">

    <section class="flex flex-col items-center text-center mt-32 mb-40 fade-in">

        {{-- Icon --}}
        <div class="mb-8">
            <div class="w-20 h-20 rounded-full
                        bg-[#00b4d8]/10
                        flex items-center justify-center">
                <i class="fas fa-briefcase text-3xl text-[#00b4d8]"></i>
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl md:text-4xl font-extrabold mb-4">
            عذرًا، لا توجد وظائف متاحة حالياً
        </h1>

        {{-- Description --}}
        <p class="text-[#a8b2d1] max-w-xl leading-relaxed mb-10">
            نشكرك على اهتمامك بالانضمام إلينا.
            حالياً لا توجد وظائف مفتوحة، لكن نعمل باستمرار على إضافة فرص جديدة.
            يُرجى زيارة الصفحة لاحقًا.
        </p>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="/"
               class="px-8 py-3 rounded-full font-semibold
                      bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                      hover:opacity-90 transition">
                العودة إلى الرئيسية
            </a>

            <a href="/contact"
               class="px-8 py-3 rounded-full font-semibold
                      border border-[#00b4d8]/40
                      text-[#00b4d8]
                      hover:bg-[#00b4d8]/10 transition">
                تواصل معنا
            </a>
        </div>

    </section>

</div>
@endsection
