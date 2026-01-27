

<?php $__env->startSection('title', 'الوظائف'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 fw-bold">الوظائف</h1>
            <p class="text-muted mb-0">إدارة الوظائف المنشورة في الموقع</p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?php echo e(route('dashboard.job-groups.index')); ?>"
               class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="fas fa-layer-group"></i>
                العناوين الرئيسية
            </a>

            <a href="<?php echo e(route('dashboard.jobs.create')); ?>"
               class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                إضافة وظيفة
            </a>
        </div>
    </div>

    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60" class="ps-4">#</th>
                            <th>عنوان الوظيفة</th>
                            <th width="220">العنوان الرئيسي</th>
                            <th width="220">فترة النشر</th>
                            <th width="140" class="text-center">طلبات التقديم</th>
                            <th width="120" class="text-center">الحالة</th>
                            <th width="120" class="text-center pe-4">إجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>

                            
                            <td class="fw-semibold text-muted ps-4">
                                #<?php echo e($key + 1); ?>

                            </td>

                            
                            <td>
                                <div class="fw-bold text-dark">
                                    <?php echo e($job->getTranslation('title','ar')); ?>

                                </div>
                                <div class="text-muted small mt-1">
                                    <?php echo e($job->getTranslation('title','en')); ?>

                                </div>
                            </td>

                            
                            <td>
                                <?php if($job->group): ?>
                                    <div class="fw-bold text-dark">
                                        <?php echo e($job->group->getTranslation('title','ar')); ?>

                                    </div>
                                    <div class="text-muted small mt-1">
                                        <?php echo e($job->group->getTranslation('title','en')); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">غير محدد</span>
                                <?php endif; ?>
                            </td>

                            
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="d-flex align-items-center gap-1">
                                        <i class="fas fa-play text-muted" style="font-size: 0.7rem"></i>
                                        <span class="small"><?php echo e($job->publish_from->format('Y-m-d')); ?></span>
                                    </span>
                                    <span class="d-flex align-items-center gap-1 mt-1">
                                        <i class="fas fa-stop text-muted" style="font-size: 0.7rem"></i>
                                        <span class="small text-muted">
                                            <?php echo e($job->publish_to?->format('Y-m-d') ?? 'لا نهائي'); ?>

                                        </span>
                                    </span>
                                </div>
                            </td>

                            
                            <td class="text-center">
                                <a href="<?php echo e(route('dashboard.jobs.applications.index', $job)); ?>"
                                   class="badge bg-info text-decoration-none">
                                    <?php echo e($job->applications_count); ?> طلب
                                </a>
                            </td>

                            
                            <td class="text-center">
                                <input type="checkbox"
                                       data-id="<?php echo e($job->id); ?>"
                                       class="js-switch"
                                       <?php echo e($job->is_active ? 'checked' : ''); ?>>
                            </td>

                            
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('dashboard.jobs.edit', $job)); ?>"
                                       class="btn btn-sm btn-outline-primary btn-icon"
                                       title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form method="POST"
                                          action="<?php echo e(route('dashboard.jobs.destroy', $job)); ?>"
                                          class="d-inline js-delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger btn-icon js-delete-btn"
                                                title="حذف"
                                                data-title="<?php echo e($job->getTranslation('title','ar')); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="py-4">
                                    <i class="fas fa-briefcase fa-2x mb-3 text-light"></i>
                                    <p class="mb-0">لا يوجد وظائف حالياً</p>
                                    <a href="<?php echo e(route('dashboard.jobs.create')); ?>" class="btn btn-sm btn-primary mt-3">
                                        إضافة وظيفة جديدة
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($jobs->hasPages()): ?>
            <div class="card-footer border-top-0">
                <div class="d-flex justify-content-center">
                    <?php echo e($jobs->links()); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .btn-icon{width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;border-radius:6px;transition:all .2s ease}
    .btn-icon:hover{transform:translateY(-2px);box-shadow:0 4px 8px rgba(0,0,0,.1)}
    .table-hover tbody tr{transition:all .2s ease}
    .table-hover tbody tr:hover{background:#f8f9fa;transform:translateX(2px)}
    .table td,.table th{padding:1rem;vertical-align:middle}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Toggle Job Status (AJAX) - طريقة واحدة فقط
    $(document).ready(function () {
        $('.js-switch').change(function () {
            const el = $(this);
            const jobId = el.data('id');
            const status = el.prop('checked') ? 1 : 0;
            const oldState = !el.prop('checked');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: `/dashboard/jobs/${jobId}/toggle`,
                data: { status: status, id: jobId },
                success: function (data) {
                    if (data.success) {
                        if (typeof showToast === 'function') showToast(data.message, 'success');
                    } else {
                        el.prop('checked', oldState);
                        if (typeof showToast === 'function') showToast('تعذر تغيير الحالة', 'error');
                    }
                },
                error: function () {
                    el.prop('checked', oldState);
                    if (typeof showToast === 'function') showToast('حدث خطأ في الاتصال بالخادم', 'error');
                }
            });
        });
    });

    // Delete confirm
    document.querySelectorAll('.js-delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const title = this.dataset.title;
            const form = this.closest('.js-delete-form');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                html: `سيتم حذف الوظيفة:<br><strong>${title}</strong><br><small class="text-danger">لا يمكن التراجع عن هذا الإجراء</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/jobs/index.blade.php ENDPATH**/ ?>