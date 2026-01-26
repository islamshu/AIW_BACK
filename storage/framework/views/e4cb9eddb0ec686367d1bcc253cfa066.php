<?php
        $services = App\Models\HomeService::where('is_active', true)->orderBy('order')->limit(3)->get();

        $count = App\Models\HomeService::where('is_active', true)->count();
    ?>
    <?php if($count > 0): ?>
<section class="py-24 relative overflow-hidden" style="background: var(--bg-color);">
    

    <div class="container mx-auto px-4 relative z-10">

        
        <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-6 fade-in" style="color: var(--primary-color);">
            <?php echo e(app()->getLocale() === 'ar' ? 'لماذا تختار AIW؟' : 'Why Choose AIW?'); ?>

        </h2>

        <p class="text-center max-w-3xl mx-auto mb-16 fade-in"
            style="color: color-mix(in srgb,var(--text-color) 70%,transparent);">
            <?php echo e(app()->getLocale() === 'ar'
                ? 'نقدّم حلولاً متكاملة تجمع بين الاستثمار الذكي والتشغيل الاحترافي لتحقيق نمو مستدام وقيمة طويلة الأمد.'
                : 'We deliver integrated solutions combining smart investment and professional operations to achieve sustainable growth and long-term value.'); ?>

        </p>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="service-card card-hover fade-in" style="transition-delay: <?php echo e($index * 0.1); ?>s">

                    
                    <div class="flex items-center justify-center h-40"
                        style="background: color-mix(in srgb,var(--primary-color) 10%,transparent)">
                        <?php if($service->icon): ?>
                            <i class="<?php echo e($service->icon); ?> text-5xl service-icon"
                                style="color: var(--primary-color)"></i>
                        <?php elseif($service->image): ?>
                            <img src="<?php echo e(asset('storage/' . $service->image)); ?>"
                                class="w-16 h-16 object-contain service-icon">
                        <?php endif; ?>
                    </div>

                    
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold mb-3" style="color: var(--text-color)">
                            <?php echo e($service->title); ?>

                        </h3>

                        <p class="text-sm mb-6 leading-relaxed"
                            style="color: color-mix(in srgb,var(--text-color) 70%,transparent)">
                            <?php echo e(Str::limit(strip_tags($service->description), 120)); ?>

                        </p>

                        <a href="<?php echo e(route('services.show', $service->id)); ?>"
                            class="inline-flex items-center gap-2 font-bold text-sm transition"
                            style="color: var(--primary-color)">
                            <?php echo e(app()->getLocale() === 'ar' ? 'عرض التفاصيل' : 'View Details'); ?>

                            <span>→</span>
                        </a>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        

        <?php if(get_general_value('services_enabled') && $count > count($services)): ?>
            <div class="text-center mt-16 fade-in">
                <a href="<?php echo e(route('services.index')); ?>"
                    class="inline-flex items-center gap-3 px-12 py-4 rounded-full font-bold text-white
                       transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                    style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                ">
                    <?php echo e(app()->getLocale() === 'ar' ? 'رؤية جميع الخدمات' : 'View All Services'); ?>

                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        <?php endif; ?>

    </div>

    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-3xl"
            style="background: color-mix(in srgb, var(--primary-color) 15%, transparent);"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-3xl"
            style="background: color-mix(in srgb, var(--secondary-color) 15%, transparent);"></div>
    </div>

</section>
<?php endif; ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/services.blade.php ENDPATH**/ ?>