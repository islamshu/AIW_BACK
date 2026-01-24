<section
    class="py-24 relative overflow-hidden"
    style="background: var(--bg-color);"
>

    <div class="container mx-auto px-4 relative z-10">

        
        <h2
            class="text-3xl md:text-4xl font-extrabold text-center mb-16 fade-in"
            style="
                color: var(--primary-color);
            "
        >
            <?php echo e(app()->getLocale() === 'ar' ? 'لماذا تختار AIW؟' : 'Why Choose AIW?'); ?>

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <?php $__currentLoopData = App\Models\HomeService::where('is_active', true)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div
                    class="rounded-2xl p-8 fade-in transition-all duration-300 hover:-translate-y-2"
                    style="
                        background: #ffffff;
                        border: 1px solid #e2e8f0;
                        transition-delay: <?php echo e($index * 0.1); ?>s;
                    "
                >

                    
                    <div
                        class="w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-6"
                        style="
                            background: color-mix(in srgb, var(--primary-color) 12%, transparent);
                        "
                    >
                        <?php if($service->icon): ?>
                            <i
                                class="<?php echo e($service->icon); ?>"
                                style="
                                    color: var(--primary-color);
                                    font-size: 24px;
                                "
                            ></i>
                        <?php endif; ?>
                    </div>

                    
                    <h3
                        class="text-lg font-bold text-center mb-3"
                        style="color: var(--text-color);"
                    >
                        <?php echo e($service->title); ?>

                    </h3>

                    
                    <p
                        class="text-center text-sm leading-relaxed"
                        style="color: color-mix(in srgb, var(--text-color) 80%, transparent);"
                    >
                        <?php echo strip_tags($service->description); ?>

                    </p>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>

    
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-3xl"
            style="
                background: color-mix(in srgb, var(--primary-color) 15%, transparent);
            "
        ></div>
        <div
            class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-3xl"
            style="
                background: color-mix(in srgb, var(--secondary-color) 15%, transparent);
            "
        ></div>
    </div>

</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/services.blade.php ENDPATH**/ ?>