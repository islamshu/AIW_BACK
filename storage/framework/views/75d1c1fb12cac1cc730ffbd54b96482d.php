
<?php $__env->startSection('title', 'الخدمة'); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">

            <h3 class="mb-3">
                <?php echo e(isset($homeService) ? 'تعديل خدمة' : 'إضافة خدمة'); ?>

            </h3>
            <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <form method="POST" enctype="multipart/form-data"
                action="<?php echo e(isset($homeService) ? route('home-services.update', $homeService) : route('home-services.store')); ?>">
                <?php echo csrf_field(); ?>
                <?php if(isset($homeService)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="row">

                    
                    <div class="col-md-6 mb-2">
                        <label>العنوان (AR)</label>
                        <input type="text" name="title[ar]" class="form-control"
                           
                        value="<?php echo e(old('title.ar', optional($homeService)->getTranslation('title', 'ar'))); ?>">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Title (EN)</label>
                        <input type="text" name="title[en]" class="form-control"
                        value="<?php echo e(old('title.en', optional($homeService)->getTranslation('title', 'en'))); ?>">
                    </div>

                    
                    <div class="col-md-6 mb-2">
                        <label>الوصف (AR)</label>
                        <textarea id="desc_ar"
                        name="description[ar]"
                        class="form-control js-editor"
                        rows="5"><?php echo old('description.ar', optional($homeService)->getTranslation('description', 'ar')); ?></textarea>
                                        </div>

                    <div class="col-md-6 mb-2">
                        <label>Description (EN)</label>
                        <textarea id="desc_en"
                        name="description[en]"
                        class="form-control js-editor"
                        rows="5"><?php echo old('description.en', optional($homeService)->getTranslation('description', 'en')); ?></textarea>
                                        </div>

                    
                    <?php
                        $type = old('type') ?? (isset($homeService) && $homeService->image ? 'image' : 'icon');
                    ?>

                    <div class="col-md-12 mb-3">
                        <label class="form-label d-block mb-2">نوع العرض</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input type-radio" type="radio" name="type" value="icon"
                                id="type_icon" <?php echo e($type === 'icon' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="type_icon">أيقونة</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input type-radio" type="radio" name="type" value="image"
                                id="type_image" <?php echo e($type === 'image' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="type_image">صورة</label>
                        </div>
                    </div>

                    
                    <div class="col-md-6 mb-3 type-field" id="iconField"
                        style="display: <?php echo e($type === 'icon' ? 'block' : 'none'); ?>;">
                        <label>الأيقونة</label>

                        <div class="input-group">
                            <input type="text" name="icon" class="form-control icon-input"
                                placeholder="fa-solid fa-truck" value="<?php echo e(old('icon', $homeService->icon ?? '')); ?>"
                                <?php echo e($type === 'image' ? 'disabled' : ''); ?>>
                                <button type="button"
                                class="btn btn-outline-secondary js-open-icon-picker">
                                اختيار
                            </button>
                        </div>

                        
                        <div class="icon-preview mt-2">
                            <?php if(old('icon', $homeService->icon ?? null)): ?>
                                <i class="<?php echo e(old('icon', $homeService->icon)); ?> fa-2x text-primary"></i>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    
                    <div class="col-md-6 mb-3 type-field" id="imageField"
                        style="display: <?php echo e($type === 'image' ? 'block' : 'none'); ?>;">

                        <label>الصورة</label>

                        
                        <input type="hidden" name="image" id="imageInput"
                            value="<?php echo e(old('image', $homeService->image ?? '')); ?>">

                        <button type="button" class="btn btn-outline-primary w-100" onclick="openMediaLibrary()">
                            📁 اختيار صورة من المكتبة
                        </button>

                        
                        <div class="mt-2">
                            <img id="imagePreview"
                                src="<?php echo e(isset($homeService) && $homeService->image ? asset('storage/' . $homeService->image) : ''); ?>"
                                class="img-thumbnail"
                                style="max-height:120px; <?php echo e(isset($homeService) && $homeService->image ? '' : 'display:none'); ?>">
                        </div>

                    </div>

                </div>

                <button class="btn btn-primary mt-3">حفظ</button>
            </form>

        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
/* ============================================================
   TOGGLE ICON / IMAGE FIELDS
============================================================ */
document.addEventListener('DOMContentLoaded', function () {

    const iconField  = document.getElementById('iconField');
    const imageField = document.getElementById('imageField');

    const iconInput  = document.querySelector('input[name="icon"]');
    const imageInput = document.getElementById('imageInput');

    const imagePreview = document.getElementById('imagePreview');
    const iconPreview  = document.querySelector('.icon-preview');

    function toggleFields() {
        const selectedType = document.querySelector('input[name="type"]:checked')?.value;

        if (selectedType === 'icon') {
            // Show icon
            iconField.style.display = 'block';
            imageField.style.display = 'none';

            // Enable / Disable
            iconInput.disabled = false;
            imageInput.disabled = true;

            // Clear image
            imageInput.value = '';
            imagePreview.src = '';
            imagePreview.style.display = 'none';

            // Remove remove_image checkbox if exists
            const removeCheckbox = document.querySelector('input[name="remove_image"]');
            if (removeCheckbox) removeCheckbox.checked = false;

        } else if (selectedType === 'image') {
            // Show image
            iconField.style.display = 'none';
            imageField.style.display = 'block';

            // Enable / Disable
            iconInput.disabled = true;
            imageInput.disabled = false;

            // Clear icon
            iconInput.value = '';
            if (iconPreview) iconPreview.innerHTML = '';
        }
    }

    document.querySelectorAll('.type-radio').forEach(radio => {
        radio.addEventListener('change', toggleFields);
    });

    // Init
    toggleFields();
});


/* ============================================================
   OPEN MEDIA LIBRARY
============================================================ */


/* ============================================================
   ICON PICKER (SIMPLE VERSION)
============================================================ */

</script>
<script>
    /* ============================================================
       ICON PICKER – SAME PRINCIPLE AS MEDIA LIBRARY
    ============================================================ */
    
    let activeIconInput   = null;
    let activeIconPreview = null;
    
    // فتح نافذة اختيار الأيقونات
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.js-open-icon-picker');
        if (!btn) return;
    
        // input و preview مباشرة (ليس repeater)
        activeIconInput   = document.querySelector('input[name="icon"]');
        activeIconPreview = document.querySelector('.icon-preview');
    
        window.open(
            '<?php echo e(route("icons.index")); ?>',
            'IconPicker',
            'width=1000,height=650,scrollbars=yes,resizable=yes'
        );
    });
    
    // استقبال الأيقونة من نافذة Icon Picker
    window.addEventListener('message', function (event) {
    
        if (!event.data || event.data.type !== 'icon-selected') return;
        if (!activeIconInput) return;
    
        const iconClass = event.data.icon;
    
        // تعبئة input
        activeIconInput.value = iconClass;
    
        // عرض المعاينة
        if (activeIconPreview) {
            activeIconPreview.innerHTML =
                `<i class="${iconClass} fa-2x text-primary"></i>`;
        }
    
        // تفعيل وضع الأيقونة تلقائيًا
        const iconRadio = document.getElementById('type_icon');
        if (iconRadio) {
            iconRadio.checked = true;
            iconRadio.dispatchEvent(new Event('change'));
        }
    });
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/home-services/form.blade.php ENDPATH**/ ?>