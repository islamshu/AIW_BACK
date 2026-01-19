<section class="pt-32 pb-20 md:pt-40 md:pb-28 bg-gradient-to-br from-[#0a192f] to-[#112240] relative overflow-hidden">
    <div class="container mx-auto px-4">

        <div class="flex flex-col lg:flex-row lg:items-start items-center justify-between gap-12">
            <!-- النص -->
            <?php
            $hero = App\Models\HomeHero::first();
            ?>
            <div class="lg:w-1/2 slide-in-right">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 shadow-2xl">
                    <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4 fade-in" data-ar="AIW - Advanced Innovation Works" data-en="AIW - Advanced Innovation Works">
                        <?php echo $hero->title; ?>

                    </h1>

                    <!-- إضافة div محدد العرض هنا -->
                    <div class="hero-subtitle text-lg text-[#8892b0] mb-8 fade-in leading-relaxed">
                        <div class="hero-subtitle max-w-xl mx-auto text-center text-[#8892b0] leading-relaxed">
                            <?php echo Str::of($hero->subtitle)->replace(['<h1', '<h2' ], '<p' )->replace(['</h1>', '</h2>'], '</p>'); ?>

                        </div>


                    </div>
                    <?php if($hero->button_text != null): ?>
                    <div class="flex flex-wrap gap-4">
                        <a href="<?php echo e($hero->button_link); ?>" class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] text-white font-bold py-3 px-6 rounded-full flex items-center gap-2 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 pulse" data-ar="اكتشف المزيد" data-en="Discover More">
                            <span><?php echo e($hero->button_text); ?> </span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- الصورة -->
            <div class="lg:w-1/2 slide-in-left">
                <div class="relative">
                    <!-- أشكال عائمة -->
                    <div class="absolute w-48 h-48 md:w-64 md:h-64 bg-gradient-to-br from-[#00b4d8]/20 to-[#ff5d8f]/20 rounded-full top-10 left-10 float-animation"></div>
                    <div class="absolute w-36 h-36 md:w-48 md:h-48 bg-gradient-to-br from-[#00b4d8]/20 to-[#ff5d8f]/20 rounded-full bottom-10 right-10 float-animation" style="animation-delay: 2s;"></div>
                    <div class="absolute w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-[#00b4d8]/20 to-[#ff5d8f]/20 rounded-full top-1/2 left-5 float-animation" style="animation-delay: 4s;"></div>

                    <!-- اللوجو الرئيسي -->
                    <div class="relative z-10 flex justify-center">
                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden shadow-2xl pulse bg-white flex items-center justify-center">
                            <img src="<?php echo e(asset('storage/'.$hero->image)); ?>"
                                alt="AIW Logo"
                                class="w-full h-full object-contain ">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/hero.blade.php ENDPATH**/ ?>