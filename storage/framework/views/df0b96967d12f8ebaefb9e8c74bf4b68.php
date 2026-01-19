

<?php $__env->startSection('title', 'إدارة سكاشن الصفحة الرئيسية'); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .section-row {
            cursor: move;
        }

        .section-key {
            font-weight: 600;
        }

        .section-meta {
            font-size: 13px;
            color: #6c757d;
        }

        .js-toggle {
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">

        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">سكاشن الصفحة الرئيسية</h3>
                <small class="text-muted">إضافة – ترتيب – تفعيل – تعديل السكاشن</small>
            </div>
        </div>

        
        <?php if($available->count()): ?>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('dashboard.home-sections.store')); ?>" class="d-flex gap-3">
                        <?php echo csrf_field(); ?>
                        <select name="key" class="form-select w-auto" required>
                            <option value="">اختر سكشن</option>
                            <?php $__currentLoopData = $available; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>">
                                    <?php echo e($meta['icon'] ?? ''); ?> <?php echo e($meta['label']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة سكشن
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
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

                                <td><i class="fas fa-grip-vertical text-muted"></i></td>

                                <td>
                                    <div class="section-key">
                                        <?php echo e($meta['icon'] ?? ''); ?> <?php echo e($meta['label'] ?? $section->key); ?>

                                    </div>
                                    <div class="section-meta">
                                        <?php echo e($meta['description'] ?? ''); ?>

                                    </div>
                                </td>

                                <td>
                                    <input type="checkbox" class="js-toggle" data-id="<?php echo e($section->id); ?>"
                                        <?php echo e($section->is_active ? 'checked' : ''); ?>>
                                </td>

                                <td>
                                    <?php if(in_array($section->key, ['text', 'hero_extra'])): ?>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-primary js-edit-section"
                                                data-id="<?php echo e($section->id); ?>" data-key="<?php echo e($section->key); ?>">
                                                <i class="fas fa-edit"></i> تعديل
                                            </button>
                                            
                                            <form action="<?php echo e(route('dashboard.sections.destroy', $section->id)); ?>" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
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

    
    <div class="modal fade" id="textModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل Text Section</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="textForm">
                    <div class="modal-body">

                        <h6>🇵🇸 عربي</h6>
                        <textarea class="form-control mb-3 js-editor" id="content_ar"></textarea>
                        <input class="form-control mb-2" id="button_text_ar" placeholder="نص الزر">
                        <input class="form-control mb-3" id="button_link_ar" placeholder="رابط الزر">

                        <hr>

                        <h6>🇬🇧 English</h6>
                        <textarea class="form-control mb-3 js-editor" id="content_en"></textarea>
                        <input class="form-control mb-2" id="button_text_en" placeholder="Button Text">
                        <input class="form-control" id="button_link_en" placeholder="Button Link">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        <button class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="heroExtraModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل Hero إضافي</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="heroForm">
                    <div class="modal-body">

                        <h6>🇵🇸 عربي</h6>
                        <input class="form-control mb-2" id="hero_title_ar" placeholder="العنوان">
                        <textarea class="form-control mb-2 js-editor" id="hero_subtitle_ar" placeholder="الوصف"></textarea>
                        <input class="form-control mb-2" id="hero_button_text_ar" placeholder="نص الزر">
                        <input class="form-control mb-3" id="hero_button_link_ar" placeholder="رابط الزر">

                        <hr>

                        <h6>🇬🇧 English</h6>
                        <input class="form-control mb-2" id="hero_title_en" placeholder="Title">
                        <textarea class="form-control mb-2 js-editor" id="hero_subtitle_en" placeholder="Description"></textarea>
                        <input class="form-control mb-2" id="hero_button_text_en" placeholder="Button Text">
                        <input class="form-control" id="hero_button_link_en" placeholder="Button Link">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
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
document.addEventListener('DOMContentLoaded', function () {

/* ======================================================
   DRAG & DROP
====================================================== */
new Sortable(document.getElementById('sortable-sections'), {
    animation: 150,
    handle: '.fa-grip-vertical',
    onEnd() {
        let order = [];
        document.querySelectorAll('#sortable-sections tr').forEach(row => {
            order.push(row.dataset.id);
        });

        fetch("<?php echo e(route('dashboard.home-sections.reorder')); ?>", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order })
        })
        .then(res => res.json())
        .then(() => showToast('تم حفظ الترتيب', 'success'));
    }
});

