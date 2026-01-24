

<?php $__env->startSection('title', 'إدارة سكاشن الصفحة الرئيسية'); ?>

<?php $__env->startSection('style'); ?>
<style>
    .section-row { cursor: move; }
    .section-key { font-weight: 600; }
    .section-meta { font-size: 13px; color: #6c757d; }
    .js-toggle { cursor: pointer; }

    .modal-header {
        background: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .modal-title {
        font-weight: 700;
    }

    .form-group label {
        font-weight: 600;
        font-size: 14px;
    }

    .admin-box {
        background: #f1f3f5;
        border: 1px dashed #ced4da;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .admin-box small {
        color: #6c757d;
    }
    /* ===== SWITCH TOGGLE ===== */
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
    background-color: #ccc;
    transition: .3s;
    border-radius: 34px;
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

.switch input:checked + .slider {
    background-color: #28a745; /* أخضر */
}

.switch input:checked + .slider:before {
    transform: translateX(22px);
}

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">سكاشن الصفحة الرئيسية</h3>
            <small class="text-muted">إدارة السكاشن (إضافة – ترتيب – تفعيل – تعديل)</small>
        </div>

        <button onclick="location.reload()" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-sync-alt"></i> إعادة تحميل
        </button>
    </div>

    
    <?php if($available->count()): ?>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="POST"
                      action="<?php echo e(route('dashboard.home-sections.store')); ?>"
                      class="form-inline">
                    <?php echo csrf_field(); ?>

                    <select name="key" class="form-control mr-2" required>
                        <option value="">اختر السكشن</option>
                    
                        <?php $__currentLoopData = $available; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>">
                                <?php if($key === 'text'): ?>
                                    إضافة نص مع زر
                                <?php elseif($key === 'hero_extra'): ?>
                                    إضافة عنوان مع نص
                                <?php else: ?>
                                    <?php echo e($meta['label'] ?? $key); ?>

                                <?php endif; ?>
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    

                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> إضافة
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="40"></th>
                        <th>السكشن</th>
                        <th width="120">الحالة</th>
                        <th width="160">التحكم</th>
                    </tr>
                </thead>

                <tbody id="sortable-sections">
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $meta = \App\Support\SectionRegistry::get($section->key); ?>

                    <tr class="section-row" data-id="<?php echo e($section->id); ?>">
                        <td>
                            <i class="fas fa-grip-vertical text-muted"></i>
                        </td>

                        <td>
                            <div class="section-key">
                                <?php echo e($section->admin_title ?? $meta['label'] ?? $section->key); ?>

                            </div>
                            <div class="section-meta">
                                <?php echo e($section->admin_note ?? $meta['description'] ?? ''); ?>

                            </div>
                        </td>

                        <td>
                            <label class="switch">
                                <input type="checkbox"
                                       class="js-switch-toggle"
                                       data-id="<?php echo e($section->id); ?>"
                                       <?php echo e($section->is_active ? 'checked' : ''); ?>>
                                <span class="slider"></span>
                            </label>
                        </td>
                        
                        

                        <td>
                            <?php if(in_array($section->key, ['text','hero_extra'])): ?>
                                <button class="btn btn-sm btn-outline-primary js-edit-section"
                                        data-id="<?php echo e($section->id); ?>"
                                        data-key="<?php echo e($section->key); ?>">
                                    <i class="fas fa-edit"></i> تعديل
                                </button>
                                <button class="btn btn-sm btn-outline-danger js-delete-section"
                                data-id="<?php echo e($section->id); ?>">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="textModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form id="textForm">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة نص مع زر</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    
                    <div class="admin-box">
                        <div class="form-group">
                            <label>عنوان إداري</label>
                            <input class="form-control" id="text_admin_title">
                        </div>

                        <div class="form-group mb-0">
                            <label>ملاحظة إدارية</label>
                            <textarea class="form-control" id="text_admin_note" rows="2"></textarea>
                            <small>للاستخدام الإداري فقط</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>النص العربي</label>
                        <textarea id="content_ar" class="form-control js-editor"></textarea>
                    </div>

                    <div class="form-group">
                        <label>النص الإنجليزي</label>
                        <textarea id="content_en" class="form-control js-editor"></textarea>
                    </div>

                    <div class="form-group">
                        <label>نص الزر (عربي)</label>
                        <input id="button_text_ar" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>رابط الزر</label>
                        <input id="button_link_ar" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                 

                    <button class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button class="btn btn-primary">حفظ</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="heroExtraModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <form id="heroForm">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة عنوان مع نص</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    
                    <div class="admin-box">
                        <div class="form-group">
                            <label>عنوان إداري</label>
                            <input class="form-control" id="hero_admin_title">
                        </div>

                        <div class="form-group mb-0">
                            <label>ملاحظة إدارية</label>
                            <textarea class="form-control" id="hero_admin_note" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>العنوان العربي</label>
                        <input id="hero_title_ar" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>العنوان الإنجليزي</label>
                        <input id="hero_title_en" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>النص العربي</label>
                        <textarea id="hero_subtitle_ar" class="form-control js-editor"></textarea>
                    </div>

                    <div class="form-group">
                        <label>النص الإنجليزي</label>
                        <textarea id="hero_subtitle_en" class="form-control js-editor"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-danger mr-auto"
                            id="deleteHeroSection">
                        <i class="fas fa-trash"></i> حذف السكشن
                    </button>

                    <button class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button class="btn btn-primary">حفظ</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
let activeSectionId = null;
let activeSectionKey = null;

/* ===== SORTABLE ===== */
new Sortable(document.getElementById('sortable-sections'), {
    animation: 150,
    handle: '.fa-grip-vertical',
    onEnd() {
        let order = [];
        document.querySelectorAll('#sortable-sections tr').forEach(r => order.push(r.dataset.id));

        fetch("<?php echo e(route('dashboard.home-sections.reorder')); ?>", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order })
        });
    }
});

