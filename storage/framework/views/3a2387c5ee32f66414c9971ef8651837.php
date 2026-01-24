<section
    class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden"
    style="
        background:
            linear-gradient(
                135deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 85%, var(--primary-color))
            );
    "
>
    <div class="container mx-auto px-4 relative z-10">

        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">

            
            <?php
                $hero = App\Models\HomeHero::first();
            ?>

            <div class="lg:w-1/2 slide-in-right">
                <div
                    class="rounded-2xl p-8 backdrop-blur-md border border-white/10 shadow-2xl"
                    style="background: rgba(255,255,255,0.04)"
                >
                    <h1
                        class="text-4xl md:text-5xl font-extrabold mb-4 fade-in leading-tight"
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                            -webkit-background-clip: text;
                            color: transparent;
                        "
                    >
                        <?php echo $hero->title; ?>

                    </h1>

                    <div
                        class="text-lg mb-8 fade-in leading-relaxed max-w-xl"
                        style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                    >
                        <?php echo Str::of($hero->subtitle)
                            ->replace(['<h1', '<h2'], '<p')
                            ->replace(['</h1>', '</h2>'], '</p>'); ?>

                    </div>

                    <?php if($hero->button_text): ?>
                        <a
                            href="<?php echo e($hero->button_link); ?>"
                            class="inline-flex items-center gap-2
                                   px-7 py-3 rounded-full font-semibold text-white
                                   transition-all duration-300
                                   hover:-translate-y-1 hover:shadow-2xl"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                            "
                        >
                            <span><?php echo e($hero->button_text); ?></span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="lg:w-1/2 slide-in-left relative">

                
                <div
                    class="absolute w-56 h-56 rounded-full top-10 left-10 blur-2xl float-animation"
                    style="
                        background: var(--primary-color);
                        opacity: .15;
                    "
                ></div>

                <div
                    class="absolute w-40 h-40 rounded-full bottom-10 right-10 blur-2xl float-animation"
                    style="
                        background: var(--secondary-color);
                        opacity: .15;
                        animation-delay: 2s;
                    "
                ></div>

                <div
                    class="absolute w-28 h-28 rounded-full top-1/2 left-5 blur-2xl float-animation"
                    style="
                        background: var(--primary-color);
                        opacity: .12;
                        animation-delay: 4s;
                    "
                ></div>

                
                <div class="relative z-10 flex justify-center">
                    <div
                        class="w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden
                               bg-white shadow-2xl flex items-center justify-center pulse"
                    >
                        <img
                            src="<?php echo e(asset('storage/'.$hero->image)); ?>"
                            alt="Hero Image"
                            class="w-full h-full object-contain"
                        >
                    </div>
                </div>

            </div>

        </div>
    </div>

    
    <div
        class="absolute inset-x-0 bottom-0 h-px"
        style="
            background: linear-gradient(
                90deg,
                transparent,
                var(--primary-color),
                transparent
            );
            opacity: .35;
        "
    ></div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/hero.blade.php ENDPATH**/ ?>