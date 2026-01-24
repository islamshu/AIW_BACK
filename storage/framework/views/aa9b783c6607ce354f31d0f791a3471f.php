

<?php $__env->startSection('title', isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="mb-4">
        <h1 class="h3 mb-1">
            <?php echo e(isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة جديدة'); ?>

        </h1>
        <p class="text-muted mb-0">
            <?php echo e(isset($job) ? 'تعديل بيانات الوظيفة' : 'إدخال بيانات الوظيفة'); ?>

        </p>
    </div>

    <form method="POST"
          action="<?php echo e(isset($job)
                    ? route('dashboard.jobs.update', $job)
                    : route('dashboard.jobs.store')); ?>">

        <?php echo csrf_field(); ?>
        <?php if(isset($job)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="card shadow-sm">

            <div class="card-body">
                <div class="row g-4">

                    
                    <div class="col-md-6">
                        <label class="fw-bold">عنوان الوظيفة (AR)</label>
                        <input type="text"
                               name="title[ar]"
                               class="form-control"
                               value="<?php echo e(old('title.ar', $job?->getTranslation('title','ar'))); ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Job Title (EN)</label>
                        <input type="text"
                               name="title[en]"
                               class="form-control"
                               value="<?php echo e(old('title.en', $job?->getTranslation('title','en'))); ?>"
                               required>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="fw-bold">تاريخ النشر من</label>
                        <input type="date"
                        name="publish_from"
                        class="form-control"
                        value="<?php echo e(old('publish_from', isset($job) && $job->publish_from ? $job->publish_from->format('Y-m-d') : '')); ?>"
                        required>

                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">تاريخ النشر إلى</label>
                        <input type="date"
                               name="publish_to"
                               class="form-control"
                               value="<?php echo e(old('publish_to', isset($job) && $job->publish_to ? $job->publish_to->format('Y-m-d') : '')); ?>"
                               required>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="fw-bold">المؤهلات (AR)</label>
                        <textarea name="requirements[ar]"
                                  class="form-control js-editor"
                                  rows="6"><?php echo e(old('requirements.ar', $job?->getTranslation('requirements','ar'))); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Requirements (EN)</label>
                        <textarea name="requirements[en]"
                                  class="form-control js-editor"
                                  rows="6"><?php echo e(old('requirements.en', $job?->getTranslation('requirements','en'))); ?></textarea>
                    </div>

                  

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('dashboard.jobs.index')); ?>" class="btn btn-light">
                    رجوع
                </a>
                <button type="submit" class="btn btn-primary">
                    <?php echo e(isset($job) ? 'تحديث' : 'حفظ'); ?>

                </button>
            </div>

        </div>
    </form>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/jobs/create.blade.php ENDPATH**/ ?>