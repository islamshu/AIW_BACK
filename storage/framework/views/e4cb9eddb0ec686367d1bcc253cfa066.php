<section
    class="py-20 relative overflow-hidden"
    style="
        background:
            linear-gradient(
                180deg,
                var(--bg-color),
                color-mix(in srgb, var(--bg-color) 85%, var(--primary-color))
            );
    "
>
    <div class="container mx-auto px-4 relative z-10">

        
        <h2
            class="text-3xl md:text-4xl font-extrabold text-center mb-16 fade-in"
            style="
                background: linear-gradient(
                    135deg,
                    var(--primary-color),
                    var(--secondary-color)
                );
                -webkit-background-clip: text;
                color: transparent;
            "
            data-ar="لماذا تختار AIW؟"
            data-en="Why Choose AIW?"
        >
            <?php echo e(app()->getLocale() === 'ar' ? 'لماذا تختار AIW؟' : 'Why Choose AIW?'); ?>

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <?php $__currentLoopData = App\Models\HomeService::where('is_active', true)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div
                    class="rounded-2xl p-8 fade-in
                           transition-all duration-300
                           hover:-translate-y-2 hover:shadow-2xl"
                    style="
                        background: rgba(255,255,255,0.04);
                        border: 1px solid rgba(255,255,255,0.08);
                        backdrop-filter: blur(6px);
                        transition-delay: <?php echo e($index * 0.1); ?>s;
                    "
                >

                    
                    <div
                        class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                        "
                    >
                        <?php if($service->icon): ?>
                            <i class="<?php echo e($service->icon); ?> text-2xl text-white"></i>
                        <?php elseif($service->image): ?>
                            <img
                                src="<?php echo e(asset('storage/' . $service->image)); ?>"
                                alt="<?php echo e($service->title); ?>"
                                class="w-full h-full object-cover rounded-full"
                            >
                        <?php endif; ?>
                    </div>

                    
                    <h3
                        class="text-xl font-bold text-center mb-4 text-white"
                        data-ar="<?php echo e($service->getTranslation('title', 'ar')); ?>"
                        data-en="<?php echo e($service->getTranslation('title', 'en')); ?>"
                    >
                        <?php echo e($service->title); ?>

                    </h3>

                    
                    <p
                        class="text-center leading-relaxed"
                        style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                        data-ar="<?php echo e($service->getTranslation('description', 'ar')); ?>"
                        data-en="<?php echo e($service->getTranslation('description', 'en')); ?>"
                    >
                        <?php echo $service->description; ?>

                    </p>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>

    
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--primary-color) 20%, transparent),
                    transparent 70%
                );
            "
        ></div>
        <div
            class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: radial-gradient(
                    circle,
                    color-mix(in srgb, var(--secondary-color) 20%, transparent),
                    transparent 70%
                );
            "
        ></div>
    </div>

</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/services.blade.php ENDPATH**/ ?>