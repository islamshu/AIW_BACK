<?php
    $isAr = app()->getLocale() === 'ar';

    // عنوان القسم
    $sectionTitle = $isAr
        ? ($data['title_ar'] ?? null)
        : ($data['title_en'] ?? null);

    // عناصر الريبيتر
    $items = $data['items'] ?? [];
    if (!is_array($items) || count($items) === 0) return;

    // طريقة العرض
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
            <h2
                class="text-2xl md:text-3xl font-extrabold tracking-tight"
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
                ?>

                <div
                    class="rounded-3xl p-8 backdrop-blur-md border
                           transition-all duration-300
                           hover:-translate-y-2"
                    style="
                        background: color-mix(in srgb, var(--bg-color) 85%, white);
                        border-color: color-mix(in srgb, var(--text-color) 12%, transparent);
                    "
                >
                    <div class="flex items-center gap-4 mb-4">

                        <div
                            class="h-14 w-14 flex items-center justify-center rounded-2xl"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                opacity: .18;
                            "
                        >
                            <i class="<?php echo e($icon); ?>" style="color: var(--primary-color)"></i>
                        </div>

                        <?php if($title): ?>
                            <h3 class="text-lg font-bold text-[var(--text-color)]">
                                <?php echo e($title); ?>

                            </h3>
                        <?php endif; ?>
                    </div>

                    <?php if($desc): ?>
                        <p
                            class="text-sm leading-relaxed"
                            style="color: color-mix(in srgb, var(--text-color) 75%, transparent);"
                        >
                            <?php echo e($desc); ?>

                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    <?php endif; ?>

    
    <?php if($mode === 'single'): ?>
        <div
            class="rounded-3xl p-10 backdrop-blur-md border"
            style="
                background: color-mix(in srgb, var(--bg-color) 85%, white);
                border-color: color-mix(in srgb, var(--text-color) 12%, transparent);
            "
        >
            <div class="grid <?php echo e($grid); ?> gap-8">

                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $title = $isAr ? ($item['title_ar'] ?? '') : ($item['title_en'] ?? '');
                        $desc  = $isAr ? ($item['desc_ar'] ?? '')  : ($item['desc_en'] ?? '');
                        $icon  = $item['icon'] ?? 'fa-regular fa-star';
                    ?>

                    <div class="flex gap-4 items-start">

                        <div
                            class="h-12 w-12 flex items-center justify-center rounded-xl flex-shrink-0"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                                opacity: .18;
                            "
                        >
                            <i class="<?php echo e($icon); ?>" style="color: var(--primary-color)"></i>
                        </div>

                        <div>
                            <?php if($title): ?>
                                <h4 class="text-base font-bold text-[var(--text-color)] mb-1">
                                    <?php echo e($title); ?>

                                </h4>
                            <?php endif; ?>

                            <?php if($desc): ?>
                                <p
                                    class="text-sm leading-relaxed"
                                    style="color: color-mix(in srgb, var(--text-color) 75%, transparent);"
                                >
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