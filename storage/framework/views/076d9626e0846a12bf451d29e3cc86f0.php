

<?php $__env->startSection('title', isset($group) ? 'تعديل عنوان رئيسي' : 'إضافة عنوان رئيسي'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="mb-4">
        <h1 class="h3 mb-1">
            <?php echo e(isset($group) ? 'تعديل عنوان رئيسي' : 'إضافة عنوان رئيسي جديد'); ?>

        </h1>
        <p class="text-muted mb-0">
            <?php echo e(isset($group) ? 'تعديل بيانات العنوان الرئيسي' : 'إدخال بيانات العنوان الرئيسي'); ?>

        </p>
    </div>
    <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <form method="POST"
          action="<?php echo e(isset($group)
                    ? route('dashboard.job-groups.update', $group)
                    : route('dashboard.job-groups.store')); ?>">

        <?php echo csrf_field(); ?>
        <?php if(isset($group)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="fw-bold">العنوان الرئيسي (AR)</label>
                        <input type="text"
                               name="title[ar]"
                               class="form-control"
                               value="<?php echo e(old('title.ar', $group?->getTranslation('title','ar'))); ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Main Group Title (EN)</label>
                        <input type="text"
                               name="title[en]"
                               class="form-control"
                               value="<?php echo e(old('title.en', $group?->getTranslation('title','en'))); ?>"
                               required>
                    </div>


                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2 bg-white">
                <a href="<?php echo e(route('dashboard.job-groups.index')); ?>" class="btn btn-light">رجوع</a>
                <button type="submit" class="btn btn-primary">
                    <?php echo e(isset($group) ? 'تحديث' : 'حفظ'); ?>

                </button>
            </div>
        </div>

    </form>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/job_groups/create.blade.php ENDPATH**/ ?>