<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in appear">

    <div class="relative">
        <?php if($sector->badge_text): ?>
            <div class="sector-badge">
                <?php echo e($sector->getTranslation('badge_text', app()->getLocale())); ?>

            </div>
        <?php endif; ?>

        <div class="h-48 bg-gradient-to-r
            from-[<?php echo e($sector->gradient_from); ?>]
            to-[<?php echo e($sector->gradient_to); ?>]
            flex items-center justify-center">

            <?php if($sector->icon): ?>
                <i class="<?php echo e($sector->icon); ?> text-white text-6xl sector-icon"></i>
            <?php endif; ?>
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-white mb-3">
            <?php echo e($sector->getTranslation('title', app()->getLocale())); ?>

        </h3>

        <p class="text-[#8892b0] mb-4">
            <?php echo $sector->getTranslation('description', app()->getLocale()); ?>

        </p>

        
        <?php if($sector->market_value && $sector->market_percent): ?>
            <div class="mb-2 flex justify-between">
                <span class="text-sm text-[#a8b2d1]"><?php echo e(__('حجم السوق')); ?></span>
                <span class="text-sm font-bold text-[#00b4d8]">
                    <?php echo e($sector->market_value); ?>B
                </span>
            </div>

            <div class="w-full bg-gray-700 rounded-full h-2">
                <div class="market-size-bar h-2 rounded-full"
                     style="width: <?php echo e($sector->market_percent); ?>%"></div>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sectors_partials.blade.php ENDPATH**/ ?>