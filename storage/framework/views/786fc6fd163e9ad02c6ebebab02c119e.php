
<div class="col-12">

    
    <label class="fw-bold mb-2 d-flex align-items-center gap-2">
        <i class="fas fa-image text-primary"></i>
        الصورة الرئيسية
    </label>

    
    <div class="section-image-preview text-center">

        
        <input type="hidden"
               name="sections[<?php echo e($section->id); ?>][data][image_id]"
               id="section_image_<?php echo e($section->id); ?>"
               value="<?php echo e($data['image_id'] ?? ''); ?>">

        
        <img
            id="section_preview_<?php echo e($section->id); ?>"
            src="<?php echo e(!empty($data['image_id']) ? get_image_path($data['image_id']) : ''); ?>"
            class="img-fluid rounded-4 mb-3"
            style="max-height:220px; <?php echo e(empty($data['image_id']) ? 'display:none' : ''); ?>"
        >

        
        <div class="d-flex justify-content-center gap-2">

            
            <button type="button"
                    class="btn btn-primary btn-sm px-4 js-open-media"
                    data-section-id="<?php echo e($section->id); ?>">
                <i class="fas fa-folder-open me-1"></i>
                اختيار صورة
            </button>

            
            <button type="button"
                    class="btn btn-outline-danger btn-sm px-4"
                    onclick="removeSectionImage(<?php echo e($section->id); ?>)"
                    id="section_remove_<?php echo e($section->id); ?>"
                    style="<?php echo e(empty($data['image_id']) ? 'display:none' : ''); ?>">
                <i class="fas fa-trash"></i>
                حذف
            </button>

        </div>

        <small class="text-muted d-block mt-3">
            يفضّل صورة بجودة عالية (PNG / JPG)
        </small>

    </div>

</div>


<div class="col-12 mt-4 pt-3 border-top">

    <h6 class="fw-bold mb-3">
        <i class="fas fa-sliders-h me-2"></i>
        إعدادات عرض الصورة
    </h6>

    <div class="row g-3">

        
        <div class="col-md-4">
            <label class="fw-bold">مكان الصورة</label>
            <select class="form-select"
                    name="sections[<?php echo e($section->id); ?>][data][image_position]">
                <option value="top" <?php echo e(($data['image_position'] ?? '') == 'top' ? 'selected' : ''); ?>>أعلى المحتوى</option>
                <option value="bottom" <?php echo e(($data['image_position'] ?? '') == 'bottom' ? 'selected' : ''); ?>>أسفل المحتوى</option>
                <option value="left" <?php echo e(($data['image_position'] ?? '') == 'left' ? 'selected' : ''); ?>>يسار النص</option>
                <option value="right" <?php echo e(($data['image_position'] ?? '') == 'right' ? 'selected' : ''); ?>>يمين النص</option>
            </select>
        </div>

        
        <div class="col-md-4">
            <label class="fw-bold">حجم الصورة</label>
            <select class="form-select"
                    name="sections[<?php echo e($section->id); ?>][data][image_size]">
                <option value="sm" <?php echo e(($data['image_size'] ?? '') == 'sm' ? 'selected' : ''); ?>>صغير</option>
                <option value="md" <?php echo e(($data['image_size'] ?? 'md') == 'md' ? 'selected' : ''); ?>>متوسط</option>
                <option value="lg" <?php echo e(($data['image_size'] ?? '') == 'lg' ? 'selected' : ''); ?>>كبير</option>
                <option value="full" <?php echo e(($data['image_size'] ?? '') == 'full' ? 'selected' : ''); ?>>بعرض كامل</option>
            </select>
        </div>

        
        <div class="col-md-4">
            <label class="fw-bold">شكل الصورة</label>
            <select class="form-select"
                    name="sections[<?php echo e($section->id); ?>][data][image_style]">
                <option value="rounded" <?php echo e(($data['image_style'] ?? 'rounded') == 'rounded' ? 'selected' : ''); ?>>مستديرة</option>
                <option value="circle" <?php echo e(($data['image_style'] ?? '') == 'circle' ? 'selected' : ''); ?>>دائرية</option>
                <option value="square" <?php echo e(($data['image_style'] ?? '') == 'square' ? 'selected' : ''); ?>>مربعة</option>
            </select>
        </div>

        
        <div class="col-md-4">
            <label class="fw-bold">ظل الصورة</label>
            <select class="form-select"
                    name="sections[<?php echo e($section->id); ?>][data][image_shadow]">
                <option value="none">بدون</option>
                <option value="sm" <?php echo e(($data['image_shadow'] ?? '') == 'sm' ? 'selected' : ''); ?>>خفيف</option>
                <option value="md" <?php echo e(($data['image_shadow'] ?? 'md') == 'md' ? 'selected' : ''); ?>>متوسط</option>
                <option value="lg" <?php echo e(($data['image_shadow'] ?? '') == 'lg' ? 'selected' : ''); ?>>قوي</option>
            </select>
        </div>

       

    </div>
</div>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/pages/sections/images.blade.php ENDPATH**/ ?>