<section class="py-20 bg-[#112240]">
    <div class="container mx-auto px-4">


        <?php
              $sectors = App\Models\Sector::where('is_active', true)
        ->orderBy('order')
        ->limit(3)
        ->get();
        $count = App\Models\Sector::where('is_active', true)
        ->orderBy('order')
        ->count()
        ?>
        
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-6 fade-in">
                <?php echo e(__('القطاعات الاستراتيجية')); ?>

            </h2>
            <p class="text-xl text-[#a8b2d1] max-w-3xl mx-auto fade-in">
                <?php echo e(__('نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية')); ?>

            </p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                     style="transition-delay: <?php echo e($index * 0.1); ?>s;">

                    
                    <div class="relative h-48 overflow-hidden">

                        
                        <?php if($sector->badge_text): ?>
                            <div class="sector-badge">
                                <?php echo e($sector->getTranslation('badge_text', app()->getLocale())); ?>

                            </div>
                        <?php endif; ?>

                        
                        <div class="w-full h-full bg-gradient-to-r
                            from-[<?php echo e($sector->gradient_from); ?>]
                            to-[<?php echo e($sector->gradient_to); ?>]
                            flex items-center justify-center">

                            <?php if($sector->icon): ?>
                                <i class="<?php echo e($sector->icon); ?> text-white text-6xl floating-icon"></i>
                            <?php endif; ?>
                        </div>

                        
                        <div class="image-overlay">
                            <h4 class="text-white font-bold text-lg">
                                <?php echo e($sector->getTranslation('title', app()->getLocale())); ?>

                            </h4>
                        </div>
                    </div>

                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3">
                            <?php echo e($sector->getTranslation('title', app()->getLocale())); ?>

                        </h3>

                        <p class="text-[#8892b0]">
                            <?php echo $sector->getTranslation('description', app()->getLocale()); ?>

                        </p>

                        
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        
        <?php if(get_general_value('sectors_enabled')): ?>
        <?php if($count > count($sectors)): ?>
        <div class="text-center mt-12 fade-in">

            <a href="/sectors"
               class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
               text-white font-bold py-3 px-8 rounded-full inline-flex items-center gap-2
               hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                <span><?php echo e(__('عرض جميع القطاعات')); ?></span>
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <?php endif; ?>
        <?php endif; ?>

    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/sectors.blade.php ENDPATH**/ ?>