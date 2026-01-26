

<?php $__env->startSection('title', app()->getLocale() === 'ar' ? 'الاخبار' : 'News'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-20">
    <div class="container mx-auto px-4">

        <h1 class="text-4xl font-extrabold mb-10 text-center">
            <?php echo e(app()->getLocale() === 'ar' ? 'الاخبار' : 'News'); ?>

        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                
                <div class="h-48 overflow-hidden">
                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>"
                         class="w-full h-full object-cover">
                </div>

                
                <div class="p-6">
                    <span class="text-sm text-gray-400">
                        <?php echo e($item->published_at->format('Y-m-d')); ?>

                    </span>

                    <h3 class="font-bold text-lg mt-2 mb-3">
                        <?php echo e($item->title); ?>

                    </h3>

                    <p class="text-gray-600 text-sm mb-4">
                        <?php echo e(Str::limit($item->excerpt, 120)); ?>

                    </p>

                    <a href="<?php echo e(route('news.show', $item)); ?>"
                       class="text-primary font-semibold hover:underline">
                       <?php echo e(app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More'); ?>

                       →
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <div class="mt-12">
            <?php echo e($news->links()); ?>

        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/news/index.blade.php ENDPATH**/ ?>