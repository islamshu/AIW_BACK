<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div
    class="sector-card rounded-2xl overflow-hidden card-hover fade-in appear
           backdrop-blur-md border transition-all duration-300"
    style="
        background: color-mix(in srgb, var(--bg-color) 88%, white);
        border-color: color-mix(in srgb, var(--text-color) 12%, transparent);
    "
>

    
    <div class="relative">

        <?php if($sector->badge_text): ?>
            <div
                class="sector-badge"
                style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                "
            >
                <?php echo e($sector->getTranslation('badge_text', app()->getLocale())); ?>

            </div>
        <?php endif; ?>

        
        <div
            class="h-48 flex items-center justify-center"
            style="
                background: linear-gradient(
                    135deg,
                    <?php echo e($sector->gradient_from); ?>,
                    <?php echo e($sector->gradient_to); ?>

                );
            "
        >
            <?php if($sector->icon): ?>
                <i
                    class="<?php echo e($sector->icon); ?> text-6xl sector-icon"
                    style="color: var(--text-color)"
                ></i>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="p-6">

        <h3
            class="text-xl font-bold mb-3"
            style="color: var(--text-color)"
        >
            <?php echo e($sector->getTranslation('title', app()->getLocale())); ?>

        </h3>

        <p
            class="mb-4 leading-relaxed"
            style="color: color-mix(in srgb, var(--text-color) 75%, transparent);"
        >
            <?php echo $sector->getTranslation('description', app()->getLocale()); ?>

        </p>

        
        <?php if($sector->market_value && $sector->market_percent): ?>
            <div class="mb-2 flex justify-between items-center">
                <span
                    class="text-sm"
                    style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                >
                    <?php echo e(__('حجم السوق')); ?>

                </span>

                <span
                    class="text-sm font-bold"
                    style="color: var(--primary-color)"
                >
                    <?php echo e($sector->market_value); ?>B
                </span>
            </div>

            <div
                class="w-full h-2 rounded-full overflow-hidden"
                style="background: color-mix(in srgb, var(--text-color) 20%, transparent);"
            >
                <div
                    class="h-2 rounded-full transition-all duration-700"
                    style="
                        width: <?php echo e($sector->market_percent); ?>%;
                        background: linear-gradient(
                            90deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );
                    "
                ></div>
            </div>
        <?php endif; ?>

    </div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sectors_partials.blade.php ENDPATH**/ ?>