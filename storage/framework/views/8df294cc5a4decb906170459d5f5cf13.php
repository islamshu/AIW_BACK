

<?php $__env->startSection('title', $service->title); ?>

<?php $__env->startSection('content'); ?>


<section class="pt-10 relative overflow-hidden"
    style="background: linear-gradient(135deg,var(--bg-color),color-mix(in srgb,var(--bg-color) 85%,white));">

    <div class="container mx-auto px-4 text-center max-w-4xl">

        
        <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl"
             style="background: color-mix(in srgb,var(--primary-color) 15%,transparent)">
            <?php if($service->icon): ?>
                <i class="<?php echo e($service->icon); ?> text-4xl"
                   style="color: var(--primary-color)"></i>
            <?php elseif($service->image): ?>
                <img src="<?php echo e(asset('storage/'.$service->image)); ?>"
                     class="w-10 h-10 object-contain">
            <?php endif; ?>
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 gradient-text">
            <?php echo e($service->title); ?>

        </h1>

        <p class="text-xl"
           style="color: color-mix(in srgb,var(--text-color) 70%,transparent)">
            <?php echo e(strip_tags($service->excerpt ?? $service->description)); ?>

        </p>

    </div>
</section>



<section class="py-10" style="background: var(--bg-color)">
    <div class="container mx-auto px-4 max-w-4xl">

        <article class="prose prose-lg max-w-none"
                 style="color: var(--text-color)">
            <?php echo $service->long_description
                ?: $service->description; ?>

        </article>

        <div class="mt-14 text-center">
            <a href="<?php echo e(route('services.index')); ?>"
               class="inline-block px-10 py-3 rounded-full font-bold text-white
                      transition hover:scale-105"
               style="background: linear-gradient(135deg,var(--primary-color),var(--secondary-color))">
                ← <?php echo e(__('العودة إلى الخدمات')); ?>

            </a>
        </div>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/services/show.blade.php ENDPATH**/ ?>