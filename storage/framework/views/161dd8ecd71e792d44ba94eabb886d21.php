<?php $__env->startSection('title','لوحة التحكم'); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
<div class="content-wrapper">

    
    <div class="content-header mb-4">
    <h3 class="fw-bold mb-1">لوحة التحكم</h3>
    <p class="text-muted mb-0">نظرة عامة على النظام</p>
</div>


<div class="row g-3 mb-4">

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التحكم بالاعدادات الاساسية للنظام')): ?>
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-eye text-primary la-2x mb-2"></i>
                <h4 class="fw-bold mb-0"><?php echo e($visits ?? 0); ?></h4>
                <small class="text-muted">عدد الزيارات</small>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التحكم باعدادات الصفحة الرئيسية')): ?>
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-cubes text-success la-2x mb-2"></i>
                <h4 class="fw-bold mb-0"><?php echo e($servicesCount); ?></h4>
                <small class="text-muted">إجمالي الخدمات</small>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التحكم باعدادات الصفحة الرئيسية')): ?>
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-th-large text-info la-2x mb-2"></i>
                <h4 class="fw-bold mb-0"><?php echo e($sectorsCount); ?></h4>
                <small class="text-muted">إجمالي القطاعات</small>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['التحكم باعدادات الصفحة الرئيسية','التحكم بالاعدادات الاساسية للنظام'])): ?>
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-check-circle text-warning la-2x mb-2"></i>
                <h4 class="fw-bold mb-0"><?php echo e($activeServices + $activeSectors); ?></h4>
                <small class="text-muted">العناصر المفعلة</small>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>


    
    <div class="row g-3">

        
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">
                    <i class="la la-info-circle me-1"></i>
                    معلومات النظام
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        📅 آخر تحديث:
                        <strong><?php echo e(now()->format('Y-m-d H:i')); ?></strong>
                    </p>

                    <p class="mb-0">
                        ⚙️ حالة الموقع:
                        <span class="badge bg-success">يعمل</span>
                    </p>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">
                    <i class="la la-bolt me-1"></i>
                    اختصارات سريعة
                </div>

                <div class="card-body d-flex flex-wrap gap-2">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التحكم باعدادات الصفحة الرئيسية')): ?>
                    <a href="<?php echo e(route('home-services.index')); ?>" class="btn btn-outline-primary btn-sm"  style="height: 30px;">
                        الخدمات
                    </a>

                    <a href="<?php echo e(route('sectors.index')); ?>" class="btn btn-outline-info btn-sm"  style="height: 30px;">
                        القطاعات
                    </a>

                    <a href="<?php echo e(route('home-hero.edit')); ?>" class="btn btn-outline-secondary btn-sm"  style="height: 30px;">
                        الهيرو
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التحكم بالاعدادات الاساسية للنظام')): ?>
                    <a href="<?php echo e(route('setting')); ?>" class="btn btn-outline-dark btn-sm"  style="height: 30px;">
                        الإعدادات
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ادارة الصفحات')): ?>
                    <a href="<?php echo e(route('dashboard.pages.index')); ?>" class="btn btn-outline-success btn-sm"  style="height: 30px;">
                        الصفحات
                    </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ادارة الوظائف')): ?>
                    <a href="<?php echo e(route('dashboard.jobs.index')); ?>" class="btn btn-outline-warning btn-sm" style="height: 30px;">
                        الوظائف
                    </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/index.blade.php ENDPATH**/ ?>