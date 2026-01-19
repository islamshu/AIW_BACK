<?php
    $lang = app()->getLocale();
?>

<section class="py-24 bg-[#0a192f]">
    <div class="container mx-auto px-4">

        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 shadow-2xl text-center">

            <div class="text-gray-300 text-lg leading-relaxed mb-10">
                <?php echo $data->content[$lang] ?? ''; ?>

            </div>

            <?php if(!empty($data->button_text[$lang])): ?>
                <div class="flex justify-center">
                    <a href="<?php echo e($data->button_link[$lang]); ?>"
                       class="inline-flex items-center gap-2 px-8 py-3 rounded-full
                              bg-gradient-to-r from-[var(--sky-blue)] to-[var(--pink)]
                              text-white font-semibold shadow-lg
                              transition hover:scale-105">
                        <?php echo e($data->button_text[$lang]); ?>

                        <i class="fas fa-arrow-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>"></i>
                    </a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/text.blade.php ENDPATH**/ ?>