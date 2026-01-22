<?php
    // ================= TEXT =================
    $textAr  = $data['text_ar'] ?? '';
    $textEn  = $data['text_en'] ?? '';
    $content = app()->getLocale() === 'ar' ? $textAr : $textEn;
    $isAr    = app()->getLocale() === 'ar';

    // ================= IMAGE =================
    $image    = $data['image'] ?? null;
    $hasImage = !empty($image);

    // settings
    $imgPosition = $data['image_position'] ?? 'right'; // left | right | top | bottom
    $imgSize     = $data['image_size'] ?? 'md';        // sm | md | lg | full
    $imgStyle    = $data['image_style'] ?? 'rounded';  // rounded | circle | square
    $imgShadow   = $data['image_shadow'] ?? 'md';      // none | sm | md | lg

    // ================= GRID LOGIC =================
    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']);

    // توزيع الأعمدة حسب حجم الصورة
    if ($isSideImage) {
        $gridCols = match($imgSize) {
            'sm' => 'lg:grid-cols-[1fr_3fr]',   // صورة 25%
            'lg' => 'lg:grid-cols-[2fr_3fr]',   // صورة ~40%
            default => 'lg:grid-cols-2',        // 50 / 50
        };

        // لو الصورة على اليسار نبدّل الأعمدة
        if ($imgPosition === 'left') {
            $gridCols = str_replace('[1fr_3fr]', '[3fr_1fr]', $gridCols);
            $gridCols = str_replace('[2fr_3fr]', '[3fr_2fr]', $gridCols);
        }
    }

    // ================= IMAGE STYLE =================
    $imgRadius = match($imgStyle) {
        'circle' => 'rounded-full',
        'square' => 'rounded-none',
        default  => 'rounded-[28px]',
    };

    $imgShadowClass = match($imgShadow) {
        'none' => '',
        'sm'   => 'shadow-md',
        'lg'   => 'shadow-[0_30px_80px_rgba(0,0,0,.45)]',
        default => 'shadow-2xl',
    };
?>

<section class="relative">
    <div class="container mx-auto px-4">
        <div class="py-20">

            
            <?php if($hasImage && $imgPosition === 'top'): ?>
                <div class="flex justify-center mb-14">
                    <img src="<?php echo e($image); ?>"
                         class="w-full max-w-3xl <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover">
                </div>
            <?php endif; ?>

            
            <div class="
                grid gap-14 items-center
                <?php echo e($isSideImage ? $gridCols : 'grid-cols-1'); ?>

            ">

                
                <?php if($hasImage && $isSideImage): ?>
                    <div class="flex justify-center">
                        <div class="relative w-full">

                            
                            <div class="absolute -inset-4 <?php echo e($imgRadius); ?>

                                bg-gradient-to-r from-[#00b4d8]/20 to-[#ff5d8f]/20
                                blur-2xl"></div>

                            <img src="<?php echo e($image); ?>"
                                 alt="Section image"
                                 class="
                                    relative w-full
                                    <?php echo e($imgRadius); ?>

                                    <?php echo e($imgShadowClass); ?>

                                    object-cover
                                 ">
                        </div>
                    </div>
                <?php endif; ?>

                
                <div class="<?php echo e($isAr ? 'text-right' : 'text-left'); ?>">
                    <div class="relative h-full">

                        
                        <div class="
                            absolute inset-0
                            rounded-3xl
                            bg-white/5
                            backdrop-blur-md
                            border border-white/10
                        "></div>

                        <div class="relative px-10 py-14">

                            <div class="
                                prose prose-lg
                                <?php echo e($isSideImage ? 'max-w-none' : 'max-w-3xl mx-auto'); ?>


                                prose-headings:text-white
                                prose-headings:font-extrabold
                                prose-headings:tracking-tight

                                prose-h2:text-3xl
                                prose-h3:text-2xl

                                prose-p:text-[#a8b2d1]
                                prose-p:leading-relaxed

                                prose-strong:text-white

                                prose-a:text-[#00b4d8]
                                hover:prose-a:underline

                                prose-ul:text-[#a8b2d1]
                                prose-li:marker:text-[#00b4d8]

                                prose-blockquote:border-s-4
                                prose-blockquote:border-[#00b4d8]
                                prose-blockquote:bg-white/5
                                prose-blockquote:text-white
                                prose-blockquote:rounded-xl
                                prose-blockquote:px-6
                                prose-blockquote:py-4
                                prose-blockquote:not-italic
                            ">
                                <?php echo $content; ?>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            
            <?php if($hasImage && $imgPosition === 'bottom'): ?>
                <div class="flex justify-center mt-14">
                    <img src="<?php echo e($image); ?>"
                         class="w-full max-w-3xl <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/sections/text.blade.php ENDPATH**/ ?>