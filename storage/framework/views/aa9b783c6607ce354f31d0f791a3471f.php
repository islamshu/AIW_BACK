

<?php $__env->startSection('title', isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid job-form-page">

    
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">
            <?php echo e(isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة جديدة'); ?>

        </h1>
        <p class="text-muted mb-0">
            <?php echo e(isset($job) ? 'تعديل بيانات الوظيفة وربطها بالعنوان الرئيسي' : 'إدخال بيانات الوظيفة وربطها بالعنوان الرئيسي'); ?>

        </p>
    </div>

    <form method="POST"
          action="<?php echo e(isset($job)
                    ? route('dashboard.jobs.update', $job)
                    : route('dashboard.jobs.store')); ?>">

        <?php echo csrf_field(); ?>
        <?php if(isset($job)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        
        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                
                <div class="col-md-12">
                    <label class="form-label fw-semibold mb-2">
                        العنوان الرئيسي (Main Group)
                    </label>
                
                    <div class="custom-select-wrapper">
                        <select name="job_group_id"
                                class="form-select custom-select"
                                required>
                            <option value="" disabled
                                <?php echo e(old('job_group_id', $job->job_group_id ?? '') ? '' : 'selected'); ?>>
                                اختر العنوان الرئيسي...
                            </option>
                
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($group->id); ?>"
                                    <?php echo e((string) old('job_group_id', $job->job_group_id ?? '') === (string) $group->id ? 'selected' : ''); ?>>
                                    <?php echo e($group->getTranslation('title','ar')); ?>

                                    — <?php echo e($group->getTranslation('title','en')); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                
                        <i class="fas fa-chevron-down select-icon"></i>
                    </div>
                </div>
                

                
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-briefcase text-primary"></i>
                        <span>عنوان الوظيفة</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">عنوان الوظيفة (AR)</label>
                            <input type="text"
                                   name="title[ar]"
                                   class="form-control form-control-lg"
                                   placeholder="مثال: مطور Laravel"
                                   value="<?php echo e(old('title.ar', $job?->getTranslation('title','ar'))); ?>"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Title (EN)</label>
                            <input type="text"
                                   name="title[en]"
                                   class="form-control form-control-lg"
                                   placeholder="Laravel Developer"
                                   value="<?php echo e(old('title.en', $job?->getTranslation('title','en'))); ?>"
                                   required>
                        </div>
                    </div>
                </div>

                
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-calendar-alt text-primary"></i>
                        <span>فترة النشر</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">تاريخ النشر من</label>
                            <input type="date"
                                   name="publish_from"
                                   class="form-control form-control-lg"
                                   value="<?php echo e(old('publish_from', isset($job) && $job->publish_from ? $job->publish_from->format('Y-m-d') : '')); ?>"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">تاريخ النشر إلى</label>
                            <input type="date"
                                   name="publish_to"
                                   class="form-control form-control-lg"
                                   value="<?php echo e(old('publish_to', isset($job) && $job->publish_to ? $job->publish_to->format('Y-m-d') : '')); ?>">
                        </div>
                    </div>
                </div>

                
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-list-check text-primary"></i>
                        <span>المؤهلات والمتطلبات</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">المؤهلات (AR)</label>
                            <textarea name="requirements[ar]"
                                      class="form-control js-editor"
                                      rows="6"><?php echo e(old('requirements.ar', $job?->getTranslation('requirements','ar'))); ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Requirements (EN)</label>
                            <textarea name="requirements[en]"
                                      class="form-control js-editor"
                                      rows="6"><?php echo e(old('requirements.en', $job?->getTranslation('requirements','en'))); ?></textarea>
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="card-footer bg-white d-flex justify-content-end gap-2 p-3">
                <a href="<?php echo e(route('dashboard.jobs.index')); ?>"
                   class="btn btn-light px-4">
                    رجوع
                </a>

                <button type="submit"
                        class="btn btn-primary px-4">
                    <?php echo e(isset($job) ? 'تحديث الوظيفة' : 'حفظ الوظيفة'); ?>

                </button>
            </div>

        </div>
    </form>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .job-form-page .form-section {
    background: #f8fafc;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 24px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #0f172a;
}

.section-header i {
    font-size: 16px;
}

.form-hint {
    font-size: 13px;
    color: #64748b;
    margin-top: 6px;
}

.form-hint a {
    color: #2563eb;
    text-decoration: none;
}

.form-hint a:hover {
    text-decoration: underline;
}

.form-control-lg,
.form-select-lg {
    border-radius: 10px;
}
.custom-select-wrapper {
    position: relative;
}

.custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: linear-gradient(180deg, #ffffff, #f8fafc);
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 14px 48px 14px 16px;
    font-size: 15px;
    font-weight: 500;
    transition: all .25s ease;
    height: 50px;
}

.custom-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    background: #fff;
}

.select-icon {
    position: absolute;
    top: 50%;
    right: 18px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #64748b;
    font-size: 14px;
}


    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/jobs/create.blade.php ENDPATH**/ ?>