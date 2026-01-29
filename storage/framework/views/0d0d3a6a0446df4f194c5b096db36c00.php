

<?php $__env->startSection('title', 'طلبات التقديم'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">
                طلبات التقديم – <?php echo e($job->getTranslation('title','ar')); ?>

            </h1>
            <p class="text-muted mb-0">
                عدد الطلبات: <?php echo e($applications->total()); ?>

            </p>
        </div>

        <a href="<?php echo e(route('dashboard.jobs.index')); ?>"
           class="btn btn-light">
            <i class="fas fa-arrow-right me-1"></i>
            رجوع للوظائف
        </a>
    </div>

    
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>السيرة الذاتية</th>
                        <th>تاريخ التقديم</th>
                        <th>الاجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td class="fw-semibold"><?php echo e($app->name); ?></td>
                            <td><?php echo e($app->phone); ?></td>
                            <td>
                                <a href="<?php echo e(asset('storage/'.$app->cv_path)); ?>"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file-pdf"></i>
                                    عرض CV
                                </a>
                            </td>
                            <td class="text-muted">
                                <?php echo e($app->created_at->format('Y-m-d H:i')); ?>

                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?php echo e(route('dashboard.jobs.applications.show', [$app->job->id,$app->id])); ?>"
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5"
                                class="text-center text-muted py-4">
                                لا يوجد طلبات تقديم لهذه الوظيفة
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($applications->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($applications->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/jobs/applications/index.blade.php ENDPATH**/ ?>