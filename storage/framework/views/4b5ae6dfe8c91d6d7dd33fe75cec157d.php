

<?php $__env->startSection('title','إضافة دور'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <h4 class="fw-bold mb-4">إضافة دور جديد</h4>
    <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <form method="POST" action="<?php echo e(route('dashboard.roles.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">اسم الدور</label>
                    <input type="text" name="name"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold mb-2">الصلاحيات</label>
                    <div class="row">
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3">
                                <label class="form-check">
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="<?php echo e($permission->name); ?>"
                                           class="form-check-input">
                                    <?php echo e($permission->name); ?>

                                </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <button class="btn btn-success">
                    حفظ الدور
                </button>

            </div>
        </div>
    </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/roles/create.blade.php ENDPATH**/ ?>