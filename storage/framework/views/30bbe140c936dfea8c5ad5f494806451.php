
<?php $__env->startSection('title','طلبات التواصل'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">طلبات التواصل</h1>
            <p class="text-muted mb-0">إدارة رسائل التواصل الواردة من الموقع</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>نوع الاستفسار</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th class="text-center">الإجراء</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="<?php echo e(!$msg->is_read ? 'table-warning' : ''); ?>">
                            <td class="fw-bold">#<?php echo e($msg->id); ?></td>

                            <td>
                                <div class="fw-semibold"><?php echo e($msg->name); ?></div>
                                <?php if(!$msg->is_read): ?>
                                    <span class="badge bg-danger mt-1">جديد</span>
                                <?php endif; ?>
                            </td>

                            <td><?php echo e($msg->email); ?></td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    <?php echo e($msg->inquiry_type ?? '—'); ?>

                                </span>
                            </td>

                            <td>
                                <?php if($msg->is_read): ?>
                                    <span class="badge bg-success">تمت المشاهدة</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">غير مقروء</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-muted">
                                <?php echo e($msg->created_at->format('Y-m-d')); ?>

                            </td>

                            <td class="text-center">
                                <a href="<?php echo e(route('dashboard.contacts.show',$msg)); ?>"
                                   class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                            
                                <form action="<?php echo e(route('dashboard.contacts.destroy',$msg)); ?>"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                لا يوجد رسائل حتى الآن
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($messages->hasPages()): ?>
            <div class="card-footer bg-white">
                <?php echo e($messages->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/contact/index.blade.php ENDPATH**/ ?>