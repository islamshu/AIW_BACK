
<?php $__env->startSection('title', 'الرئيسية'); ?>
<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = App\Models\HomeSection::where('is_active', true)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if ($__env->exists(
        'frontend.sections.' . $section->key,
        [
            'section' => $section,
            'data' => $section->contentable
        ]
    )) echo $__env->make(
        'frontend.sections.' . $section->key,
        [
            'section' => $section,
            'data' => $section->contentable
        ]
    , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/index.blade.php ENDPATH**/ ?>