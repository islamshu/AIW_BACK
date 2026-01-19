

<?php $__env->startSection('title','تعديل دور'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <h4 class="fw-bold mb-4">تعديل الدور</h4>
    <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <form method="POST"
        action="<?php echo e(route('dashboard.roles.update',$role)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="mb-3">

                    <label>اسم الدور</label>
                    <input name="name"
                        value="<?php echo e($role->name); ?>"
                        class="form-control" <?php if($role->name == 'الادارة'): ?> disabled title="لا يمكن تعديل هذه الصلاحية"  <?php endif; ?> required>
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
                                    class="form-check-input"
                                    <?php echo e(in_array($permission->name, $rolePermissions) ? 'checked' : ''); ?>>
                                <?php echo e($permission->name); ?>

                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <button class="btn btn-success">
                    تحديث الدور
                </button>

            </div>
        </div>
    </form>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/roles/edit.blade.php ENDPATH**/ ?>