<?php
    $isAr = app()->getLocale() === 'ar';

    // عنوان القسم
    $sectionTitle = $isAr
        ? ($data['title_ar'] ?? null)
        : ($data['title_en'] ?? null);

    // عناصر الريبيتر
    $items = $data['items'] ?? [];

    if (!is_array($items) || count($items) === 0) {
        return;
    }

    // طريقة العرض
    // multi  = كل عنصر داخل كارد
    // single = كل العناصر داخل كارد واحد
    $mode = $data['display_mode'] ?? 'multi';

    // عدد الأعمدة حسب عرض العمود
    if ($col >= 10) {
        $grid = 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3';
    } elseif ($col >= 7) {
        $grid = 'grid-cols-1 sm:grid-cols-2';
    } else {
        $grid = 'grid-cols-1';
    }
?>

<section class="relative">

    
    <?php if($sectionTitle): ?>
        <div class="mb-12 <?php echo e($isAr ? 'text-right' : 'text-left'); ?>">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight
                       bg-gradient-to-r from-[#00b4d8] via-[#a8b2d1] to-[#ff5d8f]
                       bg-clip-text text-transparent">
                <?php echo e($sectionTitle); ?>

            </h2>
        </div>
    <?php endif; ?>

    
    <?php if($mode === 'multi'): ?>
        <div class="grid <?php echo e($grid); ?> gap-8">

            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $title = $isAr ? ($item['title_ar'] ?? '') : ($item['title_en'] ?? '');
                    $desc  = $isAr ? ($item['desc_ar'] ?? '')  : ($item['desc_en'] ?? '');
                    $icon  = $item['icon'] ?? 'fa-regular fa-star';
                    $color = $item['icon_color'] ?? '#00b4d8';
                ?>

                <div class="rounded-3xl p-8
                            bg-white/5 backdrop-blur-md
                            border border-white/10
                            transition-all duration-300
                            hover:-translate-y-2
                            hover:border-[#00b4d8]/40
                            hover:shadow-[0_20px_40px_-20px_rgba(0,180,216,0.35)]">
        <div style="display: ruby-text; ">
                    <div class="mb-6 h-14 w-14 flex items-center justify-center rounded-2xl"
                         style="background: <?php echo e($color); ?>22;">
                        <i class="<?php echo e($icon); ?>" style="color: <?php echo e($color); ?>"></i>
                       
                    </div>
                    <h3 class="mb-3 m-5 text-lg font-bold text-white">
                            <?php echo e($title); ?>

                        </h3>
        </div>

                    <?php if($title): ?>
                       
                    <?php endif; ?>

                    <?php if($desc): ?>
                        <p class="text-sm text-[#a8b2d1] leading-relaxed">
                            <?php echo e($desc); ?>

                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    <?php endif; ?>

    
    <?php if($mode === 'single'): ?>
        <div class="rounded-3xl p-10
                    bg-white/5 backdrop-blur-md
                    border border-white/10">

            <div class="grid <?php echo e($grid); ?> gap-8">

                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $title = $isAr ? ($item['title_ar'] ?? '') : ($item['title_en'] ?? '');
                        $desc  = $isAr ? ($item['desc_ar'] ?? '')  : ($item['desc_en'] ?? '');
                        $icon  = $item['icon'] ?? 'fa-regular fa-star';
                        $color = $item['icon_color'] ?? '#00b4d8';
                    ?>

                    <div class="flex gap-4 items-start">

                        <div class="h-12 w-12 flex items-center justify-center rounded-xl flex-shrink-0"
                             style="background: <?php echo e($color); ?>22;">
                            <i class="<?php echo e($icon); ?>" style="color: <?php echo e($color); ?>"></i>
                        </div>

                        <div>
                            <?php if($title): ?>
                                <h4 class="text-base font-bold text-white mb-1">
                                    <?php echo e($title); ?>

                                </h4>
                            <?php endif; ?>

                            <?php if($desc): ?>
                                <p class="text-sm text-[#a8b2d1] leading-relaxed">
                                    <?php echo e($desc); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    <?php endif; ?>

</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/sections/repeater.blade.php ENDPATH**/ ?>