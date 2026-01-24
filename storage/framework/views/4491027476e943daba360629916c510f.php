<?php
    // ================= TEXT =================
    $textAr  = $data['text_ar'] ?? '';
    $textEn  = $data['text_en'] ?? '';
    $content = app()->getLocale() === 'ar' ? $textAr : $textEn;
    $isAr    = app()->getLocale() === 'ar';

    // ================= IMAGE =================
    $image    = $data['image'] ?? null;
    $hasImage = !empty($image);

    $imgPosition = $data['image_position'] ?? 'right';
    $imgSize     = $data['image_size'] ?? 'md';
    $imgStyle    = $data['image_style'] ?? 'rounded';
    $imgShadow   = $data['image_shadow'] ?? 'md';

    // ================= GRID =================
    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']);

    if ($isSideImage) {
        $gridCols = match($imgSize) {
            'sm' => 'lg:grid-cols-[1fr_3fr]',
            'lg' => 'lg:grid-cols-[2fr_3fr]',
            default => 'lg:grid-cols-2',
        };

        if ($imgPosition === 'left') {
            $gridCols = str_replace('[1fr_3fr]', '[3fr_1fr]', $gridCols);
            $gridCols = str_replace('[2fr_3fr]', '[3fr_2fr]', $gridCols);
        }
    }

    // ================= IMAGE STYLE =================
    $imgRadius = match($imgStyle) {
        'circle' => 'rounded-full',
        'square' => 'rounded-none',
        default  => 'rounded-3xl',
    };

    $imgShadowClass = match($imgShadow) {
        'none' => '',
        'sm'   => 'shadow-md',
        'lg'   => 'shadow-[0_30px_80px_rgba(0,0,0,.45)]',
        default => 'shadow-2xl',
    };
?>

<section
    class="relative overflow-hidden"
    style="
        background:
            linear-gradient(
                180deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 85%, var(--primary-color))
            );
    "
>
    <div class="container mx-auto px-4 py-20">

        
        <?php if($hasImage && $imgPosition === 'top'): ?>
            <div class="flex justify-center mb-14">
                <img
                    src="<?php echo e($image); ?>"
                    class="w-full max-w-3xl <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover"
                >
            </div>
        <?php endif; ?>

        
        <div class="grid gap-14 items-center <?php echo e($isSideImage ? $gridCols : 'grid-cols-1'); ?>">

            
            <?php if($hasImage && $isSideImage): ?>
                <div class="flex justify-center">
                    <div class="relative w-full">

                        
                        <div
                            class="absolute -inset-4 <?php echo e($imgRadius); ?> blur-2xl"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                opacity: .18;
                            "
                        ></div>

                        <img
                            src="<?php echo e($image); ?>"
                            alt="Section image"
                            class="relative w-full <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover"
                        >
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="<?php echo e($isAr ? 'text-right' : 'text-left'); ?>">
                <div class="relative h-full">

                    
                    <div
                        class="absolute inset-0 rounded-3xl backdrop-blur-md border"
                        style="
                            background: color-mix(in srgb, var(--bg-color) 85%, white);
                            border-color: color-mix(in srgb, var(--text-color) 10%, transparent);
                        "
                    ></div>

                    <div class="relative px-10 py-14">

                        <div
                            class="
                                prose prose-lg
                                <?php echo e($isSideImage ? 'max-w-none' : 'max-w-3xl mx-auto'); ?>


                                prose-headings:font-extrabold
                                prose-headings:tracking-tight
                                prose-headings:text-[var(--text-color)]

                                prose-h2:text-3xl
                                prose-h3:text-2xl

                                prose-p:leading-relaxed
                                prose-strong:text-[var(--text-color)]

                                prose-a:no-underline
                                hover:prose-a:underline

                                prose-ul
                                prose-blockquote:not-italic
                                prose-blockquote:rounded-xl
                                prose-blockquote:px-6
                                prose-blockquote:py-4
                                prose-blockquote:border-s-4
                            "
                            style="
                                --tw-prose-body: color-mix(in srgb, var(--text-color) 75%, transparent);
                                --tw-prose-links: var(--primary-color);
                                --tw-prose-quote-borders: var(--primary-color);
                            "
                        >
                            <?php echo $content; ?>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        
        <?php if($hasImage && $imgPosition === 'bottom'): ?>
            <div class="flex justify-center mt-14">
                <img
                    src="<?php echo e($image); ?>"
                    class="w-full max-w-3xl <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover"
                >
            </div>
        <?php endif; ?>

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
            opacity: .25;
        "
    ></div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/sections/text.blade.php ENDPATH**/ ?>