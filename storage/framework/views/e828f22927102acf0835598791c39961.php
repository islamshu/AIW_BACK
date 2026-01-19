

<?php $__env->startSection('title','تعديل السكشن'); ?>

<?php $__env->startSection('style'); ?>
<style>
    .lang-tabs .nav-link {
        font-weight: 600;
    }

    .lang-tabs .nav-link.active {
        background: #0d6efd;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="mb-4">
        <h3 class="mb-1">
            <?php echo e($meta['icon'] ?? ''); ?> <?php echo e($meta['label']); ?>

        </h3>
        <small class="text-muted">
            تعديل محتوى السكشن
        </small>
    </div>

    
    <ul class="nav nav-tabs lang-tabs mb-3">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ar">
                🇵🇸 عربي
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-en">
                🇬🇧 English
            </button>
        </li>
    </ul>

    
    <form method="POST" action="<?php echo e(route('dashboard.home-sections.update', $section)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="tab-content">

            
            <div class="tab-pane fade show active" id="tab-ar">
                <?php if ($__env->exists('dashboard.home-sections.forms.' . $section->key . '-ar')) echo $__env->make('dashboard.home-sections.forms.' . $section->key . '-ar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            
            <div class="tab-pane fade" id="tab-en">
                <?php if ($__env->exists('dashboard.home-sections.forms.' . $section->key . '-en')) echo $__env->make('dashboard.home-sections.forms.' . $section->key . '-en', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

        </div>

        
        <div class="mt-4">
            <button class="btn btn-primary px-4">
                <i class="fas fa-save"></i> حفظ التغييرات
            </button>

            <a href="<?php echo e(route('dashboard.home-sections.index')); ?>" class="btn btn-light">
                رجوع
            </a>
        </div>

    </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/home-sections/edit.blade.php ENDPATH**/ ?>