/* ===== TOGGLE ===== */
document.querySelectorAll('.js-toggle').forEach(el => {
    el.addEventListener('change', () => {
        fetch(`/dashboard/home-sections/${el.dataset.id}/toggle`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
        });
    });
});

/* ===== OPEN MODALS ===== */
document.querySelectorAll('.js-edit-section').forEach(btn => {
    btn.addEventListener('click', () => {

        activeSectionId = btn.dataset.id;
        activeSectionKey = btn.dataset.key;

        fetch(`/dashboard/home-sections/${activeSectionId}/content`)
            .then(res => res.json())
            .then(data => {

                if (activeSectionKey === 'text') {
                    text_admin_title.value = data.admin_title ?? '';
                    text_admin_note.value  = data.admin_note ?? '';
                    tinymce.get('content_ar')?.setContent(data.content?.ar ?? '');
                    tinymce.get('content_en')?.setContent(data.content?.en ?? '');
                    $('#textModal').modal('show');
                }

                if (activeSectionKey === 'hero_extra') {
                    hero_admin_title.value = data.admin_title ?? '';
                    hero_admin_note.value  = data.admin_note ?? '';
                    hero_title_ar.value    = data.title?.ar ?? '';
                    hero_title_en.value    = data.title?.en ?? '';
                    tinymce.get('hero_subtitle_ar')?.setContent(data.subtitle?.ar ?? '');
                    tinymce.get('hero_subtitle_en')?.setContent(data.subtitle?.en ?? '');
                    $('#heroExtraModal').modal('show');
                }
            });
    });
});

/* ===== SAVE TEXT + RELOAD ===== */
document.getElementById('textForm').addEventListener('submit', e => {
    e.preventDefault();

    fetch(`/dashboard/home-sections/${activeSectionId}/content`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            admin_title: text_admin_title.value,
            admin_note: text_admin_note.value,
            content_ar: tinymce.get('content_ar')?.getContent(),
            content_en: tinymce.get('content_en')?.getContent()
        })
    })
    .then(() => location.reload());
});

/* ===== SAVE HERO + RELOAD ===== */
document.getElementById('heroForm').addEventListener('submit', e => {
    e.preventDefault();

    fetch(`/dashboard/home-sections/${activeSectionId}/content`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            admin_title: hero_admin_title.value,
            admin_note: hero_admin_note.value,
            title_ar: hero_title_ar.value,
            title_en: hero_title_en.value,
            subtitle_ar: tinymce.get('hero_subtitle_ar')?.getContent(),
            subtitle_en: tinymce.get('hero_subtitle_en')?.getContent()
        })
    })
    .then(() => location.reload());
});

/* ===== DELETE ===== */
document.getElementById('deleteTextSection').addEventListener('click', () => {
    if (!confirm('هل أنت متأكد من حذف السكشن؟')) return;

    fetch(`/dashboard/home-sections/${activeSectionId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
    }).then(() => location.reload());
});

document.getElementById('deleteHeroSection').addEventListener('click', () => {
    if (!confirm('هل أنت متأكد من حذف السكشن؟')) return;

    fetch(`/dashboard/home-sections/${activeSectionId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
    }).then(() => location.reload());
});
</script>
<script>
    document.querySelectorAll('.js-delete-section').forEach(btn => {
        btn.addEventListener('click', function () {
    
            const sectionId = this.dataset.id;
    
            if (!confirm('هل أنت متأكد من حذف هذا السكشن؟')) return;
    
            fetch("<?php echo e(route('dashboard.sections.destroy', ':id')); ?>".replace(':id', sectionId), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('فشل حذف السكشن');
                }
            });
        });
    });
    </script>
  <script>
    document.querySelectorAll('.js-switch-toggle').forEach(el => {
        el.addEventListener('change', function () {
    
            const sectionId = this.dataset.id;
            const checkbox = this;
    
            fetch(`/dashboard/home-sections/${sectionId}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    checkbox.checked = !checkbox.checked;
                    alert('فشل تحديث الحالة');
                }
            })
            .catch(() => {
                checkbox.checked = !checkbox.checked;
                alert('خطأ في الاتصال');
            });
        });
    });
    </script>
    
        
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/home-sections/index.blade.php ENDPATH**/ ?>