/* ======================================================
   TOGGLE ACTIVE
====================================================== */
document.querySelectorAll('.js-toggle').forEach(el => {
    el.addEventListener('change', function () {
        fetch(`/dashboard/home-sections/${this.dataset.id}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            }
        })
        .then(() => showToast('تم تحديث الحالة', 'success'));
    });
});

});
</script>

<script>
/* ======================================================
   MODALS
====================================================== */
const textModal = new bootstrap.Modal(document.getElementById('textModal'));
const heroModal = new bootstrap.Modal(document.getElementById('heroExtraModal'));

let activeSectionId = null;
let activeSectionKey = null;

/* ======================================================
   OPEN EDIT MODAL
====================================================== */
document.querySelectorAll('.js-edit-section').forEach(btn => {
    btn.addEventListener('click', function () {

        activeSectionId  = this.dataset.id;
        activeSectionKey = this.dataset.key;

        fetch(`/dashboard/home-sections/${activeSectionId}/content`)
            .then(res => res.json())
            .then(data => {

                /* ---------- TEXT SECTION ---------- */
                if (activeSectionKey === 'text') {

                    setTimeout(() => {
                        tinymce.get('content_ar')?.setContent(data.content?.ar ?? '');
                        tinymce.get('content_en')?.setContent(data.content?.en ?? '');
                    }, 100);

                    button_text_ar.value = data.button_text?.ar ?? '';
                    button_text_en.value = data.button_text?.en ?? '';
                    button_link_ar.value = data.button_link?.ar ?? '';
                    button_link_en.value = data.button_link?.en ?? '';

                    textModal.show();
                }

                /* ---------- HERO EXTRA ---------- */
                if (activeSectionKey === 'hero_extra') {

                    hero_title_ar.value = data.title?.ar ?? '';
                    hero_title_en.value = data.title?.en ?? '';

                    setTimeout(() => {
                        tinymce.get('hero_subtitle_ar')?.setContent(data.subtitle?.ar ?? '');
                        tinymce.get('hero_subtitle_en')?.setContent(data.subtitle?.en ?? '');
                    }, 100);

                    hero_button_text_ar.value = data.button_text?.ar ?? '';
                    hero_button_text_en.value = data.button_text?.en ?? '';
                    hero_button_link_ar.value = data.button_link?.ar ?? '';
                    hero_button_link_en.value = data.button_link?.en ?? '';

                    heroModal.show();
                }

            });
    });
});
</script>

<script>
/* ======================================================
   SAVE TEXT SECTION
====================================================== */
document.getElementById('textForm').addEventListener('submit', function (e) {
    e.preventDefault();

    fetch(`/dashboard/home-sections/${activeSectionId}/content`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            content_ar: tinymce.get('content_ar')?.getContent() ?? '',
            content_en: tinymce.get('content_en')?.getContent() ?? '',
            button_text_ar: button_text_ar.value,
            button_text_en: button_text_en.value,
            button_link_ar: button_link_ar.value,
            button_link_en: button_link_en.value,
        })
    })
    .then(res => res.json())
    .then(() => {
        textModal.hide();
        showToast('تم حفظ Text Section بنجاح', 'success');
    });
});
</script>

<script>
/* ======================================================
   SAVE HERO EXTRA SECTION
====================================================== */
document.getElementById('heroExtraForm').addEventListener('submit', function (e) {
    e.preventDefault();

    fetch(`/dashboard/home-sections/${activeSectionId}/content`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title_ar: hero_title_ar.value,
            title_en: hero_title_en.value,
            subtitle_ar: tinymce.get('hero_subtitle_ar')?.getContent() ?? '',
            subtitle_en: tinymce.get('hero_subtitle_en')?.getContent() ?? '',
            button_text_ar: hero_button_text_ar.value,
            button_text_en: hero_button_text_en.value,
            button_link_ar: hero_button_link_ar.value,
            button_link_en: hero_button_link_en.value,
        })
    })
    .then(res => res.json())
    .then(() => {
        heroModal.hide();
        showToast('تم حفظ Hero الإضافي بنجاح', 'success');
    });
});
</script>
<script>
    /* =========================
       SAVE HERO EXTRA
    ========================= */
    document.getElementById('heroForm').addEventListener('submit', function (e) {
        e.preventDefault();
    
        if (!activeSectionId) {
            showToast('لم يتم تحديد السكشن', 'error');
            return;
        }
    
        fetch(`/dashboard/home-sections/${activeSectionId}/content`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                title_ar: hero_title_ar.value,
                title_en: hero_title_en.value,
    
                subtitle_ar: tinymce.get('hero_subtitle_ar')?.getContent() ?? '',
                subtitle_en: tinymce.get('hero_subtitle_en')?.getContent() ?? '',
    
                button_text_ar: hero_button_text_ar.value,
                button_text_en: hero_button_text_en.value,
    
                button_link_ar: hero_button_link_ar.value,
                button_link_en: hero_button_link_en.value,
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                heroModal.hide();
                showToast('تم حفظ Hero الإضافي بنجاح', 'success');
            } else {
                showToast('فشل الحفظ', 'error');
            }
        })
        .catch(() => showToast('خطأ غير متوقع', 'error'));
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/home-sections/index.blade.php ENDPATH**/ ?>