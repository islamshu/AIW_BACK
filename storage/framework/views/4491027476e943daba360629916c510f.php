<?php
    $textAr  = $data['text_ar'] ?? '';
    $textEn  = $data['text_en'] ?? '';
    $content = app()->getLocale() === 'ar' ? $textAr : $textEn;
    $isAr    = app()->getLocale() === 'ar';

    $image    = $data['image'] ?? null;
    $hasImage = !empty($image);

    $imgPosition = $data['image_position'] ?? 'right';
    $imgSize     = $data['image_size'] ?? 'md';
    $imgStyle    = $data['image_style'] ?? 'rounded';
    $imgShadow   = $data['image_shadow'] ?? 'md';

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

    $imgMaxWidth = match($imgSize) {
        'sm' => 'max-w-[220px]',
        'md' => 'max-w-[360px]',
        'lg' => 'max-w-[520px]',
        'full' => 'w-full',
        default => 'max-w-[360px]',
    };

    $isSideImage = $hasImage && in_array($imgPosition, ['left','right']) && $imgSize !== 'full';

    if ($isSideImage) {
        $gridCols = match($imgSize) {
            'sm' => $imgPosition === 'left'
                ? 'lg:grid-cols-[1fr_3fr]'
                : 'lg:grid-cols-[3fr_1fr]',

            'md' => 'lg:grid-cols-2',

            'lg' => $imgPosition === 'left'
                ? 'lg:grid-cols-[2fr_3fr]'
                : 'lg:grid-cols-[3fr_2fr]',

            default => 'lg:grid-cols-2',
        };
    }
?>

<section class="relative overflow-hidden">
    <div class="container mx-auto px-4 py-20">

        
        <?php if($hasImage && $imgPosition === 'top'): ?>
            <div class="flex justify-center mb-14">
                <img src="<?php echo e($image); ?>" class="<?php echo e($imgMaxWidth); ?> <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?>">
            </div>
        <?php endif; ?>

        
        <?php if($hasImage && $isSideImage): ?>
            <div class="grid gap-12 items-center <?php echo e($gridCols); ?>">

                <?php if($imgPosition === 'left'): ?>
                    
                    <div class="flex justify-center">
                        <img src="<?php echo e($image); ?>" class="<?php echo e($imgMaxWidth); ?> <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?>">
                    </div>
                <?php endif; ?>

                
                <div class="<?php echo e($isAr ? 'text-right' : 'text-left'); ?>">
                    <div class="bg-white/80 rounded-3xl px-10 py-14 shadow-sm">
                        <?php echo $content; ?>

                    </div>
                </div>

                <?php if($imgPosition === 'right'): ?>
                    
                    <div class="flex justify-center">
                        <img src="<?php echo e($image); ?>" class="<?php echo e($imgMaxWidth); ?> <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?>">
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        
        <?php if(!$isSideImage): ?>
            <div class="<?php echo e($isAr ? 'text-right' : 'text-left'); ?>">
                <?php echo $content; ?>

            </div>
        <?php endif; ?>

        
        <?php if($hasImage && $imgPosition === 'bottom'): ?>
            <div class="flex justify-center mt-14">
                <img src="<?php echo e($image); ?>" class="<?php echo e($imgMaxWidth); ?> <?php echo e($imgRadius); ?> <?php echo e($imgShadowClass); ?>">
            </div>
        <?php endif; ?>

    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/sections/text.blade.php ENDPATH**/ ?>