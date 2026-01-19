
<?php $__env->startSection('title','القطاعات'); ?>

<?php $__env->startSection('style'); ?>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #dc3545;
        transition: .3s;
        border-radius: 30px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #28a745;
    }

    input:checked + .slider:before {
        transform: translateX(22px);
    }

    input:disabled + .slider {
        opacity: .6;
        cursor: not-allowed;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
<div class="content-wrapper">

<div class="d-flex justify-content-between mb-2">
    <h3>القطاعات</h3>
    <a href="<?php echo e(route('sectors.create')); ?>" class="btn btn-primary">
        إضافة قطاع
    </a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<table class="table table-bordered align-middle">
<thead>
<tr>
    <th width="60">الترتيب</th>
    <th width="80">العرض</th>
    <th>العنوان</th>
    <th width="120">الحالة</th>
    <th width="160">إجراءات</th>
</tr>
</thead>

<tbody id="sortable">
<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr data-id="<?php echo e($sector->id); ?>">

    
    <td style="cursor: move">☰</td>

    
    <td class="text-center">
        <?php if($sector->image): ?>
            <img src="<?php echo e(asset('storage/'.$sector->image)); ?>" width="120">
        <?php elseif($sector->icon): ?>
            <i class="<?php echo e($sector->icon); ?> fa-2x"></i>
        <?php endif; ?>
    </td>

    
    <td><?php echo e(optional($sector)->getTranslation('title','ar')); ?></td>

    
    <td class="text-center">
        <label class="switch">
            <input type="checkbox"
                   class="sector-status"
                   data-id="<?php echo e($sector->id); ?>"
                   <?php echo e($sector->is_active ? 'checked' : ''); ?>>
            <span class="slider"></span>
        </label>
    </td>

    
    <td>
        <a href="<?php echo e(route('sectors.edit',$sector)); ?>"
           class="btn btn-sm btn-info">تعديل</a>

        <form method="POST"
              action="<?php echo e(route('sectors.destroy',$sector)); ?>"
              class="d-inline">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="btn btn-sm btn-danger"
                    onclick="return confirm('حذف؟')">
                حذف
            </button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
/* ===== الترتيب ===== */
Sortable.create(document.getElementById('sortable'), {
    animation: 150,
    onEnd() {
        let order = [];
        document.querySelectorAll('#sortable tr').forEach(row => {
            order.push(row.dataset.id);
        });

        fetch('<?php echo e(route('sectors.sort')); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order })
        })
        .then(res => res.json())
        .then(data => {
            toast(data.message, 'success');
        })
        .catch(() => {
            toast('حدث خطأ أثناء حفظ الترتيب', 'error');
        });
    }
});

/* ===== التفعيل / التعطيل ===== */
document.querySelectorAll('.sector-status').forEach(input => {
    input.addEventListener('change', function () {

        this.disabled = true;

        fetch(`/dashboard/sectors/${this.dataset.id}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            }
        })
        .then(res => res.json())
        .then(data => {
            toast(data.message, 'success');
            this.disabled = false;
        })
        .catch(() => {
            toast('فشل تحديث الحالة', 'error');
            this.checked = !this.checked;
            this.disabled = false;
        });
    });
});

/* ===== Toast ===== */
function toast(message, type = 'success') {
    Toastify({
        text: message,
        duration: 2500,
        gravity: "top",
        position: "right",
        backgroundColor: type === 'success'
            ? "#28a745"
            : "#dc3545"
    }).showToast();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/sectors/index.blade.php ENDPATH**/ ?>