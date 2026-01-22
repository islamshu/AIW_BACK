

<?php $__env->startSection('title','تعديل مستخدم'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="mb-4">
        <h3 class="fw-bold">تعديل المستخدم</h3>
        <p class="text-muted mb-0">تعديل بيانات المستخدم وتحديد الدور الخاص به</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <form action="<?php echo e(route('dashboard.users.update', $user)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">

                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="<?php echo e(old('name', $user->name)); ?>"
                               required>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?php echo e(old('email', $user->email)); ?>"
                               required>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الدور</label>
                        <select name="role" class="form-select" required>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role); ?>"
                                    <?php echo e($user->hasRole($role) ? 'selected' : ''); ?>>
                                    <?php echo e($role); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                </div>

                <hr class="my-4">

                
                <h6 class="mb-3 text-muted">تغيير كلمة المرور (اختياري)</h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="اتركها فارغة إذا لا تريد التغيير">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="تأكيد كلمة المرور">
                    </div>

                </div>

                
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="la la-save me-1"></i> حفظ التعديلات
                    </button>

                    <a href="<?php echo e(route('dashboard.users.index')); ?>"
                       class="btn btn-light px-4">
                        رجوع
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/users/edit.blade.php ENDPATH**/ ?>