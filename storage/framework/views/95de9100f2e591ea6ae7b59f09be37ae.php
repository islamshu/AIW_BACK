

<?php $__env->startSection('title', 'تفاصيل طلب التقديم'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">تفاصيل طلب التقديم</h1>
            <p class="text-muted mb-0">
                <?php echo e($job->getTranslation('title', 'ar')); ?>

            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?php echo e(route('dashboard.jobs.applications.index', $job->id)); ?>" class="btn btn-light">
                <i class="fas fa-arrow-right me-1"></i>
                رجوع
            </a>
            <a href="<?php echo e(route('dashboard.jobs.index')); ?>" class="btn btn-outline-secondary">
                <i class="fas fa-briefcase me-1"></i>
                الوظائف
            </a>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-user-circle me-2"></i>
                        معلومات المتقدم
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">الاسم الكامل</label>
                            <p class="fw-bold h5 mb-0"><?php echo e($application->name); ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">رقم الهاتف</label>
                            <p class="fw-bold h5 mb-0"><?php echo e($application->phone); ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">تاريخ التقديم</label>
                            <p class="fw-bold h6 mb-0">
                                <?php echo e($application->created_at->format('Y-m-d')); ?>

                                <span class="text-muted ms-2">
                                    <?php echo e($application->created_at->format('H:i')); ?>

                                </span>
                            </p>
                        </div>
                    </div>

                    
                    <?php if(!empty($application->summary)): ?>
                        <div class="mt-4 pt-3 border-top">
                            <label class="form-label text-muted small mb-2">
                                <i class="fas fa-file-alt me-1"></i>
                                ملخص المتقدم
                            </label>
                            <div class="bg-light p-4 rounded-3">
                                <p class="mb-0" style="line-height: 1.9; white-space: pre-line;">
                                    <?php echo e($application->summary); ?>

                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">

            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-briefcase me-2"></i>
                        الوظيفة
                    </h5>
                </div>
                <div class="card-body">
                    <p class="fw-bold mb-1">
                        <?php echo e($job->getTranslation('title', 'ar')); ?>

                    </p>
                    <p class="text-muted small mb-0">
                        رقم الوظيفة: #<?php echo e($job->id); ?>

                    </p>
                </div>
            </div>

            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-file-pdf me-2"></i>
                        السيرة الذاتية
                    </h5>
                </div>
                <div class="card-body">
                    <?php if($application->cv_path): ?>
                        <div class="text-center mb-3">
                            <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                            <p class="text-muted small mb-0">CV</p>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="<?php echo e(asset('storage/'.$application->cv_path)); ?>"
                               target="_blank"
                               class="btn btn-primary">
                                <i class="fas fa-eye me-1"></i>
                                عرض السيرة الذاتية
                            </a>

                            <a href="<?php echo e(asset('storage/'.$application->cv_path)); ?>"
                               download="CV_<?php echo e($application->name); ?>.pdf"
                               class="btn btn-outline-primary">
                                <i class="fas fa-download me-1"></i>
                                تحميل
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center mb-0">
                            لا يوجد ملف مرفق
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-cog me-2"></i>
                        الإجراءات
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="tel:<?php echo e($application->phone); ?>" class="btn btn-outline-success">
                            <i class="fas fa-phone me-1"></i>
                            اتصال
                        </a>

                        <button type="button"
                        class="btn btn-outline-danger"
                        data-toggle="modal"
                        data-target="#deleteModal">
                    <i class="fas fa-trash me-1"></i>
                    حذف الطلب
                </button>
                
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
              action="<?php echo e(route('dashboard.jobs.applications.destroy', [$job->id, $application->id])); ?>"
              class="modal-content">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <div class="modal-header">
                <h5 class="modal-title">حذف طلب التقديم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                هل أنت متأكد من حذف طلب
                <strong><?php echo e($application->name); ?></strong>؟
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    إلغاء
                </button>
                <button type="submit" class="btn btn-danger">
                    حذف
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .card { border-radius: 14px; }
    .btn { border-radius: 10px; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/jobs/applications/show.blade.php ENDPATH**/ ?>