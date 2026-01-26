

<?php $__env->startSection('title', $news->title); ?>

<?php $__env->startSection('content'); ?>
<section class="py-20">
    <div class="container mx-auto px-4 max-w-4xl">

        
        <img src="<?php echo e(asset('storage/' . $news->image)); ?>"
             class="rounded-2xl mb-8 w-full">

        
        <span class="text-sm text-gray-400">
            <?php echo e($news->published_at->format('Y-m-d')); ?>

        </span>

        
        <h1 class="text-4xl font-extrabold my-4">
            <?php echo e($news->title); ?>

        </h1>

        
        <article class="prose max-w-none">
            <?php echo $news->content; ?>

        </article>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/news/show.blade.php ENDPATH**/ ?>