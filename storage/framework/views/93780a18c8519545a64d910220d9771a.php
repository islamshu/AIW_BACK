

<?php $__env->startSection('title', app()->getLocale() === 'ar' ? 'خدماتنا' : 'Services'); ?>

<?php $__env->startSection('style'); ?>
<style>
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity .8s ease, transform .8s ease;
}
.fade-in.appear {
    opacity: 1;
    transform: translateY(0);
}

.card-hover {
    transition: .35s ease;
}
.card-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px -25px
        color-mix(in srgb, var(--primary-color) 35%, transparent);
}

.service-card {
    position: relative;
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.service-icon {
    transition: .4s ease;
}
.service-card:hover .service-icon {
    transform: scale(1.2) rotate(5deg);
}

.gradient-text {
    background: linear-gradient(
        to right,
        var(--primary-color),
        var(--secondary-color)
    );
    -webkit-background-clip: text;
    color: transparent;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="pt-32 pb-20 text-center relative overflow-hidden"
    style="background: linear-gradient(135deg,var(--bg-color),color-mix(in srgb,var(--bg-color) 85%,white));">

    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 gradient-text fade-in">
            <?php echo e(app()->getLocale() === 'ar' ? 'خدماتنا' : 'Services'); ?>

        </h1>

        <p class="text-xl max-w-3xl mx-auto fade-in"
           style="color: color-mix(in srgb, var(--text-color) 70%, transparent);">
            <?php echo e(app()->getLocale() === 'ar' ? 'نقدم حلولاً متكاملة تساعد الشركات على النمو بثقة واستدامة' : 'We offer integrated solutions that help companies grow confidently and sustainably.'); ?>

        </p>
    </div>
</section>


<section class="py-20" style="background: var(--bg-color)">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="service-card card-hover fade-in"
                     style="transition-delay: <?php echo e($index * .1); ?>s">

                    
                    <div class="flex items-center justify-center h-40"
                        style="background: color-mix(in srgb,var(--primary-color) 10%,transparent)">
                        <?php if($service->icon): ?>
                            <i class="<?php echo e($service->icon); ?> text-5xl service-icon"
                               style="color: var(--primary-color)"></i>
                        <?php elseif($service->image): ?>
                            <img src="<?php echo e(asset('storage/'.$service->image)); ?>"
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
                           class="inline-flex items-center gap-2 font-bold text-sm"
                           style="color: var(--primary-color)">
                            <?php echo e(__('عرض التفاصيل')); ?>

                            <span>→</span>
                        </a>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.querySelectorAll('.fade-in').forEach((el, i) => {
    setTimeout(() => el.classList.add('appear'), i * 120);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/services/index.blade.php ENDPATH**/ ?>