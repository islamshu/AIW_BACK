<?php
    $isAr = app()->getLocale() === 'ar';

    // ================= TEXT =================
    $title = $isAr ? ($data['title_ar'] ?? '') : ($data['title_en'] ?? '');
    $desc  = $isAr ? ($data['desc_ar'] ?? '')  : ($data['desc_en'] ?? '');

    $ctaText = $isAr
        ? ($data['cta_text_ar'] ?? null)
        : ($data['cta_text_en'] ?? null);

    $ctaUrl = $data['cta_url'] ?? null;

    // ================= IMAGE =================
    $imageId = $data['image_id'] ?? null;
    $media   = $imageId ? \App\Models\Media::find($imageId) : null;
    $hasImage = !empty($media);

    // settings
    $imgPosition = $data['image_position'] ?? 'right'; // left | right | top | bottom
    $imgSize     = $data['image_size'] ?? 'md';        // sm | md | lg | full
    $imgStyle    = $data['image_style'] ?? 'rounded';  // rounded | circle | square
    $imgShadow   = $data['image_shadow'] ?? 'md';      // none | sm | md | lg

    // ================= GRID LOGIC =================
    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']);

    if ($isSideImage) {
        $gridCols = match($imgSize) {
            'sm' => 'lg:grid-cols-[1fr_3fr]',   // 25% image
            'lg' => 'lg:grid-cols-[2fr_3fr]',   // ~40% image
            default => 'lg:grid-cols-2',        // 50/50
        };

        // swap if image on left
        if ($imgPosition === 'left') {
            $gridCols = str_replace('[1fr_3fr]', '[3fr_1fr]', $gridCols);
            $gridCols = str_replace('[2fr_3fr]', '[3fr_2fr]', $gridCols);
        }
    }

    // ================= IMAGE STYLE =================
    $imgRadius = match($imgStyle) {
        'circle' => 'rounded-full',
        'square' => 'rounded-none',
        default  => 'rounded-[32px]',
    };

    $imgShadowClass = match($imgShadow) {
        'none' => '',
        'sm'   => 'shadow-md',
        'lg'   => 'shadow-[0_30px_80px_rgba(0,0,0,.45)]',
        default => 'shadow-2xl',
    };
?>

<section class="relative bg-[#0a192f] overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="min-h-[75vh] flex items-center py-20">

            
            <?php if($hasImage && $imgPosition === 'top'): ?>
                <div class="flex justify-center mb-16">
                    <img src="<?php echo e($media->url); ?>"
                         alt="<?php echo e($media->alt ?? $title); ?>"
                         class="w-full max-w-4xl <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover">
                </div>
            <?php endif; ?>

            
            <div class="
                grid gap-14 items-center w-full
                <?php echo e($isSideImage ? $gridCols : 'grid-cols-1'); ?>

            ">

                
                <?php if($hasImage && $isSideImage): ?>
                    <div class="flex justify-center">
                        <div class="relative w-full">

                            
                            <div class="absolute -inset-6 <?php echo e($imgRadius); ?>

                                bg-gradient-to-r from-[#00b4d8]/20 to-[#ff5d8f]/20
                                blur-2xl"></div>

                            <img src="<?php echo e($media->url); ?>"
                                 alt="<?php echo e($media->alt ?? $title); ?>"
                                 class="
                                    relative w-full
                                    <?php echo e($imgRadius); ?>

                                    <?php echo e($imgShadowClass); ?>

                                    object-cover
                                 ">
                        </div>
                    </div>
                <?php endif; ?>

                
                <div class="<?php echo e($isAr ? 'text-right' : 'text-left'); ?>

                    <?php echo e(!$hasImage ? 'text-center' : ''); ?>

                ">

                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                        <span class="bg-gradient-to-r from-[#00b4d8] via-[#a8b2d1] to-[#ff5d8f]
                                     bg-clip-text text-transparent">
                            <?php echo e($title); ?>

                        </span>
                    </h1>

                    <?php if($desc): ?>
                        <div class="
                            mt-6 text-base md:text-lg text-[#a8b2d1] leading-relaxed
                            <?php echo e($hasImage
                                ? 'max-w-xl ' . ($isAr ? 'ms-auto' : '')
                                : 'max-w-3xl mx-auto'); ?>

                        ">
                            <?php echo $desc; ?>

                        </div>
                    <?php endif; ?>

                    <?php if($ctaText && $ctaUrl): ?>
                        <div class="mt-10 <?php echo e(!$hasImage ? 'flex justify-center' : ''); ?>">
                            <a href="<?php echo e($ctaUrl); ?>"
                               class="inline-flex items-center gap-2
                                      rounded-full
                                      bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                                      px-8 py-4
                                      text-white font-semibold
                                      shadow-lg
                                      hover:scale-105 transition">
                                <?php echo e($ctaText); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            
            <?php if($hasImage && $imgPosition === 'bottom'): ?>
                <div class="flex justify-center mt-16">
                    <img src="<?php echo e($media->url); ?>"
                         alt="<?php echo e($media->alt ?? $title); ?>"
                         class="w-full max-w-4xl <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?> object-cover">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/sections/hero.blade.php ENDPATH**/ ?>