
<?php $__env->startSection('title','تفاصيل رسالة التواصل'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">تفاصيل الرسالة</h1>
            <p class="text-muted mb-0">معلومات الرسالة المرسلة من العميل</p>
        </div>

        <a href="<?php echo e(route('dashboard.contacts.index')); ?>"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-right me-1"></i> رجوع
        </a>
    </div>

    <div class="row">
        
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h6 class="mb-3 fw-bold">معلومات المرسل</h6>

                    <div class="mb-2">
                        <small class="text-muted">الاسم</small>
                        <div class="fw-semibold"><?php echo e($contactMessage->name); ?></div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">البريد الإلكتروني</small>
                        <div><?php echo e($contactMessage->email); ?></div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">الشركة</small>
                        <div><?php echo e($contactMessage->company ?? '—'); ?></div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">نوع الاستفسار</small>
                        <div>
                            <span class="badge bg-info text-dark">
                                <?php echo e($contactMessage->inquiry_type ?? '—'); ?>

                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">تاريخ الإرسال</small>
                        <div><?php echo e($contactMessage->created_at->format('Y-m-d H:i')); ?></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">نص الرسالة</h6>

                    <div class="p-3 rounded bg-light text-dark" style="white-space: pre-line;">
                        <?php echo e($contactMessage->message); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/contact/show.blade.php ENDPATH**/ ?>