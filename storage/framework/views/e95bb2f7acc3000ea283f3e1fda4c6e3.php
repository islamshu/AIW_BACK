

<?php $__env->startSection('title','إدارة الأدوار'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">إدارة الأدوار</h4>

        <a href="<?php echo e(route('dashboard.roles.create')); ?>" class="btn btn-primary">
            <i class="la la-plus"></i> إضافة دور
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
        <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم الدور</th>
                        <th>الصلاحيات</th>
                        <th width="120">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td class="fw-bold"><?php echo e($role->name); ?></td>
                            <td>
                                <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-info mb-1">
                                        <?php echo e($permission->name); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('dashboard.roles.edit',$role)); ?>"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="la la-edit"></i>
                                </a>
                                <form action="<?php echo e(route('dashboard.roles.destroy', $role)); ?>"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                title="حذف">
                                <i class="la la-trash"></i>
                            </button>
                        </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <?php echo e($roles->links()); ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/roles/index.blade.php ENDPATH**/ ?>