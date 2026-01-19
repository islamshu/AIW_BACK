<section class="py-20 bg-[#0a192f]">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 gradient-text fade-in" data-ar="لماذا تختار AIW؟"
            data-en="Why Choose AIW?">لماذا تختار AIW؟</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- بطاقة 1 -->
            <?php $__currentLoopData = App\Models\HomeService::where('is_active', true)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-[#233554] rounded-2xl p-8 card-hover slide-in-left">
                    <?php if($service->icon): ?>
                        <!-- إذا كانت أيقونة FontAwesome -->
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center mx-auto mb-6 floating-icon">
                            <i class="<?php echo e($service->icon); ?> text-2xl text-white"></i>
                        </div>
                    <?php elseif($service->image): ?>
                        <!-- إذا كانت صورة -->
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center mx-auto mb-6 floating-icon overflow-hidden">
                            <img src="<?php echo e(asset('storage/' . $service->image)); ?>" alt="<?php echo e($service->title); ?>"
                                class=" object-cover">
                        </div>
                    <?php endif; ?>

                    <h3 class="text-xl font-bold text-white mb-4 text-center"
                        data-ar="<?php echo e($service->getTranslation('title', 'ar')); ?>"
                        data-en="<?php echo e($service->getTranslation('title', 'en')); ?>">
                        <?php echo e($service->title); ?>

                    </h3>

                    <p class="text-[#8892b0] text-center" data-ar="<?php echo e($service->getTranslation('description', 'ar')); ?>"
                        data-en="<?php echo e($service->getTranslation('description', 'en')); ?>">
                        <?php echo $service->description; ?>


                    </p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/services.blade.php ENDPATH**/ ?>