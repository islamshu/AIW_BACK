<?php
    $lang = app()->getLocale();
?>

<section class="py-28 relative overflow-hidden"
         style="background: <?php echo e($data->background ?? '#0a192f'); ?>">

    <div class="container mx-auto px-4 relative z-10">

        <div class="max-w-4xl mx-auto text-center">

            
            <?php if(!empty($data->title[$lang])): ?>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text fade-in">
                    <?php echo e($data->title[$lang]); ?>

                </h2>
            <?php endif; ?>

            
            <?php if(!empty($data->subtitle[$lang])): ?>
                <div class="text-lg md:text-xl text-[#8892b0] leading-relaxed mb-10 fade-in">
                    <?php echo $data->subtitle[$lang]; ?>

                </div>
            <?php endif; ?>

            
            <?php if(!empty($data->button_text[$lang])): ?>
                <div class="fade-in">
                    <a href="<?php echo e($data->button_link[$lang] ?? '#'); ?>"
                       class="inline-flex items-center gap-2 px-10 py-4 rounded-full
                              bg-gradient-to-r from-[var(--sky-blue)] to-[var(--pink)]
                              text-white font-semibold shadow-xl
                              transition hover:scale-105">

                        <?php echo e($data->button_text[$lang]); ?>


                        <i class="fas fa-arrow-<?php echo e($lang === 'ar' ? 'left' : 'right'); ?>"></i>
                    </a>
                </div>
            <?php endif; ?>

        </div>

    </div>

    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-[var(--sky-blue)]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[var(--pink)]/10 rounded-full blur-3xl"></div>
    </div>

</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/hero_extra.blade.php ENDPATH**/ ?>