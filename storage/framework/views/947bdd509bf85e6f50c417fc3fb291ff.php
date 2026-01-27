<?php
    /** @var \App\Models\HomeSection $section */

    $lang = app()->getLocale();

    /*
    |--------------------------------------------------------------------------
    | CONTENT (من contentable)
    |--------------------------------------------------------------------------
    */
    $content = $section->contentable->content[$lang] ?? '';

    /*
    |--------------------------------------------------------------------------
    | BUTTON (من home_sections)
    |--------------------------------------------------------------------------
    */
    $buttonText = $section->button_text[$lang] ?? null;
    $buttonLink = $section->button_link ?? null;
?>

<section
    class="py-24 relative overflow-hidden"
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

        <div
            class="rounded-2xl p-10 backdrop-blur-md border border-white/10 shadow-2xl text-center"
            style="background: rgba(255,255,255,0.04)"
        >

            
            <?php if($content): ?>
                <div
                    class="text-lg leading-relaxed mb-10 max-w-3xl mx-auto"
                    style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                >
                    <?php echo $content; ?>

                </div>
            <?php endif; ?>

            
            <?php if($buttonText && $buttonLink): ?>
                <div class="flex justify-center">
                    <a
                        href="<?php echo e($buttonLink); ?>"
                        class="
                            inline-flex items-center gap-3
                            px-9 py-4
                            rounded-full
                            font-semibold
                            text-white
                            transition-all duration-300
                            hover:-translate-y-1
                            hover:shadow-2xl
                        "
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                        "
                    >
                        <?php echo e($buttonText); ?>


                        <?php if($lang === 'ar'): ?>
                            <i class="fas fa-arrow-left"></i>
                        <?php else: ?>
                            <i class="fas fa-arrow-right"></i>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>

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
            opacity: .3;
        "
    ></div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/text.blade.php ENDPATH**/ ?>